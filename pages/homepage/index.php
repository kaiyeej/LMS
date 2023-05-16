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
        <!-- <div class="col-lg-8 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Statistics</h4>
                    <div class="card-header-action">
                        <div class="btn-group">
                            <a href="#" class="btn btn-primary">Week</a>
                            <a href="#" class="btn">Month</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="myChart" height="182"></canvas>
                    <div class="statistic-details mt-sm-4">
                        <div class="statistic-details-item">
                            <span class="text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 7%</span>
                            <div class="detail-value">&#x20B1;243</div>
                            <div class="detail-name">Today's Receivable</div>
                        </div>
                        <div class="statistic-details-item">
                            <span class="text-muted"><span class="text-danger"><i class="fas fa-caret-down"></i></span> 23%</span>
                            <div class="detail-value">&#x20B1;2,902</div>
                            <div class="detail-name">This Week's Receivable</div>
                        </div>
                        <div class="statistic-details-item">
                            <span class="text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span>9%</span>
                            <div class="detail-value">&#x20B1;12,821</div>
                            <div class="detail-name">This Month's Receivable</div>
                        </div>
                        <div class="statistic-details-item">
                            <span class="text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 19%</span>
                            <div class="detail-value">&#x20B1;92,142</div>
                            <div class="detail-name">This Year's Receivable</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Recent Activities</h4>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled list-unstyled-border">
                        <li class="media">
                            <img class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-1.png" alt="avatar">
                            <div class="media-body">
                                <div class="float-right text-primary">Now</div>
                                <div class="media-title">Pepe Smith</div>
                                <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                            </div>
                        </li>
                        <li class="media">
                            <img class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-2.png" alt="avatar">
                            <div class="media-body">
                                <div class="float-right">12m</div>
                                <div class="media-title">Juan Dela Cruz</div>
                                <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                            </div>
                        </li>
                        <li class="media">
                            <img class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-3.png" alt="avatar">
                            <div class="media-body">
                                <div class="float-right">17m</div>
                                <div class="media-title">Rizal Cruz</div>
                                <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                            </div>
                        </li>
                        <li class="media">
                            <img class="mr-3 rounded-circle" width="50" src="assets/img/avatar/avatar-4.png" alt="avatar">
                            <div class="media-body">
                                <div class="float-right">21m</div>
                                <div class="media-title">Anna Maria</div>
                                <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                            </div>
                        </li>
                    </ul>
                    <div class="text-center pt-1 pb-1">
                        <a href="#" class="btn btn-primary btn-lg btn-round">
                            View All
                        </a>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</section>
<script>
     function getReport() {

        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=" + route_settings.class_name + "&q=view",
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

    $(document).ready(function() {
        getReport();
    });
</script>