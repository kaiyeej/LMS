<form method='POST' id='frm_client'>
    <div class="modal fade" id="modalEntry" role="dialog" aria-labelledby="myModalLabel" tabindex="-1" aria-hidden="true">
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
                                                <i class="fas fa-briefcase"></i>
                                            </div>
                                            <div class="wizard-step-label">
                                                Employer Information
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
                                                <i class="fas fa-wallet"></i>
                                            </div>
                                            <div class="wizard-step-label">
                                                Paymaster
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-2 wizard-step">
                                            <div class="wizard-step-icon">
                                                <i class="fas fa-home"></i>
                                            </div>
                                            <div class="wizard-step-label">
                                                Property
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                                <form class="wizard-content mt-2">
                                    <div id="page_content_1" class="tab wizard-pane">
                                        <div class="form-group row">
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">First name</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Client middle name" name="input[client_fname]" id="client_fname" >
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Middle name</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Client middle name" name="input[client_mname]" id="client_mname">
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Last name</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Client middle name" name="input[client_lname]" id="client_lname" >
                                            </div>
                                            <div class="col-lg-2" style="padding: 10px;">
                                                <label class="text-md-right text-left">Suffix</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Suffix" name="input[client_name_extension]" id="client_name_extension">
                                            </div>
                                            <div class="col-lg-2" style="padding: 10px;">
                                                <label class="text-md-right text-left">Civil Status</label>
                                                <select class="form-control select2 input-item" id="client_civil_status" name="input[client_civil_status]" style="width:100%;" >
                                                    <option value="">Please Select</option>
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Widowed">Widowed</option>
                                                    <option value="Seperated">Seperated</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-2" style="padding: 10px;">
                                                <label class="text-md-right text-left">Birthday</label>
                                                <input type="date" class="form-control input-item" autocomplete="off" placeholder="Client middle name" name="input[client_dob]" id="client_dob" >
                                            </div>
                                            <div class="col-lg-2" style="padding: 10px;">
                                                <label class="text-md-right text-left">Contact #</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Client contact number" name="input[client_contact_no]" id="client_contact_no" >
                                            </div>
                                            <div class="col-lg-6" style="padding: 10px;">
                                                <label class="text-md-right text-left">Address</label>
                                                <textarea class="form-control input-item" autocomplete="off" placeholder="Client address" name="input[client_address]" id="client_address" ></textarea>
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Status</label>
                                                <select class="form-control select2 input-item" id="client_address_status" name="input[client_address_status]" style="width:100%;" >
                                                    <option value="">Please Select</option>
                                                    <option value="Owned">Owned</option>
                                                    <option value="Rented">Rented</option>
                                                    <option value="Free Use">Free Use</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Resident Certificate #</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Certificate number" name="input[client_res_cert_no]" id="client_res_cert_no" >
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Issued At</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Certificate issued at" name="input[client_res_cert_issued_at]" id="client_res_cert_issued_at" >
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Certificate Date</label>
                                                <input type="date" class="form-control input-item" autocomplete="off" placeholder="Certificate issued date" name="input[client_res_cert_date]" id="client_res_cert_date" >
                                            </div>
                                        </div>
                                    </div>

                                    <div id="page_content_2" class="tab wizard-pane">
                                        <div class="form-group row">
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Employer</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Employer name" name="input[client_employer]" id="client_employer" >
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Address</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Employer address" name="input[client_employer_address]" id="client_employer_address" >
                                            </div>


                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Contact #</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Contact number" name="input[client_employer_contact_no]" id="client_employer_contact_no" >
                                            </div>
                                            <div class="col-lg-2" style="padding: 10px;">
                                                <label class="text-md-right text-left">Position</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Position" name="input[client_emp_position]" id="client_emp_position" >
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Income</label>
                                                <input type="number" class="form-control input-item" autocomplete="off" placeholder="Monthly salary" name="input[client_emp_income]" id="client_emp_income" >
                                            </div>


                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Status</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Status of employment" name="input[client_emp_status]" id="client_emp_status" >
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Length</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Length of employment" name="input[client_emp_length]" id="client_emp_length" >
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Previous Employment</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Previous employment" name="input[client_prev_emp]" id="client_prev_emp">
                                            </div>
                                        </div>
                                    </div>

                                    <div id="page_content_3" class="tab wizard-pane">
                                        <div class="form-group row">
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Spouse</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Spouse fullname" name="input[client_spouse]" id="client_spouse" >
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Spouse Employer</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Employer name" name="input[client_spouse_employer]" id="client_spouse_employer" >
                                            </div>
                                            <div class="col-lg-5" style="padding: 10px;">
                                                <label class="text-md-right text-left">Address</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Spouse address" name="input[client_spouse_address]" id="client_spouse_address" >
                                            </div>

                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Resident Certificate #</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Spouse certificate number" name="input[client_spouse_res_cert_no]" id="client_spouse_res_cert_no" >
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Issued At</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Spouse certificate issued at" name="input[client_spouse_res_cert_issued_at]" id="client_spouse_res_cert_issued_at" >
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Certificate Date</label>
                                                <input type="date" class="form-control input-item" autocomplete="off" placeholder="Spouse certificate issued date" name="input[client_spouse_res_cert_date]" id="client_spouse_res_cert_date" >
                                            </div>

                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">No. of Children</label>
                                                <input type="number" class="form-control input-item" autocomplete="off" placeholder="Number of children" name="input[client_no_of_childred]" id="client_no_of_childred" >
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">No. of Children Dependent on you</label>
                                                <input type="number" class="form-control input-item" autocomplete="off" placeholder="Number of Children Dependent on you" name="input[client_no_of_child_dependent]" id="client_no_of_child_dependent" >
                                            </div>

                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">College</label>
                                                <input type="number" class="form-control input-item" autocomplete="off" placeholder="Number of children studying" name="input[client_no_of_child_college]" id="client_no_of_child_college" >
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">High School</label>
                                                <input type="number" class="form-control input-item" autocomplete="off" placeholder="Number of children studying" name="input[client_no_of_child_hs]" id="client_no_of_child_hs" >
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Elementary</label>
                                                <input type="number" class="form-control input-item" autocomplete="off" placeholder="Number of children studying" name="input[client_no_of_child_elem]" id="client_no_of_child_elem" >
                                            </div>
                                        </div>
                                    </div>

                                    <div id="page_content_4" class="tab wizard-pane">
                                        <div class="form-group row">
                                            <div class="col-lg-5" style="padding: 10px;">
                                                <label class="text-md-right text-left">Source Of Income</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Source of income" name="input[client_soi]" id="client_soi" >
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Source of income by whom</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="" name="input[client_soi_by_whom]" id="client_soi_by_whom" >
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Monthly Income</label>
                                                <input type="number" step="0.01" class="form-control input-item" autocomplete="off" placeholder="" name="input[client_soi_monthly_income]" id="client_soi_monthly_income" >
                                            </div>

                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Reference name 1</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Credit reference fullname" name="input[client_credit_ref_name1]" id="client_credit_ref_name1" >
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Reference Address 1</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Credit reference address" name="input[client_credit_ref_address1]" id="client_credit_ref_address1" >
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Reference name 2</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Credit reference fullname" name="input[client_credit_ref_name2]" id="client_credit_ref_name1" >
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Reference Address 2</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Credit reference address" name="input[client_credit_ref_address2]" id="client_credit_ref_address2" >
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Reference name 3</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Credit reference fullname" name="input[client_credit_ref_name3]" id="client_credit_ref_name3" >
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Reference Address 3</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Credit reference address" name="input[client_credit_ref_address3]" id="client_credit_ref_address3" >
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Aprox Total Income</label>
                                                <input type="number" step="0.01" class="form-control input-item" autocomplete="off" placeholder="Approximately total monthly income" name="input[client_approx_total_monthly_income]" id="client_approx_total_monthly_income" >
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Total Oustanding Obligation</label>
                                                <input type="number" step="0.01" class="form-control input-item" autocomplete="off" placeholder="Total oustanding obligation" name="input[client_total_outstanding_obligation]" id="client_total_outstanding_obligation" >
                                            </div>


                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Business Name</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Business name" name="input[client_business_name]" id="client_business_name" >
                                            </div>
                                            <div class="col-lg-5" style="padding: 10px;">
                                                <label class="text-md-right text-left">Address</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Business address" name="input[client_business_address]" id="client_business_address" >
                                            </div>

                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Telephone No.</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Telephone number" name="input[client_business_tel_no]" id="client_business_tel_no" >
                                            </div>
                                            <div class="col-lg-2" style="padding: 10px;">
                                                <label class="text-md-right text-left">Position</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Business position" name="input[client_business_position]" id="client_business_position" >
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Kind</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Business kind" name="input[client_business_kind]" id="client_business_kind" >
                                            </div>
                                            <div class="col-lg-2" style="padding: 10px;">
                                                <label class="text-md-right text-left">Length</label>
                                                <input type="number" class="form-control input-item" autocomplete="off" placeholder="Business length" name="input[client_business_length]" id="client_business_length" >
                                            </div>
                                            <div class="col-lg-2" style="padding: 10px;">
                                                <label class="text-md-right text-left">Capital Invested</label>
                                                <input type="number" step="0.01" class="form-control input-item" autocomplete="off" placeholder="Capital invested" name="input[client_business_capital_invested]" id="client_business_capital_invested" >
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Business Type</label>
                                                <select class="form-control select2 input-item" id="client_business_type" name="input[client_business_type]" style="width:100%;" >
                                                    <option value="">Please Select</option>
                                                    <option value="Sole">Sole</option>
                                                    <option value="Owner">Owner</option>
                                                    <option value="Partner">Partner</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="page_content_5" class="tab wizard-pane">
                                        <div class="form-group row">
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Insurance</label>
                                                <select class="form-control select2 input-item" id="insurance_id" name="input[insurance_id]" style="width:100%;" >
                                                </select>
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Amount</label>
                                                <input type="number" step="0.01" class="form-control input-item" autocomplete="off" placeholder="Insurance amount" name="input[client_insurance_amount]" id="client_insurance_amount" >
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Maturity</label>
                                                <input type="number" class="form-control input-item" autocomplete="off" placeholder="Insurance maturity" name="input[client_insurance_maturity]" id="client_insurance_maturity" >
                                            </div>

                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Bank Transaction</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Bank transaction" name="input[client_bank_transaction]" id="client_bank_transaction" >
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Unpaid Obligation</label>
                                                <input type="number" step="0.01" class="form-control input-item" autocomplete="off" placeholder="" name="input[client_unpaid_obligation]" id="client_unpaid_obligation" >
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Salary Withdrawal</label>
                                                <select class="form-control select2 input-item" id="client_salary_withdrawal" name="input[client_salary_withdrawal]" style="width:100%;" >
                                                    <option value="">Please Select</option>
                                                    <option value="Weekly">Weekly</option>
                                                    <option value="Semi-monthly">Semi-monthly</option>
                                                    <option value="Monthly">Monthly</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                    <div id="page_content_6" class="tab wizard-pane">
                                        <div class="form-group row">
                                            <div class="col-lg-6" style="padding: 10px;">
                                                <label class="text-md-right text-left">Paymaster Name</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Paymaster fullname" name="input[client_paymaster_name]" id="client_paymaster_name" >
                                            </div>
                                            <div class="col-lg-6" style="padding: 10px;">
                                                <label class="text-md-right text-left">Residence</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Paymaster address" name="input[client_paymaster_residence]" id="client_paymaster_residence" >
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Resident Certificate #</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Paymaster certificate number" name="input[client_paymaster_res_cert_no]" id="client_paymaster_res_cert_no" >
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Issued At</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Paymaster certificate issued at" name="input[client_paymaster_res_cert_issued_at]" id="client_paymaster_res_cert_issued_at" >
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Certificate Date</label>
                                                <input type="date" class="input-item form-control input-item" autocomplete="off" placeholder="Paymaster certificate issued date" name="input[client_paymaster_res_cert_date]" id="client_paymaster_res_cert_date" >
                                            </div>

                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Paymaster Deduct Salary</label>
                                                <div class="form-group">
                                                    <label class="custom-switch mt-2">
                                                        <span class="custom-switch-description"> No &nbsp;</span>
                                                        <input type="checkbox" value="Yes" id="client_paymaster_deduct_salary" name="input[client_paymaster_deduct_salary]" class="input-item custom-switch-input">
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
                                                        <input type="checkbox" value="Yes" id="client_paymaster_client_deduct_salary" name="input[client_paymaster_client_deduct_salary]" class="custom-switch-input">
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
                                                        <input type="checkbox" value="Yes" id="client_paymaster_conformity" name="input[client_paymaster_conformity]" class="input-item custom-switch-input">
                                                        <span class="custom-switch-indicator"></span>
                                                        <span class="custom-switch-description">Yes</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <input type="hidden" id="preset_null" name="preset_null" >
                                        </div>
                                    </div>
                                    
                                    <div id="page_content_7" class="tab wizard-pane">
                                        <div class="form-group row">
                                            <div class="col-lg-6" style="padding: 10px;">
                                                <label class="text-md-right text-left">Paymaster Name</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Paymaster fullname"  name="property_location" id="property_location" >
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
                        <button class="btn btn-icon icon-right btn-secondary" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                        <button type="submit" class="btn btn-icon icon-right btn-primary" id="nextBtn" onclick="nextPrev(1)">Save and continue </button>
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
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        
        //... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Finish";
            // document.getElementById("nextBtn").type = "submit";
        } else {
            document.getElementById("nextBtn").innerHTML = "Save and continue";
            // document.getElementById("nextBtn").type = "button";
        }
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n)
    }

    function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
            //ari
            if (n == 1 && !validateForm()) return false;
        
        
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form...
        if (currentTab >= x.length) {
            // ... the form gets submitted:
            // document.getElementById("regForm").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].querySelectorAll("[]");

        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
                // add an "invalid" class to the field:
                // y[i].className += " invalid";
                // and set the current valid status to false
                valid = false;

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
        alert(1);
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
                        $("#modalEntry").modal('hide');
                        currentTab = 0;
                    } else if (currentTab == 1 && q == "add") {
                        $("#hidden_id").val(json.data);
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
</script>