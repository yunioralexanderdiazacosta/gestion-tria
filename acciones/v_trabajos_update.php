<?php
include("../conexion.php");
$id             = $_POST['id'];
$titulo         = $_POST['titulo'];
$empresa        = $_POST['empresa'];
$periodo_id     = $_POST['periodo_id'];
$estudiante_id  = $_POST['estudiante_id'];
$profesor_id    = $_POST['profesor_id'];
$estatus        = $_POST['estatus'];
$observaciones  = $_POST['observaciones'];
$con->query("UPDATE trabajos SET titulo = '$titulo', empresa = '$empresa', periodo_id = '$periodo_id', estudiante_id = '$estudiante_id', profesor_id = '$profesor_id', estatus = '$estatus', observaciones = '$observaciones' WHERE id = '$id'");
?>