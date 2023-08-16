<?php
class Menus extends Connection
{
    public $current_url;
    public $menus;
    public $dir;
    public $route_settings;

    public function lists()
    {
        $this->menus = array(
            'master-data' => array(
                array('url' => 'branches', 'name' => 'Branches', 'class_name' => 'Branches', 'has_detail' => 0),
                array('url' => 'client-types', 'name' => 'Client Types', 'class_name' => 'ClientTypes', 'has_detail' => 0),
                // array('url' => 'expense-category', 'name' => 'Expense Category', 'class_name' => 'ExpenseCategory', 'has_detail' => 0),
                array('url' => 'clients', 'name' => 'Clients', 'class_name' => 'Clients', 'has_detail' => 0), array('url' => 'client-update', 'name' => 'Client Profile', 'class_name' => 'Clients', 'has_detail' => 0),

                array('url' => 'employers', 'name' => 'Employers', 'class_name' => 'Employers', 'has_detail' => 0),
                array('url' => 'loan-types', 'name' => 'Loan Types', 'class_name' => 'LoanTypes', 'has_detail' => 0),
                array('url' => 'insurance', 'name' => 'Insurance', 'class_name' => 'Insurance', 'has_detail' => 0),
                array('url' => 'suppliers', 'name' => 'Suppliers', 'class_name' => 'Suppliers', 'has_detail' => 0),
            ),
            'transaction' => array(
                array('url' => 'loans', 'name' => 'Loans', 'class_name' => 'Loans', 'has_detail' => 0),
                array('url' => 'collections', 'name' => 'Collections', 'class_name' => 'Collections', 'has_detail' => 0),
                // array('url' => 'expenses', 'name' => 'Disbursement', 'class_name' => 'Expenses', 'has_detail' => 1),
                array('url' => 'vouchers', 'name' => 'Vouchers', 'class_name' => 'Vouchers', 'has_detail' => 1),
            ),
            'report' => array(
                array('url' => 'accounts-receivable', 'name' => 'Accounts Receivable', 'class_name' => 'Loans', 'has_detail' => 0),
                array('url' => 'receivable-ledger', 'name' => 'Receivable Ledger', 'class_name' => 'ReceivableLedger', 'has_detail' => 0),
                array('url' => 'collection-report', 'name' => 'Collection Report', 'class_name' => 'Collections', 'has_detail' => 0),
                array('url' => 'loan-status-report', 'name' => 'Loan Status Report', 'class_name' => 'LoanReport', 'has_detail' => 0),
                array('url' => 'loan-type-report', 'name' => 'Loan Type Report', 'class_name' => 'LoanReport', 'has_detail' => 0),
                array('url' => 'statement-of-accounts', 'name' => 'Statement Of Accounts', 'class_name' => 'StatementOfAccounts', 'has_detail' => 0),
            ),
            'accounting' => array(
                // array('url' => 'cash-positioning', 'name' => 'Cash Positioning', 'class_name' => 'CashPositioning', 'has_detail' => 0),
                array('url' => 'chart-of-accounts', 'name' => 'Chart of Accounts', 'class_name' => 'ChartOfAccounts', 'has_detail' => 0),
                array('url' => 'chart-classification', 'name' => 'Chart Classification', 'class_name' => 'ChartClassification', 'has_detail' => 0),
                array('url' => 'journals', 'name' => 'Journals', 'class_name' => 'Journals', 'has_detail' => 0),
                array('url' => 'journal-entry', 'name' => 'Journal Entry', 'class_name' => 'JournalEntry', 'has_detail' => 1),
                array('url' => 'journal-book', 'name' => 'Journal Book', 'class_name' => 'JournalEntry', 'has_detail' => 0),
                array('url' => 'financial-statements', 'name' => 'Financial Statements', 'class_name' => 'FinancialStatements', 'has_detail' => 0),
                array('url' => 'income-statement', 'name' => 'Income Statement', 'class_name' => 'IncomeStatement', 'has_detail' => 0),
                array('url' => 'trial-balance', 'name' => 'Trial Balance', 'class_name' => 'ChartOfAccounts', 'has_detail' => 0),
            ),
            'security' => array(
                array('url' => 'user-categories', 'name' => 'User Categories', 'class_name' => 'UserCategories', 'has_detail' => 0),
                array('url' => 'users', 'name' => 'User Account', 'class_name' => 'Users', 'has_detail' => 0),
            ),
            'admin' => array(
                array('url' => 'log', 'name' => 'Logs', 'class_name' => 'Logs', 'has_detail' => 0),
            ),
            'user' => array(
                array('url' => 'profile', 'name' => 'Profile', 'class_name' => 'Profile', 'has_detail' => 0),
                array('url' => 'client-update', 'name' => 'Client Profile', 'class_name' => 'Clients', 'has_detail' => 0),
            ),
        );

        return $this->menus;
    }

