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
                    <input type="hidden" id="hidden_id" name="input[chart_id]">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label><strong style="color:red;">*</strong> Code</label>
                            <input type="text" class="form-control input-item" autocomplete="off" placeholder="Chart code" name="input[chart_code]" id="chart_code" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label><strong style="color:red;">*</strong> Type</label>
                            <select class="form-control select2 input-item" id="chart_type" name="input[chart_type]" style="width:100%;" onchange="changeChartType()" required>
                                <option value="">Please Select</option>
                                <option value="M">Main</option>
                                <option value="S">Sub</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12" id="div_main_chart" style="display:none;">
                            <label><strong style="color:red;">*</strong> Main Chart</label>
                            <select class="form-control select2 input-item" id="main_chart_id" name="input[main_chart_id]" onchange="changeChart()" style="width:100%;">
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label><strong style="color:red;">*</strong> Chart</label>
                            <input type="text" class="form-control input-item" autocomplete="off" placeholder="Chart of account" name="input[chart_name]" id="chart_name" required>
                        </div>
                        <div class="form-group col-md-12" id="div_sub_class" style="display:none;">
                            <label><strong style="color:red;">*</strong> Chart Classification</label>
                            <select class="form-control select2 input-item" id="chart_class_id" name="input[chart_class_id]" style="width:100%;">
                            </select>
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