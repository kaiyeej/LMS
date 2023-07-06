<?php

ini_set('memory_limit', '-1');
ini_set('max_execution_time', 0);

require '../vendor/autoload.php';
include '../core/config.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

$uploadedFile = $_FILES['excel_file']['tmp_name'];
$spreadsheet = IOFactory::load($uploadedFile);
$sheetNames = $spreadsheet->getSheetNames();

$data = [];

foreach ($sheetNames as $sheetName) {
	$worksheet = $spreadsheet->getSheetByName($sheetName);
	$customer_name = $worksheet->getCell('A6')->getValue();
	// $sheetData = $worksheet->toArray(null, true, true, true);
	$sheetData = [
		'customer' => $customer_name
	];
	$data[] = $sheetData;
}
$response['sheets'] = $data;

echo json_encode($response);

class LoanExcel extends Connection
{
}
