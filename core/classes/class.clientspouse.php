<?php

class ClientSpouse extends Connection
{
    private $table = 'tbl_client_spouse';
    public $pk = 'spouse_id';
    public $name = 'spouse_name';
    public $fk = 'client_id';

    public $inputs;

    public function addOrUpdate()
    {
        $fk = $this->clean($this->inputs[$this->fk]);
        $spouse_name = $this->clean($this->inputs['spouse_name']);
        $spouse_residence = $this->clean($this->inputs['spouse_residence']);
        $spouse_res_cert_no = $this->clean($this->inputs['spouse_res_cert_no']);
        $spouse_res_cert_issued_at = $this->clean($this->inputs['spouse_res_cert_issued_at']);
        $spouse_res_cert_date = $this->clean($this->inputs['spouse_res_cert_date']);
        $spouse_employer = $this->clean($this->inputs['spouse_employer']);
        $spouse_employer_address = $this->clean($this->inputs['spouse_employer_address']);
        $spouse_employer_contact = $this->clean($this->inputs['spouse_employer_contact']);
        $spouse_employment_position = $this->clean($this->inputs['spouse_employment_position']);
        $spouse_employment_status = $this->clean($this->inputs['spouse_employment_status']);
        $spouse_employment_length = $this->clean($this->inputs['spouse_employment_length']);
        $spouse_employment_income = $this->clean($this->inputs['spouse_employment_income']);
        $spouse_last_employment = $this->clean($this->inputs['spouse_last_employment']);

        $is_exist = $this->select($this->table, $this->pk, "client_id = '$fk'");

        $form = array(
            'client_id'                 => $fk,
            'spouse_name'               => $spouse_name,
            'spouse_residence'          => $spouse_residence,
            'spouse_res_cert_no'        => $spouse_res_cert_no,
            'spouse_res_cert_issued_at' => $spouse_res_cert_issued_at,
            'spouse_res_cert_date'      => $spouse_res_cert_date,
            'spouse_employer'           => $spouse_employer,
            'spouse_employer_address'   => $spouse_employer_address,
            'spouse_employer_contact'   => $spouse_employer_contact,
            'spouse_employment_position' => $spouse_employment_position,
            'spouse_employment_status'  => $spouse_employment_status,
            'spouse_employment_length'  => $spouse_employment_length,
            'spouse_employment_income'  => $spouse_employment_income,
            'spouse_last_employment'    => $spouse_last_employment,
        );

        return $is_exist->num_rows > 0 ? $this->update($this->table, $form, "client_id = '$fk'") : $this->insert($this->table, $form);
    }

    public function view()
    {
        $client_id = $this->inputs['client_id'];
        $result = $this->select($this->table, "*", "client_id = '$client_id'");

        if ($result->num_rows < 1)
            return array(
                'spouse_name'               => '',
                'spouse_residence'          => '',
                'spouse_res_cert_no'        => '',
                'spouse_res_cert_issued_at' => '',
                'spouse_res_cert_date'      => '',
                'spouse_employer'           => '',
                'spouse_employer_address'   => '',
                'spouse_employer_contact'   => '',
                'spouse_employment_position' => '',
                'spouse_employment_status'  => '',
                'spouse_employment_length'  => '',
                'spouse_employment_income'  => '',
                'spouse_last_employment'    => '',
            );

        $row = $result->fetch_assoc();
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
                    $this->metadata($this->name, 'varchar', 75),
                    $this->metadata('spouse_residence', 'varchar', 150),
                    $this->metadata('certificate_no', 'varchar', 50),
                    $this->metadata('certificate_issued_at', 'varchar', 150),
                    $this->metadata('certificate_date', 'date'),
                    $this->metadata('spouse_employer', 'varchar', 150),
                    $this->metadata('spouse_employer_address', 'varchar', 150),
                    $this->metadata('spouse_employer_contact', 'varchar', 50),
                    $this->metadata('spouse_employment_status', 'varchar', 10),
                    $this->metadata('spouse_employment_length', 'varchar', 10),
                    $this->metadata('spouse_employment_income', 'DECIMAL', '15,3'),
                    $this->metadata('spouse_last_employment', 'varchar', 50),
                    $default['date_added'],
                    $default['date_last_modified']
                )
            );

            return $this->schemaCreator($tables);
        }
    }
}

// CREATE TABLE `tbl_client_spouse` (
//     `spouse_id` INT(11) NOT NULL AUTO_INCREMENT,
//     `spouse_name` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `spouse_residence` VARCHAR(150) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `certificate_no` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `certificate_issued_at` VARCHAR(150) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `certificate_date` DATE NOT NULL DEFAULT '0000-00-00',
//     `spouse_employer` VARCHAR(150) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `spouse_employer_address` VARCHAR(150) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `spouse_employer_contact` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `spouse_employment_status` VARCHAR(10) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `spouse_employment_length` VARCHAR(10) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `spouse_employment_income` DECIMAL(15,3) NULL DEFAULT NULL,
//     `spouse_last_employment` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `date_added` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
//     `date_last_modified` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
//     PRIMARY KEY (`spouse_id`) USING BTREE
// )
// COLLATE='latin1_swedish_ci'
// ENGINE=InnoDB
// ;
