<?php

class Conexion {

    // Atributos
    private mysqli $dbh;

    // Método Constructor
    public function __construct(mysqli $dbh) {
        try {
            $this->dbh = $dbh;
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

    public function lastInsertedId() {
        return mysqli_insert_id($this->dbh);
    }

}