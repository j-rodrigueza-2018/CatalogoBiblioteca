<?php

class ModeloGestor {

    // Atributos de la Clase
    private $db;

    // Método Constructor de la Clase
    public function __construct() {
        $this->db = new Conexion();
    }

    // Método que nos permite dar de alta un libro
    public function crearNuevoLibro($data) {
        $nombre = $data['nombre'];
        $apellidos = $data['apellidos'];
        $fechaNacimiento = $data['fechaNacimiento'];
        $paisOrigen = $data['paisOrigen'];

        $insercion = $this->db->query("INSERT INTO autor VALUES (DEFAULT, '$nombre', '$apellidos', '$fechaNacimiento', '$paisOrigen')");
        return $insercion;
    }

}