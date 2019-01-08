        </div>
        <!--Fin del Cuerpo-->

        <!-- Inicio del footer -->
        
        <footer class="container-fluid color_5">
            <div class="row text-white py-4 text-white">
                <div class="col-md-3">
                    <img src="<?= base_url() ?>img/musica/disco.svg" alt="" width="50px" height="auto" class="float-left mr-3">
                    <h4 class="lead">Escucha tu musica favorita!</h4>
                    <footer class="blockquote-footer">Reproductor de musica <cite title="Source Title">*****</cite></footer>
                </div>
                <div class="col-md-3">
                </div>
                <div class="col-md-3">
                    <h4 class="lead">Footer</h4>
                    <p>Informacion que se ingresara en el footer</p>
                </div>
                <div class="col-md-3">
                    <h4 class="lead">Seguir</h4>
                    <a href="http://www.facebook.com"><span class="badge badge-primary">Facebook</span></a>
                    <a href="http://www.youtube.com"><span class="badge badge-danger">Youtube</span></a>
                </div>
            </div>
        </footer>

        <!-- Fin del footer -->


        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="<?= base_url() ?>js/bootstrap.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <div id="funciones">
        <script type="text/javascript">
            function playlists(){
                var usuario = <?= json_encode($usuario) ?>;
                console.log(usuario);
                console.log('<?= base_url() ?>index.php/Usuario/playlists');
                $.ajax({
                    url: '<?= base_url() ?>index.php/Usuario/playlists',
                    type: 'POST',
                    data: usuario,
                    success: function (data){
                        $("#body").html(data);
                        $("#lb_playlist").addClass("active");
                    },
                    error:function(jqXHR, exception) {
                        alert('ocurrio un error en funcion playlist '+exception);
                    }
                });
            };
            function principal(){
                var usuario = <?= json_encode($usuario) ?>;
                console.log(usuario);
                console.log('<?= base_url() ?>index.php/Usuario/principal');
                $.ajax({
                    url: '<?= base_url() ?>index.php/Usuario/principal',
                    type: 'POST',
                    data: usuario,
                    success: function (data){
                        $("#body").html(data);
                        $("#lb_playlist").removeClass("active");
                    },
                    error:function(jqXHR, exception) {
                        alert('ocurrio un error en funcion principal '+exception);
                    }
                });
            };
            function agregar_playlist(){
                var id = $('#id_usuario').val();
                var nombre = $('#nombre').val();
                console.log(id+" "+nombre);
                var usuario = <?= json_encode($usuario) ?>;
                $.ajax({
                    url: '<?= base_url() ?>index.php/Usuario/agregar_playlist',
                    type: 'POST',
                    data: { "usuario":usuario,
                            "id":id,
                            "nombre":nombre },
                    success: function (parametros){
                        alert('se mando la info al controlador');
                        console.log(parametros);
                        if(typeof parametros == "object"){
                            console.log("recibi el objeto");
                            $.ajax({
                                url: 'https://apimusica.000webhostapp.com/testServer/index.php/api/Playlists/playlists',
                                type: 'POST',
                                data: { "id_usuario": parametros.id,
                                        "nombre_playlist": parametros.nombre },
                                success: function (respuesta){
                                    alert('recibi respuesta de la api');
                                    console.log(respuesta);
                                    console.log(usuario);
                                    var info = { "usuario": usuario,
                                             "respuesta": respuesta };
                                    console.log(info);
                                    $.ajax({
                                        url: '<?= base_url() ?>index.php/Usuario/mostrar_playlist',
                                        type: 'POST',
                                        data: info,
                                        success: function (data){
                                            console.log(data);
                                            //jQuery(data);
                                            //$("#header").html(data.header);
                                            $("#funciones").html(data);
                                            //$("#lb_playlist").removeClass("active");
                                        },
                                        error: function (xhr, textStatus, errorMessage) {
                                            console.log("ERROR" + errorMessage + textStatus + xhr);
                                            //console.warn(jqxhr.responseText)
                                        }
                                    });
                                },
                                error: function (xhr, textStatus, errorMessage) {
                                    console.log("ERROR" + errorMessage + textStatus + xhr);
                                    //console.warn(jqxhr.responseText)
                                }
                            });
                        } else {
                            alert("el nombre no puede ser vacio");
                        }
                    },
                    error: function (xhr, textStatus, errorMessage) {
                        console.log("ERROR" + errorMessage + textStatus + xhr);
                        //console.warn(jqxhr.responseText)
                    }
                });

            };
            
            function play(elemento){
                var selected = elemento.id;
                console.log(selected);
                play_cancion(selected);
            };
            function play_cancion(src){
                var audio = document.getElementById('reproductor');
                console.log(src);
                $('#reproductor').attr('src', src);
                var playPromise = audio.play();
            };
            function mostrar_canciones(id_playlist){
                console.log(id_playlist.id);
                var id = id_playlist.id;
                //console.log(typeof id_playlist.id);
                var usuario = <?= json_encode($usuario) ?>;
                console.log(usuario);
                console.log('<?= base_url() ?>index.php/Usuario/canciones_disponibles');
                $.ajax({
                    url: '<?= base_url() ?>index.php/Usuario/canciones_disponibles',
                    type: 'POST',
                    data: { "usuario": usuario,
                            "id_playlist" : id },
                    success: function (data){
                        //console.log();
                        $("#body").html(data);
                        console.log(usuario);
                        $("#agregar_cancion").removeAttr("disabled");
                        //$("#lb_playlist").addClass("active");
                    },
                    error: function (xhr, textStatus, errorMessage) {
                        console.log("ERROR" + errorMessage + textStatus + xhr);
                        //console.warn(jqxhr.responseText)
                    }
                });
            };
            function id_canciones(id_playlist){
                var id_cancion = new Array();
                $('input[name="check"]:checked').each(function() {
                    id_cancion.push(this.value);
                });
                alert("Canciones seleccionadas: "+id_cancion.length+"\n"+"y los id's son:"+id_cancion+"\n"+"id del playlist"+id_playlist.value);
                var usuario = <?= json_encode($usuario) ?>;
                console.log(usuario);
                $.ajax({
                    url: '<?= base_url() ?>index.php/Usuario/validar_canciones',
                    type: 'POST',
                    data: { "usuario": usuario,
                            "id_cancion": id_cancion,
                            "id_playlist" : id_playlist.value },
                    success: function (parametros){
                        //console.log();
                        //$("#body").html(data);
                        //$("#lb_playlist").addClass("active");
                        alert('se mando la info al controlador');
                        console.log(parametros);
                        if(typeof parametros == "object"){
                            console.log("recibi un objeto");
                            console.log(typeof parametros.id_playlist);
                            console.log(typeof parametros.id_cancion);
                            var canciones = Object.values(parametros.id_cancion);
                            console.log(canciones);
                            console.log(typeof canciones);
                            $.ajax({
                                url: 'https://apimusica.000webhostapp.com/testServer/index.php/api/Playlists/playlists',
                                type: 'POST',
                                data: { "id_playlist": parametros.id_playlist,
                                        "id_cancion": canciones },
                                success: function (respuesta){
                                    console.log(respuesta);
                                    alert('recibi respuesta de la api');
                                    console.log(respuesta);
                                    console.log(usuario);
                                    var info = { "usuario": usuario,
                                             "respuesta": respuesta };
                                    console.log(info);
                                    $.ajax({
                                        url: '<?= base_url() ?>index.php/Usuario/actualizar_canciones',
                                        type: 'POST',
                                        data: info,
                                        success: function (data){
                                            console.log(data);
                                            //jQuery(data);
                                            //$("#header").html(data.header);
                                            $("#funciones").html(data);
                                            $("#agregar_cancion").attr("disabled", true);
                                            //$("#lb_playlist").removeClass("active");
                                        },
                                        error: function (xhr, textStatus, errorMessage) {
                                            console.log("ERROR" + errorMessage + textStatus + xhr);
                                            //console.warn(jqxhr.responseText)
                                        }
                                    });
                                },
                                error: function (xhr, textStatus, errorMessage) {
                                    console.log("ERROR" + errorMessage + textStatus + xhr);
                                    //console.warn(jqxhr.responseText)
                                }
                            });
                            
                        } else {
                            alert("no recibi un objeto los parametros no son validos");
                        }
                    },
                    error: function (xhr, textStatus, errorMessage) {
                        console.log("ERROR" + errorMessage + textStatus + xhr);
                        //console.warn(jqxhr.responseText)
                    }
                });
            };
        </script> 
        </div>
    </body>
</html>