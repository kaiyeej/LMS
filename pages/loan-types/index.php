<section class="section">
    <div class="section-header">
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Master Data</a></div>
            <div class="breadcrumb-item">Loan Types</div>
        </div>
    </div>

    <div class="section-body shadow">
        <div class="alert alert-light alert-has-icon" style="border: 1px dashed #3C84AB;">
            <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
            <div class="alert-body">
                <div class="alert-title">Loan Types</div>
                Manage loan types here.
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
                                        <th>Loan Type</th>
                                        <th>Loan Interest</th>
                                        <th>Penalty Percentage</th>
                                        <th>Remarks</th>
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
<?php include "modal_types.php"; ?>
<?php include "modal_fixed_interest.php"; ?>
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
                        return '<div class="custom-checkbox custom-control"><input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" name="dt_id" id="checkbox-b' + row.loan_type_id + '" value=' + row.loan_type_id + '><label for="checkbox-b' + row.loan_type_id + '" class="custom-control-label">&nbsp;</label></div>';
                    }
                },
                {
                    "mRender": function(data, type, row) {
                        var fixed_stat = row.fixed_interest == "Y" ? "" : "style='display:none;'";
                        return "<center><button class='btn btn-sm btn-info' onclick='getEntryDetails(" + row.loan_type_id + ")'><span class='fa fa-edit'></span></button><button class='btn btn-sm btn-success' " + fixed_stat + " onclick='getFixedDetails(" + row.loan_type_id + ")'><span class='fa fa-edit'></span></button></center>";
                    }
                },
                {
                    "data": "loan_type"
                },
                {
                    "mRender": function(data, type, row) {
                       return row.fixed_interest == "Y" ? "<span class='badge badge-light' style='font-size: 10px;'><i>Fixed Interest</i></span>" : row.loan_type_interest;
                       //"<center><button class='btn btn-sm btn-info' onclick='getEntryDetails(" + row.loan_type_id + ")'><span class='fa fa-edit'></span></button><button class='btn btn-sm btn-success' " + fixed_stat + " onclick='getFixedDetails(" + row.loan_type_id + ")'><span class='fa fa-edit'></span></button></center>";
                    }
                },
                {
                    "data": "penalty_percentage"
                },
                {
                    "data": "remarks"
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

    function fixedInterest() {
        if ($("#fixed_interest").prop("checked")) {
            $(".con_normal").hide();
            $('#loan_type_interest').prop('required', false);
            $('#penalty_percentage').prop('required', false);

            $('#loan_type_interest').val('');
            $('#penalty_percentage').val('');
        } else {
            $(".con_normal").show();
            $('#loan_type_interest').prop('required', true);
            $('#penalty_percentage').prop('required', true);
        }
    }

    function getFixedDetails(id) {
        $("#modalFixedEntry").modal("show");
        $("#hidden_id2").val(id);
        getfixedEntry();
    }

    $("#frm_fixed").submit(function(e) {
        e.preventDefault();

        $("#btn_submit2").prop('disabled', true);
        $("#btn_submit2").html("<span class='fa fa-spinner fa-spin'></span> Submitting ...");

        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=FixedInterest&q=add",
            data: $("#frm_fixed").serialize(),
            success: function(data) {
                getEntries();
                var json = JSON.parse(data);
                if (json.data == 1) {
                    success_add();
                    $(".input-item").val("");
                    getfixedEntry();
                } else if (json.data == 2) {
                    entry_already_exists();
                } else {
                    failed_query(json);
                }

                $("#btn_submit2").prop('disabled', false);
                $("#btn_submit2").html("Add");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                errorLogger('Error:', textStatus, errorThrown);
            }
        });
    });

    function getfixedEntry() {

        var param = "loan_type_id = '" + $("#hidden_id2").val() + "'";

        $("#dt_fixed_interest").DataTable().destroy();
        $("#dt_fixed_interest").DataTable({
            "processing": true,
            "bPaginate": false,
            "bFilter": false,
            "bInfo": false,
            "ajax": {
                "url": "controllers/sql.php?c=FixedInterest&q=show",
                "dataSrc": "data",
                "method": "POST",
                "data": {
                    input: {
                        param: param
                    }
                },
            },
            "columns": [{
                    "mRender": function(data, type, row) {
                        return "<center><button type='button' class='btn btn-sm btn-danger' id='btn_delete_" + row.loan_interest_id + "' onclick='deleteFixedInterest(" + row.loan_interest_id + ")'><span class='fa fa-trash'></span></button></center>";
                    }
                },
                {
                    "data": "loan_amount"
                },
                {
                    "data": "interest_amount"
                },
                {
                    "data": "penalty_percentage"
                },
                {
                    "data": "interest_terms"
                }
            ]
        });
    }


    function deleteFixedInterest(id) {

        $("#btn_delete_" + id).html("<span class='fa fa-spinner fa-spin'></span>");
        swal({
                title: 'Are you sure?',
                text: 'You will not be able to recover these entries!',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "POST",
                        url: "controllers/sql.php?c=FixedInterest&q=delete_entry",
                        data: {
                            input: {
                                id: id
                            }
                        },
                        success: function(data) {
                            getfixedEntry();
                            var json = JSON.parse(data);
                            console.log(json);
                            if (json.data == 1) {
                                success_delete();
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
    });
</script>