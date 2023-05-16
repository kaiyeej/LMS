<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-hand-holding-usd"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Released Loan</h4>
                    </div>
                    <div class="card-body">
                        <span id="released_total_label" class="label-item"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Outstanding Balance</h4>
                    </div>
                    <div class="card-body">
                        <span id="outstanding_total_label" class="label-item"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Approved Accounts</h4>
                    </div>
                    <div class="card-body">
                        <span id="approved_total_label" class="label-item"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-user-clock"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Pending Accounts</h4>
                    </div>
                    <div class="card-body">
                        <span id="pending_total_label" class="label-item"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Summary of Loan Types</h4>
                </div>
                <div class="card-body" id="summary_loans_report">

                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Pending Accounts</h4>
                </div>
                <div class="card-body">
                    <div class="summary">
                        <div class="summary-item">
                            <ul class="list-unstyled list-unstyled-border" id="list_pending">

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function getReport() {

        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=Loans&q=dashboard",
            success: function(data) {
                var jsonParse = JSON.parse(data);
                const json = jsonParse.data;

                $('.label-item').map(function() {
                    const id_name = this.id;
                    const new_id = id_name.replace('_label', '');
                    this.innerHTML = json[new_id];
                });
            }
        });
    }

    function getSummary() {
        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=LoanReport&q=summary_loan_type",
            success: function(data) {
                $("#summary_loans_report").html(data.replace('{"data":null}', ''));
            }
        });
    }

    function getPendingAccounts() {
        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=LoanReport&q=pending_loans",
            success: function(data) {
                $("#list_pending").html(data.replace('{"data":null}', ''));
            }
        });
    }

    $(document).ready(function() {
        getReport();
        getSummary();
        getPendingAccounts();
    });
</script>