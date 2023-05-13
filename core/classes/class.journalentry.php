<?php

class JournalEntry extends Connection
{
    private $table = 'tbl_journal_entries';
    public $pk = 'journal_entry_id';
    public $name = 'reference_number';

    private $table_detail = 'tbl_journal_entry_details';
    public $pk2 = 'journal_entry_detail_id';
    public $fk_det = 'chart_id';

    public function add()
    {
        $form = array(
            $this->name         => $this->clean($this->inputs[$this->name]),
            'cross_reference'   => $this->inputs['cross_reference'],
            'journal_id'        => $this->inputs['journal_id'],
            'remarks'           => $this->inputs['remarks'],
            'journal_date'      => $this->inputs['journal_date'],
            'user_id'           => $_SESSION['lms_user_id'],
            'is_manual'         => 'Y'
        );
        return $this->insertIfNotExist($this->table, $form, '', 'Y');
    }

    public function edit()
    {
        $form = array(
            'cross_reference'   => $this->inputs['cross_reference'],
            'journal_id'        => $this->inputs['journal_id'],
            'remarks'           => $this->inputs['remarks'],
            'journal_date'      => $this->inputs['journal_date'],
            'user_id'           => $_SESSION['lms_user_id']
        );
        return $this->updateIfNotExist($this->table, $form);
    }

    public function show()
    {
        $Users = new Users;
        $Journals = new Journals;
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
            $details = $this->total_details($row['journal_entry_id']);
            $row['encoded_by'] = $Users->fullname($row['user_id']);
            $row['journal'] = $Journals->name($row['journal_id']);
            $row['amount'] = $details[2] == 0 ? number_format($details[0],2) : "<strong style='color:#F44336;'>".number_format($details[0],2)."</strong>";
            $rows[] = $row;
        }
        return $rows;
    }

    function total_details($primary_id){
        $result = $this->select($this->table_detail, "sum(debit) as total_debit, sum(credit) as total_credit", "$this->pk = '$primary_id'");
        $row = $result->fetch_assoc();

        $status = $row['total_debit'] == $row['total_credit'] ? 0 : 1;
        
        return [$row['total_debit'],$row['total_credit'], $status];
    }

    public function view()
    {
        $primary_id = $this->inputs['id'];
        $Users = new Users;
        $result = $this->select($this->table, "*", "$this->pk = '$primary_id'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $row['encoded_by'] = $Users->fullname($row['user_id']);
            return $row;
        } else {
            return null;
        }
    }

    public function remove()
    {
        $ids = implode(",", $this->inputs['ids']);
        return $this->delete($this->table, "$this->pk IN($ids)");
    }

    public function finish()
    {
        $primary_id = $this->inputs['id'];
        $form = array(
            'status' => 'F',
        );
        return $this->update($this->table, $form, "$this->pk = '$primary_id'");
    }

    public function pk_by_name($name = null)
    {
        $name = $name == null ? $this->inputs[$this->name] : $name;
        $result = $this->select($this->table, $this->pk, "$this->name = '$name' AND (status='F' OR status='P')");
        $row = $result->fetch_assoc();
        return $row[$this->pk] * 1;
    }

    public function pk_name($name, $customer_id)
    {
        $result = $this->select($this->table, $this->pk, "$this->name = '$name' AND (status='F' OR status='P') AND customer_id='$customer_id'");
        $row = $result->fetch_assoc();
        return $row[$this->pk] * 1;
    }

    public function name($primary_id)
    {
        $result = $this->select($this->table, $this->name, "$this->pk = '$primary_id'");
        $row = $result->fetch_assoc();
        return $row[$this->name];
    }

    public function dataRow($primary_id, $field)
    {
        $result = $this->select($this->table, $field, "$this->pk = '$primary_id'");
        if($result->num_rows > 0){
            $row = $result->fetch_array();
            return $row[$field];
        }else{
            return "";
        }
    }

    public function detailsRow($primary_id, $field)
    {
        $result = $this->select($this->table_detail, $field, "$this->pk2 = '$primary_id'");
        if($result->num_rows > 0){
            $row = $result->fetch_array();
            return $row[$field];
        }else{
            return "";
        }
    }

    public function add_detail()
    {
        if($this->inputs['type'] == "D"){
            $debit = $this->inputs['amount'];
            $credit = 0;
        }else{
            $credit = $this->inputs['amount'];
            $debit = 0;
        }
        
        $form = array(
            $this->pk       => $this->inputs[$this->pk],
            $this->fk_det   => $this->inputs[$this->fk_det],
            'debit'         => $debit,
            'credit'        => $credit,
            'description'   => $this->inputs['description'],
        );
        return $this->insert($this->table_detail, $form);
    }

    public function show_detail()
    {
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $count = 1;
        $ChartOfAccounts = new ChartOfAccounts;
        $result = $this->select($this->table_detail, '*', $param);
        while ($row = $result->fetch_assoc()) {
            $row['chart'] = $ChartOfAccounts->name($row['chart_id']);
            $row['count'] = $count++;
            $rows[] = $row;
        }
        return $rows;
    }

    public function remove_detail()
    {
        $ids = implode(",", $this->inputs['ids']);
        return $this->delete($this->table_detail, "$this->pk2 IN($ids)");
    }

    public function generate()
    {
        return 'JE-' . date('YmdHis');
    }
}
