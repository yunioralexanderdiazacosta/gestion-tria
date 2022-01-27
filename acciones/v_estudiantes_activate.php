<?php
include("../conexion.php");
$id     = $_POST['id'];
$sql    = $con->query("UPDATE estudiantes SET estatus = 1 WHERE id = '$id'");
?>