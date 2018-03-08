<link href = "<?php echo base_url("public/css/jquery-ui.css"); ?>"    rel = "stylesheet">
<script src = "<?php echo base_url("public/js/jquery-ui.js"); ?>"></script>
<script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>


<script>
	$(function() {
		
		$( "#kardex_status_register_date" ).datepicker({ dateFormat: 'dd/mm/yy',changeMonth: true,changeYear: true, firstDay: 1 });
	});
	$(function(){
   //$('.style_mask').customStyle();
});
</script>


<!-- Javascript -->
<script>
	
	$( function() {

		$( "#kardex_code" ).change(function() {					
			$.ajax( {
				url: "<?php echo base_url('services/kardex_code_search')?>",
				dataType: "html",
				async:true,			          
				data: {
					term: $( "#kardex_code" ).val()
				},
				success: function( data ) {
			            //response( data );
			            $("#kardex_code_message").html(data);
			         }
			      });

		});

		
		/**#################################################**/
		$("#inventory_category_name" ).autocomplete({
			source: function( request, response ) {
				$.ajax( {
					url: "<?php echo base_url('services/list_inventories_categories')?>",
					dataType: "json",
					async:true,			          
					data: {
						term: request.term
					},
					success: function( data ) {
						response( data );
					}
				} );
			},
			minLength: 1
		});



		
		/**#################################################**/
		$("#inventory_mark" ).autocomplete({
			source: function( request, response ) {
				$.ajax( {
					url: "<?php echo base_url('services/list_inventories_marks')?>",
					dataType: "json",
					async:true,			          
					data: {
						term: request.term
					},
					success: function( data ) {
						response( data );
					}
				} );
			},
			minLength: 1
		}); 


		/**#################################################**/
		$("#inventory_model" ).autocomplete({
			source: function( request, response ) {
				$.ajax( {
					url: "<?php echo base_url('services/list_inventories_models')?>",
					dataType: "json",
					async:true,
					data: {
						term: request.term
					},
					success: function( data ) {
						response( data );
					}
				} );
			},
			minLength: 1
		}); 


		
		
		
		
		
		
	});
	
	

</script>
</head>


