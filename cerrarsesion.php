<?php
    session_start();
    include('conexion.php');
    if(isset($_SESSION['usuario']))
    {
        session_destroy();
        header("Location: login.php");
    }
    else {
       header("Location: login.php");
    }
?>
