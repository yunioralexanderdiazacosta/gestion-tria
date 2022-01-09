<?php
include("../conexion.php");
session_start();
@$usuario = $_POST['usuario'];
@$clave = md5($_POST['clave']);
$errores=array();
if (trim($usuario == "" || $clave == "")){
    $errores[] = "Debes llenar todos los campos";
}else{
    $sql = $con->query("SELECT usuario FROM usuarios WHERE usuario='$usuario' AND clave='$clave'");
    $fila = mysqli_fetch_assoc($sql);
    if(mysqli_num_rows($sql)>0)
    {
        $_SESSION['usuario'] = $fila['usuario'];
        header('Content-Type: application/json');
        print json_encode([ 'message' => 'success']);
    }else{
        header('HTTP/1.1 401 Unauthorized');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode("usuario y/o contraseña incorrectos"));
    }
    mysqli_close($con);
}
?>