<form method='POST' id='frm_submit'>
    <div class="modal fade" id="modalEntry" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
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
                        <div class="col-lg-7" id="modal_collection_body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label style="color: #6777ef;font-weight: bold;">Ref. #: </label>
                                    <input type="text" class="input-item" autocomplete="off" name="input[reference_number]" id="reference_number" style="background: transparent;border: none;outline: none;color: #6777ef;font-size: 18px;font-weight: bold; width: 80%;" readonly required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label><strong style="color:red;">*</strong> Branch</label>
                                    <select onchange="getClients()" class="form-control select2 select-item" id="branch_id" name="input[branch_id]" style="width:100%;" required>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label><strong style="color:red;">*</strong> Client</label>
                                    <select onchange="getLoans()" class="form-control select2 select-item" id="client_id" name="input[client_id]" style="width:100%;" required>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label><strong style="color:red;">*</strong> Loan ID</label>
                                    <select class="form-control select2 select-item" id="loan_id" name="input[loan_id]" onchange="loanDetails()" style="width:100%;" required>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label><strong style="color:red;">*</strong> Collection Date</label>
                                    <input type="date" class="form-control input-item" autocomplete="off" name="input[collection_date]" id="collection_date" onchange="getPenalty()" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label><strong style="color:red;">*</strong> Receipt #</label>
                                    <input type="text" class="form-control input-item" placeholder="OR/AR number" autocomplete="off" name="input[receipt_number]" id="receipt_number" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label><strong style="color:red;">*</strong> Bank</label>
                                    <select class="form-control select2 select-item" id="chart_id" name="input[chart_id]" style="width:100%;" required>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label><strong style="color:red;">*</strong> Penalty</label>
                                    <input type="number" step="0.01" class="form-control input-item" autocomplete="off" name="input[penalty_amount]" id="penalty_amount" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label><strong style="color:red;">*</strong> Amount</label>
                                    <input type="number" min="0" step="0.01" class="form-control input-item" placeholder="Collection amount" autocomplete="off" name="input[amount]" id="amount" onchange="atmComputers()" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label><strong style="color:red;">*</strong> ATM Balance Before Withdrawal</label>
                                    <input type="number" min="0" step="0.01" class="form-control input-item" placeholder="ATM Balance Before Withdrawal" autocomplete="off" name="input[old_atm_balance]" id="old_atm_balance" onchange="atmComputers()" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label><strong style="color:red;">*</strong> ATM Withdrawal</label>
                                    <input type="number" min="0" step="0.01" class="form-control input-item" placeholder="ATM Withdrawal" autocomplete="off" name="input[atm_withdrawal]" onchange="atmComputers()" id="atm_withdrawal" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>ATM Charge</label>
                                    <input type="number" min="0" step="0.01" class="form-control input-item" placeholder="ATM Charge" autocomplete="off" name="input[atm_charge]" id="atm_charge" onchange="atmComputers()">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>ATM Balance</label>
                                    <input type="number" min="0" step="0.01" class="form-control input-item" placeholder="ATM Balance" autocomplete="off" name="input[atm_balance]" id="atm_balance">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Excess</label>
                                    <input type="number" min="0" step="0.01" class="form-control input-item" placeholder="Excess" autocomplete="off" name="input[excess]" id="excess">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Remarks</label>
                                    <textarea class="form-control input-item" autocomplete="off" name="input[remarks]" id="remarks"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5" style="padding: 10px;border: 1px dashed #ff9800;border-radius: 5px;">
                            <div class="table-responsive">
                                <div class="table-responsive" style="padding-top: 5px;max-height: 500px;">
                                    <table id="dt_loan_details" class="table table-striped" style="font-size:9px;font-weight:bold;width: 100%!important;">
                                        <thead style="background: #1f384b;">
                                            <tr>
                                                <th style="color:#fff;">Date</th>
                                                <th style="color:#fff;">Payment</th>
                                                <th style="color:#fff;">Interest Amount</th>
                                                <th style="color:#fff;">Penalty</th>
                                                <th style="color:#fff;">Applicable to Principal</th>
                                                <th style="color:#fff;">Balance</th>
                                            </tr>
                                            <tr style="background: #fafafa;">
                                                <th style="text-align: left;">Monthly Installment:</th>
                                                <th colspan="3" style="text-align: left;"><span id="monthly_payment_span"></span></th>
                                                <th style="text-align: right;">Loan Amount:</th>
                                                <th style="text-align: right;"><span id="loan_amount_span"></span></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">

                    </div>


                    <div id="temporary_print">
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn_submit" class="btn btn-success">
                        Finish
                    </button>
                    <button type="button" id="btn_print" class="btn btn-primary" style="display: none;" onclick="print_collection_solo()">
                        Print
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>