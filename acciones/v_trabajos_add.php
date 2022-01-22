<?php
include("../conexion.php");
$titulo         = $_POST['titulo'];
$empresa        = $_POST['empresa'];
$periodo_id     = $_POST['periodo_id'];
$estudiante_id  = $_POST['estudiante_id'];
$profesor_id    = $_POST['profesor_id'];
$estatus        = $_POST['estatus'];
$observaciones  = $_POST['observaciones'];
if(isset($_POST['fecha_entrega'])){
    $fecha_entrega = $_POST['fecha_entrega'];
    $con->query("INSERT INTO `trabajos` (`titulo`, `empresa`, `fecha_entrega`, `periodo_id`, `estudiante_id`, `profesor_id`, `estatus`, `observaciones`) VALUES ('$titulo', '$empresa', '$fecha_entrega', $periodo_id, $estudiante_id, $profesor_id, $estatus, '$observaciones')");
}else{
    $con->query("INSERT INTO `trabajos` (`titulo`, `empresa`, `fecha_entrega`, `periodo_id`, `estudiante_id`, `profesor_id`, `estatus`, `observaciones`) VALUES ('$titulo', '$empresa', NULL, $periodo_id, $estudiante_id, $profesor_id, $estatus, '$observaciones')");
}
?>