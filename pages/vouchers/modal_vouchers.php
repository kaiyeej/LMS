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
                    <input type="hidden" id="hidden_id" name="input[voucher_id]">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div>
                                <label style="color: #6777ef;font-weight: bold;">Ref. #: </label>
                                <input type="text" class="input-item" autocomplete="off" name="input[reference_number]" id="reference_number" style="background: transparent;border: none;outline: none;color: #6777ef;font-size: 18px;font-weight: bold;" readonly required>
                            </div>

                        </div>
                        <div class="form-group col-md-4">
                            <label><strong style="color:red;">*</strong> Voucher #</label>
                            <input type="text" class="form-control input-item" autocomplete="off" name="input[voucher_no]" id="voucher_no" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label><strong style="color:red;">*</strong> Branch</label>
                            <select class="form-control select2 branch_id input-item" id="branch_id" name="input[branch_id]" style="width:100%;" onchange="getAccount()" required>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label><strong style="color:red;">*</strong> Account Type</label>
                            <select class="form-control select2 input-item" id="account_type" name="input[account_type]" style="width:100%;" onchange="getAccount()" required>
                                <option value="">&mdash;Please Select&mdash;</option>
                                <option value="S">Supplier</option>
                                <option value="C">Client</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label><strong style="color:red;">*</strong> Account</label>
                            <select class="form-control select2 input-item" id="account_id" onchange="getLoan()" name="input[account_id]" style="width:100%;" required>
                            </select>
                        </div>
                        <div id="div_loan" class="form-group col-md-6">
                            <label><strong style="color:red;">*</strong> Loan</label>
                            <select class="form-control select2 input-item" id="loan_id" name="input[loan_id]" style="width:100%;" required>
                            </select>
                        </div>
                    </div>
                    <div>
                        <hr style="margin-top: 0rem;">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label><strong style="color:red;">*</strong> Check #</label>
                            <input type="text" class="form-control input-item" autocomplete="off" name="input[check_number]" id="check_number" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>A/C #</label>
                            <input type="text" class="form-control input-item" autocomplete="off" name="input[ac_no]" id="ac_no">
                        </div>
                        <div class="form-group col-md-4">
                            <label><strong style="color:red;">*</strong> Date</label>
                            <input type="date" class="form-control input-item" autocomplete="off" name="input[voucher_date]" id="voucher_date" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label><strong style="color:red;">*</strong> Amount</label>
                            <input type="number" step="0.01" min="0" class="form-control input-item" autocomplete="off" name="input[amount]" id="amount" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label><strong style="color:red;">*</strong> Journal</label>
                            <select class="form-control select2 input-item" id="journal_id" name="input[journal_id]" style="width:100%;" required>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label><strong style="color:red;">*</strong> Description</label>
                            <textarea class="form-control input-item" name="input[description]" id="description" required></textarea>
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


<div class="modal fade" id="modalEntry2" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container">
                    <div class="row alert alert-light alert-has-icon" style="padding-left: 0px;padding-right:0px;font-size: small;border: 1px dashed #17a2b8;">
                        <div class="col-3">
                            <div><b>Reference #:</b> <span id="reference_number_label" class="label-item"></span></div>
                            <div><b>Voucher #:</b> <span id="voucher_no_label" class="label-item"></span></div>
                            <div><b>Check #:</b> <span id="check_number_label" class="label-item"></span></div>
                            <div><b>A/C #:</b> <span id="ac_no_label" class="label-item"></span></div>
                            <div><b>Encoded By:</b> <span id="encoded_by_label" class="label-item"></span></div>
                        </div>
                        <div class="col-3">
                            <div><b>Account:</b> <span id="account_label" class="label-item"></span></div>
                            <div><b>Amount:</b> <span id="voucher_amount_label" class="label-item"></span></div>
                            <div><b>Date:</b> <span id="voucher_date_label" class="label-item"></span></div>
                            <div><b>Description:</b> <span id="description_label" class="label-item"></span></div>
                        </div>
                        <div class="col-6">
                            <ul class="nav justify-content-end">
                                <li class="nav-item">
                                    <a id="menu-edit-transaction" class="nav-link" href="#" style="font-size: small;"><i class='ti ti-pencil'></i> Edit Entry</a>
                                </li>
                                <li class="nav-item">
                                    <a id="menu-delete-selected-items" class="nav-link" href="#" style="font-size: small;"><i class='ti ti-trash'></i> Delete Selected</a>
                                </li>
                                <li class="nav-item">
                                    <a id="menu-finish-transaction" class="nav-link" href="#" style="font-size: small;"><i class='ti ti-check'></i> Finish Transaction</a>
                                </li>
                                <li class="nav-item">
                                    <a id="menu-cancel-transaction" onclick="cancelVoucher()" class="nav-link" href="#" style="font-size: small;color: #C62828;font-weight: bold;"><i class='ti ti-check'></i> Cancel</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" data-dismiss="modal" style="font-size: small;"><i class='ti ti-close'></i> Close</a>
                                </li>
                                <!--<li class="nav-item">
                                <a class="nav-link disabled" href="#">Disabled</a>
                            </li>-->
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-body" style="padding-top: 0px;">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4" id="col-item">
                                <form method='POST' id='frm_submit_2'>
                                    <input type="hidden" id="hidden_id_2" name="input[voucher_id]">
                                    <input type="hidden" id="journal_entry_id" name="input[journal_entry_id]">

                                    <div class="form-group row">
                                        <div class="col">
                                            <label><strong><strong style="color:red;">*</strong> Chart</strong></label>
                                            <div>
                                                <select class="form-control form-control-sm select2" name="input[chart_id]" id="chart_id" style="width:100%;" required></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col">
                                            <label><strong><strong style="color:red;">*</strong> Type</strong></label>
                                            <div>
                                                <select class="form-control form-control-sm select2" name="input[type]" style="width:100%;" required>
                                                    <option value="">&mdash;Please Select&mdash;</option>
                                                    <option value="D">Debit</option>
                                                    <option value="C">Credit</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label><strong><strong style="color:red;">*</strong> Amount</strong></label>
                                            <div>
                                                <input type="number" step="0.01" min="0" class="form-control" class="form-control input-item" name="input[amount]" id="amount" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col">
                                            <label><strong>Description</strong></label>
                                            <textarea class="form-control" class="form-control input-item" name="input[description]" id="description"></textarea>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group row">
                                                <div class="col">
                                                    <label><strong>Date Started</strong></label>
                                                    <input type="date" class="form-control input-item" name="input[date_started]" id="date_started" required>
                                                </div>
                                            </div> -->
                                    <div class='btn-group' style="float: right;">
                                        <button type="submit" class="btn btn-info" id="btn_submit_3">Submit</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-6" id="col-list">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="dt_entries_2" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <div class="custom-checkbox custom-control">
                                                        <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-3" onchange="checkAll(this, 'dt_id_2')">
                                                        <label for="checkbox-3" class="custom-control-label"></label>
                                                    </div>
                                                </th>
                                                <th>Chart</th>
                                                <th>Description</th>
                                                <th>Debit</th>
                                                <th>Credit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr style="text-align: right;font-weight:bold">
                                                <td colspan="3">Total:</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>