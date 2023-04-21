<style>
    .tab {
        display: none;
    }

    input {
        border: 1px solid #aaaaaa;
    }

    /* Mark input boxes that gets an error on validation:
input.invalid {
    border: 1px #E57373 solid;
}

textarea.invalid {
    border: 1px #E57373 solid;
} */

    .input-item.invalid {
        border: 1px #E57373 solid;
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
            <div class="breadcrumb-item"><a href="#">Transactions</a></div>
            <div class="breadcrumb-item">Clients</div>
        </div>
    </div>

    <div class="section-body">
        <div class="alert alert-light alert-has-icon" style="border: 1px dashed #3C84AB;">
            <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
            <div class="alert-body">
                <div class="alert-title">Clients</div>
                Manage clients here.
            </div>
            <div>
                <a href="#" class="btn btn-icon icon-left btn-primary" onclick="addClient()"><i class="fas fa-plus"></i> Add</a>
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
<script type="text/javascript">

    function addClient() {
        modal_detail_status = 0;
        $("#hidden_id").val(0);
        document.getElementById("frm_client").reset();

        $("#modalLabel").html("<i class='fa fa-edit'></i> Add Entry");
        $("#modalEntry").modal('show');

        currentTab = 0;
        showTab(currentTab);
        alert(currentTab);
        $('.select2').select2().trigger('change');
    }

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
                        return '<div class="custom-checkbox custom-control"><input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" name="dt_id" id="checkbox-b' + row.client_id + '" value=' + row.client_id + '><label for="checkbox-b' + row.client_id + '" class="custom-control-label">&nbsp;</label></div>';
                    }
                },
                {
                    "mRender": function(data, type, row) {
                        return "<center><button class='btn btn-sm btn-info' onclick='getEntryDetails(" + row.client_id + ")'><span class='fa fa-edit'></span></button></center>";
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

    $("#modalEntry").on('hide.bs.modal', function(){
        currentTab = 0;
        showTab(0);
        $(".required").removeClass("invalid");
    });

    $(document).ready(function() {
        getEntries();
        getSelectOption('Insurance', 'insurance_id', 'insurance_name');
    });
</script>