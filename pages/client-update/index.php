<style>
    .input-group-text {
        font-weight: bold;
    }
</style>
<section class="section">
    <div class="section-header">
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Transactions</a></div>
            <div class="breadcrumb-item">Clients</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <div class="col-md-12">
                                <div class="author-box-name">
                                    <a href="#">
                                        <span><i class="fa-solid fa-angles-left"></i> Back to Clients</span>
                                    </a>
                                    <a href="#">
                                        <h3><span class="client_span"></span></h3>
                                    </a>
                                    <strong>Update client profile</strong>
                                </div>

                                <a href="#" style="float: right;" onclick="getPreview()" class="btn btn-lg btn-icon icon-left btn-warning"><i class="fa fa-print"></i> Print</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills" id="myTab3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="personal-tab3" data-toggle="tab" href="#personal3" role="tab" aria-controls="personal" aria-selected="true"><i class="far fa-user"></i> Personal Information</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="additional-tab3" data-toggle="tab" href="#additional3" role="tab" aria-controls="additional" aria-selected="false"><i class="fas fa-clipboard"></i> Additional Information</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="income-tab3" data-toggle="tab" href="#income" role="tab" aria-controls="income" aria-selected="false"><i class="fas fa-hand-holding-usd"></i> Source of Income</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="insurance-tab3" data-toggle="tab" href="#insurance" role="tab" aria-controls="insurance" aria-selected="false"><i class="fas fa-user-shield"></i> Insurance</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="property-tab3" data-toggle="tab" href="#property" role="tab" aria-controls="property" aria-selected="false"><i class="fas fa-home"></i> Property</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="family-tab3" data-toggle="tab" href="#family" role="tab" aria-controls="family" aria-selected="false"><i class="fas fa-users"></i> Family</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent2" style="padding-top: 25px;">
                                <div class="tab-pane fade active show" id="personal3" role="tabpanel" aria-labelledby="personal-tab3">
                                    <div id="page_content_1" class="container">
                                        <form method='POST' id='frm_client_1'>
                                            <input type="hidden" name="input[client_id]" id="hidden_id_1">
                                            <div class="form-group row">
                                                <div class="col-lg-4" style="padding: 10px;">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong> Branch</span>
                                                        </div> <select class="select2 form-control input-item" id="branch_id" name="input[branch_id]" required>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong> First name </span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_fname]" id="client_fname" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Middle name</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_mname]" id="client_mname">
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Last name</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_lname]" id="client_lname" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-2">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Suffix</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_name_extension]" id="client_name_extension">
                                                    </div>
                                                </div>

                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Civil Status</span>
                                                        </div>
                                                        <select class="form-control input-item" id="client_civil_status" name="input[client_civil_status]" required>
                                                            <option value="">Please Select</option>
                                                            <option value="Single">Single</option>
                                                            <option value="Married">Married</option>
                                                            <option value="Widowed">Widowed</option>
                                                            <option value="Seperated">Seperated</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Birthday</span>
                                                        </div>
                                                        <input type="date" class="form-control input-item" autocomplete="off" name="input[client_dob]" id="client_dob" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Contact #</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_contact_no]" id="client_contact_no" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-8">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span style="height: 64px;" class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Address</span>
                                                        </div>
                                                        <textarea class="form-control input-item" autocomplete="off" name="input[client_address]" id="client_address" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Status</span>
                                                        </div>
                                                        <select class="form-control input-item" id="client_address_status" name="input[client_address_status]" required>
                                                            <option value="">Please Select</option>
                                                            <option value="Owned">Owned</option>
                                                            <option value="Rented">Rented</option>
                                                            <option value="Free Use">Free Use</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Certificate #</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_res_cert_no]" id="client_res_cert_no" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Issued At</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_res_cert_issued_at]" id="client_res_cert_issued_at" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Certificate Date</span>
                                                        </div>
                                                        <input type="date" class="form-control input-item" autocomplete="off" name="input[client_res_cert_date]" id="client_res_cert_date" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Employer</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_employer]" id="client_employer" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Address</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_employer_address]" id="client_employer_address" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Contact #</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_employer_contact_no]" id="client_employer_contact_no" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Position</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_emp_position]" id="client_emp_position" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Income</span>
                                                        </div>
                                                        <input type="number" min="0" class="form-control input-item" autocomplete="off" name="input[client_emp_income]" id="client_emp_income" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Status</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_emp_status]" id="client_emp_status" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Length</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_emp_length]" id="client_emp_length" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Prev. Employment</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_prev_emp]" id="client_prev_emp">
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <button type="submit" id="btn_submit_1" class="btn btn-primary" style="float: right;">
                                                        Update Entry
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="additional3" role="tabpanel" aria-labelledby="additional-tab3">
                                    <div id="page_content_2" class="container">
                                        <form method='POST' id='frm_client_2'>
                                            <input type="hidden" name="input[client_id]" id="hidden_id_2">
                                            <div class="form-group row">
                                                <div class="form-group col-lg-6">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Spouse</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_spouse]" id="client_spouse">
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Residence</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_spouse_address]" id="client_spouse_address">
                                                    </div>
                                                </div>

                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Certificate #</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_spouse_res_cert_no]" id="client_spouse_res_cert_no">
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Issued At</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_spouse_res_cert_issued_at]" id="client_spouse_res_cert_issued_at">
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Certificate Date</span>
                                                        </div>
                                                        <input type="date" class="form-control input-item" autocomplete="off" name="input[client_spouse_res_cert_date]" id="client_spouse_res_cert_date">
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Spouse Employer</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_spouse_employer]" id="client_spouse_employer">
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Bussiness Address</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_spouce_employer_address]" id="client_spouce_employer_address">
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Telephone #</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_spouce_employer_contact_no]" id="client_spouce_employer_contact_no">
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Position</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_spouse_position]" id="client_spouse_position">
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Income</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_spouse_income]" id="client_spouse_income">
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Length of Employement</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_spouse_leng_emp]" id="client_spouse_leng_emp">
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Prev. Employment</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_spouse_prev_employment]" id="client_spouse_prev_employment">
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Status of Employment</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_spouse_emp_status]" id="client_spouse_emp_status">
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">No. of Children</span>
                                                        </div>
                                                        <input type="number" min="0" class="form-control input-item" autocomplete="off" name="input[client_no_of_childred]" id="client_no_of_childred">
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Dependent on you</span>
                                                        </div>
                                                        <input type="number" min="0" class="form-control input-item" autocomplete="off" name="input[client_no_of_child_dependent]" id="client_no_of_child_dependent">
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">College</span>
                                                        </div>
                                                        <input type="number" min="0" class="form-control input-item" autocomplete="off" name="input[client_no_of_child_college]" id="client_no_of_child_college">
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">High School</span>
                                                        </div>
                                                        <input type="number" min="0" class="form-control input-item" autocomplete="off" name="input[client_no_of_child_hs]" id="client_no_of_child_hs">
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Elementary</span>
                                                        </div>
                                                        <input type="number" min="0" class="form-control input-item" autocomplete="off" name="input[client_no_of_child_elem]" id="client_no_of_child_elem">
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <button type="submit" id="btn_submit_2" class="btn btn-primary" style="float: right;">
                                                        Update Entry
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="income" role="tabpanel" aria-labelledby="income-tab3">
                                    <form method='POST' id='frm_client_3'>
                                        <input type="hidden" name="input[client_id]" id="hidden_id_3">
                                        <div id="page_content_3" class="tab wizard-pane">
                                            <div class="form-group row">
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Source Of Income</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_soi]" id="client_soi" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Source of income by whom</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" placeholder="" name="input[client_soi_by_whom]" id="client_soi_by_whom" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Monthly Income</span>
                                                        </div>
                                                        <input type="number" min="0" step="0.01" class="form-control input-item" autocomplete="off" placeholder="" name="input[client_soi_monthly_income]" id="client_soi_monthly_income" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Reference Name 1</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_credit_ref_name1]" id="client_credit_ref_name1" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Reference Address 1</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_credit_ref_address1]" id="client_credit_ref_address1" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Reference Name 2</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_credit_ref_name2]" id="client_credit_ref_name2" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Reference Address 2</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_credit_ref_address2]" id="client_credit_ref_address2" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Reference Name 3</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_credit_ref_name3]" id="client_credit_ref_name3" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Reference Address 3</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_credit_ref_address3]" id="client_credit_ref_address3" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Aprox Total Income</span>
                                                        </div>
                                                        <input type="number" min="0" step="0.01" class="form-control input-item" autocomplete="off" name="input[client_approx_total_monthly_income]" id="client_approx_total_monthly_income" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Total Oustanding Obligation</span>
                                                        </div>
                                                        <input type="number" min="0" step="0.01" class="form-control input-item" autocomplete="off" name="input[client_total_outstanding_obligation]" id="client_total_outstanding_obligation" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Business Name</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" placeholder="Business name" name="input[client_business_name]" id="client_business_name" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Address</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_business_address]" id="client_business_address" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Telephone No.</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_business_tel_no]" id="client_business_tel_no" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Position</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_business_position]" id="client_business_position" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Kind</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_business_kind]" id="client_business_kind" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Length</span>
                                                        </div>
                                                        <input type="number" min="0" class="form-control input-item" autocomplete="off" name="input[client_business_length]" id="client_business_length" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Capital Invested</span>
                                                        </div>
                                                        <input type="number" min="0" step="0.01" class="form-control input-item" autocomplete="off" name="input[client_business_capital_invested]" id="client_business_capital_invested" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Business Type</span>
                                                        </div>
                                                        <select class="form-control input-item" id="client_business_type" name="input[client_business_type]" required>
                                                            <option value="">Please Select</option>
                                                            <option value="Sole">Sole</option>
                                                            <option value="Owner">Owner</option>
                                                            <option value="Partner">Partner</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <button type="submit" id="btn_submit_3" class="btn btn-primary" style="float: right;">
                                                        Update Entry
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="insurance" role="tabpanel" aria-labelledby="insurance-tab3">
                                    <form method='POST' id='frm_client_4'>
                                        <input type="hidden" name="input[client_id]" id="hidden_id_4">
                                        <div id="page_content_3" class="tab wizard-pane">
                                            <div class="form-group row">
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Insurance</span>
                                                        </div>
                                                        <select class="form-control input-item" id="insurance_id" name="input[insurance_id]" required>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Amount</span>
                                                        </div>
                                                        <input type="number" min="0" step="0.01" class="form-control input-item" autocomplete="off" name="input[client_insurance_amount]" id="client_insurance_amount" required>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Maturity</span>
                                                        </div>
                                                        <input type="number" min="0" class="form-control input-item" autocomplete="off" name="input[client_insurance_maturity]" id="client_insurance_maturity" required>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Bank Transaction</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" name="input[client_bank_transaction]" id="client_bank_transaction" required>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Unpaid Obligation</span>
                                                        </div>
                                                        <input type="number" min="0" step="0.01" class="form-control input-item" autocomplete="off" name="input[client_unpaid_obligation]" id="client_unpaid_obligation" required>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Salary Withdrawal</span>
                                                        </div>
                                                        <select class="form-control input-item" id="client_salary_withdrawal" name="input[client_salary_withdrawal]" required>
                                                            <option value="">Please Select</option>
                                                            <option value="Weekly">Weekly</option>
                                                            <option value="Semi-monthly">Semi-monthly</option>
                                                            <option value="Monthly">Monthly</option>
                                                        </select>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Paymaster Name</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" placeholder="Paymaster fullname" name="input[client_paymaster_name]" id="client_paymaster_name" required>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Residence</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" placeholder="Paymaster address" name="input[client_paymaster_residence]" id="client_paymaster_residence" required>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Certificate #</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" placeholder="Paymaster certificate number" name="input[client_paymaster_res_cert_no]" id="client_paymaster_res_cert_no" required>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Issued At</span>
                                                        </div>
                                                        <input type="text" class="form-control input-item" autocomplete="off" placeholder="Paymaster certificate issued at" name="input[client_paymaster_res_cert_issued_at]" id="client_paymaster_res_cert_issued_at" required>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Certificate Date</span>
                                                        </div>
                                                        <input type="date" class="input-item form-control input-item" autocomplete="off" placeholder="Paymaster certificate issued date" name="input[client_paymaster_res_cert_date]" id="client_paymaster_res_cert_date" required>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group row">
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
                                                <div class="form-group col-lg-12">
                                                    <button type="submit" id="btn_submit_4" class="btn btn-primary" style="float: right;">
                                                        Update Entry
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="property" role="tabpanel" aria-labelledby="property-tab3">
                                    <div id="page_content_6" class="tab wizard-pane" style="width: -webkit-fill-available;">
                                        <form method='POST' id='frm_property'>
                                            <input type="hidden" name="input[client_id]" id="hidden_id_5">
                                            <div class="form-group row">
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <div class="form-group col-lg-12">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Location</span>
                                                                </div>
                                                                <input type="text" class="form-control p_required" autocomplete="off" name="input[property_location]" id="property_location" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-lg-6">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Area</span>
                                                                </div>
                                                                <input type="text" class="form-control p_required" autocomplete="off" name="input[property_area]" id="property_area" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-lg-6">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Cost</span>
                                                                </div>
                                                                <input type="number" min="0" step="0.01" class="p_required form-control" autocomplete="off" name="input[property_acquisition_cost]" id="property_acquisition_cost" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-lg-6">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Market Value</span>
                                                                </div>
                                                                <input type="number" min="0" step="0.01" class="p_required form-control" autocomplete="off" name="input[property_pres_market_val]" id="property_pres_market_val" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-lg-6">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">Improvement</span>
                                                                </div>
                                                                <input type="text" class="form-control" autocomplete="off" name="input[property_improvement]" id="property_improvement">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <button type="submit" style="float: right;" class="btn btn-icon icon-right btn-info">Add Entry</button>
                                                        </div>
                                                    </div>
                                                </div>

                                        </form>
                                        <div class="col-lg-6">
                                            <div class="table-responsive">
                                                <div class="table-responsive">
                                                    <table id="dt_properties" class="table table-striped" style="font-size:10px;width: 100%!important;">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col"></th>
                                                                <th scope="col">Location</th>
                                                                <th scope="col">Area</th>
                                                                <th scope="col">Cost</th>
                                                                <th scope="col">Value</th>
                                                                <th scope="col">Improvement</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="family" role="tabpanel" aria-labelledby="family-tab3">
                                <div id="page_content_7" class="tab wizard-pane" style="width: -webkit-fill-available;">
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <form method='POST' id='frm_children'>
                                                <input type="hidden" name="input[client_id]" id="hidden_id_6">
                                                <div class="row">
                                                    <div class="form-group col-lg-8">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Child Name</span>
                                                            </div>
                                                            <input type="text" class="c_required form-control" autocomplete="off" name="input[child_name]" id="child_name" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-lg-4">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Age</span>
                                                            </div>
                                                            <input type="number" min="0" class="c_required form-control" autocomplete="off" name="input[child_age]" id="child_age" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Gender</span>
                                                            </div>
                                                            <select class="c_required form-control input-item" id="child_sex" name="input[child_sex]" required>
                                                                <option value="">Please Select</option>
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><strong style="color:red;">*&nbsp;</strong>Occupation</span>
                                                            </div>

                                                            <input type="text" class="c_required form-control" autocomplete="off" name="input[child_occupation]" id="child_occupation" required>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <button type="submit" style="float: right;" class="btn btn-icon icon-right btn-info">Add Entry</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-lg-6">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include "modal_preview.php"; ?>
