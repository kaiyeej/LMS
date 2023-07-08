<?php

class FixedInterest extends Connection
{
    private $table = 'tbl_fixed_loan_interest';
    public $pk = 'tbl_fixed_loan_interest';
    public $name = 'loan_amount';

    public $inputs;

    public function add_fixed()
    {
       
        $loan_amount = $this->clean($this->inputs['loan_amount']);
        $loan_type_id = $this->clean($this->inputs['loan_type_id']);
        $is_exist = $this->select("tbl_fixed_loan_interest", 'loan_interest_id', "loan_amount = '$loan_amount' AND loan_type_id='$loan_type_id'");
        if ($is_exist->num_rows > 0) {
            return 2;
        } else {
            $form = array(
                'loan_type_id'      => $this->clean($this->inputs['loan_type_id']),
                'loan_amount'       => $this->clean($this->inputs['loan_amount']),
                'interest_amount'   => $this->clean($this->inputs['interest_amount']),
                'interest_terms'    => $this->clean($this->inputs['interest_terms']),
            );

            return $this->insert("tbl_fixed_loan_interest", $form);
        }
    }

    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
        $name = $this->clean($this->inputs['loan_type']);
        $is_exist = $this->select($this->table, $this->pk, "$this->name = '" . $this->inputs[$this->name] . "' AND $this->pk != '$primary_id'");
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

    public function show_fixed()
    {
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $result = $this->select("tbl_fixed_loan_interest", '*', $param);
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

    public function delete_fixed()
    {
        $primary_id = $this->inputs['id'];
        return $this->delete("tbl_fixed_loan_interest", "loan_interest_id = '$primary_id'");
    }

    public function name($primary_id)
    {
        $result = $this->select($this->table, 'loan_type', "$this->pk = '$primary_id'");
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            return $row['loan_type'];
        }else{
            return "---";
        }
       
    }


    public function penalty_percentage($primary_id)
    {
        $result = $this->select($this->table, 'penalty_percentage', "$this->pk = '$primary_id'");
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            return $row['penalty_percentage'];
        }else{
            return null;
        }
        
    }

    public function idByName($loan_type)
    {
        $result = $this->select($this->table, 'loan_type_id', "UCASE(loan_type) = UCASE('$loan_type')");

        if ($result->num_rows < 1)
            return 0;

        $row = $result->fetch_assoc();
        return $row['loan_type_id'];
    }


    public function total_per_month($primary_id, $month, $year, $branch_id = null)
    {

        $query = $branch_id == "" ? "" : "AND branch_id='$branch_id'";

        $result = $this->select("tbl_loans", "sum(loan_amount) as total", "MONTH(loan_date) = '$month' AND YEAR(loan_date) = '$year' AND (status = 'R' OR status='F') AND $this->pk = '$primary_id' $query");
        $row = $result->fetch_assoc();
        return $row['total'];
    }
}
