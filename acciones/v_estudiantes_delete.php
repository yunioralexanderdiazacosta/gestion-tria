<?php
include("../conexion.php");
$id     = $_POST['id'];
$sql_count_trabajos = $con->query("SELECT id FROM trabajos WHERE estudiante_id = '$id'");
if(mysqli_num_rows($sql_count_trabajos) < 1){
    $sql = $con->query("DELETE FROM estudiantes WHERE id = '$id'");
}else{
    $sql = $con->query("UPDATE estudiantes SET estatus = 0 WHERE id = '$id'");
}
?>