$(document).ready(function() {
    $('#cajaBusqueda').on('keyup', function() {
        let busqueda = $('#cajaBusqueda').val();
        $.ajax({
            type: 'POST',
            url: 'http://localhost/CatalogoBiblioteca/autores/buscarAutores',
            data: {'busqueda': busqueda},
        }).done(function(respuesta) {
            $('#tablaDatosAutores').html(respuesta);
        }).fail(function() {
           alert('Hubo un error');
        });
    });
});