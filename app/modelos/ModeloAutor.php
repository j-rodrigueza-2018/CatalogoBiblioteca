<?php

class ModeloAutor {

    // Atributos de la Clase
    private $db;

    // Método Constructor de la Clase
    public function __construct() {
        $this->db = new Conexion();
    }

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

}
