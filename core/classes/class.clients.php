<?php

class Clients extends Connection
{
    private $table = 'tbl_clients';
    public $pk = 'client_id';
    public $name = 'client_fname';

    public function add()
    {
        $client_fname = $this->clean($this->inputs['client_fname']);
        $client_mname = $this->clean($this->inputs['client_mname']);
        $client_lname = $this->clean($this->inputs['client_lname']);
        $client_name_extension = $this->clean($this->inputs['client_name_extension']);

        $is_exist = $this->select($this->table, $this->pk, "client_fname = '$client_fname' AND client_mname = '$client_mname' AND client_lname='$client_lname' AND client_name_extension='$client_name_extension'");

        if ($is_exist->num_rows > 0) {
            return -2;
        } else {
            $form = array(
                'client_fname'                      => $client_fname,
                'client_mname'                      => $client_mname,
                'client_lname'                      => $client_lname,
                'client_name_extension'             => $client_name_extension,
                'client_address'                    => $this->clean($this->inputs['client_address']),
                'client_dob'                        => $this->clean($this->inputs['client_dob']),
                'client_contact_no'                 => $this->clean($this->inputs['client_contact_no']),     'client_civil_status'               => $this->clean($this->inputs['client_civil_status']),
                'client_address'                    => $this->clean($this->inputs['client_address']),     'client_address_status'             => $this->clean($this->inputs['client_address_status']),
                'client_res_cert_no'                => $this->clean($this->inputs['client_res_cert_no']),     'client_res_cert_issued_at'         => $this->clean($this->inputs['client_res_cert_issued_at']),
                'client_res_cert_date'              => $this->clean($this->inputs['client_res_cert_date']),
                'client_employer'                   => $this->clean($this->inputs['client_employer']),
                'client_employer_address'           => $this->clean($this->inputs['client_employer_address']),
                'client_employer_contact_no'        => $this->clean($this->inputs['client_employer_contact_no']),
                'client_emp_position'               => $this->clean($this->inputs['client_emp_position']),
                'client_emp_income'                 => $this->clean($this->inputs['client_emp_income']),
                'client_emp_status'                 => $this->clean($this->inputs['client_emp_status']),
                'client_emp_length'                 => $this->clean($this->inputs['client_emp_length']),
                'client_prev_emp'                   => $this->clean($this->inputs['client_prev_emp']),

            );
            return $this->insert($this->table, $form, 'Y');
        }
    }

