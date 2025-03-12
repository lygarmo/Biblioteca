<?php
    class Prestamo{
        private $conexion;

        private $idprestamo;
        private $fechaprestamo;
        private $fechadevolucion;
        private $observaciones;
        private $prestado;
        private $idusuario;
        private $idejemplar;

        //constructor
        public function __construct($db){
            $this->conexion=$db;
        }

        public function anadirPrestamo($fechaprestamo, $fechadevolucion, $observaciones, $prestado, $idusuario, $idejemplar) {
            $consulta = "INSERT INTO prestamo (fechaprestamo, fechadevolucion, observaciones, prestado, idusuario, idejemplar) 
                         VALUES (:fechaprestamo, :fechadevolucion, :observaciones, :prestado, :idusuario, :idejemplar)";
            $stmt = $this->conexion->prepare($consulta);
    
            // Enlazar parámetros
            $stmt->bindParam(':fechaprestamo', $fechaprestamo);
            $stmt->bindParam(':fechadevolucion', $fechadevolucion);
            $stmt->bindParam(':observaciones', $observaciones);
            $stmt->bindParam(':prestado', $prestado);
            $stmt->bindParam(':idusuario', $idusuario);
            $stmt->bindParam(':idejemplar', $idejemplar);
    
            // Ejecutar la consulta
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }

?>