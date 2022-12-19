<?php

class ModeloLibro {

    // Atributos de la Clase
    private $db;

    // Método Constructor de la Clase
    public function __construct() {
        $this->db = new Conexion();
    }

    // Método que nos permite dar de alta un libro en el catálogo
    public function crearNuevoLibro($data) {
        $titulo = $data['titulo'];
        $autor = $data['autor'];
        $categoria = $data['categoria'];
        $sinopsis = $data['sinopsis'];
        $imagenPortada = $data['imagenPortada'];

        $insercion = $this->db->query("INSERT INTO libro VALUES (DEFAULT, '$titulo', '$autor', '$categoria', '$sinopsis', '$imagenPortada', 0, 0)");
        return $insercion;
    }

    // Método que nos permite eliminar libros
    public function eliminarLibros($data) {
        foreach ($data as $d) {
            $borrarImg = RUTA_IMG.'/public/imagenesPortada/'.$d[1];
            unlink($borrarImg);
            $eliminacion = $this->db->query("DELETE FROM libro WHERE id='".$d[0]."'");
        }
        return $eliminacion;
    }

    // Método que nos permite eliminar un libro en concreto
    public function eliminarLibro($id, $imagen) {
        $borrarImg = RUTA_IMG.'/public/imagenesPortada/'.$imagen;
        unlink($borrarImg);
        $eliminacion = $this->db->query("DELETE FROM libro WHERE id='".$id."'");
        return $eliminacion;
    }

    // Método que nos devuelve un libro (con sus datos) a partir de su Id
    public function libroPorId($id) {
        $consulta = $this->db->query("SELECT * FROM libro WHERE id='".$id."'");
        $data = $consulta->fetch_object();
        return $data;
    }

    // Método que nos permite actualizar los datos de un libro
    public function actualizarLibro($data) {
        $id = $data['id'];
        $titulo = $data['titulo'];
        $autor = $data['autor'];
        $categoria = $data['categoria'];
        $sinopsis = $data['sinopsis'];
        $imagenPortada = $data['imagenPortada'];

        $update = $this->db->query("UPDATE libro SET titulo='$titulo', autorId='$autor', categoriaId='$categoria', sinopsis='$sinopsis', imagenPortada='$imagenPortada' WHERE id='".$id."'");
        return $update;
    }

    // Método que nos permite publicar libros en el catálogo
    public function publicarLibros($data) {
        foreach ($data as $id) {
            $publicacion = $this->db->query("UPDATE libro SET enCatalogo=1 WHERE id='".$id[0]."'");
        }
        return $publicacion;
    }

    // Método que nos permite publicar un libro en concreto en el catálogo
    public function publicarLibro($id) {
        $publicacion = $this->db->query("UPDATE libro SET enCatalogo=1 WHERE id='".$id."'");
        return $publicacion;
    }

    // Método que nos permite ocultar libros en el catálogo
    public function ocultarLibros($data) {
        foreach ($data as $id) {
            $ocultacion = $this->db->query("UPDATE libro SET enCatalogo=0 WHERE id='".$id[0]."'");
        }
        return $ocultacion;
    }

    // Método que nos permite ocultar un libro en concreto en el catálogo
    public function ocultarLibro($id) {
        $ocultacion = $this->db->query("UPDATE libro SET enCatalogo=0 WHERE id='".$id."'");
        return $ocultacion;
    }

    // Método que nos permite destacar un libro en concreto en el catálogo
    public function destacarLibro($id) {
        $destacado = $this->db->query("UPDATE libro SET destacado=1 WHERE id='".$id."'");
        return $destacado;
    }

    // Método para quitar de los libros destacados a un libro concreto en el catálogo
    public function quitarLibro($id) {
        $destacado = $this->db->query("UPDATE libro SET destacado=0 WHERE id='".$id."'");
        return $destacado;
    }

