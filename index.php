<?php
session_start();
require_once 'ConexionDB.php';

class Auth {
    private $db;

    public function __construct() {
        $conexionDB = new ConexionDB();
        $conexionDB->conectar();
        $this->db = $conexionDB->getConexion();
    }

    public function login($usuario, $clave) {
        if ($usuario == 'admin' && $clave == 'admin') {
            $_SESSION['usuario'] = 'admin';
            $_SESSION['rol'] = 'admin';
            echo 'Login correcto admin';
            header('Location: ');//rellenar en clase con la ruta 
            exit;
        } else {
            $stmt = $this->db->prepare('SELECT * FROM usuario WHERE email = :email AND clave = :clave');
            $stmt->execute(['email' => $usuario, 'clave' => $clave]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                $_SESSION['usuario'] = $user['nombre'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['rol'] = 'usuario';
                echo 'Login correcto usuario';
                header('Location: ');//rellenar en clase con la ruta
                exit;
            } else {
                echo 'Credenciales incorrectas';
            }
        }
    }

    public function registrar($nombre, $curso, $email, $direccion, $clave, $telefono) {
        try {
            $consulta = $this->db->prepare('INSERT INTO usuario (nombre, curso, email, direccion, clave, telefono) VALUES (:nombre, :curso, :email, :direccion, :clave, :telefono)');
            $consulta->execute(['nombre' => $nombre, 'curso' => $curso, 'email' => $email, 'direccion' => $direccion, 'clave' => $clave, 'telefono' => $telefono]);
            echo 'Registro exitoso';
        } catch (PDOException $e) {
            echo 'Error en el registro: ' . $e->getMessage();
        }
    }

    public function logout() {
        session_destroy();
        header('Location: index.php');
    }
}

$auth = new Auth();

if (isset($_POST['login'])) {
    $auth->login($_POST['usuario'], $_POST['clave']);
}

if (isset($_POST['registro'])) {
    $auth->registrar($_POST['nombre'], $_POST['curso'], $_POST['email'], $_POST['direccion'], $_POST['clave'], $_POST['telefono']);
}
?>

<!DOCTYPE html>
<html lang="">
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FFFBF5;
            color:rgb(23, 24, 25);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }
        h2 {
            color: #A78BFA;
        }
        form {
            background:rgb(188, 103, 155);
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            width: 300px;
            margin-bottom: 20px;
        }
        input[type="text"], input[type="password"], input[type="email"] {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            border: 1px solid #E0E7FF;
            border-radius: 8px;
            background: #FEF6FF;
        }
        button {
            background: #A5B4FC;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        button:hover {
            background:rgb(71, 73, 91);
        }
    </style>
</head>
<body>
    <h1>Bienvenido a la biblioteca municipal</h1>
    <h2>Login</h2>
    <form method="POST">
        Usuario (email o admin): <input type="text" name="usuario" required><br>
        Clave: <input type="password" name="clave" required><br>
        <button type="submit" name="login">Entrar</button>
    </form>

    <h2>¿No tienes cuenta? Regístrate</h2>
    <form method="POST">
        Nombre: <input type="text" name="nombre" required><br>
        Curso: <input type="text" name="curso" required><br>
        Email: <input type="email" name="email" required><br>
        Dirección: <input type="text" name="direccion" required><br>
        Clave: <input type="password" name="clave" required><br>
        Teléfono: <input type="text" name="telefono" required><br>
        <button type="submit" name="registro">Registrar</button>
    </form>
</body>
</html>
