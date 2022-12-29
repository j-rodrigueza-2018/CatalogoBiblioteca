<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca - Contacto</title>
    <link rel="stylesheet" href=".<?php echo URL_PROYECTO; ?>/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo URL_PROYECTO; ?>/public/css/styles.css">
</head>
<body class="contacto">
    <?php include("includes/header.php"); ?>
    <div class="container">
        <p class="h1 mt-3 mb-3">CONTACTO</p>
        <div class="row">
            <form class="col-lg-6 col-md-12 col-sm-12 border-end border-bottom">
                <div class="col-12 mb-3">
                    <label for="nombre" class="form-label subrayado">Nombre:</label>
                    <input type="text" class="form-control" id="nombre">
                </div>
                <div class="col-12 mb-3">
                    <label for="email" class="form-label subrayado">E-Mail:</label>
                    <input type="email" class="form-control" id="email">
                </div>
                <div class="col-12 mb-3">
                    <label for="mensaje" class="form-label subrayado">Mensaje:</label>
                    <textarea id="mensaje" class="form-control" rows="8"></textarea>
                </div>
                <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-danger">Enviar</button>
                </div>
            </form>
            <div class="col-lg-6 col-md-12 col-sm-12 mb-0">
                <p class="col-12"><span class="subrayado">Dirección:</span> Av. de Castilla la Mancha, 43, 45940 Valmojado, Toledo</p>
                <p class="col-12 border-bottom pb-3"><span class="subrayado">Teléfono:</span> +34 640 220 830</p>
                <p class="col-12 subrayado">Ubicación:</p>
                <iframe class="col-12" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12188.448343483235!2d-4.0875883!3d40.2065696!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xe32e54462437fc83!2sCentro%20Cultural%20%22Las%20Escuelas%22%20y%20biblioteca%20D.%20Ram%C3%B3n%20de%20la%20Cruz!5e0!3m2!1ses!2ses!4v1669567509822!5m2!1ses!2ses" width="600" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
    <?php include("includes/footer.php"); ?>

    <script>
        let contacto = document.getElementById('contacto');
        contacto.className += " active";
    </script>
</body>
</html>