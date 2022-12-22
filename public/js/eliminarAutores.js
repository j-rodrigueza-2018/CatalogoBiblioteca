$(document).ready(function() {
    $("#btnBorrarAutores").click(function() {
        let idsArray = [];
        $("input:checkbox[class=deleteCheckbox]:checked").each(function() {
            idsArray.push($(this).val());
        });

        if (idsArray.length > 0) {
            $.ajax({
                method: "POST",
                url: "http://localhost/CatalogoBiblioteca/autores/eliminarAutores",
                data: {idsArray: idsArray},
                success: function() {
                    $.each(idsArray, function(indice, id) {
                        $("#idAutor" + id).remove();
                    });
                    alert('Autor/es eliminado/s correctamente');
                }
            });
        }
    });

    // Manejador de click del botón de eliminar un autor
    $(".elimAutor").click(function(e) {
        // Evitamos el comportamiento predeterminado del botón
        e.preventDefault();
        // Obtenemos el id del autor a eliminar
        let id = $(this).attr("id");
        // Enviamos la solicitud Ajax al controlador
        $.ajax({
            url: "http://localhost/CatalogoBiblioteca/autores/eliminarAutor",
            method: "POST",
            data: {id: id},
            success: function() {
                alert('Autor eliminado correctamente');
                $("#idAutor" + id).remove();
            },
            error: function() {
                alert('Se produjo un error al enviar la solicitud');
            }
        });
    });

});