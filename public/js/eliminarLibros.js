$(document).ready(function() {
    $("#btnBorrarLibros").click(function() {
        let idsArray = [];
        $("input:checkbox[class=deleteCheckbox]:checked").each(function() {
            idsArray.push($(this).val().split('-'));
        });

        if (idsArray.length > 0) {
            $.ajax({
                method: "POST",
                url: "http://localhost/CatalogoBiblioteca/libros/eliminarLibros",
                data: {idsArray: idsArray},
                success: function(data) {
                    $.each(idsArray, function(indice, datos) {
                        var fila = $("#idLibro" + datos[0]).remove();
                    });
                }
            });
        }
    });

    $(".elimLibro").click(function() {
        let datos = $(this).attr("id").split('-');
        $.ajax({
            method: "POST",
            url: "http://localhost/CatalogoBiblioteca/libros/eliminarLibro",
            data: {datos: datos},
            success: function(data) {
                $("#idLibro" + datos[0]).remove();
            }
        });
    });

});