<div id="container">
	<h1>Registrar Kardex</h1>

	<div id="body">		
		
		<?php
		echo form_open_multipart($this->uri->uri_string());
		?>
		<table>				
			<tr class="jumbotron">
				<td>Localidad</td>	
				<td>
					<?php
					echo get_display_locations_tree($list_locations, $name="location_id", $location_id, $onchange=TRUE);
					?>               

				</td>
			</tr>
			<tr>
				<td>
					Compra
				</td>
				<td>
					<select name="purchase_item_id">
						<option value="">Detalle de compra ...</option>
						<?php
						for($i=0; $i<count($list_purchases) ; $i++){
							?>
							<option value="<?php echo $list_purchases[$i]['id_purchase_item']?>">
								<?php echo mysql_date_format_to_spanish($list_purchases[$i]['purchase_start_process_date'])."  ".$list_purchases[$i]['inventory_category_name']."  (".$list_purchases[$i]['purchase_item_quantity'].")  ".$list_purchases[$i]['purchase_name']?>
							</option>
							<?php
						}?>
					</select>
					
				</td>
			</tr>

			<tr>
				<td>
					Equipo maestro
				</td>
				<td>
					
					<select name="parent_id">
						<option value="">Seleccione ...</option>
						<?php
						for($i=0; $i<count($list_kardexes_by_location) ; $i++){
							?>
							<option value="<?php echo $list_kardexes_by_location[$i]['id_kardex']?>">
								<?php 
								echo $list_kardexes_by_location[$i]['inventory_category_name'].", ".
								$list_kardexes_by_location[$i]['kardex_code'].", ".
								$list_kardexes_by_location[$i]['kardex_serial'];
								?>
							</option>
							<?php
						}?>
					</select>
				</td>
			</tr>
			<tr>
				
				<td>
					<strong>Codigo</strong>
				</td>
				<td>
					<input id="kardex_code" type="text" name="kardex_code"> 
					<div id="kardex_code_message"></div>
				</td>
			</tr>
			<tr>
				<td>
					<strong>Serial</strong>
				</td>
				<td>						
					<input id="kardex_code" type="text" name="kardex_serial">
				</td>
			</tr>
			<tr>					
				<td>Tipo de equipo</td>
				<td>
					<input id="inventory_category_name" type="text" name="inventory_category_name">
				</td>
			</tr>
			<tr>					
				<td>Marca</td>					
				<td>
					<input id="inventory_mark" type="text" name="inventory_mark">
				</td>
			</tr>
			<tr>
				<td>Modelo</td>	
				<td><input id="inventory_model" type="text" name="inventory_model"></td>				
			</tr>
			
			<tr class="jumbotron">
				<td>Estado</td>
				<td>			
					<select name="kardex_status_value">
						<option value="">Estado ...</option>
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
			<tr class="jumbotron">
				<td>
					Descripcion
				</td>
				<td>
					<textarea name="kardex_description" cols="50" rows="4" placeholder="Descripcion"></textarea>
					<script type="text/javascript">
						jQuery(document).ready(function() {
							
							CKEDITOR.replace('kardex_description');

						});
						
					</script>
				</td>
			</tr>
			<tr class="jumbotron">
				<td>
					Fecha
				</td>
				<td>
					<input id="kardex_status_register_date" value="<?php echo $kardex_status_register_date?>" name="kardex_status_register_date" readonly="true" id="end_date" class="arrow_drowpdown"/>
				</td>
			</tr>
			<tr>
				<td colspan="3">						
					<input type="submit" name="btn_save" value="Guardar"/>
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
						LISTA DE KARDEX DE EQUIPOS
					</h4>
				</div>
			</div>
			<table class="table table-striped table-fixed">
				<tr>
					<th rowspan="2" class="col-md-1">#</th>
					<th rowspan="2" class="col-md-1">Kardex ID</th>
					<th rowspan="2" class="col-md-1">Tipo</th>
					<th rowspan="2" class="col-md-1">Marca</th>
					<th rowspan="2" class="col-md-1">Modelo</th>
					<th rowspan="2" class="col-md-1">Codigo</th>
					<th rowspan="2" class="col-md-1">Serial</th>
					<th rowspan="2" class="col-md-1">Fecha de inicio operacion</th>
					<th rowspan="2" class="col-md-1">Descripcion</th>
					<th colspan="4" class="col-md-6">Ultimo cambio en</th>				
				</tr>
				<tr>
					<th>ID KARDEX STATUS</th>				
					<th>Estado</th>
					<th>Localidad</th>
					<th>Fecha</th>				
				</tr>

				<?php
				for($i=0; $i<count($list_kardexes_full); $i++){?>
				<tr>
					<td><?php echo $i+1 ?></td>
					<td>
						<strong>
							<a href="<?php echo site_url('./inventories/kardex_save/?kardex_id='.$list_kardexes_full[$i]['id_kardex'])?>">
								<?php echo $list_kardexes_full[$i]['id_kardex'] ?>
							</a>
						</strong>
					</td>					
					<td><?php echo $list_kardexes_full[$i]['inventory_category_name'] ?></td>
					<td><?php echo $list_kardexes_full[$i]['inventory_mark'] ?></td>
					<td><?php echo $list_kardexes_full[$i]['inventory_model'] ?></td>
					<td><strong><a href="<?php echo site_url("./inventories/kardex_save/?kardex_id=".$list_kardexes_full[$i]['kardex_id']) ?>"><?php echo $list_kardexes_full[$i]['kardex_code'] ?></a></strong></td>
					<td><?php echo $list_kardexes_full[$i]['kardex_serial'] ?></td>
					<td><?php echo mysql_date_format_to_spanish($list_kardexes_full[$i]['kardex_start_date']) ?></td>
					<td><?php echo $list_kardexes_full[$i]['kardex_description'] ?></td>		
					
					<td><?php echo $list_kardexes_full[$i]['id_kardex_status'] ?></td>
					<td><?php echo $list_kardexes_full[$i]['kardex_status_value'] ?></td>
					<td><?php echo $list_kardexes_full[$i]['location_name'] ?></td>
					<td><?php echo mysql_date_format_to_spanish($list_kardexes_full[$i]['kardex_status_register_date']) ?></td>					
					<td><strong><a href="<?php echo site_url("./inventories/kardex_status_save/?kardex_id=".$list_kardexes_full[$i]['kardex_id']) ?>">Cambiar Estado</a></strong></td>
					<td><strong><a href="<?php echo site_url("./inventories/kardex_delete/?kardex_id=".$list_kardexes_full[$i]['kardex_id']) ?>">Borrar Kardex</a></strong></td>
				</tr>
				<?php
			}
			?>
			</table>
	</div>

</div>
</div>
