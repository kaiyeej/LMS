<!-- 

$request = $_SERVER['REQUEST_URI'];

/** SET ROUTES HERE */
// insert routes alphabetically
$routes = array(
    "homepage" => array(
        'class_name' => 'Homepage',
        'has_detail' => 0
    ),
    "suppliers" => array(
        'class_name' => 'Suppliers',
        'has_detail' => 0
    ),
    "clients" => array(
        'class_name' => 'Clients',
        'has_detail' => 0
    ),
    "client-update" => array(
        'class_name' => 'Clients',
        'has_detail' => 0
    ),
    "loan-types" => array(
        'class_name' => 'LoanTypes',
        'has_detail' => 0
    ),
    "loans" => array(
        'class_name' => 'Loans',
        'has_detail' => 0
    ),
    "users" => array(
        'class_name' => 'Users',
        'has_detail' => 0
    ),
    "insurance" => array(
        'class_name' => 'Insurance',
        'has_detail' => 0
    ),
    "collections" => array(
        'class_name' => 'Collections',
        'has_detail' => 0
    ),
    "vouchers" => array(
        'class_name' => 'Vouchers',
        'has_detail' => 1
    ),
    //ACCOUNTING
    "journals" => array(
        'class_name' => 'Journals',
        'has_detail' => 0
    ),
    "chart-of-accounts" => array(
        'class_name' => 'ChartOfAccounts',
        'has_detail' => 0
    ),
    "journal-entry" => array(
        'class_name' => 'JournalEntry',
        'has_detail' => 1
    ),
    //REPORTS
    "receivable-ledger" => array(
        'class_name' => 'ReceivableLedger',
        'has_detail' => 0
    ),
    "loan-status-report" => array(
        'class_name' => 'LoanReport',
        'has_detail' => 0
    ),
    "loan-type-report" => array(
        'class_name' => 'LoanReport',
        'has_detail' => 0
    ),
    "collection-report" => array(
        'class_name' => 'Collections',
        'has_detail' => 0
    ),
    "statement-of-accounts" => array(
        'class_name' => 'StatementOfAccounts',
        'has_detail' => 0
    ),
);
/** END SET ROUTES */ -->

<?php

$request = $_SERVER['REQUEST_URI'];

$base_folder = "pages/";
$page = str_replace("/" . APP_FOLDER . "/", "", $request);

// chec if has parameters
if (substr_count($page, "?") > 0) {
    $url_params = explode("?", $page);
    $dir = $base_folder . $url_params[0] . '/index.php';
    //$param = $url_params[1];
    $page = $url_params[0];
} else {

    if ($page == "" || $page == null) {
        $page = "homepage";
    }
    $dir = $base_folder . $page . '/index.php';
}

$Menus = new Menus();
$Menus->routes($page, $dir);

require_once $Menus->dir;
$route_settings = json_encode($Menus->route_settings);
