<form id='frm_import' method="POST" enctype="multipart/form-data">
    <div class="modal fade" id="modalImport" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" id="import_dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span class='ion-compose'></span> Import Clients</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12" id="import_file">
                        <div class="form-group">
                            <div class="col-lg-12" style="padding: 10px;">
                                <label class="text-md-right text-left">Client Template (CSV)</label>
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
                    $("#import_file").hide();
                    var res = JSON.parse(response);
                    if (res.data.status == -1) {
                        $('#import_result_content').html(`<div class="alert alert-danger" role="alert">${res.data.text}</div>`);
                    } else if (res.data.status == 1) {
                        getEntries();
                        $("#btn_import").hide();
                        if (res.data.clients.length > 0) {
                            var clients_tr = "";
                            for (var clientIndex = 0; clientIndex < res.data.clients.length; clientIndex++) {
                                const client = res.data.clients[clientIndex];
                                var client_name = client.client_fname + " " + client.client_mname + " " + client.client_lname + " " + client.client_name_extension;
                                var is_import_failed = client.import_status == 0 ? "import_failed" : "";
                                clients_tr += `<tr class='${is_import_failed}'>
                                <td>${clientIndex + 1}</td>
                                <td>${client_name}</td>
                                <td>${client.client_civil_status}</td>
                                <td>${client.client_dob}</td>
                                <td>${client.client_contact_no}</td>
                                <td>${client.residence}</td>
                                <td>(${client.employment_status}) ${client.employment_position} @${client.employer}</td>
                                <td>${client.locations.length}</td>
                                <td>${client.childrens.length}</td>
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
                                <th>Name</th>
                                <th>Civil Status</th>
                                <th>Birth Date</th>
                                <th>Contact Number</th>
                                <th>Adress</th>
                                <th>Employment</th>
                                <th>Properties</th>
                                <th>Children</th>
                              </tr>
                              ${clients_tr}
                        </table>
                        </div>`);
                        } else {
                            $('#import_result_content').html(`<div class="alert alert-danger" role="alert">No clients</div>`);
                        }
                    } else {
                        $('#import_result_content').html(`<div class="alert alert-danger" role="alert">Error occur while importing clients</div>`);
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