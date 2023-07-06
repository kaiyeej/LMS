<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

$uploadedFile = $_FILES['excel_file']['tmp_name'];
$spreadsheet = IOFactory::load($uploadedFile);
$sheetNames = $spreadsheet->getSheetNames();

$data = [];

foreach ($sheetNames as $sheetName) {
	$worksheet = $spreadsheet->getSheetByName($sheetName);
	$sheetData = $worksheet->toArray(null, true, true, true);
	$data[$sheetName] = $sheetData;
}
$response['sheets'] = $data;
return $response;
