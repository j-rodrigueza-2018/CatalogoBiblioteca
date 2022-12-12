<?php

class ModeloUsuarios {

    // Atributos de la Clase
    private $db;

    // Método Constructor de la Clase
    public function __construct() {
        $this->db = new Conexion();
    }

    // Método que nos devuelve un libro (con sus datos) a partir de su Id
    public function libroPorId($id) {
        $consulta = $this->db->query("SELECT l.id, l.titulo, a.id AS autorId, CONCAT(a.nombre, ' ', a.apellidos) AS autor, c.nombre AS categoria, l.sinopsis, l.imagenPortada FROM libro l JOIN autor a ON (l.autorId = a.id) JOIN categoria c ON (l.categoriaId = c.id) WHERE l.id='$id'");
        $data = $consulta->fetch_object();
        return $data;
    }

}