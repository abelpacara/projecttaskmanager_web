<link href = "<?php echo base_url("public/css/jquery-ui.css"); ?>"    rel = "stylesheet">
<script src = "<?php echo base_url("public/js/jquery-ui.js"); ?>"></script>

<script>
$(document).ready(function(){
   
   $(".selector").click(function () {
      
      var id = $(this).attr('id');   
      
      if($("#"+id).is(':checked')) { 
         $('#selected_'+id).removeClass("ptm_opacity_user_member");
      }
      else
      {
         $('#selected_'+id).addClass("ptm_opacity_user_member");   
      }
   });
});
</script>
<script>
$(function() {
   
   $( "#maintenance_register_date" ).datepicker({ dateFormat: 'dd/mm/yy',changeMonth: true,changeYear: true, firstDay: 1 });
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
	<h1>Registrar Mantenimiento</h1>

	<div id="body">		
		
		<?php
		echo form_open_multipart($this->uri->uri_string());
		?>
			<table>				
				<tr>
					<td>Seleccione Localidad</td>	
					<td>

						<?php
						$location_id_selected = "";
						if(isset($_REQUEST['location_id'])){
							$location_id_selected = $_REQUEST['location_id'];
						}

						echo get_display_locations_tree($list_locations, $name="location_id", $location_id_selected, $onchange=TRUE);
						?>

						
	              
	         	</td>	         	
         	</tr>
				<?php
				if(isset($_REQUEST['location_id'])){
				?>	

         	<tr>
         		<td>Fecha</td>
         		<td>
         			
         			<input id="maintenance_register_date" value="<?php echo $maintenance_register_date?>" name="maintenance_register_date" readonly="true" id="maintenance_register_date" class="arrow_drowpdown"/>
         		</td>
         	</tr>
         	<?php
         	}?>
				
				
			</table>
		

		<table>
		<tr>
			<td>

			<style>
			.device_item{
				float:left;
				padding: 5px;
				border: 1px solid;
				margin: 3px;

			}
			</style>
					
					
						<?php
						for($i=0; $i<count($list_kardexes); $i++){?>
							<div  id="selected_<?php echo $i?>"  class="device_item ptm_opacity_user_member overlay">
									<table>
										<tr>	
																				
											<td>
												<input type="checkbox"  id="<?php echo $i?>" class="selector" name="list_id_kardexes[]" value="<?php echo $list_kardexes[$i]['id_kardex']?>" />
											</td>
											<td>
												# <?php echo $i+1?>
											</td>	
										</tr>
										<tr>
											<th>Tipo</th>			
											<td><?php echo $list_kardexes[$i]['inventory_category_name'] ?></td>
										</tr>
										<tr>
											<th>Marca</th>
											<td><?php echo $list_kardexes[$i]['inventory_mark'] ?></td>
										</tr>
										<tr>
											<th>Modelo</th>
											<td><?php echo $list_kardexes[$i]['inventory_model'] ?></td>
										</tr>
										<tr>
											<th>Codigo</th>											
											<td><?php echo $list_kardexes[$i]['kardex_code'] ?></td>
										</tr>
										<tr>
											<th>Serial</th>											
											<td><?php echo $list_kardexes[$i]['kardex_serial'] ?></td>		
										</tr>
										<tr>
											<th>Ultimo cambio en</th>											
											<td><?php echo date("d-m-Y", strtotime($list_kardexes[$i]['kardex_status_register_date'])) ?></td>		
										</tr>
										<tr>
											<th>Estado</th>											
											<td>
												<select name="kardex_status_value_<?php echo $list_kardexes[$i]['id_kardex']?>">
													<option value="">Estado kardex ...</option>
													<?php
													for($j=0; $j<count($list_kardexes_status_values) ; $j++){
														?>
														<option value="<?php echo $list_kardexes_status_values[$j]?>"
														
														<?php
														if(strcasecmp($list_kardexes[$i]['kardex_status_value'], $list_kardexes_status_values[$j])==0)
														{
															echo " SELECTED ";	
														}
														?>
														
														>
															<?php echo $list_kardexes_status_values[$j]?>
														</option>
														<?php
													}?>
													</select>
											</td>											
										</tr>

										
										<tr>
											<th>Localidad</th>											
											<td>

												
												<select name="location_id_<?php echo $list_kardexes[$i]['id_kardex']?>">
													<option value="">Localizacion ...</option>
													<?php
													for($j=0; $j<count($list_locations) ; $j++){
														?>
														<option value="<?php echo $list_locations[$j]['id_location']?>"
														
														<?php
														if(strcasecmp($list_kardexes[$i]['location_name'], $list_locations[$j]['location_name'])==0)
														{
															echo " SELECTED ";	
														}
														?>
														
														>
															<?php echo $list_locations[$j]['location_name']?>
														</option>
														<?php
													}?>
													</select>
											</td>
											
										</tr>
									</table>
							</div>
						<?php
						}
						?>		
						
					

	
			</td>
		</tr>

		<?php
		if(isset($_REQUEST['location_id'])){
		?>		
		<tr>
			<td colspan="2">
				<textarea name="maintenance_description" cols="50" rows="3" placeholder="descripcion de soporte y mantenimiento general"></textarea>
			</td>
		</tr>	

		<tr>
			<td colspan="3">						
				<input type="submit" name="btn_save" value="Guardar"/>
			</td>
		</tr>
		<?php
		}
		?>


		</table>

		<?php
		echo form_close();
		?>
		<div class="table-responsive"> 		
			<div class="panel-default">
				<div class="panel-heading">
		       <h4>
		         LISTA DE MANTENIMIENTOS
		       </h4>
		     	</div>
	     	</div> 
		<table class="table table-striped table-hover">
			
			<tr>
				<th width="3%"  style="text-align: center; font-weight: bold;">#</th>
				<th width="3%"  style="text-align: center; font-weight: bold;">ID MAINTENANCE</th>
				<th width="30%" style="text-align: center; font-weight: bold;">DESCRIPCION</th>
				<th width="10%" style="text-align: center; font-weight: bold;">FECHA</th>
				<th width="10%" style="text-align: center; font-weight: bold;">LOCALIDAD</th>
				<th width="47%" style="text-align: center; font-weight: bold;">EQUIPOS</th>
			</tr>

			<?php
			for($i=0; $i<count($list_maintenances); $i++){
				?>
				<tr>					
					<td><?php echo $i+1?></td>
					<td><?php echo $list_maintenances[$i]['id_maintenance']?></td>
					<td><?php echo $list_maintenances[$i]['maintenance_description']?></td>
					<td><?php echo $list_maintenances[$i]['maintenance_register_date']?></td>
					<td><?php echo $list_maintenances[$i]['location_name']?></td>
					<td>
						<?php //print_r($list_maintenances[$i]['list_kardexes']) ?>
						<div class="table-responsive"> 
						<table class="table">
							<tr>
								<th width="75">ID KARDEX STATUS</th>			
								<th width="75">Tipo</th>			
								<th width="75">Marca</th>
								<th width="75">Modelo</th>
								<th width="75">Codigo</th>								
								<th width="75">Estado</th>																	
								<th width="75">Localidad</th>
								<th width="75">Ultimo cambio en</th>
								
							</tr>
							<?php 
							$list_maintenances_kardexes = $list_maintenances[$i]['list_kardexes'];
							for($k=0; $k<count($list_maintenances_kardexes); $k++){
							?>
								<tr>
									<td><?php echo $list_maintenances_kardexes[$k]['id_kardex_status']?></td>
									<td><?php echo $list_maintenances_kardexes[$k]['inventory_category_name']?></td>
									<td><?php echo $list_maintenances_kardexes[$k]['inventory_mark']?></td>
									<td><?php echo $list_maintenances_kardexes[$k]['inventory_model']?></td>
									<td><?php echo $list_maintenances_kardexes[$k]['kardex_code']?></td>									
									<td><?php echo $list_maintenances_kardexes[$k]['kardex_status_value']?></td>
									<td><?php echo $list_maintenances_kardexes[$k]['location_name']?></td>
									<td><?php echo $list_maintenances_kardexes[$k]['kardex_status_register_date']?></td>
								</tr>
							<?php
							}
							?>
							

						</table>
						</div>


					</td>
				</tr>
			<?php
			}
			?>
		</table>
		</div>

	</div>
</div>
