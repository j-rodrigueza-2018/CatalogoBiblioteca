$(document).ready(function() {
    $(".destacarLibro").click(function() {
        let datos = $(this).attr("id");
        $.ajax({
            method: "POST",
            url: "http://localhost/CatalogoBiblioteca/libros/destacarLibro",
            data: {datos: datos},
            success: function() {
                alert('Libro añadido a la sección de destacados con éxito');
                let nombreBtnDestacar = "destacarLibro" + datos;
                let botonDestacar = document.querySelector('button[name="' + nombreBtnDestacar + '"]');
                botonDestacar.hidden = true;
                let nombreBtnQuitar = "quitarLibro" + datos;
                let botonQuitar = document.querySelector('button[name="' + nombreBtnQuitar + '"]');
                botonQuitar.hidden = false;
            },
            error: function(xhr, httpStatusMessage) {
                if (xhr.status === 500) {
                    alert('El libro no se puede destacar porque no ha sido publicado con anterioridad');
                }
            }
        });
    });
});