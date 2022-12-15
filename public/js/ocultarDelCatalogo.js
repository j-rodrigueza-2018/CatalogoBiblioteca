$(document).ready(function() {
    $("#btnOcultar").click(function() {
        let idsArray = [];
        $("input:checkbox[class=deleteCheckbox]:checked").each(function() {
            idsArray.push($(this).val().split('-'));
        });

        if (idsArray.length > 0) {
            $.ajax({
                type: "POST",
                url: "http://localhost/CatalogoBiblioteca/gestor/ocultarLibros",
                data: {idsArray: idsArray},
                success: function(data) {
                    alert('Libros ocultados con éxito');
                },
                error: function(xhr, httpStatusMessage) {
                    if (xhr.status === 500) {
                        alert('El libro no se puede ocultar porque ha sido publicado con anterioridad');
                    }
                }
            });
        }
    });

    $(".ocultarLibro").click(function() {
        let datos = $(this).attr("id");
        $.ajax({
            type: "POST",
            url: "http://localhost/CatalogoBiblioteca/gestor/ocultarLibro",
            data: {datos: datos},
            success: function(data) {
                alert('Libro ocultado con éxito');
                $(".ocultarLibro#" + datos).hide();
                $(".publicarLibro#" + datos).show();
            },
            error: function(xhr, httpStatusMessage) {
                if (xhr.status === 500) {
                    alert('El libro no se puede publicar porque ha sido publicado con anterioridad');
                }
            }
        });
    });

});