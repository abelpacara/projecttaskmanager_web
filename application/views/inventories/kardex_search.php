      <link href = "<?php echo base_url("public/css/jquery-ui.css"); ?>"    rel = "stylesheet">
      <script src = "<?php echo base_url("public/js/jquery-ui.js"); ?>"></script>
      
      <!-- Javascript -->
      <script>         

      </script>
   </head>
   

<div id="container">
	<h1>Buscar Kardex</h1>

	<div id="body">		
		
		<?php
		echo form_open_multipart($this->uri->uri_string());
		//echo form_open_multipart(base_url());
		?>
		<table>
			<tr>
				<td>Codigo</td>
				<td>				
					<input id="kardex_code" type="text" name="kardex_code" value="<?php if(isset($kardex_code)){ echo $kardex_code; }?>"/>
				</td>
			</tr>

			<tr>
				<td>Serie</td>
				<td>
					<input id="kardex_serial" type="text" name="kardex_serial" value="<?php if(isset($kardex_serial)){ echo $kardex_serial; }?>"/>
				</td>
			</tr>
			<tr>
					<td>Localidad</td>	
					<td>
						<?php
						$location_id_selected = "";
						if(isset($_REQUEST['location_id'])){
							$location_id_selected = $_REQUEST['location_id'];
						}
						echo get_display_locations_tree($list_locations, $name="location_id", $location_id_selected, $onchange=FALSE);
						?>                 
	         	</td>
         	</tr>
         	<tr>
         		<td>Estado</td>
					<td>			
						<select name="kardex_status_value">
						<option value="">Todos...</option>
						<?php
						for($i=0; $i<count($list_kardexes_status_values) ; $i++){
							?>
							<option value="<?php echo $list_kardexes_status_values[$i]?>"
							<?php
							if(isset($kardex_status_value) AND strcasecmp($list_kardexes_status_values[$i], $kardex_status_value)==0){
								echo " SELECTED ";
							}
							?>
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
						<input type="submit" name="btn_search" value="Buscar"/>	
					</td>	
				</tr>
		</table>			
		<?php
		echo form_close();
		?>
		<div class="table-responsive">
			<div class="panel-default">
				<div class="panel-heading">
		       <h4>
		         KARDEX ENCONTRADOS
		       </h4>
		     	</div>
	     	</div> 
			<table class="table table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>ID KARDEX</th>
					<th>Categoria</th>
					<th>Marca</th>
					<th>Modelo</th>
					<th>Codigo</th>
					<th>Serie</th>
					<th>Localidad</th>
					<th>Estado</th>				
				</tr>
			</thead>

			<?php
			for($i=0; $i<count($list_found_kardexes); $i++){
				?>
				<tr>
					<td><?php echo $i+1?></td>					
					<td><?php echo $list_found_kardexes[$i]['id_kardex']?></td>
					<td><?php echo $list_found_kardexes[$i]['inventory_category_name']?></td>
					<td><?php echo $list_found_kardexes[$i]['inventory_mark']?></td>
					<td><?php echo $list_found_kardexes[$i]['inventory_model']?></td>
					<td><?php echo $list_found_kardexes[$i]['kardex_code']?></td>
					<td><?php echo $list_found_kardexes[$i]['kardex_serial']?></td>
					<td><?php echo $list_found_kardexes[$i]['location_name']?></td>
					<td><?php echo $list_found_kardexes[$i]['kardex_status_value']?></td>					
				</tr>
				<?php
			}?>
		</table>
		</div>
	</div>
</div>
