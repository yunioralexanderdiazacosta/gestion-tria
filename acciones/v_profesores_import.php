<?php
include("../conexion.php");

$data = json_decode($_POST['profesores']);
if (is_array($data)) {
    foreach($data as $value){
        $cedula     = trim($value->cedula);
        $nombres    = trim($value->nombres);
        $apellidos  = trim($value->apellidos);
        $encontrado = $con->query("SELECT id FROM profesores WHERE cedula = '$cedula' LIMIT 1");
        if(mysqli_num_rows($encontrado) < 1){
            $con->query("INSERT INTO profesores (cedula, nombres, apellidos) VALUES ('$cedula', '$nombres', '$apellidos')");
        }
    }
}
?>