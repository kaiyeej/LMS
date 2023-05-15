<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="./">LMS</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="./">LMS</a>
    </div>
    <!-- <ul class="sidebar-menu">
        <li><a class="nav-link" href="homepage"><i class="fas fa-th-large"></i> <span>Dashboard</span></a></li>
        <li class="menu-header">Master Data</li>
        <li><a class="nav-link" href="clients"><i class="fas fa-address-card"></i> <span>Clients</span></a></li>
        <li><a class="nav-link" href="loan-types"><i class="fas fa-list"></i> <span>Loan Types</span></a></li>
        <li><a class="nav-link" href="insurance"><i class="fas fa-shield-alt"></i> <span>Insurance</span></a></li>
        <li><a class="nav-link" href="suppliers"><i class="fas fa-address-book"></i> <span>Suppliers</span></a></li>

        <li class="menu-header">Transactions</li>
        <li><a class="nav-link" href="loans"><i class="fa fa-folder"></i> <span>Loans</span></a></li>
        <li><a class="nav-link" href="collections"><i class="fas fa-money-bill-wave"></i> <span>Collections</span></a></li>
        <li><a class="nav-link" href="vouchers"><i class="fas fa-money-check"></i> <span>Vouchers</span></a></li>
        <li class="dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i> <span>Menu 3</span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link" href="submenu1">Submenu 1</a></li>
                <li><a class="nav-link" href="submenu2">Submenu 2</a></li>
            </ul>
        </li>
        
        <li class="menu-header">Accounting</li>
        <li><a class="nav-link" href="chart-of-accounts"><i class="fas fa-clipboard-list"></i> <span>Chart of Accounts</span></a></li></li>
        <li><a class="nav-link" href="journals"><i class="fas fa-bookmark"></i> <span>Journals</span></a></li></li>
        <li><a class="nav-link" href="journal-entry"><i class="fa fa-book"></i> <span>Journal Entry</span></a></li></li>

        <li class="menu-header">Reports</li>
        <li><a class="nav-link" href="accounts-receivable"><i class="fas fa-chart-bar"></i> <span>Accounts Receivables</span></a></li>
        <li><a class="nav-link" href="receivable-ledger"><i class="fas fa-chart-bar"></i> <span>AR Ledger</span></a></li>
        <li><a class="nav-link" href="collection-report"><i class="fas fa-file-invoice-dollar"></i> <span>Collection Report</span></a></li>
        <li class="dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-list-ul"></i> <span>Loan Report</span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link" href="loan-status-report">Loan Status</a></li>
                <li><a class="nav-link" href="loan-type-report">Loan Type</a></li>
            </ul>
        </li>
        <li><a class="nav-link" href="statement-of-accounts"><i class="fas fa-file-alt"></i> <span>Statement of Accounts</span></a></li>

        <li class="menu-header">Security</li>
        <li><a class="nav-link" href="users"><i class="fas fa-user-cog"></i> <span>Users</span></a></li>
    </ul> -->
    <ul class="sidebar-menu">
    <?php
        $Menus = new Menus();

        $Menus->sidebar('Dashboard', 'homepage', 'fas fa-th-large');

        // MASTER DATA
        echo '<li class="menu-header">Master Data</li>';
        $Menus->sidebar('Clients', 'clients', 'fas fa-address-card');
        $Menus->sidebar('Loan Types', 'loan-types', 'fas fa-list');
        $Menus->sidebar('Insurance', 'insurance', 'fas fa-shield-alt');
        $Menus->sidebar('Suppliers', 'suppliers', 'fas fa-address-book');


        // TRANSACTION
        echo '<li class="menu-header">Transactions</li>';
        $Menus->sidebar('Loans', 'loans', 'fa fa-folder');
        $Menus->sidebar('Collections', 'collections', 'fas fa-money-bill-wave');
        $Menus->sidebar('Vouchers', 'vouchers', 'fas fa-money-check');

        //REPORTS
        echo '<li class="menu-header">Reports</li>';
        $Menus->sidebar('Accounts Receivables', 'accounts-receivable', 'fas fa-chart-bar');
        $Menus->sidebar('AR Ledger', 'receivable-ledger', 'fas fa-chart-bar');
        $Menus->sidebar('Collection Report', 'collection-report', 'fas fa-file-invoice-dollar');
        $Menus->sidebar_parent('Loan Report', 'fas fa-list-ul', array(
            array('Loan Status', 'loan-status-report'),
            array('Loan Type', 'loan-type-report'),
        ));
        $Menus->sidebar('Statement of Accounts', 'statement-of-accounts', 'fas fa-file-alt');


        // ADMIN
        echo '<li class="menu-header">Security</li>';
        $Menus->sidebar('User Accounts', 'users', 'fas fa-user-cog');
    ?>
        <br>
    </ul>
</aside>