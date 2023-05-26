<section class="section">
    <div class="section-header">
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Accounting</a></div>
            <div class="breadcrumb-item">Income Statement</div>
        </div>
    </div>

    <div class="section-body">
        <div class="alert alert-light alert-has-icon" style="border: 1px dashed #3C84AB;">
            <form id='frm_generate'>
                <div class="form-group row">
                    <div class="col-lg-4">
                        <label><strong>Month</strong></label>
                        <select class="form-control select2" style="width: 100%;" id='report_month' name='report_month' required>
                            <?php
                            for ($i = 0; $i < 12; $i++) {
                                $time = strtotime(sprintf('%d months', $i));
                                $label = date('F', $time);
                                $value = date('n', $time);
                                echo "<option value='$value'>" . strtoupper($label) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <label><strong>Year</strong></label>
                        <select class="form-control select2" style="width: 100%;" id='report_year' name='report_year' required>
                            <?php
                            $year = date("Y") - 2;
                            for ($i = 0; $i <= 4; $i++) { ?>
                                <option value='<?php echo $year; ?>' <?php if ($year == date("Y")) {
                                                                            echo 'selected';
                                                                        } ?>>
                                    <?php echo $year; ?></option>;
                            <?php
                                $year++;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <label>&nbsp;</label>
                        <div>
                            <div class="btn-group pull-right">
                                <button type="submit" id="btn_generate" class="btn btn-primary btn-icon-split">
                                    <span class="icon">
                                        <i class="ti ti-reload"></i>
                                    </span>
                                    <span class="text"> Generate</span>
                                </button>
                                <button type="button" onclick="exportTableToExcel(this,'dt_entries','Income-Statement')" class="btn btn-success btn-icon-split">
                                    <span class="icon">
                                        <i class="ti ti-cloud-down"></i>
                                    </span>
                                    <span class="text"> Export</span>
                                </button>
                                <button type="button" onclick="print_report('report_container')" class="btn btn-info btn-icon-split">
                                    <span class="icon">
                                        <i class="ti ti-printer"></i>
                                    </span>
                                    <span class="text"> Print</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="col-12 col-xl-12 card shadow mb-4">
                    <div id="report_container" class="card-body">
                        <center>
                            <img src="./assets/img/logo2.png" alt="logo" width="200"><br><br>
                            <strong> <span id='covered_date_label'></span></strong>
                        </center>
                        <br>
                        <div class="table-responsive">
                            <center>
                                <table class="table table-bordered table-hover cell-border" id="dt_entries" width="100%" cellspacing="0">
                                    <thead style="background: #90a4ae;">
                                        <tr>
                                            <th style="color:#fff;">COLLECTION</th>
                                            <th style="text-align:right;font-weight:bold;color:#fff;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="padding-left: 100px;">FLC Collection</td>
                                            <td style="text-align:right;"><span id="collected_total_label" class="label-item"></span></td>
                                        </tr>
                                    </tbody>

                                    <thead style="background: #90a4ae;">
                                        <tr>
                                            <th style="color:#fff;">LOAN RELEASES</th>
                                            <th style="text-align:right;font-weight:bold;"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="loan_releases_list_label" class="label-item">

                                    </tbody>

                                    <thead style="background: #90a4ae;">
                                        <tr>
                                            <th style="color:#fff;">GROSS INCOME</th>
                                            <th style="text-align:right;font-weight:bold;"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="revenue_list_label" class="label-item">

                                    </tbody>
                                    <tr style="font-weight:bold;">
                                        <td style="text-align:right;">Total Interest Income</td>
                                        <td style="text-align:right;"><span id="revenue_total_label" class="label-item"></span></td>
                                    </tr>

                                    <thead style="background: #90a4ae;">
                                        <tr>
                                            <th style="color:#fff;">EXPENSES</th>
                                            <th style="text-align:right;font-weight:bold;"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="expenses_list_label" class="label-item">

                                    </tbody>
                                    <tr style="font-weight:bold;">
                                        <td style="text-align:right;">Subtotal</td>
                                        <td style="text-align:right;"><span id="expenses_total_label" class="label-item"></span></td>
                                    </tr>

                                    <tr style="font-weight:bold;">
                                        <td style="text-align:right;font-style: italic;font-size:15px;">NET INCOME , <span id="net_date_label"></span></td>
                                        <td style="text-align:right;font-size:15px;"><span id="income_total_label" class="label-item"></span></td>
                                    </tr>

                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $("#frm_generate").submit(function(e) {
        e.preventDefault();

        getReport();
    });


    function getReport() {
        var report_month = $("#report_month").val();
        var report_year = $("#report_year").val();

        var mnth = $('#report_month').find(":selected").text();

        $("#covered_date_label").html("LENDING OPERATION FOR THE MONTH OF " + mnth + " " + report_year);
        $("#net_date_label").html(mnth + " " + report_year);

        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=" + route_settings.class_name + "&q=view",
            data: {
                input: {
                    report_month: report_month,
                    report_year: report_year
                }
            },
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

        // $("#company_name_label").html(company_profile.company_name);
        // $("#company_address_label").html(company_profile.company_address);
    });
</script>