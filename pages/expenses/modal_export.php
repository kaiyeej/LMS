<div class="modal fade" id="modalExport" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 100%;max-width: 2000px;margin: 0.5rem;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span class='ion-compose'></span> Export Disbursement Template</h5>
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
                                <th>EXPENSE REFERENCE #</th>
                                <th>Branch (BCD,LC)</th>
                                <th>Date</th>
                                <th>Journal Name</th>
                                <th>Payment Method</th>
                                <th>Remarks</th>
                                <th>Chart (Details only)</th>
                                <th>Description (Details only)</th>
                                <th>Amount (Details only)</th>
                            </tr>
                            <tr>
                                <td contenteditable="true">EXP-20230601000001</td>
                                <td contenteditable="true">BCD</td>
                                <td contenteditable="true">06/01/2023</td>
                                <td contenteditable="true">Beginning Balance</td>
                                <td contenteditable="true">Cash in Bank</td>
                                <td contenteditable="true">For test purposes only</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td contenteditable="true">EXP-20230601000001</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td contenteditable="true">Prepaid Rent</td>
                                <td contenteditable="true">Test Description</td>
                                <td contenteditable="true">1975.75</td>
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
                        <li>Dates : mm/dd/YYYY format</li>
                        <li>Journal : Please refer in Journals Module</li>
                        <li>Payment Method : Please refer in Chart of Accounts Module</li>
                        <li>Chart : Please refer to Chart of Accounts Module, for details only</li>
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
        downloadLink.setAttribute('download', 'DisbursementTemplate.csv');
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
        width: max-content;
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