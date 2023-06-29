<form method='POST' id='frm_renewal'>
    <div class="modal fade" id="modalEntryRenewal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel"><span class='ion-compose'></span> Renewal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="hidden_id_2" name="input[loan_id]">
                    <div class="form-row">
                        <div class="col-lg-7">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label style="color: #6777ef;font-weight: bold;">New Loan #: </label>
                                    <input type="text" autocomplete="off" name="input[reference_number]" id="new_reference_number" style="background: transparent;border: none;outline: none;color: #6777ef;font-size: 18px;font-weight: bold;" readonly required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label style="color: #607D8B;font-weight: bold;">Old Loan #: </label>
                                    <input type="text" class="input-item" autocomplete="off" id="reference_number" style="background: transparent;border: none;outline: none;color: #607D8B;font-size: 18px;font-weight: bold;" readonly required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label><strong style="color:red;">*</strong> Branch</label>
                                    <input type="text" class="form-control input-item" autocomplete="off" id="branch_name" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label><strong style="color:red;">*</strong> Client</label>
                                    <input type="text" class="form-control input-item" autocomplete="off" id="client" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label><strong style="color:red;">*</strong> Loan Type</label>
                                    <input type="text" class="form-control input-item" autocomplete="off" id="loan_type" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label><strong style="color:red;">*</strong> Loan Date</label>
                                    <input type="date" class="form-control input-item" autocomplete="off" name="input[loan_date]" id="loan_date" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label><strong style="color:red;">*</strong> Loan amount</label>
                                    <input type="number" step="0.01" class="form-control input-item" onchange="calculateInterest()" autocomplete="off" name="input[loan_amount]" id="loan_amount" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Interest</label>
                                    <input type="number" step="0.01" class="form-control input-item" autocomplete="off" name="input[loan_interest]" id="loan_interest" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label><strong style="color:red;">*</strong> Loan Terms</label>
                                    <input type="number" class="form-control input-item" autocomplete="off" name="input[loan_period]" id="loan_period" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label><strong style="color:red;">*</strong> Service Fee</label>
                                    <input type="number" step="0.01" class="form-control input-item" autocomplete="off" name="input[service_fee]" id="service_fee" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label><strong style="color:red;">*</strong> Monthly Payment</label>
                                    <input type="number" class="form-control input-item" autocomplete="off" name="input[monthly_payment]" id="monthly_payment" step="0.01" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <hr style="margin-top: 0rem;margin-bottom: 0rem;border-top: 1.5px solid;">
                                </div>
                                <div class="col-lg-12">
                                    <label class="text-md-right text-left">Deduct to loan</label>
                                    <div class="form-group">
                                        <label class="custom-switch mt-2">
                                            <span class="custom-switch-description"> No &nbsp;</span>
                                            <input type="checkbox" onchange="deductToLoan()" value="1" id="deduct_to_loan" name="input[deduct_to_loan]" class="input-item custom-switch-input">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">Yes</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="div_collection form-group col-md-4">
                                    <label>Bank</label>
                                    <select class="form-control select2 input-item" id="chart_id" name="input[chart_id]" style="width:100%;" required>
                                    </select>
                                </div>
                                <div class="div_collection form-group col-md-4">
                                    <label>Penalty</label>
                                    <input type="number" step="0.01" class="form-control input-item" autocomplete="off" name="input[penalty_amount]" id="penalty_amount" required>
                                </div>
                                <div class="div_collection form-group col-md-4">
                                    <label>Amount</label>
                                    <input type="number" step="0.01" class="form-control input-item" placeholder="Collection amount" autocomplete="off" name="input[amount]" id="amount" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5" style="padding: 10px;border: 1px dashed #ff9800;border-radius: 5px;">
                            <div class="table-responsive">
                                <button type="button" style="float: right;" class="btn btn-icon btn-sm icon-right btn-warning" onclick="sampleCalculation2()">Sample Calculation</button>
                                <div class="table-responsive" style="padding-top: 5px;max-height: 350px;">
                                    <table id="dt_calculation2" class="table table-striped" style="font-size:10px;width: 100%!important;">
                                        <thead style="background: #1f384b;">
                                            <tr>
                                                <th style="color:#fff;" scope="col">Date</th>
                                                <th style="color:#fff;" scope="col">Suggested Payment</th>
                                                <th style="color:#fff;" scope="col">Interest</th>
                                                <th style="color:#fff;" scope="col">Applicable to Principal</th>
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
                    <button type="submit" id="btn_submit_renew" class="btn btn-primary">
                        Add
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    function loanRenewal(){
        $("#modalEntryRenewal").modal('show');
    }
</script>