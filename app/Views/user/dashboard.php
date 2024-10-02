<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--CSS Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Icons Material -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
    <!-- Icons Font Awesome -->
    <script src="https://kit.fontawesome.com/c33b9527eb.js" crossorigin="anonymous"></script>
    <!-- Tabler icon-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css"/>
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
                        <a class="nav-link" aria-current="page" href="<?= base_url('/') ?>">El hotel</a>
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
                    <a class="nav-link text-muted custom-active" aria-current="page" href="#">
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
    <div class="container mt-5">
        <?php foreach ($reservations as $reservation): ?>
            <?php
            // Definir las fechas
            $fechaEntrada = $reservation['entry_date'];
            $fechaSalida = $reservation['departure_date'];

            $entrada = new DateTime($fechaEntrada);
            $salida = new DateTime($fechaSalida);

            // Calcular la diferencia
            $diferencia = $entrada->diff($salida);
            $diasDiferencia = $diferencia->days; // Total de días

            ?>
            <div class="row">
                <div class="col-12">
                    <div class="card card-reservation">
                        <div class="row">
                            <div class="col-2 d-flex justify-content-center align-items-center">
                                <img src="<?= base_url('images/rooms/' . $reservation['id_room'] . '/room.jpg') ?>"
                                     alt="" width="150px" height="150px" style="object-fit: cover; border-radius: 20px">
                            </div>
                            <div class="col-10">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h5 class="d-flex justify-content-between">
                                            <span><?= $reservation['name']; ?></span><span
                                                    class="badge rounded-pill bg-secondary"> <?= $reservation['status']; ?></span>
                                        </h5>
                                        <p> <?= date("d/m/Y", strtotime($reservation['entry_date'])); ?>
                                            - <?= date("d/m/Y", strtotime($reservation['departure_date'])); ?></p>
                                    </div>
                                    <div class="card-text">
                                        <p>
                                            Reserva para <?= $diasDiferencia; ?> noches
                                        </p>
                                        <div class="d-flex justify-content-between">
                                            <span>Total: <?= $diasDiferencia * $reservation['price']; ?> €</span>
                                            <span>
                                                <a class="btn btn-green me-2"
                                                   href="<?= base_url('user/pdf/generate_reservation/' . $reservation['id_reservation']) ?>">
                                                    <span class="material-symbols-outlined">
                                                    download
                                                    </span>
                                                </a>
                                                <a class="btn btn-green me-2"
                                                   href="<?= base_url('user/reservation/' . $reservation['id_reservation']) ?>">
                                                    Ver
                                                </a>
                                                 <?php if ($reservation['status'] != 'Cancelada'):?>
                                                <a class="btn btn-green me-2"
                                                   href="<?= base_url('user/reservation/edit/' . $reservation['id_reservation']) ?>">
                                                    Modificar reserva
                                                </a>
                                                <button class="btn btn-danger me-2" id="cancel-reservation"
                                                        onclick="cancelReservation(<?= $reservation['id_reservation']; ?>)">
                                                    Cancelar
                                                </button>
                                                <?php endif; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function cancelReservation(id) {
        let id_reservation = id;
        $.ajax({
            url: '/user/reservation/cancel/' + id, // Agrega el parámetro a la URL
            type: 'GET',
            dataType: 'json', // Esperamos un JSON de respuesta
            success: function (data) {
                // Procesar datos recibidos
                location.reload()
            },
            error: function (xhr, status, error) {
                // Manejo de errores
                $('#result').html('Error: ' + error);
            }
        });
    }

</script>
</body>
</html>