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
            <a class="navbar-brand font-titles" href="<?= base_url('/') ?>">Hotel Paula</a>
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
                <a class="nav-link custom-active ps-0" aria-current="page" href="#">
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
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card rounded-card shadow">
                                    <div class="card-body">
                                        <div class="card-title mt-2 mb-3 text-center text-white">
                                            <h2 class="font-titles">Restablecer contraseña</h2>
                                        </div>
                                        <div class="card-text p-3">
                                            <div id="alert-msg"></div>
                                            <form id="reset-pasword-form">
                                                <input type="hidden" name="token" id="token" value="<?= $token ?>">
                                                <div class="form-floating mb-3">
                                                    <input type="password" class="form-control" id="password" name="password"
                                                           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}"
                                                           title="La contraseña debe tener al menos 8 caracteres, incluyendo una letra mayúscula, una letra minúscula, un número y un carácter especial (@$!%*?&)"
                                                           required>
                                                    <label for="password" class="form-label" >Contraseña*</label>

                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="password" class="form-control" id="password_repeat" name="password_repeat"
                                                           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}"
                                                           title="La contraseña debe tener al menos 8 caracteres, incluyendo una letra mayúscula, una letra minúscula, un número y un carácter especial (@$!%*?&)"
                                                           required>
                                                    <label for="password" class="form-label" >Repite la contraseña*</label>
                                                </div>

                                                <button type="submit" class="btn btn-outline-light w-100">Restablecer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
        $('#reset-pasword-form').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: 'updatePassword',  // Ruta del backend en CodeIgniter
                type: 'POST',
                data: $(this).serialize(), // Serializar los datos del formulario
                dataType: 'json',
                success: function(response) {
                    // Manejar la respuesta del servidor
                    if (response.success) {
                        $('#message').html('<div class="alert alert-success">' + response.message + '</div>');
                        $('#resetPasswordForm')[0].reset(); // Reiniciar el formulario
                    } else {
                        $('#message').html('<div class="alert alert-danger">' + response.message + '</div>');
                    }
                },
                error: function(xhr, status, error) {
                    $('#message').html('<div class="alert alert-danger">Hubo un error al procesar la solicitud. Inténtalo de nuevo.</div>');
                }
            });
        });
    });
</script>
</body>
</html>
