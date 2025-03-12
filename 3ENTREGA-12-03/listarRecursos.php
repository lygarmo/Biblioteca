<?php
    session_start();
    // Verificar si el usuario está logueado
    if (!isset($_SESSION['idusuario'])) {
        // Si no está logueado, redirigir a la página de inicio de sesión
        header("Location: index.php");
        exit; // Detener la ejecución del script
    }
    require_once 'Conexion.php';
    require_once 'Documento.php';
    require_once 'Libro.php';
    require_once 'Revista.php';
    require_once 'Multimedia.php';

    // Creamos la conexion
    $conexion = new Conexion();
    $db = $conexion->conexion();

    // Creamos los objetos
    $libro = new Libro($db);
    $revista = new Revista($db);
    $multimedia = new Multimedia($db);

    // Aplicamos métodos para mostrar el contenido de las tablas
    $libros = $libro->mostrar();
    $revistas = $revista->mostrar();
    $multimedias = $multimedia->mostrar();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Listado de recursos</title>
    <link rel="stylesheet" href="estilosListado.css">
</head>
<body>
    <a href="menuUsuario.php">Volver</a><br>
    <div class="contenedor">
        <div class="seccion">
        <a href="listarLibros.php">
            <button>Libros</button>
        </a>
        <a href="listarMultimedia.php">
            <button>Multimedia</button>
        </a>
        <a href="listarRevistas.php">
            <button>Revistas</button>
        </a>
            <h1>Libros</h1>
            <?php while ($row = $libros->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="recurso">
                    <p><strong>Título:</strong> <?php echo $row['titulo']; ?></p>
                    <p><strong>Autores:</strong> <?php echo $row['listaautores']; ?></p>
                    <p><strong>ISBN:</strong> <?php echo $row['isbn']; ?></p>
                </div>
            <?php endwhile; ?>
        </div>
        <div class="seccion">
            <h1>Revistas</h1>
            <?php while ($row = $revistas->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="recurso">
                    <p><strong>Título:</strong> <?php echo $row['titulo']; ?></p>
                    <p><strong>Autores:</strong> <?php echo $row['listaautores']; ?></p>
                    <p><strong>Frecuencia:</strong> <?php echo $row['frecuencia']; ?></p>
                </div>
            <?php endwhile; ?>
        </div>
        <div class="seccion">
            <h1>Multimedia</h1>
            <?php while ($row = $multimedias->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="recurso">
                    <p><strong>Título:</strong> <?php echo $row['titulo']; ?></p>
                    <p><strong>Autores:</strong> <?php echo $row['listaautores']; ?></p>
                    <p><strong>Formato:</strong> <?php echo $row['formato']; ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>
