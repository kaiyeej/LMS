<?php

class Clients extends Connection
{
    private $table = 'tbl_clients';
    public $pk = 'client_id';
    public $name = 'client_fname';

    public $inputs;

    public function add()
    {
        $client_fname = $this->clean($this->inputs['client_fname']);
        $client_mname = $this->clean($this->inputs['client_mname']);
        $client_lname = $this->clean($this->inputs['client_lname']);
        $client_name_extension = $this->clean($this->inputs['client_name_extension']);
        $branch_id = $this->clean($this->inputs['branch_id']);

        $is_exist = $this->select($this->table, $this->pk, "client_fname = '$client_fname' AND client_mname = '$client_mname' AND client_lname='$client_lname' AND client_name_extension='$client_name_extension'");

        if ($is_exist->num_rows > 0)
            return -2;

        $form = array(
            'branch_id'             => $branch_id,
            'client_fname'          => $client_fname,
            'client_mname'          => $client_mname,
            'client_lname'          => $client_lname,
            'client_name_extension' => $client_name_extension,
            'client_type_id'        => $this->clean($this->inputs['client_type_id']),
            'client_dob'            => $this->clean($this->inputs['client_dob']),
            'client_contact_no'     => $this->clean($this->inputs['client_contact_no']),
            'client_civil_status'   => $this->clean($this->inputs['client_civil_status']),
        );

        $client_id = $this->insert($this->table, $form, 'Y');
        if ($client_id < 1)
            return 0;

        $client_modules = ['ClientResidence', 'ClientEmployment'];
        foreach ($client_modules as $ModuleClass) {
            $ModuleInstance = new $ModuleClass;
            $ModuleInstance->inputs = $this->inputs;
            $ModuleInstance->inputs['client_id'] = $client_id;
            $ModuleInstance->addOrUpdate();
        }
        return $client_id;
    }

    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
        $client_fname = $this->clean($this->inputs['client_fname']);
        $client_mname = $this->clean($this->inputs['client_mname']);
        $client_lname = $this->clean($this->inputs['client_lname']);
        $client_name_extension = $this->clean($this->inputs['client_name_extension']);
        $branch_id = $this->clean($this->inputs['branch_id']);

        $client_types = implode(',', $this->inputs['client_type_id']);

        $is_exist = $this->select($this->table, $this->pk, "client_fname = '$client_fname' AND client_mname = '$client_mname' AND client_lname='$client_lname' AND client_name_extension='$client_name_extension' AND $this->pk != '$primary_id'");
        if ($is_exist->num_rows > 0)
            return 2;

        $form = array(
            'branch_id'             => $branch_id,
            'client_fname'          => $client_fname,
            'client_mname'          => $client_mname,
            'client_lname'          => $client_lname,
            'client_name_extension' => $client_name_extension,
            'client_type_id'        => $client_types,
            'client_dob'            => $this->clean($this->inputs['client_dob']),
            'client_contact_no'     => $this->clean($this->inputs['client_contact_no']),
            'client_civil_status'   => $this->clean($this->inputs['client_civil_status']),
        );

