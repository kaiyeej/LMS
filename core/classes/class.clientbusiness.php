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
        if ($result->num_rows < 1)
            return array(
                'business_id'       => '',
                'business_name'     => '',
                'business_address'  => '',
                'business_contact'  => '',
                'business_position' => '',
                'business_kind'     => '',
                'business_length'   => '',
                'business_capital'  => 0,
                'business_type'     => '',
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
                    $this->metadata($this->name, 'varchar', 150),
                    $this->metadata('client_id', 'int', 11),
                    $this->metadata('business_address', 'varchar', 150),
                    $this->metadata('business_contact', 'varchar', 50),
                    $this->metadata('business_position', 'varchar', 50),
                    $this->metadata('business_kind', 'varchar', 150),
                    $this->metadata('business_length', 'varchar', 50),
                    $this->metadata('business_capital', 'decimal', '15,3'),
                    $this->metadata('business_type', 'varchar', 50),
                    $default['date_added'],
                    $default['date_last_modified']
                )
            );

            return $this->schemaCreator($tables);
        }
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
