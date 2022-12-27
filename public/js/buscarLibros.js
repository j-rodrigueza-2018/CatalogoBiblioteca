$(document).ready(function() {
    $('#buscarLibroCatalogo').on('click', function() {
        let titulo = $('#buscaTituloCatalogo').val();
        let autor = $('#selectAutorCatalogo').val();
        let categoria = $('#selectCategoriaCatalogo').val();
        let busqueda = [titulo, autor, categoria];
        $.ajax({
            method: 'POST',
            url: 'http://localhost/CatalogoBiblioteca/biblioteca/buscarLibros',
            data: {'busqueda': busqueda},
        }).done(function(respuesta) {
            $('#librosCatalogo').html(respuesta);
        }).fail(function() {
            alert('Hubo un error');
        });
    });

    $('#buscarLibroGestor').on('click', function() {
        let titulo = $('#buscaTituloGestor').val();
        let autor = $('#selectAutorGestor').val();
        let categoria = $('#selectCategoriaGestor').val();
        let busqueda = [titulo, autor, categoria];
        $.ajax({
            method: 'POST',
            url: 'http://localhost/CatalogoBiblioteca/libros/buscarLibros',
            data: {'busqueda': busqueda},
        }).done(function(respuesta) {
            $('#tablaDatosLibros').html(respuesta);
        }).fail(function() {
            alert('Hubo un error');
        });
    });
});