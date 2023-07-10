<?php

class ClientSoi extends Connection
{
    private $table = 'tbl_client_soi';
    public $pk = 'soi_id';
    public $name = 'soi_name';
    public $fk = 'client_id';

    public $inputs;

    public function addOrUpdate()
    {
        $fk = $this->clean($this->inputs[$this->fk]);
        $soi_name = $this->clean($this->inputs['soi_name']);
        $soi_by = $this->clean($this->inputs['soi_by']);
        $soi_monthly = $this->clean($this->inputs['soi_monthly']);
        $soi_total = $this->clean($this->inputs['soi_total']);
        $soi_obligation = $this->clean($this->inputs['soi_obligation']);

        $is_exist = $this->select($this->table, $this->pk, "client_id = '$fk'");

        $form = array(
            'client_id'         => $fk,
            'soi_name'          => $soi_name,
            'soi_by'            => $soi_by,
            'soi_monthly'       => $soi_monthly,
            'soi_total'         => $soi_total,
            'soi_obligation'    => $soi_obligation,
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
                    $this->metadata('soi_name', 'varchar', 50),
                    $this->metadata('soi_by', 'varchar', 50),
                    $this->metadata('soi_monthly', 'decimal', '12,4'),
                    $this->metadata('soi_total', 'decimal', '12,4'),
                    $this->metadata('soi_obligation', 'decimal', '12,4'),
                    $default['date_added'],
                    $default['date_last_modified']
                )
            );

            return $this->schemaCreator($tables);
        }
    }
}

// CREATE TABLE `tbl_client_soi` (
//     `soi_id` INT(11) NOT NULL AUTO_INCREMENT,
//     `client_id` INT(11) NOT NULL DEFAULT '0',
//     `soi_name` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `soi_by` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `soi_monthly` DECIMAL(12,3) NOT NULL DEFAULT '0.000',
//     `soi_total` DECIMAL(12,3) NOT NULL DEFAULT '0.000',
//     `soi_obligation` DECIMAL(12,3) NOT NULL DEFAULT '0.000',
//     `date_added` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
//     `date_last_modified` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
//     PRIMARY KEY (`soi_id`) USING BTREE
// )
// COLLATE='latin1_swedish_ci'
// ENGINE=InnoDB
// ;