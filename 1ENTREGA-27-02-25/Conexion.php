<?php
    class Conexion{
        private $host="localhost";
        private $db="biblioteca";
        private $user="root";
        private $password="root";
        private $conexion;

        public function conexion(){
            $this->conexion=null;

            try{
                $this->conexion=new PDO("mysql:host=".$this->host.";dbname=".$this->db, $this->user, $this->password);
                $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }

            return $this->conexion;
        }

        public function login($email, $clave) {
            try {
                $consulta = $this->conexion->prepare('SELECT * FROM usuario WHERE email = :email AND clave = :clave');
                $consulta->execute(['email' => $email, 'clave' => $clave]);
                $usuario = $consulta->fetch(PDO::FETCH_ASSOC);
    
                if ($usuario) {
                    return $usuario; 
                } else {
                    return false; 
                }
            } catch (PDOException $e) {
                echo "Error en el login: " . $e->getMessage();
                return false;
            }
        }


        public function registro($nombre, $curso, $email, $direccion, $clave, $telefono) {
            try {
                $consulta = $this->conexion->prepare(
                    'INSERT INTO usuario (nombre, curso, email, direccion, clave, telefono) 
                     VALUES (:nombre, :curso, :email, :direccion, :clave, :telefono)'
                );
                $consulta->execute([
                    'nombre' => $nombre,
                    'curso' => $curso,
                    'email' => $email,
                    'direccion' => $direccion,
                    'clave' => $clave,
                    'telefono' => $telefono
                ]);
    
                return true; 
            } catch (PDOException $e) {
                echo "Error en el registro: " . $e->getMessage();
                return false;
            }
        }

    }

?>
