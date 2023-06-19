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
