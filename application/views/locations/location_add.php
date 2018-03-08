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
	<h1>Registrar Localidad</h1>

	<div id="body">		
		
		<?php
		echo form_open_multipart($this->uri->uri_string());
		?>
		<table>				
			<tr class="jumbotron">
				<td>Oficina</td>	
				<td>
					<input type="hidden" value="<?php echo $office['id_office']?>"/>
					<?php echo $office['office_name']?>
				</td>
			</tr>
			<tr>
				<td>Localidad Superior</td>	
				<td>
					<?php
					echo get_display_locations_tree($list_locations, $name="location_id", $location_id, $onchange=FALSE);
					?>
				</td>
			</tr>
			<tr>
				<td>Nombre</td>
				<td><input type="text" name="location_name"/></td>
			</tr>			
			<tr class="jumbotron">
				<td>
					Descripcion
				</td>
				<td>
					<textarea name="location_description" cols="50" rows="4" placeholder="Descripcion"></textarea>
					<script type="text/javascript">
						jQuery(document).ready(function() {
							
							CKEDITOR.replace('location_description');

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
		         LISTA LOCALIDADES
		       </h4>
		     	</div>
	     	</div>
			<table class="table table-striped table-fixed">
				<tr>
					<th class="col-md-1">#</th>
					<th class="col-md-1">Nombre</th>
					<th class="col-md-1">Descripcion</th>				
				</tr>
				<?php
				for($i=0; $i<count($list_locations); $i++){?>
					<tr>
						<td class="col-md-1"><?php echo $i+1 ?></td>					
						<td class="col-md-1"><?php echo $list_locations[$i]['location_name'] ?></td>
						<td class="col-md-1"><?php echo $list_locations[$i]['location_description'] ?></td>
					</tr>
					<?php
				}?>
			</table>
		</div>
	</div>
</div>
