<?php
ini_set('memory_limit', '2048M');
include("../conexion.php");
require_once '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$reader         = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
$spreadsheet    = $reader->load($_FILES['file']['tmp_name']);
$sheetData      = $spreadsheet->getActiveSheet()->toArray();
if (!empty($sheetData)) {
    for ($i=1; $i<count($sheetData); $i++) {
        $cedula     = $sheetData[$i][0];
        $nombres    = trim(ucwords($sheetData[$i][1]));
        $apellidos  = trim(ucwords($sheetData[$i][2]));
        $con->query("INSERT INTO profesores (cedula, nombres, apellidos) VALUES ('$cedula', '$nombres', '$apellidos')");
    }
    echo "<script>window.location='profesores.php';</script>";
}
?>