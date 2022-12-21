<?php

class RepositorioCategoria implements IRepositorioCategoria {

    // Atributos de la Clase
    private Conexion $db;

    // Método Constructor de la Clase
    public function __construct() {
        $this->db = new Conexion();
    }

    // Implementamos los métodos de la interfaz 'IRepositorioCategoria'
    public function getCategorias() {
        $consulta = $this->db->query("SELECT * FROM categoria");
        return mysqli_fetch_all($consulta, MYSQLI_ASSOC);
    }

}