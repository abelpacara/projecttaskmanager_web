<link href = "<?php echo base_url("public/css/jquery-ui.css"); ?>"    rel = "stylesheet">
<script src = "<?php echo base_url("public/js/jquery-ui.js"); ?>"></script>

<script>
$(function() {
   
   $("#maintenance_start_register_date" ).datepicker({ dateFormat: 'dd/mm/yy',changeMonth: true,changeYear: true, firstDay: 1 });
   $("#maintenance_end_register_date" ).datepicker({ dateFormat: 'dd/mm/yy',changeMonth: true,changeYear: true, firstDay: 1 });
});
$(function(){
   //$('.style_mask').customStyle();
});
</script>

</head>
   

<div id="container">
	<h1>REPORTE DE KARDEXES POR FECHA</h1>

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
						<?php
						echo get_display_locations_tree($list_locations, $name="location_id", "", $onchange=FALSE);
						?>              
					</td>
				</tr>

				<tr>
					<td>
						Desde		
					</td>
				</tr>
				<tr>
					<td>
   					<input id="maintenance_start_register_date" type="text" name="maintenance_start_register_date">    					
					</td>
				</tr>
				<tr>
					<td>
						Hasta		
					</td>
				</tr>
				<tr>
					<td>						
						<input id="maintenance_end_register_date" type="text" name="maintenance_end_register_date">
					</td>
				</tr>
				
				<tr>					
					<td colspan="4"><input type="submit" name="btn_generate" value="Generar Reporte"></td>
				</tr>				
			</table>
		<?php
		echo form_close();
		?>
		
		

	</div>
</div>
