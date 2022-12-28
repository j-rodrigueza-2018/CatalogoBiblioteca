$(document).ready(function() {
    $("#btnBorrarLibros").click(function() {
        let idsArray = [];
        $("input:checkbox[class=deleteCheckbox]:checked").each(function() {
            idsArray.push($(this).val());
        });

        if (idsArray.length > 0) {
            $.ajax({
                method: "POST",
                url: "http://localhost/CatalogoBiblioteca/libroController/eliminarLibros",
                data: {idsArray: idsArray},
                success: function() {
                    $.each(idsArray, function(indice, id) {
                        alert('Libro/s eliminado/s correctamente');
                        $("#idLibro" + id).remove();
                    });
                }
            });
        }
    });

    $(".elimLibro").click(function() {
        let datos = $(this).attr("id");
        $.ajax({
            method: "POST",
            url: "http://localhost/CatalogoBiblioteca/libroController/eliminarLibro",
            data: {datos: datos},
            success: function() {
                alert('Libro eliminado correctamente');
                $("#idLibro" + datos).remove();
            }
        });
    });

});