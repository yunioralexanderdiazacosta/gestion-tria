<?php
include("../conexion.php");
$profesor_id    = $_POST['profesor_id'];
$trabajo_id     = $_POST['trabajo_id'];
$count          = $con->query("SELECT id FROM trabajos_jurados WHERE profesor_id = '$profesor_id' AND trabajo_id = '$trabajo_id'");
if(mysqli_num_rows($count) < 1){
    $con->query("INSERT INTO trabajos_jurados (profesor_id, trabajo_id) VALUES ('$profesor_id', '$trabajo_id')");
}
?>