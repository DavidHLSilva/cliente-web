				<section class="container py-3 mt-2 mb-2">
					<div class="row my-auto mx-auto justify-content-md-center">
						<div class="col-6 text-right">
							<p class="h2 mr-4">
								Canciones
							</p>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table mt-2 mb-1 table-bordered text-white">
							<thead class="thead color_3">
								<tr>
									<th scope="col">Cancion:</th>
									<th scope="col">Artista:</th>
									<th scope="col">Album:</th>
									<th scope="col">Agregar:</th>
								</tr>
							</thead>
							<tbody class="color_1">
								<?php 
									foreach ($usuario['canciones'] as $cancion) { ?>
										<tr>
					                    	<td><?= $cancion['cancion'] ?></td>
					                        <td><?= $cancion['artista'] ?></td>
					                        <td><?= $cancion['album'] ?></td>
					                        <td><input type="checkbox" name="check" value="<?= $cancion['id']; ?>" class="chk"></td>
				                    	</tr>
								<?php 
									} ?>
							</tbody>
						</table>
					</div>
					<button class="btn color_5 mt-3 text-white" onclick="id_canciones(this)" id="agregar_cancion" value="<?= $usuario['id_playlist'] ?>">
						Agregar
					</button>
				</section>