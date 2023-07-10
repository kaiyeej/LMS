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
            $this->name             => $this->clean($this->inputs[$this->name]),
            'branch_id'             => $this->clean($this->inputs['branch_id']),
            'client_id'             => $this->clean($this->inputs['client_id']),
            'loan_type_id'          => $this->clean($this->inputs['loan_type_id']),
            'loan_date'             => $this->clean($this->inputs['loan_date']),
            'loan_amount'           => $this->clean($this->inputs['loan_amount']),
            'loan_period'           => $this->clean($this->inputs['loan_period']),
            'loan_interest'         => $this->clean($this->inputs['loan_interest']),
            'penalty_percentage'    => $this->clean($this->inputs['penalty_percentage']),
            'service_fee'           => $this->clean($this->inputs['service_fee']),
            'monthly_payment'       => $this->clean($this->inputs['monthly_payment']),
            'payment_terms'         => $this->clean($this->inputs['payment_terms']),
        );

        if (isset($this->inputs['status']))
            $form['status'] = $this->inputs['status'];

        return $this->insertIfNotExist($this->table, $form, "$this->name = '" . $this->inputs[$this->name] . "'");
    }

    public function renew()
    {

        $primary_id = $this->inputs[$this->pk];
        $row = $this->view($primary_id);
        $deduct_to_loan = (!isset($this->inputs['deduct_to_loan']) ? 0 : 1);
        $monthly_payment = $this->inputs['monthly_payment'] - $row['monthly_payment'];
        $form = array(
            $this->name             => $this->clean($this->inputs[$this->name]),
            'branch_id'             => $row['branch_id'],
            'client_id'             => $row['client_id'],
            'loan_type_id'          => $row['loan_type_id'],
            'loan_date'             => $this->clean($this->inputs['loan_date']),
            'loan_amount'           => $this->clean($this->inputs['loan_amount']),
            'loan_period'           => $this->clean($this->inputs['loan_period']),
            'loan_interest'         => $this->clean($this->inputs['loan_interest']),
            'penalty_percentage'    => $this->clean($this->inputs['penalty_percentage']),
            'service_fee'           => $this->clean($this->inputs['service_fee']),
            'monthly_payment'       => $monthly_payment,
            'main_loan_id'          => $this->clean($this->inputs['loan_id']),
            'payment_terms'         => $this->clean($this->inputs['payment_terms']),
            'renewal_status'        => $this->clean($this->inputs['renewal_status']),
            'deduct_to_loan'        => $deduct_to_loan,
        );

        if (isset($this->inputs['status']))
            $form['status'] = $this->inputs['status'];

        $sql =  $this->insertIfNotExist($this->table, $form, "$this->name = '" . $this->inputs[$this->name] . "'");

        if ($this->inputs['renewal_status'] == "Y") {
            if ($deduct_to_loan != 1) {
                if ($sql) {
                    $Branches = new Branches;
                    $ChartOfAccounts = new ChartOfAccounts;
                    $Journals = new Journals;
                    $LoanTypes = new LoanTypes;
                    $jl = $Journals->jl_data('Collection');
                    $ref_code = $jl['journal_code'] . "-" . date('YmdHis');
                    $branch_name = str_replace(" Branch", "", $Branches->name($this->clean($row['branch_id'])));

                    $loan_row = $this->loan_data($this->inputs['loan_id']);
                    $amount = $this->clean($this->inputs['amount']);
                    $monthly_interest_rate = ($loan_row['loan_interest'] / 100) / 12;
                    $total_interest = ($loan_row['loan_amount'] * $monthly_interest_rate) * $loan_row['loan_period'];
                    $interest = ($amount / ($loan_row['loan_amount'] + $total_interest)) * $total_interest;

                    $collection_num = 'CL-' . date('YmdHis');

                    $form_cl = array(
                        'reference_number'  => $collection_num,
                        'loan_id'           => $this->inputs['loan_id'],
                        'branch_id'         => $row['branch_id'],
                        'chart_id'          => $this->clean($this->inputs['chart_id']),
                        'client_id'         => $row['client_id'],
                        'interest'          => $interest,
                        'amount'            => $amount,
                        'collection_date'   => $this->clean($this->inputs['loan_date']),
                        'penalty_amount'    => $this->clean($this->inputs['penalty_amount']),
                        'remarks'           => "Renew Loan for " . $row['reference_number'],
                        'user_id'           => $this->clean($_SESSION['lms_user_id']),
                    );

                    $this->insert("tbl_collections", $form_cl, "Y");


                    $form_journal = array(
                        'reference_number'  => $ref_code,
                        'cross_reference'   => $collection_num,
                        'journal_id'        => $jl['journal_id'],
                        'remarks'           => "Renew loan (Loan ID: " . $this->clean($this->inputs[$this->name]),
                        'journal_date'      => $this->inputs['loan_date'],
                        'status'            => 'F',
                        'user_id'           => $_SESSION['lms_user_id'],
                        'is_manual'         => 'N'
                    );

                    $journal_entry_id = $this->insert("tbl_journal_entries", $form_journal, 'Y');

                    // FOR CASH IN BANK
                    $cnb_total = $amount + $this->inputs['penalty_amount'];
                    $form_cnb = array('journal_entry_id' => $journal_entry_id, 'chart_id' => $this->clean($this->inputs['chart_id']), 'debit' => $cnb_total);
                    $this->insert('tbl_journal_entry_details', $form_cnb);


                    // FOR INTEREST
                    $int_chart = $ChartOfAccounts->chart_data('Interest Income - ' . $branch_name);
                    $form_interest = array('journal_entry_id' => $journal_entry_id, 'chart_id' => $int_chart['chart_id'], 'credit' => $interest);
                    $this->insert('tbl_journal_entry_details', $form_interest);


                    // FOR PENALTY
                    if ($this->inputs['penalty_amount'] > 0) {

                        $penalty_chart = $ChartOfAccounts->chart_data('Penalty Income - ' . $branch_name);
                        $form_penalty = array('journal_entry_id' => $journal_entry_id, 'chart_id' => $penalty_chart['chart_id'], 'credit' => $this->inputs['penalty_amount']);
                        $this->insert('tbl_journal_entry_details', $form_penalty);
                    }


                    // FOR LOANS RECEIVABLE
                    $lr_total = $cnb_total - ($this->inputs['penalty_amount'] + $interest);
                    $loan_type = $LoanTypes->name($row['loan_type_id']);
                    $lr_chart = $ChartOfAccounts->chart_data('Loans Receivable - ' . $loan_type . " - " . $branch_name);
                    $form_penalty = array('journal_entry_id' => $journal_entry_id, 'chart_id' => $lr_chart['chart_id'], 'credit' => $lr_total);
                    $this->insert('tbl_journal_entry_details', $form_penalty);

                    if ($this->loan_balance($this->inputs['loan_id']) <= 0) {
                        $form_finished = array(
                            'status' => 'F'
                        );
                        $this->update("tbl_loans", $form_finished, 'loan_id="' . $this->inputs['loan_id'] . '"');
                    }
                }
            }
        }
        return $sql;
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
                $this->name             => $this->clean($this->inputs[$this->name]),
                'branch_id'             => $this->clean($this->inputs['branch_id']),
                'client_id'             => $this->clean($this->inputs['client_id']),
                'loan_type_id'          => $this->clean($this->inputs['loan_type_id']),
                'loan_date'             => $this->clean($this->inputs['loan_date']),
                'loan_amount'           => $this->clean($this->inputs['loan_amount']),
                'loan_period'           => $this->clean($this->inputs['loan_period']),
                'loan_interest'         => $this->clean($this->inputs['loan_interest']),
                'penalty_percentage'    => $this->clean($this->inputs['penalty_percentage']),
                'service_fee'           => $this->clean($this->inputs['service_fee']),
                'monthly_payment'       => $this->clean($this->inputs['monthly_payment']),
                'payment_terms'         => $this->clean($this->inputs['payment_terms']),
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
            $row['loan_amount'] = "₱" . number_format($row['loan_amount'], 2);
            $rows[] = $row;
        }
        return $rows;
    }

    public function view($primary_id = null)
    {
        $primary_id = $primary_id == null ? $this->inputs['id'] : $primary_id;
        $LoanTypes = new LoanTypes;
        $Clients = new Clients;
        $Branches = new Branches;
        $result = $this->select($this->table, "*", "$this->pk = '$primary_id'");
        $row = $result->fetch_assoc();
        $row['loan_type'] = $LoanTypes->name($row['loan_type_id']);
        $row['amount'] = number_format($row['loan_amount'], 2);
        $row['monthly_payment'] = $row['monthly_payment']; //number_format($row['monthly_payment'], 2);
        $row['client'] = $Clients->name($row['client_id']);
        $row['branch_name'] = $Branches->name($row['branch_id']);
        $row['loan_type'] = $LoanTypes->name($row['branch_id']);
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
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['reference_number'];
        } else {
            return null;
        }
    }

    public function loan_client($primary_id)
    {
        $result = $this->select($this->table, 'client_id', "$this->pk = '$primary_id'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['client_id'];
        } else {
            return null;
        }
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
        $loan_interest = isset($this->inputs['loan_interest']) ? $this->inputs['loan_interest'] : null;
        $loan_period = isset($this->inputs['loan_period']) ? $this->inputs['loan_period'] : null;
        $loan_amount = isset($this->inputs['loan_amount']) ? $this->inputs['loan_amount'] : null;
        $loan_date = isset($this->inputs['loan_date']) ? $this->inputs['loan_date'] : null;
        $monthlypayment = isset($this->inputs['monthly_payment']) ? $this->inputs['monthly_payment'] : null;
        $payment_terms = isset($this->inputs['payment_terms']) ? $this->inputs['payment_terms'] : null;
        $loan_fixed_interest = isset($this->inputs['loan_fixed_interest']) ? $this->inputs['loan_fixed_interest'] : null;

        $count = 1;
        $rows = array();
        $balance = $loan_amount;
        $payment_count = 1;
        while ($count <= $loan_period) {

            $loan_date = date('M d, Y', strtotime('+1 month', strtotime($loan_date)));

            if ($loan_fixed_interest == 1) {
                $total_amount_with_interest = ($loan_interest * $loan_period) + $loan_amount;
                $monthly_interest = $loan_interest;
            } else {
                $monthly_interest_rate = ($loan_interest / 100) / 12;
                $total_amount_with_interest = ($loan_amount * $monthly_interest_rate * $loan_period) + $loan_amount;
                $monthly_interest = $balance * $monthly_interest_rate;
            }

            $suggested_payment = $loan_period > 0 ? $total_amount_with_interest / $loan_period : "";

            if ($payment_count == $payment_terms) { // matches every 3 iterations
                $payment_count = 1;
                $monthly_payment = $monthlypayment > 0 ? $monthlypayment : ($suggested_payment * $payment_terms);
            } else {
                $payment_count += 1;
                $monthly_payment = 0;
            }

            $principal_amount = $monthly_payment - $monthly_interest;
            $balance -= $principal_amount;

            $row['date'] = $loan_date;
            $row['payment'] = number_format($monthly_payment, 2); //number_format($suggested_payment, 2);
            $row['interest'] = number_format($monthly_interest, 2);
            $row['applicable_principal'] =  number_format($principal_amount, 2);
            $row['balance'] = number_format($balance, 2); //$balance > 0 ? number_format($balance, 2) : "0.00";
            $rows[] = $row;

            $count++;
        }

        return $rows;
    }

    public function statement_of_accounts()
    {
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $result = $this->select($this->table, '*', "$param");

        $rows = array();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $loan_interest = $row['loan_interest'];
            $loan_period = $row['loan_period'];
            $loan_amount = $row['loan_amount'];
            $loan_date = $row['loan_date'];
            $payment_terms = $row['payment_terms'];
            $loan_type_id = $row['loan_type_id'];
            $LoanTypes = new LoanTypes;
            $lt_row = $LoanTypes->view($loan_type_id);


            $count = 1;

            $monthly_interest_rate = ($loan_interest / 100) / 12;
            $total_amount_with_interest = ($loan_amount * $monthly_interest_rate * $loan_period) + $loan_amount;

            $balance = $loan_amount;
            $Collection = new Collections;
            $payment_count = 1;
            while ($count <= $loan_period) {

                $loan_date = date('Y-m-d', strtotime('+1 month', strtotime($loan_date)));

                if ($payment_count == $payment_terms) { // matches every 3 iterations
                    $payment_count = 1;
                    $payment = $row['monthly_payment'];
                } else {
                    $payment_count += 1;
                    $payment = 0;
                }

                // $suggested_payment = $loan_period > 0 ? $total_amount_with_interest / $loan_period : "";

                if ($lt_row['fixed_interest'] == "Y") {
                    $monthly_interest = $loan_interest;
                } else {
                    $monthly_interest_rate = ($loan_interest / 100) / 12;
                    $monthly_interest = $balance * $monthly_interest_rate;
                }
                $principal_amount = $payment - $monthly_interest; //$balance / $loan_period;

                $penalty = $Collection->penalty_per_month($loan_date, $row['loan_id']);
                // $payment = $count == 1 ? $Collection->collected_per_month($loan_date,$row['loan_id'])+$Collection->advance_collection($row['loan_id']) : $Collection->collected_per_month($loan_date,$row['loan_id']);
                $balance -= $principal_amount; //($payment + $penalty);


                $row['date'] = date('F Y', strtotime($loan_date));
                $row['payment'] = number_format($payment, 2);
                $row['interest'] = number_format($monthly_interest, 2);
                $row['penalty'] = number_format($penalty, 2);
                $row['applicable_principal'] =  number_format($principal_amount, 2);
                $row['balance'] = $balance > 0 ? number_format($balance, 2) : "0.00";
                $rows[] = $row;

                $count++;
            }

            return $rows;
        } else {
            return $rows;
        }
    }

    public function soa_collection()
    {
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $result = $this->select($this->table, '*', "$param");

        $rows = array();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $loan_interest = $row['loan_interest'];
            $loan_period = $row['loan_period'];
            $loan_amount = $row['loan_amount'];
            $loan_date = $row['loan_date'];
            $payment_terms = $row['payment_terms'];
            $LoanTypes = new LoanTypes;
            $lt_row = $LoanTypes->view($row['loan_type_id']);

            $count = 1;

            $balance = $loan_amount;
            $Collection = new Collections;
            $payment_count = 1;
            while ($count <= $loan_period) {

                $loan_date = date('Y-m-d', strtotime('+1 month', strtotime($loan_date)));

                if ($payment_count == $payment_terms) { // matches every 3 iterations
                    $payment_count = 1;
                    $payment = $count == 1 ? $Collection->collected_per_month($loan_date, $row['loan_id']) + $Collection->advance_collection($row['loan_id']) : $Collection->collected_per_month($loan_date, $row['loan_id']);
                } else {
                    $payment_count += 1;
                    $payment = 0;
                }

                // $suggested_payment = $loan_period > 0 ? $total_amount_with_interest / $loan_period : "";

                if ($lt_row['fixed_interest'] == "Y") {
                    $monthly_interest = $loan_interest;
                } else {
                    $monthly_interest_rate = ($loan_interest / 100) / 12;
                    $monthly_interest = $balance * $monthly_interest_rate;
                }

                // $monthly_interest = $balance * $monthly_interest_rate;
                $principal_amount = $payment - $monthly_interest;
                $penalty = $Collection->penalty_per_month($loan_date, $row['loan_id']);
                $balance -= ($principal_amount + $penalty);


                $row['date'] = date('F Y', strtotime($loan_date));
                $row['payment'] = number_format($payment, 2);
                $row['interest'] = number_format($monthly_interest, 2);
                $row['penalty'] = number_format($penalty, 2);
                $row['applicable_principal'] =  $principal_amount > 0 ? number_format($principal_amount, 2) : "0.00";
                $row['balance'] = $balance > 0 ? number_format($balance, 2) : "0.00";
                $rows[] = $row;

                $count++;
            }

            return $rows;
        } else {
            return $rows;
        }
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
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['total'];
        } else {
            return null;
        }
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
        $loan_id = $this->inputs['loan_id']; //isset($this->inputs['loan_id']) ? $this->inputs['loan_id'] : null;
        $collection_date = $this->inputs['collection_date'];

        $result = $this->select($this->table, '*', "loan_id='$loan_id'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $loan_interest = $row['loan_interest'];
            $loan_period = $row['loan_period'];
            $loan_amount = $row['loan_amount'];
            $monthly_payment = $row['monthly_payment'];
            $loan_date = $row['loan_date'];
            $penalty_per = $row['penalty_percentage'];
            $payment_terms = $row['payment_terms'];
        } else {
            $loan_interest = "";
            $loan_period = "";
            $loan_amount = "";
            $loan_date = "";
            $penalty_per = 0;
            $payment_terms = "";
        }

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
        $payment_count = 1;
        $Collection = new Collections;
        while ($count <= $diff) {
            $loan_date = date('Y-m-d', strtotime('+1 month', strtotime($loan_date)));
            $counter_date = date('Y-m-d', strtotime('-'.$payment_count.' month', strtotime($loan_date)));
            
            if ($payment_terms > 1) {
                if ($payment_count == $payment_terms) { // matches every terms iterations
                    $payment_count = 1;
                    $payment = $Collection->collected_per_month($loan_date, $loan_id);
                    $suggested_total += $monthly_payment;
                    $payment_total += $payment;
                }else if($Collection->penalty_checker($counter_date, $loan_id) <= 0){
                    $payment_count = 2;
                    $payment = $Collection->collected_per_month($loan_date, $loan_id);
                    $suggested_total += $monthly_payment;
                    $payment_total += $payment;
                } else {
                    $payment_count += 1;
                    $payment = 0;
                    $suggested_total = 0;
                    $payment_total = 0;
                }
            } else {
                $payment_count = 1;
                $payment = $Collection->collected_per_month($loan_date, $loan_id);
                $suggested_total += $monthly_payment;
                $payment_total += $payment;
            }
            $count++;
        }

        $pending = $suggested_total - $payment_total;

        return $pending * ($penalty_per / 100);

        // return $suggested_total." ".$payment_total;
    }

    public function total_loan($loan_id)
    {

        $result = $this->select($this->table, 'loan_amount,loan_interest,loan_period', "loan_id='$loan_id'");
        $row = $result->fetch_assoc();

        $loan_interest = $row['loan_interest'];
        $loan_period = $row['loan_period'];
        $loan_amount = $row['loan_amount'];

        $monthly_interest_rate = ($loan_interest / 100) / 12;
        $total_amount_with_interest = ($loan_amount * $monthly_interest_rate * $loan_period) + $loan_amount;

        return $total_amount_with_interest;
    }


    public function additional_loan($month, $year, $loan_id)
    {
        $result = $this->select($this->table, 'sum(loan_amount) as total', "(MONTH(loan_date) = '$month' AND YEAR(loan_date)= '$year') AND main_loan_id='$loan_id' AND renewal_status='N'");
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function loan_balance($primary_id = null)
    {
        $primary_id = $primary_id == "" ? $this->inputs[$this->pk] : $primary_id;
        $Collections = new Collections;
        $bal = $this->total_loan($primary_id) - $Collections->total_collected($primary_id);

        return $bal;
    }


    public function idByName($reference_number)
    {
        $result = $this->select($this->table, 'loan_id', "reference_number = '$reference_number'");

        if ($result->num_rows < 1)
            return 0;

        $row = $result->fetch_assoc();
        return $row['loan_id'];
    }

    public function schema()
    {
        if (DEVELOPMENT) {
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
                    $this->metadata('loan_type_id', 'int', 11),
                    $this->metadata('loan_amount', 'decimal', '12,4'),
                    $this->metadata('loan_period', 'int', 4),
                    $this->metadata('penalty_percentage','decimal', '12,4'),
                    $this->metadata('due_date', 'date'),
                    $this->metadata('loan_date', 'date'),
                    $this->metadata('main_loan_id',  'int', 11),
                    $this->metadata('deduct_to_loan',  'int', 1),
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
        if ($fileType != 'csv' || $fileType != 'xls') {
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
                    'branch_id' => $row[0] ? $branches[$row[0]] : 1,
                    'branch_name' => $branch_name,
                    'reference_number' => $row[1],
                    'client_id' => $client_id,
                    'client_name' => $this->clean($row[2]),
                    'loan_type_id' => $loan_type_id,
                    'loan_type' => $this->clean($row[3]),
                    'loan_date' => date("Y-m-d", strtotime($row[4])),
                    'loan_amount' => (float) str_replace(',', '', $row[5]),
                    'loan_interest' => (float) str_replace(',', '', $row[6]),
                    'loan_period' => (float) str_replace(',', '', $row[7]),
                    'service_fee' => (float) str_replace(',', '', $row[8]),
                    'monthly_payment' => (float) str_replace(',', '', $row[9]),
                    'status' => "R",
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
