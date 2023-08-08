<?php

class Insurance extends Connection
{
    private $table = 'tbl_insurance';
    public $pk = 'insurance_id';
    public $name = 'insurance_name';

    public $inputs;

    public function add()
    {
        $form = array(
            $this->name         => $this->clean($this->inputs[$this->name]),
            'insurance_desc'    => $this->clean($this->inputs['insurance_desc']),
            'insurance_amount'  => $this->clean($this->inputs['insurance_amount']),
        );

        return $this->insertIfNotExist($this->table, $form, "$this->name = '" . $this->inputs[$this->name] . "'");
    }

    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
        $form = array(
            $this->name         => $this->clean($this->inputs[$this->name]),
            'insurance_desc'    => $this->clean($this->inputs['insurance_desc']),
            'insurance_amount'  => $this->clean($this->inputs['insurance_amount']),
        );

        return $this->updateIfNotExist($this->table, $form, "$this->pk = '$primary_id'");
    }

    public function show()
    {
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function view()
    {
        $primary_id = $this->inputs['id'];
        $result = $this->select($this->table, "*", "$this->pk = '$primary_id'");
        return $result->fetch_assoc();

        if ($result->num_rows < 1)
            return array(
                'insurance_id'                      => '',
                'insurance'                         => '',
                'insurance_amount'                  => 0,
                'insurance_bank_transaction'        => '',
                'insurance_maturity'                => 0,
                'insurance_salary_withdrawal'       => '',
                'insurance_unpaid_obligation'       => 0,
                'paymaster_address'                 => '',
                'paymaster_client_deduct_salary'    => '',
                'paymaster_conformity'              => '',
                'paymaster_deduct_salary'           => '',
                'paymaster_name'                    => '',
                'paymaster_res_cert_date'           => '',
                'paymaster_res_cert_issued_at'      => '',
                'paymaster_res_cert_no'             => '',
            );





        $row = $result->fetch_assoc();
        return $row;
    }

    public function remove()
    {
        $ids = implode(",", $this->inputs['ids']);

        return $this->delete($this->table, "$this->pk IN($ids)");
    }

    public function name($primary_id)
    {
        $result = $this->select($this->table, 'insurance_name', "$this->pk = '$primary_id'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['insurance_name'];
        } else {
            return null;
        }
    }

    public function idByName($name)
    {
        $result = $this->select($this->table, $this->pk, "UCASE(insurance_name) = UCASE('$name')");

        if ($result->num_rows < 1)
            return 0;

        $row = $result->fetch_assoc();
        return $row[$this->pk];
    }

    public function import()
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 0);

        $response = [];
        $file = $_FILES['csv_file'];
        $fileType = pathinfo($file['name'], PATHINFO_EXTENSION);
        if ($fileType != 'csv') {
            $response['status'] = -1;
            $response['text'] = 'Invalid file format. Only CSV files are allowed.';
            return $response;
        }

        // Read the CSV file data
        $csvData = array();
        if (($handle = fopen($file['tmp_name'], 'r')) !== false) {
            while (($row = fgetcsv($handle)) !== false) {
                $csvData[] = $row;
            }
            fclose($handle);
        } else {
            $response['status'] = -1;
            $response['text'] = 'Failed to read the CSV file.';
            return $response;
        }

        // Display the processed data
        $branches = ["BCD" => 1, "LC" => 2];
        $insurance_data = [];
        $count = 0;
        $success_import = 0;
        $unsuccess_import = 0;
        foreach ($csvData as $row) {
            if ($count > 0) {
                $form = [
                    'branch_id'         => $row[0] ? $branches[$row[0]] : 1,
                    'insurance_name'    => $row[1],
                    'insurance_amount'  => $row[2],
                    'insurance_desc'    => $row[3]
                ];

                $Insurance = new Insurance;
                $Insurance->inputs = $form;
                $client_id = $row[1] != '' ? $Insurance->add() : 0;

                if ($client_id == 2) {
                    $form['import_status'] = 0;
                    $unsuccess_import += 1;
                } else if ($client_id == 0) {
                    $form['import_status'] = 0;
                    $unsuccess_import += 1;
                } else {
                    $form['import_status'] = 1;
                    $success_import += 1;
                }

                $insurance_data[] = $form;
            }
            $count++;
        }
        $response['status'] = 1;
        $response['insurances'] = $insurance_data;
        $response['success_import'] = $success_import;
        $response['unsuccess_import'] = $unsuccess_import;
        return $response;
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
                $this->metadata($this->name, 'decimal', "12,4"),
                $this->metadata('insurance_desc', 'varchar', 250),
                $this->metadata('insurance_amount', 'decimal', "12,4"),
                $default['date_added'],
                $default['date_last_modified']
            )
        );

        return $this->schemaCreator($tables);
    }
}
