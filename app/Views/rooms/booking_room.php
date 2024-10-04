<!doctype html>
<html lang="es">
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
                        <a class="nav-link active" href="#">Habitaciones</a>
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
                    <a class="nav-link ps-0 text-muted" aria-current="page" href="<?= base_url('user/dashboard') ?>">
                        Mis reservas
                    </a>
                    <a class="nav-link ps-0" aria-current="page" href="<?= base_url('/logout') ?>">
                        <i class="fa-solid fa-arrow-right-from-bracket text-muted"></i>
                        <span class="navbar-text">
                                <?= $name ?>
                            </span>
                    </a>
                <?php else: ?>
                    <a class="nav-link ps-0" aria-current="page" href="<?= base_url('/login') ?>">
                        <i class="fa-solid fa-arrow-right-to-bracket text-muted"></i>
                        <span class="navbar-text">
                                Iniciar Sesión
                            </span>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <div class="row ">
            <div class="col-md-3 mb-3">
                <form id="filter_availability" method="get">
                    <input type="hidden" id="fecha_seleccionada_entrada" name="fecha_seleccionada_entrada" value="<?= $fecha_entrada?>">
                    <input type="hidden" id="fecha_seleccionada_salida" name="fecha_seleccionada_salida" value="<?= $fecha_salida?>">
                    <input type="hidden" id="id_room" name="id_room" value="<?= $room['id']?>">
                    <div class="custom-searchar justify-content-center">
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control datepicker" id="fecha_reserva_entrada" name="fecha_reserva_entrada" required>
                            <label for="fecha_reserva_entrada">Fecha Entrada</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control datepicker" id="fecha_reserva_salida" name="fecha_reserva_salida" required>
                            <label for="fecha_reserva_salida">Fecha Salida</label>
                        </div>
                        <div class="form-floating">
                            <button class="btn w-100 btn-outline-light h-100" type="submit" id="button-search">Buscar Disponibilidad</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-9">
                <div id="alert-msg"></div>
                <div id="loader" style="display: none;">
                    <div class="row">
                        <div class="col-12">
                            <div class="loader-content">
                                <p>Cargando...</p>
                                <div class="spinner"></div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card p-3">
                    <div class="row">
                        <div class="col-md-4 d-flex justify-content-center">
                            <img src="<?= base_url('images/rooms/' . $room['id'] . '/room.jpg') ?>" alt="" width="150px" height="150px" style="object-fit: cover; border-radius: 20px">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="card-text">
                                    <h5 class="font-titles">
                                        <span><?= $room['name']; ?></span>
                                    </h5>
                                </div>
                                <div class="card-text">
                                    <span> <?= $room['description']; ?></span>
                                </div>
                                <div class="card-text">
                                    <span> <?= $room['price'] ?></span>
                                </div>
                                <div class="card-text mb-4">
                                    <small class="text-muted"><?= $room['meters']; ?> m <sup>2</sup></small>
                                    <span class="divider"></span>
                                    <small class="text-muted">Ocupación máx.: <?= $room['people']; ?></small>
                                    <span class="divider"></span>
                                    <small class="text-muted"><?= $room['category']; ?></small>
                                </div>
                                <div class="card-text">
                                    <div class="row mb-2">
                                        <?php if ($room['wifi']): ?>
                                            <div class="col-md-3">
                                                <i class="fa-solid fa-wifi"></i>
                                                <small>Conexión Wi-fi </small>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($room['television']): ?>
                                            <div class="col-md-3">
                                                <i class="fa-solid fa-tv"></i>
                                                <small>Televisión</small>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($room['air_conditioning']): ?>
                                            <div class="col-md-3">
                                                <i class="ti ti-snowflake"></i>
                                                <small>Aire Acondicionado</small>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($room['minibar']): ?>
                                            <div class="col-md-3">
                                                <i class="ti ti-fridge"></i>
                                                <small>Minibar</small>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($room['hair_dryer']): ?>
                                            <div class="col-md-3">
                                                <img src="<?= base_url('images/icons/hair_dryer.svg') ?>"
                                                     alt="icon hair" class="icons">
                                                <small>Secador de pelo</small>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            Todas las habitaciones contienen:
                                        </div>
                                        <div class="col-md-3">
                                            <i class="ti ti-device-landline-phone"></i>
                                            <small>Teléfono</small>
                                        </div>
                                        <div class="col-md-3">
                                            <img src="<?= base_url('images/icons/security_box.svg') ?>"
                                                 alt="icon security box" class="icons">
                                            <small>Caja de seguridad</small>
                                        </div>
                                        <div class="col-md-3">
                                            <img src="<?= base_url('images/icons/amenities.svg') ?>"
                                                 alt="icon amenities" class="icons">
                                            <small>Amenities</small>
                                        </div>
                                        <div class="col-md-3">
                                            <i class="ti ti-ironing-1"></i>
                                            <small>Plancha (bajo petición)</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-text">
                                    Si deseas guardar tu reserva, y poder acceder a ella en cualquier momento
                                    <a href="<?= base_url('/login')?>">Inicia Sesión </a>
                                    sino entraras modo invitado y no podrás acceder a ella.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <h5>
                                Precio
                            </h5>
                            <p>1 habitación * <?= $diasDiferencia; ?> noches</p>
                            <p>
                                Total : <span> <?= $diasDiferencia * $room['price']; ?> €</span>
                            </p>
                        </div>
                    </div>
                </div>
                <form id="reservation-room-form" action="#" method="post">
                    <div class="card mt-3 p-3">
                        <div class="card-title">
                            Datos del usuario:
                        </div>
                        <div class="card-body">
                            <div class="row  mb-2">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" name="name" required>
                                        <label for="name">Nombre*</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                                        <label for="last_name">Apellidos*</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" name="email" value="<?= $session->get('usuario_email');?>" required>
                                        <label for="email">Email*</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="tel" class="form-control" id="phone" name="phone" required>
                                        <label for="phone">Teléfono*</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="identification" name="identification" required>
                                        <label for="identification">DNI/NIF/NIE*</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="nationality" name="nationality" required>
                                        <label for="nationality">Nacionalidad*</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card p-3 mt-3">
                        <div class="card-title">
                            Datos del pago:
                        </div>
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="titular" name="titular" required>
                                        <label for="titular">Titular*</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="num_tarjeta" name="num_tarjeta" required>
                                        <label for="num_tarjeta">Número de la tarjeta*</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="month" class="form-control" id="caducidad" name="caducidad" required>
                                        <label for="caducidad">Fecha de caducidad*</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="cvv" name="cvv" required>
                                        <label for="cvv">CVV*</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 justify-content-end">
                        <div class="col-md-3">
                            <button class="btn btn-green w-100" id="button-booking" <?php if ($isBooking): ?> disabled <?php endif; ?>>
                                Reservar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
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

        function convertToDate(dateText) {
            const parts = dateText.split('/');
            return new Date(parts[2], parts[1] - 1, parts[0]);
        }


        let setDateEntry = convertToDate($('#fecha_seleccionada_entrada').val())
        $('#fecha_reserva_entrada').datepicker({
            minDate: today,
            dateFormat: dateFormat,
            onSelect: function(dateText) {
                let selectedDate = $(this).datepicker('getDate');
                let minDate = new Date(selectedDate.getTime());
                minDate.setDate(minDate.getDate() + 1);  // Añadir un día a la fecha de entrada
                $('#fecha_salida').datepicker('option', 'minDate', minDate);
            }
        });
        $('#fecha_reserva_entrada').datepicker("setDate", setDateEntry);



        let setDateDeparture = convertToDate($('#fecha_seleccionada_salida').val())
        $('#fecha_reserva_salida').datepicker({
            minDate: today,
            dateFormat: dateFormat
        });
        $('#fecha_reserva_salida').datepicker("setDate", setDateDeparture);


        $('#reservation-room-form').on('submit', function(e) {
            e.preventDefault();

            let reservation_entry_date = convertToDate($('#fecha_reserva_entrada').val()).getTime()
            let reservation_departure_date = convertToDate($('#fecha_reserva_salida').val()).getTime()
            let id_room = $('#id_room').val();
            let formData = $(this).serializeArray();

            formData.push({ name: 'checkin', value: reservation_entry_date });
            formData.push({ name: 'checkout', value: reservation_departure_date });
            formData.push({ name: 'id_room', value: id_room });
            // Enviar los datos mediante AJAX
            $.ajax({
                url: '/reservation_room',
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
                    $('#alert-msg').html('<div class="alert alert-danger">Ha habido un error. Inténtalo de nuevo.</div>');
                }

            });

        });

        $('#filter_availability').on('submit', function (e){
            e.preventDefault();

            let id_room = $('#id_room').val();
            $.ajax({
                url: '/check_availability/' + id_room,
                type: 'GET',
                data: {
                    checkin:  convertToDate($('#fecha_reserva_entrada').val()).getTime(),
                    checkout:  convertToDate($('#fecha_reserva_salida').val()).getTime(),
                },
                dataType: 'json',
                beforeSend: function() {
                    $('#loader').show();
                },
                success: function(response) {
                    if (response.success) {
                        if (response.isBooking){
                            $("#button-booking").prop("disabled",true);
                            $('#alert-msg').html('<div class="alert alert-danger">La habitación no esta disponible en esas fechas. Inténtalo de nuevo.</div>');
                        }else{
                            $("#button-booking").prop("disabled",false);
                            $('#alert-msg').css('display','none')
                        }
                    }
                },
                error: function() {
                    $('#loader').hide();
                    $('#alert-msg').html('<div class="alert alert-danger">Ha habido un error. Inténtalo de nuevo.</div>');
                },
                complete:function (){
                    $('#loader').hide();
                }

            });

        });
    });
</script>
</body>
</html>
