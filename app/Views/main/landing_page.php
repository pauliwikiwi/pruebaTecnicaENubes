<!doctype html>
<html lang="es+">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
          rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
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
                        <a class="nav-link" href="#">Habitaciones</a>
                    </li>
                </ul>
                <span class="material-symbols-outlined">
                    person
                </span>
                <span class="navbar-text">
                   Iniciar Sesión
                </span>
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
                    <div>
                        <form action="<?= base_url('filter_room') ?>" method="post">
                            <div class="input-group ">
                                <div class="form-floating">
                                    <input type="text" class="form-control datepicker" id="fechaEntrada floatingInputEntrada" name="fechaEntrada" required>
                                    <label for="floatingInputEntrada">Fecha Entrada</label>
                                </div>
                                <div class="form-floating">
                                    <input type="text" class="form-control datepicker" id="fechaSalida floatingInputSalida" name="fechaSalida" required>
                                    <label for="floatingInputSalida">Fecha Salida</label>
                                </div>
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelectGrid" aria-label="Floating label select example">
                                        <option value="1">1</option>
                                        <option value="2" selected>2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                    <label for="floatingSelectGrid">Personas</label>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<!-- Datepicker JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
<script>
    $(document).ready(function () {
        // Inicializar datepickers
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true
        });
    });
</script>
</body>
</html>