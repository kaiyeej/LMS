<?php

class Suppliers extends Connection
{
    private $table = 'tbl_suppliers';
    public $pk = 'supplier_id';
    public $name = 'supplier_name';


    public function add()
    {
        $form = array(
            $this->name             => $this->clean($this->inputs[$this->name]),
            'supplier_address'      => $this->clean($this->inputs['supplier_address']),
            'supplier_contact_no'   => $this->clean($this->inputs['supplier_contact_no']),
            'remarks'               => $this->clean($this->inputs['remarks']),
        );

        return $this->insertIfNotExist($this->table, $form, "$this->name = '".$this->inputs[$this->name]."'");
    }

    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
        $form = array(
            $this->name             => $this->clean($this->inputs[$this->name]),
            'supplier_address'      => $this->clean($this->inputs['supplier_address']),
            'supplier_contact_no'   => $this->clean($this->inputs['supplier_contact_no']),
            'remarks'               => $this->clean($this->inputs['remarks']),
        );

        return $this->updateIfNotExist($this->table, $form, "$this->pk = '$primary_id'");
    }

    public function show()
    {
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
            $row['account_id'] = $row['supplier_id'];
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
        $result = $this->select($this->table, 'supplier_name', "$this->pk = '$primary_id'");
        $row = $result->fetch_assoc();
        return $row['supplier_name'];
    }
}
