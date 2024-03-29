<?php

class JournalEntry extends Connection
{
    private $table = 'tbl_journal_entries';
    public $pk = 'journal_entry_id';
    public $name = 'reference_number';

    private $table_detail = 'tbl_journal_entry_details';
    public $pk2 = 'journal_entry_detail_id';
    public $fk_det = 'chart_id';

    public $inputs;

    public function add()
    {
        $form = array(
            $this->name         => $this->clean($this->inputs[$this->name]),
            'cross_reference'   => $this->inputs['cross_reference'],
            'branch_id'         => $this->inputs['branch_id'],
            'journal_id'        => $this->inputs['journal_id'],
            'remarks'           => $this->inputs['remarks'],
            'journal_date'      => $this->inputs['journal_date'],
            'user_id'           => $_SESSION['lms_user_id'],
            'status'            => $this->inputs['status'] ?? 'S',
            'is_manual'         => $this->inputs['is_manual'] ?? 'Y'
        );
        return $this->insertIfNotExist($this->table, $form, '', 'Y');
    }

    public function edit()
    {
        $form = array(
            'cross_reference'   => $this->inputs['cross_reference'],
            'journal_id'        => $this->inputs['journal_id'],
            'branch_id'         => $this->inputs['branch_id'],
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
        $Branches = new Branches;
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
            $details = $this->total_details($row['journal_entry_id']);
            $row['encoded_by'] = $Users->fullname($row['user_id']);
            $row['journal'] = $Journals->name($row['journal_id']);
            $row['branch'] = $Branches->name($row['branch_id']);
            $row['amount'] = $details[2] == 0 ? number_format($details[0], 2) : "<strong style='color:#F44336;'>" . number_format($details[0], 2) . "</strong>";

            $rows[] = $row;
        }
        return $rows;
    }

    function total_details($primary_id)
    {
        $result = $this->select($this->table_detail, "sum(debit) as total_debit, sum(credit) as total_credit", "$this->pk = '$primary_id'");
        $row = $result->fetch_assoc();

        $status = $row['total_debit'] == $row['total_credit'] ? 0 : 1;

        return [$row['total_debit'], $row['total_credit'], $status];
    }

    public function view()
    {
        $primary_id = $this->inputs['id'];
        $Users = new Users;
        $Branches = new Branches;
        $result = $this->select($this->table, "*", "$this->pk = '$primary_id'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $row['encoded_by'] = $Users->fullname($row['user_id']);
            $row['branch'] = $Branches->name($row['branch_id']);
            return $row;
        } else {
            return null;
        }
    }

    public function view_details($primary_id = null)
    {
        $primary_id = $primary_id == null ? $this->inputs['id'] : $primary_id;
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
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row[$this->name];
        } else {
            return null;
        }
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
        if ($this->inputs['type'] == "D") {
            $debit = $this->inputs['amount'];
            $credit = 0;
        } else {
            $credit = $this->inputs['amount'];
            $debit = 0;
        }