<script type="text/javascript">
    var client_id = "<?= $_GET['c']; ?>";

    function getPreview() {
        var id = client_id;
        $("#modalPreview").modal("show");
        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=" + route_settings.class_name + "&q=view",
            data: {
                input: {
                    id: id
                }
            },
            success: function(data) {
                get_property(id);
                get_children(id);
                var jsonParse = JSON.parse(data);
                const json = jsonParse.data;

                $('.label-item').map(function() {
                    const id_name = this.id;
                    const new_id = id_name.replace('_label', '');
                    this.innerHTML = json[new_id];
                });
            }
        });
    }

    $("#frm_client_1").submit(function(e) {
        e.preventDefault();

        $("#btn_submit_1").prop('disabled', true);
        $("#btn_submit_1").html("<span class='fa fa-spinner fa-spin'></span> Submitting ...");

        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=" + route_settings.class_name + "&q=update_1",
            data: $("#frm_client_1").serialize(),
            success: function(data) {
                var json = JSON.parse(data);
                if (json.data == 1) {
                    success_update();
                } else if (json.data == 2) {
                    entry_already_exists();
                } else {
                    failed_query(json);
                }
                $("#btn_submit_1").prop('disabled', false);
                $("#btn_submit_1").html("Update Entry");
            }
        });
    });

    $("#frm_client_2").submit(function(e) {
        e.preventDefault();

        $("#btn_submit_2").prop('disabled', true);
        $("#btn_submit_2").html("<span class='fa fa-spinner fa-spin'></span> Submitting ...");

        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=" + route_settings.class_name + "&q=update_2",
            data: $("#frm_client_2").serialize(),
            success: function(data) {
                var json = JSON.parse(data);
                if (json.data == 1) {
                    success_update();
                } else if (json.data == 2) {
                    entry_already_exists();
                } else {
                    failed_query(json);
                }
                $("#btn_submit_2").prop('disabled', false);
                $("#btn_submit_2").html("Update Entry");
            }
        });
    });

    $("#frm_client_3").submit(function(e) {
        e.preventDefault();

        $("#btn_submit_3").prop('disabled', true);
        $("#btn_submit_3").html("<span class='fa fa-spinner fa-spin'></span> Submitting ...");

        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=" + route_settings.class_name + "&q=update_3",
            data: $("#frm_client_3").serialize(),
            success: function(data) {
                var json = JSON.parse(data);
                if (json.data == 1) {
                    success_update();
                } else if (json.data == 2) {
                    entry_already_exists();
                } else {
                    failed_query(json);
                }
                $("#btn_submit_3").prop('disabled', false);
                $("#btn_submit_3").html("Update Entry");
            }
        });
    });

    $("#frm_client_4").submit(function(e) {
        e.preventDefault();

        $("#btn_submit_4").prop('disabled', true);
        $("#btn_submit_4").html("<span class='fa fa-spinner fa-spin'></span> Submitting ...");

        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=" + route_settings.class_name + "&q=update_4",
            data: $("#frm_client_4").serialize(),
            success: function(data) {
                var json = JSON.parse(data);
                if (json.data == 1) {
                    success_update();
                } else if (json.data == 2) {
                    entry_already_exists();
                } else {
                    failed_query(json);
                }
                $("#btn_submit_4").prop('disabled', false);
                $("#btn_submit_4").html("Update Entry");
            }
        });
    });


    $("#frm_property").submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=" + route_settings.class_name + "&q=addProperty",
            data: $("#frm_property").serialize(),
            success: function(data) {
                var json = JSON.parse(data);
                if (json.data == 1) {
                    $(".p_required").val("");
                    success_add();
                    getProperty();
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

    });


    $("#frm_children").submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=" + route_settings.class_name + "&q=addChildren",
            data: $("#frm_children").serialize(),
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

    });


    function getProperty() {

        var params = "client_id = '" + client_id + "'";

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
                        params: params
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

        var params = "client_id = '" + client_id + "'";

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
                        params: params
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

    $(document).ready(function() {
        getSelectOption('Insurance', 'insurance_id', 'insurance_name');
        getSelectOption('Branches', 'branch_id', 'branch_name');
        getEntryDetails(client_id);
        $("#hidden_id_1").val(client_id);
        $("#hidden_id_2").val(client_id);
        $("#hidden_id_3").val(client_id);
        $("#hidden_id_4").val(client_id);
        $("#hidden_id_5").val(client_id);
        $("#hidden_id_6").val(client_id);
        getProperty();
        getChildren();
    });
</script>