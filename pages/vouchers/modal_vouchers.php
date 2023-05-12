
<form method='POST' id='frm_submit'>
    <div class="modal fade" id="modalEntry" role="dialog" aria-labelledby="myModalLabel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
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
                        <div class="form-group col-md-6">
                            <label>Reference #</label>
                            <input type="text" class="form-control input-item" autocomplete="off" name="input[reference_number]" id="reference_number" readonly required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Voucher #</label>
                            <input type="text" class="form-control input-item" autocomplete="off" name="input[voucher_no]" id="voucher_no" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Account Type</label>
                            <select class="form-control select2 input-item" id="account_type" name="input[account_type]" style="width:100%;" onchange="getAccount()" required>
                                <option value="">&mdash;Please Select&mdash;</option>
                                <option value="S">Supplier</option>
                                <option value="C">Client</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Account</label>
                            <select class="form-control select2 input-item" id="account_id" name="input[account_id]" style="width:100%;" required>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Check #</label>
                            <input type="text" class="form-control input-item" autocomplete="off" name="input[check_number]" id="check_number" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>A/C #</label>
                            <input type="text" class="form-control input-item" autocomplete="off" name="input[ac_no]" id="ac_no" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Amount</label>
                            <input type="number" step="0.01" min="0" class="form-control input-item" autocomplete="off" name="input[amount]" id="amount" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Date</label>
                            <input type="date" class="form-control input-item" autocomplete="off" name="input[voucher_date]" id="voucher_date" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Description</label>
                            <textarea class="form-control input-item" name="input[description]" id="description"></textarea>
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
                        </div>
                        <div class="col-3">
                            <div><b>Account:</b> <span id="account_label" class="label-item"></span></div>
                            <div><b>Remarks:</b> <span id="description_label" class="label-item"></span></div>
                            <div><b>Date:</b> <span id="voucher_date_label" class="label-item"></span></div>
                            <div><b>Encoded By:</b> <span id="encoded_by_label" class="label-item"></span></div>
                        </div>
                        <div class="col-6">
                            <ul class="nav justify-content-end">
                                <li class="nav-item">
                                    <a id="menu-edit-transaction" class="nav-link" href="#" style="font-size: small;"><i class='ti ti-pencil'></i> Edit Journal Entry</a>
                                </li>
                                <li class="nav-item" style="display:none;">
                                    <a id="menu-finish-transaction" class="nav-link" href="#" style="font-size: small;"><i class='ti ti-check'></i> Finish Transaction</a>
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

                                    <div class="form-group row">
                                        <div class="col">
                                            <label><strong>Chart</strong></label>
                                            <div>
                                                <select class="form-control form-control-sm select2" name="input[chart_id]" id="chart_id" style="width:100%;" required></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col">
                                            <label><strong>Type</strong></label>
                                            <div>
                                                <select class="form-control form-control-sm select2" name="input[type]" style="width:100%;" required>
                                                    <option value="">&mdash;Please Select&mdash;</option>
                                                    <option value="D">Debit</option>
                                                    <option value="C">Credit</option>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label><strong>Amount</strong></label>
                                            <div>
                                            <input type="number" step="0.01" min="0" class="form-control" class="form-control input-item" name="input[amount]" id="amount">
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
                                <div class="btn-group mb-3 btn-group-sm" role="group" aria-label="Basic example">
                                    <button type="button" onclick="deleteEntry2()" id="btn_delete_task" class="btn btn-icon icon-left btn-danger"><i class="fas fa-trash"></i> Delete</button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped" id="dt_entries_2" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <div class="custom-checkbox custom-control">
                                                        <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-3" onchange="checkAll(this, 'dt_id_2')">
                                                        <label for="checkbox-3" class="custom-control-label">&nbsp;</label>
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