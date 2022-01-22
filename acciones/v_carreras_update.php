<?php
include("../conexion.php");
$id         = $_POST['id'];
$codigo     = $_POST['codigo'];
$nombre     = $_POST['nombre'];
$carrera_id = $_POST['carrera'];
$sql = $con->query("UPDATE carreras SET codigo = '$codigo', nombre = '$nombre' WHERE id = '$id'");
?>