<?php

class Employers extends Connection
{
    private $table = 'tbl_employers';
    public $pk = 'employer_id';
    public $name = 'employer_name';

    public $inputs;

    public function add()
    {
        $employer_name = $this->clean($this->inputs['employer_name']);
        $employer_contact_no = $this->clean($this->inputs['employer_contact_no']);
        $employer_address = $this->clean($this->inputs['employer_address']);
        $is_exist = $this->select($this->table, $this->pk, "employer_name = '$employer_name'");

        if ($is_exist->num_rows > 0)
            return 2;

        $form = array(
            'employer_name'         => $employer_name,
            'employer_contact_no'   => $employer_contact_no,
            'employer_address'      => $employer_address,
        );
        return $this->insert($this->table, $form);
    }

    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
        $employer_name = $this->clean($this->inputs['employer_name']);
        $employer_contact_no = $this->clean($this->inputs['employer_contact_no']);
        $employer_address = $this->clean($this->inputs['employer_address']);

        $is_exist = $this->select($this->table, $this->pk, "employer_name = '$employer_name' AND $this->pk != '$primary_id'");
        if ($is_exist->num_rows > 0)
            return 2;

        $form = array(
            'employer_name'         => $employer_name,
            'employer_contact_no'   => $employer_contact_no,
            'employer_address'      => $employer_address,
        );
        return $this->update($this->table, $form, "$this->pk = '$primary_id'");
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

    public function view()
    {
        $primary_id = $this->inputs['id'];
        $result = $this->select($this->table, "*", "$this->pk = '$primary_id'");
        $row = $result->fetch_assoc();
        return $row;
    }

    public function name($primary_id)
    {
        $result = $this->select($this->table, $this->name, "$this->pk = '$primary_id'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row[$this->name];
        } else {
            return "---";
        }
    }

    public function idByName($name)
    {
        $result = $this->select($this->table, $this->pk, "UCASE(employer_name) = UCASE('$name')");

        if ($result->num_rows < 1)
            return 0;

        $row = $result->fetch_assoc();
        return $row[$this->pk];
    }

    public function remove()
    {
        $ids = implode(",", $this->inputs['ids']);
        return $this->delete($this->table, "$this->pk IN($ids)");
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
                    $this->metadata($this->name, 'varchar', 150),
                    $this->metadata('employer_address', 'varchar', 255),
                    $this->metadata('employer_contact_no', 'varchar', 50),
                    $default['date_added'],
                    $default['date_last_modified']
                )
            );

            return $this->schemaCreator($tables);
        }
    }
}

// CREATE TABLE `tbl_employers` (
//     `employer_id` INT(11) NOT NULL AUTO_INCREMENT,
//     `employer_name` VARCHAR(150) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `employer_address` VARCHAR(255) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `employer_contact_no` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `date_added` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
//     `date_last_modified` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
//     PRIMARY KEY (`employer_id`) USING BTREE
// )
// COLLATE='latin1_swedish_ci'
// ENGINE=InnoDB
// AUTO_INCREMENT=4
// ;
