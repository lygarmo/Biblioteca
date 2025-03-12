<?php

    class Revista extends Documento{
        private $conexion;

        private $id;
        private $frecuencia;

        //constructor
        public function __construct($db){
            $this->conexion=$db;
        }

        //metodo para mostrar las revistas
        public function mostrar() {
            $consulta = "SELECT revista.id, revista.frecuencia, documento.titulo, documento.listaautores 
                         FROM revista 
                         JOIN documento ON revista.iddocumento = documento.iddocumento";
            $stmt = $this->conexion->prepare($consulta);
            $stmt->execute();
            return $stmt;
        }

        public function listadorevistas() {
            $consulta = "SELECT revista.id AS id, revista.frecuencia, documento.titulo, documento.listaautores, documento.iddocumento
                         FROM revista 
                         JOIN documento ON revista.iddocumento = documento.iddocumento";
            $stmt = $this->conexion->prepare($consulta);
            $stmt->execute();
            
            // Retornar un array asociativo
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

?>