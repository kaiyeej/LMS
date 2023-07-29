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
                    <input type="hidden" value="1" id="upload_step">
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
                    <button type="button" class="btn btn-primary" id="btn_back" onclick="backToLoan()"><span class="fa fa-arrow-left"></span> Back</button>
                    <button type="submit" id="btn_upload" class="btn btn-primary">
                        Submit
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

    function backToLoan() {
        $("#loan_client").show();
        $("#loan_collections").hide();

        $("#btn_back").hide();
        $("#btn_upload").show();
    }

    function uploadFile() {
        $("#upload_step").val(1);
        $('#upload_result_content').html("");
        $("#upload_file").show();
        $("#btn_upload").show();
        $("#btn_back").hide();
        $("#modalUpload").modal('show');
    }
    $('#frm_upload').submit(function(e) {
        e.preventDefault(); // Prevent form submission

        if ($("#upload_step").val() == 1) {
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
                    $("#upload_step").val(2);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert('An error occurred while processing the request.');
                }
            });
        } else {
            $('#upload_result_content').html(`<center><img src="assets/icons/loader.gif"></center>`);
            var data = {
                loan_data: loan_from_excels
            };
            $.ajax({
                type: 'POST',
                url: "controllers/sql.php?c=" + route_settings.class_name + "&q=save_upload",
                data: JSON.stringify(data),
                contentType: 'application/json',
                success: function(response) {
                    console.log(response); // Process the response data here
                    $("#modalUpload").modal('hide');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Handle any errors here
                }
            });

        }
    });

    function get_loan_collections(json) {
        var clients = json.data.sheets;
        loan_from_excels = clients;
        var client_tds = "";
        for (var clientIndex = 0; clientIndex < clients.length; clientIndex++) {
            const client = clients[clientIndex];
            var client_not_exists = client.client_id > 0 ? "" : "negative";
            client_tds += `<tr class="${client_not_exists}" data-client-index="${clientIndex}" >
                <td>${clientIndex + 1}</td>
                <td contenteditable="true" onblur="editClientCell(this,false)" data-client-column="client_name">${client.client_name}</td>
                <td colspan="7"></td>
              </tr>`;

            for (var loanIndex = 0; loanIndex < client.loans.length; loanIndex++) {
                const loan = client.loans[loanIndex];

                client_tds += `<tr data-client-index="${clientIndex}" data-loan-index="${loanIndex}">
                <td colspan="2"></td>
                <td>${loan.loan_type_name}
                    <button type="button" onclick="show_loan_collections(${clientIndex},${loanIndex})" class="btn btn-sm btn-primary" style="float:right"><span class="fa fa-list"></span></button>
                </td>
                <td onblur="editLoanCell(this,false)" data-loan-column="loan_date" contenteditable="true">${loan.loan_date}</td>
                <td onblur="editLoanCell(this)" data-loan-column="loan_amount" contenteditable="true" class='right'>${numberFormat(loan.loan_amount)}</td>
                <td onblur="editLoanCell(this)" data-loan-column="loan_interest" contenteditable="true" class='right'>${numberFormat(loan.loan_interest)}</td>
                <td onblur="editLoanCell(this)" data-loan-column="penalty_percentage" contenteditable="true" class='right'>${numberFormat(loan.penalty_percentage)}</td>
                <td onblur="editLoanCell(this)" data-loan-column="loan_period" contenteditable="true" class='right'>${numberFormat(loan.loan_period)}</td>
                <td onblur="editLoanCell(this)" data-loan-column="payment_terms" contenteditable="true" class='right'>${numberFormat(loan.payment_terms)}</td>
                <td onblur="editLoanCell(this)" data-loan-column="monthly_payment" contenteditable="true" class='right'>${numberFormat(loan.monthly_payment)}</td>
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
                <th class='w-10'>PENALTY INTEREST</th>
                <th class='w-10'>LOAN TERMS</th>
                <th class='w-10'>PAYMENT TERMS</th>
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

        $("#btn_back").show();
        $("#btn_upload").hide();

        var loan_data = loan_from_excels[client_index].loans[loan_index];
        var collections = loan_data.collections;
        var skin_collections = "",
            total_payments = 0,
            total_interest = 0;
        for (var collectionIndex = 0; collectionIndex < collections.length; collectionIndex++) {
            const collection = collections[collectionIndex];
            total_payments += collection.payment_amount;
            total_interest += collection.interest;
            skin_collections += `<tr data-client-index="${client_index}" data-loan-index="${loan_index}" data-collection-index="${collectionIndex}">
                <td class='w-2'></td>
                <td class='w-10' contenteditable="true" data-collection-column="payment_month" onblur="editCollectionCell(this,false)">${collection.payment_month}</td>
                <td class='w-10 right' contenteditable="true" data-collection-column="payment_amount" onblur="editCollectionCell(this)">${numberFormat(collection.payment_amount)}</td>
                <td class='w-10 right' contenteditable="true" data-collection-column="interest" onblur="editCollectionCell(this)">${numberFormat(collection.interest)}</td>
                <td class='w-10 right' contenteditable="true" data-collection-column="penalty" onblur="editCollectionCell(this)">${numberFormat(collection.penalty)}</td>
                <td class='w-10 right' contenteditable="true" data-collection-column="principal" onblur="editCollectionCell(this)">${numberFormat(collection.principal)}</td>
                <td class='w-5'></td>
                <td class='w-10 right' contenteditable="true">${numberFormat(collection.balance)}</td>
                <td class='w-10'>${collection.status}</td>
                <td class='w-2'></td>
            </tr>`;
        }

        $("#loan_client").hide();
        $("#loan_collections").show();
        $('#loan_collections').html(`
            <center>
                <h2>${loan_from_excels[client_index].client_name}</h2>
            </center>
            <table class="tbl_loans">
              <tr>
                <th colspan="10">${loan_data.loan_type_name}</th>
              </tr>
              <tr>
                <th class='w-2'></th>
                <th class='w-10'>PAYMENT DATE</th>
                <th class='w-10'>PAYMENTS</th>
                <th class='w-10'>INTEREST AMOUNT</th>
                <th class='w-10'>PENALTY</th>
                <th class='w-10'>APPLICABLE TO PRINCIPAL</th>
                <th class='w-5'></th>
                <th colspan="2">BALANCE OUTSTANDING</th>
                <th class='w-2'></th>
              </tr>
              <tr>
                <td></td>
                <td class="bold italic">MONTHLY PAYMENT</td>
                <td class="right">${numberFormat(loan_data.monthly_payment)}</td>
                <td colspan="7"></td>
              </tr>
              <tr>
                <td></td>
                <td class="bold italic"></td>
                <td class="right">&nbsp;</td>
                <td colspan="7"></td>
              </tr>
              <tr>
                <td colspan="7"></td>
                <td class="right">${numberFormat(loan_data.loan_amount)}</td>
                <td></td>
              </tr>
              ${skin_collections}
              <tr>
                <td colspan="10">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="2"></td>
                <td class="right">${numberFormat(total_payments)}</td>
                <td class="right">${numberFormat(total_interest)}</td>
                <td colspan="7"></td>
              </tr>
        </table>`);
    }

    function numberFormat(y, n = 2) {
        y = y * 1;
        x = y.toFixed(n);
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function editClientCell(el, is_number = true) {
        var str = el.innerHTML;
        if (is_number) {
            var replace_number = parseFloat(str.replaceAll(",", ""));
            var actual_data = replace_number ? replace_number : 0;
            el.innerHTML = numberFormat(actual_data);
        } else {
            el.innerHTML = str;
            var actual_data = str;
        }

        var client_column = el.getAttribute("data-client-column");
        var client_index = el.parentNode.getAttribute("data-client-index");

        loan_from_excels[client_index][client_column] = actual_data;
    }

    function editLoanCell(el, is_number = true) {
        var str = el.innerHTML;
        if (is_number) {
            var replace_number = parseFloat(str.replaceAll(",", ""));
            var actual_data = replace_number ? replace_number : 0;
            el.innerHTML = numberFormat(actual_data);
        } else {
            el.innerHTML = str;
            var actual_data = str;
        }

        var loan_column = el.getAttribute("data-loan-column");
        var client_index = el.parentNode.getAttribute("data-client-index");
        var loan_index = el.parentNode.getAttribute("data-loan-index");

        loan_from_excels[client_index].loans[loan_index][loan_column] = actual_data;
    }

    function editCollectionCell(el, is_number = true) {
        var str = el.innerHTML;
        if (is_number) {
            var replace_number = parseFloat(str.replaceAll(",", ""));
            var actual_data = replace_number ? replace_number : 0;
            el.innerHTML = numberFormat(actual_data);
        } else {
            el.innerHTML = str;
            var actual_data = str;
        }

        var collection_column = el.getAttribute("data-collection-column");
        var client_index = el.parentNode.getAttribute("data-client-index");
        var loan_index = el.parentNode.getAttribute("data-loan-index");
        var collection_index = el.parentNode.getAttribute("data-collection-index");

        loan_from_excels[client_index].loans[loan_index].collections[collection_index][collection_column] = actual_data;
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

    .w-5 {
        width: 5% !important;
    }

    .w-2 {
        width: 2% !important;
    }

    .right {
        text-align: right !important;
    }

    .center {
        text-align: center !important;
    }

    .bold {
        font-weight: bold;
    }

    .italic {
        font-style: italic;
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