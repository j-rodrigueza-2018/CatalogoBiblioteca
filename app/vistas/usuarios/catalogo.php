<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca - Catálogo</title>
    <link rel="stylesheet" href="../../../public/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../public/css/styles.css">
</head>
<body class="catalogo">
    <?php include("includes/header.php"); ?>
    <div class="container">
        <p class="h1 mt-3 mb-3">CATÁLOGO</p>
        <div class="row">
            <div class="col-lg-6 col-md-10 col-sm-12 mb-3">
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Título" aria-label="Buscar">
                    <select id="select1" class="form-select me-2" aria-label="Default select example">
                        <option selected disabled>Autor</option>
                        <option value="1">Autor 1</option>
                        <option value="2">Autor 2</option>
                        <option value="3">Autor 3</option>
                    </select>
                    <select id="select2" class="form-select me-2" aria-label="Default select example">
                        <option selected disabled>Categorías</option>
                        <option value="1">Categoría 1</option>
                        <option value="2">Categoría 2</option>
                        <option value="3">Categoría 3</option>
                    </select>
                    <button class="btn btn-danger" type="submit">Buscar</button>
                </form>
            </div>
        </div>
        <div class="row justify-content-center">
            <?php include("includes/librosCatalogo.php"); ?>
        </div>
    </div>
    <?php include("includes/footer.php"); ?>

    <script>
        let catalogo = document.getElementById('catalogo');
        catalogo.className += " active";
    </script>
</body>
</html>