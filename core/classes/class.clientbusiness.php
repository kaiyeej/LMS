<?php

class ClientBusiness extends Connection
{
    private $table = 'tbl_client_business';
    public $pk = 'business_id';
    public $name = 'business_name';
    public $fk = 'client_id';

    public $inputs;

    public function addOrUpdate()
    {
        $fk = $this->clean($this->inputs[$this->fk]);
        $business_name = $this->clean($this->inputs['business_name']);
        $business_address = $this->clean($this->inputs['business_address']);
        $business_contact = $this->clean($this->inputs['business_contact']);
        $business_position = $this->clean($this->inputs['business_position']);
        $business_kind = $this->clean($this->inputs['business_kind']);
        $business_length = $this->clean($this->inputs['business_length']);
        $business_capital = $this->clean($this->inputs['business_capital']);
        $business_type = $this->clean($this->inputs['business_type']);

        $is_exist = $this->select($this->table, $this->pk, "client_id = '$fk'");

        $form = array(
            'client_id'         => $fk,
            'business_name'     => $business_name,
            'business_address'  => $business_address,
            'business_contact'  => $business_contact,
            'business_position' => $business_position,
            'business_kind'     => $business_kind,
            'business_length'   => $business_length,
            'business_capital'  => $business_capital,
            'business_type'     => $business_type,
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
}

// CREATE TABLE `tbl_client_business` (
//     `business_id` INT(11) NOT NULL AUTO_INCREMENT,
//     `client_id` INT(11) NOT NULL DEFAULT '0',
//     `business_name` VARCHAR(150) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `business_address` VARCHAR(150) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `business_contact` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `business_position` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `business_kind` VARCHAR(150) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `business_length` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `business_capital` DECIMAL(15,3) NULL DEFAULT NULL,
//     `business_type` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `date_added` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
//     `date_last_modified` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
//     PRIMARY KEY (`business_id`) USING BTREE
// )
// COLLATE='latin1_swedish_ci'
// ENGINE=InnoDB
// ;
