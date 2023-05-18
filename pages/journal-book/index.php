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
                        <label><strong>Journal</strong></label>
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
                                <button type="button" onclick="exportTableToExcel(this,'dt_entries','Loan-Status-Report')" class="btn btn-success btn-icon-split">
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
                            <h5>Journal Book</h5><br>
                        </center>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dt_entries" width="100%" cellspacing="0">
                                <thead style="background: #1f384b;">
                                    <tr>
                                        <th style="color:#fff;">DATE</th>
                                        <th style="color:#fff;">GENERAL REFERENCE</th>
                                        <th style="color:#fff;">ACCOUNT</th>
                                        <th style="color:#fff;">DEBIT</th>
                                        <th style="color:#fff;">CREDIT</th>
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

    function getReport() {
        var journal_id = $("#journal_id").val();
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();

        $("#jb_report").html("<tr><td colspan='5'><center><h3><span class='fa fa-spinner fa-spin'></span> Loading ...</h3></center></td></tr>");

        $.ajax({
            type: "POST",
            url: "controllers/sql.php?c=" + route_settings.class_name + "&q=journal_book",
            data: {
                input: {
                    start_date: start_date,
                    end_date:end_date,
                    journal_id:journal_id
                }
            },
            success: function(data) {
                $("#jb_report").html(data.replace('{"data":null}', ''));

            }
        });
        
    }

    $(document).ready(function() {
        getSelectOption('Journals', 'journal_id', 'journal_name', '', ['journal_code']);
        getReport();
    });
</script>