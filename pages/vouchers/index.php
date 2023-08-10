<style>
    .label-print {
        font-weight: bold;
        text-transform: uppercase;
    }
</style>
<section class="section">
    <div class="section-header">
        <div class="alert-body">
            <div class="alert-title">Vouchers</div>
            Manage vouchers here.
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Transactions</a></div>
            <div class="breadcrumb-item">Vouchers</div>
        </div>
    </div>

    <div class="section-body shadow">
        <div class="alert alert-light alert-has-icon" style="border: 1px dashed #3C84AB;">

            <!-- <div>
                <div class="dropdown">
                    <a href="#" data-toggle="dropdown" class="btn btn-info dropdown-toggle" style="display: none;"><i class="fas fa-file-excel"></i> Template</a>
                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item has-icon" onclick="exportTemplate()"><i class="fas fa-download"></i> Export</a>
                        <a href="#" class="dropdown-item has-icon" onclick="importClient()"><i class="far fa-upload"></i> Import</a>
                    </div>
                    <div class="btn-group btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-primary" onclick="addModal()"><i class="fas fa-plus"></i> Add</button>
                        <button type="button" class="btn btn-danger" onclick="deleteEntry()"><i class="fas fa-trash"></i> Delete</button>
                    </div>
                </div>
            </div> -->
            <div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label><strong>Start Date</strong></label>
                        <div>
                            <input type="date" required class="form-control" id="start_date" value="<?php echo date('Y-m-01', strtotime(date("Y-m-d"))); ?>" name="input[start_date]">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label><strong>End Date</strong></label>
                        <div>
                            <input type="date" required class="form-control" id="end_date" value="<?php echo date('Y-m-t', strtotime(date("Y-m-d"))) ?>" name="input[end_date]">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>&nbsp;</label>
                        <div>
                            <div class="btn-group">
                                <button type="button" class="btn btn-warning" onclick="getEntries()"><i class="fas fa-refresh"></i> Generate</button>

                                <div class="dropdown">
                                    <button type="button" class="btn btn-primary" onclick="addModal()"><i class="fas fa-plus"></i> Add</button>
                                </div>
                                <div class="dropdown">
                                    <div class="btn-group btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-danger" onclick="deleteEntry()"><i class="fas fa-trash"></i> Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                        <th>Account</th>
                                        <th>Voucher #</th>
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
<?php include "modal_vouchers.php"; ?>
<?php include 'modal_print.php' ?>
<?php include 'modal_export.php' ?>
<script type="text/javascript">
    function getAccount() {
        var account_type = $("#account_type").val();
        var branch_id = $("#branch_id").val();

        if (account_type == "C") {
            getSelectOption('Clients', 'account_id', 'client_fullname', "branch_id='" + branch_id + "'");
            $("#div_loan").show();
            $("#loan_id").prop('required', true);
        } else {
            getSelectOption('Suppliers', 'account_id', 'supplier_name', "branch_id='" + branch_id + "'");
            $("#div_loan").hide();
            $("#loan_id").prop('required', false);
            // $("#div_account").removeClass('col-md-12').addClass('col-md-6');
        }
    }

    function getLoan() {
        var account_type = $("#account_type").val();

        if (account_type == "C") {
            var account_id = $("#account_id").val();
            getSelectOption('Loans', 'loan_id', 'reference_number', 'client_id = "' + account_id + '" AND status="A"');
        }
    }

    function getEntries() {
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();
        var param = "(voucher_date >= '" + start_date + "' AND voucher_date <= '" + end_date + "')";

        $("#dt_entries").DataTable().destroy();
        $("#dt_entries").DataTable({
            "processing": true,
            "order": [
                [2, 'desc']
            ],
            "ajax": {
                "url": "controllers/sql.php?c=" + route_settings.class_name + "&q=show",
                "dataSrc": "data",
                "type": "POST",
                "data": {
                    input: {
                        param: param
                    }
                }
            },
            "columns": [{
                    "mRender": function(data, type, row) {
                        return row.status == "F" ? "" : '<div class="custom-checkbox custom-control"><input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" name="dt_id" id="checkbox-b' + row.voucher_id + '" value=' + row.voucher_id + '><label for="checkbox-b' + row.voucher_id + '" class="custom-control-label">&nbsp;</label></div>';
                    }
                },
                {
                    "mRender": function(data, type, row) {
                        return '<div class="dropdown d-inline"><button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-cog"></span></button><div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;"><a class="dropdown-item has-icon" href="#" onclick="getEntryDetails2(' + row.voucher_id + ')"><i class="far fa-edit"></i> Update</a><a class="dropdown-item has-icon" href="#" onclick="printRecord(' + row.voucher_id + ')"><i class="far fa-print"></i> Print</a>';
                    }
                },
                {
                    "data": "reference_number"
                },
                {
                    "data": "account"
                },
                {
                    "data": "voucher_no"
                },
                {
                    "data": "amount",
                    className: "text-right"
                },
                {
                    "mRender": function(data, type, row) {
                        return row.status == "F" ? '<a href="#" class="badge badge-primary">Finished</a>' : row.status == "C" ? '<a href="#" class="badge badge-danger">Canceled</a>' : '<a href="#" class="badge badge-light">Saved</a>';
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

    function journalID(id) {
        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=" + route_settings.class_name + "&q=journal_id",
            data: {
                input: {
                    id: id
                }
            },
            success: function(data) {
                var jsonParse = JSON.parse(data);
                const json = jsonParse.data;
                $("#journal_entry_id").val(json);
                getEntries2();
            }
        });
    }

    // $('#journal_entry_id').change(function() { getEntries2(); });

    function getEntries2() {
        var journal_entry_id = $("#journal_entry_id").val();
        var param = "journal_entry_id = '" + journal_entry_id + "'";
        $("#dt_entries_2").DataTable().destroy();
        $("#dt_entries_2").DataTable({
            "processing": true,
            "order": [
                [3, 'desc']
            ],
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

                debitTotal = api
                    .column(3, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);


                creditTotal = api
                    .column(4, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);



                // Update footer
                $(api.column(3).footer()).html(
                    "&#x20B1; " + debitTotal.toLocaleString('en-US', {
                        minimumFractionDigits: 2
                    })
                );

                $(api.column(4).footer()).html(
                    "&#x20B1; " + creditTotal.toLocaleString('en-US', {
                        minimumFractionDigits: 2
                    })
                );


            },
            "columns": [{
                    "mRender": function(data, type, row) {
                        return '<div class="custom-checkbox custom-control"><input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" name="dt_id_2" id="checkbox-b' + row.journal_entry_detail_id + '" value=' + row.journal_entry_detail_id + '><label for="checkbox-b' + row.journal_entry_detail_id + '" class="custom-control-label">&nbsp;</label></div>';
                    }
                },
                {
                    "data": "chart"
                },
                {
                    "data": "description"
                },
                {
                    "data": "debit",
                    className: "text-right"
                },
                {
                    "data": "credit",
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

    function cancelVoucher() {
        var journal_entry_id = $("#journal_entry_id").val();
        var voucher_id = $("#hidden_id_2").val();

        swal({
                title: 'Are you sure?',
                text: 'This entries will be cancelled!',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "POST",
                        url: "controllers/sql.php?c=" + route_settings.class_name + "&q=cancel",
                        data: {
                            input: {
                                journal_entry_id: journal_entry_id,
                                voucher_id: voucher_id
                            }
                        },
                        success: function(data) {
                            getEntries();
                            var json = JSON.parse(data);
                            if (json.data == 1) {
                                success_cancel();
                                $("#modalEntry2").modal('hide');
                            } else {
                                failed_query(json);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            errorLogger('Error:', textStatus, errorThrown);
                        }
                    });
                } else {
                    swal("Cancelled", "Entries are safe :)", "error");
                }
            });

    }

    $(document).ready(function() {
        schema();
        getEntries();
        getSelectOption('Branches', 'branch_id', 'branch_name', '', [], '', 'Please Select', '', 1);
        getSelectOption('Journals', 'journal_id', 'journal_name', '', ['journal_code']);
        getSelectOption('ChartOfAccounts', 'chart_id', 'chart_name');
    });
</script>