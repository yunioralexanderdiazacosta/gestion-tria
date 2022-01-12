<?php
include("../conexion.php");
$id    = $_POST['id'];
$con->query("DELETE FROM trabajos_jurados WHERE id = '$id'");
?>