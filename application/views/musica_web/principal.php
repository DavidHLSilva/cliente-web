<!-- Inicio del navbar -->

<nav class="navbar navbar-expand navbar-dark color_1 sticky-top">
        <a class="navbar-brand" href="<?= base_url() ?>index.php/Musica">
            <img src="<?= base_url() ?>img/musica/disco.svg" width="30" height="30" class="d-inline-block align-top" alt="Logo Musica">
            Reproductor
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
</nav>

<!--Inicio del formulario-->
<div class="container-fluid color_4">
        <section class="container py-3 mt-2 mb-2">

            <div class="row ">
                <div class="col-sm-12 col-md-6">
                    <h1 class="h1 text-center ">Reproductor</h1>
                    <img src="<?= base_url() ?>img/musica/icono2.svg" width="70%" height="70%" class="mx-auto d-block" alt="Musica">
                </div>
                <div class="col-sm-12 col-md-6 align-self-center">
                    <section class="container">
                            <form action="<?= base_url() ?>index.php/Musica/login" method="post">
                                <div class="form-group row">
                                    <label for="" class="col-4 col-form-label d-none d-sm-block">Usuario:</label>    
                                    <input type="text" placeholder="Escribe tu nombre de usuario:" class="form-control col-8" name="nombre">
                                    
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-4 col-form-label d-none d-sm-block">Contraseña:</label>
                                    <input type="password" placeholder="Escribe tu contraseña:" class="form-control col-8" name="contrasenia">
                        
                                    </div>
                                <div class="form-group row float-right">
                                    <center>
                                        <button class="btn color_1 text-white">Ingresar</button>
                                    </center> 
                                </div>
                           </form>
                    </section>
                </div>
            </div>
        </section>
    </div>
    <!--Fin del formulario-->
