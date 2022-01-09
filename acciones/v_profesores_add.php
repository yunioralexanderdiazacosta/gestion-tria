<?php
include("../conexion.php");
$cedula     = $_POST['cedula'];
$nombres    = $_POST['nombres'];
$apellidos  = $_POST['apellidos'];
$con->query("INSERT INTO profesores (cedula, nombres, apellidos) VALUES ('$cedula', '$nombres', '$apellidos')");
?>