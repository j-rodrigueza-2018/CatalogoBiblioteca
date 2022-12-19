<?php

class Core {

    // Atributos de la Clase
    protected $controlador = 'Usuarios';
    protected $metodo = 'index';
    protected $parametros = [];

    // Método Constructor de la Clase
    public function __construct() {
        // Controladores
        $url = $this->url();
        if (isset($url[0])) {
            if (file_exists('../app/controladores/' . ucwords($url[0]) . '.php')) {
                $this->controlador = ucwords($url[0]);
                unset($url[0]);
            }
        }

        require_once '../app/controladores/'.$this->controlador.'.php';
        $this->controlador = new $this->controlador;

        // Métodos
        if (isset($url[1])) {
            if (method_exists($this->controlador, $url[1])) {
                $this->metodo = $url[1];
                unset($url[1]);
            }
        }

        // Parámetros (se eliminaron las posiciones 0 y 1 del array de la URL para dejar solo los parámetros)
        $this->parametros = $url ? array_values($url) : [];

        // Devolvemos un array de parámetros
        call_user_func_array([$this->controlador,$this->metodo], $this->parametros);
    }

    // Método que nos devuelve la URL
    public function url() {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'],'/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }

}