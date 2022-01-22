<?php
include("../conexion.php");
$id         = $_POST['id'];
$cedula     = $_POST['cedula'];
$nombres    = ucwords($_POST['nombres']);
$apellidos  = ucwords($_POST['apellidos']);
$carrera_id = $_POST['carrera'];
$sql = $con->query("UPDATE estudiantes SET cedula = '$cedula', nombres = '$nombres', apellidos = '$apellidos', carrera_id = '$carrera_id' WHERE id = '$id'");
?>