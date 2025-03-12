<?php
    session_start();
    // Verificar si el usuario está logueado
    if (!isset($_SESSION['idusuario'])) {
        // Si no está logueado, redirigir a la página de inicio de sesión
        header("Location: index.php");
        exit; // Detener la ejecución del script
    }

    require_once 'Conexion.php';
    require_once 'Usuario.php';

    // Obtener el ID del usuario desde la sesión
    $idusuario = $_SESSION['idusuario'];

    $idprestamo;
    $idprestamo = $_GET['idprestamo'];

    // Iniciar conexión
    $conexion = new Conexion();
    $db = $conexion->conexion();

    $usuario = new Usuario($db);

    $devolucion = $usuario->devolverPrestamo($idusuario, $idprestamo);

    

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>Devolucion</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel="stylesheet" href="prestamos.css">
    </head>

    <body>
    <a href="devolverPrestamo.php">Volver</a>
    <a href='menuUsuario.php'>Volver a inicio</a><br>
    <a href="cerrarSesion.php">Cerrar sesion</a>
    <?php if ($devolucion): ?>
        <p>El préstamo se ha devuelto correctamente.</p>
    <?php else: ?>
        <p>No se pudo procesar la devolución del préstamo.</p>
    <?php endif; ?>
    </body>
</html>