<?php
include("../conexion.php");
$codigo     = $_POST['codigo'];
$nombre     = $_POST['nombre'];
$con->query("INSERT INTO carreras (codigo, nombre) VALUES ('$codigo', '$nombre')");
?>