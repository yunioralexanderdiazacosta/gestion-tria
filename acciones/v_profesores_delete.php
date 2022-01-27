<?php
include("../conexion.php");
$id = $_POST['id'];
$sql_asesor = $con->query("SELECT id FROM trabajos WHERE profesor_id = '$id'");
$sql_jurado = $con->query("SELECT id FROM trabajos_jurados WHERE profesor_id = '$id'");

if(mysqli_num_rows($sql_asesor) > 0 || mysqli_num_rows($sql_jurado) > 0){
    $sql = $con->query("UPDATE profesores SET estatus = 0 WHERE id = '$id'");
}else{
    $sql = $con->query("DELETE FROM profesores WHERE id = '$id'");
}
?>