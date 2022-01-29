<?php
include("../conexion.php");
$cedula     = $_POST['cedula'];
$encontrado = $con->query("SELECT id FROM estudiantes WHERE cedula = '$cedula' LIMIT 1");
if(mysqli_num_rows($encontrado) > 0 && $actual != $cedula){
    echo '1';
}else{
    echo '0';
}
?>