<?php

class Collections extends Connection
{
    private $table = 'tbl_collections';
    public $pk = 'collection_id';
    public $name = 'reference_number';
    public $fk = 'loan_id';


    public function add()
    {
        $form = array(
            $this->name         => $this->clean($this->inputs[$this->name]),
            $this->fk           => $this->clean($this->inputs[$this->fk]),
            'client_id'         => $this->clean($this->inputs['client_id']),
            'amount'            => $this->clean($this->inputs['amount']),
            'collection_date'   => $this->clean($this->inputs['collection_date']),
            'penalty_amount'    => $this->clean($this->inputs['penalty_amount']),
            'remarks'           => $this->clean($this->inputs['remarks']),
            'user_id'           => $this->clean($_SESSION['lms_user_id']),
        );

        return $this->insertIfNotExist($this->table, $form, "$this->name = '".$this->inputs[$this->name]."'");
    }

    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
        $is_exist = $this->select($this->table, $this->pk, "$this->name = '".$this->inputs[$this->name]."' AND $this->pk != '$primary_id'");
        if ($is_exist->num_rows > 0) {
            return 2;
        } else {
            $form = array(
                'amount'            => $this->clean($this->inputs['amount']),
                'collection_date'   => $this->clean($this->inputs['collection_date']),
                'remarks'           => $this->clean($this->inputs['remarks']),
                'user_id'           => $this->clean($_SESSION['lms_user_id']),
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

    
    public function data_row($primary_id, $field)
    {
        $result = $this->select($this->table, $field, "$this->pk = '$primary_id'");
        if($result->num_rows > 0){
            $row = $result->fetch_array();
            return $row[$field];
        }else{
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

    public function collected_per_month($date,$loan_id){
        $result = $this->select("tbl_collections as c, tbl_loans as l", 'sum(c.amount) as total', "l.loan_id='$loan_id' AND c.loan_id='$loan_id' AND (MONTH(c.collection_date) = MONTH('$date') AND YEAR(c.collection_date)= YEAR('$date'))");
        $row = $result->fetch_assoc();
        return $row['total'];
    }
    
    
    public function penalty_per_month($date,$loan_id){
        $result = $this->select("tbl_collections as c, tbl_loans as l", 'sum(c.penalty_amount) as total', "l.loan_id='$loan_id' AND c.loan_id='$loan_id' AND (MONTH(c.collection_date) = MONTH('$date') AND YEAR(c.collection_date)= YEAR('$date'))");
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function total_collected($loan_id){
        $result = $this->select("tbl_collections as c, tbl_loans as l", 'sum(c.amount) as total', "l.loan_id='$loan_id' AND c.loan_id='$loan_id'");
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function monthly_collection($month,$year){
        $result = $this->select("tbl_collections", 'sum(amount) as total', "(MONTH(collection_date) = '$month' AND YEAR(collection_date)= '$year') AND status='F'");
        $row = $result->fetch_assoc();
        return $row['total'];
    }

}
