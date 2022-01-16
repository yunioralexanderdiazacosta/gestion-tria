<?php
include("../conexion.php");
session_start();
$usuario_conectado  = $_SESSION['usuario'];
$usuario_nuevo      = $_POST['usuario'];
if(isset($_POST['clave'])){
    $clave = md5($_POST['clave']);
    $con->query("UPDATE usuarios SET usuario = '$usuario_nuevo', clave = '$clave' WHERE usuario = '$usuario_conectado'");
}else{
    $con->query("UPDATE usuarios SET usuario = '$usuario_nuevo' WHERE usuario = '$usuario_conectado'");
}
$_SESSION['usuario'] = $usuario_nuevo;
?>