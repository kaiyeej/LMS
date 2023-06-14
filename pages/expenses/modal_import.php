<form id='frm_import' method="POST" enctype="multipart/form-data">
    <div class="modal fade" id="modalImport" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" id="import_dialog"
            style="width: 100%;max-width: 2000px;margin: 0.5rem;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span class='ion-compose'></span> Import Disbursement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12" id="import_file">
                        <div class="form-group">
                            <div class="col-lg-12" style="padding: 10px;">
                                <label class="text-md-right text-left">Disbursement Template (CSV)</label>
                                <input type="file" name="csv_file" accept=".csv" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" id="import_result_content">
                        <center><img src="assets/icons/loader.gif"></center>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn_import" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    function importTemplate() {
        $('#import_result_content').html("");
        $("#import_file").show();
        $("#btn_import").show();
        $("#modalImport").modal('show');
    }
    $('#frm_import').submit(function(e) {
        e.preventDefault(); // Prevent form submission

        var formData = new FormData(this);
        $('#import_result_content').html(`<center><img src="assets/icons/loader.gif"></center>`);
        $.ajax({
            url: "controllers/sql.php?c=" + route_settings.class_name + "&q=import",
            type: 'POST',
            data: formData,
            dataType: 'html',
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                var res = JSON.parse(response);

                $("#import_file").hide();
                if (res.data.status == -1) {
                    $('#import_result_content').html(`<div class="alert alert-danger" role="alert">${res.data.text}</div>`);
                } else if (res.data.status == 1) {
                    getEntries();
                    $("#btn_import").hide();
                    if (res.data.disbursements.length > 0) {
                        var disbursement_tr = "";
                        for (var dataIndex = 0; dataIndex < res.data.disbursements.length; dataIndex++) {
                            const disbursement = res.data.disbursements[dataIndex];
                            var is_import_failed = disbursement.import_status == 0 ? "import_failed" : "";
                            disbursement_tr += `<tr class='${is_import_failed}'>
                                <td>${dataIndex + 1}</td>
                                <td>${disbursement.reference_number}</td>
                                <td>${disbursement.branch_name}</td>
                                <td>${disbursement.expense_date}</td>
                                <td>${disbursement.journal_name}</td>
                                <td>${disbursement.payment_method}</td>
                                <td>${disbursement.chart_name}</td>
                                <td>${disbursement.expense_amount}</td>
                              </tr>`;
                        }
                        $('#import_result_content').html(`<div style='width:100%'>
                            <div class="mb-2">
                                <button type="button" class="btn btn-primary">Successful imports <span class="badge badge-transparent">${res.data.success_import}</span>
                                </button>
                                <button type="button" class="btn btn-danger">Unsuccessful imports <span class="badge badge-transparent">${res.data.unsuccess_import}</span>
                                </button>
                            </div>
                            <table id="tbl_import_result">
                              <tr>
                                <th style="min-width:5%;">#</th>
                                <th style="min-width:150px;">Reference</th>
                                <th style="min-width:150px;">Branch</th>
                                <th style="min-width:200px;">Expense Date</th>
                                <th style="min-width:100px;">Journal</th>
                                <th style="min-width:100px;">Payment Method</th>
                                <th style="min-width:200px;">Chart</th>
                                <th style="min-width:200px;">Amount</th>
                              </tr>
                              ${disbursement_tr}
                        </table>
                        </div>`);
                    } else {
                        $('#import_result_content').html(`<div class="alert alert-danger" role="alert">No disbursement</div>`);
                    }
                } else {
                    $('#import_result_content').html(`<div class="alert alert-danger" role="alert">Error occur while importing disbursement</div>`);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert('An error occurred while processing the request.');
            }
        });
    });
</script>
<style>
    #tbl_import_result {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        overflow-y: scroll;
        height: 350px;
        display: block;
    }

    #tbl_import_result td,
    th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    .import_failed {
        background-color: #db5151;
        color: #fff;
    }
</style>