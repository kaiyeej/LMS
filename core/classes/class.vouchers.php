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
        $loan_id = (!isset($this->inputs['loan_id']) ? "" : $this->inputs['loan_id']);
        
        $form = array(
            $this->name         => $this->clean($this->inputs[$this->name]),
            'branch_id'         => $this->inputs['branch_id'],
            'account_type'      => $this->inputs['account_type'],
            'account_id'        => $this->inputs['account_id'],
            'loan_id'           => $loan_id,
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
            'branch_id'         => $this->inputs['branch_id'],
            'journal_id'        => $this->inputs['journal_id'],
            'remarks'           => $this->inputs['description'],
            'journal_date'      => $this->inputs['voucher_date'],
            'user_id'           => $_SESSION['lms_user_id'],
            'status'            => 'S',
            'is_manual'         => 'N'
        );
        
        $this->insert("tbl_journal_entries", $form_journal);
        return $this->insertIfNotExist($this->table, $form, '', 'Y');

    }

    public function edit()
    {
        
        $loan_id = (!isset($this->inputs['loan_id']) ? "" : $this->inputs['loan_id']);

        $form = array(
            $this->name         => $this->clean($this->inputs[$this->name]),
            'branch_id'         => $this->inputs['branch_id'],
            'account_type'      => $this->inputs['account_type'],
            'account_id'        => $this->inputs['account_id'],
            'loan_id'           => $loan_id,
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
    

    public function update_approved_by()
    {
        
        $primary_id = $this->inputs['id'];
        $form = array(
            'approved_by' => $this->inputs['approved_by'],
        );
        return $this->update($this->table, $form, "$this->pk = '$primary_id'");
    }

    public function cancel(){
        $journal_entry_id = $this->inputs['journal_entry_id'];
        $voucher_id = $this->inputs['voucher_id'];
        $row = $this->view($voucher_id);
        $Journals = new Journals;
        $code = $Journals->journal_code($row['journal_id']);
        $ref_code = $code."-". date('YmdHis');
        $form_journal = array(
            'reference_number'  => $ref_code,
            'cross_reference'   => "C".$row['reference_number'],
            'branch_id'         => $row['branch_id'],
            'journal_id'        => $row['journal_id'],
            'remarks'           => "Reverse Entry for Cancelled Voucher (".$row['reference_number'].").",
            'journal_date'      => $row['voucher_date'],
            'status'            => 'F',
            'user_id'           => $_SESSION['lms_user_id'],
            'is_manual'         => 'N'
        );
        
        $j_id = $this->insert('tbl_journal_entries', $form_journal, 'Y');

        $jlFetch = $this->select("tbl_journal_entry_details", '*', "journal_entry_id='$journal_entry_id'");
        while ($jlRow = $jlFetch->fetch_assoc()) {
            $form_details = array(
                'journal_entry_id'      => $j_id,
                'chart_id'              => $jlRow['chart_id'],
                'debit'                 => $jlRow['credit'],
                'credit'                => $jlRow['debit'],
                'description'           => $jlRow['description']." (Reverse Entry)",
            );
            
            $this->insert("tbl_journal_entry_details", $form_details);
        }

        $form = array(
            'status' => 'C'
        );
        return $this->update($this->table, $form,'voucher_id="'.$voucher_id.'"');
    }

    public function show()
    {
        $Users = new Users;
        $Journals = new Journals;
        $Suppliers = new Suppliers;
        $Clients = new Clients;
        $Loans = new Loans;
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
            // $details = $this->total_details($row['journal_entry_id']);
            $row['account'] = $row['account_type'] == "S"? $Suppliers->name($row['account_id']) : $Clients->name($row['account_id'])." <strong style='color:#4caf50;'>(".$Loans->name($row['loan_id']).")</strong>";
            $row['encoded_by'] = $Users->fullname($row['user_id']);
            $row['amount'] = number_format($row['amount'],2);
            $rows[] = $row;
        }
        return $rows;
    }

    function total_details($primary_id){
        $result = $this->select($this->table_detail, "sum(debit) as total_debit, sum(credit) as total_credit", "journal_entry_id = '$primary_id'");
        $row = $result->fetch_assoc();

        $status = $row['total_debit'] == $row['total_credit'] ? 0 : 1;
        
        return [$row['total_debit']*1,$row['total_credit']*1, $status];
    }

    public function view($primary_id = null)
    {
        $primary_id = $primary_id == null ? $this->inputs['id'] : $primary_id;
        $Users = new Users;
        $Suppliers = new Suppliers;
        $Clients = new Clients;
        $Loans = new Loans;
        $result = $this->select($this->table, "*", "$this->pk = '$primary_id'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $row['encoded_by'] = $Users->fullname($row['user_id']);
            $row['account'] = $row['account_type'] == "S"? $Suppliers->name($row['account_id']) : $Clients->name($row['account_id'])." (".$Loans->name($row['loan_id']).")";
            $row['voucher_amount'] = number_format($row['amount'],2);
            $row['cv_date'] = date('F d, Y', strtotime($row["voucher_date"]));
            $row['amount_word'] = $this->convertNumberToWord($row['amount']);
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
        $jl_id = $this->journal_id($primary_id);
        $total = $this->total_details($jl_id);
        $row = $this->view($primary_id);
        $amount = $row['amount'];
        $loan_id = $row['loan_id'];
        if($total[0] == $total[1]){
            if($amount != $total[0]){
                return -2; //not equal amount
            }else{
                $form = array(
                    'status' => 'F',
                );
                $this->update($this->table, $form, "$this->pk = '$primary_id'");

                $form_loan = array(
                    'status' => 'R',
                );
                return $this->update('tbl_loans', $form_loan, "loan_id = '$loan_id'");
            }
            
        }else{
            return -1; //not equal
        }
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
            $row['debit'] = number_format($row['debit'],2);
            $row['credit'] = number_format($row['credit'],2);
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

    public function schema()
    {
        if (DEVELOPMENT) {
            $default['date_added'] = $this->metadata('date_added', 'datetime', '', 'NOT NULL', 'CURRENT_TIMESTAMP');
            $default['date_last_modified'] = $this->metadata('date_last_modified', 'datetime', '', 'NOT NULL', 'CURRENT_TIMESTAMP', 'ON UPDATE CURRENT_TIMESTAMP');
            $default['user_id'] = $this->metadata('user_id', 'int', 11);


            // TABLE HEADER
            $tables[] = array(
                'name'      => $this->table,
                'primary'   => $this->pk,
                'fields' => array(
                    $this->metadata($this->pk, 'int', 11, 'NOT NULL', '', 'AUTO_INCREMENT'),
                    $this->metadata($this->name, 'varchar', 75),
                    $this->metadata('branch_id', 'int', 11),
                    $this->metadata('account_type', 'int', 11),
                    $this->metadata('account_id', 'int', 11),
                    $this->metadata('voucher_no', 'varchar', 50),
                    $this->metadata('description', 'text'),
                    $this->metadata('loan_id', 'int', 11),
                    $this->metadata('check_number', 'varchar', 30),
                    $this->metadata('ac_no', 'varchar', 30),
                    $this->metadata('amount', 'decimal', '12,4'),
                    $this->metadata('voucher_date', 'date'),
                    $this->metadata('journal_id', 'int', 11),
                    $this->metadata('approved_by', 'int', 11),
                    $this->metadata('status', 'varchar', 1, 'NOT NULL', "'S'", '', "S - Pendng; F - Posted"),
                    $default['user_id'],
                    $default['date_added'],
                    $default['date_last_modified']
                )
            );

            return $this->schemaCreator($tables);
        }
    }
}
