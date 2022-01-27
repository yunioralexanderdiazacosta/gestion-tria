<?php
include("../conexion.php");
$cedula     = $_POST['cedula'];
$nombres    = ucwords($_POST['nombres']);
$apellidos  = ucwords($_POST['apellidos']);
$carrera_id = $_POST['carrera'];
$con->query("INSERT INTO estudiantes (cedula, nombres, apellidos, carrera_id, estatus) VALUES ('$cedula', '$nombres', '$apellidos', '$carrera_id', 1)");
?>