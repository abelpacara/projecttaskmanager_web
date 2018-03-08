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
					<td>Equipo</td>
					<td><?php echo $kardex['inventory_category_name']?></td>
				</tr>
				<tr>					
					<td>Marca</td>
					<td><?php echo $kardex['inventory_mark']?></td>
				</tr>
				<tr>
					<td>Modelo</td>
					<td><?php echo $kardex['inventory_model']?></td>
				</tr>
				<tr>
					<td>
						Codigo		
					</td>
					<td>	
   					 <input id="kardex_code" name="kardex_code" value="<?php echo $kardex['kardex_code']?>" placeholder="Codigo">
					</td>
				</tr>
				<tr>
					<td>
						Serial		
					</td>
					<td>
						<input id="kardex_serial" name="kardex_serial" value="<?php echo $kardex['kardex_serial']?>" placeholder="Serial">
						<input type="hidden" name="kardex_id" value="<?php echo $kardex['id_kardex']?>">

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
		
		<table>
			<tr>
				<th>Categoria</th>
				<th>Marca</th>
				<th>Modelo</th>
				<th>Codigo</th>
				<th>Serial</th>
				<th>Cambiar estado</th>
			</tr>
			<?php
			for($i=0; $i<count($list_kardexes); $i++){?>
				<tr>
					<td><?php echo $list_kardexes[$i]['inventory_category_name'] ?></td>
					<td><?php echo $list_kardexes[$i]['inventory_mark'] ?></td>
					<td><?php echo $list_kardexes[$i]['inventory_model'] ?></td>
					<td><?php echo $list_kardexes[$i]['kardex_code'] ?></td>
					<td><?php echo $list_kardexes[$i]['kardex_serial'] ?></td>
					<td><a href="<?php echo site_url("inventories/kardex_status_save")."?kardex_id=".$list_kardexes[$i]['id_kardex'] ?>">Cambiar estado</td>
				</tr>
			<?php
			}
			?>
		</table>

	</div>
</div>
