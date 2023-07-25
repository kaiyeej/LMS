<form method='POST' id='frm_other_loan'>
    <div class="modal fade" id="modalEntryRenewal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel"> <span id="modal_span_label"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-lg-7">
                            <div class="row">
                                <input type="hidden" class="input-renewal" autocomplete="off" id="renewal_status_renewal" name="input[renewal_status]" readonly>
                                <div class="form-group col-md-12">
                                    <label style="color: #6777ef;font-weight: bold;">Ref. #: </label>
                                    <input type="text" autocomplete="off" name="input[reference_number]" id="reference_number_renewal" class="reference_number" style="background: transparent;border: none;outline: none;color: #6777ef;font-size: 18px;font-weight: bold;" readonly required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label><strong style="color:red;">*</strong> Branch</label>
                                    <select class="form-control select2 branch_id" id="branch_id_renewal" name="input[branch_id]" style="width:100%;" onchange="getClients2()" required>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label><strong style="color:red;">*</strong> Client</label>
                                    <select class="form-control select2 client_id" id="client_id_renewal" name="input[client_id]" onchange="getLoans()" style="width:100%;" required>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label><strong style="color:red;">*</strong> Loan</label>
                                    <select class="form-control select2 loan_id" onchange="loan_renewal()" id="loan_id_renewal" name="input[loan_id]" style="width:100%;" required>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label><strong style="color:red;">*</strong> Loan Type</label>
                                    <input type="text" class="form-control input-renewal" autocomplete="off" id="loan_type_renewal" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label><strong style="color:red;">*</strong> Loan Date</label>
                                    <input type="date" class="form-control input-renewal" autocomplete="off" name="input[loan_date]" id="loan_date_renewal" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label><strong style="color:red;">*</strong> Loan amount</label>
                                    <input type="number" step="0.01" class="form-control input-renewal" onchange="calculateInterest2()" autocomplete="off" name="input[loan_amount]" id="loan_amount_renewal" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label><strong style="color:red;">*</strong> Loan Interest</label>
                                    <input type="number" step="0.01" class="form-control input-al input-renewal" autocomplete="off" name="input[loan_interest]" id="loan_interest_renewal" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label><strong style="color:red;">*</strong>Penalty %</label>
                                    <input type="number" step="0.01" class="form-control input-al input-renewal" autocomplete="off" name="input[penalty_percentage]" id="penalty_percentage_renewal" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label><strong style="color:red;">*</strong> Payment Terms <sub style="color:red;">(months)</sub></label>
                                    <input type="number" step="0.01" class="form-control input-al input-renewal" autocomplete="off" name="input[payment_terms]" id="payment_terms_renewal" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label><strong style="color:red;">*</strong> Loan Terms</label>
                                    <input type="number" class="form-control input-al input-renewal" autocomplete="off" name="input[loan_period]" id="loan_period_renewal" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label><strong style="color:red;">*</strong> Service Fee</label>
                                    <input type="number" step="0.01" class="form-control input-renewal" autocomplete="off" name="input[service_fee]" id="service_fee_renewal" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label><strong style="color:red;">*</strong> Monthly Payment</label>
                                    <input type="number" class="form-control input-renewal" autocomplete="off" name="input[monthly_payment]" id="monthly_payment_renewal" step="0.01" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <hr style="margin-top: 0rem;margin-bottom: 0rem;border-top: 1.5px solid;">
                                </div>
                                <div class="col-lg-12 div_renewal">
                                    <label class="text-md-right text-left">Deduct to loan</label>
                                    <div class="form-group">
                                        <label class="custom-switch mt-2">
                                            <span class="custom-switch-description"> No &nbsp;</span>
                                            <input type="checkbox" onchange="deductToLoan()" value="1" id="deduct_to_loan" name="input[deduct_to_loan]" class="input-renewal custom-switch-input">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">Yes</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="div_collection form-group col-md-4">
                                    <label>Bank</label>
                                    <select class="form-control select2 input-renewal chart_id" id="chart_id_renewal" name="input[chart_id]" style="width:100%;" required>
                                    </select>
                                </div>
                                <div class="div_collection form-group col-md-4">
                                    <label>Penalty</label>
                                    <input type="number" step="0.01" class="form-control penalty_amount" autocomplete="off" name="input[penalty_amount]" id="penalty_amount_renewal" required>
                                </div>
                                <div class="div_collection form-group col-md-4">
                                    <label>Amount</label>
                                    <input type="number" step="0.01" class="form-control amount" placeholder="Collection amount" autocomplete="off" name="input[amount]" id="amount_renewal" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5" style="padding: 10px;border: 1px dashed #ff9800;border-radius: 5px;">
                            <div class="table-responsive">
                                <button type="button" style="float: right;" class="btn btn-icon btn-sm icon-right btn-warning" onclick="sampleCalculation2()">Sample Calculation</button>
                                <div class="table-responsive" style="padding-top: 5px;max-height: 80vh;overflow-y: auto;">
                                    <table id="dt_calculation2" class="table table-striped" style="font-size:10px;width: 100%!important;">
                                        <thead style="background: #1f384b;">
                                            <tr>
                                                <th style="color:#fff;">Date</th>
                                                <th style="color:#fff;">Suggested Payment</th>
                                                <th style="color:#fff;">Interest</th>
                                                <th style="color:#fff;">Applicable to Principal</th>
                                                <th style="color:#fff;">Balance</th>
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
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    function calculateInterest2() {
        var loan_amount = $("#loan_amount_renewal").val();
        var loan_period = $("#loan_period_renewal").val();
        var interest = (loan_type_interest / 100);
        // $("#loan_interest").val(loan_type_interest);
    }

    function addOtherLoan(renewal_status) {
        
        $("#modalEntryRenewal").modal('show');
        var element = document.getElementById('reference_number_renewal');
        if (typeof(element) != 'undefined' && element != null) {
            generateReference(route_settings.class_name);
        }

        
        $('.input-renewal').attr('readonly', false);
        $(".select2").prop("disabled", false);
        $("#btn_submit_renew").show();
        $("#renewal_status_renewal").val(renewal_status);
        $("#loan_type_renewal").prop("readonly",true);

        if(renewal_status == "Y"){
            $(".div_renewal").show();
            $(".div_collection").show();
            getSelectOption('ChartOfAccounts', 'chart_id', 'chart_name', "chart_name LIKE '%Bank%'", [], '', 'Please Select', '', 1);
            $("#chart_id_renewal").prop('required',true);
            $("#penalty_amount_renewal").prop('required',true);
            $("#amount_renewal").prop('required',true);
            $(".input-al").prop("readonly",false);
            $("#modal_span_label").html("Renew Loan");
        }else{
            $(".div_renewal").hide();
            $(".div_collection").hide();
            $("#chart_id_renewal").prop('required',false);
            $("#penalty_amount_renewal").prop('required',false);
            $("#amount_renewal").prop('required',false);
            $(".input-al").prop("readonly",true);
            $("#modal_span_label").html("Additional Loan");
        }
    }

    function getClients2() {
        var branch_id = $("#branch_id_renewal").val();
        getSelectOption('Clients', 'client_id', 'client_fullname', "branch_id='" + branch_id + "'", [], '', 'Please Select', '', 1);
    }

    function getLoans() {
        var client_id = $("#client_id_renewal").val();
        getSelectOption('Loans', 'loan_id', "reference_number", "client_id = '" + client_id + "' AND status = 'R'", [], '', 'Please Select', '', 1);
    }

    function loan_renewal() {

        var loan_id = $("#loan_id_renewal").val();
        getOldLoan(loan_id);
        getBalance(loan_id);
        getPenalty(loan_id);
        $("#chart_id_renewal").prop("disabled", false);
        // sampleCalculation2();
        
    }

    function getOldLoan(id) {
        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=" + route_settings.class_name + "&q=view",
            data: {
                input: {
                    id: id
                }
            },
            success: function(data) {
                var jsonParse = JSON.parse(data);
                const json = jsonParse.data;
                $('.input-renewal').map(function() {
                    const id_name = this.id.slice(0, -8);
                    this.value = json[id_name];
                    $("#" + id_name).val(json[id_name].slice(0, -8)).trigger('change');
                });
            }
        });
    }


    function deductToLoan() {
        if ($("#deduct_to_loan").prop("checked")) {
            $(".div_collection").hide();
            $('#chart_id_renewal').prop('required', false);
            $('#penalty_amount_renewal').prop('required', false);
            $('#amount_renewal').prop('required', false);
        } else {
            $(".div_collection").show();
            $('#chart_id_renewal').prop('required', true);
            $('#penalty_amount_renewal').prop('required', true);
            $('#amount_renewal').prop('required', true);
        }
    }

    $("#frm_other_loan").submit(function(e) {
        e.preventDefault();

        $("#btn_submit_renew").prop('disabled', true);
        $("#btn_submit_renew").html("<span class='fa fa-spinner fa-spin'></span> Submitting ...");

        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=" + route_settings.class_name + "&q=renew",
            data: $("#frm_other_loan").serialize(),
            success: function(data) {
                getEntries();
                var json = JSON.parse(data);
                if (json.data > 0) {
                    $("#modalEntryRenewal").modal('hide');
                    $("#modalEntry").modal('hide');
                    success_add();
                } else if (json.data == -2) {
                    entry_already_exists();
                } else {
                    failed_query(json);
                }

                $("#btn_submit_renew").prop('disabled', false);
                $("#btn_submit_renew").html("Add");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                errorLogger('Error:', textStatus, errorThrown);
            }
        });
    });
</script>