        $is_updated = $this->update($this->table, $form, "$this->pk = '$primary_id'");
        if ($is_updated) {
            $client_modules = ['ClientResidence', 'ClientEmployment', 'ClientSpouse', 'ClientDependent', 'ClientSoi', 'ClientAtm', 'ClientBusiness', 'ClientInsurance', 'ClientReference'];

            foreach ($client_modules as $ModuleClass) {
                $ModuleInstance = new $ModuleClass;
                $ModuleInstance->inputs = $this->inputs;
                $ModuleInstance->inputs['client_id'] = $primary_id;
                $ModuleInstance->addOrUpdate();
            }
        }
        return $is_updated;
    }

    public function update_personal_information()
    {
        $primary_id = $this->inputs[$this->pk];
        $client_fname = $this->clean($this->inputs['client_fname']);
        $client_mname = $this->clean($this->inputs['client_mname']);
        $client_lname = $this->clean($this->inputs['client_lname']);
        $client_name_extension = $this->clean($this->inputs['client_name_extension']);
        $branch_id = $this->clean($this->inputs['branch_id']);
        $client_types = implode(',', $_POST['client_type_id']);

        $is_exist = $this->select($this->table, $this->pk, "client_fname = '$client_fname' AND client_mname = '$client_mname' AND client_lname='$client_lname' AND client_name_extension='$client_name_extension' AND $this->pk != '$primary_id'");
        if ($is_exist->num_rows > 0)
            return 2;

        $form = array(
            'branch_id'             => $branch_id,
            'client_fname'          => $client_fname,
            'client_mname'          => $client_mname,
            'client_lname'          => $client_lname,
            'client_name_extension' => $client_name_extension,
            'client_type_id'        => $client_types,
            'client_dob'            => $this->clean($this->inputs['client_dob']),
            'client_contact_no'     => $this->clean($this->inputs['client_contact_no']),
            'client_civil_status'   => $this->clean($this->inputs['client_civil_status']),

        );

        $is_updated = $this->update($this->table, $form, "$this->pk = '$primary_id'");
        if ($is_updated) {
            $client_modules = ['ClientResidence', 'ClientEmployment'];

            foreach ($client_modules as $ModuleClass) {
                $ModuleInstance = new $ModuleClass;
                $ModuleInstance->inputs = $this->inputs;
                $ModuleInstance->inputs['client_id'] = $primary_id;
                $ModuleInstance->addOrUpdate();
            }
        }
        return $is_updated;
    }

    public function update_additional_information()
    {
        $primary_id = $this->inputs[$this->pk];

        $client_modules = ['ClientSpouse', 'ClientDependent'];

        foreach ($client_modules as $ModuleClass) {
            $ModuleInstance = new $ModuleClass;
            $ModuleInstance->inputs = $this->inputs;
            $ModuleInstance->inputs['client_id'] = $primary_id;
            $ModuleInstance->addOrUpdate();
        }

        return 1;
    }

    public function update_source_of_income()
    {
        $primary_id = $this->inputs[$this->pk];

        $client_modules = ['ClientSoi', 'ClientReference', 'ClientBusiness', 'ClientAtm'];

        foreach ($client_modules as $ModuleClass) {
            $ModuleInstance = new $ModuleClass;
            $ModuleInstance->inputs = $this->inputs;
            $ModuleInstance->inputs['client_id'] = $primary_id;
            $ModuleInstance->addOrUpdate();
        }

        return 1;
    }

    public function update_insurance()
    {
        $primary_id = $this->inputs[$this->pk];

        $client_modules = ['ClientInsurance'];

        foreach ($client_modules as $ModuleClass) {
            $ModuleInstance = new $ModuleClass;
            $ModuleInstance->inputs = $this->inputs;
            $ModuleInstance->inputs['client_id'] = $primary_id;
            $ModuleInstance->addOrUpdate();
        }

        return 1;
    }

    public function show()
    {
        $ClientResidence = new ClientResidence;
        $rows = array();
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
            $row['client_fullname'] = $row['client_fname'] . " " . $row['client_mname'] . " " . $row['client_lname'] . " " . $row['client_name_extension'];
            $row['account_id'] = $row['client_id'];
            $row['client_address'] = $ClientResidence->nameByClient($row['client_id']);
            $rows[] = $row;
        }
        return $rows;
    }

    public function view()
    {
        $primary_id = $this->inputs['id'];
        $result = $this->select($this->table, "*", "$this->pk = '$primary_id'");
        $row = $result->fetch_assoc();

        $bithdayDate = $row['client_dob'];
        $date = new DateTime($bithdayDate);
        $now = new DateTime();
        $interval = $now->diff($date);

        // $row['client_insurance'] = $Insurance->name($row['insurance_id']);
        $row['client_fullname'] = $row['client_fname'] . " " . $row['client_mname'] . " " . $row['client_lname'] . " " . $row['client_name_extension'];
        $row['client_age'] = $interval->y;


        $client_modules = ['ClientResidence', 'ClientEmployment', 'ClientSpouse', 'ClientDependent', 'ClientSoi', 'ClientAtm', 'ClientReference', 'ClientBusiness', 'ClientInsurance'];

        foreach ($client_modules as $ModuleClass) {
            $ModuleInstance = new $ModuleClass;
            $ModuleInstance->inputs['client_id'] = $primary_id;
            $module_data = $ModuleInstance->view();
            if (count($module_data) > 0) {
                $new_array = array_merge($row, $module_data);
            } else {
                $new_array = $row;
            }

            $row = $new_array;
        }

        return $new_array;
    }

    public function remove()
    {
        $ids = implode(",", $this->inputs['ids']);
        return $this->delete($this->table, "$this->pk IN($ids)");
    }

    public function name($primary_id)
    {
        $result = $this->select($this->table, 'client_fname,client_mname,client_lname,client_name_extension', "$this->pk = '$primary_id'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['client_fname'] . " " . $row['client_mname'] . " " . $row['client_lname'] . " " . $row['client_name_extension'];
        } else {
            return "---";
        }
    }

    public function getBranch($primary_id)
    {
        $result = $this->select($this->table, 'branch_id', "$this->pk = '$primary_id'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['branch_id'];
        } else {
            return null;
        }
    }

    public function formal_name($primary_id)
    {
        $result = $this->select($this->table, 'client_fname,client_mname,client_lname,client_name_extension', "$this->pk = '$primary_id'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['client_lname'] . ", " . $row['client_fname'] . " " . $row['client_mname'] . " " . $row['client_name_extension'];
        } else {
            return "---";
        }
    }

    public function delete_entry()
    {
        $id = $this->inputs['id'];

        return $this->delete($this->table, "$this->pk = $id");
    }

    public function delete_property()
    {
        $id = $this->inputs['id'];

        return $this->delete('tbl_property_owned', "property_id = $id");
    }

    public function delete_child()
    {
        $id = $this->inputs['id'];

        return $this->delete('tbl_children', "child_id = $id");
    }

    public function addProperty()
    {

        $property_location = $this->clean($this->inputs['property_location']);
        $form = array(
            $this->pk                   => $this->inputs[$this->pk],
            'property_location'         => $property_location,
            'property_area'             => $this->clean($this->inputs['property_area']),
            'property_acquisition_cost' => $this->clean($this->inputs['property_acquisition_cost']),
            'property_pres_market_val'  => $this->clean($this->inputs['property_pres_market_val']),
            'property_improvement'      => $this->clean($this->inputs['property_improvement']),

        );

        return $this->insertIfNotExist("tbl_property_owned", $form, "property_location = '" . $property_location . "' AND $this->pk='" . $this->inputs[$this->pk] . "'");
    }



    public function showProperty()
    {
        $rows = array();
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $result = $this->select("tbl_property_owned", '*', $param);
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function get_property()
    {
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = "";
        $result = $this->select("tbl_property_owned", '*', $param);
        while ($row = $result->fetch_assoc()) {

            $rows .=    '<div class="col-md-3"><h6>' . $row['property_location'] . '</h6></div>' .
                '<div class="col-md-2"><h6>' . $row['property_area'] . '</h6></div>' .
                '<div class="col-md-2"><h6>' . $row['property_acquisition_cost'] . '</h6></div>' .
                '<div class="col-md-2"><h6>' . $row['property_pres_market_val'] . '</h6></div>' .
                '<div class="col-md-3"><h6>' . $row['property_improvement'] . '</h6></div>';
        }
        return $rows;
    }

    public function get_children()
    {
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = "";
        $result = $this->select("tbl_children", '*', $param);
        while ($row = $result->fetch_assoc()) {

            $rows .=    '<div class="col-md-3"><h6>' . $row['child_name'] . '</h6></div>' .
                '<div class="col-md-2"><h6>' . $row['child_sex'] . '</h6></div>' .
                '<div class="col-md-2"><h6>' . $row['child_age'] . '</h6></div>' .
                '<div class="col-md-5"><h6>' . $row['child_occupation'] . '</h6></div>';
        }
        return $rows;
    }

    public function showChildren()
    {
        $rows = array();
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $result = $this->select("tbl_children", '*', $param);
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function addChildren()
    {

        $child_name = $this->clean($this->inputs['child_name']);
        $form = array(
            $this->pk                   => $this->inputs[$this->pk],
            'child_name'                => $child_name,
            'child_age'                 => $this->clean($this->inputs['child_age']),
            'child_sex'                 => $this->clean($this->inputs['child_sex']),
            'child_occupation'          => $this->clean($this->inputs['child_occupation'])

        );

        return $this->insertIfNotExist("tbl_children", $form, "child_name = '" . $child_name . "' AND $this->pk='" . $this->inputs[$this->pk] . "'");
    }

    public function idByFullname($fullname)
    {
        $result = $this->select($this->table, 'client_id', "UCASE(CONCAT(client_fname,IF(client_mname != '', CONCAT(' ',client_mname),''),' ',client_lname,IF(client_name_extension != '', CONCAT(' ',client_name_extension),''))) = UCASE('$fullname')");

        if ($result->num_rows < 1)
            return 0;

        $row = $result->fetch_assoc();
        return $row['client_id'];
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
        $clients_data = [];
        $count = 0;
        $success_import = 0;
        $unsuccess_import = 0;
        $Employers = new Employers;
        $Insurance = new Insurance;
        foreach ($csvData as $row) {
            if ($count > 0) {

                $form = [
                    'branch_id'             => $row[0] ? $branches[$row[0]] : 1,
                    'client_fname'          => $row[1],
                    'client_mname'          => $row[2],
                    'client_lname'          => $row[3],
                    'client_name_extension' => $row[4],
                    'client_civil_status'   => $row[5],
                    'client_dob'            => date("Y-m-d", strtotime($row[6])),
                    'client_contact_no'     => $row[7],
                    'residence'             => $row[8],
                    'residence_status'      => $row[9],
                    'residence_certificate_no'  => $row[10],
                    'certificate_issued_at' => $row[11],
                    'certificate_date'      => $row[12],
                    'employer_id'           => $Employers->idByName($this->clean($row[13])),
                    'employer_address'      => $row[14],
                    'employer_contact_no'   => $row[15],
                    'employment_position'   => $row[16],
                    'employment_income'     => $row[17],
                    'employment_status'     => $row[18],
                    'employment_length'     => $row[19],
                    'last_employment'       => $row[20],
                    'spouse_name'                   => $row[21],
                    'spouse_residence'              => $row[22],
                    'spouse_res_cert_no'            => $row[23],
                    'spouse_res_cert_issued_at'     => $row[24],
                    'spouse_res_cert_date'          => $row[25],
                    'spouse_employer'               => $row[26],
                    'spouse_employer_address'       => $row[27],
                    'spouse_employer_contact'       => $row[28],
                    'spouse_employment_position'    => $row[29],
                    'spouse_employment_income'      => $row[30],
                    'spouse_employment_length'      => $row[31],
                    'spouse_last_employment'        => $row[32],
                    'spouse_employment_status'      => $row[33],
                    'no_of_children'    => $row[34],
                    'dep_no_of_child'   => $row[35],
                    'dep_college'       => $row[36],
                    'dep_hs'            => $row[37],
                    'dep_elem'          => $row[38],
                    'soi_name'          => $row[39],
                    'soi_by'            => $row[40],
                    'soi_monthly'       => $row[41],
                    'client_credit_ref_name1'       => $row[42],
                    'client_credit_ref_address1'    => $row[43],
                    'client_credit_ref_name2'       => $row[44],
                    'client_credit_ref_address2'    => $row[45],
                    'client_credit_ref_name3'       => $row[46],
                    'client_credit_ref_address3'    => $row[47],
                    'soi_total'         => $row[48],
                    'soi_obligation'    => $row[49],
                    'business_name'     => $row[50],
                    'business_address'  => $row[51],
                    'business_contact'  => $row[52],
                    'business_position' => $row[53],
                    'business_kind'     => $row[54],
                    'business_length'   => $row[55],
                    'business_capital'  => $row[56],
                    'business_type'     => $row[57],
                    'insurance_id'      => $Insurance->idByName($this->clean($row[58])),
                    'insurance_amount'  => $row[59],
                    'insurance_maturity'    => $row[60],
                    'insurance_bank_transaction'    => $row[61],
                    'insurance_unpaid_obligation'   => $row[62],
                    'insurance_salary_withdrawal'   => $row[63],
                    'paymaster_name'                => $row[64],
                    'paymaster_address'             => $row[65],
                    'paymaster_res_cert_no'          => $row[66],
                    'paymaster_res_cert_issued_at'   => $row[67],
                    'paymaster_res_cert_date'        => $row[68]
                ];

                if ($row[69] == 'Yes')
                    $form['client_paymaster_deduct_salary'] = "Yes";

                if ($row[70] == 'Yes')
                    $form['client_paymaster_client_deduct_salary'] = "Yes";

                if ($row[71] == 'Yes')
                    $form['client_paymaster_conformity'] = "Yes";

                $form['client_type_id'] = 0;
                $form['atm_account_no'] = "";
                $form['atm_bank'] = "";
                $form['employer'] = $row[13];

                $Clients = new Clients;
                $Clients->inputs = $form;
                $client_id = $row[1] != '' ? $Clients->add() : 0;

                if ($client_id == -2) {
                    $form['import_status'] = 0;
                    $unsuccess_import += 1;
                } else if ($client_id == 0) {
                    $form['import_status'] = 0;
                    $unsuccess_import += 1;
                } else {
                    $form['import_status'] = 1;
                    $success_import += 1;
                    $form['client_id'] = $client_id;
                    $Clients->inputs['client_id'] = $client_id;
                    $Clients->edit();
                }

                $location_list = [];
                $children_list = [];

                if ($client_id > 0) {

                    $locations = [72, 77];
                    foreach ($locations as $location) {
                        $property_location = $row[$location];
                        $property_area = $row[$location + 1];
                        $property_acquisition_cost = $row[$location + 2];
                        $property_pres_market_val = $row[$location + 3];
                        $property_improvement = $row[$location + 4];

                        $Clients = new Clients;
                        if ($property_location != "") {
                            $Clients->inputs['client_id'] = $client_id;
                            $Clients->inputs['property_location'] = $property_location;
                            $Clients->inputs['property_area'] = $property_area;
                            $Clients->inputs['property_acquisition_cost'] = $property_acquisition_cost;
                            $Clients->inputs['property_pres_market_val'] = $property_pres_market_val;
                            $Clients->inputs['property_improvement'] = $property_improvement;
                            $Clients->addProperty();
                            $location_list[] = $property_location;
                        }
                    }


                    $childrens = [82, 86, 90, 94, 98];
                    foreach ($childrens as $children) {
                        $child_name = $row[$children];
                        $child_age = $row[$children + 1];
                        $child_sex = $row[$children + 2];
                        $child_occupation = $row[$children + 3];

                        $Clients = new Clients;
                        if ($child_name != "") {
                            $Clients->inputs['client_id'] = $client_id;
                            $Clients->inputs['child_name'] = $child_name;
                            $Clients->inputs['child_age'] = $child_age;
                            $Clients->inputs['child_sex'] = $child_sex;
                            $Clients->inputs['child_occupation'] = $child_occupation;
                            $Clients->addChildren();
                            $children_list[] = $child_name;
                        }
                    }
                }

                $form['locations'] = $location_list;
                $form['childrens'] = $children_list;
                $clients_data[] = $form;
            }
            $count++;
        }
        $response['status'] = 1;
        $response['clients'] = $clients_data;
        $response['success_import'] = $success_import;
        $response['unsuccess_import'] = $unsuccess_import;
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
                    $this->metadata('branch_id', 'int', 11),
                    $this->metadata('client_type_id', 'int', 11),
                    $this->metadata('client_fname', 'varchar', 50),
                    $this->metadata('client_mname', 'varchar', 50),
                    $this->metadata('client_lname', 'varchar', 50),
                    $this->metadata('client_name_extension', 'varchar', 5),
                    $this->metadata('client_dob', 'date'),
                    $this->metadata('client_contact_no', 'varchar', 30),
                    $this->metadata('client_civil_status', 'varchar', 10),
                    $default['date_added'],
                    $default['date_last_modified']
                )
            );

            return $this->schemaCreator($tables);
        }
    }
}


// CREATE TABLE `tbl_clients` (
//     `client_id` INT(11) NOT NULL AUTO_INCREMENT,
//     `branch_id` INT(11) NOT NULL,
//     `client_type_id` INT(11) NOT NULL,
//     `client_fname` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci',
//     `client_mname` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci',
//     `client_lname` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci',
//     `client_name_extension` VARCHAR(5) NOT NULL COLLATE 'utf8mb4_general_ci',
//     `client_dob` DATE NOT NULL,
//     `client_contact_no` VARCHAR(30) NOT NULL COLLATE 'utf8mb4_general_ci',
//     `client_civil_status` VARCHAR(10) NOT NULL COMMENT 'Single, Married, Widowed, Seperated' COLLATE 'utf8mb4_general_ci',
//     `date_added` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
//     `date_last_modified` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
//     PRIMARY KEY (`client_id`) USING BTREE
// )
// COLLATE='utf8mb4_general_ci'
// ENGINE=InnoDB
// AUTO_INCREMENT=22
// ;
