<?php
    class Revista{
        private $conexion;

        private $idrevista;
        private $titulo;
        private $listaautores;
        private $fechapublicacion;
        private $materia;
        private $descripcion;
        private $editorial;
        private $numeroejemplares;
        private $isbn;
        private $frecuencia;

        //constructor
        public function __construct($db){
            $this->conexion=$db;
        }

        //metodo para mostrar las revistas
        public function mostrar() {
            $consulta = "SELECT * FROM revistas";
            $stmt = $this->conexion->prepare($consulta);
            $stmt->execute();
            return $stmt;
        }
    }

?>