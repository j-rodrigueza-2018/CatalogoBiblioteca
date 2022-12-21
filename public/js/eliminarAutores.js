$(document).ready(function() {
    $("#btnBorrarAutores").click(function() {
        let idsArray = [];
        $("input:checkbox[class=deleteCheckbox]:checked").each(function() {
            idsArray.push($(this).val());
        });

        if (idsArray.length > 0) {
            $.ajax({
                type: "POST",
                url: "http://localhost/CatalogoBiblioteca/autores/eliminarAutores",
                data: {idsArray: idsArray},
                success: function(data) {
                    $.each(idsArray, function(indice, id) {
                        var fila = $("#idAutor" + id).remove();
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
            url: "http://localhost/CatalogoBiblioteca/autores/eliminarAutor",
            data: data,
            success: function(data) {
                $("#idAutor" + id).remove();
            }
        });
    });

});