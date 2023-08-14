<?php

class Suppliers extends Connection
{
    private $table = 'tbl_suppliers';
    public $pk = 'supplier_id';
    public $name = 'supplier_name';

    public $inputs;

    public function add()
    {
        $form = array(
            $this->name             => $this->clean($this->inputs[$this->name]),
            'branch_id'             => $this->clean($this->inputs['branch_id']),
            'supplier_address'      => $this->clean($this->inputs['supplier_address']),
            'supplier_contact_no'   => $this->clean($this->inputs['supplier_contact_no']),
            'remarks'               => $this->clean($this->inputs['remarks']),
        );

        return $this->insertIfNotExist($this->table, $form, "$this->name = '" . $this->inputs[$this->name] . "'");
    }

    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
        $form = array(
            $this->name             => $this->clean($this->inputs[$this->name]),
            'branch_id'             => $this->clean($this->inputs['branch_id']),
            'supplier_address'      => $this->clean($this->inputs['supplier_address']),
            'supplier_contact_no'   => $this->clean($this->inputs['supplier_contact_no']),
            'remarks'               => $this->clean($this->inputs['remarks']),
        );

        return $this->updateIfNotExist($this->table, $form, "$this->pk = '$primary_id'");
    }

    public function show()
    {
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $Branches = new Branches;
        $rows = array();
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
            $row['account_id'] = $row['supplier_id'];
            $row['branch'] = $Branches->name($row['branch_id']);
            $rows[] = $row;
        }
        return $rows;
    }

    public function view()
    {
        $primary_id = $this->inputs['id'];
        $result = $this->select($this->table, "*", "$this->pk = '$primary_id'");
        return $result->fetch_assoc();
    }

    public function remove()
    {
        $ids = implode(",", $this->inputs['ids']);

        return $this->delete($this->table, "$this->pk IN($ids)");
    }

    public function name($primary_id)
    {
        $result = $this->select($this->table, 'supplier_name', "$this->pk = '$primary_id'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['supplier_name'];
        } else {
            return null;
        }
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
        $suppliers_data = [];
        $count = 0;
        $success_import = 0;
        $unsuccess_import = 0;
        foreach ($csvData as $row) {
            if ($count > 0) {
                $form = [
                    'supplier_name'         => $row[0],
                    'supplier_contact_no'   => $row[1],
                    'supplier_address'      => $row[2],
                    'remarks'               => $row[3]
                ];

                $Suppliers = new Suppliers;
                $Suppliers->inputs = $form;
                $client_id = $row[0] != '' ? $Suppliers->add() : 0;

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

                $suppliers_data[] = $form;
            }
            $count++;
        }
        $response['status'] = 1;
        $response['suppliers'] = $suppliers_data;
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
                $this->metadata($this->name, 'varchar', 50),
                $this->metadata('branch_id', 'int', 11),
                $this->metadata('supplier_address', 'varchar', 250),
                $this->metadata('supplier_contact_no', 'varchar', 15),
                $this->metadata('remarks', 'varchar', 250),
                $default['date_added'],
                $default['date_last_modified']
            )
        );

        return $this->schemaCreator($tables);
    }

    public function triggers()
    {
        // HEADER
        $triggers[] = array(
            'table' => $this->table,
            'name' => 'delete_' . $this->table,
            'action_time' => 'BEFORE', // ['AFTER','BEFORE']
            'event' => "DELETE", // ['INSERT','UPDATE', 'DELETE']
            "statement" => "INSERT INTO " . $this->table . "_deleted SELECT * FROM $this->table WHERE $this->pk = OLD.$this->pk"
        );
        return $this->triggerCreator($triggers);
    }
}
