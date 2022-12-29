<?php

include_once 'IRepositorioAutor.php';
include_once RUTA_APP . '/modelos/Autor.php';

class RepositorioAutor implements IRepositorioAutor {

    // Atributos de la Clase
    private Conexion $db;

    // Método Constructor de la Clase
    public function __construct() {
        $this->db = new Conexion(new mysqli(HOST, USER, PASS, NAME));
    }

    // Implementamos los métodos de la interfaz 'IRepositorioAutor'
    public function crearAutor(Autor $autor) {
        $nombre = $autor->getNombre();
        $apellidos = $autor->getApellidos();
        $fechaNacimiento = $autor->getFechaNacimiento();
        $pais = $autor->getPaisId();

        $consulta = $this->db->query("INSERT INTO autor VALUES (DEFAULT, '$nombre', '$apellidos', '$fechaNacimiento', '$pais')");
        $autor->setId($this->db->lastInsertedId());
        return $consulta;
    }

    public function editarAutor(Autor $autor) {
        $id = $autor->getId();
        $nombre = $autor->getNombre();
        $apellidos = $autor->getApellidos();
        $fechaNacimiento = $autor->getFechaNacimiento();
        $pais = $autor->getPaisId();

        return $this->db->query("UPDATE autor SET nombre='$nombre', apellidos='$apellidos', fechaNacimiento='$fechaNacimiento', paisId='$pais' WHERE id='$id'");
    }

    public function eliminarAutor(Autor $autor) {
        $id = $autor->getId();
        return $this->db->query("DELETE FROM autor WHERE id='" . $id . "'");
    }

    public function eliminarAutores($autores) {
        foreach ($autores as $autor) {
            $eliminacion = $this->db->query("DELETE FROM autor WHERE id='" . $autor->getId() . "'");
        }
        return $eliminacion;
    }

    public function buscarPorId($id): ?Autor {
        $consulta = $this->db->query("SELECT * FROM autor WHERE id='$id'");
        $data = $consulta->fetch_object();
        if (isset($data->nombre)) {
            return new Autor($id, $data->nombre, $data->apellidos, $data->fechaNacimiento, $data->paisId);
        } else {
            return null;
        }
    }

    public function mostrarAutores(): array {
        $consulta = "SELECT a.id, a.nombre AS nombreAutor, a.apellidos, DATE_FORMAT(a.fechaNacimiento, '%d-%m-%Y') AS fechaNac, p.nombre AS pais FROM autor a JOIN pais p ON (a.paisId = p.id) ORDER BY a.nombre ASC";
        return $this->db->result_query($consulta);
    }

    public function buscarPorApellidos($texto): array {
        $textoBusqueda = $this->db->realEscapeString($texto);
        $consulta = "SELECT a.id, a.nombre AS nombreAutor, a.apellidos, DATE_FORMAT(a.fechaNacimiento, '%d-%m-%Y') AS fechaNac, p.nombre AS pais FROM autor a JOIN pais p ON (a.paisId = p.id) WHERE a.apellidos LIKE '%{$textoBusqueda}%' ORDER BY a.nombre ASC";
        return $this->db->result_query($consulta);
    }

}