				<section class="container-fluid py-3 mt-2 mb-2 mx-2">
					<div class="row mt-1 mb-2 justify-content-md-center">
						<div class="col-6 text-right">
							<h1 class="h1 mr-4">Playlists</h1>
						</div>
						<div class="col-4 text-right">
							<button class="btn btn-sm color_1 mt-3 text-white" id="btAgregarPlay"
							<?php 
								if(isset($usuario['playlists'])) { 
									if(count($usuario['playlists'])==2) {  
										echo "disabled"; 
									} 
								}
							?> data-toggle="modal" data-target="#modal_agregar_playlist">Agregar</button>
						</div>
					</div>
					<div class="container-fluid row justify-content-md-center">
						<?php 
							if(isset($usuario['playlists'])) {
								foreach ($usuario['playlists'] as $playlist) { ?>
								 	<section class=" col-12-sm text-center rounded color_3 my-auto mx-auto">
										<div class="row my-1">
											<div class="col-10-sm col-8 text-right my-1">
												<h4 class="h4 my-1 text-white"><?= $playlist['nombre'] ?></h4>
											</div>
											<div class="col-2-sm col-4 text-right my-1">
												<button class="btn btn-sm btn-outline-light my-1 mr-3 text-white rounded-right" id="<?= $playlist['id']; ?>" onclick="mostrar_canciones(this)">+</button>
											</div>
										</div>
										<div class="table-responsive">
											<table class="table mt-2 mb-1 color_5 rounded text-white">
												<thead class="thead">
													<tr>
														<th scope="col">Cancion:</th>
														<th scope="col">Artista:</th>
														<th scope="col">Album:</th>
													</tr>
												</thead>
												<tbody>
													<?php 
														if (isset($playlist['canciones'])) {
															foreach ($playlist['canciones'] as $cancion) { ?>
																<tr>
											                    	<td><?= $cancion['nombre'] ?></td>
											                        <td><?= $cancion['artista'] ?></td>
											                        <td><?= $cancion['album'] ?></td>
										                    	</tr>
													<?php 
															}
														} ?>
												</tbody>
											</table>
										</div>
									</section>
							<?php 
								} 
					    	}
					    	else { ?>
							<section class="col-8 text-center rounded my-1 mx-4">
								<h1 class="h1">Aun no tienes playlist :( crea una :)</h1>
							</section>
						<?php 	
							} ?>
					</div>
				</section>
				<div class="modal fade" id="modal_agregar_playlist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  	<div class="modal-dialog modal-sm" role="document">
				    	<div class="modal-content">
				      		<div class="modal-header">
				        		<h5 class="modal-title" id="exampleModalLabel">Agregar playlist</h5>
				        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          			<span aria-hidden="true">&times;</span>
				        		</button>
				      		</div>
				      		<div class="modal-body">
				      			<input type="text" value="<?= $usuario['id']; ?>" hidden="" id="id_usuario" name="">
				      			<label>Nombre:</label>
				      			<input type="text" name="" id="nombre" class="form-control input-sm">
				      		</div>
				      		<div class="modal-footer">
				        		<button type="button" class="btn color_1 text-white" data-dismiss="modal" id="agregar_playlist" onclick="agregar_playlist()">
				        			Agregar
				        		</button>
				      		</div>
				    	</div>
				  	</div>
				</div>
