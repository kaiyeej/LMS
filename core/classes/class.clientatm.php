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
        if ($result->num_rows < 1)
            return array(
                'atm_account_no'    => '',
                'atm_balance'       => '0.000',
                'atm_bank'          => '',
                'atm_id'            => '',
            );

        $row = $result->fetch_assoc();
        return $row;
    }

    public function name($client_id)
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
                    $this->metadata('atm_bank', 'varchar', 50),
                    $this->metadata('atm_balance', 'varchar', '15,3', 'NOT NULL', 0),
                    $default['date_added'],
                    $default['date_last_modified']
                )
            );

            return $this->schemaCreator($tables);
        }
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
