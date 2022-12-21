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

    // Método que nos devuelve los libros (con su portada y título) en el catálogo
    public function buscarLibros($data) {
        $titulo = $data[0];
        $autor = $data[1];
        $categoria = $data[2];
        $salida = '';

        if ($autor == null && $categoria == null) {
            $consulta = $this->db->query("SELECT id AS idLibro, titulo, imagenPortada FROM libro WHERE estaPublicado=1 AND titulo LIKE '%{$titulo}%' ORDER BY titulo");
        } elseif ($titulo == null && $autor == null) {
            $consulta = $this->db->query("SELECT l.id AS idLibro, l.titulo, l.imagenPortada, cat.nombre FROM libro l JOIN categoria cat ON (l.categoriaId = cat.id) WHERE l.estaPublicado=1 AND cat.nombre = '$categoria' ORDER BY l.titulo");
        } elseif ($titulo == null && $categoria == null) {
            $consulta = $this->db->query("SELECT l.id AS idLibro, l.titulo, l.imagenPortada, CONCAT(a.nombre, ' ', a.apellidos) FROM libro l JOIN autor a ON (l.autorId = a.id) WHERE l.estaPublicado=1 AND CONCAT(a.nombre, ' ', a.apellidos)='$autor' ORDER BY l.titulo");
        } elseif ($titulo == null) {
            $consulta = $this->db->query("SELECT l.id AS idLibro, l.titulo, l.imagenPortada, CONCAT(a.nombre, ' ', a.apellidos), cat.nombre FROM libro l JOIN autor a ON (l.autorId = a.id) JOIN categoria cat ON (l.categoriaId = cat.id) WHERE l.estaPublicado=1 AND CONCAT(a.nombre, ' ', a.apellidos)='$autor' AND cat.nombre = '$categoria' ORDER BY l.titulo");
        } elseif ($autor == null) {
            $consulta = $this->db->query("SELECT l.id AS idLibro, l.titulo, l.imagenPortada, CONCAT(a.nombre, ' ', a.apellidos), cat.nombre FROM libro l JOIN autor a ON (l.autorId = a.id) JOIN categoria cat ON (l.categoriaId = cat.id) WHERE l.estaPublicado=1 AND l.titulo LIKE '%{$titulo}%' AND cat.nombre = '$categoria' ORDER BY l.titulo");
        } elseif ($categoria == null) {
            $consulta = $this->db->query("SELECT l.id AS idLibro, l.titulo, l.imagenPortada, CONCAT(a.nombre, ' ', a.apellidos), cat.nombre FROM libro l JOIN autor a ON (l.autorId = a.id) JOIN categoria cat ON (l.categoriaId = cat.id) WHERE l.estaPublicado=1 AND l.titulo LIKE '%{$titulo}%' AND CONCAT(a.nombre, ' ', a.apellidos)='$autor' ORDER BY l.titulo");
        } else {
            $consulta = $this->db->query("SELECT l.id AS idLibro, l.titulo, l.imagenPortada, CONCAT(a.nombre, ' ', a.apellidos), cat.nombre FROM libro l JOIN autor a ON (l.autorId = a.id) JOIN categoria cat ON (l.categoriaId = cat.id) WHERE l.estaPublicado=1 AND l.titulo LIKE '%{$titulo}%' AND CONCAT(a.nombre, ' ', a.apellidos)='$autor' AND cat.nombre = '$categoria' ORDER BY l.titulo");
        }
        while ($fila = mysqli_fetch_assoc($consulta)) {
            $idLibro = $fila['idLibro'];
            $imagen = $fila['imagenPortada'];
            $titulo = $fila['titulo'];
            $salida .= "
                <div class='card border-0 col-2 catalogo' style='width: 15rem;'>
                    <a href='".RUTA_PUBLIC."/usuarios/vistaDetalleLibro/$idLibro' class='text-center text-black text-decoration-none'>
                        <img src='".RUTA_PUBLIC."/public/imagenesPortada/$imagen' class='card-img-top'>
                        <div class='card-body'>
                            <h5 class='card-title'>$titulo</h5>
                        </div>
                    </a>
                </div>
            ";
        }

        return $salida;
    }

    // Método que devuelve los libros en el catálogo por su categoría
    public function libroCategoria($data) {
        $categoria = $data;
        $salida = '';

        $consulta = $this->db->query("SELECT c.*, l.id AS idLibro, l.titulo, l.imagenPortada, cat.nombre FROM catalogo c JOIN libro l ON (c.libroId = l.id) JOIN categoria cat ON (l.categoriaId = cat.id) WHERE cat.nombre = '$categoria' ORDER BY l.titulo");

        while ($fila = mysqli_fetch_assoc($consulta)) {
            $idLibro = $fila['idLibro'];
            $imagen = $fila['imagenPortada'];
            $titulo = $fila['titulo'];
            $salida .= "
                <div class='card border-0 col-2 catalogo' style='width: 15rem;'>
                    <a href='".RUTA_PUBLIC."/usuarios/vistaDetalleLibro/$idLibro' class='text-center text-black text-decoration-none'>
                        <img src='".RUTA_PUBLIC."/public/imagenesPortada/$imagen' class='card-img-top'>
                        <div class='card-body'>
                            <h5 class='card-title'>$titulo</h5>
                        </div>
                    </a>
                </div>
            ";
        }

        return $salida;

    }

}