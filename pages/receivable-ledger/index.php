<section class="section">
    <div class="section-header">
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Reports</a></div>
            <div class="breadcrumb-item">Accounts Ledger</div>
        </div>
    </div>

    <div class="section-body">
        <div class="alert alert-light alert-has-icon" style="border: 1px dashed #3C84AB;">
            <form id='frm_generate'>
                <div class="form-group row">
                    <div class="col-lg-3">
                        <label><strong>Client</strong></label>
                        <div>
                            <select class="form-control form-control-sm select2" required id="client_id" name="input[client_id]">
                                <option class="">&mdash; All &mdash; </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <label><strong>Start Date</strong></label>
                        <div>
                            <input type="date" class="form-control" id="start_date" name="input[start_date]">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <label><strong>End Date</strong></label>
                        <div>
                            <input type="date" class="form-control" id="end_date" name="input[end_date]">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <label>&nbsp;</label>
                        <div>
                            <div class="btn-group pull-right">
                                <button type="submit" id="btn_generate" class="btn btn-primary btn-icon-split">
                                    <span class="icon">
                                        <i class="ti ti-reload"></i>
                                    </span>
                                    <span class="text"> Generate</span>
                                </button>
                                <button type="button" onclick="exportTableToExcel(this,'dt_entries','Receivable-Ledger-Report')" class="btn btn-success btn-icon-split">
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
                            <h5>Receivable Ledger</h5><br>
                        </center>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dt_entries" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>DATE</th>
                                        <th>TRANSACTION</th>
                                        <th>REFERENCE #</th>
                                        <th style="text-align:right">DEBIT</th>
                                        <th style="text-align:right">CREDIT</th>
                                        <th style="text-align:right">BALANCE</th>
                                    </tr>
                                    <tr>
                                        <td style="text-align:right"><strong>Account:</strong></td>
                                        <td colspan="5"><span style="font-size:15px;font-weight: bold;" id="span_client"></span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" style="text-align:right"><strong>Balance Fowarded:</strong></td>
                                        <td><span id="span_balance_fowarded"></span></td>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" style="text-align:right">Summary:</th>
                                        <th></th>
                                        <th></th>
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
        getTotal();
    });


    function getTotal() {
        var client_id = $("#client_id").val();
        var start_date = $("#start_date").val() == "" ? 0 : $("#start_date").val();
        var end_date = $("#end_date").val() == "" ? 0 : $("#end_date").val();

        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=" + route_settings.class_name + "&q=total",
            data: {
                input: {
                    client_id: client_id,
                    start_date: start_date,
                    end_date: end_date
                }
            },
            success: function(data) {
                var json = JSON.parse(data);
                $("#span_balance_fowarded").html(json.data[0].toLocaleString('en-US', {
                    minimumFractionDigits: 2
                }));

                var bf_total = $(".bf_total").last().val();
                if (bf_total != undefined) {
                    $("#span_total").html(bf_total);
                } else {
                    $("#span_total").html(json.data[0].toLocaleString('en-US', {
                        minimumFractionDigits: 2
                    }));
                }
                
            }
        });
    }

    function getClient() {
        var optionSelected = $("#client_id").find('option:selected').attr('client_fullname');
        $("#span_client").html(optionSelected);
    }

    function getReport() {
        var client_id = $("#client_id").val();
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
                        client_id: client_id,
                        start_date: start_date,
                        end_date: end_date
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
                    .column(3, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(3).footer()).html(
                    "&#x20B1; " + debitTotal.toLocaleString('en-US', {
                        minimumFractionDigits: 2
                    })
                );

                creditTotal = api
                    .column(4, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(4).footer()).html(
                    "&#x20B1; " + creditTotal.toLocaleString('en-US', {
                        minimumFractionDigits: 2
                    })
                );

            },
            "columns": [{
                    "data": "date"
                },
                {
                    "data": "transaction"
                },
                {
                    "data": "reference_number"
                },
                {
                    "data": "debit",
                    className: "text-right"
                },
                {
                    "data": "credit",
                    className: "text-right"
                },
                {
                    "mRender": function(data, type, row) {
                        return row.balance + "<input type='hidden' class='bf_total' value='" + row.balance + "'>";

                    },
                    className: "text-right"
                },

            ]

        });

        getTotal();
        getClient();
    }

    $(document).ready(function() {
        getSelectOption('Clients', 'client_id', 'client_fullname', "", ['client_fullname']);
        getTotal();
    });
</script>