    public function edit()
    {
        $primary_id = $this->inputs[$this->pk];
        $client_fname = $this->clean($this->inputs['client_fname']);
        $client_mname = $this->clean($this->inputs['client_mname']);
        $client_lname = $this->clean($this->inputs['client_lname']);
        $client_name_extension = $this->clean($this->inputs['client_name_extension']);

        $client_paymaster_deduct_salary = (!isset($this->inputs['client_paymaster_deduct_salary']) ? "No" : "Yes");
        $client_paymaster_client_deduct_salary = (!isset($this->inputs['client_paymaster_client_deduct_salary']) ? "No" : "Yes");
        $client_paymaster_conformity = (!isset($this->inputs['client_paymaster_conformity']) ? "No" : "Yes");


        $is_exist = $this->select($this->table, $this->pk, "client_fname = '$client_fname' AND client_mname = '$client_mname' AND client_lname='$client_lname' AND client_name_extension='$client_name_extension' AND $this->pk != '$primary_id'");
        if ($is_exist->num_rows > 0) {
            return 2;
        } else {
            $form = array(
                'client_fname'                      => $client_fname,
                'client_mname'                      => $client_mname,
                'client_lname'                      => $client_lname,
                'client_name_extension'             => $client_name_extension,
                'client_address'                    => $this->clean($this->inputs['client_address']),
                'client_dob'                        => $this->clean($this->inputs['client_dob']),
                'client_contact_no'                 => $this->clean($this->inputs['client_contact_no']),     'client_civil_status'               => $this->clean($this->inputs['client_civil_status']),
                'client_address'                    => $this->clean($this->inputs['client_address']),     'client_address_status'             => $this->clean($this->inputs['client_address_status']),
                'client_res_cert_no'                => $this->clean($this->inputs['client_res_cert_no']),     'client_res_cert_issued_at'         => $this->clean($this->inputs['client_res_cert_issued_at']),
                'client_res_cert_date'              => $this->clean($this->inputs['client_res_cert_date']), 'client_employer'                   => $this->clean($this->inputs['client_employer']), 'client_employer_address'           => $this->clean($this->inputs['client_employer_address']), 'client_employer_contact_no'        => $this->clean($this->inputs['client_employer_contact_no']),
                'client_emp_position'               => $this->clean($this->inputs['client_emp_position']), 'client_emp_income'                 => $this->clean($this->inputs['client_emp_income']), 'client_emp_status'                 => $this->clean($this->inputs['client_emp_status']), 'client_emp_length'                 => $this->clean($this->inputs['client_emp_length']), 'client_prev_emp'                   => $this->clean($this->inputs['client_prev_emp']),

                'client_spouse'                     => $this->clean($this->inputs['client_spouse']),
                'client_spouse_address'             => $this->clean($this->inputs['client_spouse_address']),
                'client_spouse_res_cert_no'         => $this->clean($this->inputs['client_spouse_res_cert_no']),
                'client_spouse_res_cert_issued_at'  => $this->clean($this->inputs['client_spouse_res_cert_issued_at']),
                'client_spouse_res_cert_date'       => $this->clean($this->inputs['client_spouse_res_cert_date']),
                'client_spouse_employer'            => $this->clean($this->inputs['client_spouse_employer']),
                'client_spouce_employer_address'           => $this->clean($this->inputs['client_spouce_employer_address']),
                'client_spouce_employer_contact_no' => $this->clean($this->inputs['client_spouce_employer_contact_no']),
                'client_spouse_position'            => $this->clean($this->inputs['client_spouse_position']),
                'client_spouse_income'              => $this->clean($this->inputs['client_spouse_income']),
                'client_spouse_emp_status'          => $this->clean($this->inputs['client_spouse_emp_status']),
                'client_spouse_leng_emp'            => $this->clean($this->inputs['client_spouse_leng_emp']),
                'client_spouse_prev_employment'     => $this->clean($this->inputs['client_spouse_prev_employment']),
                'client_no_of_childred'             => $this->clean($this->inputs['client_no_of_childred']),
                'client_no_of_child_dependent'      => $this->clean($this->inputs['client_no_of_child_dependent']),
                'client_no_of_child_college'        => $this->clean($this->inputs['client_no_of_child_college']),
                'client_no_of_child_hs'             => $this->clean($this->inputs['client_no_of_child_hs']),
                'client_no_of_child_elem'           => $this->clean($this->inputs['client_no_of_child_elem']),

                'client_soi'                        => $this->clean($this->inputs['client_soi']),
                'client_soi_by_whom'                => $this->clean($this->inputs['client_soi_by_whom']),
                'client_soi_monthly_income'         => $this->clean($this->inputs['client_soi_monthly_income']),
                'client_credit_ref_name1'           => $this->clean($this->inputs['client_credit_ref_name1']),
                'client_credit_ref_name1'           => $this->clean($this->inputs['client_credit_ref_name1']),
                'client_credit_ref_address1'        => $this->clean($this->inputs['client_credit_ref_address1']),
                'client_credit_ref_name2'           => $this->clean($this->inputs['client_credit_ref_name2']),
                'client_credit_ref_address2'        => $this->clean($this->inputs['client_credit_ref_address2']),
                'client_credit_ref_name3'           => $this->clean($this->inputs['client_credit_ref_name3']),
                'client_credit_ref_address3'        => $this->clean($this->inputs['client_credit_ref_address3']),
                'client_approx_total_monthly_income' => $this->clean($this->inputs['client_approx_total_monthly_income']),
                'client_total_outstanding_obligation' => $this->clean($this->inputs['client_total_outstanding_obligation']),
                'client_business_name'              => $this->clean($this->inputs['client_business_name']),
                'client_business_address'           => $this->clean($this->inputs['client_business_address']),
                'client_business_tel_no'            => $this->clean($this->inputs['client_business_tel_no']),
                'client_business_position'          => $this->clean($this->inputs['client_business_position']),
                'client_business_kind'              => $this->clean($this->inputs['client_business_kind']),
                'client_business_length'            => $this->clean($this->inputs['client_business_length']),
                'client_business_capital_invested'  => $this->clean($this->inputs['client_business_capital_invested']),
                'client_business_type'              => $this->clean($this->inputs['client_business_type']),

                'insurance_id'                      => $this->clean($this->inputs['insurance_id']),
                'client_insurance_amount'           => $this->clean($this->inputs['client_insurance_amount']),
                'client_insurance_maturity'         => $this->clean($this->inputs['client_insurance_maturity']),
                'client_bank_transaction'           => $this->clean($this->inputs['client_bank_transaction']),
                'client_unpaid_obligation'          => $this->clean($this->inputs['client_unpaid_obligation']),
                'client_salary_withdrawal'          => $this->clean($this->inputs['client_salary_withdrawal']),
                'client_paymaster_name'             => $this->clean($this->inputs['client_paymaster_name']),
                'client_paymaster_residence'        => $this->clean($this->inputs['client_paymaster_residence']),
                'client_paymaster_res_cert_no'      => $this->clean($this->inputs['client_paymaster_res_cert_no']),
                'client_paymaster_res_cert_issued_at'   => $this->clean($this->inputs['client_paymaster_res_cert_issued_at']),
                'client_paymaster_res_cert_date'   => $this->clean($this->inputs['client_paymaster_res_cert_date']),
                'client_paymaster_deduct_salary'   => $this->clean($client_paymaster_deduct_salary),
                'client_paymaster_client_deduct_salary' => $this->clean($client_paymaster_client_deduct_salary),
                'client_paymaster_conformity'           => $this->clean($client_paymaster_conformity)

            );
            return $this->update($this->table, $form, "$this->pk = '$primary_id'");
        }
    }

