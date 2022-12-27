<?php

include_once 'IRepositorioCatalogo.php';
include_once RUTA_APP.'/modelos/Libro.php';

class RepositorioCatalogo implements IRepositorioCatalogo {

    // Atributos de la Clase
    private Conexion $db;

    // Método Constructor de la Clase
    public function __construct() {
        $this->db = new Conexion();
    }

    public function getLibrosDestacados(): array {
        $consulta = "SELECT id AS idLibro, titulo, imagenPortada FROM libro WHERE estaPublicado=1 AND esDestacado=1 ORDER BY titulo";
        return $this->db->result_query($consulta);
    }

    public function getLibrosPublicados(): array {
        $consulta = "SELECT id AS idLibro, titulo, imagenPortada FROM libro WHERE estaPublicado=1 ORDER BY titulo";
        return $this->db->result_query($consulta);
    }

    public function getDetallesLibro(Libro $libro) {
        $id = $libro->getId();
        $consulta = $this->db->query("SELECT l.id, l.titulo, a.id AS autorId, CONCAT(a.nombre, ' ', a.apellidos) AS autor, c.nombre AS categoria, l.sinopsis, l.imagenPortada FROM libro l JOIN autor a ON (l.autorId = a.id) JOIN categoria c ON (l.categoriaId = c.id) WHERE l.id='$id'");
        return $consulta->fetch_object();
    }

    // Método privado que nos devuelve un libro en función de los filtros aplicados
    private function filtrosCatalogo($texto): string {
        $titulo = $this->db->realEscapeString($texto[0]);
        $autor = $this->db->realEscapeString($texto[1]);
        $categoria = $this->db->realEscapeString($texto[2]);

        if ($autor == null && $categoria == null) {
            $consulta = "SELECT id AS idLibro, titulo, imagenPortada FROM libro WHERE estaPublicado=1 AND titulo LIKE '%{$titulo}%' ORDER BY titulo";
        } elseif ($titulo == null && $autor == null) {
            $consulta = "SELECT l.id AS idLibro, l.titulo, l.imagenPortada, cat.nombre FROM libro l JOIN categoria cat ON (l.categoriaId = cat.id) WHERE l.estaPublicado=1 AND cat.nombre = '$categoria' ORDER BY l.titulo";
        } elseif ($titulo == null && $categoria == null) {
            $consulta = "SELECT l.id AS idLibro, l.titulo, l.imagenPortada, CONCAT(a.nombre, ' ', a.apellidos) FROM libro l JOIN autor a ON (l.autorId = a.id) WHERE l.estaPublicado=1 AND CONCAT(a.nombre, ' ', a.apellidos)='$autor' ORDER BY l.titulo";
        } elseif ($titulo == null) {
            $consulta = "SELECT l.id AS idLibro, l.titulo, l.imagenPortada, CONCAT(a.nombre, ' ', a.apellidos), cat.nombre FROM libro l JOIN autor a ON (l.autorId = a.id) JOIN categoria cat ON (l.categoriaId = cat.id) WHERE l.estaPublicado=1 AND CONCAT(a.nombre, ' ', a.apellidos)='$autor' AND cat.nombre = '$categoria' ORDER BY l.titulo";
        } elseif ($autor == null) {
            $consulta = "SELECT l.id AS idLibro, l.titulo, l.imagenPortada, CONCAT(a.nombre, ' ', a.apellidos), cat.nombre FROM libro l JOIN autor a ON (l.autorId = a.id) JOIN categoria cat ON (l.categoriaId = cat.id) WHERE l.estaPublicado=1 AND l.titulo LIKE '%{$titulo}%' AND cat.nombre = '$categoria' ORDER BY l.titulo";
        } elseif ($categoria == null) {
            $consulta = "SELECT l.id AS idLibro, l.titulo, l.imagenPortada, CONCAT(a.nombre, ' ', a.apellidos), cat.nombre FROM libro l JOIN autor a ON (l.autorId = a.id) JOIN categoria cat ON (l.categoriaId = cat.id) WHERE l.estaPublicado=1 AND l.titulo LIKE '%{$titulo}%' AND CONCAT(a.nombre, ' ', a.apellidos)='$autor' ORDER BY l.titulo";
        } else {
            $consulta = "SELECT l.id AS idLibro, l.titulo, l.imagenPortada, CONCAT(a.nombre, ' ', a.apellidos), cat.nombre FROM libro l JOIN autor a ON (l.autorId = a.id) JOIN categoria cat ON (l.categoriaId = cat.id) WHERE l.estaPublicado=1 AND l.titulo LIKE '%{$titulo}%' AND CONCAT(a.nombre, ' ', a.apellidos)='$autor' AND cat.nombre = '$categoria' ORDER BY l.titulo";
        }

        return $consulta;
    }

    // Método que nos devuelve los libros de nuestra base de datos
    public function buscarLibros($texto): array {
        $consulta = $this->filtrosCatalogo($texto);
        return $this->db->result_query($consulta);
    }

    public function buscarLibroPorCategoria($texto): array {
        $categoria = $this->db->realEscapeString($texto);
        $consulta = "SELECT l.id AS idLibro, l.titulo, l.imagenPortada, CONCAT(a.nombre, ' ', a.apellidos), cat.nombre FROM libro l JOIN autor a ON (l.autorId = a.id) JOIN categoria cat ON (l.categoriaId = cat.id) WHERE l.estaPublicado=1 AND cat.nombre = '$categoria' ORDER BY l.titulo";
        return $this->db->result_query($consulta);
    }

}