<form id='frm_upload' method="POST" enctype="multipart/form-data">
    <div class="modal fade" id="modalUpload" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" id="import_dialog" style="width: 100%;max-width: 2000px;margin: 0.5rem;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span class='ion-compose'></span> Import Loans</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12" id="upload_file">
                        <div class="form-group">
                            <div class="col-lg-12" style="padding: 10px;">
                                <label class="text-md-right text-left">Loans (XLS)</label>
                                <input type="file" name="excel_file" accept=".xlsx, .xls" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" id="upload_result_content">
                        <center><img src="assets/icons/loader.gif"></center>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn_upload" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    var loan_from_excels = [];
    document.addEventListener("keydown", function(event) {
        if (event.key === "Enter") {
            var activeElement = document.activeElement;
            var nextElement = activeElement.nextElementSibling;

            if (nextElement) {
                nextElement.focus();
                event.preventDefault();
            }
        }
    });

    function uploadFile() {
        $('#upload_result_content').html("");
        $("#upload_file").show();
        $("#btn_upload").show();
        $("#modalUpload").modal('show');
    }
    $('#frm_upload').submit(function(e) {
        e.preventDefault(); // Prevent form submission

        loan_from_excels = [];
        var formData = new FormData(this);
        $('#upload_result_content').html(`<center><img src="assets/icons/loader.gif"></center>`);
        $.ajax({
            url: "controllers/sql.php?c=" + route_settings.class_name + "&q=upload",
            type: 'POST',
            data: formData,
            dataType: 'html',
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                var json = JSON.parse(response);
                get_loan_collections(json);
                $("#upload_file").hide();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert('An error occurred while processing the request.');
            }
        });
    });

    function get_loan_collections(json) {
        var clients = json.data.sheets;
        loan_from_excels = clients;
        var client_tds = "";
        for (var clientIndex = 0; clientIndex < clients.length; clientIndex++) {
            const client = clients[clientIndex];
            var client_not_exists = client.client_id > 0 ? "" : "negative";
            client_tds += `<tr class="${client_not_exists}">
                <td>${clientIndex + 1}</td>
                <td contenteditable="true">${client.client_name}</td>
                <td colspan="7"></td>
              </tr>`;

            for (var loanIndex = 0; loanIndex < client.loans.length; loanIndex++) {
                const loan = client.loans[loanIndex];

                client_tds += `<tr>
                <td colspan="2"></td>
                <td>${loan.loan_type_name}
                    <button type="button" onclick="show_loan_collections(${clientIndex},${loanIndex})" class="btn btn-sm btn-primary" style="float:right"><span class="fa fa-list"></span></button>
                </td>
                <td onblur="editLoanCell(this,${clientIndex},${loanIndex})" contenteditable="true">${loan.loan_date}</td>
                <td onblur="editLoanNumberCell(this,${clientIndex},${loanIndex})" contenteditable="true" class='right'>${numberFormat(loan.loan_amount)}</td>
                <td onblur="editLoanNumberCell(this,${clientIndex},${loanIndex})" contenteditable="true" class='right'></td>
                <td onblur="editLoanNumberCell(this,${clientIndex},${loanIndex})" contenteditable="true" class='right'></td>
                <td onblur="editLoanNumberCell(this,${clientIndex},${loanIndex})" contenteditable="true" class='right'>${numberFormat(loan.monthly_payment)}</td>
                <td class='right'>${numberFormat(loan.balance)}</td>
              </tr>`;
            }
        }
        $('#upload_result_content').html(`<div style='width:100%' class='w3-animate-left' id="loan_client">
            <table class="tbl_loans">
              <tr>
                <th>#</th>
                <th>CLIENT</th>
                <th>LOAN TYPE</th>
                <th class='w-10'>LOAN DATE</th>
                <th class='w-10'>LOAN AMOUNT</th>
                <th class='w-10'>INTEREST</th>
                <th class='w-10'>LOAN TERMS</th>
                <th class='w-10'>MONTHLY PAYMENT</th>
                <th class='w-10'>BALANCE OUTSTANDING</th>
              </tr>
              ${client_tds}
        </table>
        </div>
        <div style='width:100%;display:none;' class='w3-animate-left' id="loan_collections">
        </div>`);
    }

    function show_loan_collections(client_index, loan_index) {
        $("#loan_client").hide();
        $("#loan_collections").show();
        $('#loan_collections').html(`
            <table class="tbl_loans">
              <tr>
                <th>#</th>
                <th>PAYMENT DATE</th>
                <th class='w-10'>PAYMENTS</th>
                <th class='w-10'>INTEREST AMOUNT</th>
                <th class='w-10'>PENALTY</th>
                <th class='w-10'>APPLICABLE TO PRINCIPAL</th>
                <th class='w-10'>BALANCE OUTSTANDING</th>
              </tr>
        </table>`);
    }

    function numberFormat(y, n = 2) {
        y = y * 1;
        x = y.toFixed(n);
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function editLoanNumberCell(el, client_index, loan_index) {
        var str = el.innerHTML;
        var replace_number = parseFloat(str.replaceAll(",", ""));
        var actual_number = replace_number ? replace_number : 0;
        el.innerHTML = numberFormat(actual_number);
    }
</script>
<style>
    .tbl_loans {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        overflow-y: scroll;
        height: 350px;
        color: #0a0a0a;
        display: block;
    }

    .tbl_loans td,
    th {
        border: 1px solid #dddddd;
        padding: 2px;
    }

    .tbl_loans th {
        text-align: center;
    }

    .import_failed {
        background-color: #db5151;
        color: #fff;
    }

    .w-10 {
        width: 10% !important;
    }

    .right {
        text-align: right !important;
    }

    .center {
        text-align: center !important;
    }

    .negative {
        background: red;
        color: #fff;
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