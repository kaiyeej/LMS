<form id='frmMassCollection' method="POST">
    <div class="modal fade" id="modalMassCollection" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" id="import_dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span class='ion-compose'></span> Add Mass Collection</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" value="1" id="mass_collection_step">
                    <div class="form-row" id="mass_collection_step_1">
                        <div class="form-group col-md-3">
                            <label>Loan Type</label>
                            <select class="form-control select2 input-item" id="loan_type_id" name="input[loan_type_id]" style="width:100%;" required>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Collection Date</label>
                            <input type="date" class="form-control input-item" autocomplete="off" name="input[collection_date]" id="collection_date" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Company Code</label>
                            <input type="text" class="form-control input-item" autocomplete="off" name="input[company_code]" id="company_code" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>ATM Charge</label>
                            <input min="0" type="number" class="form-control input-item" autocomplete="off" name="input[atm_charge]" id="atm_charge" required>
                        </div>
                    </div>
                    <div class="row" id="mass_collection_result_content">
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn_mass_submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    function addMassCollection() {
        $("#mass_collection_step").val(1);
        $("#btn_mass_submit").html("Next");

        $('#mass_collection_result_content').html("");
        // get_mass_collections();
        $("#modalMassCollection").modal('show');
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
                    get_mass_collections(json);
                    $("#mass_collection_step").val(2);
                    $("#btn_mass_submit").html("Save");
                    $("#mass_collection_step_1").hide();
                }
            });
        } else {

        }
    });

    function get_mass_collections(json) {
        var client_tds = "";
        for (var clientIndex = 0; clientIndex < json.clients.length; clientIndex++) {
            const client = json.clients[clientIndex];
            client_tds += `<tr>
                <td>${clientIndex+1}</td>
                <td>${client.client_name}</td>
                <td onblur="solveCollection(this,${client.client_id},1)" id="mc1_${client.client_id}" contenteditable="true" class='right'></td>
                <td onblur="solveCollection(this,${client.client_id},2)" id="mc2_${client.client_id}" contenteditable="true" class='right'></td>
                <td onblur="solveCollection(this,${client.client_id},3)" id="mc3_${client.client_id}" contenteditable="true" class='right'></td>
                <td onblur="solveCollection(this,${client.client_id},4)" id="mc4_${client.client_id}" contenteditable="true" class='right'></td>
                <td onblur="solveCollection(this,${client.client_id},5)" id="mc5_${client.client_id}" contenteditable="true" class='right'>${client.atm_charge}</td>
                <td id="mc6_${client.client_id}" class='right'></td>
                <td id="mc7_${client.client_id}" class='right'></td>
                <td id="mc8_${client.client_id}">00100-5011-01798-1</td>
              </tr>`;
        }
        $('#mass_collection_result_content').html(`<div style='width:100%'>
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
        </table>
        </div>`);
    }

    function solveCollection(ele, client_id, type) {
        var str = ele.innerHTML;
        var num = parseFloat(str.replace(",", ""));

        formated_num = numberFormat(num);
        ele.innerHTML = formated_num == "NaN" ? '' : formated_num;
        balanceComputer(client_id);
    }

    function balanceComputer(client_id) {
        var atm_balance_before = stringToNum(client_id, 1);
        var atm_withdrawal = stringToNum(client_id, 2);
        var deduction = stringToNum(client_id, 3);
        var emergency_loan = stringToNum(client_id, 4);
        var atm_charge = stringToNum(client_id, 5);

        var atm_balance = atm_balance_before - atm_withdrawal;
        formated_num = numberFormat(atm_balance);
        $("#mc6_" + client_id).html(formated_num == "NaN" ? '' : formated_num);
    }

    function stringToNum(client_id, num) {
        var str = $("#mc" + num + "_" + client_id).html();
        var num = parseFloat(str.replace(",", ""));
        return num * 1;
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

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 42px;
    }
</style>