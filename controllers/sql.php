<?php
include '../core/config.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

$api_methods = array(
    'LoanUploads->save_upload',
    'MassCollections->save_collections',
    'MassCollections->finish_collections'
);

$query = $_GET['q'];
$class = $_GET['c'];

$Instance = $class . "->" . $query;

if (in_array($Instance, $api_methods)) {
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    $inputs =  json_decode(file_get_contents('php://input'), TRUE);
} else {
    $inputs = isset($_POST['input']) ? $_POST['input'] : "";
}

$ClassName = new $class;
$ClassName->inputs = $inputs;

$response = array();
$response['data'] = $ClassName->$query();

echo json_encode($response);
