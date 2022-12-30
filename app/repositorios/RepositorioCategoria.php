<?php

include_once 'IRepositorioCategoria.php';
include_once RUTA_APP_FROM_REPOS.'/modelos/Categoria.php';

class RepositorioCategoria implements IRepositorioCategoria {

    // Atributos de la Clase
    private Conexion $db;

    // Método Constructor de la Clase
    public function __construct() {
        $this->db = new Conexion(new mysqli(HOST, USER, PASS, NAME));
    }

    // Implementamos los métodos de la interfaz 'IRepositorioCategoria'
    public function getCategorias() {
        $consulta = $this->db->query("SELECT * FROM categoria");
        return mysqli_fetch_all($consulta, MYSQLI_ASSOC);
    }

}