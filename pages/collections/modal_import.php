<form id='frm_import' method="POST" enctype="multipart/form-data">
    <div class="modal fade" id="modalImport" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" id="import_dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span class='ion-compose'></span> Import Collections</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12" id="import_file">
                        <div class="form-group">
                            <div class="col-lg-12" style="padding: 10px;">
                                <label class="text-md-right text-left">Collections Template (CSV)</label>
                                <input type="file" id="csv_file" name="csv_file" accept=".csv" class="form-control" required>
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
        $("#csv_file").val('');
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
                try {
                    var res = JSON.parse(response);

                    $("#import_file").hide();
                    if (res.data.status == -1) {
                        $('#import_result_content').html(`<div class="alert alert-danger" role="alert">${res.data.text}</div>`);
                    } else if (res.data.status == 1) {
                        getEntries();
                        $("#btn_import").hide();
                        if (res.data.collections.length > 0) {
                            var loans_tr = "";
                            for (var loanIndex = 0; loanIndex < res.data.collections.length; loanIndex++) {
                                const collection = res.data.collections[loanIndex];
                                var is_import_failed = collection.import_status == 0 ? "import_failed" : "";
                                loans_tr += `<tr class='${is_import_failed}'>
                                <td>${loanIndex + 1}</td>
                                <td>${collection.branch_name}</td>
                                <td>${collection.loan_reference_number}</td>
                                <td>${collection.client_name}</td>
                                <td>${collection.collection_date}</td>
                                <td>${collection.bank}</td>
                                <td>${collection.penalty_amount}</td>
                                <td>${collection.amount}</td>
                                <td>${collection.remarks}</td>
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
                                <th>#</th>
                                <th>Branch</th>
                                <th>Loan Reference #</th>
                                <th>Client</th>
                                <th>Collection Date</th>
                                <th style="min-width: 150px;">Bank</th>
                                <th>Penalty</th>
                                <th>Collection Amount</th>
                                <th style="min-width: 150px;">Remarks</th>
                              </tr>
                              ${loans_tr}
                        </table>
                        </div>`);
                        } else {
                            $("#csv_file").val('');
                            $("#import_file").show();
                            $('#import_result_content').html(`<div class="alert alert-danger" role="alert">No collections</div>`);
                        }
                    } else {
                        $('#import_result_content').html(`<div class="alert alert-danger" role="alert">Error occur while importing collections</div>`);
                    }
                } catch (error) {
                    $("#csv_file").val('');
                    $("#import_file").show();
                    $('#import_result_content').html(`<div class="alert alert-danger" role="alert">Error occur while importing file. Please contact Juancoder IT Solutions.</div>`);
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
        overflow: scroll;
        color: #0a0a0a;
        display: block;
        width: max-content;
        max-width: 100%;
        white-space: nowrap;
        height: 350px;
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