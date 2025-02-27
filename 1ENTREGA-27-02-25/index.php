<?php
session_start();
require_once 'Conexion.php';

// Crear una instancia de la clase Conexion
$conexion = new Conexion();
$db = $conexion->conexion();

// Procesar el formulario de login
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $clave = $_POST['clave'];

    if($email=='admin' && $clave=='admin'){
        header('Location: menuAdmin.html');
    }

    // Llamar al método login
    $usuario = $conexion->login($email, $clave);

    if ($usuario) {
        // Guardar datos en la sesión
        $_SESSION['usuario'] = $usuario['nombre'];
        $_SESSION['email'] = $usuario['email'];

        // Redirigir al menú del usuario
        header('Location: menuUsuario.html');
        exit;
    } else {
        echo "Credenciales incorrectas.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link rel='stylesheet' type='text/css' media='screen' href='estilos.css'>
    <title>Login</title>
</head>
<body>
    <h1>Bienvenido a la biblioteca municipal</h1>
    <h2>Login</h2>
    <form method="POST">
        Email: <input type="text" name="email" required><br>
        Clave: <input type="password" name="clave" required><br>
        <button type="submit" name="login">Entrar</button>
    </form>
    <a href="Registro.php">¿Aún no estás registrado?</a>
</body>
</html>