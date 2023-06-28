<style>
    table {
        display: block;
        overflow-x: auto;
        overflow-y: auto;
        max-height: 800px;
        font-size: 12px;
    }

    .div1 table {
        border-spacing: 0;
    }

    .div1 th {
        border-left: none;
        border-right: 1px solid #bbbbbb;
        padding: 8px;
        width: 100px;
        min-width: 100px;
        position: sticky;
        top: 0;
        background: #1f384b;
        color: #e0e0e0;
    }

    .div1 td {
        border-left: none;
        border-right: 1px solid #bbbbbb;
        border-bottom: 1px solid #bbbbbb;
        padding: 8px;
        width: 100px;
        min-width: 100px;
    }

    /* .div1 th:nth-child(1), */
    .div1 td:nth-child(1) {
        position: sticky;
        left: 0;
        width: 300px;
        min-width: 300px;
    }


    .div1 td:nth-child(1) {
        background: #ffebb5;
    }

    /* .div1 th:nth-child(1) {
        z-index: 2;
    } */

    .div1 td:nth-child(1) {
        z-index: 2;
    }

    thead {
        position: sticky;
        top: 0;
        border-bottom: 2px solid #ccc;
        z-index: 999999;
    }

    tfoot {
        position: sticky;
        bottom: 0;
        border-top: 2px solid #ccc;
        z-index: 999999;
    }
</style>
<section class="section">
    <div class="section-header">
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Accounting</a></div>
            <div class="breadcrumb-item">Cash Positioning</div>
        </div>
    </div>

    <div class="section-body">
        <div class="alert alert-light alert-has-icon" style="border: 1px dashed #3C84AB;">
            <form id='frm_generate'>
                <div class="form-group row">
                    <div class="col-lg-4">
                        <label><strong>Start Date</strong></label>
                        <div>
                            <input type="date" required class="form-control" value="<?php echo date('Y-m-01', strtotime(date("Y-m-d"))); ?>" id="start_date" name="input[start_date]">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <label><strong>End Date</strong></label>
                        <div>
                            <input type="date" required class="form-control" value="<?php echo date('Y-m-t', strtotime(date("Y-m-d"))) ?>" id="end_date" name="input[end_date]">
                        </div>
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
                                <button type="button" onclick="exportTableToExcel(this,'dt_entries','Trial-Balance')" class="btn btn-success btn-icon-split">
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
                            <h5>Cash Positioning</h5>
                            <strong> <span id='covered_date_label'></span></strong>
                        </center>
                        <br>
                        <div id="trial_balance_report">

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
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();
        var start_d = new Date(start_date);
        var end_d = new Date(end_date);

        var options = {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };

        $("#covered_date_label").html("PERIOD COVERED " + start_d.toLocaleDateString('en-US', options).toUpperCase() + " TO " + end_d.toLocaleDateString('en-US', options).toUpperCase());

        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=" + route_settings.class_name + "&q=show",
            data: {
                input: {
                    start_date: start_date,
                    end_date: end_date
                }
            },
            success: function(data) {
                $("#trial_balance_report").html(data.replace('{"data":null}', ''));
                // $("tfoot").html("<td>Total:</td>");
                var sums = []
                $("table tbody tr").each(function() {
                    $(this).find("td").each(function(i, x) {
                        if ($(x).html().length) {
                            var tdValue = parseInt($(x).html().replaceAll(',', ''));
                            tdValue = (tdValue + parseInt(sums[i] == undefined ? 0 : sums[i]))
                            sums[i] = tdValue
                        }
                    })
                })
                $.each(sums, function(i, x) {
                    if(i == 0){
                        $("tfoot").append("<td style='background: #1f384b;'>Total</td>")
                    }else{
                        total = x == undefined ? 0.00 : x;
                        $("tfoot").append("<td>" + total.toLocaleString() + "</td>")
                    }
                    
                })

            }
        });
    }

    $(document).ready(function() {
        getReport();
        // $("#company_label").html(company_name);
    });
</script>