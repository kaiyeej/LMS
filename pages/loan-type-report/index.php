<section class="section">
    <div class="section-header">
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Reports</a></div>
            <div class="breadcrumb-item">Loan Type</div>
        </div>
    </div>

    <div class="section-body">
        <div class="alert alert-light alert-has-icon" style="border: 1px dashed #3C84AB;">
            <form id='frm_generate'>
                <div class="form-group row">
                    <div class="col col_date">
                        <label><strong>Start Date</strong></label>
                        <div>
                            <input type="date" required class="form-control" value="<?php echo date('Y-m-01', strtotime(date("Y-m-d"))); ?>" id="start_date" name="input[start_date]">
                        </div>
                    </div>
                    <div class="col col_date">
                        <label><strong>End Date</strong></label>
                        <div>
                            <input type="date" required class="form-control" value="<?php echo date('Y-m-t', strtotime(date("Y-m-d"))) ?>" id="end_date" name="input[end_date]">
                        </div>
                    </div>
                    <div class="col">
                        <label><strong>Loan Type</strong></label>
                        <div>
                            <select class="form-control form-control-sm select2" required id="loan_type_id" name="input[loan_type_id]">
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <label>&nbsp;</label>
                        <div>
                            <div class="btn-group pull-right">
                                <button type="submit" id="btn_generate" class="btn btn-primary btn-icon-split">
                                    <span class="icon">
                                        <i class="ti ti-reload"></i>
                                    </span>
                                    <span class="text"> Generate</span>
                                </button>
                                <button type="button" onclick="exportTableToExcel(this,'dt_entries','Loan-Type-Report')" class="btn btn-success btn-icon-split">
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
                    <div class="col-lg-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="date_range" onchange="setDateRange()" class="custom-control-input" id="date_range">
                            <label style="font-size: 12px;" class="custom-control-label" for="date_range">Hide Date Range</label>
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
                            <h5>Loan Type Report</h5><br>
                        </center>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dt_entries" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Client</th>
                                        <th>Reference #</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th style="text-align:right">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="5" style="text-align:right">Total:</th>
                                        <th><span id="span_total"></span></th>
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

    function setDateRange(){
        if($("#date_range").prop("checked")){
            $(".col_date").hide();
        }else{
            $(".col_date").show();
        }
    }


    function getReport() {
        var loan_type_id = $("#loan_type_id").val();
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();
        if($("#date_range").prop("checked")){
            var date_range = 1;
        }else{
            var date_range = 0;
        }
        $("#dt_entries").DataTable().destroy();
        $("#dt_entries").DataTable({
            "processing": true,
            "searching": false,
            "paging": false,
            "ordering": false,
            "info": false,
            "ajax": {
                "url": "controllers/sql.php?c=" + route_settings.class_name + "&q=view",
                "dataSrc": "data",
                "method": "POST",
                "data": {
                    input: {
                        loan_type_id: loan_type_id,
                        start_date: start_date,
                        end_date: end_date,
                        report_type: "type",
                        date_range:date_range
                    }
                },
            },
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api();

                // Remove the formatting to get integer data for summation
                var intVal = function(i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '') * 1 :
                        typeof i === 'number' ?
                        i : 0;
                };

                debitTotal = api
                    .column(5, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(5).footer()).html(
                    "&#x20B1; " + debitTotal.toLocaleString('en-US', {
                        minimumFractionDigits: 2
                    })
                );


            },
            "columns": [{
                    "data": "loan_date"
                },
                {
                    "data": "client"
                },
                {
                    "data": "reference_number"
                },
                {
                    "data": "loan_type"
                },
                {
                    "mRender": function(data, type, row) {
                        return row.status == "P" ? '<a href="#" class="badge badge-light">Pending</a>' : row.status == "A" ? '<a href="#" class="badge badge-success">Approved</a>' : row.status == "R" ? '<a href="#" class="badge badge-info">Released</a>' : row.status == "F" ? '<a href="#" class="badge badge-primary">Fully Paid</a>' : '<a href="#" class="badge badge-danger">Denied</a>';
                    }
                },
                {
                    "data": "amount",
                    className: "text-right"
                },

            ]

        });

    }

    $(document).ready(function() {
        getSelectOption('LoanTypes', 'loan_type_id', 'loan_type', '', [], -1, 'All');
        getReport();
    });
</script>