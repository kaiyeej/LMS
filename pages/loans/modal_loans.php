
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
                    <input type="hidden" id="hidden_id" name="input[loan_id]">
                    <div class="form-row">
                        <div class="col-lg-7" id="loan_container">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label style="color: #6777ef;font-weight: bold;">Ref. #: </label>
                                    <input type="text" class="input-item" autocomplete="off" name="input[reference_number]" id="reference_number" style="background: transparent;border: none;outline: none;color: #6777ef;font-size: 18px;font-weight: bold;" readonly required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Branch</label>
                                    <select class="form-control select2 input-item" id="branch_id" name="input[branch_id]" style="width:100%;" onchange="getClients()" required>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Client</label>
                                    <select class="form-control select2 input-item" id="client_id" name="input[client_id]" style="width:100%;" required>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Loan Type</label>
                                    <select class="form-control select2 input-item" onchange="changeLoanType()" id="loan_type_id" name="input[loan_type_id]" style="width:100%;" required>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Loan Date</label>
                                    <input type="date" class="form-control input-item" autocomplete="off" name="input[loan_date]" id="loan_date" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Loan amount</label>
                                    <input type="number" step="0.01" class="form-control input-item" onchange="calculateInterest()" autocomplete="off" name="input[loan_amount]" id="loan_amount" required>
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label>Interest</label>
                                    <input type="number" step="0.01" class="form-control input-item" autocomplete="off" name="input[loan_interest]" id="loan_interest" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Loan Terms</label>
                                    <input type="number" class="form-control input-item" autocomplete="off" onchange="calculateInterest()" name="input[loan_period]" id="loan_period" required>
                                </div>
                                
                                <div class="form-group col-md-4">
                                    <label>Service Fee</label>
                                    <input type="number" step="0.01" class="form-control input-item" autocomplete="off" name="input[service_fee]" id="service_fee" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Monthly Payment</label>
                                    <input type="number" class="form-control input-item" autocomplete="off"  name="input[monthly_payment]" id="monthly_payment" required>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-5" style="padding: 10px;border: 1px dashed #607D8B;border-radius: 5px;">
                            <div class="table-responsive">
                                <button type="button" style="float: right;" class="btn btn-icon btn-sm icon-right btn-warning" onclick="sampleCalculation()">Sample Calculation</button>
                                <div class="table-responsive" style="padding-top: 5px;max-height: 350px;">
                                    <table id="dt_calculation" class="table table-striped" style="font-size:10px;width: 100%!important;">
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
                    <div class="form-row">

                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn_submit" class="btn btn-primary">
                        Save
                    </button>
                    <!-- <button type="button" onclick="deniedLoan()" id="btn_deny" class="btn btn-danger">
                        Deny
                    </button> -->
                    <button type="button" onclick="releasedLoan()" id="btn_release" class="btn btn-info">
                        Release
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>