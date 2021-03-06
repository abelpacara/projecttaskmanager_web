<link href = "<?php echo base_url("public/css/jquery-ui.css"); ?>"    rel = "stylesheet">
<script src = "<?php echo base_url("public/js/jquery-ui.js"); ?>"></script>
<script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>

<script>
	$(function() {
   
   $( "#kardex_status_register_date" ).datepicker({ dateFormat: 'dd/mm/yy',changeMonth: true,changeYear: true, firstDay: 1 });
	});
</script>

<div id="container">
	<h1>Guardar Estado Kardex</h1>

	<div id="body">		
		
		<?php
		echo form_open_multipart($this->uri->uri_string());
		?>
			<table border="1">
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
					<td colspan="2">			
						<select name="kardex_status_value">
						<option value="">Estado kardex ...</option>
						<?php
						for($i=0; $i<count($list_kardexes_status_values) ; $i++){
							?>
							<option value="<?php echo $list_kardexes_status_values[$i]?>">
								<?php echo $list_kardexes_status_values[$i]?>
							</option>
							<?php
						}?>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2">							
						<?php
						echo get_display_locations_tree($list_locations, $name="location_id", NULL, $onchange=FALSE);
						?>               
					</td>
				</tr>				

				<tr>
					<td colspan="2">
						<textarea name="kardex_status_description" cols="50" rows="4" placeholder="Descripcion"></textarea>
						<script type="text/javascript">
							jQuery(document).ready(function() {
					
							  CKEDITOR.replace('kardex_status_description');

							 });
			            
			         </script>
					</td>
				</tr>				
				<tr>
					<td colspan="2">
						<input id="kardex_status_register_date" value="<?php echo $kardex_status_register_date?>" name="kardex_status_register_date" readonly="true" id="end_date" class="arrow_drowpdown"/>
					</td>
				</tr>				
				<tr>
					<td colspan="2">
						<input type="hidden" name="kardex_id" value="<?php echo $kardex['id_kardex']?>"/>						
						<input type="submit" name="btn_save" value="Guardar"/>
					</td>
				</tr>
			</table>
		<?php
		echo form_close();
		?>
		<table border="1">
			<tr>				
				<th>Estado</th>
				<th>Localizacion</th>
				<th>Fecha de registro</th>
				<th>Descripcion</th>
			</tr>
			<?php
			for($i=0; $i<count($list_kardexes_status); $i++){?>
				<tr>
					<td><?php echo $list_kardexes_status[$i]['kardex_status_value'] ?></td>
					<td><?php echo $list_kardexes_status[$i]['location_name'] ?></td>					
					<td><?php echo $list_kardexes_status[$i]['kardex_status_register_date'] ?></td>					
					<td><?php echo $list_kardexes_status[$i]['kardex_status_description'] ?></td>					
				</tr>
			<?php
			}
			?>
		</table>
	</div>
</div>
