<?php
include("../conexion.php");
$nombre = $_POST['nombre'];
if($_POST['actual'] == 'actual'){
    $con->query("UPDATE  periodos SET actual = 0");
    $actual = 1;
}else{
    $actual = 0;
}
$con->query("INSERT INTO periodos (nombre, actual) VALUES ('$nombre', '$actual')");
?>