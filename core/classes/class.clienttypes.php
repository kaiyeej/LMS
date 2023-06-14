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

        return $this->insertIfNotExist($this->table, $form, "$this->name = '" . $this->inputs[$this->name] . "'");
    }

    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
        $is_exist = $this->select($this->table, $this->pk, "$this->name = '" . $this->inputs[$this->name] . "' AND $this->pk != '$primary_id'");
        if ($is_exist->num_rows > 0) {
            return 2;
        } else {
            $form = array(
                $this->name     => $this->clean($this->inputs[$this->name]),
                'remarks'       => $this->clean($this->inputs['remarks']),
                'user_id'       => $_SESSION['lms_user_id'],
            );

            return $this->updateIfNotExist($this->table, $form, "$this->pk = '$primary_id'");
        }
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
        $row = $result->fetch_assoc();
        return $row[$this->name];
    }

    public function schema()
    {
        if (DEVELOPMENT) {
            $default['date_added'] = $this->metadata('date_added', 'datetime', '', 'NOT NULL', 'CURRENT_TIMESTAMP');
            $default['date_last_modified'] = $this->metadata('date_last_modified', 'datetime', '', 'NOT NULL', '', 'ON UPDATE CURRENT_TIMESTAMP');
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
    }
}
