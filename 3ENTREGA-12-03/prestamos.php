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

// Creamos la conexión
$conexion = new Conexion();
$db = $conexion->conexion();

// Creamos los objetos
$libro = new Libro($db);
$revista = new Revista($db);
$multimedia = new Multimedia($db);

$tipo = '';
$elegido = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = $_POST['tipo']; // Obtener el tipo de documento seleccionado

    // Según el tipo de documento, llamar al método correspondiente
    if ($tipo == 'libro') {
        $elegido = $libro->listadoLibros();
    } else if ($tipo == 'revista') {
        $elegido = $revista->listadorevistas();
    } else if ($tipo == 'multimedia') {
        $elegido = $multimedia->listadomultimedias();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Seleccionar Documento</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='prestamoCSS.css'>
</head>
<body>
<a href="tipoDocumento.php">Volver</a>
<a href='menuUsuario.php'>Volver a inicio</a><br>
    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($tipo)): ?>
        <section id="documentos">
            <h2>Documentos disponibles para <?php echo htmlspecialchars($tipo); ?>:</h2>
            <?php if (!empty($elegido)): ?>
                <form method="post" action="gestionPrestamo.php">
                    <input type="hidden" name="tipo" value="<?php echo htmlspecialchars($tipo); ?>">
                    <input type="hidden" name="documentoid" value="<?php echo htmlspecialchars($tipo); ?>">
                        <?php foreach ($elegido as $documento): ?>
                                <input type="radio" name="idDocumento" value="<?php echo $documento['id']; ?>" required>
                                <?php echo htmlspecialchars($documento['titulo']); ?> 
                                (ID: <?php echo htmlspecialchars($documento['id']); ?>)<br>
                        <?php endforeach; ?>
                    <br>
                    <input type="submit" value="Seleccionar Documento">
                </form>
            <?php else: ?>
                <p>No hay documentos disponibles para <?php echo htmlspecialchars($tipo); ?>.</p>
            <?php endif; ?>
        </section>
    <?php endif; ?>
</body>
</html>