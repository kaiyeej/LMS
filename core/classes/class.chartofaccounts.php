<?php

class ChartOfAccounts extends Connection
{
    private $table = 'tbl_chart_of_accounts';
    public $pk = 'chart_id';
    public $name = 'chart_name';


    public function add()
    {
        
        $main_chart_id = (!isset($this->inputs['main_chart_id']) && $this->inputs['chart_type'] == "M" ? "" : $this->clean($this->inputs['main_chart_id']));
        $chart_type = $this->clean($this->inputs['chart_type']);
        if($chart_type == "S"){
            $chart_class_id = $this->main_chart_class($main_chart_id);
        }else{
            $chart_class_id = $this->clean($this->inputs['chart_class_id']);
        }
        $form = array(
            $this->name         => $this->clean($this->inputs[$this->name]),
            'chart_code'        => $this->clean($this->inputs['chart_code']),
            'chart_type'        => $chart_type,
            'main_chart_id'     => $main_chart_id,
            'chart_class_id'    => $chart_class_id,
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
        $ChartClassification = new ChartClassification;
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
            $row['type'] = $row['chart_type'] == "M" ? "Main" : "Sub";
            $row['main_chart'] = $this->name($row['main_chart_id']);
            $row['main_chart_id'] = $row['chart_id'];
            $row['chart_class'] = $ChartClassification->name($row['chart_class_id']);
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

    public function trial_balance()
    {
        $start_date = $this->inputs['start_date'];
        $end_date = $this->inputs['end_date'];
        $JournalEntry = new JournalEntry;
        $rows = array();
        $result = $this->select($this->table, '*');
        while ($row = $result->fetch_assoc()) {
            $JL = $JournalEntry->total_per_chart($start_date,$end_date,$row['chart_id']);
            $sub = $row['chart_type'] == "S" ? "&emsp;&emsp;&emsp; " : "";
            $row['chart_name'] = $sub.$row['chart_name'];
            $row['debit'] = $JL['total_debit'] > 0 ? number_format($JL['total_debit'],2) : "--";
            $row['credit'] = $JL['total_credit'] > 0 ? number_format($JL['total_credit'],2) : "--";
            $rows[] = $row;
        }
        return $rows;
    }

    public function main_chart_class($primary_id){
        $result = $this->select($this->table, "chart_class_id", "$this->pk = '$primary_id'");
        $row = $result->fetch_assoc();
        return $row['chart_class_id'];
    }
}
