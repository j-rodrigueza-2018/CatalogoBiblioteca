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

        $insercion = $this->db->query("INSERT INTO libro VALUES (DEFAULT, '$titulo', '$autor', '$categoria', '$sinopsis', '$imagenPortada')");
        return $insercion;
    }

    // Método que nos permite dar de baja autores
    public function eliminarLibros($data) {
        foreach ($data as $d) {
            $borrarImg = RUTA_IMG.'/public/imagenesPortada/'.$d[1];
            unlink($borrarImg);
            $eliminacion = $this->db->query("DELETE FROM libro WHERE id='".$d[0]."'");
        }
        return $eliminacion;
    }

    // Método que nos permite dar de baja un autor en concreto
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

    /* ------------------------------------ */

    /* Métodos de las vistas de los Autores */

    // Método que nos permite dar de alta un autor
    public function crearNuevoAutor($data) {
        $nombre = $data['nombre'];
        $apellidos = $data['apellidos'];
        $fechaNacimiento = $data['fechaNacimiento'];
        $paisOrigen = $data['paisOrigen'];

        $insercion = $this->db->query("INSERT INTO autor VALUES (DEFAULT, '$nombre', '$apellidos', '$fechaNacimiento', '$paisOrigen')");
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
        $paisOrigen = $data['paisOrigen'];

        $update = $this->db->query("UPDATE autor SET nombre='$nombre', apellidos='$apellidos', fechaNacimiento='$fechaNacimiento', paisOrigenId='$paisOrigen' WHERE id='$id'");
        return $update;
    }

    // Método que nos devuelve autores (con sus datos) a partir de sus apellidos
    public function autorPorApellidos($texto) {
        if (isset($texto)) {
            $con = $this->db->realEscapeString($texto);
            $consulta = "SELECT a.id, a.nombre AS nombreAutor, a.apellidos, DATE_FORMAT(a.fechaNacimiento, '%d-%m-%Y') AS fechaNac, p.nombre AS paisOrigen FROM autor a JOIN paisOrigen p ON (a.paisOrigenId = p.id) WHERE a.apellidos LIKE '%{$con}%' ORDER BY a.nombre ASC";
        }

        $resultado = $this->db->query($consulta);
        $salida = "<table class='table table-bordered'>
                    <thead>
                        <tr>
                            <th scope='col'></th>
                            <th scope='col' class='text-center'>Nombre</th>
                            <th scope='col' class='text-center'>Apellidos</th>
                            <th scope='col' class='text-center'>Fecha de Nacimiento</th>
                            <th scope='col' class='text-center'>País de Origen</th>
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
                                <td class='text-center'>".$fila['fechaNac']."</td>
                                <td class='text-center'>".$fila['paisOrigen']."</td>
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