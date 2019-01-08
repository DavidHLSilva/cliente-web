			<section class="container py-3 mt-2 mb-2">
				<?php //print_r($usuario); 
					//echo "\n";
					//echo count($usuario['playlists']);
				?>
					<?php 
						if(isset($usuario['playlists'])) {
					    	if (count($usuario['playlists']) == 1) { ?>
						        <section class="container py-3 mt-2 mb-2">
						            <div class="row ">
						                <div class="col-sm-12 col-md-6 text-center">
						                    <img src="<?= base_url() ?>img/musica/icono2.svg" width="65%" height="65%" class="mx-auto d-block" alt="Musica">
						                    
						                    <audio id="reproductor" controls=""></audio>
						                </div>
						                <div class="col-sm-12 col-md-6 text-center mt-5">
						                    <div class="col-sm-10 col-md-10 mr-auto ml-auto">
						                        <ul class="list-group" id="playlist_1" style="height: 250px; overflow-y: scroll;">
						                            <li class="list-group-item color_5 text-white"><?= $usuario['playlists'][0]['nombre'] ?></li>
						                            <?php 
						                            	if (isset($usuario['playlists'][0]['canciones'])) {
							                            	foreach ($usuario['playlists'][0]['canciones'] as $cancion) { 
							                            		$direccion = str_replace(" ", "%20", $cancion['direccion']);
							                            		$direccion = "https://apimusica.000webhostapp.com/testServer/".$direccion; ?>
							                                	<li class="list-group-item" id="<?= $direccion; ?>" name="fila" onclick="play(this)"><?= $cancion['nombre'] ?></li>
						                            <?php 
						                            	}
						                        			} ?>
						                        </ul>
						                    </div>
						                </div>
						            </div>
						        </section>
					   	<?php 
							} 
							if(count($usuario['playlists']) == 2) { ?>
						        <section class="container py-3 mt-2 mb-2">
						            <div class="row ">
						                <div class="col-sm-12 col-md-6 text-center">
						                    <img src="<?= base_url() ?>img/musica/icono2.svg" width="65%" height="65%" class="mx-auto d-block" alt="Musica">
						                    
						                    <audio id="reproductor" controls=""></audio>
						                </div>
						                <div class="col-sm-12 col-md-6 text-center mt-5">
						                    <div class="col-sm-10 col-md-10 mr-auto ml-auto">
						                        <ul class="list-group" id="playlist_1" style="height: 250px; overflow-y: scroll;">
						                            <li class="list-group-item color_5 text-white"><?= $usuario['playlists'][0]['nombre'] ?></li>
						                            <?php 
						                            	if (isset($usuario['playlists'][0]['canciones'])) {
								                            foreach ($usuario['playlists'][0]['canciones'] as $cancion) { 
								                            	$direccion = str_replace(" ", "%20", $cancion['direccion']);
							                            		$direccion = "https://apimusica.000webhostapp.com/testServer/".$direccion; ?>
								                                <li class="list-group-item" id="<?= $direccion; ?>" name="fila" onclick="play(this)"><?= $cancion['nombre'] ?></li>
						                            <?php
						                            	}
						                        			} ?>
						                        </ul>
						                    </div>
						                    <div class="col-sm-10 col-md-10 mr-auto ml-auto">
						                        <ul class="list-group" id="playlist_2" style="height: 250px; overflow-y: scroll;">
						                            <li class="list-group-item color_5 text-white"><?= $usuario['playlists'][1]['nombre'] ?></li>
						                            <?php
						                            	if (isset($usuario['playlists'][1]['canciones'])) { 
								                            foreach ($usuario['playlists'][1]['canciones'] as $cancion) { 
								                            	$direccion = str_replace(" ", "%20", $cancion['direccion']);
							                            		$direccion = "https://apimusica.000webhostapp.com/testServer/".$direccion;  ?>
								                                <li class="list-group-item" id="<?= $direccion; ?>" name="fila" onclick="play(this)"><?= $cancion['nombre'] ?></li>
						                            <?php
						                            	}
						                        			} ?>
						                        </ul>
						                    </div>
						                </div>
						            </div>
						        </section>
						<?php 
							} 
						} else { ?>
				        <section class="container py-3 mt-2 mb-2">
				            <div class="row ">
				                <div class="col-sm-12 col-md-12">
				                    <img src="<?= base_url() ?>img/musica/icono2.svg" width="55%" height="55%" class="mx-auto d-block" alt="Musica">
				                    <h1 class="h1 text-center">No tienes playlist :(</h1>
				                </div>
				            </div>
				        </section>
				   	<?php 
						} ?>
			</section>
