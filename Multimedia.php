<?php
    class Multimedia{
        private $conexion;

        private $idmultimedia;
        private $titulo;
        private $listaautores;
        private $fechapublicacion;
        private $materia;
        private $descripcion;
        private $editorial;
        private $numeroejemplares;
        private $soporte;

        //constructor
        public function __construct($db){
            $this->conexion=$db;
        }

        //metodo para mostrar multimedia
        public function mostrar() {
            $consulta = "SELECT * FROM multimedia";
            $stm = $this->conexion->prepare($consulta);
            $stm->execute();
            return $stm;
        }
    }
?>
