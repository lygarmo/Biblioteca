<?php
    class Libro{
        private $conexion;

        private $idlibro;
        private $titulo;
        private $listaautores;
        private $fechapublicacion;
        private $materia;
        private $descripcion;
        private $editorial;
        private $numeroejemplares;
        private $numeropaginas;
        private $isbn;

        //constructor
        public function __construct($db){
            $this->conexion=$db;
        }

        //metodo para mostrar los libros
        public function mostrar() {
            $consulta = "SELECT * FROM libro";
            $stmt = $this->conexion->prepare($consulta);
            $stmt->execute();
            return $stmt;
        }
    }

?>