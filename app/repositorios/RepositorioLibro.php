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

    public function buscarPorId(int $id) {
        $consulta = $this->db->query("SELECT * FROM libro WHERE id='".$id."'");
        $libro = $consulta->fetch_object();
        return new Libro($libro->id, $libro->titulo, $libro->autorId, $libro->categoriaId, $libro->sinopsis, $libro->imagenPortada, $libro->estaPublicado, $libro->esDestacado);
    }

    // Método privado que nos devuelve un libro en función de los filtros aplicados
    private function obtenerPorFiltro($texto): string {
        $titulo = $this->db->realEscapeString($texto[0]);
        $autor = $this->db->realEscapeString($texto[1]);
        $categoria = $this->db->realEscapeString($texto[2]);

        if ($autor == null && $categoria == null) {
            $consulta = "SELECT l.id, l.titulo, CONCAT(a.nombre, ' ', a.apellidos) AS autor, c.nombre AS categoria, l.imagenPortada, l.estaPublicado, l.esDestacado FROM libro l JOIN autor a ON (l.autorId = a.id) JOIN categoria c ON (l.categoriaId = c.id) WHERE l.titulo LIKE '%{$titulo}%' ORDER BY l.titulo ASC";
        } elseif ($titulo == null && $autor == null) {
            $consulta = "SELECT l.id, l.titulo, CONCAT(a.nombre, ' ', a.apellidos) AS autor, c.nombre AS categoria, l.imagenPortada, l.estaPublicado, l.esDestacado FROM libro l JOIN autor a ON (l.autorId = a.id) JOIN categoria c ON (l.categoriaId = c.id) WHERE c.nombre = '$categoria' ORDER BY l.titulo ASC";
        } elseif ($titulo == null && $categoria == null) {
            $consulta = "SELECT l.id, l.titulo, CONCAT(a.nombre, ' ', a.apellidos) AS autor, c.nombre AS categoria, l.imagenPortada, l.estaPublicado, l.esDestacado FROM libro l JOIN autor a ON (l.autorId = a.id) JOIN categoria c ON (l.categoriaId = c.id) WHERE CONCAT(a.nombre, ' ', a.apellidos)='$autor' ORDER BY l.titulo ASC";
        } elseif ($titulo == null) {
            $consulta = "SELECT l.id, l.titulo, CONCAT(a.nombre, ' ', a.apellidos) AS autor, c.nombre AS categoria, l.imagenPortada, l.estaPublicado, l.esDestacado FROM libro l JOIN autor a ON (l.autorId = a.id) JOIN categoria c ON (l.categoriaId = c.id) WHERE CONCAT(a.nombre, ' ', a.apellidos)='$autor' AND c.nombre = '$categoria' ORDER BY l.titulo ASC";
        } elseif ($autor == null) {
            $consulta = "SELECT l.id, l.titulo, CONCAT(a.nombre, ' ', a.apellidos) AS autor, c.nombre AS categoria, l.imagenPortada, l.estaPublicado, l.esDestacado FROM libro l JOIN autor a ON (l.autorId = a.id) JOIN categoria c ON (l.categoriaId = c.id) WHERE l.titulo LIKE '%{$titulo}%' AND c.nombre = '$categoria' ORDER BY l.titulo ASC";
        } elseif ($categoria == null) {
            $consulta = "SELECT l.id, l.titulo, CONCAT(a.nombre, ' ', a.apellidos) AS autor, c.nombre AS categoria, l.imagenPortada, l.estaPublicado, l.esDestacado FROM libro l JOIN autor a ON (l.autorId = a.id) JOIN categoria c ON (l.categoriaId = c.id) WHERE l.titulo LIKE '%{$titulo}%' AND CONCAT(a.nombre, ' ', a.apellidos)='$autor' ORDER BY l.titulo ASC";
        } else {
            $consulta = "SELECT l.id, l.titulo, CONCAT(a.nombre, ' ', a.apellidos) AS autor, c.nombre AS categoria, l.imagenPortada, l.estaPublicado, l.esDestacado FROM libro l JOIN autor a ON (l.autorId = a.id) JOIN categoria c ON (l.categoriaId = c.id) WHERE l.titulo LIKE '%{$titulo}%' AND CONCAT(a.nombre, ' ', a.apellidos)='$autor' AND c.nombre = '$categoria' ORDER BY l.titulo ASC";
        }

        return $consulta;
    }

    // Método que nos devuelve los libros de nuestra base de datos
    public function buscarLibros($texto) {
        $consulta = $this->obtenerPorFiltro($texto);
        return $this->db->result_query($consulta);
        /*$salida = "<table class='table table-bordered'>
                    <thead>
                    <tr>
                        <th scope='col'></th>
                        <th scope='col' class='text-center'>Título</th>
                        <th scope='col' class='text-center d-none d-sm-none d-md-none d-lg-none d-xl-table-cell'>Autores</th>
                        <th scope='col' class='text-center d-none d-sm-none d-md-none d-lg-none d-xl-table-cell'>Categoría</th>
                        <th scope='col' class='text-center'>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
        ";

        $consulta = $this->obtenerPorFiltro($texto);
        while ($fila = mysqli_fetch_assoc($consulta)) {
            $salida .= "<tr id='idLibro".$fila['id']."'>";
            $salida .= "<td class='text-center'>";
            $salida .= "<input type='checkbox' name='ids[]' class='deleteCheckbox' value='".$fila['id']."-".$fila['imagenPortada']."'>";
            $salida .= "</td>";
            $salida .= "<td class='text-center col-5'>".$fila['titulo']."</td>";
            $salida .= "<td class='text-center d-none d-sm-none d-md-none d-lg-none d-xl-table-cell'>".$fila['autor']."</td>";
            $salida .= "<td class='text-center d-none d-sm-none d-md-none d-lg-none d-xl-table-cell'>".$fila['categoria']."</td>";
            $salida .= "<td class='text-center'>";
            $salida .= "<button type='button' class='btn btn-danger bi-trash elimLibro' id='".$fila['id']."-".$fila['imagenPortada']."'></button>";
            $location = RUTA_PUBLIC.'/libros/vistaEditarLibro/'.$fila['id'];
            $salida .= "<button type='button' class='btn btn-primary bi-pencil-square ms-2' onclick='location.href=\"$location\"'></button>";
            if ($fila['estaPublicado'] == 0) {
                $salida .= "<button type='button' class='btn btn-warning bi-eye-fill text-white ms-2 publicarLibro' name='publicarLibro".$fila['id']."' id='".$fila['id']."'></button>";
                $salida .= "<button type='button' class='btn btn-secondary bi-eye-slash-fill ms-2 ocultarLibro' name='ocultarLibro".$fila['id']."' id='".$fila['id']."' hidden></button>";
            } else {
                $salida .= "<button type='button' class='btn btn-warning bi-eye-fill text-white ms-2 publicarLibro' name='publicarLibro".$fila['id']."' id='".$fila['id']."' hidden></button>";
                $salida .= "<button type='button' class='btn btn-secondary bi-eye-slash-fill ms-2 ocultarLibro' name='ocultarLibro".$fila['id']."' id='".$fila['id']."'></button>";
            }
            if ($fila['esDestacado'] == 0) {
                $salida .= "<button type='button' class='btn btn-success bi-star-fill ms-2 destacarLibro' name='destacarLibro".$fila['id']."' id='".$fila['id']."'></button>";
                $salida .= "<button type='button' class='btn btn-danger bi-star ms-2 quitarLibro' name='quitarLibro".$fila['id']."' id='".$fila['id']."' hidden></button>";
            } else {
                $salida .= "<button type='button' class='btn btn-success bi-star-fill ms-2 destacarLibro' name='destacarLibro".$fila['id']."' id='".$fila['id']."' hidden></button>";
                $salida .= "<button type='button' class='btn btn-danger bi-star ms-2 quitarLibro' name='quitarLibro".$fila['id']."' id='".$fila['id']."'></button>";
            }
            $salida .= "</td>";
            $salida .= "</tr>";
        }

        $salida .= "</tbody>";
        $salida .= "</table>";

        return $salida;*/
    }

    public function mostrarLibros() {
        $consulta = "SELECT l.id, l.titulo, CONCAT(a.nombre, ' ', a.apellidos) AS autor, c.nombre AS categoria, l.imagenPortada, l.estaPublicado, l.esDestacado FROM libro l JOIN autor a ON (l.autorId = a.id) JOIN categoria c ON (l.categoriaId = c.id) ORDER BY l.titulo ASC";
        return $this->db->result_query($consulta);
    }

}