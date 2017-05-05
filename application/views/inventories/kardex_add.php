      <link href = "<?php echo base_url("public/css/jquery-ui.css"); ?>"    rel = "stylesheet">
      <script src = "<?php echo base_url("public/js/jquery-ui.js"); ?>"></script>
      
      <!-- Javascript -->
      <script>
         
          $( function() {
			    			 
			    /**#################################################**/
			    $("#inventory_category_name" ).autocomplete({
			      source: function( request, response ) {
			        $.ajax( {
			          url: "http://localhost/projecttaskmanager_web/index.php/services/list_categories",
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
			      minLength: 1,
			      select: function( event, ui ) {
			        //log( "Selected: " + ui.item.value + " aka " + ui.item.id );

			        		$.ajax( {
				          url: "http://localhost/projecttaskmanager_web/index.php/services/kardex_data",
				          dataType: "json",
				          async:true,				          
				          data: {
									inventory_category_name : ui.item.value				            
				          },
				          success: function( response ) {
				            //response( data );
				          }
				        }).done(function(data) {
							  
							  
							   if ( console && console.log ) {
								      
								    }
					  		   });
					  }	
	      	});
	   	});
			
			/**#################################################**/
			    $("#inventory_category_name" ).autocomplete({
			      source: function( request, response ) {
			        $.ajax( {
			          url: "http://localhost/projecttaskmanager_web/index.php/services/list_categories",
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
			      minLength: 1,
			      select: function( event, ui ) {
			        //log( "Selected: " + ui.item.value + " aka " + ui.item.id );

			        		$.ajax( {
				          url: "http://localhost/projecttaskmanager_web/index.php/services/kardex_data",
				          dataType: "json",
				          async:true,				          
				          data: {
									inventory_category_name : ui.item.value				            
				          },
				          success: function( response ) {
				            //response( data );
				          }
				        }).done(function(data) {
							  
							  
							   if ( console && console.log ) {
								      
								    }
					  		   });
					  }	
	      	});
	   	});

      </script>
   </head>
   

<div id="container">
	<h1>Agregar Kardex</h1>

	<div id="body">		
		
		<?php
		echo form_open_multipart($this->uri->uri_string());
		?>
			<table>
				<tr>					
					<td>Categoria</td>
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
					<td><input id="inventory_mark" type="text" name="inventory_model"></td>				
				</tr>
				<tr>
					<td>
						Codigo		
					</td>
					<td>
   					<input id="kardex_code" type="text" name="kardex_code"> 
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
					<td>						
						<input type="submit" name="btn_save" value="Guardar"/>
					</td>
				</tr>
			</table>
		<?php
		echo form_close();
		?>
		
		<table border="1">
			<tr>
				<th>Categoria</th>
				<th>Marca</th>
				<th>Modelo</th>
				<th>Codigo</th>
				<th>Serial</th>
				
			</tr>
			<?php
			for($i=0; $i<count($list_kardexes); $i++){?>
				<tr>
					<td><?php echo $list_kardexes[$i]['inventory_category_name'] ?></td>
					<td><?php echo $list_kardexes[$i]['inventory_mark'] ?></td>
					<td><?php echo $list_kardexes[$i]['inventory_model'] ?></td>
					<td><?php echo $list_kardexes[$i]['kardex_code'] ?></td>
					<td><?php echo $list_kardexes[$i]['kardex_serial'] ?></td>
					
				</tr>
			<?php
			}
			?>
		</table>

	</div>
</div>
