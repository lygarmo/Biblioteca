<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='estilos.css'>
</head>
<body>
    <h1>Registrate</h1>
    <form action="procesar_registro.php" method="POST">
        Nombre: <input type="text" name="nombre" required><br>
        Curso: <input type="number" name="curso" required><br>
        Email: <input type="email" name="email" required><br>
        Dirección: <input type="text" name="direccion" required><br>
        Clave: <input type="password" name="clave" required><br>
        Teléfono: <input type="text" name="telefono" required><br><br>
        <button type="submit" name="registro">Registrar</button>
    </form>
    <a href="index.php">Volver</a>
</body>
</html>