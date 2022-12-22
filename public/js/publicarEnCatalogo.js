$(document).ready(function() {
    $("#btnPublicar").click(function() {
        let idsArray = [];
        $("input:checkbox[class=deleteCheckbox]:checked").each(function() {
            idsArray.push($(this).val().split('-'));
        });

        if (idsArray.length > 0) {
            $.ajax({
                method: "POST",
                url: "http://localhost/CatalogoBiblioteca/libros/publicarLibros",
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
        let datos = $(this).attr("id");
        $.ajax({
            method: "POST",
            url: "http://localhost/CatalogoBiblioteca/libros/publicarLibro",
            data: {datos: datos},
            success: function(data) {
                alert('Libro publicado con éxito');
                let nombreBtnPublicar = "publicarLibro" + datos;
                let botonPublicar = document.querySelector('button[name="' + nombreBtnPublicar + '"]');
                botonPublicar.hidden = true;
                let nombreBtnOcultar = "ocultarLibro" + datos;
                let botonOcultar = document.querySelector('button[name="' + nombreBtnOcultar + '"]');
                botonOcultar.hidden = false;
            },
            error: function(xhr, httpStatusMessage) {
                if (xhr.status === 500) {
                    alert('El libro no se puede publicar porque ha sido publicado con anterioridad');
                }
            }
        });
    });

});