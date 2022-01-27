<?php
include("../conexion.php");
$cedula     = $_POST['cedula'];
$nombres    = ucwords($_POST['nombres']);
$apellidos  = ucwords($_POST['apellidos']);
$con->query("INSERT INTO profesores (cedula, nombres, apellidos, estatus) VALUES ('$cedula', '$nombres', '$apellidos', 1)");
?>