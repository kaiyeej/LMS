<?php

class ChartClassification extends Connection
{
    private $table = 'tbl_chart_classification';
    public $pk = 'chart_class_id';
    public $name = 'chart_class_name';


    public function add()
    {
        $form = array(
            $this->name     => $this->clean($this->inputs[$this->name]),
            'chart_class_code'  => $this->clean($this->inputs['chart_class_code']),
        );

        return $this->insertIfNotExist($this->table, $form, "$this->name = '".$this->inputs[$this->name]."'");
    }

    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
        $form = array(
            $this->name     => $this->clean($this->inputs[$this->name]),
            'chart_class_code'  => $this->clean($this->inputs['chart_class_code']),
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

    public function name($primary_id)
    {
        $result = $this->select($this->table, $this->name, "$this->pk = '$primary_id'");
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            return $row[$this->name];
        }else{
            return "--";
        }
        
    }

    public function chart_class_code($primary_id)
    {
        $result = $this->select($this->table, 'chart_class_code', "$this->pk = '$primary_id'");
        $row = $result->fetch_assoc();
        return $row['chart_class_code'];
    }
}
