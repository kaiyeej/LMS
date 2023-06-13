<?php

class Loans extends Connection
{
    private $table = 'tbl_loans';
    public $pk = 'loan_id';
    public $name = 'reference_number';

    public $inputs;

    public function add()
    {
        $form = array(
            $this->name         => $this->clean($this->inputs[$this->name]),
            'branch_id'         => $this->clean($this->inputs['branch_id']),
            'client_id'         => $this->clean($this->inputs['client_id']),
            'loan_type_id'      => $this->clean($this->inputs['loan_type_id']),
            'loan_date'         => $this->clean($this->inputs['loan_date']),
            'loan_amount'       => $this->clean($this->inputs['loan_amount']),
            'loan_period'       => $this->clean($this->inputs['loan_period']),
            'loan_interest'     => $this->clean($this->inputs['loan_interest']),
            'service_fee'       => $this->clean($this->inputs['service_fee']),
            'monthly_payment'   => $this->clean($this->inputs['monthly_payment']),
        );

        if (isset($this->inputs['status']))
            $form['status'] = $this->inputs['status'];

        return $this->insertIfNotExist($this->table, $form, "$this->name = '" . $this->inputs[$this->name] . "'");
    }

    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
        $name = $this->clean($this->inputs['reference_number']);
        $is_exist = $this->select($this->table, $this->pk, "$this->name = '" . $this->inputs[$this->name] . "' AND $this->pk != '$primary_id'");
        if ($is_exist->num_rows > 0) {
            return 2;
        } else {
            $form = array(
                $this->name         => $this->clean($this->inputs[$this->name]),
                'branch_id'         => $this->clean($this->inputs['branch_id']),
                'client_id'         => $this->clean($this->inputs['client_id']),
                'loan_type_id'      => $this->clean($this->inputs['loan_type_id']),
                'loan_date'         => $this->clean($this->inputs['loan_date']),
                'loan_amount'       => $this->clean($this->inputs['loan_amount']),
                'loan_period'       => $this->clean($this->inputs['loan_period']),
                'loan_interest'     => $this->clean($this->inputs['loan_interest']),
                'service_fee'       => $this->clean($this->inputs['service_fee']),
                'monthly_payment'   => $this->clean($this->inputs['monthly_payment']),
            );

            return $this->updateIfNotExist($this->table, $form, "$this->pk = '$primary_id'");
        }
    }

    public function show()
    {
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $Clients = new Clients;
        $LoanTypes = new LoanTypes;
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
            $row['client'] = $Clients->name($row['client_id']);
            $row['loan_account'] = $Clients->name($row['client_id']) . " - " . $row['reference_number'];
            $row['loan_type'] = $LoanTypes->name($row['loan_type_id']);
            $row['loan_ref_id'] = $row['reference_number'] . " (₱" . number_format($row['loan_amount'], 2) . ")";
            $rows[] = $row;
        }
        return $rows;
    }

    public function view()
    {
        $primary_id = $this->inputs['id'];
        $LoanTypes = new LoanTypes;
        $Clients = new Clients;
        $result = $this->select($this->table, "*", "$this->pk = '$primary_id'");
        $row = $result->fetch_assoc();
        $row['loan_type'] = $LoanTypes->name($row['loan_type_id']);
        $row['amount'] = number_format($row['loan_amount'], 2);
        $row['client'] = $Clients->name($row['client_id']);
        return $row;
    }

    public function client_id()
    {
        $primary_id = $this->inputs['id'];
        $result = $this->select($this->table, "client_id", "$this->pk = '$primary_id'");
        $row = $result->fetch_assoc();
        return $row['client_id'];
    }

    public function remove()
    {
        $ids = implode(",", $this->inputs['ids']);

        return $this->delete($this->table, "$this->pk IN($ids)");
    }

    public function released()
    {
        $primary_id = $this->inputs['id'];
        $form = array(
            'status' => 'R',
        );
        return $this->update($this->table, $form, "$this->pk = '$primary_id'");
    }

    public function denied()
    {
        $primary_id = $this->inputs['id'];
        $form = array(
            'status' => 'D',
        );
        return $this->update($this->table, $form, "$this->pk = '$primary_id'");
    }

    public function name($primary_id)
    {
        $result = $this->select($this->table, 'reference_number', "$this->pk = '$primary_id'");
        $row = $result->fetch_assoc();
        return $row['reference_number'];
    }

    public function loan_client($primary_id)
    {
        $result = $this->select($this->table, 'client_id', "$this->pk = '$primary_id'");
        $row = $result->fetch_assoc();
        return $row['client_id'];
    }

    public function generate()
    {
        return 'LN-' . date('YmdHis');
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

    public function total($primary_id)
    {
        $result = $this->select($this->table, 'sum(loan_amount) as total', "$this->pk = '$primary_id'");
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function loan_data($primary_id)
    {
        $result = $this->select($this->table, '*', "$this->pk = '$primary_id'");
        return $result->fetch_assoc();
    }

    public function sample_calculation()
    {
        $loan_interest = $this->inputs['loan_interest'];
        $loan_period = $this->inputs['loan_period'];
        $loan_amount = $this->inputs['loan_amount'];
        $loan_date = $this->inputs['loan_date'];

        $count = 1;
        $rows = array();
        while ($count <= $loan_period) {

            $loan_date = date('M d, Y', strtotime('+1 month', strtotime($loan_date)));

            $monthly_interest_rate = ($loan_interest / 100) / 12;
            $total_amount_with_interest = ($loan_amount * $monthly_interest_rate * $loan_period) + $loan_amount;
            $suggested_payment = $loan_period > 0 ? $total_amount_with_interest / $loan_period : "";
            $monthly_interest = $loan_amount * $monthly_interest_rate;
            $principal_amount = $loan_amount / $loan_period;

            $row['date'] = $loan_date;
            $row['payment'] = number_format($suggested_payment, 2);
            $row['interest'] = number_format($monthly_interest, 2);
            $row['applicable_principal'] =  number_format($principal_amount, 2);
            $rows[] = $row;

            $count++;
        }

        return $rows;
    }

    public function statement_of_accounts()
    {
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $result = $this->select($this->table, '*', "$param");
        $row = $result->fetch_assoc();

        $loan_interest = $row['loan_interest'];
        $loan_period = $row['loan_period'];
        $loan_amount = $row['loan_amount'];
        $loan_date = $row['loan_date'];

        $count = 1;
        $rows = array();
        $Collection = new Collections;
        while ($count <= $loan_period) {

            $loan_date = date('M d, Y', strtotime('+1 month', strtotime($loan_date)));

            $monthly_interest_rate = ($loan_interest / 100) / 12;
            $total_amount_with_interest = ($loan_amount * $monthly_interest_rate * $loan_period) + $loan_amount;
            $suggested_payment = $loan_period > 0 ? $total_amount_with_interest / $loan_period : "";
            $monthly_interest = $loan_amount * $monthly_interest_rate;
            $principal_amount = $loan_amount / $loan_period;



            $row['date'] = $loan_date;
            $row['payment'] = number_format($Collection->collected_per_month($loan_date), 2);
            $row['interest'] = number_format($monthly_interest, 2);
            $row['penalty'] = number_format(0, 2);
            $row['applicable_principal'] =  number_format($principal_amount, 2);
            $rows[] = $row;

            $count++;
        }

        return $rows;
    }

    public function accounts_receivable()
    {
        $report_year = $this->inputs['report_year'];
        $rows = array();
        $Clients = new Clients;
        $Collections = new Collections;
        $result = $this->select($this->table, '*', "YEAR(loan_date) = '$report_year' AND status != 'D'");
        while ($row = $result->fetch_assoc()) {
            $payment = $Collections->total_collected($row['loan_id']);
            $amount_receivable = $row['loan_amount'] - $payment;
            $penalty = 0;
            $subtotal = $amount_receivable + $penalty;
            $row['client'] = $Clients->name($row['client_id']);
            $row['amount'] = number_format($row['loan_amount'], 2);
            $row['total_payment'] = number_format($payment, 2);
            $row['amount_receivable'] = number_format($amount_receivable, 2);
            $row['total_penalties'] = number_format($penalty, 2);
            $row['subtotal'] = number_format($subtotal, 2);
            $rows[] = $row;
        }
        return $rows;
    }

    public function released_total()
    {
        $year = date('Y');
        $result = $this->select($this->table, "sum(loan_amount) as total", "YEAR(loan_date) = '$year' AND (status = 'R' OR status='F')");
        $row = $result->fetch_assoc();
        return $row['total'];
    }


    public function outstanding_total()
    {
        $total = 0;
        $result = $this->select($this->table, "loan_id,loan_amount,client_id", "status = 'R'");
        while ($row = $result->fetch_assoc()) {
            $collection = $this->select('tbl_collections', "sum(amount) as total", "status = 'F' AND loan_id='$row[loan_id]' AND client_id='$row[client_id]'");
            $total_collected = $collection->fetch_assoc();

            $total += $row['loan_amount'] - $total_collected['total'];
        }

        return $total;
    }

    public function approved_loans()
    {
        $year = date('Y');
        $result = $this->select($this->table, "count(loan_id) as total", "YEAR(loan_date) = '$year' AND (status = 'R' OR status = 'A' OR status='F')");
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function pending_loans()
    {
        $year = date('Y');
        $result = $this->select($this->table, "count(loan_id) as total", "YEAR(loan_date) = '$year' AND status = 'A'");
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function dashboard()
    {
        $rows = array();
        $row['outstanding_total'] = number_format($this->outstanding_total(), 2);
        $row['released_total'] = number_format($this->released_total(), 2);
        $row['approved_total'] = $this->approved_loans();
        $row['pending_total'] = $this->pending_loans();
        $rows = $row;
        return $rows;
    }

    public function penalty()
    {
        $loan_id = $this->inputs['loan_id'];
        $collection_date = $this->inputs['collection_date'];

        $result = $this->select($this->table, '*', "loan_id='$loan_id'");
        $row = $result->fetch_assoc();

        $loan_interest = $row['loan_interest'];
        $loan_period = $row['loan_period'];
        $loan_amount = $row['loan_amount'];
        $loan_date = $row['loan_date'];

        $LoanTypes = new LoanTypes;
        $penalty_per = $LoanTypes->penalty_percentage($row['loan_type_id']);


        $ts1 = strtotime($loan_date);
        $ts2 = strtotime($collection_date);

        $year1 = date('Y', $ts1);
        $year2 = date('Y', $ts2);

        $month1 = date('m', $ts1);
        $month2 = date('m', $ts2);

        $diff = (($year2 - $year1) * 12) + ($month2 - $month1);

        $suggested_total = 0;
        $payment_total = 0;
        $count = 2;
        $Collection = new Collections;
        while ($count <= $diff) {

            $loan_date = date('Y-m-d', strtotime('+1 month', strtotime($loan_date)));

            $monthly_interest_rate = ($loan_interest / 100) / 12;
            $total_amount_with_interest = ($loan_amount * $monthly_interest_rate * $loan_period) + $loan_amount;
            $suggested_payment = $loan_period > 0 ? $total_amount_with_interest / $loan_period : "";
            $payment = $Collection->collected_per_month($loan_date, $loan_id);

            $suggested_total += $suggested_payment;
            $payment_total += $payment;

            $count++;
        }

        $pending = $suggested_total - $payment_total;

        return $pending * ($penalty_per / 100);

        // return $suggested_total." ".$payment_total;
    }

    public function schema()
    {
        if (DEVELOPMENT) {
            $default['date_added'] = $this->metadata('date_added', 'datetime', '', 'NOT NULL', 'CURRENT_TIMESTAMP');
            $default['date_last_modified'] = $this->metadata('date_last_modified', 'datetime', '', 'NOT NULL', '', 'ON UPDATE CURRENT_TIMESTAMP');
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
                    $this->metadata('loan_type_id', 'int', 11),
                    $this->metadata('loan_amount', 'decimal', '12,3'),
                    $this->metadata('service_fee', 'decimal', '12,3'),
                    $this->metadata('monthly_payment', 'decimal', '12,3'),
                    $this->metadata('loan_period', 'int', 11),
                    $this->metadata('loan_interest', 'int', 11),
                    $this->metadata('due_date', 'date'),
                    $this->metadata('loan_date', 'date'),
                    $this->metadata('status', 'varchar', 1, 'NOT NULL', "'A'", '', "P - Pending; A - Approved; R - Released; D - Denied; F- Fully paid"),
                    $default['user_id'],
                    $default['date_added'],
                    $default['date_last_modified']
                )
            );

            return $this->schemaCreator($tables);
        }
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
        $LoanTypes = new LoanTypes();

        foreach ($csvData as $row) {
            if ($count > 0) {
                $client_id = $Clients->idByFullname($this->clean($row[2]));
                $loan_type_id = $LoanTypes->idByName($this->clean($row[3]));
                $branch_name = $row[0] == 'BCD' ? "Bacolod" : "La Carlota";
                $form = [
                    'branch_id'         => $row[0] ? $branches[$row[0]] : 1,
                    'branch_name'       => $branch_name,
                    'reference_number'  => $row[1],
                    'client_id'         => $client_id,
                    'client_name'       => $this->clean($row[2]),
                    'loan_type_id'      => $loan_type_id,
                    'loan_type'         => $this->clean($row[3]),
                    'loan_date'         => date("Y-m-d", strtotime($row[4])),
                    'loan_amount'       => (float) str_replace(',', '', $row[5]),
                    'loan_interest'     => (float) str_replace(',', '', $row[6]),
                    'loan_period'       => (float) str_replace(',', '', $row[7]),
                    'service_fee'       => (float) str_replace(',', '', $row[8]),
                    'monthly_payment'   => (float) str_replace(',', '', $row[9]),
                ];

                if ($client_id > 0 && $loan_type_id > 0) {
                    $Loans = new Loans;
                    $Loans->inputs = $form;
                    $loan_id = $row[0] != '' ? $Loans->add() : 0;
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
        $response['loans'] = $loans_data;
        $response['success_import'] = $success_import;
        $response['unsuccess_import'] = $unsuccess_import;
        return $response;
    }
}
