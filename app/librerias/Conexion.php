<?php

class Conexion {

    // Atributos
    private string $host = HOST;
    private string $user = USER;
    private string $pass = PASS;
    private string $dbname = NAME;
    protected array $rows = array();
    private mysqli $dbh;

    // Método Constructor
    public function __construct() {
        try {
            $this->dbh = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        } catch (mysqli_sql_exception $e) {
            $this->error = $e->getMessage();
        }
    }

    // Métodos públicos
    public function query($query) {
        return $this->dbh->query($query);
    }

    public function result_query($query): array {
        $result = $this->dbh->query($query);
        $num = mysqli_num_rows($result);
        while ($row = $result->fetch_object()) {
            $rows[] = $row;
        }
        if ($num == 0) {
            $rows = array();
        }
        return $rows;
    }

    public function realEscapeString($query) {
        return $this->dbh->real_escape_string($query);
    }

}