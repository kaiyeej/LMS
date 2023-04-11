<form method='POST' id='frm_submit'>
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
                    <!-- <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>First Name</label>
                            <input type="text" class="form-control input-item" autocomplete="off" placeholder="Client first name" name="input[client_fname]" id="client_fname" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Middle Name</label>
                            <input type="text" class="form-control input-item" autocomplete="off" placeholder="Client middle name" name="input[client_mname]" id="client_mname" required>
                        </div>
                        <div class="form-group col-md-8">
                            <label>Last Name</label>
                            <input type="text" class="form-control input-item" autocomplete="off" placeholder="Client last name" name="input[client_lname]" id="client_lname" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Suffix</label>
                            <input type="text" class="form-control input-item" autocomplete="off" placeholder="Name extension" name="input[client_name_extension]" id="client_name_extension">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Date of Birth</label>
                            <input type="date" class="form-control input-item" name="input[client_dob]" id="client_dob" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Contact #</label>
                            <input type="text" class="form-control input-item" placeholder="Contact number" name="input[client_contact_no]" id="client_contact_no" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Address</label>
                            <textarea class="form-control input-item" placeholder="Address" name="input[client_address]" id="client_address" required></textarea>
                        </div>
                    </div> -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="wizard-steps">
                                        <div id="page_1" class="wizard-step wizard-step-active">
                                            <div class="wizard-step-icon">
                                                <i class="far fa-user"></i>
                                            </div>
                                            <div class="wizard-step-label">
                                                User Account
                                            </div>
                                        </div>
                                        <div id="page_2" class="wizard-step">
                                            <div class="wizard-step-icon">
                                                <i class="fas fa-box-open"></i>
                                            </div>
                                            <div class="wizard-step-label">
                                                Create an App
                                            </div>
                                        </div>
                                        <div id="page_3" class="wizard-step">
                                            <div class="wizard-step-icon">
                                                <i class="fas fa-server"></i>
                                            </div>
                                            <div class="wizard-step-label">
                                                Server Information
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <form class="wizard-content mt-2">
                                <div id="page_content_1" class="wizard-pane">
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
                                            <input type="text" class="form-control input-item" autocomplete="off" placeholder="Name Extension" name="input[client_name_extension]" id="client_name_extension">
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
                                            <textarea class="form-control input-item" autocomplete="off" placeholder="Client middle name" name="input[client_civil_status]" id="client_civil_status" required></textarea>
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


                                <div id="page_content_2" class="wizard-pane" style="display:none;">
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
                                            <input type="text" class="form-control input-item" autocomplete="off" placeholder="Name Extension" name="input[client_name_extension]" id="client_name_extension">
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
                    <a href="#" class="btn btn-icon icon-right btn-secondary"><i class="fas fa-arrow-left"></i> Previous</a>
                    <a href="#" class="btn btn-icon icon-right btn-primary" onclick="nextPAge">Save and continue <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</form>