<!doctype html>
<html lang="es">
    <head>
        <!-- Requiere meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
        <link rel="stylesheet" href="<?= base_url() ?>css/bootstrap.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">



        <!-- Estilos en Css -->
        <style>
            .color_1{background:#033649 ;}
            .color_2{background:#E8DDCB ;}
            .color_3{background:#036564 ;}
            .color_4{background:#CDB380 ;}
            .color_5{background:#031634 ;}
        </style>

        <title>Reproductor</title>
    </head>
    <body>
    <!-- Inicio del navbar -->

        <nav class="navbar navbar-expand-sm navbar-dark color_1 sticky-top" id="nav">
            <a class="navbar-brand text-white">
                <img src="<?= base_url() ?>img/musica/disco.svg" width="30" height="30" class="d-inline-block align-top" alt="Logo Musica">
                Reproductor
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <div class="navbar-nav text-center">
                    <a class="nav-item nav-link active btn" onclick="inicio()" id="ini">Inicio</a>
                    <a class="nav-item nav-link btn" onclick="canciones()" id="can">Canciones</a>
                    <a class="nav-item nav-link btn" onclick="usuarios()" id="usu">Usuarios</a>
                </div>
                
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <div class="navbar-nav mr-auto ml-auto text-center">
                </div>
                <div class="d-flex flex-row justify-content-center">
                    <a href="<?= base_url() ?>index.php/Musica/Salir" class="btn btn-outline-light">Salir</a>
                </div>
            </div>
        </nav>

        <!--Inicio del Body-->
        <div class="container-fluid color_4" id="body">