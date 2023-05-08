<style>
    .table.table-md th,
    .table.table-md td {
        padding: 5px 5px;
    }
</style>
<form metdod='POST'>
    <div class="modal fade" id="modalPreview" role="dialog" aria-labelledby="myModalLabel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="report_container">
                    <!-- <div class="row">
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
                            <label>Birtdday:</label>
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
                            <label>Lengtd:</label>
                            <h6 class="label-item" id="client_emp_lengtd_label"></h6>
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

                    </div> -->
                    <div class="table-responsive">
                        <table class="table table-md table-bordered" style="width:100%">
                            <thead></thead>
                            <tr>
                                <td colspan="2">
                                    <label>Name:</label>
                                    <h6 class="label-item" id="client_fullname_label"></h6>
                                </td>

                                <td>
                                    <label>Tel No.:</label>
                                    <h6 class="label-item" id="client_contact_no_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label>Address:</label>
                                    <h6 class="label-item" id="client_address_label"></h6>
                                </td>
                                <td>
                                    <label>Status:</label>
                                    <h6 class="label-item" id="client_address_status_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Age:</label>
                                    <h6 class="label-item" id="client_age_label"></h6>
                                </td>
                                <td>
                                    <label>Date of Birth:</label>
                                    <h6 class="label-item" id="client_dob_label"></h6>
                                </td>
                                <td>
                                    <label>Civil Status:</label>
                                    <h6 class="label-item" id="client_civil_status_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Res. Cert. No.:</label>
                                    <h6 class="label-item" id="client_res_cert_no_label"></h6>
                                </td>
                                <td>
                                    <label>Issued At:</label>
                                    <h6 class="label-item" id="client_res_cert_issued_at_label"></h6>
                                </td>
                                <td>
                                    <label>Date:</label>
                                    <h6 class="label-item" id="client_res_cert_date_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Where Employed:</label>
                                    <h6 class="label-item" id="client_employer_label"></h6>
                                </td>
                                <td>
                                    <label>Business Address:</label>
                                    <h6 class="label-item" id="client_employer_address_label"></h6>
                                </td>
                                <td>
                                    <label>Tel No.:</label>
                                    <h6 class="label-item" id="client_employer_contact_no_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Position:</label>
                                    <h6 class="label-item" id="client_emp_position_label"></h6>
                                </td>
                                <td>
                                    <label>Income:</label>
                                    <h6 class="label-item" id="client_emp_income_label"></h6>
                                </td>
                                <td>
                                    <label>Status of Employement:</label>
                                    <h6 class="label-item" id="client_emp_status_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Length of Employement:</label>
                                    <h6 class="label-item" id="client_emp_length_label"></h6>
                                </td>
                                <td colspan="2">
                                    <label>Previous Employement:</label>
                                    <h6 class="label-item" id="client_prev_emp_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label>Name of Husband or Spouse:</label>
                                    <h6 class="label-item" id="client_spouse_label"></h6>
                                </td>
                                <td>
                                    <label>Residence:</label>
                                    <h6 class="label-item" id="client_spouse_address_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label style="padding-left: 50px;">Res. Cert. No.:</label>
                                    <h6 style="padding-left: 50px;" style="padding-left: 50px;" class="label-item" id="client_spouse_res_cert_no_label"></h6>
                                </td>
                                <td>
                                    <label>Issued At:</label>
                                    <h6 class="label-item" id="client_spouse_res_cert_issued_at_label"></h6>
                                </td>
                                <td>
                                    <label>Date:</label>
                                    <h6 class="label-item" id="client_spouse_res_cert_date_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label style="padding-left: 50px;">Where Employed:</label>
                                    <h6 style="padding-left: 50px;" class="label-item" id="client_spouse_employer_label"></h6>
                                </td>
                                <td>
                                    <label>Business Address:</label>
                                    <h6 class="label-item" id="client_spouce_employer_address_label"></h6>
                                </td>
                                <td>
                                    <label>Tel. No.:</label>
                                    <h6 class="label-item" id="client_spouce_employer_contact_no_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label style="padding-left: 50px;">Position:</label>
                                    <h6 style="padding-left: 50px;" class="label-item" id="client_spouse_position_label"></h6>
                                </td>
                                <td>
                                    <label>Income:</label>
                                    <h6 class="label-item" id="client_spouse_income_label"></h6>
                                </td>
                                <td>
                                    <label>Status:</label>
                                    <h6 class="label-item" id="client_spouse_emp_status_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label style="padding-left: 50px;">Length:</label>
                                    <h6 style="padding-left: 50px;" class="label-item" id="client_spouse_leng_emp_label"></h6>
                                </td>
                                <td colspan="2">
                                    <label>Previous Employement:</label>
                                    <h6 class="label-item" id="client_spouse_prev_employment_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <label>No. Of Children:</label>
                                    <h6 class="label-item" id="client_no_of_childred_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <label>No. Of Children Dependent on you:</label>
                                    <h6 class="label-item" id="client_no_of_child_dependent_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>College:</label>
                                    <h6 class="label-item" id="client_no_of_child_college_label"></h6>
                                </td>
                                <td>
                                    <label>High School:</label>
                                    <h6 class="label-item" id="client_no_of_child_hs_label"></h6>
                                </td>
                                <td>
                                    <label>Elementary:</label>
                                    <h6 class="label-item" id="client_no_of_child_elem_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Source Of Income:</label>
                                    <h6 class="label-item" id="client_soi_label"></h6>
                                </td>
                                <td>
                                    <label>by whom:</label>
                                    <h6 class="label-item" id="client_soi_by_whom_label"></h6>
                                </td>
                                <td>
                                    <label>Total Monthly Income:</label>
                                    <h6 class="label-item" id="client_soi_monthly_income_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Credit Reference Name:</label>
                                    <h6 class="label-item" id="client_credit_ref_name1_label"></h6>
                                </td>
                                <td colspan="2">
                                    <label>Address:</label>
                                    <h6 class="label-item" id="client_credit_ref_address1_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h6 class="label-item" id="client_credit_ref_name2_label"></h6>
                                </td>
                                <td colspan="2">
                                    <h6 class="label-item" id="client_credit_ref_address2_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h6 class="label-item" id="client_credit_ref_name3_label"></h6>
                                </td>
                                <td colspan="2">
                                    <h6 class="label-item" id="client_credit_ref_address3_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Aproximate Total Monthly Income:</label>
                                    <h6 class="label-item" id="client_credit_ref_name3_label"></h6>
                                </td>
                                <td colspan="2">
                                    <label>Total Oustanding Obligation:</label>
                                    <h6 class="label-item" id="client_credit_ref_address3_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <label>If in business for self, please state.<br>Firm or Trade Name</label>
                                    <h6 class="label-item" id="client_business_name_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Address</label>
                                    <h6 class="label-item" id="client_business_address_label"></h6>
                                </td>
                                <td>
                                    <label>Tel No.:</label>
                                    <h6 class="label-item" id="client_business_tel_no_label"></h6>
                                </td>
                                <td>
                                    <label>Position:</label>
                                    <h6 class="label-item" id="client_business_position_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label>Kind of Business</label>
                                    <h6 class="label-item" id="client_business_kind_label"></h6>
                                </td>
                                <td>
                                    <label>How Long:</label>
                                    <h6 class="label-item" id="client_business_length_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label>Capital Invested</label>
                                    <h6 class="label-item" id="client_business_capital_invested_label"></h6>
                                </td>
                                <td>
                                    <label>Sole/Owner/Partner:</label>
                                    <h6 class="label-item" id="client_business_type_label"></h6>
                                </td>
                            </tr>

                        </table>

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