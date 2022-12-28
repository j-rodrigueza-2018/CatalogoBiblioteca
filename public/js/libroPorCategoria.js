$(document).ready(function() {
    $('.filtroCategoria').on('click', function() {
        let categoria = $('.filtroCategoria').innerText;
        $.ajax({
            type: 'POST',
            url: 'http://localhost/CatalogoBiblioteca/bibliotecaController/libroCategoria',
            data: {'categoria': categoria},
        }).done(function(respuesta) {
            $('#librosCatalogo').html(respuesta);
        }).fail(function() {
            alert('Hubo un error');
        });
    });
});