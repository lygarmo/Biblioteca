<?php
session_start();
require_once 'Conexion.php';

// Crear una instancia de la clase Conexion
$conexion = new Conexion();
$db = $conexion->conexion();

// Procesar el formulario de registro
if (isset($_POST['registro'])) {
    $nombre = $_POST['nombre'];
    $curso = $_POST['curso'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    $clave = $_POST['clave'];
    $telefono = $_POST['telefono'];

    // Llamar al método registro
    if ($conexion->registro($nombre, $curso, $email, $direccion, $clave, $telefono)) {
        echo "Registro exitoso.";
    } else {
        echo "Error en el registro.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel='stylesheet' type='text/css' media='screen' href='estilos.css'>
</head>
<body>
    <h1>¡Regístrate!</h1>
    <form method="POST">
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