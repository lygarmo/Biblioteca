<?php
    session_start();

    $nombre='';
    $curso=0;
    $email='';
    $direccion='';
    $clave='';
    $telefono='';

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registro'])) {
        // Recoger los datos del formulario
        $nombre = $_POST['nombre'];
        $curso = $_POST['curso'];
        $email = $_POST['email'];
        $direccion = $_POST['direccion'];
        $clave = $_POST['clave'];
        $telefono = $_POST['telefono'];
    }

    try {
        $conexion = new PDO("mysql:host=localhost;dbname=biblioteca", "root", "root");
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta para obtener todos los datos de solicitantes ordenados por puntos y NO cursos
        $consulta = $conexion->prepare("INSERT INTO usuario (nombre, curso, email, direccion, clave, telefono) VALUES (:nombre, :curso, :email, :direccion, :clave, :telefono)");

        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':curso', $curso, PDO::PARAM_INT);
        $consulta->bindParam(':email', $email);
        $consulta->bindParam(':direccion', $direccion);
        $consulta->bindParam(':clave', $clave);
        $consulta->bindParam(':telefono', $telefono);

        $consulta->execute();

        echo "Registro exitoso!";
        echo "<br><a href='index.php'>Volver</a>";

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit;
    }
?>