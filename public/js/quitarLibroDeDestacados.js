$(document).ready(function() {
    $(".quitarLibro").click(function() {
        let datos = $(this).attr("id");
        $.ajax({
            method: "POST",
            url: "http://localhost/CatalogoBiblioteca/libroController/quitarLibro",
            data: {datos: datos},
            success: function() {
                alert('Libro eliminado de la sección de destacados con éxito');
                let nombreBtnQuitar = "quitarLibro" + datos;
                let botonQuitar = document.querySelector('button[name="' + nombreBtnQuitar + '"]');
                botonQuitar.hidden = true;
                let nombreBtnDestacar = "destacarLibro" + datos;
                let botonDestacar = document.querySelector('button[name="' + nombreBtnDestacar + '"]');
                botonDestacar.hidden = false;
            },
            error: function(xhr) {
                if (xhr.status === 500) {
                    alert('El libro no se puede quitar de destacados porque no ha sido publicado con anterioridad');
                }
            }
        });
    });
});