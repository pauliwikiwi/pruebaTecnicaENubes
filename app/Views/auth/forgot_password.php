<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
    <script src="https://kit.fontawesome.com/c33b9527eb.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
          rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css"
          rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <title>Hotel Paula Blázquez</title>
</head>
<body>
<div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-4">
        <div class="container-fluid">
            <a class="navbar-brand font-titles" href="#">Hotel Paula</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= base_url('/') ?>">El hotel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/rooms') ?>">Habitaciones</a>
                    </li>
                </ul>
                <a class="nav-link custom-active" aria-current="page" href="#">
                    <i class="fa-regular fa-user"></i>
                    <span class="navbar-text">
                        Iniciar Sesión
                    </span>
                </a>

            </div>
        </div>
    </nav>
    <div class="row m-0">
        <div class="col p-0">
            <div class="main-image">
                <div class="dark-image w-100 h-100 d-flex justify-content-center align-items-center flex-column">
                    <div class="card rounded-card shadow w-25">
                        <div class="card-body">
                            <div class="card-title mt-2 mb-3 text-center text-white">
                                <h2 class="font-titles">Recuperar la contraseña</h2>
                            </div>
                            <div class="card-subtitle text-white">
                                <p>
                                    Introduce el email con el que te diste de alta y te enviaremos un correo con instrucciones para que recuperes tu contraseña.
                                </p>
                            </div>
                            <div class="card-text p-3">
                                <div id="alert-msg"></div>
                                <form id="forgot-password-form">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="mail" name="mail" required>
                                        <label for="mail" class="form-label">Email*</label>
                                    </div>
                                    <button type="submit" class="btn btn-outline-light w-100">Recuperar contraseña</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous">

</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#forgot-password-form').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: 'forgot_password/sendEmail',  // Ruta al backend en CodeIgniter
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#alert-msg').html('<div class="alert alert-success">' + response.message + '</div>');
                        $('#forgot-password-form')[0].reset();  // Limpiar el formulario
                    } else {
                        $('#alert-msg').html('<div class="alert alert-danger">' + response.message + '</div>');
                    }
                },
                error: function() {
                    $('#alert-msg').html('<div class="alert alert-danger">Error al enviar el correo.</div>');
                }
            });
        });
    });
</script>
</body>
</html>
