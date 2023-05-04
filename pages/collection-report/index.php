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
                <div class="row">
                    <div class="form-group col-md-6">
                        <label><strong>Account</strong></label>
                        <select style="width:100%;" class="form-control form-control-sm select2" required id="loan_id" name="input[loan_id]">
                        </select>
                    </div>
                    <div class="form-group col-md-6">
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
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="col-12 col-xl-12 card shadow mb-4">
                    <div id="report_container" class="card-body">

                        <div class="row">
                            <div class="col-md-4">
                                <ul class="list-group">
                                    <li class="list-group-item">Date:</li>
                                    <li class="list-group-item">Loan Type:</li>
                                    <li class="list-group-item">Loan Terms:</li>
                                    <li class="list-group-item">Due Date:</li>
                                    <li class="list-group-item">Amount:</li>
                                    <li class="list-group-item">Remarks:</li>
                                </ul>
                            </div>
                            <div class="col-md-8 table-responsive">
                                <center>
                                    <h5>Collection Report</h5>
                                    <h6>Account: </h6>
                                </center>
                                <table class="table table-bordered" id="dt_entries" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>DATE</th>
                                            <th>REFERENCE #</th>
                                            <th style="text-align:right">AMOUNT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="2" style="text-align:right">TOTAL:</th>
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
    </div>
</section>
<script type="text/javascript">
    $("#frm_generate").submit(function(e) {
        e.preventDefault();
        getReport();
    });


    function getReport() {
        var loan_type_id = $("#loan_type_id").val();
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();
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
                        report_type: "type"
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
                    "data": "collection_date"
                },
                {
                    "data": "reference_number"
                },
                {
                    "data": "loan_type"
                },
                {
                    "data": "amount",
                    className: "text-right"
                },

            ]

        });

    }

    $(document).ready(function() {
        getSelectOption('Loans', 'loan_id', 'loan_account');

    });
</script>