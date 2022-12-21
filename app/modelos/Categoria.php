<?php

class Categoria {

    // Atributos de la Clase
    private int $id;
    private string $nombre;

    // Método Constructor de la Clase
    public function __construct(int $id, string $nombre) {
        $this->id = $id;
        $this->nombre = $nombre;
    }

    // Métodos 'get' y 'set' de la Clase
    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

}