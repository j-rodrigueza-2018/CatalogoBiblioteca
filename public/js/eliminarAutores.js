$(document).ready(function() {
    $("#btnBorrar").click(function() {
        var idsArray = [];
        $("input:checkbox[class=deleteCheckbox]:checked").each(function() {
            idsArray.push($(this).val());
        });

        if (idsArray.length > 0) {
            $.ajax({
                type: "POST",
                url: "http://localhost/CatalogoBiblioteca2/gestor/eliminarAutor",
                data: {idsArray: idsArray},
                success: function(data) {
                    $.each(idsArray, function(indice, id) {
                        var fila = $("#id" + id).remove();
                    });
                }
            });
        }
    });
})