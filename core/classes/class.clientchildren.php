<?php

class ClientChildren extends Connection
{
    private $table = 'tbl_client_children';
    public $pk = 'child_id';
    public $fk = 'client_id';
    public $name = 'child_name';

    public $inputs;

    public function remove()
    {
        $id = $this->inputs['id'];

        return $this->delete($this->table, "child_id = $id");
    }

    public function get_children()
    {
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = "";
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {

            $rows .=    '<div class="col-md-3"><h6>' . $row['child_name'] . '</h6></div>' .
                '<div class="col-md-2"><h6>' . $row['child_sex'] . '</h6></div>' .
                '<div class="col-md-2"><h6>' . $row['child_age'] . '</h6></div>' .
                '<div class="col-md-5"><h6>' . $row['child_occupation'] . '</h6></div>';
        }
        return $rows;
    }

    public function show()
    {
        $rows = array();
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function add()
    {

        $child_name = $this->clean($this->inputs['child_name']);
        $form = array(
            $this->fk           => $this->inputs[$this->fk],
            'child_name'        => $child_name,
            'child_age'         => $this->clean($this->inputs['child_age']),
            'child_sex'         => $this->clean($this->inputs['child_sex']),
            'child_occupation'  => $this->clean($this->inputs['child_occupation'])

        );

        return $this->insertIfNotExist($this->table, $form, "child_name = '" . $child_name . "' AND $this->fk='" . $this->inputs[$this->fk] . "'");
    }

    public function schema()
    {
        $default['date_added'] = $this->metadata('date_added', 'datetime', '', 'NOT NULL', 'CURRENT_TIMESTAMP');
        $default['date_last_modified'] = $this->metadata('date_last_modified', 'datetime', '', 'NOT NULL', 'CURRENT_TIMESTAMP', 'ON UPDATE CURRENT_TIMESTAMP');

        // TABLE HEADER
        $tables[] = array(
            'name'      => $this->table,
            'primary'   => $this->pk,
            'fields' => array(
                $this->metadata($this->pk, 'int', 11, 'NOT NULL', '', 'AUTO_INCREMENT'),
                $this->metadata('client_id', 'int', 11),
                $this->metadata('child_name', 'varchar', 150),
                $this->metadata('child_sex', 'varchar', 10),
                $this->metadata('child_age', 'int', 11),
                $this->metadata('child_occupation', 'varchar', 50),
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
