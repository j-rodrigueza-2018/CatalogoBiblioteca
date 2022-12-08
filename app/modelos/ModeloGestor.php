<?php

class ModeloGestor {

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
        $paisOrigen = $data['paisOrigen'];

        $insercion = $this->db->query("INSERT INTO autor VALUES (DEFAULT, '$nombre', '$apellidos', '$fechaNacimiento', '$paisOrigen')");
        return $insercion;
    }

    // Método que nos permite dar de baja autores
    public function eliminarAutores($data) {
        foreach ($data as $id) {
            $eliminacion = $this->db->query("DELETE FROM autor WHERE id='".$id."'");
            return $eliminacion;
        }
    }

    // Método que nos permite dar de baja un autor en concreto
    public function eliminarAutor($id) {
        $eliminacion = $this->db->query("DELETE FROM autor WHERE id='".$id."'");
        return $eliminacion;
    }

}