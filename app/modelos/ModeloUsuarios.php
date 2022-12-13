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

        if ($autor == null && $categoria == null) {
            $consulta = $this->db->query("SELECT c.*, l.id AS idLibro, l.titulo, l.imagenPortada FROM catalogo c JOIN libro l ON (c.libroId = l.id) WHERE l.titulo LIKE '%{$titulo}%' ORDER BY l.titulo");
        } elseif ($titulo == null && $autor == null) {
            $consulta = $this->db->query("SELECT c.*, l.id AS idLibro, l.titulo, l.imagenPortada, cat.nombre FROM catalogo c JOIN libro l ON (c.libroId = l.id) JOIN categoria cat ON (l.categoriaId = cat.id) WHERE cat.nombre = '$categoria' ORDER BY l.titulo");
        } elseif ($titulo == null && $categoria == null) {
            $consulta = $this->db->query("SELECT c.*, l.id AS idLibro, l.titulo, l.imagenPortada, CONCAT(a.nombre, ' ', a.apellidos) FROM catalogo c JOIN libro l ON (c.libroId = l.id) JOIN autor a ON (l.autorId = a.id) WHERE CONCAT(a.nombre, ' ', a.apellidos)='$autor' ORDER BY l.titulo");
        } elseif ($titulo == null) {
            $consulta = $this->db->query("SELECT c.*, l.id AS idLibro, l.titulo, l.imagenPortada, CONCAT(a.nombre, ' ', a.apellidos), cat.nombre FROM catalogo c JOIN libro l ON (c.libroId = l.id) JOIN autor a ON (l.autorId = a.id) JOIN categoria cat ON (l.categoriaId = cat.id) WHERE CONCAT(a.nombre, ' ', a.apellidos)='$autor' AND cat.nombre = '$categoria' ORDER BY l.titulo");
        } elseif ($autor == null) {
            $consulta = $this->db->query("SELECT c.*, l.id AS idLibro, l.titulo, l.imagenPortada, CONCAT(a.nombre, ' ', a.apellidos), cat.nombre FROM catalogo c JOIN libro l ON (c.libroId = l.id) JOIN autor a ON (l.autorId = a.id) JOIN categoria cat ON (l.categoriaId = cat.id) WHERE l.titulo LIKE '%{$titulo}%' AND cat.nombre = '$categoria' ORDER BY l.titulo");
        } elseif ($categoria == null) {
            $consulta = $this->db->query("SELECT c.*, l.id AS idLibro, l.titulo, l.imagenPortada, CONCAT(a.nombre, ' ', a.apellidos), cat.nombre FROM catalogo c JOIN libro l ON (c.libroId = l.id) JOIN autor a ON (l.autorId = a.id) JOIN categoria cat ON (l.categoriaId = cat.id) WHERE l.titulo LIKE '%{$titulo}%' AND CONCAT(a.nombre, ' ', a.apellidos)='$autor' ORDER BY l.titulo");
        } else {
            $consulta = $this->db->query("SELECT c.*, l.id AS idLibro, l.titulo, l.imagenPortada, CONCAT(a.nombre, ' ', a.apellidos), cat.nombre FROM catalogo c JOIN libro l ON (c.libroId = l.id) JOIN autor a ON (l.autorId = a.id) JOIN categoria cat ON (l.categoriaId = cat.id) WHERE l.titulo LIKE '%{$titulo}%' AND CONCAT(a.nombre, ' ', a.apellidos)='$autor' AND cat.nombre = '$categoria' ORDER BY l.titulo");
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

        /*
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
        */
    }

}