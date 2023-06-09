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
                        <table id="tbl_import_template">
                            <tr>
                                <th>Reference #</th>
                                <th>Voucher #</th>
                                <th>Check #</th>
                                <th>A/C #</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Description</th>
                                <th>Supplier</th>
                                <th>Client</th>
                                <th>Loan Reference (For Client Only)</th>
                                <th>Chart Code (For Details only)</th>
                                <th>Description (For Details only)</th>
                                <th>Debit Amount (For Client Only)</th>
                                <th>Credit Amount (For Client Only)</th>
                            </tr>
                            <tr>
                                <td contenteditable="true">CV-20230526055830</td>
                                <td contenteditable="true">1</td>
                                <td contenteditable="true">2</td>
                                <td contenteditable="true">3</td>
                                <td contenteditable="true">06/08/2023</td>
                                <td contenteditable="true">200,000.00</td>
                                <td contenteditable="true">TO RELEASE LOAN PROCEEDS FOR THE RENEWAL OF SHIELA</td>
                                <td contenteditable="true">Eduard Rino Carton</td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td contenteditable="true">CV-20230526055830</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td contenteditable="true">20020</td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true">200,000.000</td>
                                <td contenteditable="true"></td>
                            </tr>
                            <tr>
                                <td contenteditable="true">CV-20230526055830</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td contenteditable="true">20020</td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true">143,746.180</td>
                            </tr>
                            <tr>
                                <td contenteditable="true">CV-20230526055830</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td contenteditable="true">100300</td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true"></td>
                                <td contenteditable="true">56,253.820</td>
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
        // window.location = "assets/forms/CollectionsTemplate.csv";

        // Get the table by ID
        let table = document.getElementById('tbl_import_template');

        // Convert table to CSV format
        let csvData = convertTableToCSV(table);

        // Create a hidden anchor element to download the CSV file
        let downloadLink = document.createElement('a');
        downloadLink.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csvData));
        downloadLink.setAttribute('download', 'VoucherTemplate.csv');
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