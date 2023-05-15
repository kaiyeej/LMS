<style>
    ul {
        list-style-type: none;
    }
</style>

<form method='POST' id='frm_privileges_submit' class="users">
    <div class="modal fade" id="modalPrivileges" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" style="margin-top: 10px;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalPrivilegesLabel"><span class='fa fa-pen'></span> User Privileges</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="input[user_id]" id="priv_user_id">
                    <div class="row">
                        <div class="col-3">
                            <a class="nav-link" href="#">
                                <i class="ti ti-shopping-cart menu-icon"></i>
                                <span class="menu-title">Master Data</span>
                            </a>
                            <ul class="list-group" id="master_data_column"></ul>
                        </div>
                        <div class="col-3">
                            <a class="nav-link" href="#">
                                <i class="ti ti-shopping-cart menu-icon"></i>
                                <span class="menu-title">Transaction</span>
                            </a>
                            <ul class="list-group" id="transaction_column"></ul>
                        </div>
                        <div class="col-3">
                            <a class="nav-link" href="#">
                                <i class="ti ti-shopping-cart menu-icon"></i>
                                <span class="menu-title">Accounting</span>
                            </a>
                            <ul class="list-group" id="accounting_column"></ul>
                        </div>
                        <div class="col-3">
                            <a class="nav-link" href="#">
                                <i class="ti ti-shopping-cart menu-icon"></i>
                                <span class="menu-title">Reports</span>
                            </a>
                            <ul class="list-group" id="report_column"></ul>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn_submit_priv" class="btn btn-primary">
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<style>

</style>