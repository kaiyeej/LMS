<?php

class Expenses extends Connection
{
    private $table = 'tbl_expenses';
    public $pk = 'expense_id';
    public $name = 'reference_number';

    private $table_detail = 'tbl_expense_details';
    public $pk2 = 'expense_detail_id';
    public $fk_det = 'chart_id';

    public function add()
    {
        $form = array(
            $this->name         => $this->clean($this->inputs[$this->name]),
            'expense_date'      => $this->inputs['expense_date'],
            'remarks'           => $this->inputs['remarks'],
            'credit_method'     => $this->inputs['credit_method'],
            'journal_id'        => $this->inputs['journal_id'],
            'user_id'           => $_SESSION['lms_user_id']
        );
        return $this->insertIfNotExist($this->table, $form, '', 'Y');
    }

    public function edit()
    {
        $form = array(
            $this->name         => $this->clean($this->inputs[$this->name]),
            'expense_date'      => $this->inputs['expense_date'],
            'remarks'           => $this->inputs['remarks'],
            'credit_method'     => $this->inputs['credit_method'],
            'journal_id'        => $this->inputs['journal_id'],
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
            $row['encoded_by'] = $Users->fullname($row['user_id']);
            $row['journal'] = $Journals->name($row['journal_id']);
            $row['amount'] = number_format($this->total($row['expense_id']), 2);
            $rows[] = $row;
        }
        return $rows;
    }

    function total($primary_id)
    {
        $result = $this->select($this->table_detail, "sum(expense_amount) as total", "$this->pk = '$primary_id'");
        $row = $result->fetch_assoc();

        return  $row['total'];
    }

    public function view()
    {
        $primary_id = $this->inputs['id'];
        $Users = new Users;
        $Journals = new Journals;
        $ChartOfAccounts = new ChartOfAccounts;
        $result = $this->select($this->table, "*", "$this->pk = '$primary_id'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $row['encoded_by'] = $Users->fullname($row['user_id']);
            $row['journal_name'] = $Journals->name($row['journal_id']);
            $row['credit_method_name'] = $ChartOfAccounts->name($row['credit_method']);
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
        $result = $this->select($this->table, "*", "$this->pk = '$primary_id'");
        $row = $result->fetch_assoc();

        if ($row['status'] != "F") {
            $form = array(
                'status' => 'F',
            );
            $sql = $this->update($this->table, $form, "$this->pk = '$primary_id'");

            if ($sql) {

                $Journals = new Journals;
                $code = $Journals->journal_code($row['journal_id']);
                $ref_code = $code . "-" . date('YmdHis');

                $form_journal = array(
                    'reference_number'  => $ref_code,
                    'cross_reference'   => $row['reference_number'],
                    'journal_id'        => $row['journal_id'],
                    'remarks'           => $row['remarks'],
                    'journal_date'      => $row['expense_date'],
                    'user_id'           => $_SESSION['lms_user_id'],
                    'is_manual'         => 'N',
                    'status'            => 'F'
                );

                $journal_entry_id = $this->insert("tbl_journal_entries", $form_journal, 'Y');

                $details = $this->select($this->table_detail, "*", "$this->pk = '$primary_id'");
                $total = 0;
                while ($dRow = $details->fetch_array()) {
                    $total += $dRow['expense_amount'];
                    $form_details = array(
                        'journal_entry_id'      => $journal_entry_id,
                        $this->fk_det           => $dRow['chart_id'],
                        'debit'                 => $dRow['expense_amount'],
                        'credit'                => 0,
                        'description'           => $dRow['expense_desc'],
                    );
                    $this->insert("tbl_journal_entry_details", $form_details);
                }

                $form_credit = array(
                    'journal_entry_id'      => $journal_entry_id,
                    $this->fk_det           => $row['credit_method'],
                    'debit'                 => 0,
                    'credit'                => $total
                );
                $this->insert("tbl_journal_entry_details", $form_credit);
            }

            return $sql;
        }else{
            return -2;
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

    public function dataRow($primary_id, $field)
    {
        $result = $this->select($this->table, $field, "$this->pk = '$primary_id'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_array();
            return $row[$field];
        } else {
            return "";
        }
    }

    public function detailsRow($primary_id, $field)
    {
        $result = $this->select($this->table_detail, $field, "$this->pk2 = '$primary_id'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_array();
            return $row[$field];
        } else {
            return "";
        }
    }

    public function add_detail()
    {
        $form = array(
            $this->pk               => $this->inputs[$this->pk],
            $this->fk_det           => $this->inputs[$this->fk_det],
            // 'expense_category_id'   => $this->inputs['expense_category_id'],
            'expense_desc'          => $this->inputs['expense_desc'],
            'expense_amount'        => $this->inputs['expense_amount'],
        );
        return $this->insert($this->table_detail, $form);
    }

    public function show_detail()
    {
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $count = 1;
        $ChartOfAccounts = new ChartOfAccounts;
        $ExpenseCategory = new ExpenseCategory;
        $result = $this->select($this->table_detail, '*', $param);
        while ($row = $result->fetch_assoc()) {
            $row['chart'] = $ChartOfAccounts->name($row['chart_id']);
            // $row['category'] = $ExpenseCategory->name($row['expense_category_id']);
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
        return 'EXP-' . date('YmdHis');
    }

    public function total_per_chart($start_date, $end_date, $chart_id, $journal_id)
    {
        $result = $this->select("tbl_expenses as h, tbl_expense_details as d", 'sum(d.debit) as total_debit, sum(d.credit) as total_credit', "(h.journal_date >= '$start_date' AND h.journal_date <= '$end_date') AND h.expense_id=d.expense_id AND h.status='F' AND d.chart_id='$chart_id' AND h.journal_id='$journal_id'");

        $row = $result->fetch_assoc();
        return $row;
    }

    public function chart_per_year($year, $chart_id)
    {
        $result = $this->select("tbl_expenses as h, tbl_expense_details as d", 'sum(d.debit-d.credit) as total', "YEAR(journal_date)='$year' AND h.expense_id=d.expense_id AND h.status='F' AND d.chart_id='$chart_id'");

        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function journal_book()
    {
        $journal_id = $this->inputs['journal_id'];
        $start_date = $this->inputs['start_date'];
        $end_date = $this->inputs['end_date'];

        $rows = array();
        $Chart = new ChartOfAccounts;
        $result = $this->select($this->table, '*', "journal_id='$journal_id' AND (journal_date >= '$start_date' AND journal_date <= '$end_date')");
        while ($row = $result->fetch_assoc()) {
            $details = $this->select($this->table_detail, "*", "expense_id='$row[expense_id]' ORDER BY debit DESC");

            $chart_data = "";
            $debit_data = "";
            $credit_data = "";
            while ($dRow = $details->fetch_array()) {
                $type = $dRow['debit'] > 0 ? "" : "&emsp;&emsp;";
                $debit = $dRow['debit'] > 0 ? number_format($dRow['debit']) : "";
                $credit = $dRow['credit'] > 0 ? number_format($dRow['credit']) : "";
                $chart_data .= $type . $Chart->name($dRow['chart_id']) . "<br>";
                $debit_data .= $debit . "<br>";
                $credit_data .= $credit . "<br>";
            }
            $remarks = $row['remarks'] == "" ? "" : '<br>(' . $row['remarks'] . ')';

            $row['date'] = date('M d, Y', strtotime($row["journal_date"]));
            $row['general_reference'] = $row["reference_number"] . $remarks;
            $row['account'] = $chart_data;
            $row['debit'] = $debit_data;
            $row['credit'] = $credit_data;
            $rows[] = $row;
        }

        return $rows;
    }
}
