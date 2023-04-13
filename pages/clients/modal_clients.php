<form method='POST' id='frm_client'>
    <div class="modal fade" id="modalEntry" role="dialog" aria-labelledby="myModalLabel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
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
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <div class="wizard-steps">
                                                <div class="wizard-step">
                                                    <div class="wizard-step-icon">
                                                        <i class="far fa-user"></i>
                                                    </div>
                                                    <div class="wizard-step-label">
                                                        Personal Information
                                                    </div>
                                                </div>
                                                <div class="wizard-step">
                                                    <div class="wizard-step-icon">
                                                        <i class="fas fa-briefcase"></i>
                                                    </div>
                                                    <div class="wizard-step-label">
                                                        Employer Information
                                                    </div>
                                                </div>
                                                <div class="wizard-step">
                                                    <div class="wizard-step-icon">
                                                        <i class="fas fa-clipboard"></i>
                                                    </div>
                                                    <div class="wizard-step-label">
                                                        Additional Information
                                                    </div>
                                                </div>
                                                <div class="wizard-step">
                                                    <div class="wizard-step-icon">
                                                        <i class="fas fa-clipboard"></i>
                                                    </div>
                                                    <div class="wizard-step-label">
                                                        Source of Income
                                                    </div>
                                                </div>
                                                <div class="wizard-step">
                                                    <div class="wizard-step-icon">
                                                        <i class="fas fa-clipboard"></i>
                                                    </div>
                                                    <div class="wizard-step-label">
                                                        Insurance
                                                    </div>
                                                </div>
                                                <div class="wizard-step">
                                                    <div class="wizard-step-icon">
                                                        <i class="fas fa-clipboard"></i>
                                                    </div>
                                                    <div class="wizard-step-label">
                                                        Paymaster
                                                    </div>
                                                </div>
                                                <div class="wizard-step">
                                                    <div class="wizard-step-icon">
                                                        <i class="fas fa-clipboard"></i>
                                                    </div>
                                                    <div class="wizard-step-label">
                                                        Property
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form class="wizard-content mt-2">
                                    <div id="page_content_1" class="tab wizard-pane">
                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <label class="text-md-right text-left">First name</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Client middle name" name="input[client_fname]" id="client_fname" required>
                                            </div>
                                            <div class="col-lg-3">
                                                <label class="text-md-right text-left">Middle name</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Client middle name" name="input[client_mname]" id="client_mname">
                                            </div>
                                            <div class="col-lg-3">
                                                <label class="text-md-right text-left">Last name</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Client middle name" name="input[client_lname]" id="client_lname" required>
                                            </div>
                                            <div class="col-lg-2">
                                                <label class="text-md-right text-left">Suffix</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Suffix" name="input[client_name_extension]" id="client_name_extension">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <label class="text-md-right text-left">Civil Status</label>
                                                <select class="form-control select2 input-item" id="client_civil_status" name="input[client_civil_status]" style="width:100%;" required>
                                                    <option value="">Please Select</option>
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Widowed">Widowed</option>
                                                    <option value="Seperated">Seperated</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="text-md-right text-left">Birthday</label>
                                                <input type="date" class="form-control input-item" autocomplete="off" placeholder="Client middle name" name="input[client_dob]" id="client_dob" required>
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="text-md-right text-left">Contact #</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Client contact number" name="input[client_contact_no]" id="client_contact_no" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-8">
                                                <label class="text-md-right text-left">Address</label>
                                                <textarea class="form-control input-item" autocomplete="off" placeholder="Client address" name="input[client_address]" id="client_address" required></textarea>
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="text-md-right text-left">Status</label>
                                                <select class="form-control select2 input-item" id="client_address_status" name="input[client_address_status]" style="width:100%;" required>
                                                    <option value="">Please Select</option>
                                                    <option value="Owned">Owned</option>
                                                    <option value="Rented">Rented</option>
                                                    <option value="Free Use">Free Use</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <label class="text-md-right text-left">Resident Certificate #</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Certificate number" name="input[client_res_cert_no]" id="client_res_cert_no" required>
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="text-md-right text-left">Issued At</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Certificate issued at" name="input[client_res_cert_issued_at]" id="client_res_cert_issued_at" required>
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="text-md-right text-left">Certificate Date</label>
                                                <input type="date" class="form-control input-item" autocomplete="off" placeholder="Certificate issued date" name="input[client_res_cert_date]" id="client_res_cert_date" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <!-- <div class="col-md-6">
                                            
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <a href="#" class="btn btn-icon icon-right btn-primary"><i class="fas fa-arrow-left"></i> Back</a>
                                            <a href="#" class="btn btn-icon icon-right btn-primary">Next <i class="fas fa-arrow-right"></i></a>
                                        </div> -->
                                        </div>
                                    </div>

                                    <div id="page_content_2" class="tab wizard-pane">
                                        <div class="form-group row">
                                            <div class="col-lg-6" style="padding: 10px;">
                                                <label class="text-md-right text-left">Employer</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Employer name" name="input[client_employer]" id="client_employer" required>
                                            </div>
                                            <div class="col-lg-6" style="padding: 10px;">
                                                <label class="text-md-right text-left">Address</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Employer address" name="input[client_employer_address]" id="client_employer_address" required>
                                            </div>


                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Contact #</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Contact number" name="input[client_employer_contact_no]" id="client_employer_contact_no" required>
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Position</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Position" name="input[client_emp_position]" id="client_emp_position" required>
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Income</label>
                                                <input type="number" class="form-control input-item" autocomplete="off" placeholder="Monthly salary" name="input[client_emp_income]" id="client_emp_income" required>
                                            </div>


                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Status</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Status of employment" name="input[client_emp_status]" id="client_emp_status" required>
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Length</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Length of employment" name="input[client_emp_length]" id="client_emp_length" required>
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Previous Employment</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Previous employment" name="input[client_prev_emp]" id="client_prev_emp">
                                            </div>

                                        </div>
                                    </div>

                                    <div id="page_content_3" class="tab wizard-pane">
                                        <div class="form-group row">
                                            <div class="col-lg-6" style="padding: 10px;">
                                                <label class="text-md-right text-left">Spouse</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Spouse fullname" name="input[client_spouse]" id="client_spouse" required>
                                            </div>
                                            <div class="col-lg-6" style="padding: 10px;">
                                                <label class="text-md-right text-left">Address</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Spouse address" name="input[client_spouse_address]" id="client_spouse_address" required>
                                            </div>

                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Resident Certificate #</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Spouse certificate number" name="input[client_spouse_res_cert_no]" id="client_spouse_res_cert_no" required>
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Issued At</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Spouse certificate issued at" name="input[client_spouse_res_cert_issued_at]" id="client_spouse_res_cert_issued_at" required>
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Certificate Date</label>
                                                <input type="date" class="form-control input-item" autocomplete="off" placeholder="Spouse certificate issued date" name="input[client_spouse_res_cert_date]" id="client_spouse_res_cert_date" required>
                                            </div>

                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Spouse Employer</label>
                                                <input type="text" class="form-control input-item" autocomplete="off" placeholder="Employer name" name="input[client_spouse_employer]" id="client_spouse_employer" required>
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">No. of Children</label>
                                                <input type="number" class="form-control input-item" autocomplete="off" placeholder="Number of children" name="input[client_no_of_childred]" id="client_no_of_childred" required>
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">No. of Children Dependent on you</label>
                                                <input type="number" class="form-control input-item" autocomplete="off" placeholder="Number of Children Dependent on you" name="input[client_no_of_child_dependent]" id="client_no_of_child_dependent" required>
                                            </div>

                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">College</label>
                                                <input type="number" class="form-control input-item" autocomplete="off" placeholder="Number of children studying" name="input[client_no_of_child_college]" id="client_no_of_child_college" required>
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">High School</label>
                                                <input type="number" class="form-control input-item" autocomplete="off" placeholder="Number of children studying" name="input[client_no_of_child_hs]" id="client_no_of_child_hs" required>
                                            </div>
                                            <div class="col-lg-4" style="padding: 10px;">
                                                <label class="text-md-right text-left">Elementary</label>
                                                <input type="number" class="form-control input-item" autocomplete="off" placeholder="Number of children studying" name="input[client_no_of_child_elem]" id="client_no_of_child_elem" required>
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
            document.getElementById("nextBtn").innerHTML = "Submit";
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
        y = x[currentTab].querySelectorAll("[required]");
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
        var hidden_id = $("#hidden_id").val();
        var q = hidden_id > 0 ? "edit" : "add";
        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=" + route_settings.class_name + "&q=" + q,
            data: $("#frm_client").serialize(),
            success: function(data) {
                var json = JSON.parse(data);
                if (json.data > 0) {
                    if (currentTab == 3) {
                        success_update();
                        $("#modalEntry").modal('hide');
                        currentTab = 0;
                    }else if(currentTab == 1 && q == "add"){
                        $("#hidden_id").val(json.data);
                    }
                
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
    }
</script>