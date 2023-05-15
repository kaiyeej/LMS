<?php

class Vouchers extends Connection
{
    private $table = 'tbl_vouchers';
    public $pk = 'voucher_id';
    public $name = 'reference_number';

    private $table_detail = 'tbl_journal_entry_details';
    public $pk2 = 'journal_entry_detail_id';
    public $fk_det = 'chart_id';

    public function add()
    {
        
        $Journals = new Journals;
        $code = $Journals->journal_code($this->inputs['journal_id']);
        $ref_code = $code."-". date('YmdHis');
        
        $form = array(
            $this->name         => $this->clean($this->inputs[$this->name]),
            'account_type'      => $this->inputs['account_type'],
            'account_id'        => $this->inputs['account_id'],
            'voucher_no'        => $this->inputs['voucher_no'],
            'description'       => $this->inputs['description'],
            'check_number'      => $this->inputs['check_number'],
            'ac_no'             => $this->inputs['ac_no'],
            'amount'            => $this->inputs['amount'],
            'voucher_date'      => $this->inputs['voucher_date'],
            'journal_id'        => $this->inputs['journal_id'],
            'user_id'           => $_SESSION['lms_user_id']
        );


        $form_journal = array(
            'reference_number'  => $ref_code,
            'cross_reference'   => $this->clean($this->inputs[$this->name]),
            'journal_id'        => $this->inputs['journal_id'],
            'remarks'           => $this->inputs['description'],
            'journal_date'      => $this->inputs['voucher_date'],
            'user_id'           => $_SESSION['lms_user_id'],
            'is_manual'         => 'N'
        );
        
        $this->insert("tbl_journal_entries", $form_journal);
        return $this->insertIfNotExist($this->table, $form, '', 'Y');

    }

    public function edit()
    {
        $form = array(
            $this->name         => $this->clean($this->inputs[$this->name]),
            'account_type'      => $this->inputs['account_type'],
            'account_id'        => $this->inputs['account_id'],
            'voucher_no'        => $this->inputs['voucher_no'],
            'description'       => $this->inputs['description'],
            'check_number'      => $this->inputs['check_number'],
            'ac_no'             => $this->inputs['ac_no'],
            'amount'            => $this->inputs['amount'],
            'voucher_date'      => $this->inputs['voucher_date'],
            'user_id'           => $_SESSION['lms_user_id']
        );
        return $this->updateIfNotExist($this->table, $form);
    }

    public function show()
    {
        $Users = new Users;
        $Journals = new Journals;
        $Suppliers = new Suppliers;
        $Clients = new Clients;
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
            // $details = $this->total_details($row['journal_entry_id']);
            $row['account'] = $row['account_type'] == "S"? $Suppliers->name($row['account_id']) : $Clients->name($row['account_id']);
            $row['encoded_by'] = $Users->fullname($row['user_id']);
            $row['amount'] = 0;
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
        $Suppliers = new Suppliers;
        $Clients = new Clients;
        $result = $this->select($this->table, "*", "$this->pk = '$primary_id'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $row['encoded_by'] = $Users->fullname($row['user_id']);
            $row['account'] = $row['account_type'] == "S"? $Suppliers->name($row['account_id']) : $Clients->name($row['account_id']);
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

    public function journal_id($id = null)
    {
        $primary_id = $id == null ? $this->inputs['id'] : $id;
        $cross_reference = $this->name($primary_id);
        $result = $this->select('tbl_journal_entries', 'journal_entry_id', "cross_reference = '$cross_reference'");
        $row = $result->fetch_assoc();
        return $row['journal_entry_id'];
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
            'journal_entry_id'      => $this->inputs['journal_entry_id'],
            $this->fk_det           => $this->inputs[$this->fk_det],
            'debit'                 => $debit,
            'credit'                => $credit,
            'description'           => $this->inputs['description'],
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
        return 'CV-' . date('YmdHis');
    }
}
