<style>
    .text-right {
        text-align: right;
    }
</style>
<section class="section">
    <div class="section-header">
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Reports</a></div>
            <div class="breadcrumb-item">Loan Status</div>
        </div>
    </div>

    <div class="section-body shadow">
        <div class="alert alert-light alert-has-icon" style="border: 1px dashed #3C84AB;">
            <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
            <div class="alert-body">
                <div class="alert-title">Loans</div>
                Manage loans here.
            </div>
            <div>
                <a href="#" class="btn btn-icon icon-left btn-primary" onclick="addModal()"><i class="fas fa-plus"></i> Add</a>
                <a href="#" class="btn btn-icon icon-left btn-danger" onclick='deleteEntry()'><i class="fas fa-trash"></i> Delete</a>
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
                                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-1" onchange="checkAll(this, 'dt_id')">
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
<script type="text/javascript">
    function getEntries() {
        $("#dt_entries").DataTable().destroy();
        $("#dt_entries").DataTable({
            "processing": true,
            "ajax": {
                "url": "controllers/sql.php?c=" + route_settings.class_name + "&q=show",
                "dataSrc": "data"
            },
            "columns": [{
                    "mRender": function(data, type, row) {
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
                        return row.status == "P" ? '<a href="#" class="badge badge-light">Pending</a>' : row.status == "A" ? '<a href="#" class="badge badge-success">Approved</a>' :  row.status == "R" ? '<a href="#" class="badge badge-info">Released</a>' : row.status == "F" ? '<a href="#" class="badge badge-primary">Fully Paid</a>' : '<a href="#" class="badge badge-danger">Denied</a>';
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

    function changeLoanType() {
        var optionSelected = $("#loan_type_id").find('option:selected').attr('loan_type_interest');
        loan_type_interest = optionSelected;
        $("#loan_interest").val(loan_type_interest);
    }

    function calculateInterest(){
        var loan_amount = $("#loan_amount").val();
        var loan_period = $("#loan_period").val();
        var interest = (loan_type_interest/100)

        // $("#loan_interest").val(loan_type_interest);

    }

    function sampleCalculation() {
        var loan_date = $("#loan_date").val();
        var loan_amount = $("#loan_amount").val();
        var loan_period = $("#loan_period").val();
        var loan_interest = $("#loan_interest").val();

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
                        loan_date: loan_date
                    }
                },
            },
            "columns": [
                {
                    "data": "date"
                },
                {
                    "data": "payment", className: "text-right"
                },
                {
                    "data": "interest", className: "text-right"
                },
                {
                    "data": "applicable_principal", className: "text-right"
                }
            ]
        });
    }

    var loan_type_interest = 0;
    $(document).ready(function() {
        getEntries();
        getSelectOption('LoanTypes', 'loan_type_id', 'loan_type', "", ['loan_type_interest']);
        getSelectOption('Clients', 'client_id', 'client_fullname');
    });
</script>