    // Método privado que nos devuelve un libro en función de los filtros aplicados
    private function obtenerPorFiltro($data) {
        $titulo = $data[0];
        $autor = $data[1];
        $categoria = $data[2];

        if ($autor == null && $categoria == null) {
            $consulta = $this->db->query("SELECT l.id, l.titulo, CONCAT(a.nombre, ' ', a.apellidos) AS autor, c.nombre AS categoria, l.imagenPortada, l.enCatalogo, l.destacado FROM libro l JOIN autor a ON (l.autorId = a.id) JOIN categoria c ON (l.categoriaId = c.id) WHERE l.titulo LIKE '%{$titulo}%' ORDER BY l.titulo ASC");
        } elseif ($titulo == null && $autor == null) {
            $consulta = $this->db->query("SELECT l.id, l.titulo, CONCAT(a.nombre, ' ', a.apellidos) AS autor, c.nombre AS categoria, l.imagenPortada, l.enCatalogo, l.destacado FROM libro l JOIN autor a ON (l.autorId = a.id) JOIN categoria c ON (l.categoriaId = c.id) WHERE c.nombre = '$categoria' ORDER BY l.titulo ASC");
        } elseif ($titulo == null && $categoria == null) {
            $consulta = $this->db->query("SELECT l.id, l.titulo, CONCAT(a.nombre, ' ', a.apellidos) AS autor, c.nombre AS categoria, l.imagenPortada, l.enCatalogo, l.destacado FROM libro l JOIN autor a ON (l.autorId = a.id) JOIN categoria c ON (l.categoriaId = c.id) WHERE CONCAT(a.nombre, ' ', a.apellidos)='$autor' ORDER BY l.titulo ASC");
        } elseif ($titulo == null) {
            $consulta = $this->db->query("SELECT l.id, l.titulo, CONCAT(a.nombre, ' ', a.apellidos) AS autor, c.nombre AS categoria, l.imagenPortada, l.enCatalogo, l.destacado FROM libro l JOIN autor a ON (l.autorId = a.id) JOIN categoria c ON (l.categoriaId = c.id) WHERE CONCAT(a.nombre, ' ', a.apellidos)='$autor' AND c.nombre = '$categoria' ORDER BY l.titulo ASC");
        } elseif ($autor == null) {
            $consulta = $this->db->query("SELECT l.id, l.titulo, CONCAT(a.nombre, ' ', a.apellidos) AS autor, c.nombre AS categoria, l.imagenPortada, l.enCatalogo, l.destacado FROM libro l JOIN autor a ON (l.autorId = a.id) JOIN categoria c ON (l.categoriaId = c.id) WHERE l.titulo LIKE '%{$titulo}%' AND c.nombre = '$categoria' ORDER BY l.titulo ASC");
        } elseif ($categoria == null) {
            $consulta = $this->db->query("SELECT l.id, l.titulo, CONCAT(a.nombre, ' ', a.apellidos) AS autor, c.nombre AS categoria, l.imagenPortada, l.enCatalogo, l.destacado FROM libro l JOIN autor a ON (l.autorId = a.id) JOIN categoria c ON (l.categoriaId = c.id) WHERE l.titulo LIKE '%{$titulo}%' AND CONCAT(a.nombre, ' ', a.apellidos)='$autor' ORDER BY l.titulo ASC");
        } else {
            $consulta = $this->db->query("SELECT l.id, l.titulo, CONCAT(a.nombre, ' ', a.apellidos) AS autor, c.nombre AS categoria, l.imagenPortada, l.enCatalogo, l.destacado FROM libro l JOIN autor a ON (l.autorId = a.id) JOIN categoria c ON (l.categoriaId = c.id) WHERE l.titulo LIKE '%{$titulo}%' AND CONCAT(a.nombre, ' ', a.apellidos)='$autor' AND c.nombre = '$categoria' ORDER BY l.titulo ASC");
        }

        return $consulta;
    }

    // Método que nos devuelve los libros de nuestra base de datos
    public function buscarLibros($data) {
        $salida = "<table class='table table-bordered'>
                    <thead>
                    <tr>
                        <th scope='col'></th>
                        <th scope='col' class='text-center'>Título</th>
                        <th scope='col' class='text-center d-none d-sm-none d-md-none d-lg-none d-xl-table-cell'>Autor</th>
                        <th scope='col' class='text-center d-none d-sm-none d-md-none d-lg-none d-xl-table-cell'>Categoría</th>
                        <th scope='col' class='text-center'>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
        ";

        $consulta = $this->obtenerPorFiltro($data);
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
            $location = RUTA_PUBLIC.'/gestor/vistaEditarLibro/'.$fila['id'];
            $salida .= "<button type='button' class='btn btn-primary bi-pencil-square ms-2' onclick='location.href=\"$location\"'></button>";
            if ($fila['enCatalogo'] == 0) {
                $salida .= "<button type='button' class='btn btn-warning bi-eye-fill text-white ms-2 publicarLibro' name='publicarLibro".$fila['id']."' id='".$fila['id']."'></button>";
                $salida .= "<button type='button' class='btn btn-secondary bi-eye-slash-fill ms-2 ocultarLibro' name='ocultarLibro".$fila['id']."' id='".$fila['id']."' hidden></button>";
            } else {
                $salida .= "<button type='button' class='btn btn-warning bi-eye-fill text-white ms-2 publicarLibro' name='publicarLibro".$fila['id']."' id='".$fila['id']."' hidden></button>";
                $salida .= "<button type='button' class='btn btn-secondary bi-eye-slash-fill ms-2 ocultarLibro' name='ocultarLibro".$fila['id']."' id='".$fila['id']."'></button>";
            }
            if ($fila['destacado'] == 0) {
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

        return $salida;
    }

}