    public function update_1()
    {
        $primary_id = $this->inputs[$this->pk];
        $client_fname = $this->clean($this->inputs['client_fname']);
        $client_mname = $this->clean($this->inputs['client_mname']);
        $client_lname = $this->clean($this->inputs['client_lname']);
        $client_name_extension = $this->clean($this->inputs['client_name_extension']);


        $is_exist = $this->select($this->table, $this->pk, "client_fname = '$client_fname' AND client_mname = '$client_mname' AND client_lname='$client_lname' AND client_name_extension='$client_name_extension' AND $this->pk != '$primary_id'");
        if ($is_exist->num_rows > 0) {
            return 2;
        } else {
            $form = array(
                'client_fname'                      => $client_fname,
                'client_mname'                      => $client_mname,
                'client_lname'                      => $client_lname,
                'client_name_extension'             => $client_name_extension,
                'client_address'                    => $this->clean($this->inputs['client_address']),
                'client_dob'                        => $this->clean($this->inputs['client_dob']),
                'client_contact_no'                 => $this->clean($this->inputs['client_contact_no']),     'client_civil_status'               => $this->clean($this->inputs['client_civil_status']),
                'client_address'                    => $this->clean($this->inputs['client_address']),     'client_address_status'             => $this->clean($this->inputs['client_address_status']),
                'client_res_cert_no'                => $this->clean($this->inputs['client_res_cert_no']),     'client_res_cert_issued_at'         => $this->clean($this->inputs['client_res_cert_issued_at']),
                'client_res_cert_date'              => $this->clean($this->inputs['client_res_cert_date']), 'client_employer'                   => $this->clean($this->inputs['client_employer']), 'client_employer_address'           => $this->clean($this->inputs['client_employer_address']), 'client_employer_contact_no'        => $this->clean($this->inputs['client_employer_contact_no']),
                'client_emp_position'               => $this->clean($this->inputs['client_emp_position']), 'client_emp_income'                 => $this->clean($this->inputs['client_emp_income']), 'client_emp_status'                 => $this->clean($this->inputs['client_emp_status']), 'client_emp_length'                 => $this->clean($this->inputs['client_emp_length']), 'client_prev_emp'                   => $this->clean($this->inputs['client_prev_emp']),
            );
            return $this->update($this->table, $form, "$this->pk = '$primary_id'");
        }
    }

