<?php

    class Documento{
        private $iddocumento;
        private $titulo;
        private $listaautores;
        private $fechapublicacion;
        private $materia;
        private $descripcion;
        private $numeroejemplares;

        //constructor
        public function __construct($db){
            $this->conexion = $db; 
        }


        public function existencias($id){
            $consulta = "SELECT numeroejemplares FROM documento WHERE id = :id";
            $stmt = $this->conexion->prepare($consulta);

            $stmt->bindParam(':id', $id);

            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado['numeroejemplares'];
        }

        
    }

?>