    public function routes($page, $dir)
    {
        $this->lists();
        $levels = ['master-data', 'transaction', 'report', 'accounting', 'admin', 'user', 'security'];

        if ($page == 'homepage' || $page == 'profile') {
            $this->dir = $dir;
            $this->route_settings = [];
        } else if ($page == 'jcis-admin') {
            $this->dir = $dir;
            $this->route_settings = [];
        } else {
            $has_page = false;
            $main_column = '';
            foreach ($levels as $main_column_) {
                if (array_search($page, array_column($this->menus[$main_column_], 'url')) !== FALSE) {
                    $main_column = $main_column_;
                    $has_page = true;
                    break;
                }
            }
            if ($has_page) {
                $index = array_search($page, array_column($this->menus[$main_column], 'url'));
                $list_data = $this->menus[$main_column][$index];

                $UserPrivileges = new UserPrivileges();
                if ($UserPrivileges->check($page, $_SESSION['lms_user_category_id']) == 1) {
                    $this->dir = $dir;
                    $this->route_settings = [
                        'class_name' => $list_data['class_name'],
                        'has_detail' => $list_data['has_detail']
                    ];
                } else {
                    $this->dir = '403.php';
                    $this->route_settings = [];
                }
            } else {
                $this->dir = '404.php';
                $this->route_settings = [];
            }
        }
    }

    public function sidebar($name, $url, $ti)
    {
        $UserPrivileges = new UserPrivileges();
        if ($UserPrivileges->check($url, $_SESSION['lms_user_category_id']) == 1) {
            $is_active = $url == $this->current_url ? "class='active'" : "";
            echo '<li ' . $is_active . '><a class="nav-link" href="./' . $url . '"><i class="' . $ti . '"></i> <span>' . $name . '</span></a></li></li>';
        }
    }

    public function sidebar_parent($name, $ti, $child)
    {
        $UserPrivileges = new UserPrivileges();

        $ui = str_replace(' ', '', strtolower($name));
        $child_label = "";
        $has_active = 0;
        foreach ($child as $row) {
            if ($UserPrivileges->check($row[1], $_SESSION['lms_user_category_id']) == 1) {
                $is_active = $row[1] == $this->current_url ? "class='active'" : "";
                $has_active += $row[1] == $this->current_url ? 1 : 0;
                $child_label .=  '<li ' . $is_active . '><a class="nav-link" href="./' . $row[1] . '">' . $row[0] . '</a></li>';
            }
        }
        if ($child_label != '') {
            $is_parent_active = $has_active > 0 ? "active" : "";
            echo '<li class="dropdown ' . $is_parent_active . '">
                    <a href="#" class="nav-link has-dropdown"><i class="' . $ti . '"></i> <span>' . $name . '</span></a>
                    <ul class="dropdown-menu">
                        ' . $child_label . '
                    </ul>
                </li>';
        }
    }
}