    public function update_2()
    {
        $primary_id = $this->inputs[$this->pk];

        $form = array(
            'client_spouse'                     => $this->clean($this->inputs['client_spouse']),
            'client_spouse_address'             => $this->clean($this->inputs['client_spouse_address']),
            'client_spouse_res_cert_no'         => $this->clean($this->inputs['client_spouse_res_cert_no']),
            'client_spouse_res_cert_issued_at'  => $this->clean($this->inputs['client_spouse_res_cert_issued_at']),
            'client_spouse_res_cert_date'       => $this->clean($this->inputs['client_spouse_res_cert_date']),
            'client_spouse_employer'            => $this->clean($this->inputs['client_spouse_employer']),
            'client_spouce_employer_address'           => $this->clean($this->inputs['client_spouce_employer_address']),
            'client_spouce_employer_contact_no' => $this->clean($this->inputs['client_spouce_employer_contact_no']),
            'client_spouse_position'            => $this->clean($this->inputs['client_spouse_position']),
            'client_spouse_income'              => $this->clean($this->inputs['client_spouse_income']),
            'client_spouse_emp_status'          => $this->clean($this->inputs['client_spouse_emp_status']),
            'client_spouse_leng_emp'            => $this->clean($this->inputs['client_spouse_leng_emp']),
            'client_spouse_prev_employment'     => $this->clean($this->inputs['client_spouse_prev_employment']),
            'client_no_of_childred'             => $this->clean($this->inputs['client_no_of_childred']),
            'client_no_of_child_dependent'      => $this->clean($this->inputs['client_no_of_child_dependent']),
            'client_no_of_child_college'        => $this->clean($this->inputs['client_no_of_child_college']),
            'client_no_of_child_hs'             => $this->clean($this->inputs['client_no_of_child_hs']),
            'client_no_of_child_elem'           => $this->clean($this->inputs['client_no_of_child_elem']),

        );
        return $this->update($this->table, $form, "$this->pk = '$primary_id'");
    }

    public function update_3()
    {
        $primary_id = $this->inputs[$this->pk];

        $form = array(
            'client_soi'                        => $this->clean($this->inputs['client_soi']),
            'client_soi_by_whom'                => $this->clean($this->inputs['client_soi_by_whom']),
            'client_soi_monthly_income'         => $this->clean($this->inputs['client_soi_monthly_income']),
            'client_credit_ref_name1'           => $this->clean($this->inputs['client_credit_ref_name1']),
            'client_credit_ref_name1'           => $this->clean($this->inputs['client_credit_ref_name1']),
            'client_credit_ref_address1'        => $this->clean($this->inputs['client_credit_ref_address1']),
            'client_credit_ref_name2'           => $this->clean($this->inputs['client_credit_ref_name2']),
            'client_credit_ref_address2'        => $this->clean($this->inputs['client_credit_ref_address2']),
            'client_credit_ref_name3'           => $this->clean($this->inputs['client_credit_ref_name3']),
            'client_credit_ref_address3'        => $this->clean($this->inputs['client_credit_ref_address3']),
            'client_approx_total_monthly_income' => $this->clean($this->inputs['client_approx_total_monthly_income']),
            'client_total_outstanding_obligation' => $this->clean($this->inputs['client_total_outstanding_obligation']),
            'client_business_name'              => $this->clean($this->inputs['client_business_name']),
            'client_business_address'           => $this->clean($this->inputs['client_business_address']),
            'client_business_tel_no'            => $this->clean($this->inputs['client_business_tel_no']),
            'client_business_position'          => $this->clean($this->inputs['client_business_position']),
            'client_business_kind'              => $this->clean($this->inputs['client_business_kind']),
            'client_business_length'            => $this->clean($this->inputs['client_business_length']),
            'client_business_capital_invested'  => $this->clean($this->inputs['client_business_capital_invested']),
            'client_business_type'              => $this->clean($this->inputs['client_business_type']),

        );
        return $this->update($this->table, $form, "$this->pk = '$primary_id'");
    }

