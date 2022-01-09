<?php
include("../conexion.php");
$id     = $_POST['id'];
$nombre = $_POST['nombre'];
if($_POST['actual'] == 'actual'){
    $con->query("UPDATE periodos SET actual = 0");
    $actual = 1;
}else{
    $actual = 0;
}
$sql    = $con->query("UPDATE periodos SET nombre = '$nombre', actual = '$actual' WHERE id = '$id'");
?>