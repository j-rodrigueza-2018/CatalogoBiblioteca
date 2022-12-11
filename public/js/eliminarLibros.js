$(document).ready(function() {
    $("#btnBorrarLibros").click(function() {
        let idsArray = [];
        $("input:checkbox[class=deleteCheckbox]:checked").each(function() {
            idsArray.push($(this).val());
        });

        if (idsArray.length > 0) {
            $.ajax({
                type: "POST",
                url: "http://localhost/CatalogoBiblioteca/gestor/eliminarLibros",
                data: {idsArray: idsArray},
                success: function(data) {
                    $.each(idsArray, function(indice, id) {
                        var fila = $("#idLibro" + id).remove();
                    });
                }
            });
        }
    });

    $(".elimLibro").click(function() {
        let datos = $(this).attr("id").split('-');
        $.ajax({
            type: "POST",
            url: "http://localhost/CatalogoBiblioteca/gestor/eliminarLibro",
            data: {datos: datos},
            success: function(data) {
                $("#idLibro" + datos[0]).remove();
            }
        });
    });

});