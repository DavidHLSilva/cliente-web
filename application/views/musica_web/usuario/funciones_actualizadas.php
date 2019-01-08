
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