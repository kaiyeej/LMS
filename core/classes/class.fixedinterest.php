<?php

class FixedInterest extends Connection
{
    private $table = 'tbl_fixed_loan_interest';
    public $pk = 'loan_interest_id';
    public $name = 'loan_amount';

    public $inputs;

    public function add()
    {
        $form = array(
            $this->name             => $this->clean($this->inputs[$this->name]),
            'loan_type_id'          => $this->clean($this->inputs['loan_type_id']),
            'interest_amount'       => $this->clean($this->inputs['interest_amount']),
            'penalty_percentage'    => $this->clean($this->inputs['penalty_percentage']),
            'interest_terms'        => $this->clean($this->inputs['interest_terms']),
        );

        return $this->insertIfNotExist($this->table, $form, "$this->name = '" . $this->inputs[$this->name] . "'");
    }

    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
        $form = array(
            $this->name             => $this->clean($this->inputs[$this->name]),
            'loan_type_id'          => $this->clean($this->inputs['loan_type_id']),
            'interest_amount'       => $this->clean($this->inputs['interest_amount']),
            'penalty_percentage'    => $this->clean($this->inputs['penalty_percentage']),
            'interest_terms'        => $this->clean($this->inputs['interest_terms']),
        );

        return $this->updateIfNotExist($this->table, $form, "$this->pk = '$primary_id'");
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

    public function delete_entry()
    {
        $primary_id = $this->inputs['id'];
        return $this->delete("tbl_fixed_loan_interest", "loan_interest_id = '$primary_id'");
    }

    public function name($primary_id)
    {
        $result = $this->select($this->table, 'loan_amount', "$this->pk = '$primary_id'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['loan_amount'];
        } else {
            return "---";
        }
    }



}
