<section class="section">
    <div class="section-header">
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Reports</a></div>
            <div class="breadcrumb-item">Statement of Accounts</div>
        </div>
    </div>

    <div class="section-body">
        <div class="alert alert-light alert-has-icon" style="border: 1px dashed #3C84AB;">
            <form id='frm_generate'>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label><strong>Client</strong></label>
                        <select style="width:100%;" class="form-control form-control-sm select2" required id="client_id" name="input[client_id]">
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
                                <button type="button" onclick="exportTableToExcel(this,'dt_entries','Statement-of-Accounts')" class="btn btn-success btn-icon-split">
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
                            <!-- <div class="col-md-4">
                                <ul class="list-group">
                                    <li class="list-group-item">Date: <strong><span class="span_details" id="loan_date"></span></strong></li>
                                    <li class="list-group-item">Loan type: <strong><span class="span_details" id="loan_type"></span></strong></li>
                                    <li class="list-group-item">Loan Terms: <strong><span class="span_details" id="loan_period"></span></strong></li>
                                    <li class="list-group-item">Amount: <strong><span class="span_details" id="amount"></span></strong></li>
                                    <li class="list-group-item">Status: <strong><span class="span_details" id="span_status"></span></strong></li>
                                </ul>
                            </div> -->
                            <div class="col-md-12 table-responsive">
                                <center>
                                    <h5>Statement of Accounts</h5>
                                    <h6><span class="span_details" id="client"></span></h6>
                                    <h6><span class="span_details" id="reference_number"></span></h6>
                                </center>
                                <table class="table table-bordered" id="dt_entries" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>PAYMENT DATE</th>
                                            <th>PAYMENT</th>
                                            <th>INTEREST AMOUNT</th>
                                            <th>PENALTY</th>
                                            <th>APPLICABLE TO PRINCIPAL</th>
                                            <th>BALANCE OUTSTANDING</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th colspan="3"></th>
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
        var loan_id = $("#loan_id").val();
        var param = "loan_id= '"+loan_id+"' ";
        $("#dt_entries").DataTable().destroy();
        $("#dt_entries").DataTable({
            "processing": true,
            "searching": false,
            "paging": false,
            "ordering": false,
            "info": false,
            "ajax": {
                "url": "controllers/sql.php?c=" + route_settings.class_name + "&q=statement_of_accounts",
                "dataSrc": "data",
                "method": "POST",
                "data": {
                    input: {
                        param: param
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


                payment_total = api
                    .column(1, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(1).footer()).html(
                    "&#x20B1; " + payment_total.toLocaleString('en-US', {
                        minimumFractionDigits: 2
                    })
                );

                interest_total = api
                    .column(2, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(2).footer()).html(
                    "&#x20B1; " + interest_total.toLocaleString('en-US', {
                        minimumFractionDigits: 2
                    })
                );


            },
            "columns": [{
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


    function getDetails(id) {
        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=Loans&q=view",
            data: {
                input: {
                    id: id
                }
            },
            success: function(data) {
                var jsonParse = JSON.parse(data);
                const json = jsonParse.data;

                $('.span_details').map(function() {
                    //console.log(this.id);
                    const id_name = this.id;
                    this.innerHTML = json[id_name];
                });
            }
        });
    }

    $(document).ready(function() {
        getSelectOption('Loans', 'loan_id', 'loan_account', '', ['client']);

    });
</script>