<form method='POST' id='frm_submit'>
    <div class="modal fade" id="modalEntry" role="dialog" aria-labelledby="myModalLabel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel"><span class='ion-compose'></span> Add Entry</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="hidden_id" name="input[client_id]">
                    <div class="form-row">
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
                            <select class="form-control select2 input-item" id="client_name_extension" name="input[client_name_extension]" style="width:100%;" srequired>
                                <option value="">Please Select</option>
                                <option value="Jr.">Jr.</option>
                                <option value="Sr.">Sr.</option>
                                <option value="III">III</option>
                            </select>
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
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn_submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>