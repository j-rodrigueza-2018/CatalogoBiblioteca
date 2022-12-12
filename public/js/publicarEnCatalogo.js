$(document).ready(function() {
    $("#btnPublicar").click(function() {
        let idsArray = [];
        $("input:checkbox[class=deleteCheckbox]:checked").each(function() {
            idsArray.push($(this).val().split('-'));
        });

        if (idsArray.length > 0) {
            $.ajax({
                type: "POST",
                url: "http://localhost/CatalogoBiblioteca/gestor/publicarLibros",
                data: {idsArray: idsArray},
                success: function(data) {
                    alert('Libros publicados con éxito');
                },
                error: function(xhr, httpStatusMessage) {
                    if (xhr.status === 500) {
                        alert('El libro no se puede publicar porque ha sido publicado con anterioridad');
                    }
                }
            });
        }
    });

    $(".publicarLibro").click(function() {
        let datos = $(this).attr("id").split('-');
        $.ajax({
            type: "POST",
            url: "http://localhost/CatalogoBiblioteca/gestor/publicarLibro",
            data: {datos: datos},
            success: function(data) {
                alert('Libro publicado con éxito');
            },
            error: function(xhr, httpStatusMessage) {
                if (xhr.status === 500) {
                    alert('El libro no se puede publicar porque ha sido publicado con anterioridad');
                }
            }
        });
    });

});