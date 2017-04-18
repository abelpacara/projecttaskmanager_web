<link href = "<?php echo base_url("public/css/jquery-ui.css"); ?>"    rel = "stylesheet">
<script src = "<?php echo base_url("public/js/jquery-1.10.2.js");?>"></script>
<script src = "<?php echo base_url("public/js/jquery-ui.js"); ?>"></script>

<div id="container">
	<h1>Guardar Kardex</h1>

	<div id="body">		
		
		<?php
		echo form_open_multipart($this->uri->uri_string());
		?>
			<table>
				<tr>					
					<td>Equipo</td>
					<td><?php echo $kardex['inventory_category_name']?></td>
				</tr>
				<tr>					
					<td>Marca</td>
					<td><?php echo $kardex['inventory_mark']?></td>
				</tr>
				<tr>
					<td>Modelo</td>
					<td><?php echo $kardex['inventory_model']?></td>
				</tr>
				<tr>
					<td>
						Codigo		
					</td>
					<td>	
   					 <?php echo $kardex['kardex_code']?>
					</td>
				</tr>
				<tr>
					<td>
						Serial		
					</td>
					<td>
						<?php echo $kardex['kardex_serial']?>
					</td>
				</tr>
				<tr>
					<td>			
						<select name="kardex_status_value">
						<option value="">Estado kardex ...</option>
						<?php
						for($i=0; $i<count($list_kardexes_status_values) ; $i++){
							?>
							<option value="<?php echo $list_kardexes_status_values[$i]?>"
								<?php if(strcasecmp($kardex['kardex_status_value'], $list_kardexes_status_values[$i])==0) { echo " SELECTED "; } ?>
								>
								<?php echo $list_kardexes_status_values[$i]?>
							</option>
							<?php
						}?>
						</select>
					</td>
				</tr>
				<tr>
					<td>							
						<select name="location_id">
							<option value="">Localizacion ...</option>
							<?php
							for($i=0; $i<count($list_locations) ; $i++){
								?>
								<option value="<?php echo $list_locations[$i]['id_location']?>"
								<?php if(strcasecmp($kardex['location_name'], $list_locations[$i]['location_name'])==0) { echo " SELECTED "; } ?>
								>
									<?php echo $list_locations[$i]['location_name']?>										
								</option>
								<?php
							}?>
						</select>
					</td>
				</tr>				
				
				<tr>
					<td>						
						<input type="submit" name="btn_save" value="Guardar"/>
					</td>
				</tr>
			</table>
		<?php
		echo form_close();
		?>
		<table>
			<tr>
				<th>Categoria</th>
				<th>Marca</th>
				<th>Modelo</th>
				<th>Codigo</th>
				<th>Serial</th>
				<th>Estado</th>
				<th>Localizacion</th>				
			</tr>
			<?php
			for($i=0; $i<count($list_kardexes_status); $i++){?>
				<tr>
					<td><?php echo $list_kardexes_status[$i]['inventory_category_name'] ?></td>
					<td><?php echo $list_kardexes_status[$i]['inventory_mark'] ?></td>
					<td><?php echo $list_kardexes_status[$i]['inventory_model'] ?></td>
					<td><?php echo $list_kardexes_status[$i]['kardex_code'] ?></td>
					<td><?php echo $list_kardexes_status[$i]['kardex_serial'] ?></td>					
				</tr>
			<?php
			}
			?>
		</table>
	</div>
</div>
