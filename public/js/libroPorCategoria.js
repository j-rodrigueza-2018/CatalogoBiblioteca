$(document).ready(function() {
    $('.filtroCategoria').on('click', function() {
        let categoria = $('.filtroCategoria').innerText;
        $.ajax({
            type: 'POST',
            url: 'http://localhost/CatalogoBiblioteca/biblioteca/libroCategoria',
            data: {'categoria': categoria},
        }).done(function(respuesta) {
        });
    });
});