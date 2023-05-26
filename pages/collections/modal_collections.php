<form method='POST' id='frm_submit'>
    <div class="modal fade" id="modalEntry" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel"><span class='ion-compose'></span> Add Entry</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="hidden_id" name="input[collection_id]">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Reference #</label>
                            <input type="text" class="form-control input-item" readonly autocomplete="off" name="input[reference_number]" id="reference_number" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Client</label>
                            <select class="form-control select2 input-item" id="client_id" name="input[client_id]" style="width:100%;" required>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Loan ID</label>
                            <select class="form-control select2 input-item" id="loan_id" name="input[loan_id]" onchange="getPenalty()" style="width:100%;" required>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Collection Date</label>
                            <input type="date" class="form-control input-item" autocomplete="off" name="input[collection_date]" id="collection_date" onchange="getPenalty()"  required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Penalty</label>
                            <input type="number" readonly step="0.01" class="form-control input-item" autocomplete="off" name="input[penalty_amount]" id="penalty_amount" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Amount</label>
                            <input type="number" step="0.01" class="form-control input-item" placeholder="Collection amount"  autocomplete="off" name="input[amount]" id="amount" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Remarks</label>
                            <textarea class="form-control input-item" autocomplete="off" name="input[remarks]" id="remarks"></textarea>
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