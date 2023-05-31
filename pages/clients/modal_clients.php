<form method='POST' id='frm_client'>
    <div class="modal fade" id="modalEntry" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel"><span class='ion-compose'></span> Add Entry</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="hidden_id" name="input[client_id]">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="wizard-steps">
                                        <div class="wizard-step">
                                            <div class="wizard-step-icon">
                                                <i class="far fa-user"></i>
                                            </div>
                                            <div class="wizard-step-label">
                                                Personal Information
                                            </div>
                                        </div>
                                        <div class="col-md-2 wizard-step">
                                            <div class="wizard-step-icon">
                                                <i class="fas fa-clipboard"></i>
                                            </div>
                                            <div class="wizard-step-label">
                                                Additional Information
                                            </div>
                                        </div>
                                        <div class="col-md-2 wizard-step">
                                            <div class="wizard-step-icon">
                                                <i class="fas fa-hand-holding-usd"></i>
                                            </div>
                                            <div class="wizard-step-label">
                                                Source of Income
                                            </div>
                                        </div>
                                        <div class="col-md-2 wizard-step">
                                            <div class="wizard-step-icon">
                                                <i class="fas fa-user-shield"></i>
                                            </div>
                                            <div class="wizard-step-label">
                                                Insurance
                                            </div>
                                        </div>
                                        <div class="col-md-2 wizard-step">
                                            <div class="wizard-step-icon">
                                                <i class="fas fa-home"></i>
                                            </div>
                                            <div class="wizard-step-label">
                                                Property
                                            </div>
                                        </div>
                                        <div class="col-md-2 wizard-step">
                                            <div class="wizard-step-icon">
                                                <i class="fas fa-users"></i>
                                            </div>
                                            <div class="wizard-step-label">
                                                Family
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <form class="wizard-content mt-2">
                                    <div id="page_content_1" class="tab wizard-pane">
                                        <div class="form-group row">
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Branch</label>
                                                <select class="required select2 form-control input-item" id="branch_id" name="input[branch_id]" style="width:100%;">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">First name</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Client middle name" name="input[client_fname]" id="client_fname">
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Middle name</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Client middle name" name="input[client_mname]" id="client_mname">
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Last name</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Client middle name" name="input[client_lname]" id="client_lname">
                                            </div>
                                            <div class="col-lg-2" style="padding: 10px;">
                                                <label class="text-md-right text-left">Suffix</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Suffix" name="input[client_name_extension]" id="client_name_extension">
                                            </div>
                                            <div class="col-lg-2" style="padding: 10px;">
                                                <label class="text-md-right text-left">Civil Status</label>
                                                <select class="required form-control input-item" id="client_civil_status" name="input[client_civil_status]" style="width:100%;">
                                                    <option value="">Please Select</option>
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Widowed">Widowed</option>
                                                    <option value="Seperated">Seperated</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-2" style="padding: 10px;">
                                                <label class="text-md-right text-left">Birthday</label>
                                                <input type="date" class="required form-control input-item" autocomplete="off" placeholder="Client middle name" name="input[client_dob]" id="client_dob">
                                            </div>
                                            <div class="col-lg-2" style="padding: 10px;">
                                                <label class="text-md-right text-left">Contact #</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Client contact number" name="input[client_contact_no]" id="client_contact_no">
                                            </div>
                                            <div class="col-lg-6" style="padding: 10px;">
                                                <label class="text-md-right text-left">Address</label>
                                                <textarea class="required form-control input-item" autocomplete="off" placeholder="Client address" name="input[client_address]" id="client_address"></textarea>
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Status</label>
                                                <select class="required form-control input-item" id="client_address_status" name="input[client_address_status]" style="width:100%;">
                                                    <option value="">Please Select</option>
                                                    <option value="Owned">Owned</option>
                                                    <option value="Rented">Rented</option>
                                                    <option value="Free Use">Free Use</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Resident Certificate #</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Certificate number" name="input[client_res_cert_no]" id="client_res_cert_no">
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Issued At</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Certificate issued at" name="input[client_res_cert_issued_at]" id="client_res_cert_issued_at">
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Certificate Date</label>
                                                <input type="date" class="required form-control input-item" autocomplete="off" placeholder="Certificate issued date" name="input[client_res_cert_date]" id="client_res_cert_date">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Employer</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Employer name" name="input[client_employer]" id="client_employer">
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Address</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Employer address" name="input[client_employer_address]" id="client_employer_address">
                                            </div>


                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Contact #</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Contact number" name="input[client_employer_contact_no]" id="client_employer_contact_no">
                                            </div>
                                            <div class="col-lg-2" style="padding: 10px;">
                                                <label class="text-md-right text-left">Position</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Position" name="input[client_emp_position]" id="client_emp_position">
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Income</label>
                                                <input type="number" class="required form-control input-item" autocomplete="off" placeholder="Monthly salary" name="input[client_emp_income]" id="client_emp_income">
                                            </div>


                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Status</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Status of employment" name="input[client_emp_status]" id="client_emp_status">
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Length</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Length of employment" name="input[client_emp_length]" id="client_emp_length">
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Previous Employment</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Previous employment" name="input[client_prev_emp]" id="client_prev_emp">
                                            </div>
                                        </div>
                                    </div>

                                    <div id="page_content_2" class="tab wizard-pane">

                                        <div class="form-group row">
                                            <div class="col-lg-6" style="padding: 10px;">
                                                <label class="text-md-right text-left">Spouse</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Spouse fullname" name="input[client_spouse]" id="client_spouse">
                                            </div>
                                            <div class="col-lg-6" style="padding: 10px;">
                                                <label class="text-md-right text-left">Residence</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Spouse address" name="input[client_spouse_address]" id="client_spouse_address">
                                            </div>

                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Resident Certificate #</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Spouse certificate number" name="input[client_spouse_res_cert_no]" id="client_spouse_res_cert_no">
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Issued At</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Spouse certificate issued at" name="input[client_spouse_res_cert_issued_at]" id="client_spouse_res_cert_issued_at">
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Certificate Date</label>
                                                <input type="date" class="form-control input-item" autocomplete="off" placeholder="Spouse certificate issued date" name="input[client_spouse_res_cert_date]" id="client_spouse_res_cert_date">
                                            </div>
                                            
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Spouse Employer</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Employer name" name="input[client_spouse_employer]" id="client_spouse_employer">
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Bussiness Address</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Employer name" name="input[client_spouce_employer_address]" id="client_spouce_employer_address">
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Telephone #</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Employer name" name="input[client_spouce_employer_contact_no]" id="client_spouce_employer_contact_no">
                                            </div>

                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Position</label>
                                                <input type="text" class=" form-control input-item" autocomplete="off" placeholder="Employer name" name="input[client_spouse_position]" id="client_spouse_position">
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Income</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Employer name" name="input[client_spouse_income]" id="client_spouse_income">
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Status of Employment</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Employer name" name="input[client_spouse_emp_status]" id="client_spouse_emp_status">
                                            </div>

                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Length of Employement</label>
                                                <input type="text" class=" form-control input-item" autocomplete="off" placeholder="Employer name" name="input[client_spouse_leng_emp]" id="client_spouse_leng_emp">
                                            </div>
                                            <div class="col-lg-8" style="padding: 10px;">
                                                <label class="text-md-right text-left">Prev. Employment</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Employer name" name="input[client_spouse_prev_employment]" id="client_spouse_prev_employment">
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Status of Employment</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Employer name" name="input[client_spouse_emp_status]" id="client_spouse_emp_status">
                                            </div>

                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">No. of Children</label>
                                                <input type="number" class="form-control input-item" autocomplete="off" placeholder="Number of children" name="input[client_no_of_childred]" id="client_no_of_childred">
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">No. of Children Dependent on you</label>
                                                <input type="number" class="form-control input-item" autocomplete="off" placeholder="Number of Children Dependent on you" name="input[client_no_of_child_dependent]" id="client_no_of_child_dependent">
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">College</label>
                                                <input type="number" class="form-control input-item" autocomplete="off" placeholder="Number of children studying" name="input[client_no_of_child_college]" id="client_no_of_child_college">
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">High School</label>
                                                <input type="number" class="form-control input-item" autocomplete="off" placeholder="Number of children studying" name="input[client_no_of_child_hs]" id="client_no_of_child_hs">
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Elementary</label>
                                                <input type="number" class="form-control input-item" autocomplete="off" placeholder="Number of children studying" name="input[client_no_of_child_elem]" id="client_no_of_child_elem">
                                            </div>
                                        </div>
                                    </div>

                                    <div id="page_content_3" class="tab wizard-pane">
                                        <div class="form-group row">
                                            <div class="col-lg-5" style="padding: 10px;">
                                                <label class="text-md-right text-left">Source Of Income</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Source of income" name="input[client_soi]" id="client_soi">
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Source of income by whom</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="" name="input[client_soi_by_whom]" id="client_soi_by_whom">
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Monthly Income</label>
                                                <input type="number" step="0.01" class="required form-control input-item" autocomplete="off" placeholder="" name="input[client_soi_monthly_income]" id="client_soi_monthly_income">
                                            </div>

                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Reference name 1</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Credit reference fullname" name="input[client_credit_ref_name1]" id="client_credit_ref_name1">
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Reference Address 1</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Credit reference address" name="input[client_credit_ref_address1]" id="client_credit_ref_address1">
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Reference name 2</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Credit reference fullname" name="input[client_credit_ref_name2]" id="client_credit_ref_name1">
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Reference Address 2</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Credit reference address" name="input[client_credit_ref_address2]" id="client_credit_ref_address2">
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Reference name 3</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Credit reference fullname" name="input[client_credit_ref_name3]" id="client_credit_ref_name3">
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Reference Address 3</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Credit reference address" name="input[client_credit_ref_address3]" id="client_credit_ref_address3">
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Aprox Total Income</label>
                                                <input type="number" step="0.01" class="required form-control input-item" autocomplete="off" placeholder="Approximately total monthly income" name="input[client_approx_total_monthly_income]" id="client_approx_total_monthly_income">
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Total Oustanding Obligation</label>
                                                <input type="number" step="0.01" class="required form-control input-item" autocomplete="off" placeholder="Total oustanding obligation" name="input[client_total_outstanding_obligation]" id="client_total_outstanding_obligation">
                                            </div>


                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Business Name</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Business name" name="input[client_business_name]" id="client_business_name">
                                            </div>
                                            <div class="col-lg-5" style="padding: 10px;">
                                                <label class="text-md-right text-left">Address</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Business address" name="input[client_business_address]" id="client_business_address">
                                            </div>

                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Telephone No.</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Telephone number" name="input[client_business_tel_no]" id="client_business_tel_no">
                                            </div>
                                            <div class="col-lg-2" style="padding: 10px;">
                                                <label class="text-md-right text-left">Position</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Business position" name="input[client_business_position]" id="client_business_position">
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Kind</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Business kind" name="input[client_business_kind]" id="client_business_kind">
                                            </div>
                                            <div class="col-lg-2" style="padding: 10px;">
                                                <label class="text-md-right text-left">Length</label>
                                                <input type="number" class="required form-control input-item" autocomplete="off" placeholder="Business length" name="input[client_business_length]" id="client_business_length">
                                            </div>
                                            <div class="col-lg-2" style="padding: 10px;">
                                                <label class="text-md-right text-left">Capital Invested</label>
                                                <input type="number" step="0.01" class="required form-control input-item" autocomplete="off" placeholder="Capital invested" name="input[client_business_capital_invested]" id="client_business_capital_invested">
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Business Type</label>
                                                <select class="required form-control input-item" id="client_business_type" name="input[client_business_type]" style="width:100%;">
                                                    <option value="">Please Select</option>
                                                    <option value="Sole">Sole</option>
                                                    <option value="Owner">Owner</option>
                                                    <option value="Partner">Partner</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> 

                                    <div id="page_content_3" class="tab wizard-pane">
                                        <div class="form-group row">
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Insurance</label>
                                                <select class="required form-control input-item" id="insurance_id" name="input[insurance_id]" style="width:100%;">
                                                </select>
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Amount</label>
                                                <input type="number" step="0.01" class="required form-control input-item" autocomplete="off" placeholder="Insurance amount" name="input[client_insurance_amount]" id="client_insurance_amount">
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Maturity</label>
                                                <input type="number" class="required form-control input-item" autocomplete="off" placeholder="Insurance maturity" name="input[client_insurance_maturity]" id="client_insurance_maturity">
                                            </div>

                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Bank Transaction</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Bank transaction" name="input[client_bank_transaction]" id="client_bank_transaction">
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Unpaid Obligation</label>
                                                <input type="number" step="0.01" class="required form-control input-item" autocomplete="off" placeholder="" name="input[client_unpaid_obligation]" id="client_unpaid_obligation">
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Salary Withdrawal</label>
                                                <select class="required form-control input-item" id="client_salary_withdrawal" name="input[client_salary_withdrawal]" style="width:100%;">
                                                    <option value="">Please Select</option>
                                                    <option value="Weekly">Weekly</option>
                                                    <option value="Semi-monthly">Semi-monthly</option>
                                                    <option value="Monthly">Monthly</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6" style="padding: 10px;">
                                                <label class="text-md-right text-left">Paymaster Name</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Paymaster fullname" name="input[client_paymaster_name]" id="client_paymaster_name">
                                            </div>
                                            <div class="col-lg-6" style="padding: 10px;">
                                                <label class="text-md-right text-left">Residence</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Paymaster address" name="input[client_paymaster_residence]" id="client_paymaster_residence">
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Resident Certificate #</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Paymaster certificate number" name="input[client_paymaster_res_cert_no]" id="client_paymaster_res_cert_no">
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Issued At</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Paymaster certificate issued at" name="input[client_paymaster_res_cert_issued_at]" id="client_paymaster_res_cert_issued_at">
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Certificate Date</label>
                                                <input type="date" class="required input-item form-control input-item" autocomplete="off" placeholder="Paymaster certificate issued date" name="input[client_paymaster_res_cert_date]" id="client_paymaster_res_cert_date">
                                            </div>

                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Paymaster Deduct Salary</label>
                                                <div class="form-group">
                                                    <label class="custom-switch mt-2">
                                                        <span class="custom-switch-description"> No &nbsp;</span>
                                                        <input type="checkbox" value="Yes" id="client_paymaster_deduct_salary" name="input[client_paymaster_deduct_salary]" class="required input-item custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Yes</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Client Deduct Salary</label>
                                                <div class="form-group">
                                                    <label class="custom-switch mt-2">
                                                        <span class="custom-switch-description"> No &nbsp;</span>
                                                        <input type="checkbox" value="Yes" id="client_paymaster_client_deduct_salary" name="input[client_paymaster_client_deduct_salary]" class="required custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Yes</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Paymaster Conformity</label>
                                                <div class="form-group">
                                                    <label class="custom-switch mt-2">
                                                        <span class="custom-switch-description"> No &nbsp;</span>
                                                        <input type="checkbox" value="Yes" id="client_paymaster_conformity" name="input[client_paymaster_conformity]" class="required input-item custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Yes</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="page_content_6" class="tab wizard-pane" style="width: -webkit-fill-available;">
                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-lg-12" style="padding: 10px;">
                                                        <label class="text-md-right text-left">Location</label>
                                                        <input type="text" class="p_required form-control" autocomplete="off" placeholder="Real property location" name="input[property_location]" id="property_location">
                                                    </div>
                                                    <div class="col-lg-6" style="padding: 10px;">
                                                        <label class="text-md-right text-left">Area</label>
                                                        <input type="text" class="p_required form-control" autocomplete="off" placeholder="Area" name="input[property_area]" id="property_area">
                                                    </div>
                                                    <div class="col-lg-6" style="padding: 10px;">
                                                        <label class="text-md-right text-left">Cost</label>
                                                        <input type="number" step="0.01" class="p_required form-control" autocomplete="off" placeholder="Acquisition cost" name="input[property_acquisition_cost]" id="property_acquisition_cost">
                                                    </div>
                                                    <div class="col-lg-6" style="padding: 10px;">
                                                        <label class="text-md-right text-left">Property Market Value</label>
                                                        <input type="number" step="0.01" class="p_required form-control" autocomplete="off" placeholder="Property Market Value" name="input[property_pres_market_val]" id="property_pres_market_val">
                                                    </div>
                                                    <div class="col-lg-6" style="padding: 10px;">
                                                        <label class="text-md-right text-left">Improvement, if any</label>
                                                        <input type="text" class="form-control" autocomplete="off" name="input[property_improvement]" id="property_improvement">
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <button type="button" style="float: right;" class="btn btn-icon icon-right btn-info" onclick="addProperty()">Add Entry</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6" style="padding: 10px;">
                                                <div class="table-responsive">
                                                    <div class="table-responsive">
                                                        <table id="dt_properties" class="table table-striped" style="font-size:10px;width: 100%!important;">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col"></th>
                                                                    <th scope="col">Location</th>
                                                                    <th scope="col">Area</th>
                                                                    <th scope="col">Cost</th>
                                                                    <th scope="col">Market Value</th>
                                                                    <th scope="col">Improvement</th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="page_content_7" class="tab wizard-pane" style="width: -webkit-fill-available;">
                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-lg-9" style="padding: 10px;">
                                                        <label class="text-md-right text-left">Child Name</label>
                                                        <input type="text" class="c_required form-control" autocomplete="off" placeholder="Child Fullname" name="input[child_name]" id="child_name">
                                                    </div>
                                                    <div class="col-lg-3" style="padding: 10px;">
                                                        <label class="text-md-right text-left">Age</label>
                                                        <input type="number" class="c_required form-control" autocomplete="off" min="0" placeholder="Age" name="input[child_age]" id="child_age">
                                                    </div>
                                                    <div class="col-lg-4" style="padding: 10px;">
                                                        <label class="text-md-right text-left">Gender</label>
                                                        <select class="c_required form-control input-item" id="child_sex" name="input[child_sex]" style="width:100%;">
                                                            <option value="">Please Select</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-8" style="padding: 10px;">
                                                        <label class="text-md-right text-left">Occupation</label>
                                                        <input type="text" class="c_required form-control" autocomplete="off" placeholder="Child occupation" name="input[child_occupation]" id="child_occupation">
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <button type="button" style="float: right;" class="btn btn-icon icon-right btn-info" onclick="addChildren()">Add Entry</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6" style="padding: 10px;">
                                                <div class="table-responsive">
                                                    <div class="table-responsive">
                                                        <table id="dt_children" class="table table-striped" style="font-size:10px;width: 100%!important;">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col"></th>
                                                                    <th scope="col">Name</th>
                                                                    <th scope="col">Age</th>
                                                                    <th scope="col">Gender</th>
                                                                    <th scope="col">Occupation</th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn_submit" class="btn btn-primary">
                        Save
                    </button> -->
                        <button type="button" class="btn btn-icon icon-right btn-secondary" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                        <button type="button" class="btn btn-icon icon-right btn-primary" id="nextBtn" onclick="nextPrev(1)">Save and continue </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        $(".tab " + n + " input").hide();
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {

            document.getElementById("prevBtn").style.display = "inline";

        }
        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Finish";
        } else {
            document.getElementById("nextBtn").innerHTML = "Save and continue";
        }
        fixStepIndicator(n)
    }

    function nextPrev(n) {
        var x = document.getElementsByClassName("tab");
        if (n == 1 && !validateForm()) return false;

        // Hide the current tab:
        x[currentTab].style.display = "none";
        currentTab = currentTab + n;
        if (currentTab >= x.length) {

            return false;
        }

        showTab(currentTab);
        if (currentTab == 4) {
            getProperty();
        } else if (currentTab == 5) {
            getChildren();
        }
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByClassName("required");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
                // add an "invalid" class to the field:
                y[i].className += " invalid";
                $(this).siblings(".select2-container").css('border', '5px solid red');
                // and set the current valid status to false
                valid = false;

            } else {
                y[i].classList.remove("invalid");
            }

        }
        

        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("wizard-step")[currentTab].className += " wizard-step-info";
            saveClient();
        }
        return valid; // return the valid status

    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("wizard-step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" wizard-step-active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " wizard-step-active";

    }

    function saveClient() {
        //   e.preventDefault();
        var hidden_id = $("#hidden_id").val();
        var q = hidden_id > 0 ? "edit" : "add";
        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=" + route_settings.class_name + "&q=" + q,
            data: $("#frm_client").serialize(),
            success: function(data) {
                var json = JSON.parse(data);
                if (json.data > 0) {
                    if (currentTab == 6) {
                        success_update();
                        getEntries();
                        $("#modalEntry").modal('hide');
                        currentTab = 0;
                    } else if (currentTab == 1) {
                        q == "add" ? $("#hidden_id").val(json.data) : "";
                        getEntries();
                    }

                } else if (json.data == -2) {
                    entry_already_exists();
                    currentTab = 0;
                    showTab(currentTab);
                } else {
                    failed_query(json);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                errorLogger('Error:', textStatus, errorThrown);
            }
        });
    }

    function addProperty() {
        var isValid = true;
        var fields = $('input.p_required');
        for (var i = 0; i < fields.length; i++) {
            if ($(fields[i]).val() == '') {
                $(fields[i]).addClass('invalid');
                isValid = false;
            } else {
                $(fields[i]).removeClass('invalid');
            }
        }

        if (isValid) {
            var client_id = $("#hidden_id").val();
            var property_location = $("#property_location").val();
            var property_area = $("#property_area").val();
            var property_acquisition_cost = $("#property_acquisition_cost").val();
            var property_pres_market_val = $("#property_pres_market_val").val();
            var property_improvement = $("#property_improvement").val();

            $.ajax({
                type: "POST",
                url: "controllers/sql.php?c=" + route_settings.class_name + "&q=addProperty",
                data: {
                    input: {
                        client_id: client_id,
                        property_location: property_location,
                        property_area: property_area,
                        property_acquisition_cost: property_acquisition_cost,
                        property_pres_market_val: property_pres_market_val,
                        property_improvement: property_improvement
                    }
                },
                success: function(data) {
                    var json = JSON.parse(data);
                    if (json.data == 1) {
                        $(".p_required").val("");
                        $("#property_improvement").val("");
                        getProperty();
                        success_add();
                    } else if (json.data == 2) {
                        entry_already_exists();
                    } else {
                        failed_query(json);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    errorLogger('Error:', textStatus, errorThrown);
                }
            });
        } else {

        }

    }


    function addChildren() {
        var isValid = true;
        var fields = $('input.c_required');
        for (var i = 0; i < fields.length; i++) {
            if ($(fields[i]).val() == '') {
                $(fields[i]).addClass('invalid');
                isValid = false;
            } else {
                $(fields[i]).removeClass('invalid');
            }
        }

        if (isValid) {
            var client_id = $("#hidden_id").val();
            var child_name = $("#child_name").val();
            var child_age = $("#child_age").val();
            var child_sex = $("#child_sex").val();
            var child_occupation = $("#child_occupation").val();

            $.ajax({
                type: "POST",
                url: "controllers/sql.php?c=" + route_settings.class_name + "&q=addChildren",
                data: {
                    input: {
                        client_id: client_id,
                        child_name: child_name,
                        child_age: child_age,
                        child_sex: child_sex,
                        child_occupation: child_occupation
                    }
                },
                success: function(data) {
                    var json = JSON.parse(data);
                    if (json.data == 1) {
                        $(".c_required").val("");
                        $('#child_sex').select2().trigger('change');
                        success_add();
                        getChildren();
                    } else if (json.data == 2) {
                        entry_already_exists();
                    } else {
                        failed_query(json);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    errorLogger('Error:', textStatus, errorThrown);
                }
            });
        } else {

        }

    }

    function getProperty() {
        var param = "client_id = '" + $("#hidden_id").val() + "'";

        $("#dt_properties").DataTable().destroy();
        $("#dt_properties").DataTable({
            "processing": true,
            "bPaginate": false,
            "bFilter": false,
            "bInfo": false,
            "ajax": {
                "url": "controllers/sql.php?c=" + route_settings.class_name + "&q=showProperty",
                "dataSrc": "data",
                "method": "POST",
                "data": {
                    input: {
                        param: param
                    }
                },
            },
            "columns": [{
                    "mRender": function(data, type, row) {
                        return "<center><button type='button' class='btn btn-sm btn-danger' id='btn_delete_" + row.property_id + "' onclick='deleteProperty(" + row.property_id + ")'><span class='fa fa-trash'></span></button></center>";
                    }
                },
                {
                    "data": "property_location"
                },
                {
                    "data": "property_area"
                },
                {
                    "data": "property_acquisition_cost"
                },
                {
                    "data": "property_pres_market_val"
                },
                {
                    "data": "property_improvement"
                }
            ]
        });
    }

    function deleteChild(id) {

        $("#btn_delete_c_" + id).html("<span class='fa fa-spinner fa-spin'></span>");
        swal({
                title: 'Are you sure?',
                text: 'You will not be able to recover these entries!',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                    $.ajax({
                        type: "POST",
                        url: "controllers/sql.php?c=" + route_settings.class_name + "&q=delete_child",
                        data: {
                            input: {
                                id: id
                            }
                        },
                        success: function(data) {
                            getChildren();
                            var json = JSON.parse(data);
                            console.log(json);
                            if (json.data == 1) {
                                success_delete();
                            } else {
                                failed_query(json);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            errorLogger('Error:', textStatus, errorThrown);
                        }
                    });
                } else {
                    swal("Cancelled", "Entries are safe :)", "error");
                }
            });
    }

    function deleteProperty(id) {

        $("#btn_delete_c_" + id).html("<span class='fa fa-spinner fa-spin'></span>");
        swal({
                title: 'Are you sure?',
                text: 'You will not be able to recover these entries!',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                    $.ajax({
                        type: "POST",
                        url: "controllers/sql.php?c=" + route_settings.class_name + "&q=delete_property",
                        data: {
                            input: {
                                id: id
                            }
                        },
                        success: function(data) {
                            getProperty();
                            var json = JSON.parse(data);
                            console.log(json);
                            if (json.data == 1) {
                                success_delete();
                            } else {
                                failed_query(json);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            errorLogger('Error:', textStatus, errorThrown);
                        }
                    });
                } else {
                    swal("Cancelled", "Entries are safe :)", "error");
                }
            });
    }

    function getChildren() {

        var param = "client_id = '" + $("#hidden_id").val() + "'";

        $("#dt_children").DataTable().destroy();
        $("#dt_children").DataTable({
            "processing": true,
            "bPaginate": false,
            "bFilter": false,
            "bInfo": false,
            "ajax": {
                "url": "controllers/sql.php?c=" + route_settings.class_name + "&q=showChildren",
                "dataSrc": "data",
                "method": "POST",
                "data": {
                    input: {
                        param: param
                    }
                },
            },
            "columns": [{
                    "mRender": function(data, type, row) {
                        return "<center><button type='button' class='btn btn-sm btn-danger' id='btn_delete_c_" + row.child_id + "' onclick='deleteChild(" + row.child_id + ")'><span class='fa fa-trash'></span></button></center>";
                    }
                },
                {
                    "data": "child_name"
                },
                {
                    "data": "child_age"
                },
                {
                    "data": "child_sex"
                },
                {
                    "data": "child_occupation"
                }
            ]
        });
    }
</script>