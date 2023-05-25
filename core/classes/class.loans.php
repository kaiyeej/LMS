<?php

class Loans extends Connection
{
    private $table = 'tbl_loans';
    public $pk = 'loan_id';
    public $name = 'reference_number';


    public function add()
    {
        $form = array(
            $this->name         => $this->clean($this->inputs[$this->name]),
            'client_id'         => $this->clean($this->inputs['client_id']),
            'loan_type_id'      => $this->clean($this->inputs['loan_type_id']),
            'loan_date'         => $this->clean($this->inputs['loan_date']),
            'loan_amount'       => $this->clean($this->inputs['loan_amount']),
            'loan_period'       => $this->clean($this->inputs['loan_period']),
            'loan_interest'     => $this->clean($this->inputs['loan_interest']),
        );

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
                $this->name     => $this->clean($this->inputs[$this->name]),
                'client_id'         => $this->clean($this->inputs['client_id']),
                'loan_type_id'      => $this->clean($this->inputs['loan_type_id']),
                'loan_date'         => $this->clean($this->inputs['loan_date']),
                'loan_amount'       => $this->clean($this->inputs['loan_amount']),
                'loan_period'       => $this->clean($this->inputs['loan_period']),
                'loan_interest'     => $this->clean($this->inputs['loan_interest']),
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
            $row['loan_account'] = $Clients->name($row['client_id'])." - ".$row['reference_number'];
            $row['loan_type'] = $LoanTypes->name($row['loan_type_id']);
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

            $monthly_interest_rate = ($loan_interest/100)/12;
            $total_amount_with_interest = ($loan_amount*$monthly_interest_rate*$loan_period) + $loan_amount;
            $suggested_payment = $loan_period > 0 ? $total_amount_with_interest/$loan_period : "";
            $monthly_interest = $loan_amount*$monthly_interest_rate;
            $principal_amount = $loan_amount/$loan_period;

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

            $monthly_interest_rate = ($loan_interest/100)/12;
            $total_amount_with_interest = ($loan_amount*$monthly_interest_rate*$loan_period) + $loan_amount;
            $suggested_payment = $loan_period > 0 ? $total_amount_with_interest/$loan_period : "";
            $monthly_interest = $loan_amount*$monthly_interest_rate;
            $principal_amount = $loan_amount/$loan_period;

        

            $row['date'] = $loan_date;
            $row['payment'] = number_format($Collection->collected_per_month($loan_date), 2);
            $row['interest'] = number_format($monthly_interest, 2);
            $row['penalty'] = number_format(0,2);
            $row['applicable_principal'] =  number_format($principal_amount, 2);
            $rows[] = $row;
            
            $count++;
        }

        return $rows;
    }

    public function accounts_receivable(){
        $report_year = $this->inputs['report_year'];
        $rows = array();
        $Clients = new Clients;
        $Collections = new Collections;
        $result = $this->select($this->table, '*',"YEAR(loan_date) = '$report_year' AND status != 'D'");
        while ($row = $result->fetch_assoc()) {
            $payment = $Collections->total_collected($row['loan_id']);
            $amount_receivable = $row['loan_amount']-$payment;
            $penalty = 0;
            $subtotal = $amount_receivable+$penalty;
            $row['client'] = $Clients->name($row['client_id']);
            $row['amount'] = number_format($row['loan_amount'],2);
            $row['total_payment'] = number_format($payment,2);
            $row['amount_receivable'] = number_format($amount_receivable,2);
            $row['total_penalties'] = number_format($penalty,2);
            $row['subtotal'] = number_format($subtotal,2);
            $rows[] = $row;
        }
        return $rows;
    }

    public function released_total(){
        $year = date('Y');
        $result = $this->select($this->table, "sum(loan_amount) as total", "YEAR(loan_date) = '$year' AND (status = 'R' OR status='F')");
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    
    public function outstanding_total(){
        $total = 0;
        $result = $this->select($this->table, "loan_id,loan_amount,client_id", "status = 'R'");
        while($row = $result->fetch_assoc()){
            $collection = $this->select('tbl_collections', "sum(amount) as total", "status = 'F' AND loan_id='$row[loan_id]' AND client_id='$row[client_id]'");
            $total_collected = $collection->fetch_assoc();

            $total += $row['loan_amount']-$total_collected['total'];
        }

        return $total;
    }

    public function approved_loans(){
        $year = date('Y');
        $result = $this->select($this->table, "count(loan_id) as total", "YEAR(loan_date) = '$year' AND (status = 'R' OR status = 'A' OR status='F')");
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function pending_loans(){
        $year = date('Y');
        $result = $this->select($this->table, "count(loan_id) as total", "YEAR(loan_date) = '$year' AND status = 'A'");
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function dashboard()
    {
        $rows = array();
        $row['outstanding_total'] = number_format($this->outstanding_total(),2);
        $row['released_total'] = number_format($this->released_total(),2);
        $row['approved_total'] = $this->approved_loans();
        $row['pending_total'] = $this->pending_loans();
        $rows = $row;
        return $rows;
    }

    
}
