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
            <div class="breadcrumb-item">Employers</div>
        </div>
    </div>

    <div class="section-body shadow">
        <div class="alert alert-light alert-has-icon" style="border: 1px dashed #3C84AB;">
            <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
            <div class="alert-body">
                <div class="alert-title">Employers</div>
                Manage employers here.
            </div>
            <div>
                <div class="dropdown">
                    <div class="btn-group btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-primary" onclick="addEntry()"><i class="fas fa-plus"></i> Add</button>
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
<?php include "modal_employers.php"; ?>
<script type="text/javascript">
    function addEntry() {
        modal_detail_status = 0;
        $("#hidden_id").val(0);
        document.getElementById("frm_submit").reset();

        $("#modalLabel").html("<i class='fa fa-edit'></i> Add Entry");
        $("#modalEntry").modal('show');

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
                        return '<div class="custom-checkbox custom-control"><input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" name="dt_id" id="checkbox-b' + row.employer_id + '" value=' + row.employer_id + '><label for="checkbox-b' + row.employer_id + '" class="custom-control-label">&nbsp;</label></div>';
                    }
                },
                {
                    "mRender": function(data, type, row) {
                        return "<center><button class='btn btn-sm btn-info' onclick='getEntryDetails(" + row.employer_id + ")'><span class='fa fa-edit'></span></button></center>";
                    }
                },
                {
                    "data": "employer_name"
                },
                {
                    "data": "employer_address"
                },
                {
                    "data": "employer_contact_no"
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
    $(document).ready(function() {
        schema();
        getEntries();
    });
</script>