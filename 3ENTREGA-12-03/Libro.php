<?php
class Libro extends Documento{
    private $conexion;

    private $id;
    private $editorial;
    private $isbn;
    private $numeropaginas;

    // Constructor
    public function __construct($db){
        $this->conexion = $db;
    }

    // Método para mostrar los libros (con la información de documento asociada)
    public function mostrar() {
        $consulta = "SELECT libro.id, libro.isbn, libro.editorial, libro.numeropaginas, documento.titulo, documento.listaautores 
                     FROM libro 
                     JOIN documento ON libro.iddocumento = documento.iddocumento";
        $stmt = $this->conexion->prepare($consulta);
        $stmt->execute();
        return $stmt;
    }

    public function listadoLibros() {
        $consulta = "SELECT libro.id AS id, libro.isbn, libro.editorial, libro.numeropaginas, 
                            documento.titulo, documento.listaautores 
                     FROM libro 
                     JOIN documento ON libro.iddocumento = documento.iddocumento";
        $stmt = $this->conexion->prepare($consulta);
        $stmt->execute();
        
        // Retornar un array asociativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
?>
