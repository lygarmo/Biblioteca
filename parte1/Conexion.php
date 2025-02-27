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

    }

?>
