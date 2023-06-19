<?php

class ClientReference extends Connection
{
    private $table = 'tbl_client_reference';
    public $pk = 'reference_id';
    public $name = 'reference_name';
    public $fk = 'client_id';

    public $inputs;

    public function addOrUpdate()
    {
        $fk = $this->clean($this->inputs[$this->fk]);

        for ($reference_no = 1; $reference_no <= 3; $reference_no++) {
            $client_credit_ref_name = $this->clean($this->inputs['client_credit_ref_name' . $reference_no]);
            $client_credit_ref_address = $this->clean($this->inputs['client_credit_ref_address' . $reference_no]);

            $is_exist = $this->select($this->table, $this->pk, "client_id = '$fk' AND reference_no = '$reference_no'");

            $form = array(
                'client_id'         => $fk,
                'reference_no'      => $reference_no,
                'reference_name'    => $client_credit_ref_name,
                'reference_address' => $client_credit_ref_address,
            );

            $is_exist->num_rows > 0 ? $this->update($this->table, $form, "client_id = '$fk' AND reference_no = '$reference_no'") : $this->insert($this->table, $form);
        }

        return 1;
    }

    public function view()
    {
        $client_id = $this->inputs['client_id'];
        $response = [];

        for ($reference_no = 1; $reference_no <= 3; $reference_no++) {
            $result = $this->select($this->table, "*", "client_id = '$client_id' AND reference_no = '$reference_no'");
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $response['client_credit_ref_name' . $reference_no] = $row['reference_name'];
                $response['client_credit_ref_address' . $reference_no] = $row['reference_address'];
            } else {
                $response['client_credit_ref_name' . $reference_no] = "";
                $response['client_credit_ref_address' . $reference_no] = "";
            }
        }
        return $response;
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
                    $this->metadata('reference_no', 'int', 11),
                    $this->metadata('reference_name', 'varchar', 150),
                    $this->metadata('reference_address', 'varchar', 150),
                    $default['date_added'],
                    $default['date_last_modified']
                )
            );

            return $this->schemaCreator($tables);
        }
    }
}

// CREATE TABLE `tbl_client_reference` (
//     `reference_id` INT(11) NOT NULL AUTO_INCREMENT,
//     `client_id` INT(11) NOT NULL DEFAULT '0',
//     `reference_no` INT(11) NOT NULL DEFAULT '0',
//     `reference_name` VARCHAR(150) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `reference_address` VARCHAR(150) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `date_added` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
//     `date_last_modified` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
//     PRIMARY KEY (`reference_id`) USING BTREE
// )
// COLLATE='latin1_swedish_ci'
// ENGINE=InnoDB
// ;
