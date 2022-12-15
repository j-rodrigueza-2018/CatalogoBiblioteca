<?php

class ModeloGestor {

    // Atributos de la Clase
    private $db;

    // Método Constructor de la Clase
    public function __construct() {
        $this->db = new Conexion();
    }

    /* Métodos de las vistas de los Libros */

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
        $destacado = $this->db->query("UPDATE catalogo SET destacado=0 WHERE id='".$id."'");
        return $destacado;
    }

    // Método que nos devuelve los libros de nuestra base de datos
    public function buscarLibros($data) {
        $titulo = $data[0];
        $autor = $data[1];
        $categoria = $data[2];

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

        if ($autor == null && $categoria == null) {
            $consulta = $this->db->query("SELECT l.id, l.titulo, CONCAT(a.nombre, ' ', a.apellidos) AS autor, c.nombre AS categoria, l.imagenPortada FROM libro l JOIN autor a ON (l.autorId = a.id) JOIN categoria c ON (l.categoriaId = c.id) WHERE l.titulo LIKE '%{$titulo}%' ORDER BY l.titulo ASC");
        } elseif ($titulo == null && $autor == null) {
            $consulta = $this->db->query("SELECT l.id, l.titulo, CONCAT(a.nombre, ' ', a.apellidos) AS autor, c.nombre AS categoria, l.imagenPortada FROM libro l JOIN autor a ON (l.autorId = a.id) JOIN categoria c ON (l.categoriaId = c.id) WHERE c.nombre = '$categoria' ORDER BY l.titulo ASC");
        } elseif ($titulo == null && $categoria == null) {
            $consulta = $this->db->query("SELECT l.id, l.titulo, CONCAT(a.nombre, ' ', a.apellidos) AS autor, c.nombre AS categoria, l.imagenPortada FROM libro l JOIN autor a ON (l.autorId = a.id) JOIN categoria c ON (l.categoriaId = c.id) WHERE CONCAT(a.nombre, ' ', a.apellidos)='$autor' ORDER BY l.titulo ASC");
        } elseif ($titulo == null) {
            $consulta = $this->db->query("SELECT l.id, l.titulo, CONCAT(a.nombre, ' ', a.apellidos) AS autor, c.nombre AS categoria, l.imagenPortada FROM libro l JOIN autor a ON (l.autorId = a.id) JOIN categoria c ON (l.categoriaId = c.id) WHERE CONCAT(a.nombre, ' ', a.apellidos)='$autor' AND c.nombre = '$categoria' ORDER BY l.titulo ASC");
        } elseif ($autor == null) {
            $consulta = $this->db->query("SELECT l.id, l.titulo, CONCAT(a.nombre, ' ', a.apellidos) AS autor, c.nombre AS categoria, l.imagenPortada FROM libro l JOIN autor a ON (l.autorId = a.id) JOIN categoria c ON (l.categoriaId = c.id) WHERE l.titulo LIKE '%{$titulo}%' AND c.nombre = '$categoria' ORDER BY l.titulo ASC");
        } elseif ($categoria == null) {
            $consulta = $this->db->query("SELECT l.id, l.titulo, CONCAT(a.nombre, ' ', a.apellidos) AS autor, c.nombre AS categoria, l.imagenPortada FROM libro l JOIN autor a ON (l.autorId = a.id) JOIN categoria c ON (l.categoriaId = c.id) WHERE l.titulo LIKE '%{$titulo}%' AND CONCAT(a.nombre, ' ', a.apellidos)='$autor' ORDER BY l.titulo ASC");
        } else {
            $consulta = $this->db->query("SELECT l.id, l.titulo, CONCAT(a.nombre, ' ', a.apellidos) AS autor, c.nombre AS categoria, l.imagenPortada FROM libro l JOIN autor a ON (l.autorId = a.id) JOIN categoria c ON (l.categoriaId = c.id) WHERE l.titulo LIKE '%{$titulo}%' AND CONCAT(a.nombre, ' ', a.apellidos)='$autor' AND c.nombre = '$categoria' ORDER BY l.titulo ASC");
        }
        while ($fila = mysqli_fetch_assoc($consulta)) {
            $salida .= "<tr id='idLibro".$fila['id']."'>";
            $salida .= "<td class='text-center'>";
            $salida .= "<input type='checkbox' name='ids[]' class='deleteCheckbox' value='".$fila['id']."-".$fila['imagenPortada']."'>";
            $salida .= "</td>";
            $salida .= "<td class='text-center'>".$fila['titulo']."</td>";
            $salida .= "<td class='text-center d-none d-sm-none d-md-none d-lg-none d-xl-table-cell'>".$fila['autor']."</td>";
            $salida .= "<td class='text-center d-none d-sm-none d-md-none d-lg-none d-xl-table-cell'>".$fila['categoria']."</td>";
            $salida .= "<td class='text-lg-center'>";
            $salida .= "<button type='button' class='btn btn-danger bi-trash elimLibro' id='".$fila['id']."-".$fila['imagenPortada']."'></button>";
            $location = RUTA_PUBLIC.'/gestor/vistaEditarLibro/'.$fila['id'];
            $salida .= "<button type='button' class='btn btn-primary bi-pencil-square ms-2' onclick='location.href=\"$location\"'></button>";
            $salida .= "<button type='button' class='btn btn-warning bi-eye-fill text-white ms-2 publicarLibro' id='".$fila['id']."'></button>";
            $salida .= "<button type='button' class='btn btn-secondary bi-eye-slash-fill ms-2 ocultarLibro' id='".$fila['id']."' hidden></button>";
            $salida .= "<button type='button' class='btn btn-success bi-star-fill ms-2 destacarLibro' id='".$fila['id']."'></button>";
            $salida .= "<button type='button' class='btn btn-danger bi-star ms-2 quitarLibro' id='".$fila['id']."' hidden></button>";
            $salida .= "</td>";
            $salida .= "</tr>";
        }

        $salida .= "</tbody>";
        $salida .= "</table>";

        return $salida;
    }

    /* ------------------------------------ */

    /* Métodos de las vistas de los Autores */

    // Método que nos permite dar de alta un autor
    public function crearNuevoAutor($data) {
        $nombre = $data['nombre'];
        $apellidos = $data['apellidos'];
        $fechaNacimiento = $data['fechaNacimiento'];
        $paises = $data['paises'];

        $insercion = $this->db->query("INSERT INTO autor VALUES (DEFAULT, '$nombre', '$apellidos', '$fechaNacimiento', '$paises')");
        return $insercion;
    }

    // Método que nos permite dar de baja autores
    public function eliminarAutores($data) {
        foreach ($data as $id) {
            $eliminacion = $this->db->query("DELETE FROM autor WHERE id='".$id."'");
        }
        return $eliminacion;
    }

    // Método que nos permite dar de baja un autor en concreto
    public function eliminarAutor($id) {
        $eliminacion = $this->db->query("DELETE FROM autor WHERE id='".$id."'");
        return $eliminacion;
    }

    // Método que nos devuelve un autor (con sus datos) a partir de su Id
    public function autorPorId($id) {
        $consulta = $this->db->query("SELECT * FROM autor WHERE id='$id'");
        $data = $consulta->fetch_object();
        return $data;
    }

    // Método que nos permite actualizar los datos de un autor
    public function actualizarAutor($data) {
        $id = $data['id'];
        $nombre = $data['nombre'];
        $apellidos = $data['apellidos'];
        $fechaNacimiento = $data['fechaNacimiento'];
        $paises = $data['paises'];

        $update = $this->db->query("UPDATE autor SET nombre='$nombre', apellidos='$apellidos', fechaNacimiento='$fechaNacimiento', paisId='$paises' WHERE id='$id'");
        return $update;
    }

    // Método que nos devuelve autores (con sus datos) a partir de sus apellidos
    public function autorPorApellidos($texto) {
        if (isset($texto)) {
            $con = $this->db->realEscapeString($texto);
            $consulta = "SELECT a.id, a.nombre AS nombreAutor, a.apellidos, DATE_FORMAT(a.fechaNacimiento, '%d-%m-%Y') AS fechaNac, p.nombre AS paises FROM autor a JOIN paises p ON (a.paisId = p.id) WHERE a.apellidos LIKE '%{$con}%' ORDER BY a.nombre ASC";
        }

        $resultado = $this->db->query($consulta);
        $salida = "<table class='table table-bordered'>
                    <thead>
                        <tr>
                            <th scope='col'></th>
                            <th scope='col' class='text-center'>Nombre</th>
                            <th scope='col' class='text-center'>Apellidos</th>
                            <th scope='col' class='text-center d-none d-sm-none d-md-table-cell d-lg-table-cell d-xl-table-cell'>Fecha de Nacimiento</th>
                            <th scope='col' class='text-center d-none d-sm-none d-md-table-cell d-lg-table-cell d-xl-table-cell'>País de Origen</th>
                            <th scope='col' class='text-center'>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>";
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $location = RUTA_PUBLIC.'/gestor/vistaEditarAutor/'.$fila['id'];
                $salida .= "<tr id='id".$fila['id']."'>
                                <td class='text-center'>
                                    <input type='checkbox' name='ids[]' class='deleteCheckbox' value='".$fila['id']."'>
                                </td>
                                <td class='text-center'>".$fila['nombreAutor']."</td>
                                <td class='text-center'>".$fila['apellidos']."</td>
                                <td class='text-center text-center d-none d-sm-none d-md-table-cell d-lg-table-cell d-xl-table-cell'>".$fila['fechaNac']."</td>
                                <td class='text-center text-center d-none d-sm-none d-md-table-cell d-lg-table-cell d-xl-table-cell'>".$fila['paises']."</td>
                                <td class='text-center'>
                                    <button type='button' class='btn btn-danger bi-trash elimAutor' id='".$fila['id']."'></button>
                                    <button type='button' class='btn btn-primary bi-pencil-square ms-2' onclick='location.href=\"$location\"'></button>
                                </td>
                            </tr>";
            }
            $salida .= "</tbody></table>";
        }

        return $salida;
    }

    /* ------------------------------------ */

}