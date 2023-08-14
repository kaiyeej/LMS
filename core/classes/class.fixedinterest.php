<?php

class FixedInterest extends Connection
{
    private $table = 'tbl_fixed_loan_interest';
    public $pk = 'loan_interest_id';
    public $name = 'loan_amount';

    public $inputs;

    public function add()
    {
        $form = array(
            $this->name             => $this->clean($this->inputs[$this->name]),
            'loan_type_id'          => $this->clean($this->inputs['loan_type_id']),
            'interest_amount'       => $this->clean($this->inputs['interest_amount']),
            'penalty_percentage'    => $this->clean($this->inputs['penalty_percentage']),
            'interest_terms'        => $this->clean($this->inputs['interest_terms']),
        );

        return $this->insertIfNotExist($this->table, $form, "$this->name = '" . $this->inputs[$this->name] . "'");
    }

    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
        $form = array(
            $this->name             => $this->clean($this->inputs[$this->name]),
            'loan_type_id'          => $this->clean($this->inputs['loan_type_id']),
            'interest_amount'       => $this->clean($this->inputs['interest_amount']),
            'penalty_percentage'    => $this->clean($this->inputs['penalty_percentage']),
            'interest_terms'        => $this->clean($this->inputs['interest_terms']),
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

    public function delete_entry()
    {
        $primary_id = $this->inputs['id'];
        return $this->delete("tbl_fixed_loan_interest", "loan_interest_id = '$primary_id'");
    }

    public function name($primary_id)
    {
        $result = $this->select($this->table, 'loan_amount', "$this->pk = '$primary_id'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['loan_amount'];
        } else {
            return "---";
        }
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
                $this->metadata($this->name, 'decimal', "12,4"),
                $this->metadata('loan_type_id', 'int', 11),
                $this->metadata('interest_amount', 'int', 11),
                $this->metadata('penalty_percentage', 'decimal', "5,2"),
                $this->metadata('interest_terms', 'int', 4),
                $default['user_id'],
                $default['date_added'],
                $default['date_last_modified']
            )
        );

        return $this->schemaCreator($tables);
    }

    public function triggers()
    {
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
