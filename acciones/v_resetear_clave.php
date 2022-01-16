<?php
include("../conexion.php");
$usuario    = $_POST['usuario'];
$clave      = md5($_POST['clave']);
$con->query("UPDATE usuarios SET clave = '$clave' WHERE usuario = '$usuario'");
?>