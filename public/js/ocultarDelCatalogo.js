$(document).ready(function() {
    $("#btnOcultar").click(function() {
        let idsArray = [];
        $("input:checkbox[class=deleteCheckbox]:checked").each(function() {
            idsArray.push($(this).val());
        });

        if (idsArray.length > 0) {
            $.ajax({
                method: "POST",
                url: "http://localhost/CatalogoBiblioteca/libros/ocultarLibros",
                data: {idsArray: idsArray},
                success: function() {
                    alert('Libros ocultados con éxito');
                },
                error: function(xhr) {
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
            method: "POST",
            url: "http://localhost/CatalogoBiblioteca/libros/ocultarLibro",
            data: {datos: datos},
            success: function() {
                alert('Libro ocultado con éxito');
                let nombreBtnOcultar = "ocultarLibro" + datos;
                let botonOcultar = document.querySelector('button[name="' + nombreBtnOcultar + '"]');
                botonOcultar.hidden = true;
                let nombreBtnPublicar = "publicarLibro" + datos;
                let botonPublicar = document.querySelector('button[name="' + nombreBtnPublicar + '"]');
                botonPublicar.hidden = false;
            },
            error: function(xhr) {
                if (xhr.status === 500) {
                    alert('El libro no se puede publicar porque ha sido publicado con anterioridad');
                }
            }
        });
    });

});