<?php

class Collections extends Connection
{
    private $table = 'tbl_collections';
    public $pk = 'collection_id';
    public $name = 'reference_number';
    public $fk = 'loan_id';

    public $inputs;

    public function add()
    {
        try {
            $this->checker();
            $this->begin_transaction();

            $Loans              = new Loans;
            $Branches           = new Branches;
            $ChartOfAccounts    = new ChartOfAccounts;
            $Journals           = new Journals;
            $LoanTypes          = new LoanTypes;
            $JournalEntry       = new JournalEntry;

            $branch_name    = $Branches->name($this->inputs['branch_id']);
            $jl             = $Journals->jl_data('Collection');
            $loan_row       = $Loans->loan_data($this->inputs['loan_id']);
            $int_chart      = $ChartOfAccounts->chart_data('Interest Income ' . $branch_name, true);
            $penalty_chart  = $ChartOfAccounts->chart_data('Penalty Income ' . $branch_name, true);
            $loan_type      = $loan_row != null ? $LoanTypes->name($loan_row['loan_type_id']) : '';
            $lr_chart       = $ChartOfAccounts->chart_data('Loans Receivable ' . $loan_type . " " . $branch_name, true);

            if ($jl == null)
                throw new Exception("Kindly add the journal \n Collection Receipt Journal");
            if ($loan_row == null)
                throw new Exception("The selected loan does not exists.");
            if ($int_chart == null)
                throw new Exception("Kindly add the chart of account for \n Interest Income - $branch_name.");
            if ($penalty_chart == null)
                throw new Exception("Kindly add the chart of account for \n Penalty Income - $branch_name.");
            if ($lr_chart == null)
                throw new Exception("Kindly add the chart of account for \n Loans Receivable - $loan_type - $branch_name.");

            $journal_ref_code   = $JournalEntry->generate($jl['journal_code']);
            $amount             = $this->clean($this->inputs['amount']);
            $interest           = $this->interest_calculator($amount, $loan_row['loan_amount'], $loan_row['loan_interest'], $loan_row['loan_period']);

            $form = array(
                $this->name         => $this->clean($this->inputs[$this->name]),
                $this->fk           => $this->clean($this->inputs[$this->fk]),
                'branch_id'         => $this->clean($this->inputs['branch_id']),
                'chart_id'          => $this->clean($this->inputs['chart_id']),
                'client_id'         => $this->clean($this->inputs['client_id']),
                'interest'          => $interest,
                'amount'            => $amount,
                'collection_date'   => $this->clean($this->inputs['collection_date']),
                'penalty_amount'    => $this->clean($this->inputs['penalty_amount']),
                'remarks'           => $this->clean($this->inputs['remarks']),
                'user_id'           => $this->clean($_SESSION['lms_user_id']),
                'old_atm_balance'   => $this->clean($this->inputs['old_atm_balance']),
                'atm_withdrawal'    => $this->clean($this->inputs['atm_withdrawal']),
                'atm_charge'        => $this->clean($this->inputs['atm_charge']),
                'atm_balance'       => $this->clean($this->inputs['atm_balance']),
                'excess'            => $this->clean($this->inputs['excess']),
                'receipt_number'    => $this->clean($this->inputs['receipt_number']),
            );

            $cl_id = $this->insertIfNotExist($this->table, $form);
            if ($cl_id < 1)
                throw new Exception($cl_id);

            if ($Loans->loan_balance($this->inputs['loan_id'], $this->inputs['collection_date']) <= 0)
                $Loans->finish();

            // FOR JOURNAL ENTRY
            $form_journal = array(
                'reference_number'  => $journal_ref_code,
                'cross_reference'   => $this->clean($this->inputs[$this->name]),
                'branch_id'         => $this->clean($this->inputs['branch_id']),
                'journal_id'        => $jl['journal_id'],
                'remarks'           => $this->inputs['remarks'],
                'journal_date'      => $this->inputs['collection_date'],
                'status'            => 'F',
                'user_id'           => $_SESSION['lms_user_id'],
                'is_manual'         => 'N'
            );
            $JournalEntry->inputs = $form_journal;
            $journal_entry_id = $JournalEntry->add();
            if ($journal_entry_id < 1)
                throw new Exception($journal_entry_id);


            // FOR CASH IN BANK
            $cnb_total = $amount + $this->inputs['penalty_amount'];
            $form_cnb = array(
                'type'              => 'D',
                'journal_entry_id'  => $journal_entry_id,
                'chart_id'          => $this->clean($this->inputs['chart_id']),
                'amount'            => $cnb_total,
            );
            $JournalEntry->inputs = $form_cnb;
            $journal_entry_detail_id = $JournalEntry->add_detail();
            if ($journal_entry_detail_id < 1)
                throw new Exception($journal_entry_detail_id);


            // FOR INTEREST
            $form_interest = array(
                'type'              => 'C',
                'journal_entry_id'  => $journal_entry_id,
                'chart_id'          => $int_chart['chart_id'],
                'amount'            => $interest,
            );
            $JournalEntry->inputs = $form_interest;
            $journal_entry_detail_id = $JournalEntry->add_detail();
            if ($journal_entry_detail_id < 1)
                throw new Exception($journal_entry_detail_id);


            // FOR PENALTY
            if ($this->inputs['penalty_amount'] > 0) {
                $form_penalty = array(
                    'type'              => 'C',
                    'journal_entry_id'  => $journal_entry_id,
                    'chart_id'          => $penalty_chart['chart_id'],
                    'amount'            => $this->inputs['penalty_amount']
                );
                $JournalEntry->inputs = $form_penalty;
                $journal_entry_detail_id = $JournalEntry->add_detail();
                if ($journal_entry_detail_id < 1)
                    throw new Exception($journal_entry_detail_id);
            }


            // FOR LOANS RECEIVABLE
            $form_receivable = array(
                'type'              => 'C',
                'journal_entry_id'  => $journal_entry_id,
                'chart_id'          => $lr_chart['chart_id'],
                'amount'            => $cnb_total - ($this->inputs['penalty_amount'] + $interest)
            );
            $JournalEntry->inputs = $form_receivable;
            $journal_entry_detail_id = $JournalEntry->add_detail();
            if ($journal_entry_detail_id < 1)
                throw new Exception($journal_entry_detail_id);

            // FOR ACCOUNTS PAYABLE EXCESS ?????

            $this->commit();
            return $cl_id;
        } catch (Exception $e) {
            $this->rollback();
            Logs::error("Collections->add", "Collection", $e->getMessage());
            return $e->getMessage();
        }
    }

