<?php
include("../conexion.php");
$id = $_POST['id'];
$con->query("DELETE FROM trabajos_jurados WHERE trabajo_id = '$id'");
$con->query("DELETE FROM trabajos WHERE id = '$id'");
?>