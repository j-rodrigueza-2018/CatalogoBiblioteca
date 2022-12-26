<?php

include_once 'IRepositorioLibro.php';
include_once RUTA_APP.'/modelos/Libro.php';

class RepositorioLibro implements IRepositorioLibro {

    // Atributos de la Clase
    private Conexion $db;

    // Método Constructor de la Clase
    public function __construct() {
        $this->db = new Conexion();
    }

    // Implementamos los métodos de la interfaz 'IRepositorioLibro'
    public function crearLibro(Libro $libro) {
        $titulo = $libro->getTitulo();
        $autor = $libro->getAutorId();
        $categoria = $libro->getCategoriaId();
        $sinopsis = $libro->getSinopsis();
        $imagenPortada = $libro->getImagenPortada();

        return $this->db->query("INSERT INTO libro VALUES (DEFAULT, '$titulo', '$autor', '$categoria', '$sinopsis', '$imagenPortada', 0, 0)");
    }

    public function editarLibro(Libro $libro) {
        $id = $libro->getId();
        $titulo = $libro->getTitulo();
        $autor = $libro->getAutorId();
        $categoria = $libro->getCategoriaId();
        $sinopsis = $libro->getSinopsis();
        $imagenPortada = $libro->getImagenPortada();

        return $this->db->query("UPDATE libro SET titulo='$titulo', autorId='$autor', categoriaId='$categoria', sinopsis='$sinopsis', imagenPortada='$imagenPortada' WHERE id='".$id."'");
    }

    public function eliminarLibro(Libro $libro) {
        $id = $libro->getId();
        $imagen = $libro->getImagenPortada();
        $borrarImg = RUTA_IMG.'/public/imagenesPortada/'.$imagen;
        unlink($borrarImg);

        return $this->db->query("DELETE FROM libro WHERE id='".$id."'");
    }

    public function eliminarLibros($libros) {
        foreach ($libros as $libro) {
            $borrarImg = RUTA_IMG.'/public/imagenesPortada/'.$libro->getImagenPortada();
            unlink($borrarImg);
            $eliminacion = $this->db->query("DELETE FROM libro WHERE id='".$libro->getId()."'");
        }
        return $eliminacion;
    }

    public function publicarLibro(Libro $libro) {
        $id = $libro->getId();
        return $this->db->query("UPDATE libro SET estaPublicado=1 WHERE id='".$id."'");
    }

    public function publicarLibros($libros) {
        foreach ($libros as $libro) {
            $publicacion = $this->db->query("UPDATE libro SET estaPublicado=1 WHERE id='".$libro->getId()."'");
        }
        return $publicacion;
    }

    public function ocultarLibro(Libro $libro) {
        $id = $libro->getId();
        return $this->db->query("UPDATE libro SET estaPublicado=0 WHERE id='".$id."'");
    }

    public function ocultarLibros($libros) {
        foreach ($libros as $libro) {
            $ocultacion = $this->db->query("UPDATE libro SET estaPublicado=0 WHERE id='".$libro->getId()."'");
        }
        return $ocultacion;
    }

    public function destacarLibro(Libro $libro) {
        $id = $libro->getId();
        return $this->db->query("UPDATE libro SET esDestacado=1 WHERE id='".$id."'");
    }

    public function quitarLibro(Libro $libro) {
        $id = $libro->getId();
        return $this->db->query("UPDATE libro SET esDestacado=0 WHERE id='".$id."'");
    }

    public function buscarPorId(int $id): Libro {
        $consulta = $this->db->query("SELECT * FROM libro WHERE id='".$id."'");
        $libro = $consulta->fetch_object();
        return new Libro($libro->id, $libro->titulo, $libro->autorId, $libro->categoriaId, $libro->sinopsis, $libro->imagenPortada, $libro->estaPublicado, $libro->esDestacado);
    }

    // Método privado que nos devuelve un libro en función de los filtros aplicados
    private function obtenerPorFiltro($texto): string {
        $titulo = $this->db->realEscapeString($texto[0]);
        $autor = $this->db->realEscapeString($texto[1]);
        $categoria = $this->db->realEscapeString($texto[2]);

        $consulta = "SELECT l.id, l.titulo, CONCAT(a.nombre, ' ', a.apellidos) AS autor, c.nombre AS categoria, l.imagenPortada, l.estaPublicado, l.esDestacado FROM libro l JOIN autor a ON (l.autorId = a.id) JOIN categoria c ON (l.categoriaId = c.id)";
        if ($autor == null && $categoria == null) {
            $consulta .= " WHERE l.titulo LIKE '%{$titulo}%' ORDER BY l.titulo ASC";
        } elseif ($titulo == null && $autor == null) {
            $consulta .= " WHERE c.nombre = '$categoria' ORDER BY l.titulo ASC";
        } elseif ($titulo == null && $categoria == null) {
            $consulta .= " WHERE CONCAT(a.nombre, ' ', a.apellidos)='$autor' ORDER BY l.titulo ASC";
        } elseif ($titulo == null) {
            $consulta .= " WHERE CONCAT(a.nombre, ' ', a.apellidos)='$autor' AND c.nombre = '$categoria' ORDER BY l.titulo ASC";
        } elseif ($autor == null) {
            $consulta .= " WHERE l.titulo LIKE '%{$titulo}%' AND c.nombre = '$categoria' ORDER BY l.titulo ASC";
        } elseif ($categoria == null) {
            $consulta .= " WHERE l.titulo LIKE '%{$titulo}%' AND CONCAT(a.nombre, ' ', a.apellidos)='$autor' ORDER BY l.titulo ASC";
        } else {
            $consulta .= " WHERE l.titulo LIKE '%{$titulo}%' AND CONCAT(a.nombre, ' ', a.apellidos)='$autor' AND c.nombre = '$categoria' ORDER BY l.titulo ASC";
        }

        return $consulta;
    }

    // Método que nos devuelve los libros de nuestra base de datos
    public function buscarLibros($texto): array {
        $consulta = $this->obtenerPorFiltro($texto);
        return $this->db->result_query($consulta);
    }

    public function mostrarLibros(): array {
        $consulta = "SELECT l.id, l.titulo, CONCAT(a.nombre, ' ', a.apellidos) AS autor, c.nombre AS categoria, l.imagenPortada, l.estaPublicado, l.esDestacado FROM libro l JOIN autor a ON (l.autorId = a.id) JOIN categoria c ON (l.categoriaId = c.id) ORDER BY l.titulo ASC";
        return $this->db->result_query($consulta);
    }

}