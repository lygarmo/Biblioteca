<?php
session_start();

$email = '';
$clave = '';

if (isset($_POST['login'])) {
    // Obtener los datos del formulario
    $email = $_POST['email'];
    $clave = $_POST['clave'];
}

// Si es admin directamente nos redirige
if ($email === 'admin' && $clave === 'admin') {
    $_SESSION['id'] = 'admin';
    header("Location: menuAdmin.php");
    exit;
}

require_once 'Conexion.php';
require_once 'Usuario.php';

// Creamos la conexión
$conexion = new Conexion();
$conexion = $conexion->conexion();

$usuario = new Usuario($conexion);
$resultadoConsulta = $usuario->autenticarUsuario($email, $clave);

$logueado = false;

if ($resultadoConsulta) {
    $_SESSION['idusuario'] = $resultadoConsulta['idusuario']; // Guardar el ID del usuario en la sesión
    // Si el usuario es autenticado
    header("Location: menuUsuario.php");
    exit;
} else {
    // Si no existe el usuario o la contraseña es incorrecta
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Inicio de sesión</title>
    <style>
        /* Estilos generales */
        body {
            font-family: 'Poppins', sans-serif; /* Tipografía moderna */
            margin: 0;
            padding: 0;
            overflow: hidden; /* Evita el desplazamiento */
        }

        /* Contenedor del fondo difuminado */
        .fondo-difuminado {
            position: fixed; /* Fija el fondo */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('fondo.jpg'); /* Imagen de fondo */
            background-size: cover; /* Cubre todo el espacio */
            background-position: center; /* Centra la imagen */
            filter: blur(7px); /* Aplica el desenfoque */
            z-index: -1; /* Lo coloca detrás del contenido */
        }

        /* Contenedor del contenido */
        .contenido {
            position: relative; /* Permite que el contenido esté por encima del fondo */
            z-index: 1; /* Asegura que el contenido esté sobre el fondo */
            display: flex;
            flex-direction: column; /* Organiza los elementos en columna */
            justify-content: center;
            align-items: center;
            height: 100vh; /* Ocupa toda la altura de la pantalla */
            color: white;
            text-align: center; /* Centra el texto */
        }

        /* Estilos del formulario */
        form {
            background-color: rgba(255, 255, 255, 0.9); /* Fondo blanco semitransparente */
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1); /* Sombra suave */
            width: 100%;
            max-width: 500px;
            text-align: center;
            color: black; /* Texto negro dentro del formulario */
        }

        input[type="text"], input[type="password"], input[type="email"] {
            width: 100%;
            padding: 12px;
            margin: 12px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f8f9fa; /* Fondo gris suave */
            font-size: 16px;
            transition: border 0.3s ease, background-color 0.3s ease;
        }

        input[type="text"]:focus, input[type="password"]:focus, input[type="email"]:focus {
            border-color: #6c757d; /* Borde gris al hacer foco */
            background-color: #ffffff; /* Fondo blanco al hacer foco */
            outline: none; /* Eliminar el borde por defecto */
        }

        button {
            background-color: #6c757d; /* Gris para botones */
            color: #fff;
            border: none;
            padding: 14px 20px;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            margin-top: 10px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        button:hover {
            background-color: #495057; /* Gris más oscuro al hacer hover */
            transform: translateY(-2px); /* Efecto de elevación */
        }

        /* Estilos para el enlace de registro */
        .registro {
            margin-top: 20px;
            color: white;
            font-size: 16px;
        }

        .registro a {
            color: white; /* Gris para el enlace */
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .registro a:hover {
            color: #495057; /* Gris más oscuro al hacer hover */
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Fondo difuminado -->
    <div class="fondo-difuminado"></div>

    <!-- Contenido -->
    <div class="contenido">
        <h1>Bienvenido a la biblioteca municipal</h1>
        <h2>Login</h2>
        <form method="POST">
            Email: <input type="text" name="email" required><br>
            Clave: <input type="password" name="clave" required><br>
            <button type="submit" name="login">Entrar</button>
        </form>

        <div class="registro">
            <h2>¿No tienes cuenta? Regístrate</h2>
            <a href="Registro.php">Regístrate</a>
        </div>
    </div>
</body>
</html>