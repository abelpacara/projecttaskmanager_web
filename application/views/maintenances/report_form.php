<link href = "<?php echo base_url("public/css/jquery-ui.css"); ?>"    rel = "stylesheet">
<script src = "<?php echo base_url("public/js/jquery-ui.js"); ?>"></script>

<script>
$(function() {
   
   $("#maitenance_start_register_date" ).datepicker({ dateFormat: 'dd/mm/yy',changeMonth: true,changeYear: true, firstDay: 1 });
   $("#maitenance_end_register_date" ).datepicker({ dateFormat: 'dd/mm/yy',changeMonth: true,changeYear: true, firstDay: 1 });
});
$(function(){
   //$('.style_mask').customStyle();
});
</script>

</head>
   

<div id="container">
	<h1>REPORTE DE MANTENIMIENTOS POR FECHA</h1>

	<div id="body">		
		
		<?php
		echo form_open_multipart($this->uri->uri_string());
		?>
			<table>
				<tr>
					<td>
						Localidad
					</td>

				</tr>
				<tr>
					<td>
						<select name="location_id">
							<option>Localidades...</option>
							<?php 
		              	//echo get_display_locations_tree($list_locations_tree,"location_id","localidad seleccionado");
							for($i=0; $i<count($list_locations); $i++){
							?>
								<option value="<?php echo $list_locations[$i]['id_location']?>">
									<?php echo $list_locations[$i]['location_name']?>
								</option>
							<?php
							}
		              	?>	
						</select>	              
					</td>
				</tr>

				<tr>
					<td>
						Desde		
					</td>
				</tr>
				<tr>
					<td>
   					<input id="maitenance_start_register_date" type="text" name="maitenance_start_register_date">    					
					</td>
				</tr>
				<tr>
					<td>
						Hasta		
					</td>
				</tr>
				<tr>
					<td>						
						<input id="maitenance_end_register_date" type="text" name="maitenance_start_register_date">
					</td>
				</tr>
				
				<tr>					
					<td colspan="4"><input type="submit" name="btn_generate"></td>
				</tr>				
			</table>
		<?php
		echo form_close();
		?>
		
		

	</div>
</div>
