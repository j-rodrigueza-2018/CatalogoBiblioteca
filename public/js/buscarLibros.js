$(document).ready(function() {
    $('#buscarLibroCatalogo').on('click', function() {
        let titulo = $('#buscaTituloCatalogo').val();
        let autor = $('#selectAutorCatalogo').val();
        let categoria = $('#selectCategoriaCatalogo').val();
        let busqueda = [titulo, autor, categoria];
        $.ajax({
            type: 'POST',
            url: 'http://localhost/CatalogoBiblioteca/usuarios/buscarLibros',
            data: {'busqueda': busqueda},
        }).done(function(respuesta) {
            $('#librosCatalogo').html(respuesta);
        }).fail(function() {
            alert('Hubo un error');
        });
    });
});