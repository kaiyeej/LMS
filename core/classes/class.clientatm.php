<?php

class ClientAtm extends Connection
{
    private $table = 'tbl_client_atm';
    public $pk = 'atm_id';
    public $name = 'atm_account_no';
    public $fk = 'client_id';

    public $inputs;

    public function addOrUpdate()
    {
        $fk = $this->clean($this->inputs[$this->fk]);
        $atm_account_no = $this->clean($this->inputs['atm_account_no']);
        $atm_bank = $this->clean($this->inputs['atm_bank']);

        $is_exist = $this->select($this->table, $this->pk, "client_id = '$fk'");

        $form = array(
            'client_id'         => $fk,
            'atm_account_no'    => $atm_account_no,
            'atm_bank'          => $atm_bank,
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

// CREATE TABLE `tbl_client_atm` (
//     `atm_id` INT(11) NOT NULL AUTO_INCREMENT,
//     `client_id` INT(11) NOT NULL DEFAULT '0',
//     `atm_account_no` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `atm_bank` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `atm_balance` DECIMAL(15,3) NOT NULL DEFAULT '0.000',
//     `date_added` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
//     `date_last_modified` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
//     PRIMARY KEY (`atm_id`) USING BTREE
// )
// COLLATE='latin1_swedish_ci'
// ENGINE=InnoDB
// ;
