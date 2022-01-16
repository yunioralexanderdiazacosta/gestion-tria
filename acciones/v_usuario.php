<?php
include("../conexion.php");
$usuario        = $_POST['usuario'];
$usuario_actual = $_SESSION['usuario'];
$encontrado = $con->query("SELECT id FROM usuarios WHERE usuario = '$usuario' LIMIT 1");
if(mysqli_num_rows($encontrado) > 0 && $usuario_actual != $usuario){
    echo '1';
}else{
    echo '0';
}
?>