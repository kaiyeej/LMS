<form id='frmMassCollection' method="POST">
    <div class="modal fade" id="modalMassCollection" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" id="import_dialog" style="width: 100%;max-width: 2000px;margin: 0.5rem;">
            <div class="modal-content">
                <div class="modal-header" id="mass-modal-header">
                    <h5 class="modal-title"><span class='ion-compose'></span> Add Mass Collection</h5>
                </div>
                <div class="modal-body">
                    <div class="form-row w3-animate-left">
                        <div class="form-group col-md-2">
                            <label><strong style="color:red;">*</strong> Branch</label>
                            <select class="form-control select2 input-item" id="mass_branch_id" name="input[branch_id]" style="width:100%;" required>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label><strong style="color:red;">*</strong> Loan Type</label>
                            <select class="form-control select2 input-item" id="loan_type_id" name="input[loan_type_id]" style="width:100%;" required>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label><strong style="color:red;">*</strong> Bank</label>
                            <select class="form-control select2 input-item" id="mass_chart_id" name="input[chart_id]" style="width:100%;" required>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label><strong style="color:red;">*</strong> Collection Date</label>
                            <input type="date" class="form-control input-item" autocomplete="off" name="input[collection_date]" id="collection_date" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label><strong style="color:red;">*</strong> Employer</label>
                            <select class="form-control select2 input-item" id="employer_id" name="input[employer_id]" style="width:100%;" required>
                            </select>
                        </div>
                        <div class="form-group col-md-1">
                            <label>ATM Charge</label>
                            <input min="0" type="number" class="form-control input-item" autocomplete="off" name="input[atm_charge]" id="atm_charge">
                        </div>
                        <div class="form-group col-md-1">
                            <br />
                            <button type="submit" id="btn_mass_generate" style="margin-top:10px;" class="btn btn-primary">
                                Generate
                            </button>
                        </div>
                    </div>
                    <div class="row" id="mass_collection_result_content">
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- <button type="button" id="btn_mass_prev" class="btn btn-warning" onclick="goStep1()"><span class='fa fa-arrow-left'></span> Back</button> -->
                    <button type="button" id="btn_mass_submit" onclick="saveMassCollection()" class="btn btn-primary">
                        Save
                    </button>
                    <button type="submit" id="btn_mass_finish" class="btn btn-success">
                        Finish
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    var mc_client_data = [],
        mc_header_data = [];
    document.addEventListener("keydown", function(event) {
        if (event.key === "Enter") {
            var activeElement = document.activeElement;
            var nextElement = activeElement.nextElementSibling;

            if (nextElement) {
                focusAndSelectText(nextElement);
                event.preventDefault();
            }

            var last_row_element = activeElement.getAttribute("data-column");
            if (last_row_element == 'atm_charge') {
                var parentRow = activeElement.parentNode;
                var nextRow = parentRow.nextElementSibling;
                if (nextRow) {
                    var next_row_column = nextRow.querySelector("td[data-column='receipt_number']");
                    if (next_row_column) {
                        focusAndSelectText(next_row_column);
                        event.preventDefault();
                    } else {
                        focusFirstReceiptNumber();
                    }
                }
            }
        }
    });

    function focusAndSelectText(myElement) {
        // Set the focus on the element
        myElement.focus();

        // Select the text content of the element
        if (document.body.createTextRange) { // For Internet Explorer
            const range = document.body.createTextRange();
            range.moveToElementText(myElement);
            range.select();
        } else if (window.getSelection) { // For modern browsers
            const selection = window.getSelection();
            const range = document.createRange();
            range.selectNodeContents(myElement);
            selection.removeAllRanges();
            selection.addRange(range);
        }
    }

    function focusFirstReceiptNumber() {
        const data_column = document.querySelectorAll(`[data-column='receipt_number']`);
        if (data_column.length > 0)
            focusAndSelectText(data_column[0]);
    }

    function addMassCollection() {

        resetMassCollection();

        $("#mass-modal-header").html(`<h5 class="modal-title"><span class='ion-compose'></span> Add Mass Collection</h5>`);

        $('#modalMassCollection').modal({
            backdrop: 'static',
            keyboard: false
        }, 'show');
    }

    $('#frmMassCollection').submit(function(e) {
        e.preventDefault(); // Prevent form submission

        var formData = $(this).serialize();

        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=MassCollections&q=initialize",
            data: formData,
            success: function(data) {
                var jsonParse = JSON.parse(data);
                const json = jsonParse.data;
                mc_header_data = json.headers;
                get_mass_collections(json);
                // $("#mass_collection_step").val(2);
                // // $("#btn_mass_submit").html("<span class='fa fa-check-circle'></span> Save");
                // $("#btn_mass_submit").show();
                // // $("#mass_collection_step_1").hide();
                // // $("#btn_mass_prev").show();
            }
        });
    });


    function saveMassCollection() {
        if (mc_client_data.length > 0) {
            if ($(".negative").length > 0) {
                swal("Cannot proceed!", "Negative values are found!", "warning");
            } else {
                var form_mass_collection = mc_header_data;
                form_mass_collection.details = mc_client_data;
                $.ajax({
                    type: "POST",
                    url: "controllers/sql.php?c=MassCollections&q=save_collections",
                    data: {
                        input: form_mass_collection
                    },
                    success: function(data) {
                        var jsonParse = JSON.parse(data);
                        const json = jsonParse.data;

                        $('#modalMassCollection').modal('hide');
                        getEntries();
                        success_add();
                    }
                });
            }
        } else {
            swal("Cannot proceed!", "No Entry found!", "warning");
        }
    }

    function resetMassCollection() {
        getSelectOption('LoanTypes', 'loan_type_id', 'loan_type', "", ['loan_type_interest']);
        getSelectOption('Employers', 'employer_id', 'employer_name');
        $("#mass_chart_id").html($("#chart_id").html());
        $("#mass_branch_id").html($("#branch_id").html());

        $('#mass_collection_result_content').html(`<div style='width:100%' class='w3-animate-left'>
            <table id="tbl_mass_collection">
              <tr>
                <th>#</th>
                <th>Name</th>
                <th class='w-8'>Receipt #</th>
                <th class='w-8'>ATM Balance Before Withdrawal</th>
                <th class='w-8'>ATM Withdrawal</th>
                <th class='w-8'>Deduction</th>
                <th class='w-8'>Emergency Loan</th>
                <th class='w-8'>ATM Charge</th>
                <th class='w-8'>ATM Balance</th>
                <th class='w-8'>Excess</th>
                <th>Account Number</th>
                <th>Status</th>
              </tr>
              <tr>
                <th colspan="3" class="end">TOTAL:</th>
                <th id="mc_total_2" class="right"></th>
                <th id="mc_total_3" class="right"></th>
                <th id="mc_total_4" class="right"></th>
                <th id="mc_total_5" class="right"></th>
                <th id="mc_total_6" class="right"></th>
                <th id="mc_total_7" class="right"></th>
                <th id="mc_total_8" class="right"></th>
                <th></th>
                <th></th>
              </tr>
        </table>`);
    }

    function get_mass_collections(json) {
        var client_tds = "";
        mc_client_data = [];

        var total_atm_balance_before_withdraw = 0,
            total_atm_withdrawal = 0,
            total_deduction = 0,
            total_emergency_loan = 0,
            total_atm_charge = 0,
            total_atm_balance = 0,
            total_excess = 0;
        for (var clientIndex = 0; clientIndex < json.clients.length; clientIndex++) {
            const client = json.clients[clientIndex];

            var receipt_number = client.receipt_number;
            var atm_balance_before_withdraw = 0;
            var atm_withdrawal = 0;
            var deduction = client.monthly_payment * 1;
            var emergency_loan = 0;
            var atm_charge = client.atm_charge * 1;
            var atm_balance = 0;
            var excess = atm_withdrawal - deduction - emergency_loan - atm_charge;
            var atm_account_no = client.atm_account_no;
            var nega_excess = excess < 0 ? "negative" : "";

            var client_data = {
                client_id: client.client_id * 1,
                loan_id: client.loan_id * 1,
                atm_balance_before_withdraw: atm_balance_before_withdraw,
                atm_withdrawal: atm_withdrawal,
                deduction: deduction,
                emergency_loan: emergency_loan,
                atm_charge: atm_charge,
                atm_balance: 0,
                excess: excess,
                receipt_number: receipt_number,
                atm_account_no: atm_account_no
            };

            total_atm_balance_before_withdraw += atm_balance_before_withdraw;
            total_atm_withdrawal += atm_withdrawal;
            total_deduction += deduction;
            total_emergency_loan += emergency_loan;
            total_atm_charge += atm_charge;
            total_atm_balance += atm_balance;
            total_excess += excess;

            mc_client_data.push(client_data);
            client_tds += `<tr data-client-index='${clientIndex}'>
                <td>${clientIndex + 1}</td>
                <td>${client.client_name}</td>
                <td data-column='receipt_number' onblur="editCollectionCell(this,false)" contenteditable="true" class='right'>${receipt_number}</td>
                <td data-column='atm_balance_before_withdraw' onblur="editCollectionCell(this)" contenteditable="true" class='right'>${numberFormatClearZero(atm_balance_before_withdraw)}</td>
                <td data-column='atm_withdrawal' onblur="editCollectionCell(this)" contenteditable="true" class='right'>${numberFormatClearZero(atm_withdrawal)}</td>
                <td data-column='deduction' onblur="editCollectionCell(this)" contenteditable="true" class='right'>${numberFormatClearZero(deduction)}</td>
                <td data-column='emergency_loan' onblur="editCollectionCell(this)" contenteditable="true" class='right'>${numberFormatClearZero(emergency_loan)}</td>
                <td data-column='atm_charge' onblur="editCollectionCell(this)" contenteditable="true" class='right'>${numberFormatClearZero(atm_charge)}</td>
                <td data-column='atm_balance' class='right'>${numberFormatClearZero(atm_balance)}</td>
                <td data-column='excess' class='right ${nega_excess}'>${numberFormatClearZero(excess)}</td>
                <td data-column='atm_account_no' class='center'>${atm_account_no}</td>
                <td data-column='status_display' class='center'>${client.status_display}</td>
              </tr>`;
        }
        $('#mass_collection_result_content').html(`<div style='width:100%' class='w3-animate-left'>
            <table id="tbl_mass_collection">
              <tr>
                <th>#</th>
                <th>Name</th>
                <th class='w-8'>Receipt #</th>
                <th class='w-8'>ATM Balance Before Withdrawal</th>
                <th class='w-8'>ATM Withdrawal</th>
                <th class='w-8'>Deduction</th>
                <th class='w-8'>Emergency Loan</th>
                <th class='w-8'>ATM Charge</th>
                <th class='w-8'>ATM Balance</th>
                <th class='w-8'>Excess</th>
                <th>Account Number</th>
                <th>Status</th>
              </tr>
              ${client_tds}
              <tr>
                <th colspan="3" class="end">TOTAL:</th>
                <th data-column='total_atm_balance_before_withdraw' class="right">${numberFormat(total_atm_balance_before_withdraw)}</th>
                <th data-column='total_atm_withdrawal' class="right">${numberFormat(total_atm_withdrawal)}</th>
                <th data-column='total_deduction' class="right">${numberFormat(total_deduction)}</th>
                <th data-column='total_emergency_loan' class="right">${numberFormat(total_emergency_loan)}</th>
                <th data-column='total_atm_charge' class="right">${numberFormat(total_atm_charge)}</th>
                <th data-column='total_atm_balance' class="right">${numberFormat(total_atm_balance)}</th>
                <th data-column='total_excess' class="right">${numberFormat(total_excess)}</th>
                <th></th>
                <th></th>
              </tr>
        </table>
        <div class='col-md-12 row' style="color:#0a0a0a;">
            <div class='col-md-6'>
                <span>PREPARED BY: </span><br>
                <span><b>${json.headers.prepared_by}</b></span>
            </div>
            <div class='col-md-6'>
                <span>CHECKED BY: </span><br>
                <span><b>${json.headers.prepared_by}</b></span>
            </div>
        </div>
        </div>`);
        focusFirstReceiptNumber();
    }

    function editCollectionCell(el, is_number = true) {
        var str = el.innerHTML;
        if (is_number) {
            var replace_number = parseFloat(str.replaceAll(",", ""));
            var actual_data = replace_number ? replace_number : 0;
            el.innerHTML = numberFormatClearZero(actual_data);
        } else {
            el.innerHTML = str;
            var actual_data = str;
        }

        var column = el.getAttribute("data-column");
        var client_index = el.parentNode.getAttribute("data-client-index");

        mc_client_data[client_index][column] = actual_data;

        if (is_number) {
            totalSolvers(column);
            collectionSolvers(el, client_index);
        }
    }

    function totalSolvers(column) {
        // Get all elements with the attribute data-column='excess'
        const data_column = document.querySelectorAll(`[data-column='${column}']`);

        // Loop through the NodeList and perform actions on each element
        var total_value = 0;
        for (let i = 0; i < data_column.length; i++) {
            const element = data_column[i];

            var str = element.innerHTML;
            var replace_number = parseFloat(str.replaceAll(",", ""));
            var actual_data = replace_number ? replace_number : 0;

            total_value += actual_data;
        }
        const total_data_column = document.querySelector(`[data-column='total_${column}']`);
        total_data_column.innerHTML = numberFormatClearZero(total_value);
    }

    function collectionSolvers(el, client_index) {
        var atm_balance_before_withdraw = mc_client_data[client_index].atm_balance_before_withdraw * 1;
        var atm_withdrawal = mc_client_data[client_index].atm_withdrawal * 1;
        var deduction = mc_client_data[client_index].deduction * 1;
        var emergency_loan = mc_client_data[client_index].emergency_loan * 1;
        var atm_charge = mc_client_data[client_index].atm_charge * 1;

        var atm_balance = atm_balance_before_withdraw - atm_withdrawal;
        var excess = atm_withdrawal - deduction - emergency_loan - atm_charge;

        // Find the sibling td elements with data-column='excess' within the same row
        const excess_column = el.parentNode.querySelector("td[data-column='excess']");
        excess_column.innerHTML = numberFormat(excess);
        negativeIdentifier(excess_column, excess);
        totalSolvers('excess');

        const atm_balance_column = el.parentNode.querySelector("td[data-column='atm_balance']");
        atm_balance_column.innerHTML = numberFormat(atm_balance);
        negativeIdentifier(atm_balance_column, atm_balance);
        totalSolvers('atm_balance');
    }

    function negativeIdentifier(el, value) {
        if (value > 0) {
            el.classList.remove('negative');
        } else {
            el.classList.add('negative');
        }
    }

    function numberFormatClearZero(y, n = 2) {
        y = y * 1;
        if (y == 0)
            return '';
        x = y.toFixed(n);
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function numberFormat(y, n = 2) {
        y = y * 1;
        x = y.toFixed(n);
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
</script>
<style>
    #tbl_mass_collection {
        font-family: arial, sans-serif;
        font-size: 12px;
        border-collapse: collapse;
        width: 100%;
        overflow-y: scroll;
        height: 350px;
        color: #0a0a0a;
        display: block;
    }

    #tbl_mass_collection td,
    th {
        border: 1px solid #dddddd;
        padding: 2px;
    }

    #tbl_mass_collection th {
        text-align: center;
    }

    #tbl_mass_collection td {
        font-size: 12pt !important;
    }

    .import_failed {
        background-color: #db5151;
        color: #fff;
    }

    .w-10 {
        width: 10% !important;
    }

    .w-8 {
        width: 8% !important;
    }

    .w-5 {
        width: 5% !important;
    }

    .right {
        text-align: right !important;
    }

    .center {
        text-align: center !important;
    }

    .end {
        text-align: end !important;
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