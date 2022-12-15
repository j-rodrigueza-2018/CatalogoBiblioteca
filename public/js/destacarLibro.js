$(document).ready(function() {
    $(".destacarLibro").click(function() {
        let datos = $(this).attr("id");
        $.ajax({
            type: "POST",
            url: "http://localhost/CatalogoBiblioteca/gestor/destacarLibro",
            data: {datos: datos},
            success: function(data) {
                alert('Libro añadido a la sección de destacados con éxito');
                $(".destacarLibro#" + datos).hide();
                $(".quitarLibro#" + datos).removeAttr('hidden').show();
            },
            error: function(xhr, httpStatusMessage) {
                if (xhr.status === 500) {
                    alert('El libro no se puede destacar porque no ha sido publicado con anterioridad');
                }
            }
        });
    });
});