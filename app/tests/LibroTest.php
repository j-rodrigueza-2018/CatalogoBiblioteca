<?php

include_once 'app/config/config.php';
include_once 'app/librerias/Conexion.php';
include_once 'app/modelos/Libro.php';
include_once 'app/repositorios/RepositorioLibro.php';

use PHPUnit\Framework\TestCase;

class LibroTest extends TestCase {

    // Atributos de la Clase
    private static ?Libro $libro;
    private static ?RepositorioLibro $repositorioLibro;

    // Establecemos los parámetros por defecto para los métodos en el método 'setUpBeforeClass'
    public static function setUpBeforeClass(): void {
        self::$libro = new Libro(0, 'Manual de Espumas', 31, 11, 'Sinopsis de prueba', 'Manual_de_Espumas_20225.jpg');
        self::$repositorioLibro = new RepositorioLibro();
    }

    // Eliminamos cualquier dato almacenado durante los tests mediante el método 'tearDownAfterClass'
    public static function tearDownAfterClass(): void {
        self::$libro = null;
        self::$repositorioLibro = null;
    }

    // Comprobamos que funciona el método de crear un libro
    public function testCrearLibro() {
        // Creamos el libro en la base de datos
        self::$repositorioLibro->crearLibro(self::$libro);
        // Obtenemos el libro creado en la base de datos a través de su id
        $libroBD = self::$repositorioLibro->buscarPorId(self::$libro->getId());
        // Comprobamos si el libro original es igual al obtenido en la base de datos
        $this->assertEquals(self::$libro, $libroBD);
    }

    // Comprobamos que funciona el método de editar un libro cambiando el título y la sinopsis al libro
    public function testEditarLibro() {
        // Cambiamos el título y la sinopsis del libro
        self::$libro->setTitulo('Manual de Espumas 2');
        self::$libro->setSinopsis('Sinopsis nueva');
        // Editamos el libro en la base de datos con los nuevos datos
        self::$repositorioLibro->editarLibro(self::$libro);
        // Obtenemos el libro editado en la base de datos a través de su id
        $libroBD = self::$repositorioLibro->buscarPorId(self::$libro->getId());
        $this->assertEquals(self::$libro, $libroBD);
    }

    // Comprobamos que funciona el método de publicar un libro
    public function testPublicarLibro() {
        // Publicamos el libro en la base de datos con los nuevos datos
        self::$repositorioLibro->publicarLibro(self::$libro);
        // Comprobamos que el libro se ha publicado de manera correcta mirando si el atributo 'estaPublicado' es igual a 1
        $this->assertEquals(self::$libro->getEstaPublicado(), 1);
    }

    // Comprobamos que funciona el método de ocultar un libro
    public function testOcultarLibro() {
        // Publicamos el libro en la base de datos con los nuevos datos
        self::$repositorioLibro->ocultarLibro(self::$libro);
        // Comprobamos que el libro se ha ocultado de manera correcta mirando si el atributo 'estaPublicado' es igual a 1
        $this->assertEquals(self::$libro->getEstaPublicado(), 0);
    }

    // Comprobamos que funciona el método de destacar un libro
    public function testDestacarLibro() {
        // Destacamos el libro en la base de datos con los nuevos datos
        self::$repositorioLibro->destacarLibro(self::$libro);
        // Comprobamos que el libro se ha publicado de manera correcta mirando si el atributo 'estaPublicado' es igual a 1
        $this->assertEquals(self::$libro->getEsDestacado(), 1);
    }

    // Comprobamos que funciona el método de quitar un libro de destacados
    public function testQuitarLibro() {
        // Destacamos el libro en la base de datos con los nuevos datos
        self::$repositorioLibro->quitarLibro(self::$libro);
        // Comprobamos que el libro se ha publicado de manera correcta mirando si el atributo 'estaPublicado' es igual a 1
        $this->assertEquals(self::$libro->getEsDestacado(), 0);
    }

    // Comprobamos que funciona el método de eliminar un libro
    public function testEliminarLibro() {
        // Eliminamos el libro de la base de datos
        self::$repositorioLibro->eliminarLibro(self::$libro);
        // Intentamos obtener el libro eliminado de la base de datos a través de su id
        $libroBD = self::$repositorioLibro->buscarPorId(self::$libro->getId());
        // Comprobamos si el valor obtenido es 'null', ya que si es así, la eliminación se habrá realizado correctamente
        $this->assertNull($libroBD);
    }

}
