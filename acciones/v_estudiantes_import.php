<?php
include("../conexion.php");

$data = json_decode($_POST['estudiantes']);
if (is_array($data)) {
    foreach($data as $value){
        $cedula     = trim($value->cedula);
        $nombres    = trim($value->nombres);
        $apellidos  = trim($value->apellidos);
        $carrera    = trim($value->carrera);
        $encontrado = $con->query("SELECT id FROM estudiantes WHERE cedula = '$cedula' LIMIT 1");
        if(mysqli_num_rows($encontrado) < 1){
            $sql = $con->query("SELECT id FROM carreras WHERE codigo = '$carrera'");
            $row = mysqli_fetch_assoc($sql);
            $carrera_id = $row['id'];
            $con->query("INSERT INTO estudiantes (cedula, nombres, apellidos, carrera_id) VALUES ('$cedula', '$nombres', '$apellidos', '$carrera_id')");
        }
    }
}
?>