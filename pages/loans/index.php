<style>
    .text-right {
        text-align: right;
    }
</style>
<section class="section">
    <div class="section-header">
        <div class="alert-body">
            <div class="alert-title">Loans</div>
            Manage loans here.
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Transactions</a></div>
            <div class="breadcrumb-item">Loans</div>
        </div>
    </div>

    <div class="section-body shadow">
        <div class="alert alert-light alert-has-icon" style="border: 1px dashed #3C84AB;">
            <div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label><strong>Start Date</strong></label>
                        <div>
                            <input type="date" required class="form-control" id="start_date"
                                value="<?php echo date('Y-m-01', strtotime(date(" Y-m-d"))); ?>"
                            name="input[start_date]">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label><strong>End Date</strong></label>
                        <div>
                            <input type="date" required class="form-control" id="end_date"
                                value="<?php echo date('Y-m-t', strtotime(date(" Y-m-d"))) ?>" name="input[end_date]">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>&nbsp;</label>
                        <div>
                            <div class="btn-group">
                                <button type="button" class="btn btn-warning" onclick="getEntries()"><i
                                        class="fas fa-refresh"></i> Generate</button>

                                <div class="dropdown">
                                    <a href="#" data-toggle="dropdown" class="btn btn-info dropdown-toggle"><i
                                            class="fas fa-file-excel"></i> Template</a>
                                    <div class="dropdown-menu">
                                        <!-- <a href="#" class="dropdown-item has-icon" onclick="exportTemplate()"><i class="fas fa-download"></i> Export Loan Template</a> -->
                                        <!--                                         <a href="#" class="dropdown-item has-icon" onclick="importTemplate()"><i
                                                class="far fa-upload"></i> Import Loan Template</a> -->
                                        <a href="#" class="dropdown-item has-icon" onclick="uploadFile()"><i
                                                class="far fa-upload"></i>
                                            Upload Ledger</a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><i
                                            class="fas fa-plus"></i> Add</a>
                                    <div class="dropdown-menu">
                                        <a href="#" class="dropdown-item has-icon" onclick="addModal()"><i
                                                class="fas fa-add"></i> Add New Loan</a>
                                        <a href="#" class="dropdown-item has-icon" onclick="addOtherLoan('Y')"><i
                                                class="far fa-repeat"></i> Loan Renewal</a>
                                        <a href="#" class="dropdown-item has-icon" onclick="addOtherLoan('N')"><i
                                                class="far fa-file-circle-plus"></i> Additional Loan</a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <div class="btn-group btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-danger" onclick="deleteEntry()"><i
                                                class="fas fa-trash"></i> Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dt_entries" class="table table-striped">
                                <thead class="">
                                    <tr>
                                        <th style="width:10px;">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" data-checkboxes="mygroup"
                                                    class="custom-control-input" id="checkbox-1"
                                                    onchange="checkAll(this, 'dt_id')">
                                                <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </th>
                                        <th></th>
                                        <th>Reference #</th>
                                        <th>Client</th>
                                        <th>Loan Type</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Date Added</th>
                                        <th>Date Modified</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include "modal_loans.php"; ?>
