<style>
tr{
    border: 1px solid #ede6e6;

}    
</style>

<section class="section">
    <div class="section-header">
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Accounting</a></div>
            <div class="breadcrumb-item">Journal Book</div>
        </div>
    </div>

    <div class="section-body">
        <div class="alert alert-light alert-has-icon" style="border: 1px dashed #3C84AB;">
            <form id='frm_generate'>
                <div class="form-group row">
                    <div class="col-lg-3">
                        <label><strong>Start Date</strong></label>
                        <div>
                            <input type="date" required class="form-control" value="<?php echo date('Y-m-01', strtotime(date("Y-m-d"))); ?>" id="start_date" name="input[start_date]">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <label><strong>End Date</strong></label>
                        <div>
                            <input type="date" required class="form-control" value="<?php echo date('Y-m-t', strtotime(date("Y-m-d"))) ?>" id="end_date" name="input[end_date]">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <label><strong style="color:red;">*</strong> <strong>Journal</strong></label>
                        <select class="form-control select2 input-item" id="journal_id" name="input[journal_id]" style="width:100%;" required>
                        </select>
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
                                <button type="button" onclick="exportTableToExcel(this,'dt_entries','Journal-Book')" class="btn btn-success btn-icon-split">
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
                            <h5>Journal Book</h5>
                            <strong><h6 id="journal_label"></h6></strong>
                            <strong> <span id='covered_date_label'></span></strong>
                        </center>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dt_entries" width="100%">
                                <thead style="background: #1f384b;">
                                    <tr>
                                        <th style="color:#fff;">Date</th>
                                        <th style="color:#fff;">General Reference</th>
                                        <th style="color:#fff;">Account</th>
                                        <th style="color:#fff;">Debit</th>
                                        <th style="color:#fff;">Credit</th>
                                    </tr>
                                </thead>
                                <tbody id="jb_report">
                                </tbody>
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

    // function getReport() {
    //     var journal_id = $("#journal_id").val();
    //     var start_date = $("#start_date").val();
    //     var end_date = $("#end_date").val();

    //     $("#jb_report").html("<tr><td colspan='5'><center><h3><span class='fa fa-spinner fa-spin'></span> Loading ...</h3></center></td></tr>");

    //     $.ajax({
    //         type: "POST",
    //         url: "controllers/sql.php?c=" + route_settings.class_name + "&q=journal_book",
    //         data: {
    //             input: {
    //                 start_date: start_date,
    //                 end_date:end_date,
    //                 journal_id:journal_id
    //             }
    //         },
    //         success: function(data) {
    //             $("#jb_report").html(data.replace('{"data":null}', ''));

    //         }
    //     });
        
    // }

    function getReport() {
        var journal_id = $("#journal_id").val();
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
        
        $("#dt_entries").DataTable().destroy();
        $("#dt_entries").DataTable({
            "processing": true,
            "searching": false,
            "paging": false,
            "ordering": false,
            "info": false,
            "ajax": {
                "url": "controllers/sql.php?c=" + route_settings.class_name + "&q=journal_book",
                "dataSrc": "data",
                "method": "POST",
                "data": {
                    input: {
                        journal_id: journal_id,
                        start_date: start_date,
                        end_date: end_date,
                    }
                },
            },
            // "footerCallback": function(row, data, start, end, display) {
            //     var api = this.api();

            //     // Remove the formatting to get integer data for summation
            //     var intVal = function(i) {
            //         return typeof i === 'string' ?
            //             i.replace(/[\$,]/g, '') * 1 :
            //             typeof i === 'number' ?
            //             i : 0;
            //     };

            //     debitTotal = api
            //         .column(5, {
            //             page: 'current'
            //         })
            //         .data()
            //         .reduce(function(a, b) {
            //             return intVal(a) + intVal(b);
            //         }, 0);

            //     // Update footer
            //     $(api.column(5).footer()).html(
            //         "&#x20B1; " + debitTotal.toLocaleString('en-US', {
            //             minimumFractionDigits: 2
            //         })
            //     );


            // },
            "columns": [{
                    "data": "date"
                },
                {
                    "data": "general_reference"
                },
                {
                    "data": "account"
                },
                {
                    "data": "debit",
                    className: "text-right"
                },
                {
                    "data": "credit",
                    className: "text-right"
                },

            ]

        });
        var optionSelected = $("#journal_id").find('option:selected').attr('journal_name');
        
        $("#journal_label").html(optionSelected);

    }

    $(document).ready(function() {
        getSelectOption('Journals', 'journal_id', 'journal_name', '', ['journal_name']);
        getReport();
    });
</script>