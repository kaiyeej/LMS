<style>
    .tab {
        display: none;
    }

    input {
        border: 1px solid #aaaaaa;
    }

    .select2.invalid {
        border: 1px #E57373 solid !important;
    }

    .input-item.invalid {
        border: 1px #E57373 solid !important;
    }

    .p_required.invalid {
        border: 1px #E57373 solid !important;
    }

    .c_required.invalid {
        border: 1px #E57373 solid !important;
    }

    .modal-body {
        max-width: 100%;
        overflow-x: auto;
    }
</style>
<section class="section">
    <div class="section-header">
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Master Data</a></div>
            <div class="breadcrumb-item">Clients</div>
        </div>
    </div>

    <div class="section-body shadow">
        <div class="alert alert-light alert-has-icon" style="border: 1px dashed #3C84AB;">
            <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
            <div class="alert-body">
                <div class="alert-title">Clients</div>
                Manage clients here.
            </div>
            <div>
                <div class="dropdown">
                    <a href="#" data-toggle="dropdown" class="btn btn-info dropdown-toggle"><i class="fas fa-file-excel"></i> Template</a>
                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item has-icon" onclick="exportTemplate()"><i class="fas fa-download"></i> Export</a>
                        <a href="#" class="dropdown-item has-icon" onclick="importTemplate()"><i class="far fa-upload"></i> Import</a>
                    </div>
                    <div class="btn-group btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-primary" onclick="addClient()"><i class="fas fa-plus"></i> Add</button>
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
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Contact #</th>
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
<?php include "modal_clients.php"; ?>
<?php include "modal_import.php"; ?>
<?php include "modal_export.php"; ?>
<script type="text/javascript">
    function addClient() {
        modal_detail_status = 0;
        $("#hidden_id").val(0);
        document.getElementById("frm_client").reset();

        $("#modalLabel").html("<i class='fa fa-edit'></i> Add Entry");
        $("#modalEntry").modal('show');

        currentTab = 0;
        showTab(currentTab);
        $('.select2').select2().trigger('change');
    }

    function getEntries() {
        $("#dt_entries").DataTable().destroy();
        $("#dt_entries").DataTable({
            "processing": true,
            "order": [
                [2, 'asc']
            ],
            "ajax": {
                "url": "controllers/sql.php?c=" + route_settings.class_name + "&q=show",
                "dataSrc": "data"
            },
            "columns": [{
                    "mRender": function(data, type, row) {
                        return '<div class="custom-checkbox custom-control"><input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" name="dt_id" id="checkbox-b' + row.client_id + '" value=' + row.client_id + '><label for="checkbox-b' + row.client_id + '" class="custom-control-label">&nbsp;</label></div>';
                    }
                },
                {
                    "mRender": function(data, type, row) {
                        var update_client = "window.location='u'";
                        return "<center><button class='btn btn-sm btn-info' onclick='window.location=\"client-update?c=" + row.client_id + "\" '><span class='fa fa-edit'></span></button></center>";
                    }
                },
                {
                    "data": "client_fullname"
                },
                {
                    "data": "client_address"
                },
                {
                    "data": "client_contact_no"
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

    function getPreview(id) {
        $("#modalPreview").modal("show");
        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=" + route_settings.class_name + "&q=view",
            data: {
                input: {
                    id: id
                }
            },
            success: function(data) {
                getProperty(id);
                getChildren(id);
                var jsonParse = JSON.parse(data);
                const json = jsonParse.data;

                $('.label-item').map(function() {
                    const id_name = this.id;
                    const new_id = id_name.replace('_label', '');
                    this.innerHTML = json[new_id];
                });
            }
        });
    }

    // function getProperty(id) {
    //     var params = "client_id = '" + id + "'";
    //     $.ajax({
    //         type: "POST",
    //         url: "controllers/sql.php?c=" + route_settings.class_name + "&q=get_property",
    //         data: {
    //             input: {
    //                 params: params
    //             }
    //         },
    //         success: function(data) {
    //             var jsonParse = JSON.parse(data);
    //             const json = jsonParse.data;
    //             console.log(json);
    //             $("#property_container").html(json);
    //         }
    //     });
    // }

    // function getChildren(id) {
    //     var params = "client_id = '" + id + "'";
    //     $.ajax({
    //         type: "POST",
    //         url: "controllers/sql.php?c=" + route_settings.class_name + "&q=get_children",
    //         data: {
    //             input: {
    //                 params: params
    //             }
    //         },
    //         success: function(data) {
    //             var jsonParse = JSON.parse(data);
    //             const json = jsonParse.data;
    //             console.log(json);
    //             $("#children_container").html(json);
    //         }
    //     });
    // }

    $("#modalEntry").on('hide.bs.modal', function() {
        currentTab = 0;
        showTab(0);
        $(".required").removeClass("invalid");
        $(".p_required").removeClass("invalid");
        $(".wizard-step").removeClass("wizard-step-info");
        $(".tab").css({
            "display": "none"
        });
        $("#page_content_1").css({
            "display": "block"
        });
    });

    $(document).ready(function() {
        getEntries();
        getSelectOption('Insurance', 'insurance_id', 'insurance_name');
        getSelectOption('Branches', 'branch_id', 'branch_name');
        getSelectOption('ClientTypes', 'client_type_id', 'client_type');
    });
</script>