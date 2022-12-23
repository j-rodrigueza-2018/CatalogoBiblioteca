<?php

include_once 'IRepositorioAutor.php';
include_once RUTA_APP.'/modelos/Autor.php';

class RepositorioAutor implements IRepositorioAutor {

    // Atributos de la Clase
    private Conexion $db;

    // Método Constructor de la Clase
    public function __construct() {
        $this->db = new Conexion();
    }

    // Implementamos los métodos de la interfaz 'IRepositorioAutor'
    public function crearAutor(Autor $autor) {
        $nombre = $autor->getNombre();
        $apellidos = $autor->getApellidos();
        $fechaNacimiento = $autor->getFechaNacimiento();
        $pais = $autor->getPaisId();

        return $this->db->query("INSERT INTO autor VALUES (DEFAULT, '$nombre', '$apellidos', '$fechaNacimiento', '$pais')");
    }

    public function editarAutor(Autor $autor) {
        $id = $autor->getId();
        $nombre = $autor->getNombre();
        $apellidos = $autor->getApellidos();
        $fechaNacimiento = $autor->getFechaNacimiento();
        $pais = $autor->getPaisId();

        return $this->db->query("UPDATE autor SET nombre='$nombre', apellidos='$apellidos', fechaNacimiento='$fechaNacimiento', paisId='$pais' WHERE id='$id'");
    }

    public function eliminarAutor($id) {
        return $this->db->query("DELETE FROM autor WHERE id='".$id."'");
    }

    public function eliminarAutores($autores) {
        foreach ($autores as $id) {
            $eliminacion = $this->db->query("DELETE FROM autor WHERE id='".$id."'");
        }
        return $eliminacion;
    }

    public function buscarPorId($id): Autor {
        $consulta = $this->db->query("SELECT * FROM autor WHERE id='$id'");
        $data = $consulta->fetch_object();
        return new Autor($data->id, $data->nombre, $data->apellidos, $data->fechaNacimiento, $data->paisId);
    }

    // Método que nos devuelve autores (con sus datos) a partir de sus apellidos
    public function autorPorApellidos($texto): string {
        if (isset($texto)) {
            $con = $this->db->realEscapeString($texto);
            $consulta = "SELECT a.id, a.nombre AS nombreAutor, a.apellidos, DATE_FORMAT(a.fechaNacimiento, '%d-%m-%Y') AS fechaNac, p.nombre AS pais FROM autor a JOIN pais p ON (a.paisId = p.id) WHERE a.apellidos LIKE '%{$con}%' ORDER BY a.nombre ASC";
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
                                <td class='text-center text-center d-none d-sm-none d-md-table-cell d-lg-table-cell d-xl-table-cell'>".$fila['pais']."</td>
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

}