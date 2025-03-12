<?php
    session_start();
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
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='tipoDocumento.css'>
    <script src='main.js'></script>
</head>
<body>
<a href="menuUsuario.php">Volver a inicio</a>
    <form method="post" action="prestamos.php">
        <label for="tipo">Tipo de documento:</label>
        <select name="tipo" id="tipo" required>
            <option value="" disabled selected>Selecciona un tipo de documento</option>
            <option value="libro">Libro</option>
            <option value="revista">Revista</option>
            <option value="multimedia">Multimedia</option>
        </select>
        <br>
        <input type="submit" value="Seleccionar">
    </form>
    
</body>
</html>