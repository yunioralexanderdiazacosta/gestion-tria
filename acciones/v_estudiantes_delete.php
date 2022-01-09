<?php
include("../conexion.php");
$id     = $_POST['id'];
$sql    = $con->query("DELETE FROM estudiantes WHERE id = '$id'");
?>