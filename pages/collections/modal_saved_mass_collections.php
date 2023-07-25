<div class="modal fade" id="modalSavedMassCollection" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" id="import_dialog" style="width: 100%;max-width: 2000px;margin: 0.5rem;">
        <div class="modal-content">
            <div class="modal-header" id="mass-modal-header">
                <h5 class="modal-title"><span class='ion-compose'></span> View Saved Mass Collection</h5>
            </div>
            <div class="modal-body">
                <div class="row section">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="dt_saved_mass" class="table table-striped">
                                        <thead class="">
                                            <tr>
                                                <th></th>
                                                <th>Reference #</th>
                                                <th>Branch</th>
                                                <th>Loan Type</th>
                                                <th>Bank</th>
                                                <th>Collection Date</th>
                                                <th>Employer</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    function viewSavedMassCollection() {
        $("#modalSavedMassCollection").modal("show");
        getSavedMassCollection();
    }

    function getSavedMassCollection() {
        var param = "status = 'S'";

        $("#dt_saved_mass").DataTable().destroy();
        $("#dt_saved_mass").DataTable({
            "processing": true,
            "order": [
                [2, 'desc']
            ],
            "ajax": {
                "url": "controllers/sql.php?c=MassCollections&q=show",
                "dataSrc": "data",
                "type": "POST",
                "data": {
                    input: {
                        param: param
                    }
                }
            },
            "columns": [
                {
                    "data": "reference_number"
                },
                {
                    "data": "reference_number"
                },
                {
                    "data": "reference_number"
                },
                {
                    "data": "reference_number"
                },
                {
                    "data": "reference_number"
                },
                {
                    "data": "reference_number"
                }
            ]
        });
    }
</script>