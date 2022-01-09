<?php
include("../conexion.php");
$id         = $_POST['id'];
$cedula     = $_POST['cedula'];
$nombres    = $_POST['nombres'];
$apellidos  = $_POST['apellidos'];
$sql = $con->query("UPDATE estudiantes SET cedula = '$cedula', nombres = '$nombres', apellidos = '$apellidos' WHERE id = '$id'");
?>