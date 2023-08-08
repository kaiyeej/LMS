<?php

class ClientInsurance extends Connection
{
    private $table = 'tbl_client_insurance';
    public $pk = 'client_insurance_id';
    public $name = 'insurance_id';
    public $fk = 'client_id';

    public $inputs;

    public function addOrUpdate()
    {
        $fk = $this->clean($this->inputs[$this->fk]);
        $insurance_id = $this->clean($this->inputs['insurance_id']);
        $insurance_amount = $this->clean($this->inputs['insurance_amount']);
        $insurance_maturity = $this->clean($this->inputs['insurance_maturity']);
        $insurance_bank_transaction = $this->clean($this->inputs['insurance_bank_transaction']);
        $insurance_unpaid_obligation = $this->clean($this->inputs['insurance_unpaid_obligation']);
        $insurance_salary_withdrawal = $this->clean($this->inputs['insurance_salary_withdrawal']);
        $paymaster_name = $this->clean($this->inputs['paymaster_name']);
        $paymaster_address = $this->clean($this->inputs['paymaster_address']);
        $paymaster_res_cert_no = $this->clean($this->inputs['paymaster_res_cert_no']);
        $paymaster_res_cert_issued_at = $this->clean($this->inputs['paymaster_res_cert_issued_at']);
        $paymaster_res_cert_date = $this->clean($this->inputs['paymaster_res_cert_date']);
        $paymaster_deduct_salary = (!isset($this->inputs['paymaster_deduct_salary']) ? "No" : "Yes");
        $paymaster_client_deduct_salary = (!isset($this->inputs['paymaster_client_deduct_salary']) ? "No" : "Yes");
        $paymaster_conformity = (!isset($this->inputs['paymaster_conformity']) ? "No" : "Yes");

        $is_exist = $this->select($this->table, $this->pk, "client_id = '$fk'");

        $form = array(
            'client_id'                         => $fk,
            'insurance_id'                      => $insurance_id,
            'insurance_amount'                  => $insurance_amount,
            'insurance_maturity'                => $insurance_maturity,
            'insurance_bank_transaction'        => $insurance_bank_transaction,
            'insurance_unpaid_obligation'       => $insurance_unpaid_obligation,
            'insurance_salary_withdrawal'       => $insurance_salary_withdrawal,
            'paymaster_name'                    => $paymaster_name,
            'paymaster_address'                 => $paymaster_address,
            'paymaster_res_cert_no'             => $paymaster_res_cert_no,
            'paymaster_res_cert_issued_at'      => $paymaster_res_cert_issued_at,
            'paymaster_res_cert_date'           => $paymaster_res_cert_date,
            'paymaster_deduct_salary'           => $paymaster_deduct_salary,
            'paymaster_client_deduct_salary'    => $paymaster_client_deduct_salary,
            'paymaster_conformity'              => $paymaster_conformity,
        );

        return $is_exist->num_rows > 0 ? $this->update($this->table, $form, "client_id = '$fk'") : $this->insert($this->table, $form);
    }

    public function view()
    {
        $client_id = $this->inputs['client_id'];
        $result = $this->select($this->table, "*", "client_id = '$client_id'");
        if ($result->num_rows < 1)
            return array(
                'insurance_id'                      => '',
                'insurance_amount'                  => '',
                'insurance_maturity'                => '',
                'insurance_bank_transaction'        => '',
                'insurance_unpaid_obligation'       => '',
                'insurance_salary_withdrawal'       => '',
                'paymaster_name'                    => '',
                'paymaster_address'                 => '',
                'paymaster_res_cert_no'             => '',
                'paymaster_res_cert_issued_at'      => '',
                'paymaster_res_cert_date'           => '',
                'paymaster_deduct_salary'           => '',
                'paymaster_client_deduct_salary'    => '',
                'paymaster_conformity'              => '',
            );

        $row = $result->fetch_assoc();
        $Insurance = new Insurance;
        $row['insurance'] = $Insurance->name($row['insurance_id']);
        return $row;
    }

    public function clientInsuranceID($primary_id)
    {
        $result = $this->select($this->table, $this->name, "client_id = '$primary_id'");
        $row = $result->fetch_assoc();
        return $row[$this->name];
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
                $this->metadata('insurance_id', 'int', 11),
                $this->metadata('insurance_amount', 'decimal', '15,3'),
                $this->metadata('insurance_maturity', 'int', 11),
                $this->metadata('insurance_bank_transaction', 'varchar', 50),
                $this->metadata('insurance_unpaid_obligation', 'decimal', '15,3'),
                $this->metadata('insurance_salary_withdrawal', 'varchar', 50),
                $this->metadata('paymaster_name', 'varchar', 50),
                $this->metadata('paymaster_address', 'varchar', 50),
                $this->metadata('paymaster_res_cert_no', 'varchar', 50),
                $this->metadata('paymaster_res_cert_issued_at', 'varchar', 50),
                $this->metadata('paymaster_res_cert_date', 'date'),
                $this->metadata('paymaster_deduct_salary', 'varchar', 3, 'NOT NULL', 'NULL', '', "'Yes,No'"),
                $this->metadata('paymaster_client_deduct_salary', 'varchar', 3, 'NOT NULL', 'NULL', '', "'Yes,No'"),
                $this->metadata('paymaster_conformity', 'varchar', 3, 'NOT NULL', 'NULL', '', "'Yes,No'"),
                $default['date_added'],
                $default['date_last_modified']
            )
        );

        return $this->schemaCreator($tables);
    }
}

// CREATE TABLE `tbl_client_insurance` (
//     `client_insurance_id` INT(11) NOT NULL AUTO_INCREMENT,
//     `client_id` INT(11) NOT NULL DEFAULT '0',
//     `insurance_id` INT(11) NOT NULL DEFAULT '0',
//     `insurance_amount` DECIMAL(15,3) NOT NULL DEFAULT '0.000',
//     `insurance_maturity` INT(11) NOT NULL DEFAULT '0',
//     `insurance_bank_transaction` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `insurance_unpaid_obligation` DECIMAL(15,3) NULL DEFAULT NULL,
//     `insurance_salary_withdrawal` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `paymaster_name` VARCHAR(150) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `paymaster_address` VARCHAR(150) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `paymaster_res_cert_no` VARCHAR(150) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `paymaster_res_cert_issued_at` VARCHAR(150) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
//     `paymaster_res_cert_date` DATE NOT NULL DEFAULT '0000-00-00',
//     `paymaster_deduct_salary` VARCHAR(3) NULL DEFAULT NULL COMMENT 'Yes,No' COLLATE 'latin1_swedish_ci',
//     `paymaster_client_deduct_salary` VARCHAR(3) NULL DEFAULT NULL COMMENT 'Yes,No' COLLATE 'latin1_swedish_ci',
//     `paymaster_conformity` VARCHAR(3) NULL DEFAULT NULL COMMENT 'Yes,No' COLLATE 'latin1_swedish_ci',
//     `date_added` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
//     `date_last_modified` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
//     PRIMARY KEY (`client_insurance_id`) USING BTREE
// )
// COLLATE='latin1_swedish_ci'
// ENGINE=InnoDB
// ;
