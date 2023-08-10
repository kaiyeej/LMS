<style>
    .table.table-md th,
    .table.table-md td {
        padding: 5px 5px;
    }
</style>
<form metdod='POST'>
    <div class="modal fade" id="modalPreview" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                    <h6 class="label-item" id="residence_label"></h6>
                                </td>
                                <td>
                                    <label>Status:</label>
                                    <h6 class="label-item" id="residence_status_label"></h6>
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
                                    <h6 class="label-item" id="residence_certificate_no_label"></h6>
                                </td>
                                <td>
                                    <label>Issued At:</label>
                                    <h6 class="label-item" id="certificate_issued_at_label"></h6>
                                </td>
                                <td>
                                    <label>Date:</label>
                                    <h6 class="label-item" id="certificate_date_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Where Employed:</label>
                                    <h6 class="label-item" id="employer_label"></h6>
                                </td>
                                <td>
                                    <label>Business Address:</label>
                                    <h6 class="label-item" id="employer_address_label"></h6>
                                </td>
                                <td>
                                    <label>Tel No.:</label>
                                    <h6 class="label-item" id="employer_contact_no_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Position:</label>
                                    <h6 class="label-item" id="employment_position_label"></h6>
                                </td>
                                <td>
                                    <label>Income:</label>
                                    <h6 class="label-item" id="employment_income_label"></h6>
                                </td>
                                <td>
                                    <label>Status of Employement:</label>
                                    <h6 class="label-item" id="employment_status_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Length of Employement:</label>
                                    <h6 class="label-item" id="employment_length_label"></h6>
                                </td>
                                <td colspan="2">
                                    <label>Previous Employement:</label>
                                    <h6 class="label-item" id="last_employment_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label>Name of Husband or Spouse:</label>
                                    <h6 class="label-item" id="spouse_name_label"></h6>
                                </td>
                                <td>
                                    <label>Residence:</label>
                                    <h6 class="label-item" id="spouse_residence_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label style="padding-left: 50px;">Res. Cert. No.:</label>
                                    <h6 style="padding-left: 50px;" style="padding-left: 50px;" class="label-item" id="spouse_res_cert_no_label"></h6>
                                </td>
                                <td>
                                    <label>Issued At:</label>
                                    <h6 class="label-item" id="spouse_res_cert_issued_at_label"></h6>
                                </td>
                                <td>
                                    <label>Date:</label>
                                    <h6 class="label-item" id="spouse_res_cert_date_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label style="padding-left: 50px;">Where Employed:</label>
                                    <h6 style="padding-left: 50px;" class="label-item" id="spouse_employer_label"></h6>
                                </td>
                                <td>
                                    <label>Business Address:</label>
                                    <h6 class="label-item" id="spouse_employer_address_label"></h6>
                                </td>
                                <td>
                                    <label>Tel. No.:</label>
                                    <h6 class="label-item" id="spouse_employer_contact_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label style="padding-left: 50px;">Position:</label>
                                    <h6 style="padding-left: 50px;" class="label-item" id="spouse_employment_position_label"></h6>
                                </td>
                                <td>
                                    <label>Income:</label>
                                    <h6 class="label-item" id="spouse_employment_income_label"></h6>
                                </td>
                                <td>
                                    <label>Status:</label>
                                    <h6 class="label-item" id="spouse_employment_status_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label style="padding-left: 50px;">Length:</label>
                                    <h6 style="padding-left: 50px;" class="label-item" id="spouse_employment_length_label"></h6>
                                </td>
                                <td colspan="2">
                                    <label>Previous Employement:</label>
                                    <h6 class="label-item" id="spouse_last_employment_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <label>No. Of Children:</label>
                                    <h6 class="label-item" id="no_of_children_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <label>No. Of Children Dependent on you:</label>
                                    <h6 class="label-item" id="dep_no_of_child_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>College:</label>
                                    <h6 class="label-item" id="dep_college_label"></h6>
                                </td>
                                <td>
                                    <label>High School:</label>
                                    <h6 class="label-item" id="dep_hs_label"></h6>
                                </td>
                                <td>
                                    <label>Elementary:</label>
                                    <h6 class="label-item" id="dep_elem_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Source Of Income:</label>
                                    <h6 class="label-item" id="soi_name_label"></h6>
                                </td>
                                <td>
                                    <label>by whom:</label>
                                    <h6 class="label-item" id="soi_by_label"></h6>
                                </td>
                                <td>
                                    <label>Total Monthly Income:</label>
                                    <h6 class="label-item" id="soi_monthly_label"></h6>
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
                                    <h6 class="label-item" id="soi_total_label"></h6>
                                </td>
                                <td colspan="2">
                                    <label>Total Oustanding Obligation:</label>
                                    <h6 class="label-item" id="soi_obligation_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <label>If in business for self, please state.<br>Firm or Trade Name</label>
                                    <h6 class="label-item" id="business_name_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Address</label>
                                    <h6 class="label-item" id="business_address_label"></h6>
                                </td>
                                <td>
                                    <label>Tel No.:</label>
                                    <h6 class="label-item" id="business_contact_label"></h6>
                                </td>
                                <td>
                                    <label>Position:</label>
                                    <h6 class="label-item" id="business_position_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label>Kind of Business</label>
                                    <h6 class="label-item" id="business_kind_label"></h6>
                                </td>
                                <td>
                                    <label>How Long:</label>
                                    <h6 class="label-item" id="business_length_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label>Capital Invested</label>
                                    <h6 class="label-item" id="business_capital_label"></h6>
                                </td>
                                <td>
                                    <label>Sole/Owner/Partner:</label>
                                    <h6 class="label-item" id="business_type_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Insurance Carried</label>
                                    <h6 class="label-item" id="insurance_label"></h6>
                                </td>
                                <td>
                                    <label>Amount</label>
                                    <h6 class="label-item" id="insurance_amount_label"></h6>
                                </td>
                                <td>
                                    <label>Maturity</label>
                                    <h6 class="label-item" id="insurance_maturity_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label>Bank Transacted</label>
                                    <h6 class="label-item" id="insurance_bank_transaction_label"></h6>
                                </td>
                                <td>
                                    <label>Unpaid Obligation with other entities</label>
                                    <h6 class="label-item" id="insurance_unpaid_obligation_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Name of Paymaster</label>
                                    <h6 class="label-item" id="paymaster_name_label"></h6>
                                </td>
                                <td colspan="2">
                                    <label>Residence</label>
                                    <h6 class="label-item" id="paymaster_address_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Res. Cert. No.</label>
                                    <h6 class="label-item" id="paymaster_res_cert_no_label"></h6>
                                </td>
                                <td>
                                    <label>Issued At</label>
                                    <h6 class="label-item" id="paymaster_res_cert_issued_at_label"></h6>
                                </td>
                                <td>
                                    <label>Date</label>
                                    <h6 class="label-item" id="paymaster_res_cert_date_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <label>Is he/she willing to deduct from your salary, with your consent and authority, the amount payable to us under installment?</label>
                                    <h6 class="label-item" id="paymaster_client_deduct_salary_label"></h6>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <label>Are you willing to have your installment deducted from your salary by your paymaster under first priority?</label>
                                    <h6 class="label-item" id="paymaster_conformity_label"></h6>
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
        var param = "client_id = '" + id + "'";
        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=ClientProperty&q=show",
            data: {
                input: {
                    param: param
                }
            },
            success: function(data) {
                var jsonParse = JSON.parse(data);
                const json = jsonParse.data;
                console.log(json);

                var property_container = "";
                if (json.length > 0) {
                    for (var cIndex = 0; cIndex < json.length; cIndex++) {
                        var property_data = json[cIndex];
                        property_container += `<div class="col-md-3"><h6>${property_data.property_location}</h6></div>
                            <div class="col-md-2"><h6>${property_data.property_area}</h6></div>
                            <div class="col-md-2"><h6>${numberFormat(property_data.property_acquisition_cost)}</h6></div>
                            <div class="col-md-2"><h6>${numberFormat(property_data.property_pres_market_val)}</h6></div>
                            <div class="col-md-3"><h6>${property_data.property_improvement}</h6></div>`;
                    }
                }

                $("#property_container").html(property_container);
            }
        });
    }

    function get_children(id) {
        var param = "client_id = '" + id + "'";
        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=ClientChildren&q=show",
            data: {
                input: {
                    param: param
                }
            },
            success: function(data) {
                var jsonParse = JSON.parse(data);
                const json = jsonParse.data;

                var children_container = "";
                if (json.length > 0) {
                    for (var cIndex = 0; cIndex < json.length; cIndex++) {
                        var child_data = json[cIndex];
                        children_container += `<div class="col-md-3"><h6>${child_data.child_name}</h6></div>
                            <div class="col-md-2"><h6>${child_data.child_sex}</h6></div>
                            <div class="col-md-2"><h6>${child_data.child_age}</h6></div>
                            <div class="col-md-5"><h6>${child_data.child_occupation}</h6></div>`;
                    }
                }
                console.log(json);
                $("#children_container").html(children_container);
            }
        });
    }
</script>