<?php
   session_start(); // Iniciar la sesión

   // Verificar si el usuario está logueado
   if (!isset($_SESSION['idusuario'])) {
       // Si no está logueado, redirigir a la página de inicio de sesión
       header("Location: index.php");
       exit; // Detener la ejecución del script
   }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>Menu principal</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' type='text/css' media='screen' href='menu.css'>
        <script src='main.js'></script>
    </head>
    <body>
        <a href="cerrarSesion.php">Cerrar sesion</a>
        <h1>Menu usuario</h1>
        <a href="listarRecursos.php">Listar recursos</a>
        <a href="tipoDocumento.php">Prestamo</a>
        <a href="listarPrestamos.php">Consulta de prestamos</a>
        <a href="devolverPrestamo.php">Devolver prestamo</a>
        
    </body>
</html>