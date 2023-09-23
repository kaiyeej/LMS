<?php

class MassCollections extends Connection
{
    private $table = 'tbl_mass_collections';
    public $pk = 'mass_collection_id';
    public $name = 'reference_number';

    private $table_detail = 'tbl_mass_collection_details';
    public $pk2 = 'mass_collection_detail_id';

    private $table_collections = 'tbl_collections';

    public $inputs;

    public function add()
    {
        $form = array(
            $this->name         => $this->clean($this->inputs[$this->name]),
            'chart_id'          => $this->clean($this->inputs['chart_id']),
            'collection_date'   => $this->clean($this->inputs['collection_date']),
            'atm_charge'        => $this->clean($this->inputs['atm_charge']),
            'status'            => $this->clean($this->inputs['status']),
            'prepared_by'       => $this->inputs['prepared_by'] ?? $_SESSION['lms_user_id'],
            'finished_by'       => $this->inputs['finished_by'] ?? $_SESSION['lms_user_id'],
        );

        return $this->insert($this->table, $form, 'Y');
    }
    public function edit()
    {
        $form = array(
            'prepared_by'   => $this->inputs['prepared_by'],
            'finished_by'   => $this->inputs['finished_by'],
        );

        return $this->update($this->table, $form, "mass_collection_id = '" . $this->inputs['mass_collection_id'] . "'");
    }
    public function show()
    {
        $Branches           = new Branches;
        $LoanTypes          = new LoanTypes;
        $ChartOfAccounts    = new ChartOfAccounts;
        $Employers          = new Employers;
        $Users              = new Users;

        $param = $this->inputs['param'] ?? null;
        $rows = array();
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
            $row['branch']      = $Branches->name($row['branch_id']);
            $row['loan_type']   = $LoanTypes->name($row['loan_type_id']);
            $row['bank']        = $ChartOfAccounts->name($row['chart_id']);
            $row['employer']    = $Employers->name($row['employer_id']);
            $row['prepared']    = $Users->name($row['prepared_by']);
            $row['checked']     = $Users->name($row['finished_by']);
            $rows[] = $row;
        }
        return $rows;
    }

    public function initilize_query()
    {
        "SELECT l.*
        FROM tbl_loans AS l
        INNER JOIN tbl_clients AS c ON c.client_id = l.client_id
        INNER JOIN tbl_client_employment AS ce ON ce.client_id = c.client_id
        WHERE
            c.branch_id= 1
            AND ce.employer_id = 4
        GROUP BY c.client_id
        ORDER BY c.client_lname ASC";
    }

    public function initialize()
    {
        $Clients            = new Clients;
        $ChartOfAccounts    = new ChartOfAccounts;
        $Branches           = new Branches;
        $Employers          = new Employers;
        $ClientAtm          = new ClientAtm;
        $LoanTypes          = new LoanTypes;
        $Users              = new Users;

        // $loan_type_id       = $this->inputs['loan_type_id'];
        $collection_date    = $this->inputs['collection_date'];
        $employer_id        = $this->inputs['employer_id'];
        $chart_id           = $this->inputs['chart_id'];
        $branch_id          = (int) $this->inputs['branch_id'];
        $atm_charge         = (float) $this->inputs['atm_charge'];
        $loan_types         = $LoanTypes->show();

        $rows = array();
        $result = $this->select(
            "tbl_loans",
            '*',
            "status = 'R' AND branch_id = '$branch_id' GROUP BY client_id"
        );
        while ($row = $result->fetch_assoc()) {
            $row_details = [];
            $row_details['client_id']       = $row['client_id'];
            $row_details['branch_id']       = $row['branch_id'];
            $row_details['client_name']     = $Clients->initial_name($row['client_id']);
            $row_details['receipt_number']  = "";
            $row_details['old_atm_balance'] = 0;
            $row_details['atm_withdrawal']  = 0;
            $row_details['deduction']       = $row['monthly_payment'];
            $row_details['emergency_loan']  = 0;
            $row_details['atm_charge']      = $atm_charge;
            $row_details['atm_balance']     = 0;
            $row_details['excess']          = 0;
            $row_details['atm_account_no']  = $ClientAtm->name($row['client_id']);
            $row_details['is_included']     = 1;
            $row_details['mass_collection_detail_id'] = 0;
            $row_details['loans'] = $this->loans_per_type($loan_types, $row['client_id']);

            $rows[] = $row_details;
        }
        $response['clients'] = $rows;

        $response['headers'] = [
            // "loan_type_id"          => $loan_type_id,
            // "loan_name"             => $LoanTypes->name($loan_type_id),
            "collection_date"       => date("Y-m-d", strtotime($collection_date)),
            "collection_date_label" => date("F d, Y", strtotime($collection_date)),
            "employer_id"           => $employer_id,
            // "employer_name"         => $Employers->name($employer_id),
            "prepared_by"           => $_SESSION['lms_user_id'],
            "finished_by"           => $_SESSION['lms_user_id'],
            "chart_id"              => $chart_id,
            "chart_name"            => $ChartOfAccounts->name($chart_id),
            "branch_id"             => $branch_id,
            // "branch_name"           => $Branches->name($branch_id),
            "atm_charge"            => $atm_charge,
            "status"                => "S",
            "mass_collection_id"    => 0,
            "loan_types"            => $loan_types,
            "users"                 => $Users->show()
        ];
        return $response;
    }

    public function loans_per_type($loan_types, $client_id)
    {
        $response = [];
        foreach ($loan_types as $row) {
            $loan_data = $this->loan_per_type($client_id, $row['loan_type_id']);
            $loan_data['loan_type_id'] = (int) $row['loan_type_id'];
            $response[] = $loan_data;
        }
        return $response;
    }

    public function loan_per_type($client_id, $loan_type_id)
    {
        $result = $this->select("tbl_loans", 'loan_id,monthly_payment', "client_id = '$client_id' AND loan_type_id = '$loan_type_id' AND status = 'R'");

        if ($result->num_rows < 1)
            return [
                'loan_id' => 0,
                'monthly_payment' => 0
            ];

        $row = $result->fetch_assoc();
        return [
            'loan_id' => (int) $row['loan_id'],
            'monthly_payment' => (float) $row['monthly_payment']
        ];
    }

    public function save_collections()
    {
        try {
            $this->checker();
            $this->begin_transaction();

            if ($this->inputs['mass_collection_id'] > 0) {
                $mass_collection_id = $this->inputs['mass_collection_id'];
                $this->edit();
            } else {
                $this->inputs['reference_number'] = $this->generate();
                $this->inputs['prepared_by'] = $this->inputs['prepared_by'];
                $mass_collection_id = $this->add();
                if ($mass_collection_id < 1)
                    throw new Exception($mass_collection_id);
            }

            $details = $this->inputs['details'];

            foreach ($details as $row) {
                $form_detail = [
                    'mass_collection_id'    => $mass_collection_id,
                    'client_id'             => $row['client_id'],
                    'branch_id'             => $row['branch_id'],
                    'receipt_number'        => $row['receipt_number'],
                    'old_atm_balance'       => $row['old_atm_balance'],
                    'atm_withdrawal'        => $row['atm_withdrawal'],
                    'atm_charge'            => $row['atm_charge'],
                    'atm_balance'           => $row['atm_balance'],
                    'excess'                => $row['excess'],
                    'atm_account_no'        => $row['atm_account_no'],
                    'is_included'           => $row['is_included'],
                    'loans'                 => json_encode($row['loans'])
                ];

                $is_inserted = $row['mass_collection_detail_id'] > 0 ? $this->update($this->table_detail, $form_detail, "mass_collection_detail_id = '" . $row['mass_collection_detail_id'] . "'") : $this->insert($this->table_detail, $form_detail);
                if ($is_inserted != 1)
                    throw new Exception($is_inserted);
            }
            $this->commit();
            return $mass_collection_id;
        } catch (Exception $e) {
            $this->rollback();
            Logs::error("MassCollections->save_collections", "Mass Collection", $e->getMessage());
            return $e->getMessage();
        }
    }

    public function finish_collections()
    {
        try {
            $this->checker();
            $this->begin_transaction();

            if ($this->inputs['mass_collection_id'] > 0) {
                $mass_collection_id = $this->inputs['mass_collection_id'];
            } else {
                $this->inputs['reference_number'] = $this->generate();
                $mass_collection_id = $this->add();
                if ($mass_collection_id < 1)
                    throw new Exception($mass_collection_id);
            }

            $details = $this->inputs['details'];

            foreach ($details as $row) {
                $form_detail = [
                    'mass_collection_id'    => $mass_collection_id,
                    'client_id'             => $row['client_id'],
                    'branch_id'             => $row['branch_id'],
                    'receipt_number'        => $row['receipt_number'],
                    'old_atm_balance'       => $row['old_atm_balance'],
                    'atm_withdrawal'        => $row['atm_withdrawal'],
                    'atm_charge'            => $row['atm_charge'],
                    'atm_balance'           => $row['atm_balance'],
                    'excess'                => $row['excess'],
                    'atm_account_no'        => $row['atm_account_no'],
                    'is_included'           => $row['is_included'],
                    'loans'                 => json_encode($row['loans'])
                ];

                $is_inserted = $row['mass_collection_detail_id'] > 0 ? $this->update($this->table_detail, $form_detail, "mass_collection_detail_id = '" . $row['mass_collection_detail_id'] . "'") : $this->insert($this->table_detail, $form_detail);
                if ($is_inserted != 1)
                    throw new Exception($is_inserted);

                if ($row['is_included'] == 1) {
                    foreach ($row['loans'] as $loan_data) {
                        if ($loan_data['loan_id'] > 0) {
                            $form_collection = [
                                'branch_id'         => $row['branch_id'],
                                'reference_number'  => "CL-" . $row['client_id'] . "-" . $loan_data['loan_id'] . "-" . date("YmdHis"),
                                'chart_id'          => $this->clean($this->inputs['chart_id']),
                                'collection_date'   => $this->clean($this->inputs['collection_date']),
                                'penalty_amount'    => 0,
                                'remarks'           => "",
                                'loan_id'           => $loan_data['loan_id'],
                                'client_id'         => $row['client_id'],
                                'amount'            => $loan_data['monthly_payment'],
                                'old_atm_balance'   => $row['old_atm_balance'],
                                'atm_balance'       => $row['atm_balance'],
                                'atm_withdrawal'    => $row['atm_withdrawal'],
                                'atm_charge'        => $row['atm_charge'],
                                'excess'            => $row['excess'],
                                'receipt_number'    => $row['receipt_number'],
                                'mass_collection_detail_id' => $row['mass_collection_detail_id'],
                            ];

                            $MassCollections = new MassCollections;
                            $MassCollections->inputs = $form_collection;
                            $cl_id = $MassCollections->add_collection();
                            if ($cl_id < 1)
                                throw new Exception($cl_id);
                        }
                    }
                }
            }
            $this->update($this->table, ['status' => 'F'], "mass_collection_id = '$mass_collection_id'");
            $this->commit();
            return $mass_collection_id;
        } catch (Exception $e) {
            $this->rollback();
            Logs::error("MassCollections->finish_collections", "Mass Collection", $e->getMessage());
            return $e->getMessage();
        }
    }

    public function remove()
    {
        $ids = implode(",", $this->inputs['ids']);
        return $this->delete($this->table, "$this->pk IN($ids)");
    }

    public function add_collection()
    {
        try {
            $Loans              = new Loans;
            $Branches           = new Branches;
            $ChartOfAccounts    = new ChartOfAccounts;
            $Journals           = new Journals;
            $LoanTypes          = new LoanTypes;
            $JournalEntry       = new JournalEntry;
            $Collections        = new Collections;

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

            $ref_code       = $JournalEntry->generate($jl['journal_code'] . "-" . $this->inputs['mass_collection_detail_id']);
            $amount         = $this->clean($this->inputs['amount']);
            $interest       = $Collections->interest_calculator($amount, $loan_row['loan_amount'], $loan_row['loan_interest'], $loan_row['loan_period']);

            $form = array(
                'reference_number'  => $this->clean($this->inputs['reference_number']),
                'loan_id'           => $this->clean($this->inputs['loan_id']),
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
                'mass_collection_detail_id' => $this->clean($this->inputs['mass_collection_detail_id']),
            );

            $cl_id = $this->insert($this->table_collections, $form, 'Y');
            if ($cl_id < 1)
                throw new Exception("cl_id:" . $cl_id);

            if ($Loans->loan_balance($this->inputs['loan_id'], $this->inputs['collection_date']) <= 0)
                $Loans->finish();

            // FOR JOURNAL ENTRY
            $form_journal = array(
                'reference_number'  => $ref_code,
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
                throw new Exception("form_journal:" . $journal_entry_id);


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
                throw new Exception("form_cnb:" . $journal_entry_detail_id);


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
                throw new Exception("form_interest:" . $journal_entry_detail_id);


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
                    throw new Exception("form_penalty:" . $journal_entry_detail_id);
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
                throw new Exception("form_receivable:" . $journal_entry_detail_id);
            return $cl_id;
        } catch (Exception $e) {
            Logs::error("MassCollections->add_collection", "Collection", $e->getMessage());
            return $e->getMessage();
        }
    }

    public function view_saved()
    {
        $mass_collection_id = $this->inputs['id'];

        $Clients = new Clients;
        $LoanTypes = new LoanTypes;
        $Users = new Users;

        $rows = array();
        $result = $this->select($this->table_detail, "*", "mass_collection_id = '$mass_collection_id'");
        while ($row = $result->fetch_assoc()) {
            $row['client_name'] = $Clients->initial_name($row['client_id']);
            $row['loans'] = json_decode($row['loans'], true);
            $rows[] = $row;
        }
        $response['clients'] = $rows;

        $response['headers'] = $this->view();
        $response['headers']['loan_types'] = $LoanTypes->show();
        $response['headers']['users'] = $Users->show();
        return $response;
    }

    public function view()
    {
        $primary_id = $this->inputs['id'];
        $result = $this->select($this->table, "*", "$this->pk = '$primary_id'");
        return $result->fetch_assoc();
    }

    public function generate()
    {
        return 'MCL-' . date('YmdHis');
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
                $this->metadata('loan_type_id', 'int', 11),
                $this->metadata('chart_id', 'int', 11),
                $this->metadata('collection_date', 'date'),
                $this->metadata('employer_id', 'int', 11),
                $this->metadata('atm_charge', 'decimal', '12,2'),
                $this->metadata('status', 'varchar', 1, 'NOT NULL', "'S'", '', "'S:Saved;F:Finished'"),
                $this->metadata('prepared_by', 'int', 11),
                $this->metadata('finished_by', 'int', 11),
                $default['date_added'],
                $default['date_last_modified']
            )
        );

        // TABLE DETAILS
        $tables[] = array(
            'name'      => $this->table_detail,
            'primary'   => $this->pk2,
            'fields' => array(
                $this->metadata($this->pk2, 'int', 11, 'NOT NULL', '', 'AUTO_INCREMENT'),
                $this->metadata('mass_collection_id', 'int', 11),
                $this->metadata('client_id', 'int', 11),
                $this->metadata('branch_id', 'int', 11),
                $this->metadata('receipt_number', 'varchar', 5),
                $this->metadata('old_atm_balance', 'decimal', '12,4'),
                $this->metadata('atm_withdrawal', 'decimal', '12,4'),
                $this->metadata('atm_charge', 'decimal', '12,4'),
                $this->metadata('atm_balance', 'decimal', '12,4'),
                $this->metadata('excess', 'decimal', '12,4'),
                $this->metadata('atm_account_no', 'varchar', 50),
                $this->metadata('loans', 'text'),
                $this->metadata('is_included', 'int', 1),
                $default['date_added'],
                $default['date_last_modified']
            )
        );

        return $this->schemaCreator($tables);
    }

    public function triggers()
    {
        // HEADER
        $triggers[] = array(
            'table' => $this->table,
            'name' => 'delete_mass_collections',
            'action_time' => 'AFTER', // ['AFTER','BEFORE']
            'event' => "DELETE", // ['INSERT','UPDATE', 'DELETE']
            "statement" => "DELETE FROM $this->table_detail WHERE $this->pk = OLD.$this->pk"
        );

        // HEADER
        $triggers[] = array(
            'table' => $this->table,
            'name' => 'delete_' . $this->table,
            'action_time' => 'BEFORE', // ['AFTER','BEFORE']
            'event' => "DELETE", // ['INSERT','UPDATE', 'DELETE']
            "statement" => "INSERT INTO " . $this->table . "_deleted SELECT * FROM $this->table WHERE $this->pk = OLD.$this->pk"
        );

        return $this->triggerCreator($triggers);
    }
}
