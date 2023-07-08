<form method='POST' id='frm_fixed'>
    <div class="modal fade" id="modalFixedEntry" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel"><span class='ion-compose'></span> Add Entry</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="hidden_id2" name="input[loan_type_id]">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="number" step="0.02" class="form-control input-item" autocomplete="off" placeholder="Loan amount" name="input[loan_amount]" id="loan_amount" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Loan Interest</label>
                                        <input type="number" step="0.1" max="100" min="0" class="form-control input-item" autocomplete="off" placeholder="Loan interest" name="input[interest_amount]" id="interest_amount" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Terms</label>
                                        <input type="number" step="0.1" max="100" min="0" class="form-control input-item" autocomplete="off" placeholder="Interest terms" name="input[interest_terms]" id="interest_terms" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <div class="table-responsive">
                                    <table id="dt_fixed_interest" class="table table-striped" style="width: 100%!important;">
                                        <thead>
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Interest</th>
                                                <th scope="col">Terms</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn_submit2" class="btn btn-primary">
                        Add
                    </button>
                </div>

            </div>
        </div>
    </div>
</form>