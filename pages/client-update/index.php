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
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Client</h4>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills" id="myTab3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="personal-tab3" data-toggle="tab" href="#personal3" role="tab" aria-controls="personal" aria-selected="true">Personal Information</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="additional-tab3" data-toggle="tab" href="#additional3" role="tab" aria-controls="additional" aria-selected="false">Additional Information</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#contact3" role="tab" aria-controls="contact" aria-selected="false">Source of Income</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#contact3" role="tab" aria-controls="contact" aria-selected="false">Insurance</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#contact3" role="tab" aria-controls="contact" aria-selected="false">Property</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#contact3" role="tab" aria-controls="contact" aria-selected="false">Family</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent2">
                                <div class="tab-pane fade active show" id="personal3" role="tabpanel" aria-labelledby="personal-tab3">
                                    <div id="page_content_1" class="container">
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
                                </div>
                                <div class="tab-pane fade" id="additional3" role="tabpanel" aria-labelledby="additional-tab3">
                                    <div id="page_content_2" class="container">
                                        <div class="form-group row">
                                            <div class="col-lg-6" style="padding: 10px;">
                                                <label class="text-md-right text-left">Spouse</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Spouse fullname" name="input[client_spouse]" id="client_spouse">
                                            </div>
                                            <div class="col-lg-6" style="padding: 10px;">
                                                <label class="text-md-right text-left">Residence</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Spouse address" name="input[client_spouse_address]" id="client_spouse_address">
                                            </div>

                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Resident Certificate #</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Spouse certificate number" name="input[client_spouse_res_cert_no]" id="client_spouse_res_cert_no">
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Issued At</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Spouse certificate issued at" name="input[client_spouse_res_cert_issued_at]" id="client_spouse_res_cert_issued_at">
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Certificate Date</label>
                                                <input type="date" class="required form-control input-item" autocomplete="off" placeholder="Spouse certificate issued date" name="input[client_spouse_res_cert_date]" id="client_spouse_res_cert_date">
                                            </div>

                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Spouse Employer</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Employer name" name="input[client_spouse_employer]" id="client_spouse_employer">
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Bussiness Address</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Employer name" name="input[client_spouce_employer_address]" id="client_spouce_employer_address">
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Telephone #</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Employer name" name="input[client_spouce_employer_contact_no]" id="client_spouce_employer_contact_no">
                                            </div>

                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Position</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Employer name" name="input[client_spouse_position]" id="client_spouse_position">
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Income</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Employer name" name="input[client_spouse_income]" id="client_spouse_income">
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Status of Employment</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Employer name" name="input[client_spouse_emp_status]" id="client_spouse_emp_status">
                                            </div>

                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Length of Employement</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Employer name" name="input[client_spouse_leng_emp]" id="client_spouse_leng_emp">
                                            </div>
                                            <div class="col-lg-8" style="padding: 10px;">
                                                <label class="text-md-right text-left">Prev. Employment</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Employer name" name="input[client_spouse_prev_employment]" id="client_spouse_prev_employment">
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Status of Employment</label>
                                                <input type="text" class="required form-control input-item" autocomplete="off" placeholder="Employer name" name="input[client_spouse_emp_status]" id="client_spouse_emp_status">
                                            </div>

                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">No. of Children</label>
                                                <input type="number" class="required form-control input-item" autocomplete="off" placeholder="Number of children" name="input[client_no_of_childred]" id="client_no_of_childred">
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">No. of Children Dependent on you</label>
                                                <input type="number" class="required form-control input-item" autocomplete="off" placeholder="Number of Children Dependent on you" name="input[client_no_of_child_dependent]" id="client_no_of_child_dependent">
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">College</label>
                                                <input type="number" class="required form-control input-item" autocomplete="off" placeholder="Number of children studying" name="input[client_no_of_child_college]" id="client_no_of_child_college">
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">High School</label>
                                                <input type="number" class="required form-control input-item" autocomplete="off" placeholder="Number of children studying" name="input[client_no_of_child_hs]" id="client_no_of_child_hs">
                                            </div>
                                            <div class="col-lg-3" style="padding: 10px;">
                                                <label class="text-md-right text-left">Elementary</label>
                                                <input type="number" class="required form-control input-item" autocomplete="off" placeholder="Number of children studying" name="input[client_no_of_child_elem]" id="client_no_of_child_elem">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="contact3" role="tabpanel" aria-labelledby="contact-tab3">
                                    Vestibulum imperdiet odio sed neque ultricies, ut dapibus mi maximus. Proin ligula massa, gravida in lacinia efficitur, hendrerit eget mauris. Pellentesque fermentum, sem interdum molestie finibus, nulla diam varius leo, nec varius lectus elit id dolor.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<?php include "modal_clients.php"; ?>
<?php include "modal_preview.php"; ?>
<script type="text/javascript">
    function addClient() {
        modal_detail_status = 0;
        $("#hidden_id").val(0);
        document.getElementById("frm_client").reset();

        $("#modalLabel").html("<i class='fa fa-edit'></i> Add Entry");
        $("#modalEntry").modal('show');

        currentTab = 0;
        showTab(currentTab);
        $('.select2').select2().trigger('change');
    }

    function getEntries() {
        $("#dt_entries").DataTable().destroy();
        $("#dt_entries").DataTable({
            "processing": true,
            "ajax": {
                "url": "controllers/sql.php?c=" + route_settings.class_name + "&q=show",
                "dataSrc": "data"
            },
            "columns": [{
                    "mRender": function(data, type, row) {
                        return '<div class="custom-checkbox custom-control"><input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" name="dt_id" id="checkbox-b' + row.client_id + '" value=' + row.client_id + '><label for="checkbox-b' + row.client_id + '" class="custom-control-label">&nbsp;</label></div>';
                    }
                },
                {
                    "mRender": function(data, type, row) {
                        return "<center><button class='btn btn-sm btn-info' onclick='getEntryDetails(" + row.client_id + ");getProperty()'><span class='fa fa-edit'></span></button><button class='btn btn-sm btn-warning' onclick='getPreview(" + row.client_id + ")'><span class='fa fa-file-alt'></span></button></center>";
                    }
                },
                {
                    "data": "client_fullname"
                },
                {
                    "data": "client_address"
                },
                {
                    "data": "client_contact_no"
                },
                {
                    "data": "date_added"
                },
                {
                    "data": "date_last_modified"
                }
            ]
        });
    }

    function getPreview(id) {
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
                getProperty(id);
                getChildren(id);
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

    function getProperty(id) {
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

    function getChildren(id) {
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

    $("#modalEntry").on('hide.bs.modal', function() {
        currentTab = 0;
        showTab(0);
        $(".required").removeClass("invalid");
        $(".p_required").removeClass("invalid");
        $(".wizard-step").removeClass("wizard-step-info");
        $(".tab").css({
            "display": "none"
        });
        $("#page_content_1").css({
            "display": "block"
        });
    });

    $(document).ready(function() {
        getEntries();
        getSelectOption('Insurance', 'insurance_id', 'insurance_name');
    });
</script>