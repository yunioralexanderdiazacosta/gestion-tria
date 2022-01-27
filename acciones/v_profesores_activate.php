<?php
include("../conexion.php");
$id     = $_POST['id'];
$sql    = $con->query("UPDATE profesores SET estatus = 1 WHERE id = '$id'");
?>