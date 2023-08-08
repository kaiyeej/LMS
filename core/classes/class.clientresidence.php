<?php

class ClientResidence extends Connection
{
    private $table = 'tbl_client_residence';
    public $pk = 'residence_id';
    public $name = 'residence';
    public $fk = 'client_id';

    public $inputs;

    public function addOrUpdate()
    {
        $fk = $this->clean($this->inputs[$this->fk]);
        $residence = $this->clean($this->inputs['residence']);
        $residence_status = $this->clean($this->inputs['residence_status']);
        $residence_certificate_no = $this->clean($this->inputs['residence_certificate_no']);
        $certificate_issued_at = $this->clean($this->inputs['certificate_issued_at']);
        $certificate_date = $this->clean($this->inputs['certificate_date']);
        $is_exist = $this->select($this->table, $this->pk, "client_id = '$fk'");

        $form = array(
            'client_id'                 => $fk,
            'residence'                 => $residence,
            'residence_status'          => $residence_status,
            'residence_certificate_no'  => $residence_certificate_no,
            'certificate_issued_at'     => $certificate_issued_at,
            'certificate_date'          => $certificate_date,
        );

        return $is_exist->num_rows > 0 ? $this->update($this->table, $form, "client_id = '$fk'") : $this->insert($this->table, $form);
    }

    public function view()
    {
        $client_id = $this->inputs['client_id'];
        $result = $this->select($this->table, "*", "client_id = '$client_id'");
        if ($result->num_rows < 1)
            return array(
                'residence_id'              => '',
                'client_id'                 => $client_id,
                'residence'                 => '',
                'residence_status'          => '',
                'residence_certificate_no'  => '',
                'certificate_issued_at'     => '',
                'certificate_date'          => '',
            );
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

    public function nameByClient($client_id)
    {
        $result = $this->select($this->table, $this->name, "client_id = '$client_id'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row[$this->name];
        } else {
            return "---";
        }
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
                $this->metadata('residence', 'text'),
                $this->metadata('residence_status', 'varchar', 15, 'NOT NULL', '', '', "'Owned,Rented, Free of use'"),
                $this->metadata('residence_certificate_no', 'varchar', 50),
                $this->metadata('certificate_issued_at', 'varchar', 150),
                $this->metadata('certificate_date', 'date'),
                $default['date_added'],
                $default['date_last_modified']
            )
        );

        return $this->schemaCreator($tables);
    }
}

// CREATE TABLE `tbl_client_residence` (
//     `residence_id` INT(11) NOT NULL AUTO_INCREMENT,
//     `client_id` INT(11) NOT NULL,
//     `residence` TEXT NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `residence_status` VARCHAR(15) NOT NULL COMMENT 'Owned,Rented, Free of use' COLLATE 'latin1_swedish_ci',
//     `residence_certificate_no` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
//     `certificate_issued_at` VARCHAR(150) NOT NULL COLLATE 'latin1_swedish_ci',
//     `certificate_date` DATE NOT NULL,
//     `date_added` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
//     `date_last_modified` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
//     PRIMARY KEY (`residence_id`) USING BTREE
// )
// COLLATE='latin1_swedish_ci'
// ENGINE=InnoDB
// ;
