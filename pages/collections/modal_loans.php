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
                    <input type="hidden" id="hidden_id" name="input[loan_id]">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Reference #</label>
                            <input type="text" class="form-control input-item" readonly autocomplete="off" name="input[reference_number]" id="reference_number" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Loan Type</label>
                            <select class="form-control select2 input-item" onchange="changeLoanType()" id="loan_type_id" name="input[loan_type_id]" style="width:100%;" required>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Client</label>
                            <select class="form-control select2 input-item" id="client_id" name="input[client_id]" style="width:100%;" required>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Loan Date</label>
                            <input type="date" class="form-control input-item" autocomplete="off" name="input[loan_date]" id="loan_date" required>
                        </div>
                        
                        <div class="form-group col-md-4">
                            <label>Loan amount</label>
                            <input type="number" step="0.01" class="form-control input-item" onchange="calculateInterest()" autocomplete="off" name="input[loan_amount]" id="loan_amount" required>
                        </div>
                        
                        <div class="form-group col-md-4">
                            <label>Loan Period</label>
                            <input type="number" class="form-control input-item" autocomplete="off" onchange="calculateInterest()" name="input[loan_period]" id="loan_period" required>
                        </div>
                        
                        <div class="form-group col-md-4">
                            <label>Interest</label>
                            <input type="number" step="0.01" class="form-control input-item" autocomplete="off" name="input[loan_interest]" id="loan_interest" required>
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