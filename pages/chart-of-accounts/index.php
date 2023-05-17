<section class="section">
    <div class="section-header">
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Accounting</a></div>
            <div class="breadcrumb-item">Chart of Accounts</div>
        </div>
    </div>

    <div class="section-body  shadow">
        <div class="alert alert-light alert-has-icon" style="border: 1px dashed #3C84AB;">
            <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
            <div class="alert-body">
                <div class="alert-title">Chart of Accounts</div>
                Manage chart of accounts here.
            </div>
            <div>
                <a href="#" class="btn btn-icon icon-left btn-primary" onclick="addModal()"><i class="fas fa-plus"></i> Add</a>
                <a href="#" class="btn btn-icon icon-left btn-danger" onclick='deleteEntry()'><i class="fas fa-trash"></i> Delete</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dt_entries" class="table table-striped">
                                <thead class="">
                                    <tr>
                                        <th style="width:10px;">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-1" onchange="checkAll(this, 'dt_id')">
                                                <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </th>
                                        <th></th>
                                        <th>Code</th>
                                        <th>Chart of Accounts</th>
                                        <th>Type</th>
                                        <th>Main Account</th>
                                        <th>Classification</th>
                                        <th>Date Added</th>
                                        <th>Date Modified</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include "modal_chart_of_accounts.php"; ?>
<script type="text/javascript">
    function getEntries() {
        $("#dt_entries").DataTable().destroy();
        $("#dt_entries").DataTable({
            "processing": true,
            "ajax": {
                "url": "controllers/sql.php?c=" + route_settings.class_name + "&q=show",
                "dataSrc": "data"
            },
            "columns": [{
                    "mRender": function(data, type, row) {
                        return '<div class="custom-checkbox custom-control"><input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" name="dt_id" id="checkbox-b' + row.chart_id + '" value=' + row.chart_id + '><label for="checkbox-b' + row.chart_id + '" class="custom-control-label">&nbsp;</label></div>';
                    }
                },
                {
                    "mRender": function(data, type, row) {
                        return "<center><button class='btn btn-sm btn-info' onclick='getEntryDetails(" + row.chart_id + ")'><span class='fa fa-edit'></span></button></center>";
                    }
                },
                {
                    "data": "chart_code"
                },
                {
                    "data": "chart_name"
                },
                {
                    "data": "type"
                },
                {
                    "data": "main_chart"
                },
                {
                    "data": "chart_class"
                },
                {
                    "data": "date_added"
                },
                {
                    "data": "date_last_modified"
                }
            ]
        });

        getSelectOption('ChartOfAccounts', 'main_chart_id', "chart_name", "chart_type = 'M'", ['chart_name']);
    }

    function changeChartType(){
        var chart_type = $("#chart_type").val();

        if(chart_type == "S"){
            $("#div_main_chart").show();
            $("#div_sub_class").hide();
            $("#main_chart_id").prop('required',true);
            $("#chart_class_id").prop('required',false);
        }else{
            $("#div_main_chart").hide();
            $("#div_sub_class").show();
            $("#main_chart_id").prop('required',false);
            $("#chart_class_id").prop('required',true);
            $("#chart_name").val("");
        }
    }

    function changeChart() {
        var chart_type = $("#chart_type").val();

        if(chart_type == "S"){
            var optionSelected = $("#main_chart_id").find('option:selected').attr('chart_name');
            chart_name = optionSelected;
            $("#chart_name").val(chart_name+" - ");
        }else{
            $("#chart_name").val("");
        }
        
    }

    $(document).ready(function() {
        getEntries();
        getSelectOption('ChartOfAccounts', 'main_chart_id', "chart_name", "chart_type = 'M'", ['chart_name']);
        getSelectOption('ChartClassification', 'chart_class_id', "chart_class_name");
    });
</script>