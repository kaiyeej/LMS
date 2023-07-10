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
                    <input type="hidden" id="hidden_id" name="input[loan_type_id]">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label><strong style="color:red;">*</strong>Loan Type</label>
                            <input type="text" class="form-control input-item" autocomplete="off" placeholder="Loan type" name="input[loan_type]" id="loan_type" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label><strong style="color:red;">*</strong>Remarks</label>
                            <textarea class="form-control input-item" placeholder="Remarks" name="input[remarks]" id="remarks"></textarea>
                        </div>

                        <div class="col-lg-12 div_renewal">
                            
                            <div class="form-group">
                                <label class="text-md-right text-left"><strong style="color:red;">*</strong>Fixed Interest Amount</label>
                                <label class="custom-switch mt-2">
                                    <span class="custom-switch-description"> No &nbsp;</span>
                                    <input type="checkbox" onchange="fixedInterest()" value="Y" class="input-item custom-switch-input"name="input[fixed_interest]" id="fixed_interest">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">Yes</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group con_normal col-md-6">
                            <label><strong style="color:red;">*</strong>Loan Interest</label>
                            <input type="number" step="0.1" max="100" min="0" class="form-control input-item" autocomplete="off" placeholder="Loan interest" name="input[loan_type_interest]" id="loan_type_interest" required>
                        </div>
                        <div class="form-group con_normal col-md-6">
                            <label><strong style="color:red;">*</strong>Penalty %</label>
                            <input type="number" step="0.1" max="100" min="0" class="form-control input-item" autocomplete="off" placeholder="Penalty percentage" name="input[penalty_percentage]" id="penalty_percentage" required>
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