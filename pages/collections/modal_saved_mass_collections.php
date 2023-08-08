<div class="modal fade" id="modalSavedMassCollection" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" id="import_dialog" style="width: 100%;max-width: 2000px;margin: 0.5rem;">
        <div class="modal-content">
            <div class="modal-header" id="mass-modal-header">
                <h5 class="modal-title"><span class='ion-compose'></span> View Saved Mass Collection</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <table id="dt_saved_mass" class="table table-striped" style="width: 100%;">
                        <thead class="">
                            <tr>
                                <th></th>
                                <th>Reference #</th>
                                <th>Branch</th>
                                <th>Loan Type</th>
                                <th>Bank</th>
                                <th>Collection Date</th>
                                <th>Employer</th>
                                <th>Prepared By</th>
                            </tr>
                        </thead>
                    </table>
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
            "columns": [{
                    "mRender": function(data, type, row) {

                        return '<div class="dropdown d-inline"><button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-cog"></span></button><div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 29px, 0px); top: 0px; left: 0px; will-change: transform;"><a class="dropdown-item has-icon" href="#" onclick="viewMassCollection(' + row.mass_collection_id + ')"><i class="far fa-edit"></i> Update</a><a class="dropdown-item has-icon" href="#" onclick="deleteMassCollection(' + row.mass_collection_id + ')"><i class="far fa-trash"></i> Remove</a>';
                    }
                },
                {
                    "data": "reference_number"
                },
                {
                    "data": "branch"
                },
                {
                    "data": "loan_type"
                },
                {
                    "data": "bank"
                },
                {
                    "data": "collection_date"
                },
                {
                    "data": "employer"
                },
                {
                    "data": "prepared"
                }
            ]
        });
    }

    function deleteMassCollection(mass_collection_id) {
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
                        url: "controllers/sql.php?c=MassCollections&q=remove",
                        data: {
                            input: {
                                ids: [mass_collection_id]
                            }
                        },
                        success: function(data) {
                            getSavedMassCollection();
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
</script>