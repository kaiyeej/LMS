<style>
    .table.table-md th,
    .table.table-md td {
        padding: 5px 5px;
    }
</style>
<form metdod='POST'>
    <div class="modal fade" id="modalPreview" role="dialog" aria-labelledby="myModalLabel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" onclick="print_report('report_container')" class="btn btn-info">
                        <span class="fa fa-print"></span> Print
                    </button>
                </div>
                <div class="modal-body" id="report_container">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="./assets/img/logo2.png" alt="logo" width="150">
                        </div>
                        <div class="col-md-8" style="padding-top: 15px;">
                            <center>
                                <h5>FEATHERLEAF LENDING CORPORATION</h5>
                                <span>2ND FLOOR CARMEN BLDG., LIZARES AVENUE, BACOLOD CITY</span>
                            </center>
                        </div>
                    </div>
                    <div class="table-responsive" style="padding-top: 45px;">
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
                                <td colspan="3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Credit Reference Name:</label>
                                            <h6 class="label-item" id="client_credit_ref_name1_label"></h6>
                                            <h6 class="label-item" id="client_credit_ref_name2_label"></h6>
                                            <h6 class="label-item" id="client_credit_ref_name3_label"></h6>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Address:</label>
                                            <h6 class="label-item" id="client_credit_ref_address1_label"></h6>
                                            <h6 class="label-item" id="client_credit_ref_address2_label"></h6>
                                            <h6 class="label-item" id="client_credit_ref_address3_label"></h6>
                                        </div>
                                    </div>
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
                            <tr>
                                <td>
                                    <label>Insurance Carried</label>
                                    <h6 class="label-item" id="client_insurance_label"></h6>
                                </td>
                                <td>
                                    <label>Amount</label>
                                    <h6 class="label-item" id="client_insurance_amount_label"></h6>
                                </td>
                                <td>
                                    <label>Maturity</label>
                                    <h6 class="label-item" id="client_insurance_maturity_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label>Bank Transacted</label>
                                    <h6 class="label-item" id="client_bank_transaction_label"></h6>
                                </td>
                                <td>
                                    <label>Unpaid Obligation with other entities</label>
                                    <h6 class="label-item" id="client_unpaid_obligation_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Name of Paymaster</label>
                                    <h6 class="label-item" id="client_paymaster_name_label"></h6>
                                </td>
                                <td colspan="2">
                                    <label>Residence</label>
                                    <h6 class="label-item" id="client_paymaster_residence_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Res. Cert. No.</label>
                                    <h6 class="label-item" id="client_paymaster_res_cert_no_label"></h6>
                                </td>
                                <td>
                                    <label>Issued At</label>
                                    <h6 class="label-item" id="client_paymaster_res_cert_issued_at_label"></h6>
                                </td>
                                <td>
                                    <label>Date</label>
                                    <h6 class="label-item" id="client_paymaster_res_cert_date_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <label>Is he/she willing to deduct from your salary, with your consent and authority, the amount payable to us under installment?</label>
                                    <h6 class="label-item" id="client_paymaster_client_deduct_salary_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <label>Are you willing to have your installment deducted from your salary by your paymaster under first priority?</label>
                                    <h6 class="label-item" id="client_paymaster_conformity_label"></h6>
                                    <label>Is your paymaster willing to conform to this requirement under his/her personal obligation and liability to fulfill incase of failure if so.</label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>Real Property Owned Location</label>
                                        </div>
                                        <div class="col-md-2">
                                            <label>Area</label>
                                        </div>
                                        <div class="col-md-2">
                                            <label>Acquisition Cost</label>
                                        </div>
                                        <div class="col-md-2">
                                            <label>Present Market Value</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Improvement, if any</label>
                                        </div>
                                    </div>
                                    <div class="row" id="property_container"></div>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="3">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>Child Name</label>
                                        </div>
                                        <div class="col-md-2">
                                            <label>Gender</label>
                                        </div>
                                        <div class="col-md-2">
                                            <label>Age</label>
                                        </div>
                                        <div class="col-md-5">
                                            <label>Occupation</label>
                                        </div>
                                    </div>
                                    <div class="row" id="children_container"></div>
                                </td>
                            </tr>

                        </table>

                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    

    function get_property(id) {
        var params = "client_id = '" + id + "'";
        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=" + route_settings.class_name + "&q=get_property",
            data: {
                input: {
                    params: params
                }
            },
            success: function(data) {
                var jsonParse = JSON.parse(data);
                const json = jsonParse.data;
                console.log(json);
                $("#property_container").html(json);
            }
        });
    }

    function get_children(id) {
        var params = "client_id = '" + id + "'";
        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=" + route_settings.class_name + "&q=get_children",
            data: {
                input: {
                    params: params
                }
            },
            success: function(data) {
                var jsonParse = JSON.parse(data);
                const json = jsonParse.data;
                console.log(json);
                $("#children_container").html(json);
            }
        });
    }
</script>