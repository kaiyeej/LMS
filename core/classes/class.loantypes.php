<?php

class LoanTypes extends Connection
{
    private $table = 'tbl_loan_types';
    public $pk = 'loan_type_id';
    public $name = 'loan_type';


    public function add()
    {
        $form = array(
            $this->name     => $this->clean($this->inputs[$this->name]),
            'loan_type_interest' => $this->clean($this->inputs['loan_type_interest']),
            'penalty_percentage' => $this->clean($this->inputs['penalty_percentage']),
            'remarks'       => $this->clean($this->inputs['remarks']),
        );

        return $this->insertIfNotExist($this->table, $form, "$this->name = '".$this->inputs[$this->name]."'");
    }

    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
        $name = $this->clean($this->inputs['loan_type']);
        $is_exist = $this->select($this->table, $this->pk, "$this->name = '".$this->inputs[$this->name]."' AND $this->pk != '$primary_id'");
        if ($is_exist->num_rows > 0) {
            return 2;
        } else {
            $form = array(
                $this->name     => $this->clean($this->inputs[$this->name]),
                'loan_type_interest' => $this->clean($this->inputs['loan_type_interest']),
                'penalty_percentage' => $this->clean($this->inputs['penalty_percentage']),
                'remarks'       => $this->clean($this->inputs['remarks']),
            );

            return $this->updateIfNotExist($this->table, $form, "$this->pk = '$primary_id'");
        }
    }

    public function show()
    {
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
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
        $result = $this->select($this->table, 'loan_type', "$this->pk = '$primary_id'");
        $row = $result->fetch_assoc();
        return $row['loan_type'];
    }

    
    public function penalty_percentage($primary_id)
    {
        $result = $this->select($this->table, 'penalty_percentage', "$this->pk = '$primary_id'");
        $row = $result->fetch_assoc();
        return $row['penalty_percentage'];
    }

    public function total_per_month($primary_id,$month,$year){

        $result = $this->select("tbl_loans", "sum(loan_amount) as total", "MONTH(loan_date) = '$month' AND YEAR(loan_date) = '$year' AND (status = 'R' OR status='F') AND $this->pk = '$primary_id'");
        $row = $result->fetch_assoc();
        return $row['total'];
    }
}
