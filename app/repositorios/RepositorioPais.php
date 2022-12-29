<?php

class RepositorioPais implements IRepositorioPais {

    // Atributos de la Clase
    private Conexion $db;

    // Método Constructor de la Clase
    public function __construct() {
        $this->db = new Conexion(new mysqli(HOST, USER, PASS, NAME));
    }

    // Implementamos los métodos de la interfaz 'IRepositorioCategoria'
    public function getPaises() {
        $consulta = $this->db->query("SELECT * FROM pais");
        return mysqli_fetch_all($consulta, MYSQLI_ASSOC);
    }

}