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
			
   		<input id="kardex_code" type="text" name="kardex_code" placeholder="Codigo"/><br/>			
			<input id="kardex_serial" type="text" name="kardex_serial" placeholder="Serie"/><br/>	
			
			<input type="submit" name="btn_search" value="Buscar"/>
		<?php
		echo form_close();
		?>
		<table border="1">
			<tr>
				<th>#</th>
				<th>Nombre</th>
				<th>Marca</th>
				<th>Modelo</th>
				<th>Codigo</th>
				<th>Serie</th>
			</tr>

			<?php
			for($i=0; $i<count($list_found_kardexes); $i++){
				?>
				<tr>
					<td><?php echo $i+1?></td>					
					<td><?php echo $list_found_kardexes[$i]['inventory_mark']?></td>
					<td><?php echo $list_found_kardexes[$i]['inventory_model']?></td>
					<td><?php echo $list_found_kardexes[$i]['kardex_code']?></td>
					<td><?php echo $list_found_kardexes[$i]['kardex_serial']?></td>
					<td><a href='<?php echo site_url("/inventories/kardex_save2?kardex_id=".$list_found_kardexes[$i]['id_kardex']); ?>'>Modificar</a></td>
				</tr>
				<?php
			}?>
		</table>
	</div>
</div>