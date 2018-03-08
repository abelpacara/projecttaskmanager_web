      <link href = "<?php echo base_url("public/css/jquery-ui.css"); ?>"    rel = "stylesheet">
      <script src = "<?php echo base_url("public/js/jquery-ui.js"); ?>"></script>
      
      <!-- Javascript -->
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
				<td>Tipo</td>
				<td>
					<input id="inventory_category_name" type="text" name="inventory_category_name"  value="<?php if(isset($inventory_category_name)){ echo $inventory_category_name; }?>">
				</td>
			</tr>


			<tr>
				<td>Marca</td>
				<td>
					<input id="inventory_mark" type="text" name="inventory_mark" value="<?php if(isset($inventory_mark)){ echo $inventory_mark; }?>"/>
				</td>
			</tr>



			<tr>
				<td>Modelo</td>
				<td>
					<input id="inventory_model" type="text" name="inventory_model" value="<?php if(isset($inventory_model)){ echo $inventory_model; }?>"/>
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
			<table class="table table-striped table-hover">
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
					<th>Fecha de inicio de operaciones</th>				
					<th>Estado</th>				
				</tr>
			</thead>

			<?php
			for($i=0; $i<count($list_found_kardexes); $i++){
				?>
				<tr>
					<td><?php echo $i+1?></td>					
					<td>
                                            <a href="<?php echo site_url("./inventories/kardex_save/?kardex_id=".$list_found_kardexes[$i]['kardex_id']) ?>">
                                            <?php echo $list_found_kardexes[$i]['id_kardex']?>
                                            </a>
                                        </td>
					<td><?php echo $list_found_kardexes[$i]['inventory_category_name']?></td>
					<td><?php echo $list_found_kardexes[$i]['inventory_mark']?></td>
					<td><?php echo $list_found_kardexes[$i]['inventory_model']?></td>					

					<td><strong><a href="<?php echo site_url("./inventories/kardex_save/?kardex_id=".$list_found_kardexes[$i]['kardex_id']) ?>"><?php echo $list_found_kardexes[$i]['kardex_code'] ?></a></strong></td>

					<td><?php echo $list_found_kardexes[$i]['kardex_serial']?></td>
					<td><?php echo $list_found_kardexes[$i]['location_name']?></td>
					<td><?php echo mysql_date_format_to_spanish($list_found_kardexes[$i]['kardex_start_date'])?></td>
					<td><?php echo $list_found_kardexes[$i]['kardex_status_value']?></td>
					<td><strong><a href="<?php echo site_url("./inventories/kardex_status_save/?kardex_id=".$list_found_kardexes[$i]['kardex_id']) ?>">Cambiar Estado</a></strong></td>
					<td><strong><a href="<?php echo site_url("./inventories/kardex_delete/?kardex_id=".$list_found_kardexes[$i]['kardex_id']) ?>">Borrar Kardex</a></strong></td>
				</tr>
				<?php
			}?>
		</table>
		</div>
	</div>
</div>
