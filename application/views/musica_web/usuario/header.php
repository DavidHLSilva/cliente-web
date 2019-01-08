<!doctype html>
<html lang="es">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
        <link rel="stylesheet" href="<?= base_url() ?>css/bootstrap.css">

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

        <nav class="navbar navbar-expand-sm navbar-dark color_1 sticky-top">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle btn btn-outline-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Menú
                        </a>
                        <div class="dropdown-menu bg-light" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item disabled"><?= $nombre ?></a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" onclick="playlists()" id="lb_playlist">Playlists</a>
                        </div>
                </div>
                <div class="navbar-nav mr-auto ml-auto text-center">
                    <a class="navbar-brand text-white" onclick="principal()">
                        <h3>Reproductor</h3>
                    </a>
                </div>
                <div class="d-flex flex-row justify-content-center">
                    <a href="<?= base_url() ?>index.php/Musica/Salir" class="btn btn-outline-light" id="idSalir">Salir</a>
                </div>
            </div>
        </nav>

        <!--Inicio del Cuerpo-->
        <div class="container-fluid color_4" id="body">
