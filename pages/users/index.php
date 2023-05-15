<section class="section">
    <div class="section-header">
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Transactions</a></div>
            <div class="breadcrumb-item">Users</div>
        </div>
    </div>

    <div class="section-body">
        <div class="alert alert-light alert-has-icon" style="border: 1px dashed #3C84AB;">
            <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
            <div class="alert-body">
                <div class="alert-title">User Accounts</div>
                Manage users here.
            </div>
            <div>
                <a href="#" class="btn btn-icon icon-left btn-primary" onclick="addUser()"><i class="fas fa-plus"></i> Add</a>
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
                                        <th></th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Username</th>
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
<?php require_once "modal_users.php"; ?>
<?php require_once 'modal_privileges.php'; ?>
<script type="text/javascript">
    function addUser() {
        $("#div_pass").show();
        $("#password").prop('required', true);
        addModal();
    }

    function getUserDetails(id) {
        $("#div_password").hide();
        getEntryDetails(id);
    }

    function getUserPrivileges(id) {
        $("#priv_user_id").val(id);
        $("#modalPrivileges").modal('show');

        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=UserPrivileges&q=lists",
            data: {
                input: {
                    id: id
                }
            },
            success: function(data) {
                var json = JSON.parse(data),
                    text_masterdata = '',
                    text_transaction = '',
                    text_accounting = '';
                    text_report = '';

                if (json.data.masterdata.length > 0) {
                    for (let mIndex = 0; mIndex < json.data.masterdata.length; mIndex++) {
                        const rowData = json.data.masterdata[mIndex];
                        text_masterdata += skin_privilege(rowData.name, rowData.status, rowData.url);
                    }
                }
                $("#master_data_column").html(text_masterdata);

                if (json.data.transaction.length > 0) {
                    for (let mIndex = 0; mIndex < json.data.transaction.length; mIndex++) {
                        const rowData = json.data.transaction[mIndex];
                        text_transaction += skin_privilege(rowData.name, rowData.status, rowData.url);
                    }
                }
                $("#transaction_column").html(text_transaction);

                if (json.data.accounting.length > 0) {
                    for (let mIndex = 0; mIndex < json.data.accounting.length; mIndex++) {
                        const rowData = json.data.accounting[mIndex];
                        text_accounting += skin_privilege(rowData.name, rowData.status, rowData.url);
                    }
                }
                $("#accounting_column").html(text_accounting);

                if (json.data.report.length > 0) {
                    for (let mIndex = 0; mIndex < json.data.report.length; mIndex++) {
                        const rowData = json.data.report[mIndex];
                        text_report += skin_privilege(rowData.name, rowData.status, rowData.url);
                    }
                }
                $("#report_column").html(text_report);
            }
        });
    }

    function skin_privilege(item_name, status, url) {
        var check_input = status == 1 ? "checked" : '';
        return '<li class="list-group-item">' +
            '<input class="checkbox" name="input[' + url + ']" value="1" type="checkbox" ' + check_input + '>  ' + item_name + '<i class="input-helper"></i></label>' +
            
            '</li>';
    }


    $("#frm_privileges_submit").submit(function(e) {
        e.preventDefault();

        $("#btn_submit_priv").prop('disabled', true);
        $("#btn_submit_priv").html("<span class='fa fa-spinner fa-spin'></span> Submitting ...");

        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=UserPrivileges&q=add",
            data: $("#frm_privileges_submit").serialize(),
            success: function(data) {
                var json = JSON.parse(data);
                if (json.data) {
                    success_update();
                }
                $("#btn_submit_priv").prop('disabled', false);
                $("#btn_submit_priv").html("<span class='fa fa-check-circle'></span> Submit");
            }
        });
    });

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
                        return '<div class="custom-checkbox custom-control"><input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" name="dt_id" id="checkbox-bs' + row.user_id + '" value=' + row.user_id + '><label for="checkbox-b' + row.user_id + '" class="custom-control-label">&nbsp;</label></div>';
                    }
                },
                {
                    "mRender": function(data, type, row) {
                        return row.user_category_id <= '1' ? '' : "<center><button class='btn btn-warning btn-sm' onclick='getUserPrivileges(" + row.user_id + ")'><span class='fa fa-key'></span></button></center>";
                    }
                },
                {
                    "mRender": function(data, type, row) {
                        return "<center><button class='btn btn-sm btn-info' onclick='getUserEntry(" + row.user_id + ")'><span class='fa fa-edit'></span></button></center>";
                    }
                },
                {
                    "data": "user_fullname"
                },
                {
                    "data": "user_category_name"
                },
                {
                    "data": "username"
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

    function getUserEntry(id) {
        getEntryDetails(id);
        $("#div_pass").hide();
        $("#password").prop('required', false);
    }

    $(document).ready(function() {
        getEntries();
        getSelectOption('UserCategories', 'user_caterogy_id', 'user_caterogy_name');
    });
</script>