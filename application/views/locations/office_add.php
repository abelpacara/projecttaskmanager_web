<link href = "<?php echo base_url("public/css/jquery-ui.css"); ?>"    rel = "stylesheet">
<script src = "<?php echo base_url("public/js/jquery-ui.js"); ?>"></script>
<script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>


<script>
	$(function() {
		
		$( "#kardex_status_register_date").datepicker({ dateFormat: 'dd/mm/yy',changeMonth: true,changeYear: true, firstDay: 1 });
	});
	$(function(){
   //$('.style_mask').customStyle();
});
</script>

</head>
<div id="container">
	<h1>Registrar Oficina</h1>

	<div id="body">		
		
		<?php
		echo form_open_multipart($this->uri->uri_string());
		?>
		<table>							
			<tr>
				<td>Nombre</td>
				<td><input type="text" name="office_name"/></td>
			</tr>			
			<tr>
				<td>Sigla</td>
				<td><input type="text" name="office_shortname"/></td>
			</tr>			

			<tr class="jumbotron">
				<td>
					Descripcion
				</td>
				<td>
					<textarea name="office_description" cols="50" rows="4" placeholder="Descripcion"></textarea>
					<script type="text/javascript">
						jQuery(document).ready(function() {
							
							CKEDITOR.replace('office_description');

						});
						
					</script>
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
		         LISTA OFICINAS
		       </h4>
		     	</div>
	     	</div>
			<table class="table table-striped table-fixed">
				<tr>
					<th class="col-md-1">#</th>
					<th class="col-md-1">Nombre</th>
					<th class="col-md-1">Sigla</th>
					<th class="col-md-1">Descripcion</th>				
				</tr>
				<?php
				for($i=0; $i<count($list_offices); $i++){?>
					<tr>
						<td class="col-md-1"><?php echo $i+1 ?></td>					
						<td class="col-md-1"><?php echo $list_offices[$i]['office_name'] ?></td>
						<td class="col-md-1"><?php echo $list_offices[$i]['office_shortname'] ?></td>
						<td class="col-md-1"><?php echo $list_offices[$i]['office_description'] ?></td>
					</tr>
					<?php
				}?>
			</table>
		</div>
	</div>
</div>
