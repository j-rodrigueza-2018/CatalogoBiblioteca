$(document).ready(function() {
    $("#btnBorrar").click(function() {
        let idsArray = [];
        $("input:checkbox[class=deleteCheckbox]:checked").each(function() {
            idsArray.push($(this).val());
        });

        if (idsArray.length > 0) {
            $.ajax({
                type: "POST",
                url: "http://localhost/CatalogoBiblioteca/gestor/eliminarAutores",
                data: {idsArray: idsArray},
                success: function(data) {
                    $.each(idsArray, function(indice, id) {
                        var fila = $("#id" + id).remove();
                    });
                }
            });
        }
    });

    $(".elimAutor").click(function() {
        let id = $(this).attr("id");
        let data = "id=" + id;
        $.ajax({
            type: "POST",
            url: "http://localhost/CatalogoBiblioteca/gestor/eliminarAutor",
            data: data,
            success: function(data) {
                $("#id" + id).remove();
            }
        });
    });

});