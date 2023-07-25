<form method='POST' id='frm_submit'>
    <div class="modal fade" id="modalEntry" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel"><span class='ion-compose'></span> Add Entry</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="hidden_id" name="input[user_id]">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label><strong style="color:red;">*</strong> First Name</label>
                            <input type="text" class="form-control input-item" placeholder="First name" name="input[user_fname]" id="user_fname" autocomplete="off" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Middle Name</label>
                            <input type="text" class="form-control input-item" placeholder="Middle name" name="input[user_mname]" id="user_mname" autocomplete="off">
                        </div>
                        <div class="form-group col-md-6">
                            <label><strong style="color:red;">*</strong> Last Name</label>
                            <input type="text" class="form-control input-item" placeholder="Last name" name="input[user_lname]" id="user_lname" required autocomplete="off">
                        </div>
                        <div class="form-group col-md-6">
                            <label><strong style="color:red;">*</strong> Category</label>
                            <select class="form-control select2 input-item" id="user_category_id" name="input[user_category_id]" style="width:100%;" required>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label><strong style="color:red;">*</strong> Username</label>
                            <input type="text" class="form-control input-item" placeholder="Username" name="input[username]" id="username" required autocomplete="off">
                        </div>
                        <div class="form-group col-md-12" id="div_pass">
                            <label><strong style="color:red;">*</strong> Password</label>
                            <input type="password" class="form-control input-item" placeholder="Password" name="input[password]" id="password" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn_submit" class="btn btn-primary">
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>