<style>
    
    @media print {
        thead, th{
            color: black !important;
        }
    }
</style>
<section class="section">
    <div class="section-header">
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Accounting</a></div>
            <div class="breadcrumb-item">Financial Statements</div>
        </div>
    </div>

    <div class="section-body">
        <div class="alert alert-light alert-has-icon" style="border: 1px dashed #3C84AB;">
            <form id='frm_generate'>
                <div class="form-group row">
                    <div class="col-lg-4">
                        <label><strong>Start Year</strong></label>
                        <select class="form-control select2" style="width: 100%;" id='start_date' name='start_date' required>
                            <?php
                            $year = date("Y") - 4;
                            for ($i = 1; $i <= 4; $i++) { ?>
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
                        <label><strong>End Year</strong></label>
                        <select class="form-control select2" style="width: 100%;" id='end_date' name='end_date' required>
                            <?php
                            $year2 = date("Y");
                            for ($i = 0; $i <= 4; $i++) { ?>
                                <option value='<?php echo $year2; ?>' <?php if ($year2 == date("Y")) {
                                                                            echo 'selected';
                                                                        } ?>>
                                    <?php echo $year2; ?></option>;
                            <?php
                                $year2++;
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
                                <button type="button" onclick="exportTableToExcel(this,'dt_entries','Financial-Statements')" class="btn btn-success btn-icon-split">
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
                            <img src="./assets/img/logo2.png" alt="logo" width="200"><br>
                            <!-- <h5><span id="company_label"></span></h5> -->
                            <h5>Financial Statements</h5>
                            <strong> <span id='covered_date_label'></span></strong>
                        </center>
                        <br>
                        <div class="table-responsive" id="financial_report">
                            <table class="table table-bordered table-hover cell-border" id="dt_entries" width="100%" cellspacing="0">
                                <thead style="background: #1f384b;">
                                    <tr>

                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr style="font-size: 15px;">
                                        <th style="text-align:right;">TOTAL:</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
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

    function setTH() {
        $("#dt_entries>thead>tr").html("<th style='color:#fff;'>CHART</th>");
        $("#dt_entries>tfoot>tr").html("<th style='text-align:right;'>TOTAL</th>");

        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();
        var y = (end_date - start_date) + 1;
        var i = 0;
        var year = start_date;
        while (i < y) {
            $("#dt_entries>thead>tr").append("<th style='color:#fff;text-align:right;'>" + year + "</th>");
            $("#dt_entries>tfoot>tr").append("<th style='text-align:right;'></th>");
            year++;
            i++;
        }
    }


    function getReport() {
        setTH();
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();
        var start_d = new Date(start_date);
        var end_d = new Date(end_date);

        var options = {
            year: 'numeric',
        };

        $("#covered_date_label").html("PERIOD COVERED " + start_d.toLocaleDateString('en-US', options).toUpperCase() + " TO " + end_d.toLocaleDateString('en-US', options).toUpperCase());

        $("#financial_report").html("<center><h3><span class='fa fa-spinner fa-spin'></span> Loading ...</h3></center>");

        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=" + route_settings.class_name + "&q=show",
            data: {
                input: {
                    start_date: start_date,
                    end_date:end_date
                }
            },
            success: function(data) {
                $("#financial_report").html(data.replace('{"data":null}', ''));

            }
        });

    }

    $(document).ready(function() {
        getReport();
    });
</script>