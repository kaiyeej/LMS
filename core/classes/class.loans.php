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
        $result = $this->select($this->table, "*", "$this->pk = '$primary_id'");
        return $result->fetch_assoc();
    }

    public function remove()
    {
        $ids = implode(",", $this->inputs['ids']);

        return $this->delete($this->table, "$this->pk IN($ids)");
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
}
