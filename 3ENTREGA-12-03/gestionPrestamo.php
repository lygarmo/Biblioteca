<?php
session_start();
// Verificar si el usuario está logueado
if (!isset($_SESSION['idusuario'])) {
    // Si no está logueado, redirigir a la página de inicio de sesión
    header("Location: index.php");
    exit; // Detener la ejecución del script
}
require_once 'Conexion.php';
require_once 'Prestamo.php';
require_once 'Documento.php';


// Verificar si el usuario está autenticado
if (!isset($_SESSION['idusuario'])) {
    die("<p>Error: No has iniciado sesión.</p>");
}

// Obtener el ID del usuario desde la sesión
$idusuario = $_SESSION['idusuario'];

// Iniciar conexión
$conexion = new Conexion();
$db = $conexion->conexion();

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger datos del formulario
    $idDocumento = $_POST['idDocumento'] ?? null; // Usar el operador de fusión null
    $tipo = $_POST['tipo'] ?? null; // Usar el operador de fusión null

    if (!$idDocumento || !$tipo) {
        die("<p>Error: No se proporcionó un ID o tipo de documento válido.</p>");
    }


    // Obtener el iddocumento desde la tabla correspondiente
    $consultaDocumento = "SELECT iddocumento FROM $tipo WHERE id = :idDocumento";
    $stmtDocumento = $db->prepare($consultaDocumento);
    $stmtDocumento->bindParam(':idDocumento', $idDocumento);
    $stmtDocumento->execute();
    $documento = $stmtDocumento->fetch(PDO::FETCH_ASSOC);

    if (!$documento) {
        die("<p>Error: No se encontró el documento asociado.</p>");
    }

    $iddocumento = $documento['iddocumento'];

    // Obtener el idejemplar desde la tabla ejemplar
    $consultaEjemplar = "SELECT idejemplar FROM ejemplar WHERE iddocumento = :iddocumento";
    $stmtEjemplar = $db->prepare($consultaEjemplar);
    $stmtEjemplar->bindParam(':iddocumento', $iddocumento);
    $stmtEjemplar->execute();
    $ejemplar = $stmtEjemplar->fetch(PDO::FETCH_ASSOC);

    if (!$ejemplar) {
        die("<p>Error: No se encontró un ejemplar para este documento.</p>");
    }

    $idejemplar = $ejemplar['idejemplar'];


    //cantidad de existencias
    $consulta = "SELECT numeroejemplares FROM documento WHERE iddocumento = :id";
    $stmt = $db->prepare($consulta);

    $stmt->bindParam(':id', $iddocumento);

    $stmt->execute();
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    $cantidadtotal = $resultado['numeroejemplares'];


    //cantidad de prestados
    $consulta = "SELECT count(*) AS total_Dprestamos FROM prestamo WHERE idejemplar = :idejemplar and prestado=1";
    $stmt = $db->prepare($consulta);

    $stmt->bindParam(':idejemplar', $idejemplar);

    $stmt->execute();
    $prestados = $stmt->fetch(PDO::FETCH_ASSOC);
    $totalPrestamosActivos = $prestados['total_Dprestamos'];

    //consultar cantidad de prestamos
    $consulta = "SELECT count(*) AS total_prestamos FROM prestamo WHERE idusuario = :idusuario and prestado=1";
    $stmt = $db->prepare($consulta);

    $stmt->bindParam(':idusuario', $idusuario);

    $stmt->execute();
    $prestados = $stmt->fetch(PDO::FETCH_ASSOC);
    $totalPrestamosUsuario = $prestados['total_prestamos'];

    if ($totalPrestamosUsuario >= 6) {
        echo "Ya tienes 6 prestamos activos";
    } else {
        if ($cantidadtotal > $totalPrestamosActivos) {
            // Datos para el préstamo
            $fechaprestamo = date('Y-m-d'); // Fecha actual
            $fechadevolucion = date('Y-m-d', strtotime('+3 weeks')); // Fecha de devolución en 3 semanas
            $observaciones = "Ninguna";
            $prestado = 1; // 1 indica que está prestado

            // Instanciar la clase Prestamo
            $prestamo = new Prestamo($db);

            // Insertar el préstamo en la base de datos
            $resultado = $prestamo->anadirPrestamo($fechaprestamo, $fechadevolucion, $observaciones, $prestado, $idusuario, $idejemplar);

            if ($resultado) {
                echo "<p>Préstamo registrado con éxito.</p><br>";
            } else {
                echo "<p>Error al registrar el préstamo.</p>";
            }
        } else {
            echo "No hay suficientes documentos disponibles";
        }
    }
} else {
    echo "<p>Acceso no permitido.</p>";
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>Page Title</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet' type='text/css' media='screen' href='prestamoCSS.css'>

    </head>
    <body>
        <a href="tipoDocumento.php">Volver</a>
        <a href='menuUsuario.php'>Volver a inicio</a><br>
    </body>
</html>