<?php include "modal_other_loans.php"; ?>
<?php include "modal_export.php"; ?>
<?php include "modal_import.php"; ?>
<?php include "modal_upload.php"; ?>
<script type="text/javascript">
    function getEntries() {
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();
        var param = "(loan_date >= '" + start_date + "' AND loan_date <= '" + end_date + "')";

        $("#dt_entries").DataTable().destroy();
        $("#dt_entries").DataTable({
            "processing": true,
            "ajax": {
                "url": "controllers/sql.php?c=" + route_settings.class_name + "&q=show",
                "dataSrc": "data",
                "type": "POST",
                "data": {
                    input: {
                        param: param
                    }
                }
            },
            "order": [
                [7, 'desc']
            ],
            "columns": [{

                "mRender": function(data, type, row) {
                    // return row.status == "D" || row.status == "A" ? '<div class="custom-checkbox custom-control"><input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" name="dt_id" id="checkbox-b' + row.loan_id + '" value=' + row.loan_id + '><label for="checkbox-b' + row.loan_id + '" class="custom-control-label">&nbsp;</label></div>' : "";
                    return '<div class="custom-checkbox custom-control"><input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" name="dt_id" id="checkbox-b' + row.loan_id + '" value=' + row.loan_id + '><label for="checkbox-b' + row.loan_id + '" class="custom-control-label">&nbsp;</label></div>';
                }
            },
            {
                "mRender": function(data, type, row) {
                    return "<center><button class='btn btn-sm btn-info' onclick='getEntryDetails(" + row.loan_id + ")'><span class='fa fa-edit'></span></button></center>";
                }
            },
            {
                "data": "reference_number"
            },
            {
                "data": "client"
            },
            {
                "data": "loan_type"
            },
            {
                "data": "loan_amount"
            },
            {
                "mRender": function(data, type, row) {
                    return row.status == "P" ? '<a href="#" class="badge badge-light">Pending</a>' : row.status == "A" ? '<a href="#" class="badge badge-success">Approved</a>' : row.status == "R" ? '<a href="#" class="badge badge-info">Released</a>' : row.status == "F" ? '<a href="#" class="badge badge-primary">Fully Paid</a>' : '<a href="#" class="badge badge-danger">Denied</a>';
                }
            },
            {
                "data": "date_added"
            },
            {
                "data": "date_last_modified"
            }
            ]
        });
    }

    function clients() {
        var id = $("#hidden_id").val();
        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=" + route_settings.class_name + "&q=client_id",
            data: {
                input: {
                    id: id
                }
            },
            success: function(data) {
                var jsonParse = JSON.parse(data);
                const json = jsonParse.data;
                $("#client_id").val(json).trigger('change');
            }
        });
    }

    function releasedLoan() {
        $("#btn_release").html("<span class='fa fa-spinner fa-spin'></span>");
        swal({
            title: 'Are you sure?',
            text: 'You will not be able to recover these entries!',
            icon: 'info',
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    var loan_id = $("#hidden_id").val();

                    $.ajax({
                        type: "POST",
                        url: "controllers/sql.php?c=" + route_settings.class_name + "&q=released",
                        data: {
                            input: {
                                id: loan_id
                            }
                        },
                        success: function(data) {
                            getEntries();
                            var json = JSON.parse(data);
                            console.log(json);
                            if (json.data == 1) {
                                swal("Success!", "Successfully released loan!", "success");
                            } else {
                                failed_query(json);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            errorLogger('Error:', textStatus, errorThrown);
                        }
                    });
                    $("#btn_release").html('Release');
                    $("#btn_release").prop('disabled', true);

                    $("#modalEntry").modal("hide");
                } else {
                    swal("Cancelled", "Entries are safe :)", "error");
                }
            });
    }

    // function deniedLoan() {
    //     $("#btn_deny").html("<span class='fa fa-spinner fa-spin'></span>");
    //     swal({
    //             title: 'Are you sure?',
    //             text: 'You will not be able to recover these entries!',
    //             icon: 'warning',
    //             buttons: true,
    //             dangerMode: true,
    //         })
    //         .then((willDelete) => {
    //             if (willDelete) {
    //                 var loan_id = $("#hidden_id").val();

    //                 $.ajax({
    //                     type: "POST",
    //                     url: "controllers/sql.php?c=" + route_settings.class_name + "&q=denied",
    //                     data: {
    //                         input: {
    //                             id: loan_id
    //                         }
    //                     },
    //                     success: function(data) {
    //                         getEntries();
    //                         var json = JSON.parse(data);
    //                         console.log(json);
    //                         if (json.data == 1) {
    //                             swal("Success!", "Successfully denied loan!", "success");
    //                         } else {
    //                             failed_query(json);
    //                         }
    //                     },
    //                     error: function(jqXHR, textStatus, errorThrown) {
    //                         errorLogger('Error:', textStatus, errorThrown);
    //                     }
    //                 });
    //                 $("#btn_deny").html('Release');
    //                 $("#btn_deny").prop('disabled', true);

    //                 $("#modalEntry").modal("hide");
    //             } else {
    //                 swal("Cancelled", "Entries are safe :)", "error");
    //             }
    //         });
    // }

    function changeLoanType(loan_type_id = null) {
        var loan_type_id = loan_type_id == null ? $("#loan_type_id").val() : loan_type_id;
        var loan_type_interest = $("#loan_type_id").find('option:selected').attr('loan_type_interest');
        var penalty_percentage = $("#loan_type_id").find('option:selected').attr('penalty_percentage');
        var fixed_interest = $("#loan_type_id").find('option:selected').attr('fixed_interest');
        $("#loan_interest").val(loan_type_interest);
        $("#penalty_percentage").val(penalty_percentage);

        if (fixed_interest != "Y") {
            $("#div_amount").html('<label><strong style="color:red;">*</strong> Loan amount</label><input type="number" step="0.01" class="form-control input-item" onchange="calculateInterest()" autocomplete="off" name="input[loan_amount]" id="loan_amount" required>');
            loan_fixed_interest = 0;
        } else {
            $("#div_amount").html('<label><strong style="color:red;">*</strong> Loan amount</label><select class="form-control select2 input-item" id="loan_amount" name="input[loan_amount]" onchange="getFixedInterest()" style="width:100%;" required></select>');
            getSelectOption('FixedInterest', 'loan_amount', 'loan_amount', "loan_type_id='" + loan_type_id + "'", ['interest_amount', 'interest_terms', 'penalty_percentage']);
            loan_fixed_interest = 1;
        }
    }

    function getFixedInterest() {
        var loan_interest = $("#loan_amount").find('option:selected').attr('interest_amount');
        var penalty_percentage = $("#loan_amount").find('option:selected').attr('penalty_percentage');
        var loan_period = $("#loan_amount").find('option:selected').attr('interest_terms');
        $("#loan_interest").val(loan_interest);
        $("#penalty_percentage").val(penalty_percentage);
        $("#loan_period").val(loan_period);

    }

    function calculateInterest() {
        var loan_amount = $("#loan_amount").val();
        var loan_period = $("#loan_period").val();
        var interest = (loan_type_interest / 100);
        // $("#loan_interest").val(loan_type_interest);
    }

    function sampleCalculation(type) {
        var loan_date = $("#loan_date").val();
        var loan_amount = $("#loan_amount").val();
        var loan_period = $("#loan_period").val();
        var loan_interest = $("#loan_interest").val();
        var payment_date_start = $("#payment_date_start").val();
        var monthly_payment = $("#monthly_payment").val() * 1;
        var payment_terms = $("#payment_terms").val() * 1;

        if ((loan_amount == "" || loan_period == "" || loan_interest == "" || payment_terms == "") && type != "add") {
            swal("Ops!", "Fill out all required fields.", "warning");
        } else {

            $("#dt_calculation").DataTable().destroy();
            $("#dt_calculation").DataTable({
                "processing": true,
                "bPaginate": false,
                "bFilter": false,
                "bInfo": false,
                "ordering": false,
                "ajax": {
                    "url": "controllers/sql.php?c=" + route_settings.class_name + "&q=sample_calculation",
                    "dataSrc": "data",
                    "method": "POST",
                    "data": {
                        input: {
                            loan_interest: loan_interest,
                            loan_period: loan_period,
                            loan_amount: loan_amount,
                            loan_date: loan_date,
                            monthly_payment: monthly_payment,
                            payment_terms: payment_terms,
                            loan_fixed_interest: loan_fixed_interest,
                            payment_date_start:payment_date_start
                        }
                    },
                },
                "columns": [{
                    "data": "date"
                },
                {
                    "data": "payment",
                    className: "text-right"
                },
                {
                    "data": "interest",
                    className: "text-right"
                },
                {
                    "data": "applicable_principal",
                    className: "text-right"
                },
                {
                    "data": "balance",
                    className: "text-right"
                }
                ]
            });
        }
    }

    function sampleCalculation2() {
        var loan_date = $("#loan_date_renewal").val();
        var loan_amount = $("#loan_amount_renewal").val();
        var loan_period = $("#loan_period_renewal").val();
        var loan_interest = $("#loan_interest_renewal").val();
        var monthly_payment = $("#monthly_payment_renewal").val();
        var payment_terms = $("#payment_terms_renewal").val();
        var payment_date_start = $("#payment_date_start").val();
        

        $("#dt_calculation2").DataTable().destroy();
        $("#dt_calculation2").DataTable({
            "processing": true,
            "bPaginate": false,
            "bFilter": false,
            "bInfo": false,
            "ordering": false,
            "ajax": {
                "url": "controllers/sql.php?c=" + route_settings.class_name + "&q=sample_calculation",
                "dataSrc": "data",
                "method": "POST",
                "data": {
                    input: {
                        loan_interest: loan_interest,
                        loan_period: loan_period,
                        loan_amount: loan_amount,
                        loan_date: loan_date,
                        monthly_payment: monthly_payment,
                        payment_terms: payment_terms,
                        payment_date_start:payment_date_start
                    }
                },
            },
            "columns": [{
                "data": "date"
            },
            {
                "data": "payment",
                className: "text-right"
            },
            {
                "data": "interest",
                className: "text-right"
            },
            {
                "data": "applicable_principal",
                className: "text-right"
            },
            {
                "data": "balance",
                className: "text-right"
            }
            ]
        });
    }

    function loanDetails() {
        var loan_id = $("#hidden_id").val();
        var param = "loan_id= '" + loan_id + "' ";
        $("#dt_loan_details").DataTable().destroy();
        $("#dt_loan_details").DataTable({
            "processing": true,
            "searching": false,
            "paging": false,
            "ordering": false,
            "info": false,
            "order": [
                [2, 'desc']
            ],
            "ajax": {
                "url": "controllers/sql.php?c=Loans&q=statement_of_accounts",
                "dataSrc": "data",
                "method": "POST",
                "data": {
                    input: {
                        param: param
                    }
                },
            },
            "columns": [{
                "data": "date"
            },
            {
                "data": "payment"
            },
            {
                "data": "interest"
            },
            {
                "data": "penalty"
            },
            {
                "data": "applicable_principal"
            },
            {
                "data": "balance"
            }
            ]
        });
    }

    function getPenalty(loan_id) {
        var collection_date = $("#loan_date").val();
        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=Loans&q=penalty",
            data: {
                input: {
                    loan_id: loan_id,
                    collection_date: collection_date
                }
            },
            success: function(data) {
                var json = JSON.parse(data);
                $(".penalty_amount").val(json.data);
            }
        });
    }

    function getBalance() {
        var loan_date = $("#loan_date_renewal").val();
        var loan_id = $("#loan_id_renewal").val();
        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=Loans&q=loan_balance",
            data: {
                input: {
                    loan_id: loan_id,
                    loan_date: loan_date
                }
            },
            success: function(data) {
                var json = JSON.parse(data);
                $(".amount").val(json.data);
            }
        });
    }

    function generateReference2() {
        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=" + route_settings.class_name + "&q=generate",
            data: [],
            success: function(data) {
                var json = JSON.parse(data);
                $("#new_reference_number").val(json.data);
            }
        });
    }


    function getClients() {
        var branch_id = $("#branch_id").val();
        getSelectOption('Clients', 'client_id', 'client_fullname', "branch_id='" + branch_id + "'", [], '', 'Please Select', '', 1);
    }

    var loan_type_interest = 0;
    var loan_fixed_interest = 0;
    $(document).ready(function() {
        schema();
        getEntries();
        getSelectOption('Branches', 'branch_id', 'branch_name', '', [], '', 'Please Select', '', 1);
        getSelectOption('LoanTypes', 'loan_type_id', 'loan_type', "", ['loan_type_interest', 'penalty_percentage', 'fixed_interest']);
    });
</script>