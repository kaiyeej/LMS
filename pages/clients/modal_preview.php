<form method='POST'>
    <div class="modal fade" id="modalPreview" role="dialog" aria-labelledby="myModalLabel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="report_container">
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label>First Name:</label>
                            <h6 class="label-item" id="client_fname_label"></h6>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Middle Name:</label>
                            <h6 class="label-item" id="client_mname_label"></h6>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Last Name:</label>
                            <h6 class="label-item" id="client_lname_label"></h6>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Suffix:</label>
                            <h6 class="label-item" id="client_name_extension_label"></h6>
                        </div>
                        
                        <div class="col-md-2 form-group">
                            <label>Birthday:</label>
                            <h6 class="label-item" id="client_dob_label"></h6>
                        </div>
                        <div class="col-md-2 form-group">
                            <label>Contact #:</label>
                            <h6 class="label-item" id="client_contact_no_label"></h6>
                        </div>
                        <div class="col-md-2 form-group">
                            <label>Civil Status:</label>
                            <h6 class="label-item" id="client_civil_status_label"></h6>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address:</label>
                            <h6 class="label-item" id="client_address_label"></h6>
                        </div>

                        <div class="col-md-3 form-group">
                            <label>Status:</label>
                            <h6 class="label-item" id="client_address_status_label"></h6>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Resident Certificate #:</label>
                            <h6 class="label-item" id="client_res_cert_no_label"></h6>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Issued At:</label>
                            <h6 class="label-item" id="client_res_cert_issued_at_label"></h6>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Certificate Date:</label>
                            <h6 class="label-item" id="client_res_cert_date_label"></h6>
                        </div>

                        <div class="col-md-3 form-group">
                            <label>Employer:</label>
                            <h6 class="label-item" id="client_employer_label"></h6>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Address:</label>
                            <h6 class="label-item" id="client_employer_address_label"></h6>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Contact #:</label>
                            <h6 class="label-item" id="client_employer_contact_no_label"></h6>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Position:</label>
                            <h6 class="label-item" id="client_emp_position_label"></h6>
                        </div>

                        <div class="col-md-3 form-group">
                            <label>Income:</label>
                            <h6 class="label-item" id="client_emp_income_label"></h6>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Status:</label>
                            <h6 class="label-item" id="client_emp_status_label"></h6>
                        </div>
                        <div class="col-md-2 form-group">
                            <label>Length:</label>
                            <h6 class="label-item" id="client_emp_length_label"></h6>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Previous Employment:</label>
                            <h6 class="label-item" id="client_prev_emp_label"></h6>
                        </div>
                        
                        <div class="col-md-12"><hr style="margin-top: 0rem;margin-bottom: 0rem;"></div>

                        <div class="col-md-3 form-group">
                            <label>Spouce:</label>
                            <h6 class="label-item" id="client_spouse_label"></h6>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Address:</label>
                            <h6 class="label-item" id="client_spouse_address_label"></h6>
                        </div>
                        <div class="col-md-2 form-group">
                            <label>Certificate #:</label>
                            <h6 class="label-item" id="client_spouse_res_cert_no_label"></h6>
                        </div>
                        <div class="col-md-2 form-group">
                            <label>Issued At:</label>
                            <h6 class="label-item" id="client_spouse_res_cert_issued_at_label"></h6>
                        </div>
                        <div class="col-md-2 form-group">
                            <label>Certificate Date:</label>
                            <h6 class="label-item" id="client_spouse_res_cert_issued_at_label"></h6>
                        </div>

                        <div class="col-md-3 form-group">
                            <label>No. of Children:</label>
                            <h6 class="label-item" id="client_no_of_childred_label"></h6>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>No. of Children Dependent on you:</label>
                            <h6 class="label-item" id="client_no_of_child_dependent_label"></h6>
                        </div>
                        <div class="col-md-2 form-group">
                            <label>College:</label>
                            <h6 class="label-item" id="client_no_of_child_college_label"></h6>
                        </div>
                        <div class="col-md-2 form-group">
                            <label>High School:</label>
                            <h6 class="label-item" id="client_no_of_child_hs_label"></h6>
                        </div>
                        <div class="col-md-2 form-group">
                            <label>Elementary:</label>
                            <h6 class="label-item" id="client_no_of_child_elem_label"></h6>
                        </div>

                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" id="btn_submit" onclick="print_report('report_container')" class="btn btn-secondary">
                       <span class="fa fa-print"></span> Print
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>