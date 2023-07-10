<?php
include '../core/config.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

$response = array();

if (isset($_POST['input'])) {
    $inputs = $_POST['input'];
} else {
    $inputs = "";
}

$query = $_GET['q'];
$class = $_GET['c'];

if($query == 'save_upload' && $class == 'Loans'){

    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    $inputs =  json_decode(file_get_contents('php://input'), TRUE);
}

$ClassName = new $class;
$ClassName->inputs = $inputs;


$response['data'] = $ClassName->$query();

echo json_encode($response);
