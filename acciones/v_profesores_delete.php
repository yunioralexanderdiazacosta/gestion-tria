<?php
include("../conexion.php");
$id     = $_POST['id'];
$sql    = $con->query("DELETE FROM profesores WHERE id = '$id'");
?>