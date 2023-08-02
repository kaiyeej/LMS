<?php

class Journals extends Connection
{
    private $table = 'tbl_journals';
    public $pk = 'journal_id';
    public $name = 'journal_name';

    public $inputs;

    public function add()
    {
        $form = array(
            $this->name     => $this->clean($this->inputs[$this->name]),
            'journal_code'  => $this->clean($this->inputs['journal_code']),
        );

        return $this->insertIfNotExist($this->table, $form, "$this->name = '" . $this->inputs[$this->name] . "'");
    }

    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
        $form = array(
            $this->name     => $this->clean($this->inputs[$this->name]),
            'journal_code'  => $this->clean($this->inputs['journal_code']),
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
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public function remove()
    {
        $ids = implode(",", $this->inputs['ids']);

        return $this->delete($this->table, "$this->pk IN($ids)");
    }

    public function name($primary_id)
    {
        $result = $this->select($this->table, 'journal_name', "$this->pk = '$primary_id'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['journal_name'];
        } else {
            return null;
        }
    }

    public function journal_code($primary_id)
    {
        $result = $this->select($this->table, 'journal_code', "$this->pk = '$primary_id'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['journal_code'];
        } else {
            return null;
        }
    }

    public function jl_data($code)
    {
        $result = $this->select($this->table, '*', "journal_name like '%$code%'");
        if ($result->num_rows < 1)
            return null;
        return $result->fetch_assoc();
    }

    public function idByName($name)
    {
        $result = $this->select($this->table, $this->pk, "UCASE($this->name) = UCASE('$name')");

        if ($result->num_rows < 1)
            return 0;

        $row = $result->fetch_assoc();
        return $row[$this->pk];
    }

    public function schema()
    {
        if (DEVELOPMENT) {
            $default['date_added'] = $this->metadata('date_added', 'datetime', '', 'NOT NULL', 'CURRENT_TIMESTAMP');
            $default['date_last_modified'] = $this->metadata('date_last_modified', 'datetime', '', 'NOT NULL', 'CURRENT_TIMESTAMP', 'ON UPDATE CURRENT_TIMESTAMP');


            // TABLE HEADER
            $tables[] = array(
                'name'      => $this->table,
                'primary'   => $this->pk,
                'fields' => array(
                    $this->metadata($this->pk, 'int', 11, 'NOT NULL', '', 'AUTO_INCREMENT'),
                    $this->metadata($this->name, 'varchar', 50),
                    $this->metadata('journal_code', 'varchar', 10),
                    $this->metadata('is_preset', 'int', 1),
                    $default['date_added'],
                    $default['date_last_modified']
                )
            );

            return $this->schemaCreator($tables);
        }
    }
}
