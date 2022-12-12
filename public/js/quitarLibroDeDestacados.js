$(document).ready(function() {
    $(".quitarLibro").click(function() {
        let datos = $(this).attr("id");
        $.ajax({
            type: "POST",
            url: "http://localhost/CatalogoBiblioteca/gestor/quitarLibro",
            data: {datos: datos},
            success: function(data) {
                alert('Libro eliminado de la sección de destacados con éxito');
            },
            error: function(xhr, httpStatusMessage) {
                if (xhr.status === 500) {
                    alert('El libro no se puede quitar de destacados porque no ha sido publicado con anterioridad');
                }
            }
        });
    });
});