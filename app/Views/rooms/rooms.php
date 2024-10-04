<!doctype html>
<html lang="es">
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
<div>
    <?php foreach ($rooms as $room): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4 custom-card">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="<?= base_url('images/rooms/' . $room['id'] . '/room.jpg') ?>"
                                 class="img-fluid rounded-start custom-height" alt="Imagen habitación">
                        </div>
                        <div class="col-md-8 d-flex justify-content-between flex-column">
                            <div class="card-body">
                                <h4 class="card-title font-titles"><?= $room['name']; ?></h4>
                                <p class="card-text"><?= $room['description']; ?></p>
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
                            </div>
                            <div class="card-body">
                                <div class="row justify-content-end align-items-center">
                                    <div class="col-md-6 text-end">
                                                    <span>
                                                        Precio por noche:
                                                        <s class="me-3">
                                                            <?= number_format($room['price'] * 1.10); ?>€
                                                        </s>
                                                        <?= $room['price']; ?> €
                                                    </span>
                                    </div>
                                    <div class="col-md-3">
                                        <a class="btn w-100 btn-green" href="<?= base_url('/booking_room/' . $room['id'] . '?checkin_date=' . $fecha_entrada . '&checkout_date=' . $fecha_salida . '&guests=' . $personas) ?>">
                                            Reservar
                                        </a>

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

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- jQuery UI -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    function booking_room(room_id){

    }
</script>
</body>
</html>
