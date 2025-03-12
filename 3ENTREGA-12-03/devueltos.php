<?php
session_start();
// Verificar si el usuario está logueado
if (!isset($_SESSION['idusuario'])) {
    // Si no está logueado, redirigir a la página de inicio de sesión
    header("Location: index.php");
    exit; // Detener la ejecución del script
}

require_once 'Conexion.php';
require_once 'Usuario.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['idusuario'])) {
    die("<p>Error: No has iniciado sesión.</p>");
}

// Obtener el ID del usuario desde la sesión
$idusuario = $_SESSION['idusuario'];

// Iniciar conexión
$conexion = new Conexion();
$db = $conexion->conexion();

// Crear una instancia de la clase Usuario
$usuario = new Usuario($db);

// Obtener los préstamos del usuario
$prestamos = $usuario->saberPrestamosDevueltos($idusuario);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Préstamos</title>
    <link rel="stylesheet" href="prestamos.css">
</head>
<body>
    <a href="menuUsuario.php">Volver</a>
    <h1>Lista de Préstamos</h1>
    <a href="listarPrestamos.php">
        <button>Todos</button>
    </a>
    <a href="nodevueltos.php">
        <button>No devueltos</button>
    </a>
    <?php if (!empty($prestamos)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID Préstamo</th>
                    <th>ID Ejemplar</th>
                    <th>Fecha de Préstamo</th>
                    <th>Fecha de Devolución</th>
                    <th>Observaciones</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($prestamos as $prestamo): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($prestamo['idprestamo']); ?></td>
                        <td><?php echo htmlspecialchars($prestamo['idejemplar']); ?></td>
                        <td><?php echo htmlspecialchars($prestamo['fechaprestamo']); ?></td>
                        <td><?php echo htmlspecialchars($prestamo['fechadevolucion']); ?></td>
                        <td><?php echo htmlspecialchars($prestamo['observaciones']); ?></td>
                        <td><?php echo ($prestamo['prestado'] == 1) ? 'Prestado' : 'Devuelto'; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No tienes préstamos activos.</p>
    <?php endif; ?>
</body>
</html>