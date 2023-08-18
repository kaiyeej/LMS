<section class="section">
    <div class="section-header">
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Admin</a></div>
            <div class="breadcrumb-item">Control Panel</div>
        </div>
    </div>
    <div class="section-body shadow">
        <div class="alert alert-light alert-has-icon" style="border: 1px dashed #3C84AB;">
            <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
            <div class="alert-body">
                <div class="alert-title">Control Panel</div>
                Manage administrative actions here.
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="database-syncer-tab" data-toggle="tab"
                                    href="#database-syncer" role="tab" aria-controls="database-syncer"
                                    aria-selected="true">Database Syncer</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="others-tab" data-toggle="tab" href="#others" role="tab"
                                    aria-controls="others" aria-selected="false">Others</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="database-syncer" role="tabpanel"
                                aria-labelledby="database-syncer-tab">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="btn-group-vertical btn-block" role="group"
                                            aria-label="Basic example">
                                            <button type="button" class="btn btn-primary"
                                                onclick="syncDatabase()">Sync</button>
                                            <button type="button" class="btn btn-danger"
                                                onclick="syncFresh()">Fresh</button>
                                            <button type="button" class="btn btn-warning"
                                                onclick="syncFreshTransaction()">Fresh
                                                Transaction</button>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="jumbotron" style="max-height: 350px;overflow: auto;"
                                            id="database-syncer-output">
                                            <div>
                                                <h5 class="section-title">Clients</h5>
                                                <div class="row">
                                                    <strong style="margin-left: 42px;">Query:</strong>
                                                    <p style="margin-bottom: 3px;margin-left: 65px;">
                                                        <span class="fa fa-check-circle text-success"></span> lorem
                                                        itsutiestqw qweioqweiolorem itsutiestqw qweioqweiolorem
                                                        itsutiestqw qweioqweiolorem itsutiestqw qweioqweiolorem
                                                    </p>

                                                    <p style="margin-bottom: 3px;margin-left: 65px;">
                                                        <span class="fa fa-check-circle text-success"></span> lorem
                                                        itsutiestqw qweioqweiolorem itsutiestqw qweioqweiolorem
                                                        itsutiestqw qweioqweiolorem itsutiestqw qweioqweiolorem
                                                    </p>
                                                </div>

                                                <div class="row">
                                                    <strong style="margin-bottom: 10px;">Error:</strong>
                                                    <p style="margin-bottom: 3px;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                                        <span class="fa fa-exclamation-circle text-warning"></span>
                                                        lorem itsutiestqw qweioqweiolorem itsutiestqw qweioqweiolorem
                                                        itsutiestqw qweioqweiolorem itsutiestqw qweioqweiolorem
                                                    </p>

                                                    <p style="margin-bottom: 3px;">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                                        <span class="fa fa-exclamation-circle text-warning"></span>
                                                        lorem itsutiestqw qweioqweiolorem itsutiestqw qweioqweiolorem
                                                        itsutiestqw qweioqweiolorem itsutiestqw qweioqweiolorem
                                                    </p>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="others" role="tabpanel" aria-labelledby="others-tab">
                                For Others
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function syncDatabase() {

        var output_db_syncer = document.getElementById("database-syncer-output");
        output_db_syncer.innerHTML = "";

        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=DatabaseSyncer&q=sync",
            success: function(data) {
                var jsonParse = JSON.parse(data);
                const json = jsonParse.data;

                for (let schema_module in json.schemas) {
                    if (json.schemas[schema_module].length > 0) {
                        output_db_syncer.innerHTML += schema_module + "::" + schema_module.length + "<br>";
                    }
                }
                // output_db_syncer.innerHTML = json;

            }
        });
    }

    function syncFresh() {

        var output_db_syncer = document.getElementById("database-syncer-output");
        output_db_syncer.innerHTML = "";

        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=DatabaseSyncer&q=fresh",
            success: function(data) {
                var jsonParse = JSON.parse(data);
                const json = jsonParse.data;

                for (let schema_module in json.schemas) {
                    if (json.schemas[schema_module].length > 0) {
                        output_db_syncer.innerHTML += schema_module + "::" + schema_module.length + "<br>";
                    }
                }
                // output_db_syncer.innerHTML = json;

            }
        });
    }
    function syncFreshTransaction() {

        var output_db_syncer = document.getElementById("database-syncer-output");
        output_db_syncer.innerHTML = "";

        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=DatabaseSyncer&q=fresh_transaction",
            success: function(data) {
                var jsonParse = JSON.parse(data);
                const json = jsonParse.data;

                for (let schema_module in json.schemas) {
                    if (json.schemas[schema_module].length > 0) {
                        output_db_syncer.innerHTML += schema_module + "::" + schema_module.length + "<br>";
                    }
                }
                // output_db_syncer.innerHTML = json;

            }
        });
    }
</script>