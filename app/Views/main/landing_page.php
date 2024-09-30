<!doctype html>
<html lang="es+">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--CSS Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Icons Material -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <!-- Icons Font Awesome -->
    <script src="https://kit.fontawesome.com/c33b9527eb.js" crossorigin="anonymous"></script>
    <!-- Tabler icon-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <!-- Fuentes google-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
          rel="stylesheet">
    <!-- jQuery UI CSS -->
    <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
    <!-- CSS Propio-->
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
                        <a class="nav-link active" aria-current="page" href="#">El hotel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/rooms') ?>">Habitaciones</a>
                    </li>
                </ul>
                <?php
                $name = '';
                $session = session();
                if ($session->get('logged_in') == 1) {
                    $name = $session->get('usuario_nombre');
                }
                ?>
                <?php if ($name != ''): ?>
                    <a class="nav-link text-muted" aria-current="page" href="<?= base_url('protected/dashboard') ?>">
                        Mis reservas
                    </a>
                    <a class="nav-link" aria-current="page" href="<?= base_url('/logout') ?>">
                        <i class="fa-solid fa-arrow-right-from-bracket text-muted"></i>
                        <span class="navbar-text">
                                <?= $name ?>
                            </span>
                    </a>
                <?php else: ?>
                    <a class="nav-link" aria-current="page" href="<?= base_url('/login') ?>">
                        <i class="fa-solid fa-arrow-right-to-bracket text-muted"></i>
                        <span class="navbar-text">
                                Iniciar Sesión
                            </span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <div class="row m-0">
        <div class="col p-0">
            <div class="main-image">
                <div class="dark-image w-100 h-100 d-flex justify-content-center align-items-center flex-column">
                    <div>
                        <p class="text-center text-white">
                         <span class="material-symbols-outlined">
                            star
                        </span>
                            <span class="material-symbols-outlined">
                            star
                        </span>
                            <span class="material-symbols-outlined">
                            star
                        </span>
                            <span class="material-symbols-outlined">
                            star
                        </span>
                        </p>
                        <p class="text-center text-white title-hotel">Hotel Paula</p>
                        <p class="text-center text-white subtitle-site">San Juan - Puerto Rico</p>
                    </div>
                    <div class="div-form">
                        <div id="alert-msg"></div>
                        <form id="search_room_form" method="post">
                            <div class="input-group custom-searchar">
                                <div class="form-floating me-2">
                                    <input type="text" class="form-control datepicker" id="fecha_entrada" name="fecha_entrada" required>
                                    <label for="fecha_entrada">Fecha Entrada</label>
                                </div>
                                <div class="form-floating me-2">
                                    <input type="text" class="form-control datepicker" id="fecha_salida" name="fecha_salida" required>
                                    <label for="fecha_salida">Fecha Salida</label>
                                </div>
                                <div class="form-floating me-2">
                                    <select class="form-select" id="personas" aria-label="Floating label select example" name="personas" required>
                                        <option value="1">1</option>
                                        <option value="2" selected>2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                    <label for="floatingSelectGrid">Personas</label>
                                </div>
                                <div class="form-floating">
                                    <button class="btn btn-outline-light h-100" type="submit" id="button-search">Buscar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">


        </div>
    </div>
</div>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- jQuery UI -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    // Configurar el idioma español para el datepicker
    $.datepicker.setDefaults($.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: 'Anterior',
        nextText: 'Siguiente',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    });
    $(document).ready(function () {
        let today = new Date();
        let dateFormat = 'dd/mm/yy';

        // Inicializar el datepicker en el campo de fecha de entrada
        $('#fecha_entrada').datepicker({
            minDate: today,
            dateFormat: dateFormat,
            onSelect: function(dateText) {
                let selectedDate = $(this).datepicker('getDate');
                let minDate = new Date(selectedDate.getTime());
                minDate.setDate(minDate.getDate() + 1);  // Añadir un día a la fecha de entrada
                $('#fecha_salida').datepicker('option', 'minDate', minDate);
            }
        });

        // Inicializar el datepicker en el campo de fecha de salida
        $('#fecha_salida').datepicker({
            minDate: today,
            dateFormat: dateFormat
        });

        $('#search_room_form').on('submit', function(e) {
            e.preventDefault();

            // Capturar los datos del formulario
            let formData = {
                fecha_entrada: $('#fecha_entrada').val(),
                fecha_salida: $('#fecha_salida').val(),
                personas: $('#personas').val()
            };

            // Enviar los datos mediante AJAX
            $.ajax({
                url: '/filter_room', // URL del backend que procesará los datos
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        window.location.href = response.redirect;
                    } else {
                        $('#alert-msg').html('<div class="alert alert-danger">' + response.message + '</div>');
                    }
                },
                error: function() {
                    $('#alert-msg').html('<div class="alert alert-danger">Error en el envío de la reserva. Inténtalo de nuevo.</div>');
                }
            });
        });
    });
</script>
</body>
</html>