        $form = array(
            $this->pk       => $this->inputs[$this->pk],
            $this->fk_det   => $this->inputs[$this->fk_det],
            'debit'         => $debit,
            'credit'        => $credit,
            'description'   => $this->inputs['description'] ?? '',
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
            $row['debit'] = number_format($row['debit'], 2);
            $row['credit'] = number_format($row['credit'], 2);
            $rows[] = $row;
        }
        return $rows;
    }

    public function remove_detail()
    {
        $ids = implode(",", $this->inputs['ids']);
        return $this->delete($this->table_detail, "$this->pk2 IN($ids)");
    }

    public function generate($journal_code = 'JE')
    {
        return $journal_code . '-' . date('YmdHis');
    }

    public function total_per_chart($start_date, $end_date, $chart_id, $journal_id)
    {
        $result = $this->select("tbl_journal_entries as h, tbl_journal_entry_details as d", 'sum(d.debit) as total_debit, sum(d.credit) as total_credit', "(h.journal_date >= '$start_date' AND h.journal_date <= '$end_date') AND h.journal_entry_id=d.journal_entry_id AND h.status='F' AND d.chart_id='$chart_id' AND h.journal_id='$journal_id'");

        $row = $result->fetch_assoc();
        return $row;
    }

    public function chart_per_year($year, $chart_id)
    {
        $result = $this->select("tbl_journal_entries as h, tbl_journal_entry_details as d", 'sum(d.debit-d.credit) as total', "YEAR(journal_date)='$year' AND h.journal_entry_id=d.journal_entry_id AND h.status='F' AND d.chart_id='$chart_id'");

        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function total_year($year)
    {
        $result = $this->select("tbl_journal_entries as h, tbl_journal_entry_details as d", 'sum(d.debit-d.credit) as total', "YEAR(journal_date)='$year' AND h.journal_entry_id=d.journal_entry_id AND h.status='F'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['total'];
        } else {
            return 0;
        }
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
            $details = $this->select($this->table_detail, "*", "journal_entry_id='$row[journal_entry_id]' ORDER BY debit DESC");

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

    public function schema()
    {
        $default['date_added'] = $this->metadata('date_added', 'datetime', '', 'NOT NULL', 'CURRENT_TIMESTAMP');
        $default['date_last_modified'] = $this->metadata('date_last_modified', 'datetime', '', 'NOT NULL', 'CURRENT_TIMESTAMP', 'ON UPDATE CURRENT_TIMESTAMP');
        $default['user_id'] = $this->metadata('user_id', 'int', 11);


        // TABLE HEADER
        $tables[] = array(
            'name'      => $this->table,
            'primary'   => $this->pk,
            'fields' => array(
                $this->metadata($this->pk, 'int', 11, 'NOT NULL', '', 'AUTO_INCREMENT'),
                $this->metadata($this->name, 'varchar', 50),
                $this->metadata('branch_id', 'int', 11),
                $this->metadata('cross_reference', 'varchar', 50),
                $this->metadata('journal_id', 'int', 11),
                $this->metadata('remarks', 'varchar', 250),
                $this->metadata('journal_date', 'date'),
                $this->metadata('status', 'varchar', 1, 'NOT NULL', '', '', "'S = Saved; F = Posted'"),
                $this->metadata('is_manual', 'varchar', 1, '', '', '', "'N = No ; Y = Yes'"),
                $default['user_id'],
                $default['date_added'],
                $default['date_last_modified']
            )
        );

        // TABLE DETAILS
        $tables[] = array(
            'name'      => $this->table_detail,
            'primary'   => $this->pk2,
            'fields' => array(
                $this->metadata($this->pk2, 'int', 11, 'NOT NULL', '', 'AUTO_INCREMENT'),
                $this->metadata($this->pk, 'int', 11),
                $this->metadata($this->fk_det, 'int', 11),
                $this->metadata('description', 'varchar', 250),
                $this->metadata('debit', 'decimal', '12,4'),
                $this->metadata('credit', 'decimal', '12,4')
            )
        );

        return $this->schemaCreator($tables);
    }

    public function triggers()
    {
        $triggers[] = array(
            'table' => $this->table,
            'name' => 'delete_journal_entry',
            'action_time' => 'AFTER', // ['AFTER','BEFORE']
            'event' => "DELETE", // ['INSERT','UPDATE', 'DELETE']
            "statement" => "DELETE FROM $this->table_detail WHERE $this->pk = OLD.$this->pk"
        );

        // HEADER
        $triggers[] = array(
            'table' => $this->table,
            'name' => 'delete_' . $this->table,
            'action_time' => 'BEFORE', // ['AFTER','BEFORE']
            'event' => "DELETE", // ['INSERT','UPDATE', 'DELETE']
            "statement" => "INSERT INTO " . $this->table . "_deleted SELECT * FROM $this->table WHERE $this->pk = OLD.$this->pk"
        );

        return $this->triggerCreator($triggers);
    }
}
