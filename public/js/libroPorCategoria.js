$(document).ready(function() {
    $('.filtroCategoria').on('click', function() {
        let categoria = $('.filtroCategoria').val();
        $.ajax({
            type: 'POST',
            url: 'http://localhost/CatalogoBiblioteca/usuarios/libroCategoria',
            data: {'categoria': categoria},
        }).done(function(respuesta) {
            $('#librosCatalogo').html(respuesta);
        }).fail(function() {
            alert('Hubo un error');
        });
    });
});