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
	<h1>Administrar Kardex</h1>

		
		<table border="1" class="table-striped table-hover">
			<CAPTION>LISTA DE KARDEX DE EQUIPOS</CAPTION>
			<tr>
				<th rowspan="2">#</th>
				<th rowspan="2">Categoria</th>
				<th rowspan="2">Marca</th>
				<th rowspan="2">Modelo</th>
				<th rowspan="2">Codigo</th>
				<th rowspan="2">Serial</th>
				<th rowspan="2">Fecha inicio de operaciones</th>
				<th rowspan="2">Descripcion</th>
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
					<td><a href="<?php echo site_url("./inventories/kardex_save/?kardex_id=".$list_kardexes_full[$i]['kardex_id']) ?>">
							<?php echo $list_kardexes_full[$i]['inventory_category_name'] ?>
						</a>
					</td>
					<td><?php echo $list_kardexes_full[$i]['inventory_mark'] ?></td>
					<td><?php echo $list_kardexes_full[$i]['inventory_model'] ?></td>
					<td>
						<?php echo $list_kardexes_full[$i]['kardex_code'] ?>													
					</td>
					<td><?php echo $list_kardexes_full[$i]['kardex_serial'] ?></td>		
					<td><?php echo mysql_date_format_to_spanish($list_kardexes_full[$i]['kardex_start_date']) ?></td>		
					<td><?php echo $list_kardexes_full[$i]['kardex_description'] ?></td>							
					<td><?php echo $list_kardexes_full[$i]['id_kardex_status'] ?></td>
					<td><?php echo $list_kardexes_full[$i]['kardex_status_value'] ?></td>
					<td><?php echo $list_kardexes_full[$i]['location_name'] ?></td>
					<td><?php 
						echo mysql_date_format_to_spanish($list_kardexes_full[$i]['kardex_status_register_date']) 						
						?>							
					</td>
					<td><strong><a href="<?php echo site_url("./inventories/kardex_status_save/?kardex_id=".$list_kardexes_full[$i]['kardex_id']) ?>">Cambiar Estado</a></strong></td>
					<td><strong><a href="<?php echo site_url("./inventories/kardex_delete/?kardex_id=".$list_kardexes_full[$i]['kardex_id']) ?>">Borrar Kardex</a></strong></td>
				</tr>
			<?php
			}
			?>
		</table>

	</div>
</div>
