<?php
    session_start(); 

    $_SESSION = [];

    session_destroy();

    // Redirigir a la página de inicio
    header("Location: index.php"); 
    exit;
?>