    public function interest_calculator($amount, $loan_amount, $loan_interest, $loan_period)
    {
        $monthly_interest_rate = ($loan_interest / 100) / 12;
        $total_interest = ($loan_amount * $monthly_interest_rate) * $loan_period;
        $interest = $loan_amount + $total_interest > 0 ? ($amount / ($loan_amount + $total_interest)) * $total_interest : 0;
        return $interest;
    }

    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
        $is_exist = $this->select($this->table, $this->pk, "$this->name = '" . $this->inputs[$this->name] . "' AND $this->pk != '$primary_id'");
        if ($is_exist->num_rows > 0) {
            return 2;
        } else {
            $form = array(
                'amount'            => $this->clean($this->inputs['amount']),
                'branch_id'         => $this->clean($this->inputs['branch_id']),
                'chart_id'          => $this->clean($this->inputs['chart_id']),
                'collection_date'   => $this->clean($this->inputs['collection_date']),
                'remarks'           => $this->clean($this->inputs['remarks']),
                'user_id'           => $this->clean($_SESSION['lms_user_id']),
                'atm_balance'       => $this->clean($this->inputs['atm_balance']),
                'atm_withdrawal'    => $this->clean($this->inputs['atm_withdrawal']),
                'atm_charge'        => $this->clean($this->inputs['atm_charge']),
                'receipt_number'    => $this->clean($this->inputs['receipt_number']),
            );

            return $this->updateIfNotExist($this->table, $form, "$this->pk = '$primary_id'");
        }
    }

    public function show()
    {
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $Clients = new Clients;
        $Loans = new Loans;
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
            $row['client'] = $Clients->name($Loans->loan_client($row['loan_id']));
            $row['loan_ref_id'] = $Loans->name($row['loan_id']);
            $row['amount'] = number_format($row['amount'], 2);
            $rows[] = $row;
        }
        return $rows;
    }

    public function view($primary_id = null)
    {
        $primary_id = $primary_id == null ? $this->inputs['id'] : $primary_id;
        $Loans = new Loans;
        $result = $this->select($this->table, "*", "$this->pk = '$primary_id'");
        $row = $result->fetch_assoc();
        $loan = $Loans->view($row['loan_id']);
        $row['loan_amount'] = number_format($loan['loan_amount'], 2);
        return $row;
    }

    public function remove()
    {
        $ids = implode(",", $this->inputs['ids']);

        //update loan status
        $result = $this->select($this->table, "loan_id", "$this->pk IN($ids) AND status = 'F'");
        while ($row = $result->fetch_assoc()) {
            $form_ = array(
                'status'   => 'R',
            );
            $this->update('tbl_loans', $form_, "loan_id = '$row[loan_id]'");
        }

        return $this->delete($this->table, "$this->pk IN($ids)");
    }

    public function name($primary_id)
    {
        $result = $this->select($this->table, 'reference_number', "$this->pk = '$primary_id'");
        $row = $result->fetch_assoc();
        return $row['reference_number'];
    }

    public function total($primary_id)
    {
        $result = $this->select($this->table, 'sum(amount) as total', "$this->pk = '$primary_id'");
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function generate()
    {
        return 'CL-' . date('YmdHis');
    }

    public function loan_id()
    {
        $primary_id = $this->inputs['id'];
        $result = $this->select($this->table, "loan_id", "$this->pk = '$primary_id'");
        $row = $result->fetch_assoc();
        return $row['loan_id'];
    }

    public function data_row($primary_id, $field)
    {
        $result = $this->select($this->table, $field, "$this->pk = '$primary_id'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_array();
            return $row[$field];
        } else {
            return "";
        }
    }

    public function pk_by_name($name = null)
    {
        $name = $name == null ? $this->inputs[$this->name] : $name;
        $result = $this->select($this->table, $this->pk, "$this->name = '$name'");
        $row = $result->fetch_assoc();
        return $row[$this->pk] * 1;
    }

    public function collected_per_month($date, $loan_id)
    {
        $result = $this->select("tbl_collections as c, tbl_loans as l", 'sum(c.amount) as total', "l.loan_id='$loan_id' AND c.loan_id='$loan_id' AND (MONTH(c.collection_date) = MONTH('$date') AND YEAR(c.collection_date)= YEAR('$date'))");
        $row = $result->fetch_assoc();
        return $row['total'];
    }


    public function penalty_checker($date, $loan_id)
    {
        $result = $this->select("tbl_collections as c, tbl_loans as l", '*', "l.loan_id='$loan_id' AND c.loan_id='$loan_id' AND (MONTH(c.collection_date) = MONTH('$date') AND YEAR(c.collection_date)= YEAR('$date'))");

        if ($result->num_rows > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function advance_collection($loan_id)
    {
        $result = $this->select("tbl_collections as c, tbl_loans as l", 'sum(c.amount) as total', "l.loan_id='$loan_id' AND c.loan_id='$loan_id' AND c.collection_date <= l.loan_date");
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function late_collection($loan_id, $date)
    {
        $result = $this->select("tbl_collections as c, tbl_loans as l", 'sum(c.amount) as total', "l.loan_id='$loan_id' AND c.loan_id='$loan_id' AND c.collection_date > '$date'");
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function late_collection_checker($loan_id, $date)
    {
        $result = $this->select("tbl_collections as c, tbl_loans as l", 'collection_date', "l.loan_id='$loan_id' AND c.loan_id='$loan_id' AND c.collection_date > '$date' order by collection_date desc
        limit 1;");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['collection_date'];
        } else {
            return 0;
        }
    }


    public function penalty_per_month($date, $loan_id)
    {
        $result = $this->select("tbl_collections as c, tbl_loans as l", 'sum(c.penalty_amount) as total', "l.loan_id='$loan_id' AND c.loan_id='$loan_id' AND (MONTH(c.collection_date) = MONTH('$date') AND YEAR(c.collection_date)= YEAR('$date'))");
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function total_collected($loan_id)
    {
        $result = $this->select($this->table, '(sum(amount-penalty_amount)) as total', "loan_id='$loan_id' AND status='F'");
        $row = $result->fetch_assoc();
        return ($row['total']);
    }


    public function total_collected_by_loan($loan_id)
    {
        $result = $this->select($this->table, 'sum(amount) as total, sum(penalty_amount) as penalty', "loan_id='$loan_id' AND status='F'");
        $row = $result->fetch_assoc();
        return [$row['total'], $row['penalty']];
    }

    public function monthly_collection($month, $year, $branch_id = null)
    {
        $query = $branch_id == "" ? "" : "AND branch_id='$branch_id'";
        $result = $this->select("tbl_collections", 'sum(amount) as total', "(MONTH(collection_date) = '$month' AND YEAR(collection_date)= '$year') AND status='F' $query");
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function client_id()
    {
        $primary_id = $this->inputs['id'];
        $result = $this->select($this->table, "client_id,loan_id", "$this->pk = '$primary_id'");
        $row = $result->fetch_assoc();
        return [$row['client_id'], $row['loan_id']];
    }

    public function import()
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 0);

        $response = [];
        $file = $_FILES['csv_file'];
        $fileType = pathinfo($file['name'], PATHINFO_EXTENSION);
        if ($fileType != 'csv') {
            $response['status'] = -1;
            $response['text'] = 'Invalid file format. Only CSV files are allowed.';
            return $response;
        }

        // Read the CSV file data
        $csvData = array();
        if (($handle = fopen($file['tmp_name'], 'r')) !== false) {
            while (($row = fgetcsv($handle)) !== false) {
                $csvData[] = $row;
            }
            fclose($handle);
        } else {
            $response['status'] = -1;
            $response['text'] = 'Failed to read the CSV file.';
            return $response;
        }

        // Display the processed data
        $branches = ["BCD" => 1, "LC" => 2];
        $loans_data = [];
        $count = 0;
        $success_import = 0;
        $unsuccess_import = 0;
        $Clients = new Clients();
        foreach ($csvData as $row) {
            if ($count > 0) {

                $Loans = new Loans();
                $loan_id = $Loans->idByName($this->clean($row[1]));
                $Loans->inputs['id'] = $loan_id;
                $client_id = $Loans->client_id();

                $branch_name = $row[0] == 'BCD' ? "Bacolod" : "La Carlota";
                $reference_number = "CL-" . date("Ymd", strtotime($row[2])) . sprintf("%'.06d", $count);
                $form = [
                    'branch_id' => $row[0] ? $branches[$row[0]] : 1,
                    'branch_name' => $branch_name,
                    'loan_reference_number' => $this->clean($row[1]),
                    'reference_number' => $reference_number,
                    'loan_id' => $loan_id,
                    'client_id' => $client_id,
                    'client_name' => $Clients->name($client_id),
                    'amount' => (float) str_replace(',', '', $row[5]),
                    'collection_date' => date("Y-m-d", strtotime($row[2])),
                    'penalty_amount' => (float) str_replace(',', '', $row[4]),
                    'remarks' => $this->clean($row[6]),
                    'bank' => $this->clean($row[3]),
                ];

                if ($client_id > 0 && $loan_id > 0) {
                    $Collections = new Collections;
                    $Collections->inputs = $form;
                    $loan_id = $row[0] != '' ? $Collections->add() : 0;
                    if ($loan_id == 2) {
                        $form['import_status'] = 0;
                        $unsuccess_import += 1;
                    } else if ($loan_id == 0) {
                        $form['import_status'] = 0;
                        $unsuccess_import += 1;
                    } else {
                        $form['import_status'] = 1;
                        $success_import += 1;
                    }
                } else {
                    $form['import_status'] = 0;
                    $unsuccess_import += 1;
                }

                $loans_data[] = $form;
            }
            $count++;
        }
        $response['status'] = 1;
        $response['collections'] = $loans_data;
        $response['success_import'] = $success_import;
        $response['unsuccess_import'] = $unsuccess_import;
        return $response;
    }

    public function schema()
    {
        $default['date_added'] = $this->metadata('date_added', 'datetime', '', 'NOT NULL', 'CURRENT_TIMESTAMP');
        $default['date_last_modified'] = $this->metadata('date_last_modified', 'datetime', '', 'NOT NULL', 'CURRENT_TIMESTAMP', 'ON UPDATE CURRENT_TIMESTAMP');
        $default['user_id'] = $this->metadata('user_id', 'int', 11);


        // TABLE HEADER
        $tables[] = array(
            'name'      => $this->table,
            'primary'   => $this->pk,
            'fields' => array(
                $this->metadata($this->pk, 'int', 11, 'NOT NULL', '', 'AUTO_INCREMENT'),
                $this->metadata($this->name, 'varchar', 75),
                $this->metadata('branch_id', 'int', 11),
                $this->metadata('client_id', 'int', 11),
                $this->metadata('loan_id', 'int', 11),
                $this->metadata('receipt_number', 'varchar', 5),
                $this->metadata('amount', 'decimal', '12,4'),
                $this->metadata('penalty_amount', 'decimal', '12,4'),
                $this->metadata('interest', 'decimal', '12,4'),
                $this->metadata('remarks', 'varchar', 250),
                $this->metadata('collection_date', 'date'),
                $this->metadata('mass_collection_detail_id', 'int', 11),
                $this->metadata('old_atm_balance', 'decimal', '12,4'),
                $this->metadata('atm_balance', 'decimal', '12,4'),
                $this->metadata('atm_charge', 'decimal', '12,4'),
                $this->metadata('atm_withdrawal', 'decimal', '12,4'),
                $this->metadata('excess', 'decimal', '12,4'),
                $this->metadata('status', 'varchar', 1),
                $this->metadata('chart_id', 'int', 11),
                $default['user_id'],
                $default['date_added'],
                $default['date_last_modified']
            )
        );

        return $this->schemaCreator($tables);
    }


    public function triggers()
    {
        $triggers[] = array(
            'table' => $this->table,
            'name' => 'delete_collections',
            'action_time' => 'AFTER', // ['AFTER','BEFORE']
            'event' => "DELETE", // ['INSERT','UPDATE', 'DELETE']
            "statement" => "DELETE FROM tbl_journal_entries WHERE cross_reference = OLD.reference_number"
        );
        return $this->triggerCreator($triggers);
    }
}
