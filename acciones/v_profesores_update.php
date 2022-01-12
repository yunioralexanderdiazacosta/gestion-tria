<?php
include("../conexion.php");
$id         = $_POST['id'];
$cedula     = $_POST['cedula'];
$nombres    = ucwords($_POST['nombres']);
$apellidos  = ucwords($_POST['apellidos']);
$sql = $con->query("UPDATE profesores SET cedula = '$cedula', nombres = '$nombres', apellidos = '$apellidos' WHERE id = '$id'");
?>