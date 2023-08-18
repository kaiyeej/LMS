<?php

class ClientTypes extends Connection
{
    private $table = 'tbl_client_types';
    public $pk = 'client_type_id';
    public $name = 'client_type';

    public $inputs;

    public function add()
    {
        $form = array(
            $this->name     => $this->clean($this->inputs[$this->name]),
            'remarks'       => $this->clean($this->inputs['remarks']),
            'user_id'       => $_SESSION['lms_user_id'],
        );

        $response = $this->insertIfNotExist($this->table, $form);
        Logs::action($this->action_response, "Client Types", "Branches->add");
        return $response;
    }

    public function edit()
    {
        $form = array(
            $this->name => $this->clean($this->inputs[$this->name]),
            'remarks'   => $this->clean($this->inputs['remarks']),
            'user_id'   => $_SESSION['lms_user_id'],
        );

        $response = $this->updateIfNotExist($this->table, $form);
        Logs::action($this->action_response, "Client Types", "ClientTypes->edit");
        return $response;
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
        foreach ($this->inputs['ids'] as $id) {
            $name = $this->name($id);
            $res = $this->delete($this->table, "$this->pk = '$id'");
            if ($res == 1) {
                Logs::action("Successfuly deleted Client Type: $name", "ClientTypes", "ClientTypes->remove");
            }
        }
        return 1;
    }

    public function name($primary_id)
    {
        $result = $this->select($this->table, $this->name, "$this->pk = '$primary_id'");
        $row = $result->fetch_assoc();
        return $row[$this->name];
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
                $this->metadata('remarks', 'text'),
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

// CREATE TABLE `tbl_client_types` (
//     `client_type_id` INT(11) NOT NULL AUTO_INCREMENT,
//     `client_type` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
//     `remarks` TEXT NOT NULL COLLATE 'latin1_swedish_ci',
//     `user_id` INT(11) NOT NULL,
//     `date_added` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
//     `date_last_modified` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
//     PRIMARY KEY (`client_type_id`) USING BTREE
// )
// COLLATE='latin1_swedish_ci'
// ENGINE=InnoDB
// AUTO_INCREMENT=2
// ;
