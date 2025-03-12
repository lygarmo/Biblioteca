<?php

    class Multimedia extends Documento{
        private $conexion;

        private $id;
        private $formato;

        //constructor
        public function __construct($db){
            $this->conexion=$db;
        }

        //metodo para mostrar multimedia
        public function mostrar() {
            $consulta = "SELECT multimedia.id, multimedia.formato, documento.titulo, documento.listaautores 
                         FROM multimedia 
                         JOIN documento ON multimedia.iddocumento = documento.iddocumento";
            $stmt = $this->conexion->prepare($consulta);
            $stmt->execute();
            return $stmt;
        }

        public function listadomultimedias() {
            $consulta = "SELECT multimedia.id AS id, multimedia.formato, documento.titulo, documento.listaautores 
                         FROM multimedia 
                         JOIN documento ON multimedia.iddocumento = documento.iddocumento";
            $stmt = $this->conexion->prepare($consulta);
            $stmt->execute();
            
            // Retornar un array asociativo
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>
