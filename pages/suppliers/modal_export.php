<div class="modal fade" id="modalExport" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 100%;max-width: 2000px;margin: 0.5rem;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span class='ion-compose'></span> Export Supplier Template</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <h3 class="text-info">Template Overview</h3>
                    <div style='width:100%' class='w3-animate-left'>
                        <table id="tbl_import_template">
                            <tr>
                                <th>SUPPLIER NAME</th>
                                <th>CONTACT NUMBER</th>
                                <th>ADDRESS</th>
                                <th>REMARKS</th>
                            </tr>
                            <tr>
                                <td contenteditable="true">&nbsp;</td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                            </tr>
                            <tr>
                                <td contenteditable="true">&nbsp;</td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row mt-2">
                    <h3 class="text-danger">Notes</h3>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="exportFile()" class="btn btn-primary">
                    <i class="fas fa-download"></i> Export
                </button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function exportTemplate() {
        $("#modalExport").modal('show');
    }

    function exportFile() {
        window.location = "assets/forms/SupplierTemplate.csv";
    }
</script>

<style>
    #tbl_import_template {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        overflow-x: scroll;
        color: #0a0a0a;
        display: block;
        width: max-content;
        max-width: 100%;
        white-space: nowrap;
    }

    #tbl_import_template td,
    th {
        border: 1px solid #dddddd;
        padding: 8px;
    }

    #tbl_import_template th {
        text-align: center;
    }
</style>

<style>
    .w3-animate-left {
        position: relative;
        animation: animateleft 0.8s
    }

    @keyframes animateleft {
        from {
            left: -300px;
            opacity: 0
        }

        to {
            left: 0;
            opacity: 1
        }
    }

    .w3-animate-zoom {
        animation: animatezoom 0.8s
    }

    @keyframes animatezoom {
        from {
            transform: scale(0)
        }

        to {
            transform: scale(1)
        }
    }

    .w3-animate-top {
        position: relative;
        animation: animatetop 0.4s
    }

    @keyframes animatetop {
        from {
            top: -300px;
            opacity: 0
        }

        to {
            top: 0;
            opacity: 1
        }
    }
</style>