<?php
include("../conexion.php");
$id     = $_POST['id'];
$nombre = $_POST['nombre'];
$sql = $con->query("DELETE FROM periodos WHERE id = '$id'");
?>