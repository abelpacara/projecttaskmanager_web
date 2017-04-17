      <link href = "<?php echo base_url("public/css/jquery-ui.css"); ?>"    rel = "stylesheet">
      <script src = "<?php echo base_url("public/js/jquery-1.10.2.js");?>"></script>
      <script src = "<?php echo base_url("public/js/jquery-ui.js"); ?>"></script>
      
      <!-- Javascript -->
      <script>
         /*
          $( function() {
			    			 
			    $("#kardex_code" ).autocomplete({
			      source: function( request, response ) {
			        $.ajax( {
			          url: "http://localhost/projecttaskmanager_web/index.php/inventories/list_kardexes_code",
			          dataType: "json",
			          async:false,			          
			          data: {
			            term: request.term
			          },
			          success: function( data ) {
			            response( data );
			          }
			        } );
			      },
			      minLength: 1,
			      select: function( event, ui ) {
			        //log( "Selected: " + ui.item.value + " aka " + ui.item.id );

			        		$.ajax( {
				          url: "http://localhost/projecttaskmanager_web/index.php/inventories/kardex_data",
				          dataType: "json",
				          async:false,				          
				          data: {
									kardex_code : ui.item.value				            
				          },
				          success: function( response ) {
				            //response( data );
				          }
				        }).done(function(data) {
							  
							  alert(data);
							   if ( console && console.log ) {
								      console.log( "Sample of data:"+data);
								    }
					  		   });
					  }	
	      	});
	   	});
			*/

      </script>
   </head>
   

<div id="container">
	<h1>Guardar Kardex</h1>

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
   					 <?php echo $kardex['kardex_code']?>
					</td>
				</tr>
				<tr>
					<td>
						Codigo		
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
						for($i=0; $i<count($list_kardexes_status) ; $i++){
							?>
							<option value="<?php echo $list_kardexes_status[$i]?>"><?php echo $list_kardexes_status[$i]?></option>
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
								<option value="<?php echo $list_locations[$i]['id_location']?>"><?php echo $list_locations[$i]['location_name']?></option>
								<?php
							}?>
						</select>
					</td>
				</tr>
				<tr>
					<td>							
						<input id="inventory_name" value="" type="text" name="inventory_name" placeholder="Nombre"/>
					</td>
				</tr>
				<tr>
					<td>
						<input id="inventory_mark" value="" type="text" name="inventory_mark" placeholder="Marca"/>
					</td>
				</tr>
				<tr>
					<td>
						<input id="inventory_model" value="" type="text" name="inventory_model" placeholder="Modelo"/>
					</td>
				</tr>
				<tr>
					<td>
						<input type="hidden" name="kardex_id" value="<?php echo $kardex['id_kardex']?>"/>
						<input type="submit" name="btn_save" value="Guardar"/>
					</td>
				</tr>
			</table>
		<?php
		echo form_close();
		?>
		
	</div>
</div>
