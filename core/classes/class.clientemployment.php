<?php

class ClientEmployment extends Connection
{
    private $table = 'tbl_client_employment';
    public $pk = 'employment_id';
    public $name = 'employer_id';
    public $fk = 'client_id';

    public $inputs;

    public function addOrUpdate()
    {
        $fk = $this->clean($this->inputs[$this->fk]);
        $employer_id = $this->clean($this->inputs['employer_id']);
        $employer_address = $this->clean($this->inputs['employer_address']);
        $employer_contact_no = $this->clean($this->inputs['employer_contact_no']);
        $employment_position = $this->clean($this->inputs['employment_position']);
        $employment_income = $this->clean($this->inputs['employment_income']);
        $employment_status = $this->clean($this->inputs['employment_status']);
        $employment_length = $this->clean($this->inputs['employment_length']);
        $last_employment = $this->clean($this->inputs['last_employment']);

        $is_exist = $this->select($this->table, $this->pk, "client_id = '$fk' AND employer_id = '$employer_id'");

        $this->update($this->table, ["current_status" => 0], "client_id = '$fk'");

        $form = array(
            'client_id'             => $fk,
            'employer_id'           => $employer_id,
            'employer_address'      => $employer_address,
            'employer_contact_no'   => $employer_contact_no,
            'employment_position'   => $employment_position,
            'employment_income'     => $employment_income,
            'employment_status'     => $employment_status,
            'employment_length'     => $employment_length,
            'last_employment'       => $last_employment,
            'current_status'        => 1,
        );

        return $is_exist->num_rows > 0 ? $this->update($this->table, $form, "client_id = '$fk' AND employer_id = '$employer_id'") : $this->insert($this->table, $form);
    }

    public function view()
    {
        $client_id = $this->inputs['client_id'];
        $result = $this->select($this->table, "*", "client_id = '$client_id' AND current_status = 1");
        $row = $result->fetch_assoc();

        $Employers = new Employers;
        $row['employer'] = $Employers->name($row['employer_id']);
        return $row;
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
                    $this->metadata('client_id', 'int', 11),
                    $this->metadata('employer_id', 'int', 11),
                    $this->metadata('employer_address', 'varchar', 150),
                    $this->metadata('employer_contact_no', 'varchar', 50),
                    $this->metadata('employment_position', 'varchar', 50),
                    $this->metadata('employment_income', 'decimal', '15,3'),
                    $this->metadata('employment_status', 'varchar', 15),
                    $this->metadata('employment_length', 'varchar', 15),
                    $this->metadata('last_employment', 'varchar', 50),
                    $this->metadata('current_status', 'int', 1),
                    $default['date_added'],
                    $default['date_last_modified']
                )
            );

            return $this->schemaCreator($tables);
        }
    }
}

// CREATE TABLE `tbl_client_employment` (
//     `employment_id` INT(11) NOT NULL AUTO_INCREMENT,
//     `client_id` INT(11) NOT NULL DEFAULT '0',
//     `employer_id` INT(11) NOT NULL DEFAULT '0',
//     `employer_address` VARCHAR(150) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `employer_contact_no` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `employment_position` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `employment_income` DECIMAL(15,3) NOT NULL DEFAULT '0.000',
//     `employment_status` VARCHAR(15) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `employment_length` VARCHAR(15) NOT NULL DEFAULT '0' COLLATE 'latin1_swedish_ci',
//     `last_employment` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `current_status` INT(1) NOT NULL DEFAULT '0',
//     `date_added` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
//     `date_last_modified` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
//     PRIMARY KEY (`employment_id`) USING BTREE
// )
// COLLATE='latin1_swedish_ci'
// ENGINE=InnoDB
// AUTO_INCREMENT=16
// ;
