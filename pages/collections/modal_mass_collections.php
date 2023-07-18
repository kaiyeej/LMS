<form id='frmMassCollection' method="POST">
    <div class="modal fade" id="modalMassCollection" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" id="import_dialog" style="width: 100%;max-width: 2000px;margin: 0.5rem;">
            <div class="modal-content">
                <div class="modal-header" id="mass-modal-header">
                    <h5 class="modal-title"><span class='ion-compose'></span> Add Mass Collection</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="1" id="mass_collection_step">
                    <div class="form-row w3-animate-left" id="mass_collection_step_1">
                        <div class="form-group col-md-2">
                            <label><strong style="color:red;">*</strong>Branch</label>
                            <select class="form-control select2 input-item" id="mass_branch_id" name="input[branch_id]" style="width:100%;" required>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label><strong style="color:red;">*</strong>Loan Type</label>
                            <select class="form-control select2 input-item" id="loan_type_id" name="input[loan_type_id]" style="width:100%;" required>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label><strong style="color:red;">*</strong>Bank</label>
                            <select class="form-control select2 input-item" id="mass_chart_id" name="input[chart_id]" style="width:100%;" required>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label><strong style="color:red;">*</strong>Collection Date</label>
                            <input type="date" class="form-control input-item" autocomplete="off" name="input[collection_date]" id="collection_date" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label><strong style="color:red;">*</strong>Employer</label>
                            <select class="form-control select2 input-item" id="employer_id" name="input[employer_id]" style="width:100%;" required>
                            </select>
                        </div>
                        <div class="form-group col-md-1">
                            <label>ATM Charge</label>
                            <input min="0" type="number" class="form-control input-item" autocomplete="off" name="input[atm_charge]" id="atm_charge">
                        </div>
                        <div class="form-group col-md-1">
                            <br />
                            <button type="button" id="btn_mass_generate" onclick="mass_generate()" style="margin-top:10px;" class="btn btn-primary">
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
                    <button type="submit" id="btn_mass_submit" class="btn btn-primary">
                        Save
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
                nextElement.focus();
                event.preventDefault();
            }
        }
    });

    function addMassCollection() {
        getSelectOption('LoanTypes', 'loan_type_id', 'loan_type', "", ['loan_type_interest']);
        getSelectOption('Employers', 'employer_id', 'employer_name');
        $("#mass_chart_id").html($("#chart_id").html());
        $("#mass_branch_id").html($("#branch_id").html());

        $("#mass-modal-header").html(`<h5 class="modal-title"><span class='ion-compose'></span> Add Mass Collection</h5>`);
        $("#mass_collection_step_1").show();
        $("#mass_collection_step").val(1);
        $("#loan_type_id").val("").select2().trigger('change');
        document.getElementById("collection_date").value = "";
        $("#company_code").val('');
        $("#atm_charge").val('');
        // $("#btn_mass_submit").html("<span class='fa fa-arrow-right'></span> Next");
        $("#btn_mass_submit").hide();

        $('#mass_collection_result_content').html("");
        // $("#btn_mass_prev").hide();

        // get_mass_collections();
        // $("#modalMassCollection").modal('show');
        $('#modalMassCollection').modal({
            backdrop: 'static',
            keyboard: false
        }, 'show');
    }

    function goStep1() {
        $("#mass-modal-header").html(`<h5 class="modal-title"><span class='ion-compose'></span> Add Mass Collection</h5>`);
        $("#mass_collection_step_1").show();
        $("#mass_collection_step").val(1);
        $("#btn_mass_submit").html("<span class='fa fa-arrow-right'></span> Next");
        $('#mass_collection_result_content').html("");
        // $("#btn_mass_prev").hide();
    }

    function mass_generate() {

        // document.querySelector("#frmMassCollection").submit();
        var branch_id = $("#mass_branch_id").val();
        var loan_type_id = $("#loan_type_id").val();
        var mass_chart_id = $("#mass_chart_id").val();
        var collection_date = $("#collection_date").val();
        var employer_id = $("#employer_id").val();
        $('#frmMassCollection input:required').each(function() {
            if($(this).val() === ''){

                swal("Ops!", "Fill out all required fields.", "warning");
            } else {
                $.ajax({
                    type: "POST",
                    url: "controllers/sql.php?c=" + route_settings.class_name + "&q=init_mass_collection",
                    data: $('#frmMassCollection').serialize(),
                    success: function(data) {
                        var jsonParse = JSON.parse(data);
                        const json = jsonParse.data;
                        mc_header_data = json.headers;
                        get_mass_collections(json);
                        $("#mass_collection_step").val(2);
                        // $("#btn_mass_submit").html("<span class='fa fa-check-circle'></span> Save");
                        $("#btn_mass_submit").show();
                        // $("#mass_collection_step_1").hide();
                        // $("#btn_mass_prev").show();
                    }
                });
            }
        });


    }

    $('#frmMassCollection').submit(function(e) {
        e.preventDefault(); // Prevent form submission

        var formData = $(this).serialize();
        var mass_collection_step = $("#mass_collection_step").val() * 1;
        if (mass_collection_step == 1) {
            $.ajax({
                type: "POST",
                url: "controllers/sql.php?c=" + route_settings.class_name + "&q=init_mass_collection",
                data: formData,
                success: function(data) {
                    var jsonParse = JSON.parse(data);
                    const json = jsonParse.data;
                    mc_header_data = json.headers;
                    get_mass_collections(json);
                    $("#mass_collection_step").val(2);
                    // $("#btn_mass_submit").html("<span class='fa fa-check-circle'></span> Save");
                    $("#btn_mass_submit").show();
                    // $("#mass_collection_step_1").hide();
                    // $("#btn_mass_prev").show();
                }
            });
        } else {
            if (mc_client_data.length > 0) {
                if ($(".negative").length > 0) {
                    swal("Cannot proceed!", "Negative values are found!", "warning");
                } else {
                    var form_mass_collection = mc_header_data;
                    form_mass_collection.details = mc_client_data;
                    $.ajax({
                        type: "POST",
                        url: "controllers/sql.php?c=" + route_settings.class_name + "&q=add_mass_collection",
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
    });

    function get_mass_collections(json) {
        // $("#mass-modal-header").html(`
        // <div class='col-md-12 row' style="color:#0a0a0a;">
        //     <div class='col-md-2'>
        //         <img src="./assets/img/logo2.png" alt="logo" width="90%">
        //     </div>
        //     <div class='col-md-10'>
        //         <span>BRANCH: <b>${json.headers.branch_name}</b></span><br>
        //         <span>LOAN TYPE: <b>${json.headers.loan_name}</b></span><br>
        //         <span>BANK: <b>${json.headers.chart_name}</b></span><br>
        //         <span>COLLECTION DATE: <b>${json.headers.collection_date_label}</b></span><br>
        //         <span>EMPLOYER: <b>${json.headers.employer_name}</b></span><br>
        //     </div>
        // </div>`);
        var client_tds = "";
        mc_client_data = [];
        for (var clientIndex = 0; clientIndex < json.clients.length; clientIndex++) {
            const client = json.clients[clientIndex];

            var deduction = client.monthly_payment * 1;
            var atm_charge = client.atm_charge * 1;
            var excess = 0 - deduction - 0 - atm_charge;
            var nega_excess = excess < 0 ? "negative" : "";

            var client_data = {
                client_id: client.client_id * 1,
                loan_id: client.loan_id * 1,
                atm_balance_before_withdraw: 0,
                atm_withdrawal: 0,
                deduction: deduction,
                emergency_loan: 0,
                atm_charge: atm_charge,
                atm_balance: 0,
                excess: excess
            };
            mc_client_data.push(client_data);
            client_tds += `<tr>
                <td>${clientIndex+1}</td>
                <td>${client.client_name}</td>
                <td onblur="solveCollection(this,${clientIndex},1)" id="mc1_${clientIndex}" contenteditable="true" class='right mc_1'></td>
                <td onblur="solveCollection(this,${clientIndex},2)" id="mc2_${clientIndex}" contenteditable="true" class='right mc_2'></td>
                <td onblur="solveCollection(this,${clientIndex},3)" id="mc3_${clientIndex}" contenteditable="true" class='right mc_3'>${numberFormat(client.monthly_payment)}</td>
                <td onblur="solveCollection(this,${clientIndex},4)" id="mc4_${clientIndex}" contenteditable="true" class='right mc_4'></td>
                <td onblur="solveCollection(this,${clientIndex},5)" id="mc5_${clientIndex}" contenteditable="true" class='right mc_5'>${numberFormat(client.atm_charge)}</td>
                <td id="mc6_${clientIndex}" class='right'></td>
                <td id="mc7_${clientIndex}" class='right mc_7 ${nega_excess}'>${numberFormat(excess)}</td>
                <td id="mc8_${clientIndex}" class='center'>${client.atm_account_no}</td>
              </tr>`;
        }
        $('#mass_collection_result_content').html(`<div style='width:100%' class='w3-animate-left'>
            <table id="tbl_mass_collection">
              <tr>
                <th>#</th>
                <th>NAME</th>
                <th class='w-10'>ATM BALANCE BEFORE WITHDRAWAL</th>
                <th class='w-10'>ATM WITHDRAWAL</th>
                <th class='w-10'>DEDUCTION</th>
                <th class='w-10'>EMERGENCY LOAN</th>
                <th class='w-10'>ATM CHARGE</th>
                <th class='w-10'>ATM BALANCE</th>
                <th class='w-10'>EXCESS</th>
                <th>ACCOUNT NO</th>
              </tr>
              ${client_tds}
              <tr>
                <th colspan="2">TOTAL</th>
                <th id="mc_total_1" class="right"></th>
                <th id="mc_total_2" class="right"></th>
                <th id="mc_total_3" class="right"></th>
                <th id="mc_total_4" class="right"></th>
                <th id="mc_total_5" class="right"></th>
                <th id="mc_total_6" class="right"></th>
                <th id="mc_total_7" class="right"></th>
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
                <span><b>MITOS SHEILA GARFIL</b></span>
            </div>
        </div>
        </div>`);
        totalComputer(6);
        totalComputer(7);
    }

    function solveCollection(ele, client_id, type) {
        var str = ele.innerHTML;
        var num = parseFloat(str.replaceAll(",", ""));

        formated_num = numberFormat(num);
        ele.innerHTML = formated_num == "NaN" ? '' : formated_num;
        totalComputer(type);
        balanceComputer(client_id);
    }

    function totalComputer(type) {
        var elements = document.getElementsByClassName("mc_" + type);
        var total_amount = 0;
        // Loop through the collection of elements
        for (var i = 0; i < elements.length; i++) {
            var element = elements[i];
            var number = parseFloat(element.innerHTML.replaceAll(",", ""));
            number = number ? number : 0;
            total_amount += number;
        }
        $("#mc_total_" + type).html(numberFormat(total_amount));
    }

    function balanceComputer(client_id) {
        var atm_balance_before = stringToNum(client_id, 1);
        mc_client_data[client_id].atm_balance_before_withdraw = atm_balance_before;

        var atm_withdrawal = stringToNum(client_id, 2);
        mc_client_data[client_id].atm_withdrawal = atm_withdrawal;

        var deduction = stringToNum(client_id, 3);
        mc_client_data[client_id].deduction = deduction;

        var emergency_loan = stringToNum(client_id, 4)
        mc_client_data[client_id].emergency_loan = emergency_loan;

        var atm_charge = stringToNum(client_id, 5)
        mc_client_data[client_id].atm_charge = atm_charge;

        var atm_balance = atm_balance_before - atm_withdrawal;
        mc_client_data[client_id].atm_balance = atm_balance;
        var formated_num = numberFormat(atm_balance);
        $("#mc6_" + client_id).html(formated_num);
        if (atm_balance < 0) {
            $("#mc6_" + client_id).addClass("negative");
        } else {
            $("#mc6_" + client_id).removeClass("negative");
        }
        totalComputer(6);

        var excess = atm_withdrawal - deduction - emergency_loan - atm_charge;
        mc_client_data[client_id].excess = excess;
        var formated_num = numberFormat(excess);
        $("#mc7_" + client_id).html(formated_num);
        if (excess < 0) {
            $("#mc7_" + client_id).addClass("negative");
        } else {
            $("#mc7_" + client_id).removeClass("negative");
        }
        totalComputer(7);

    }

    function stringToNum(client_id, num) {
        var str = $("#mc" + num + "_" + client_id).html();
        var number = parseFloat(str.replaceAll(",", ""));
        return number ? number : 0;
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