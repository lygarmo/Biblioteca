<?php
    class Usuario{
        private $conexion;

        // Constructor
        public function __construct($db){
            $this->conexion = $db;
        }

        // Método para obtener usuarios
        public function obtenerUsuarios(){
            $consulta = "SELECT * FROM usuario";
            $stmt = $this->conexion->prepare($consulta);
            $stmt->execute();
            return $stmt;
        }

        // Método para insertar un nuevo usuario
        public function insertarUsuario($nombre, $curso, $email, $direccion, $clave, $telefono){
            $consulta = "INSERT INTO usuario (nombre, curso, email, direccion, clave, telefono) VALUES 
                (:nombre, :curso, :email, :direccion, :clave, :telefono)";
            $stmt = $this->conexion->prepare($consulta);

            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':curso', $curso);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->bindParam(':clave', $clave);
            $stmt->bindParam(':telefono', $telefono);

            $stmt->execute();
            return $stmt;
        }

        // Método para autenticar usuario
        public function autenticarUsuario($usuario, $clave){
            $consulta = "SELECT * FROM usuario WHERE email = :email AND clave = :clave";
            $stmt = $this->conexion->prepare($consulta);

            $stmt->bindParam(':email', $usuario);
            $stmt->bindParam(':clave', $clave);

            $stmt->execute();

            // Si el usuario existe, devuelve el resultado
            if ($stmt->rowCount() > 0) {
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                return $resultado; // Devuelve los datos del usuario
            } else {
                return null; // Usuario no encontrado
            }
        }

        public function saberPrestamos($idusuario){
            $consulta = "SELECT * FROM prestamo WHERE idusuario = :idusuario ORDER BY fechaprestamo DESC";
            $stmt = $this->conexion->prepare($consulta);

            $stmt->bindParam(':idusuario', $idusuario);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function saberPrestamosNoDevueltos($idusuario){
            $consulta = "SELECT * FROM prestamo WHERE idusuario = :idusuario and prestado=1 ORDER BY fechaprestamo DESC";
            $stmt = $this->conexion->prepare($consulta);

            $stmt->bindParam(':idusuario', $idusuario);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function saberPrestamosDevueltos($idusuario){
            $consulta = "SELECT * FROM prestamo WHERE idusuario = :idusuario and prestado=0 ORDER BY fechaprestamo DESC";
            $stmt = $this->conexion->prepare($consulta);

            $stmt->bindParam(':idusuario', $idusuario);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function devolverPrestamo($idusuario, $idprestamo){
            $fechaactual=date('Y-m-d');
            $mensaje='';

            $consulta = "SELECT * FROM prestamo WHERE idusuario = :idusuario and prestado=1 and idprestamo=:idprestamo";
            $stmt = $this->conexion->prepare($consulta);

            $stmt->bindParam(':idusuario', $idusuario);
            $stmt->bindParam(':idprestamo', $idprestamo);

            $stmt->execute();
            $prestamo = $stmt->fetch(PDO::FETCH_ASSOC);
              // Verificar si la consulta devolvió resultados
    if ($prestamo === false) {
        // Si no se encontró el préstamo, retornar false o un mensaje de error
        return false; // O podrías lanzar una excepción si prefieres manejarlo de esa manera
    }
            $fechadevolucion = $prestamo['fechadevolucion'];


            if (strtotime($fechaactual) <= strtotime($fechadevolucion)) {
                // Si la fecha actual es menor o igual a la fecha de devolución
                $mensaje='Devuelto en fecha';
            }else{
                // Si la fecha de devolucion es menor que la fecha actual
                $mensaje='NO devuelto en fecha';
            }

            $consulta = "UPDATE prestamo SET prestado=0, fechadevolucion = :fechaactual, observaciones = :observaciones
                WHERE idprestamo = :idprestamo";

            $stmt = $this->conexion->prepare($consulta);

            $stmt->bindParam(':fechaactual', $fechaactual);
            $stmt->bindParam(':observaciones', $mensaje);
            $stmt->bindParam(':idprestamo', $idprestamo);

            return $stmt->execute();
            
        }


    }
?>
