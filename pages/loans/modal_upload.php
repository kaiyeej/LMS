<form id='frm_upload' method="POST" enctype="multipart/form-data">
    <div class="modal fade" id="modalUpload" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" id="import_dialog" style="width: 100%;max-width: 2000px;margin: 0.5rem;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span class='ion-compose'></span> Statement of Account/Ledger</h5>
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
                                <input type="file" id="excel_file" name="excel_file" accept=".xlsx, .xls" class="form-control" required>
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
    var loan_from_excels = [],
        loan_types = [],
        clients_masterdata = [];
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
        $("#excel_file").val('');
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
                url: "controllers/sql.php?c=LoanUploads&q=upload",
                type: 'POST',
                data: formData,
                dataType: 'html',
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    try {
                        var json = JSON.parse(response);
                        if (json.data.status == 'success') {
                            get_loan_collections(json.data);
                            $("#upload_file").hide();
                            $("#upload_step").val(2);
                        } else {
                            $("#excel_file").val('');
                            $('#upload_result_content').html(`<div class="alert alert-danger" role="alert">Error occur while importing file. Please contact Juancoder IT Solutions.</div>`);
                        }
                    } catch (error) {
                        $("#excel_file").val('');
                        $('#upload_result_content').html(`<div class="alert alert-danger" role="alert">Error occur while importing file. Please contact Juancoder IT Solutions.</div>`);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert('An error occurred while processing the request.');
                }
            });
        } else {
            if ($(".unacceptable_data").length > 0) {
                swal("Cannot proceed!", "Please check invalid inputs.", "warning");
            } else {
                $('#upload_result_content').html(`<center><img src="assets/icons/loader.gif"></center>`);
                var data = {
                    loan_data: loan_from_excels
                };
                $.ajax({
                    type: 'POST',
                    url: "controllers/sql.php?c=LoanUploads&q=save_upload",
                    data: JSON.stringify(data),
                    contentType: 'application/json',
                    success: function(response) {
                        if (response.data > 0) {
                            success_upload();
                        } else {
                            failed_query();
                        }
                        console.log(response); // Process the response data here
                        $("#modalUpload").modal('hide');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Handle any errors here
                    }
                });
            }
        }
    });

    function get_loan_collections(json) {
        var clients = json.data.sheets;
        loan_from_excels = clients;
        loan_types = json.data.loan_types;
        clients_masterdata = json.data.clients;
        var client_tds = "";
        for (var clientIndex = 0; clientIndex < clients.length; clientIndex++) {
            const client = clients[clientIndex];
            var client_not_exists = client.client_id > 0 ? "" : "unacceptable_data";
            client_tds += `<tr class="${client_not_exists}" data-client-index="${clientIndex}" >
                <td>${clientIndex + 1}</td>
                <td contenteditable="true" onblur="editClientCell(this)" data-client-column="client_name" colspan="11">${client.client_name}</td>
              </tr>`;

            for (var loanIndex = 0; loanIndex < client.loans.length; loanIndex++) {
                const loan = client.loans[loanIndex];
                var loan_is_valid = isValidDate(loan.loan_date) ? "" : "unacceptable_data";
                var start_is_valid = isValidDate(loan.payment_date_start) ? "" : "unacceptable_data";

                client_tds += `<tr data-client-index="${clientIndex}" data-loan-index="${loanIndex}">
                <td colspan="2"></td>
                <td class='center'>
                    <button type="button" onclick="show_loan_collections(${clientIndex},${loanIndex})" class="btn btn-sm btn-primary" style="float:right"><span class="fa fa-list"></span></button>
                </td>
                <td onblur="editLoanCell(this,false)" data-loan-column="loan_type_name" contenteditable="true" class='${unacceptable_data(loan.loan_type_id)}'>${loan.loan_type_name}</td>
                <td onblur="editLoanCell(this,false)" data-loan-column="loan_date" contenteditable="true" class='${loan_is_valid}'>${loan.loan_date}</td>
                <td onblur="editLoanCell(this,false)" data-loan-column="payment_date_start" contenteditable="true" class='${start_is_valid}'>${loan.payment_date_start}</td>
                <td onblur="editLoanCell(this)" data-loan-column="loan_amount" contenteditable="true" class='right ${unacceptable_data(loan.loan_amount)}'>${numberFormatClearZero(loan.loan_amount)}</td>
                <td onblur="editLoanCell(this)" data-loan-column="loan_interest" contenteditable="true" class='right ${unacceptable_data(loan.loan_interest)}'>${numberFormatClearZero(loan.loan_interest)}</td>
                <td onblur="editLoanCell(this)" data-loan-column="penalty_percentage" contenteditable="true" class='right ${unacceptable_data(loan.penalty_percentage)}'>${numberFormatClearZero(loan.penalty_percentage)}</td>
                <td onblur="editLoanCell(this)" data-loan-column="loan_period" contenteditable="true" class='right ${unacceptable_data(loan.loan_period)}'>${numberFormatClearZero(loan.loan_period)}</td>
                <td onblur="editLoanCell(this)" data-loan-column="payment_terms" contenteditable="true" class='right ${unacceptable_data(loan.payment_terms)}'>${numberFormatClearZero(loan.payment_terms)}</td>
                <td onblur="editLoanCell(this)" data-loan-column="monthly_payment" contenteditable="true" class='right ${unacceptable_data(loan.monthly_payment)}'>${numberFormatClearZero(loan.monthly_payment)}</td>
                <td class='right'>${numberFormat(loan.balance)}</td>
              </tr>`;
            }
        }
        $('#upload_result_content').html(`<div style='width:100%' class='w3-animate-left table-container' id="loan_client">
            <table id="tbl_ledgers" class="tbl_loans">
            <thead>
              <tr>
                <th>#</th>
                <th colspan="2">Client</th>
                <th>Loan Type</th>
                <th class='w-8'>Loan Date</th>
                <th class='w-8'>Payment Start</th>
                <th class='w-8'>Loan Amount</th>
                <th class='w-8'>Interest</th>
                <th class='w-8'>Penalty Interest</th>
                <th class='w-8'>Loan Terms</th>
                <th class='w-8'>Payment Terms</th>
                <th class='w-8'>Monthly Payment</th>
                <th class='w-8'>Outstanding Balance</th>
              </tr>
              </thead>
              ${client_tds}
        </table>
        </div>
        <div style='width:100%;display:none;' class='w3-animate-left table-container' id="loan_collections">
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
                <td class='w-8' contenteditable="true" data-collection-column="payment_month" onblur="editCollectionCell(this,false)">${collection.payment_month}</td>
                <td class='w-8 right' contenteditable="true" data-collection-column="payment_amount" onblur="editCollectionCell(this)">${numberFormat(collection.payment_amount)}</td>
                <td class='w-8 right' contenteditable="true" data-collection-column="interest" onblur="editCollectionCell(this)">${numberFormat(collection.interest)}</td>
                <td class='w-8 right' contenteditable="true" data-collection-column="penalty" onblur="editCollectionCell(this)">${numberFormat(collection.penalty)}</td>
                <td class='w-8 right' contenteditable="true" data-collection-column="principal" onblur="editCollectionCell(this)">${numberFormat(collection.principal)}</td>
                <td class='w-5'></td>
                <td class='w-8 right' contenteditable="true">${numberFormat(collection.balance)}</td>
                <td class='w-8'>${collection.status}</td>
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
            <thead>
              <tr>
                <th colspan="10">${loan_data.loan_type_name}</th>
              </tr>
              <tr>
                <th class='w-2'></th>
                <th class='w-8'>Payment Date</th>
                <th class='w-8'>Payment</th>
                <th class='w-8'>Interest Amount</th>
                <th class='w-8'>Penalty</th>
                <th class='w-8'>Applicable to Principal</th>
                <th class='w-5'></th>
                <th colspan="2">Outstanding Balance</th>
                <th class='w-2'></th>
              </tr>
              </thead>
              <tr>
                <td></td>
                <td class="bold italic">Monthly Payment</td>
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

    function unacceptable_data(amount) {
        amount = amount * 1;
        if (amount <= 0)
            return 'unacceptable_data';
        return '';
    }

    function editLoanCell(el, is_number = true) {
        var str = el.innerHTML;
        if (is_number) {
            var replace_number = parseFloat(str.replaceAll(",", ""));
            var actual_data = replace_number ? replace_number : 0;
            el.innerHTML = numberFormat(actual_data);
            if (actual_data > 0) {
                el.classList.remove('unacceptable_data');
            } else {
                el.classList.add('unacceptable_data');
            }
        } else {
            el.innerHTML = str.toUpperCase();
            var actual_data = str;
            loanTypeChecker(el);
            loanDateChecker(el);
            loanStartDateChecker(el);
        }

        var loan_column = el.getAttribute("data-loan-column");
        var client_index = el.parentNode.getAttribute("data-client-index");
        var loan_index = el.parentNode.getAttribute("data-loan-index");

        loan_from_excels[client_index].loans[loan_index][loan_column] = actual_data;
    }

    function editClientCell(el) {
        var new_client_name = el.innerText.toUpperCase().trim(' ');
        el.innerHTML = new_client_name;

        var client_id = 0,
            branch_id = 0;
        for (var i = 0; i < clients_masterdata.length; i++) {
            if (clients_masterdata[i].fullname == new_client_name) {
                client_id = clients_masterdata[i].client_id * 1;
                branch_id = clients_masterdata[i].branch_id * 1;
                break;
            }
        }

        var client_column = el.getAttribute("data-client-column");
        var client_index = el.parentNode.getAttribute("data-client-index");

        loan_from_excels[client_index][client_column] = new_client_name;
        loan_from_excels[client_index].client_id = client_id;
        loan_from_excels[client_index].branch_id = branch_id;

        if (client_id > 0) {
            el.parentNode.classList.remove('unacceptable_data');
        } else {
            el.parentNode.classList.add('unacceptable_data');
        }
    }

    function loanTypeChecker(el) {
        var loan_column = el.getAttribute("data-loan-column");
        if (loan_column != 'loan_type_name')
            return;

        var new_loan_type_name = el.innerHTML.toUpperCase();
        var loan_type_id = 0;
        for (var i = 0; i < loan_types.length; i++) {
            if (loan_types[i].loan_type == new_loan_type_name) {
                loan_type_id = loan_types[i].loan_type_id;
                break;
            }
        }

        var client_index = el.parentNode.getAttribute("data-client-index");
        var loan_index = el.parentNode.getAttribute("data-loan-index");

        loan_from_excels[client_index].loans[loan_index].loan_type_id = loan_type_id;

        if (loan_type_id > 0) {
            el.classList.remove('unacceptable_data');
        } else {
            el.classList.add('unacceptable_data');
        }
    }

    function loanDateChecker(el) {
        var loan_column = el.getAttribute("data-loan-column");
        if (loan_column != 'loan_date')
            return;

        var new_loan_date = el.innerHTML;

        var client_index = el.parentNode.getAttribute("data-client-index");
        var loan_index = el.parentNode.getAttribute("data-loan-index");

        loan_from_excels[client_index].loans[loan_index].loan_date = new_loan_date;

        if (isValidDate(new_loan_date)) {
            el.classList.remove('unacceptable_data');
        } else {
            el.classList.add('unacceptable_data');
        }
    }

    function loanStartDateChecker(el) {
        var loan_column = el.getAttribute("data-loan-column");
        if (loan_column != 'payment_date_start')
            return;

        var new_loan_date = el.innerHTML;

        var client_index = el.parentNode.getAttribute("data-client-index");
        var loan_index = el.parentNode.getAttribute("data-loan-index");

        loan_from_excels[client_index].loans[loan_index].payment_date_start = new_loan_date;

        if (isValidDate(new_loan_date)) {
            el.classList.remove('unacceptable_data');
        } else {
            el.classList.add('unacceptable_data');
        }
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

    function isValidDate(dateString) {
        // Use a regular expression to validate the "m/d/Y" format
        const dateRegex = /^\d{1,2}\/\d{1,2}\/\d{4}$/;

        if (!dateRegex.test(dateString)) {
            // If the input doesn't match the "m/d/Y" format, return false
            return false;
        }

        // Extract month, day, and year from the date string
        const [month, day, year] = dateString.split('/').map(Number);

        // Check if the month, day, and year are within valid ranges
        if (month < 1 || month > 12 || day < 1 || day > 31 || year < 1000 || year > 9999) {
            return false;
        }

        // Additional validation for months with 30 and 31 days
        const thirtyDaysMonths = [4, 6, 9, 11];
        if (thirtyDaysMonths.includes(month) && day > 30) {
            return false;
        }

        if (month === 2) {
            // Additional validation for February
            const isLeapYear = (year % 4 === 0 && year % 100 !== 0) || (year % 400 === 0);
            if (isLeapYear && day > 29) {
                return false;
            }
            if (!isLeapYear && day > 28) {
                return false;
            }
        }

        return true;
    }
</script>
<style>
    .tbl_loans {
        font-family: arial, sans-serif;
        font-size: 11pt;
        border-collapse: collapse;
        width: 100%;
        color: #0a0a0a;
    }

    .table-container {
        /* Set a max height to make the table scrollable */
        max-height: 400px;
        overflow-y: auto;
    }

    .table-container thead {
        position: sticky;
        top: 0;
        background-color: #f2f2f2;
        /* Set the background color for the sticky header */
        font-weight: bold;
        /* Optionally, you can style the sticky header */
    }

    /*    .tbl_loans {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        overflow-y: scroll;
        height: 350px;
        color: #0a0a0a;
        display: block;
    }*/

    .tbl_loans td,
    th {
        border: 1px solid #dddddd;
        padding: 2px;
    }

    .tbl_loans th {
        text-align: center;
    }

    .tbl_loans td {
        font-size: 12pt !important;
    }

    .import_failed {
        background-color: #db5151;
        color: #fff;
    }

    .w-8 {
        width: 8% !important;
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

    .unacceptable_data {
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