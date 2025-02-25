<?php
    require_once 'Conexion.php';
    require_once 'Libro.php';
    require_once 'Multimedia.php';
    require_once 'Revista.php';

    //creamos la conexion
    $conexion=new Conexion();
    $db=$conexion->conexion();

    //creamos los objetos
    $libro=new Libro($db);
    $multimedia=new Multimedia($db);
    $revista=new Revista($db);

    //aplicamos metodos para mostrar el contenido de las tablas
    $libros=$libro->mostrar();
    $multimedias=$multimedia->mostrar();
    $revistas=$revista->mostrar();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Listado de recursos</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #333;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }

        .recurso {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .recurso p {
            margin: 0;
            font-size: 16px;
            color: #555;
        }

        .recurso p strong {
            color: #333;
        }

        /* Estilos para los títulos de sección */
        .seccion {
            margin-top: 30px;
        }

        /* Estilos para el contenedor principal */
        .contenedor {
            max-width: 800px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="contenedor">
        <div class="seccion">
            <h1>Libros</h1>
            <?php while ($row = $libros->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="recurso">
                    <p><strong>ISBN:</strong> <?php echo $row['isbn']; ?></p>
                    <p><strong>Autores:</strong> <?php echo $row['listaautores']; ?></p>
                    <p><strong>Título:</strong> <?php echo $row['titulo']; ?></p>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="seccion">
            <h1>Multimedia</h1>
            <?php while ($row = $multimedias->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="recurso">
                    <p><strong>Autores:</strong> <?php echo $row['listaautores']; ?></p>
                    <p><strong>Título:</strong> <?php echo $row['titulo']; ?></p>
                    <p><strong>Soporte:</strong> <?php echo $row['soporte']; ?></p>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="seccion">
            <h1>Revistas</h1>
            <?php while ($row = $revistas->fetch(PDO::FETCH_ASSOC)): ?>
                <div class="recurso">
                    <p><strong>ISBN:</strong> <?php echo $row['isbn']; ?></p>
                    <p><strong>Autores:</strong> <?php echo $row['listaautores']; ?></p>
                    <p><strong>Título:</strong> <?php echo $row['titulo']; ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>