<?php
header('Content-type: application/json');
include("../conexion.php");
$id     = $_POST['id'];
$sql    = $con->query("SELECT * FROM carreras WHERE id='$id'");
$row    = mysqli_fetch_assoc($sql);
echo json_encode($row);
?>