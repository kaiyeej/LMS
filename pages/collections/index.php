<section class="section">
    <div class="section-header">
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Transactions</a></div>
            <div class="breadcrumb-item">Collections</div>
        </div>
    </div>

    <div class="section-body shadow">
        <div class="alert alert-light alert-has-icon" style="border: 1px dashed #3C84AB;">
            <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
            <div class="alert-body">
                <div class="alert-title">Collections</div>
                Manage collections here.
            </div>
            <div>
                <div class="dropdown">
                    <a href="#" data-toggle="dropdown" class="btn btn-info dropdown-toggle"><i class="fas fa-file-excel"></i> Template</a>
                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item has-icon" onclick="exportTemplate()"><i class="fas fa-download"></i> Export</a>
                        <a href="#" class="dropdown-item has-icon" onclick="importTemplate()"><i class="far fa-upload"></i> Import</a>
                    </div>
                    <div class="btn-group btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-success" onclick="addMassCollection()"><i class="fas fa-coins"></i> Mass Collection</button>
                        <button type="button" class="btn btn-primary" onclick="addModal()"><i class="fas fa-plus"></i>
                            Add</button>
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
                                        <th>Loan ID</th>
                                        <th>Client</th>
                                        <th>Amount</th>
                                        <th>Collection Date</th>
                                        <th>Status</th>
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
<?php include "modal_collections.php"; ?>
<?php include "modal_mass_collections.php"; ?>
<?php include "modal_export.php"; ?>
<?php include "modal_import.php"; ?>
<script type="text/javascript">
    function getEntries() {
        $("#dt_entries").DataTable().destroy();
        $("#dt_entries").DataTable({
            "processing": true,
            "order": [
                [2, 'desc']
            ],
            "ajax": {
                "url": "controllers/sql.php?c=" + route_settings.class_name + "&q=show",
                "dataSrc": "data"
            },
            "columns": [{
                    "mRender": function(data, type, row) {
                        return '<div class="custom-checkbox custom-control"><input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" name="dt_id" id="checkbox-b' + row.collection_id + '" value=' + row.collection_id + '><label for="checkbox-b' + row.collection_id + '" class="custom-control-label">&nbsp;</label></div>';
                    }
                },
                {
                    "mRender": function(data, type, row) {
                        return "<center><button class='btn btn-sm btn-info' onclick='getEntryDetails(" + row.collection_id + ")'><span class='fa fa-edit'></span></button></center>";
                    }
                },
                {
                    "data": "reference_number"
                },
                {
                    "data": "loan_ref_id"
                },
                {
                    "data": "client"
                },
                {
                    "data": "amount"
                },
                {
                    "data": "collection_date"
                },
                {
                    "mRender": function(data, type, row) {
                        return row.status == "P" ? '<a href="#" class="badge badge-light">Pending</a>' : (row.status == 'F' ? '<a href="#" class="badge badge-success">Finished</a>' : '<a href="#" class="badge badge-danger">Canceled</a>');
                    }
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

    function getPenalty() {
        var loan_id = $("#loan_id").val();
        var collection_date = $("#collection_date").val();
        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=Loans&q=penalty",
            data: {
                input: {
                    loan_id: loan_id,
                    collection_date: collection_date
                }
            },
            success: function(data) {
                var json = JSON.parse(data);
                $("#penalty_amount").val(json.data);
            }
        });
    }

    function loan_id() {
        var id = $("#hidden_id").val();
        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=" + route_settings.class_name + "&q=loan_id",
            data: {
                input: {
                    id: id
                }
            },
            success: function(data) {
                var jsonParse = JSON.parse(data);
                const json = jsonParse.data;
                $("#loan_id").val(json).trigger('change');
            }
        });
    }



    $('#client_id').change(function() {
        getSelectOption('Loans', 'loan_id', "reference_number", "client_id = '" + $(this).val() + "' AND status = 'R'");
    })

    $(document).ready(function() {
        getEntries();
        getSelectOption('Clients', 'client_id', 'client_fullname');
        getSelectOption('LoanTypes', 'loan_type_id', 'loan_type', "", ['loan_type_interest']);
    });
</script>