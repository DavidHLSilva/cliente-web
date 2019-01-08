				<section class="container py-3 mt-2 mb-2">
					<div class="row my-auto mx-auto justify-content-md-center">
						<div class="col-6 text-right">
							<p class="h2 mr-4">
								Usuarios
							</p>
						</div>
						<div class="col-4 text-right">
							<button class="btn color_5 mt-3 text-white" id="agregar_cancion" data-toggle="modal" data-target="#modal_nuevo">
								Agregar
							</button>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table mt-2 mb-1 table-hover table-bordered text-white">
							<thead class="thead color_3">
								<tr>
									<th>Nombre:</th>
									<th>Tipo usuario:</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody class="color_1">
								<?php 
									foreach ($usuarios as $usuario) { 
										if($usuario['activo'] == 1){ 
											$info = $usuario['id']."||".
						                    		$usuario['nombre']."||".
						                    		$usuario['id_tipo_usuario']; ?>
											<tr>
						                    	<td><?= $usuario['nombre'] ?></td>
						                    	<?php 
						                    		if($usuario['id_tipo_usuario'] == 1) { ?>
						                        		<td>Administrador</td>
						                        <?php
						                        	} else { ?>
						                        		<td>Usuario</td>
						                        <?php
						                        	} ?>
						                        <td>
						                        	<button class="btn btn-sm btn-outline-warning" data-toggle="modal" data-target="#modal_editar" onclick="mostrar_info('<?php echo $info ?>')">
						                        		Editar
						                        	</button>
						                        </td>
						                        <td>
						                        	<button class="btn btn-sm btn-outline-danger" onclick="eliminar('<?php echo (int)$usuario['id'] ?>')">Eliminar</button>
						                        </td>
					                    	</tr>
								<?php 	}
									} ?>
							</tbody>
						</table>
					</div>
				</section>

				<!-- Modal agregar usuario -->
				<div class="modal fade" id="modal_nuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  	<div class="modal-dialog modal-sm" role="document">
				    	<div class="modal-content">
				      		<div class="modal-header">
				        		<h5 class="modal-title" id="exampleModalLabel">Agregar usuario</h5>
				        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          			<span aria-hidden="true">&times;</span>
				        		</button>
				      		</div>
				      		<div class="modal-body">
				      			<label>Nombre:</label>
				      			<input type="text" name="" id="nombre" class="form-control input-sm">
				      			<label>Contraseña</label>
				      			<input type="text" name="" id="contrasenia" class="form-control input-sm">
				      			<label>Tipo de usuario</label>
							  	<select class="custom-select" id="id_tipo" class="form-control input-sm">
							    	<option value="1">Administrador</option>
							    	<option value="2">Usuario</option>
							  	</select>
				      		</div>
				      		<div class="modal-footer">
				        		<button type="button" class="btn color_5 text-white" data-dismiss="modal" id="agregar_usuario" onclick="agregar_usuario()">
				        			Agregar
				        		</button>
				      		</div>
				    	</div>
				  	</div>
				</div>
				<!-- Modal editar usuario -->
				<div class="modal fade" id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  	<div class="modal-dialog modal-sm" role="document">
				    	<div class="modal-content">
				      		<div class="modal-header">
				        		<h5 class="modal-title" id="exampleModalLabel">Editar usuario</h5>
				        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          			<span aria-hidden="true">&times;</span>
				        		</button>
				      		</div>
				      		<div class="modal-body">
				      			<input type="text" hidden="" id="id_usuario" name="">
				      			<label>Nombre:</label>
				      			<input type="text" name="" id="nombre_editar" class="form-control input-sm">
				      			<label>Tipo de usuario</label>
							  	<select class="custom-select" id="id_tipo_editar" class="form-control input-sm">
							    	<option value="1">Administrador</option>
							    	<option value="2">Usuario</option>
							  	</select>
				      		</div>
				      		<div class="modal-footer">
				        		<button type="button" class="btn btn-warning" data-dismiss="modal" id="editar_usuario" onclick="actualizar_usuario()">
				        			Editar
				        		</button>
				      		</div>
				    	</div>
				  	</div>
				</div>
				
