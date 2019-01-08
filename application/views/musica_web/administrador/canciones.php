				<section class="container py-3 mt-2 mb-2">
					<div class="row my-auto mx-auto justify-content-md-center">
						<div class="col-6 text-right">
							<p class="h2 mr-4">
								Canciones
							</p>
						</div>
						<div class="col-4 text-right">
							<button class="btn color_5 mt-3 text-white" id="agregar_cancion" data-toggle="modal" data-target="#modal_cancion">
								Agregar
							</button>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table mt-2 mb-1 table-bordered text-white">
							<thead class="thead color_3">
								<tr>
									<th scope="col">Cancion:</th>
									<th scope="col">Artista:</th>
									<th scope="col">Album:</th>
								</tr>
							</thead>
							<tbody class="color_1">
								<?php 
									foreach ($canciones as $cancion) { ?>
										<tr>
					                    	<td><?= $cancion['cancion'] ?></td>
					                        <td><?= $cancion['artista'] ?></td>
					                        <td><?= $cancion['album'] ?></td>
				                    	</tr>
								<?php 
									} ?>
							</tbody>
						</table>
					</div>
				</section>
				<!-- Modal agregar cancion -->
				<div class="modal fade" id="modal_cancion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  	<div class="modal-dialog modal-sm" role="document">
				    	<div class="modal-content">
				      		<div class="modal-header">
				        		<h5 class="modal-title" id="exampleModalLabel">Agregar cancion</h5>
				        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          			<span aria-hidden="true">&times;</span>
				        		</button>
				      		</div>
				      		<form action="<?= base_url() ?>index.php/Administrador/agregar_cancion" method="post">
					      		<div class="modal-body">
					      			<label>Cancion:</label>
					      			<input type="text" name="nombre_cancion" id="cancion" class="form-control input-sm" required>
					      			<label>Artista:</label>
					      			<input type="text" name="nombre_artista" id="artista" class="form-control input-sm" required>
					      			<label>Album:</label>
					      			<input type="text" name="nombre_album" id="album" class="form-control input-sm" required>
					      			<label>Genero</label>
					      			<select class="custom-select" name="id_genero" id="id_tipo" class="form-control input-sm">
								    	<option value="1">Clasica</option>
								    	<option value="3">Blues</option>
								    	<option value="4">Corrido</option>
								    	<option value="5">Country</option>
								    	<option value="6">Cumbia</option>
								    	<option value="7">Disco</option>
								    	<option value="8">Electronica</option>
								    	<option value="9">Flamenco</option>
								    	<option value="10">Folk</option>
								    	<option value="11">Funk</option>
								    	<option value="12">Gospel</option>
								    	<option value="13">Heavy Metal</option>
								    	<option value="14">Hip Hop</option>
								    	<option value="15">Indie</option>
								    	<option value="16">Jazz</option>
								    	<option value="17">Merengue</option>
								    	<option value="18">Pop</option>
								    	<option value="19">Ranchera</option>
								    	<option value="20">Rap</option>
								    	<option value="21">Reggae</option>
								    	<option value="22">Reggaeton</option>
								    	<option value="23">Rumba</option>
								    	<option value="24">Rock</option>
								    	<option value="25">Rock and Roll</option>
								    	<option value="26">Salsa</option>
								    	<option value="27">Son</option>
								    	<option value="28">Soul</option>
								    	<option value="29">Tango</option>
								    	<option value="30">Balada</option>
								  	</select>
					      			<label>Archivo:</label>
								  	<div class="input-group mb-3">
										<div class="custom-file">
											<input type="file" class="custom-file-input" id="archivo_mp3" required>
										    <label class="custom-file-label" for="archivo_mp3">Selecciona el archivo</label>
										</div>
									</div>
					      		</div>
					      		<div class="modal-footer">
					        		<button type="button" class="btn color_5 text-white" data-dismiss="modal" id="agregar_cancion" href="#">
					        			Agregar
					        		</button>
					      		</div>
					      	</form>
				    	</div>
				  	</div>
				</div>