    public function update_4()
    {
        $primary_id = $this->inputs[$this->pk];
        
        $client_paymaster_deduct_salary = (!isset($this->inputs['client_paymaster_deduct_salary']) ? "No" : "Yes");
        $client_paymaster_client_deduct_salary = (!isset($this->inputs['client_paymaster_client_deduct_salary']) ? "No" : "Yes");
        $client_paymaster_conformity = (!isset($this->inputs['client_paymaster_conformity']) ? "No" : "Yes");


        $form = array(
            'insurance_id'                      => $this->clean($this->inputs['insurance_id']),
            'client_insurance_amount'           => $this->clean($this->inputs['client_insurance_amount']),
            'client_insurance_maturity'         => $this->clean($this->inputs['client_insurance_maturity']),
            'client_bank_transaction'           => $this->clean($this->inputs['client_bank_transaction']),
            'client_unpaid_obligation'          => $this->clean($this->inputs['client_unpaid_obligation']),
            'client_salary_withdrawal'          => $this->clean($this->inputs['client_salary_withdrawal']),
            'client_paymaster_name'             => $this->clean($this->inputs['client_paymaster_name']),
            'client_paymaster_residence'        => $this->clean($this->inputs['client_paymaster_residence']),
            'client_paymaster_res_cert_no'      => $this->clean($this->inputs['client_paymaster_res_cert_no']),
            'client_paymaster_res_cert_issued_at'   => $this->clean($this->inputs['client_paymaster_res_cert_issued_at']),
            'client_paymaster_res_cert_date'   => $this->clean($this->inputs['client_paymaster_res_cert_date']),
            'client_paymaster_deduct_salary'   => $this->clean($client_paymaster_deduct_salary),
            'client_paymaster_client_deduct_salary' => $this->clean($client_paymaster_client_deduct_salary),
            'client_paymaster_conformity'           => $this->clean($client_paymaster_conformity)

        );
        return $this->update($this->table, $form, "$this->pk = '$primary_id'");
    }


    public function show()
    {
        $rows = array();
        $param = isset($this->inputs['param']) ? $this->inputs['param'] : null;
        $rows = array();
        $result = $this->select($this->table, '*', $param);
        while ($row = $result->fetch_assoc()) {
            $row['client_fullname'] = $row['client_fname'] . " " . $row['client_mname'] . " " . $row['client_lname'] . " " . $row['client_name_extension'];
            $row['account_id'] = $row['client_id'];
            $rows[] = $row;
        }
        return $rows;
    }

    public function view()
    {
        $Insurance = new Insurance;
        $primary_id = $this->inputs['id'];
        $result = $this->select($this->table, "*", "$this->pk = '$primary_id'");
        $row = $result->fetch_assoc();

        $bithdayDate = $row['client_dob'];
        $date = new DateTime($bithdayDate);
        $now = new DateTime();
        $interval = $now->diff($date);

        $row['client_insurance'] = $Insurance->name($row['insurance_id']);
        $row['client_fullname'] = $row['client_fname'] . " " . $row['client_mname'] . " " . $row['client_lname'] . " " . $row['client_name_extension'];
        $row['client_age'] = $interval->y;
        return $row;
    }

    public function remove()
    {
        $ids = implode(",", $this->inputs['ids']);
        return $this->delete($this->table, "$this->pk IN($ids)");
    }

    public function name($primary_id)
    {
        $result = $this->select($this->table, 'client_fname,client_mname,client_lname,client_name_extension', "$this->pk = '$primary_id'");
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            return $row['client_fname'] . " " . $row['client_mname'] . " " . $row['client_lname'] . " " . $row['client_name_extension'];
        }else{
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

        return $this->insertIfNotExist("tbl_property_owned", $form, "property_location = '" . $property_location . "'");
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

        return $this->insertIfNotExist("tbl_children", $form, "child_name = '" . $child_name . "'");
    }
}
