<?php

class ChartOfAccounts extends Connection
{
    private $table = 'tbl_chart_of_accounts';
    public $pk = 'chart_id';
    public $name = 'chart_name';


    public function add()
    {
        $form = array(
            $this->name         => $this->clean($this->inputs[$this->name]),
            'chart_code'        => $this->clean($this->inputs['chart_code']),
            'chart_type'        => $this->clean($this->inputs['chart_type']),
            'main_chart_id'     => $this->clean($this->inputs['main_chart_id']),
        );

        return $this->insertIfNotExist($this->table, $form, "$this->name = '".$this->inputs[$this->name]."'");
    }

    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
        $main_chart_id = (!isset($this->inputs['main_chart_id']) && $this->inputs['chart_type'] == "M" ? "" : $this->clean($this->inputs['main_chart_id']));
        $form = array(
            $this->name     => $this->clean($this->inputs[$this->name]),
            'chart_code'        => $this->clean($this->inputs['chart_code']),
            'chart_type'        => $this->clean($this->inputs['chart_type']),
            'main_chart_id'     => $main_chart_id,
        );

        return $this->updateIfNotExist($this->table, $form, "$this->pk = '$primary_id'");
    }

    public function show()
    {
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $Journals = new Journals();
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
            $row['type'] = $row['chart_type'] == "M" ? "Main" : "Sub";
            $row['main_chart_id'] = $row['chart_id'];
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
        $result = $this->select($this->table, 'chart_name', "$this->pk = '$primary_id'");
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            return $row['chart_name'];
        }else{
            return '---';
        }
        
    }
}
