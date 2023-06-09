<div class="modal fade" id="modalExport" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span class='ion-compose'></span> Export Insurance Template</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <h3 class="text-info">Template Overview</h3>
                    <div style='width:100%' class='w3-animate-left'>
                        <table id="tbl_export_template">
                            <tr>
                                <th style="min-width: 100px;">BRANCH (BCD,LC)</th>
                                <th style="min-width: 200px;">INSURANCE NAME</th>
                                <th style="min-width: 100px;">AMOUNT</th>
                                <th style="min-width: 300px;">DESCRIPTION</th>
                            </tr>
                            <tr>
                                <td contenteditable="true">&nbsp;</td>
                                <td contenteditable="true"></td>
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
                <div class="row">
                    <h6 class="text-danger">Notes: Please open exported file (.csv) in Microsoft Excel Application</h6>

                </div>
                <div class="row">
                    <ul class="text-danger">
                        <li>Branches : BCD (Bacolod), LC (La Carlota)</li>
                        <li>Amount : Encode in no comma (e.g 1000)</li>
                    </ul>
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
        // window.location = "assets/forms/CollectionsTemplate.csv";

        // Get the table by ID
        let table = document.getElementById('tbl_export_template');

        // Convert table to CSV format
        let csvData = convertTableToCSV(table);

        // Create a hidden anchor element to download the CSV file
        let downloadLink = document.createElement('a');
        downloadLink.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csvData));
        downloadLink.setAttribute('download', 'InsuranceTemplate.csv');
        downloadLink.style.display = 'none';

        // Append the anchor element to the document body and click it to trigger the download
        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);
    }

    function convertTableToCSV(table) {
        let csv = [];
        let rows = table.querySelectorAll('tr');

        for (let i = 0; i < rows.length; i++) {
            let row = [],
                cols = rows[i].querySelectorAll('td, th');

            for (let j = 0; j < cols.length; j++) {
                let cellValue = cols[j].innerText.trim().replace(/"/g, '""');
                row.push('"' + cellValue + '"');
            }

            csv.push(row.join(','));
        }

        return csv.join('\n');
    }
</script>

<style>
    #tbl_export_template {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        overflow-x: scroll;
        color: #0a0a0a;
        display: block;
        width: 100%;
        max-width: 100%;
        white-space: nowrap;
    }

    #tbl_export_template td,
    th {
        border: 1px solid #dddddd;
        padding: 8px;
    }

    #tbl_export_template th {
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