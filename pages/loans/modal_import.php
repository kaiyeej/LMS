<form id='frm_import' method="POST" enctype="multipart/form-data">
    <div class="modal fade" id="modalImport" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" id="import_dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span class='ion-compose'></span> Import Loans</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12" id="import_file">
                        <div class="form-group">
                            <div class="col-lg-12" style="padding: 10px;">
                                <label class="text-md-right text-left">Loans Template (CSV)</label>
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
                        Submit
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
                    if (res.data.loans.length > 0) {
                        var loans_tr = "";
                        for (var loanIndex = 0; loanIndex < res.data.loans.length; loanIndex++) {
                            const loan = res.data.loans[loanIndex];
                            var is_import_failed = loan.import_status == 0 ? "import_failed" : "";
                            loans_tr += `<tr class='${is_import_failed}'>
                                <td>${loanIndex + 1}</td>
                                <td>${loan.branch_name}</td>
                                <td>${loan.reference_number}</td>
                                <td>${loan.client_name}</td>
                                <td>${loan.loan_type}</td>
                                <td>${loan.loan_date}</td>
                                <td>${loan.loan_amount}</td>
                                <td>${loan.loan_interest}</td>
                                <td>${loan.loan_period}</td>
                                <td>${loan.service_fee}</td>
                                <td>${loan.monthly_payment}</td>
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
                                <th>Reference #</th>
                                <th>Client</th>
                                <th>Loan Type</th>
                                <th>Load Date</th>
                                <th>Loan Amount</th>
                                <th>Interest</th>
                                <th>Loan Terms</th>
                                <th>Service Fee</th>
                                <th>Monthly Payment</th>
                              </tr>
                              ${loans_tr}
                        </table>
                        </div>`);
                    } else {
                        $('#import_result_content').html(`<div class="alert alert-danger" role="alert">No loans</div>`);
                    }
                } else {
                    $('#import_result_content').html(`<div class="alert alert-danger" role="alert">Error occur while importing loans</div>`);
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