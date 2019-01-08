        </div>
        <!--Fin del body-->
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
        <script type="text/javascript">
        	function canciones() {
        		$.ajax({
    				url: '<?= base_url() ?>index.php/Administrador/canciones',
    				type: 'post',
    				data: {},
    				success: function (data) {
                        $("#body").html(data);
                        $("#ini").removeClass("active");
                        $("#usu").removeClass("active");
                        $("#can").addClass("active");				
                    },
                    error:function(jqXHR, exception) {
                        alert('ocurrio un error en funcion inicio '+exception);
                    }
    			});
        	};
            function usuarios() {
        		$.ajax({
    				url: '<?= base_url() ?>index.php/Administrador/usuarios',
    				type: 'post',
    				data: {},
    				success: function (data) {
    					$("#body").html(data);
                        $("#can").removeClass("active");
                        $("#ini").removeClass("active");
                        $("#usu").addClass("active");				
                    },
                    error:function(jqXHR, exception) {
                        alert('ocurrio un error en funcion inicio '+exception);
                    }
    			});
        	};
            function inicio(){
                var usuario = <?= json_encode($usuario) ?>;
                console.log(usuario);
                $.ajax({
                    url: '<?= base_url() ?>index.php/Administrador/inicio',
                    type: 'POST',
                    data: {"usuario":usuario },
                    success: function (data){
                        $("#body").html(data);
                        $("#can").removeClass("active");
                        $("#usu").removeClass("active");
                        $("#ini").addClass("active");
                    },
                    error:function(jqXHR, exception) {
                        alert('ocurrio un error en funcion inicio '+exception);
                    }
                });
            };

            function agregar_usuario(){
                nombre=$("#nombre").val();
                contrasenia=$("#contrasenia").val();
                id_tipo=$("#id_tipo").val();
                alert(nombre+" "+contrasenia+" "+id_tipo);
                $.ajax({
                    url: '<?= base_url() ?>index.php/Administrador/agregar',
                    type: 'POST',
                    data: { "nombre":nombre,
                            "contrasenia":contrasenia,
                            "id_tipo":id_tipo},
                    success: function (parametros){
                        //$("#body").html(data);
                        //$("#can").removeClass("active");
                        //$("#usu").removeClass("active");
                        //$("#ini").addClass("active");
                        alert('se mando la info al controlador');
                        if(typeof parametros == "object"){
                            console.log(parametros);
                            console.log(typeof parametros);
                            alert('recibi un objeto');
                            $.ajax({
                                url: 'https://apimusica.000webhostapp.com/testServer/index.php/api/Usuarios/usuarios',
                                type: 'POST',
                                data: parametros,
                                success: function (respuesta){
                                    $.ajax({
                                        url: '<?= base_url() ?>index.php/Administrador/usuario_agregado',
                                        type: 'POST',
                                        data: respuesta,
                                        success: function (data){
                                            $("#body").html(data);
                                            $("#can").removeClass("active");
                                            $("#usu").removeClass("active");
                                            $("#ini").addClass("active");
                                        },
                                        error:function(jqXHR, exception) {
                                            alert('ocurrio un error al mostrar la vista principal '+exception);
                                        }
                                    });
                                },
                                error:function(jqXHR, exception) {
                                    alert('ocurrio un error al conectar con la api '+exception);
                                }
                            });
                            
                        }else{
                            alert('el nombre y contrasenia no puede ser vacio');
                        }
                        
                    },
                    error:function(jqXHR, exception) {
                        alert('ocurrio un error en la funcion agregar_usuario '+exception);
                    }
                });
            };
            function mostrar_info(info){
                usuario = info.split('||');
                //console.log(usuario[0]);
                $('#id_usuario').val(usuario[0]);
                $('#nombre_editar').val(usuario[1]);
                $('#id_tipo_editar').val(usuario[2]);
            };
            function actualizar_usuario(){
                id = $('#id_usuario').val();
                nombre = $('#nombre_editar').val();
                id_tipo = $('#id_tipo_editar').val();
                alert(id+" "+nombre+" "+id_tipo);
                $.ajax({
                    url: '<?= base_url() ?>index.php/Administrador/actualizar',
                    type: 'POST',
                    data: { "nombre":nombre,
                            "contrasenia":"",
                            "id_tipo":id_tipo,
                            "id":id },
                    success: function (parametros){
                        //$("#body").html(data);
                        //$("#can").removeClass("active");
                        //$("#usu").removeClass("active");
                        //$("#ini").addClass("active");
                        alert('se mando la info al controlador');
                        if(typeof parametros == "object"){
                            console.log(parametros);
                            console.log(typeof parametros);
                            alert('recibi un objeto');
                            $.ajax({
                                url: 'https://apimusica.000webhostapp.com/testServer/index.php/api/Usuarios/usuarios',
                                type: 'PUT',
                                data: parametros,
                                success: function (respuesta){
                                    $.ajax({
                                        url: '<?= base_url() ?>index.php/Administrador/usuario_actualizado',
                                        type: 'POST',
                                        data: respuesta,
                                        success: function (data){
                                            $("#body").html(data);
                                            $("#can").removeClass("active");
                                            $("#usu").removeClass("active");
                                            $("#ini").addClass("active");
                                        },
                                        error:function(jqXHR, exception) {
                                            alert('ocurrio un error al mostrar la vista principal '+exception);
                                        }
                                    });
                                },
                                error:function(jqXHR, exception) {
                                    alert('ocurrio un error al conectar con la api '+exception);
                                }
                            });
                            
                        }else{
                            alert('el nombre no puede ser vacio');
                        }
                        
                    },
                    error:function(jqXHR, exception) {
                        alert('ocurrio un error en la funcion actualizar '+exception);
                    }
                });
            };
            function eliminar(id){
                //alert(id);
                opcion = confirm("Seguro que quieres eliminar a este usuario");
                if (opcion == true) {
                    alert("Has clickado OK");
                    console.log(id);
                    console.log(typeof id);
                    $.ajax({
                        url: '<?= base_url() ?>index.php/Administrador/eliminar_usuario',
                        type: 'POST',
                        data: {"id":id },
                        success: function (parametro){
                            //$("#body").html(data);
                            //$("#can").removeClass("active");
                            //$("#usu").removeClass("active");
                            //$("#ini").addClass("active");
                            alert('se mando la info al controlador');
                            if(typeof parametro == "object"){
                                console.log(parametro);
                                console.log(typeof parametro.id);
                                //var id_int = parseInt(id);
                                //console.log(id_int);
                                //console.log(typeof id_int);
                                //console.log(typeof id.id);
                                $.ajax({
                                url: 'https://apimusica.000webhostapp.com/testServer/index.php/api/Usuarios/usuarios?id='+parametro.id,
                                type: 'DELETE',
                                data: {},
                                success: function (respuesta){
                                    $.ajax({
                                        url: '<?= base_url() ?>index.php/Administrador/eliminado',
                                        type: 'POST',
                                        data: respuesta,
                                        success: function (data){
                                            $("#body").html(data);
                                            $("#can").removeClass("active");
                                            $("#usu").removeClass("active");
                                            $("#ini").addClass("active");
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
                            }else{
                                alert("No recibi un objeto, el id debe ser >0");
                            }
                        },
                         error: function (xhr, textStatus, errorMessage) {
                            console.log("ERROR" + errorMessage + textStatus + xhr);
                            //console.warn(jqxhr.responseText)
                        }
                    });
                } else {
                    alert("Has clickado Cancelar");
                }
            };
        </script>
    </body>
</html>