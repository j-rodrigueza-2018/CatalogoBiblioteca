$(document).ready(function() {
    $("#btnPublicar").click(function() {
        let idsArray = [];
        $("input:checkbox[class=deleteCheckbox]:checked").each(function() {
            idsArray.push($(this).val().split('-'));
        });

        if (idsArray.length > 0) {
            $.ajax({
                type: "POST",
                url: "http://localhost/CatalogoBiblioteca/gestor/publicarLibros",
                data: {idsArray: idsArray},
                success: function(data) {
                    alert('Libros publicados con éxito');
                }
            });
        }
    });
});