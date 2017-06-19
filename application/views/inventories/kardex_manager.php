<link href = "<?php echo base_url("public/css/jquery-ui.css"); ?>"    rel = "stylesheet">
<script src = "<?php echo base_url("public/js/jquery-ui.js"); ?>"></script>

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
				<tr>
					<td>
						Codigo		
					</td>
					<td>
   					<input id="kardex_code" type="text" name="kardex_code"> 
   					<div id="kardex_code_message"></div>
					</td>
				</tr>
				<tr>
					<td>
						Serial		
					</td>
					<td>						
						<input id="kardex_code" type="text" name="kardex_serial">
					</td>
				</tr>
				<tr>					
					<td>Tipo</td>
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
				<tr>
					<td>Localidad</td>	
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
						<input type="text" name="kardex_status_description" placeholder="Descripcion" />
					</td>
				</tr>
				<tr>
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
		
		<table border="1">
			<CAPTION>LISTA DE KARDEX DE EQUIPOS</CAPTION>
			<tr>
				<th rowspan="2">#</th>
				<th rowspan="2">Categoria</th>
				<th rowspan="2">Marca</th>
				<th rowspan="2">Modelo</th>
				<th rowspan="2">Codigo</th>
				<th rowspan="2">Serial</th>
				<th colspan="4">Ultimo cambio en</th>				
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
					<td><?php echo $list_kardexes_full[$i]['inventory_category_name'] ?></td>
					<td><?php echo $list_kardexes_full[$i]['inventory_mark'] ?></td>
					<td><?php echo $list_kardexes_full[$i]['inventory_model'] ?></td>
					<td><?php echo $list_kardexes_full[$i]['kardex_code'] ?></td>
					<td><?php echo $list_kardexes_full[$i]['kardex_serial'] ?></td>		
					
					<td><?php echo $list_kardexes_full[$i]['id_kardex_status'] ?></td>
					<td><?php echo $list_kardexes_full[$i]['kardex_status_value'] ?></td>
					<td><?php echo $list_kardexes_full[$i]['location_name'] ?></td>
					<td><?php echo date("d-m-Y", strtotime($list_kardexes_full[$i]['kardex_status_register_date'])) ?></td>
				</tr>
			<?php
			}
			?>
		</table>

	</div>
</div>
