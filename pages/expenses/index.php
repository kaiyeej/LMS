<section class="section">
    <div class="section-header">
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Transactions</a></div>
            <div class="breadcrumb-item">Disbursement</div>
        </div>
    </div>

    <div class="section-body shadow">
        <div class="alert alert-light alert-has-icon" style="border: 1px dashed #3C84AB;">
            <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
            <div class="alert-body">
                <div class="alert-title">Disbursement</div>
                Manage disbursement here.
            </div>
            <div>
                <div class="dropdown">
                    <a href="#" data-toggle="dropdown" class="btn btn-info dropdown-toggle"><i class="fas fa-file-excel"></i> Template</a>
                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item has-icon" onclick="exportTemplate()"><i class="fas fa-download"></i> Export</a>
                        <a href="#" class="dropdown-item has-icon" onclick="importTemplate()"><i class="far fa-upload"></i> Import</a>
                    </div>
                    <div class="btn-group btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-primary" onclick="addModal()"><i class="fas fa-plus"></i> Add</button>
                        <button type="button" class="btn btn-danger" onclick="deleteEntry()"><i class="fas fa-trash"></i> Delete</button>
                    </div>
                </div>
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
                                        <th>Reference #</th>
                                        <th>Branch</th>
                                        <th>Expense Date</th>
                                        <th>Payment Method</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Encoded By</th>
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
<?php include "modal_expenses.php"; ?>
<?php include "modal_export.php"; ?>
<?php include "modal_import.php"; ?>
<script type="text/javascript">
    function getEntries() {
        $("#dt_entries").DataTable().destroy();
        $("#dt_entries").DataTable({
            "processing": true,
            "order": [
                [9, 'desc']
            ],
            "ajax": {
                "url": "controllers/sql.php?c=" + route_settings.class_name + "&q=show",
                "dataSrc": "data"
            },
            "columns": [{
                    "mRender": function(data, type, row) {
                        return '<div class="custom-checkbox custom-control"><input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" name="dt_id" id="checkbox-b' + row.expense_id + '" value=' + row.expense_id + '><label for="checkbox-b' + row.expense_id + '" class="custom-control-label">&nbsp;</label></div>';
                    }
                },
                {
                    "mRender": function(data, type, row) {
                        return "<center><button class='btn btn-sm btn-info' onclick='getEntryDetails2(" + row.expense_id + ")'><span class='fa fa-edit'></span></button></center>";
                    }
                },
                {
                    "data": "reference_number"
                },
                {
                    "data": "branch_name"
                },
                {
                    "data": "expense_date"
                },
                {
                    "data": "remarks"
                },
                {
                    "data": "amount",
                    className: "text-right"
                },
                {
                    "mRender": function(data, type, row) {
                        return row.status == "F" ? '<a href="#" class="badge badge-primary">Posted</a>' : row.status == "C" ? '<a href="#" class="badge badge-danger">Canceled</a>' : '<a href="#" class="badge badge-light">Saved</a>';
                    }
                },
                {
                    "data": "encoded_by"
                },
                {
                    "data": "date_added"
                },
                {
                    "data": "date_last_modified"
                }
            ]
        });
    }

    function getEntries2() {
        var hidden_id_2 = $("#hidden_id_2").val();
        var param = "expense_id = '" + hidden_id_2 + "'";
        $("#dt_entries_2").DataTable().destroy();
        $("#dt_entries_2").DataTable({
            "processing": true,
            "ajax": {
                "url": "controllers/sql.php?c=" + route_settings.class_name + "&q=show_detail",
                "dataSrc": "data",
                "type": "POST",
                "data": {
                    input: {
                        param: param
                    }
                }
            },
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api();

                // Remove the formatting to get integer data for summation
                var intVal = function(i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '') * 1 :
                        typeof i === 'number' ?
                        i : 0;
                };

                total = api
                    .column(3, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);


                $(api.column(3).footer()).html(
                    "&#x20B1; " + total.toLocaleString('en-US', {
                        minimumFractionDigits: 2
                    })
                );


            },
            "columns": [{
                    "mRender": function(data, type, row) {
                        return '<div class="custom-checkbox custom-control"><input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" name="dt_id_2" id="checkbox-b' + row.expense_detail_id + '" value=' + row.expense_detail_id + '><label for="checkbox-b' + row.expense_detail_id + '" class="custom-control-label">&nbsp;</label></div>';
                    }
                },
                {
                    "data": "chart"
                },
                // {
                //     "data": "category"
                // },
                {
                    "data": "expense_desc"
                },
                {
                    "data": "expense_amount",
                    className: "text-right"
                },
            ]
        });
    }

    function generateRef() {
        var refnum = $("#reference_number").val();
        var optionSelected = $("#journal_id").find('option:selected').attr('journal_code');
        var newStr = refnum.split("-");

        $("#reference_number").val(optionSelected + "-" + newStr[1]);
    }

    $(document).ready(function() {
        getEntries();
        getSelectOption('Branches', 'branch_id', 'branch_name');
        getSelectOption('Journals', 'journal_id', 'journal_name', '', ['journal_code']);
        getSelectOption('ChartOfAccounts', 'credit_method', 'chart_name');
        getSelectOption('ChartOfAccounts', 'chart_id', 'chart_name');
        // getSelectOption('ExpenseCategory', 'expense_category_id', 'expense_category');
    });
</script>