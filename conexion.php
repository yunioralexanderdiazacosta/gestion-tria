<?php
$host_db = "localhost";
$usuario_db = "root";
$clave_db = "1234";
$nombre_db = "iupsm_tria";
$con = mysqli_connect($host_db, $usuario_db, $clave_db, $nombre_db);
mysqli_set_charset($con,'utf8');
?>