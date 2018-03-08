<link href = "<?php echo base_url("public/css/jquery-ui.css"); ?>"    rel = "stylesheet">      
<script src = "<?php echo base_url("public/js/jquery-ui.js"); ?>"></script>
<script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>


      <!-- Javascript -->
<script>

	$(function() {   
            $("#kardex_status_register_date").datepicker({ dateFormat: 'dd/mm/yy',changeMonth: true,changeYear: true, firstDay: 1 });
        
        
        
            
                /**#################################################**/
                $("#location_id").bind('change', function(e) {                  
                    
                    
                    var typeFeed=$(this).val();
                    
                    
                    
                    $.ajax( {
                      url: "<?php echo base_url('services/list_kardexes_by_location')?>",
                      dataType: "json",
                      async:true,
                      data: {
                        location_id: typeFeed
                      },
                      success: function( mydata ) {
                            $("#kardexes_parents").html("");
                          
                            var html_kardexes_parents = "<select name='parent_id' id='parent_id'><option value=''>Seleccione ...</option>";
                            
                            $.each(mydata, function(key, value){
                                
                                /*
                                for(var key in fields){
                                    
                                }*/                                
                                
                                $.each(value, function(key2, value2){
                                    //$("#kardexes_parents").append(key2 + ": " + value2 + '<br>');
                                    html_kardexes_parents += "<option value=''>"+value2+"</option>";
                                });
                            });
                            html_kardexes_parents += "</select>";
                            
                            
                            $("#kardexes_parents").html(html_kardexes_parents);
                          
                      }
                    } );
                   
                  
	      	}); 
        
	});
        
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
					<td>Compra</td>
					<td>
						<select name="purchase_item_id">
						<option value="">Detalle de compra ...</option>
						<?php
						for($i=0; $i<count($list_purchases) ; $i++){
							?>
							<option value="<?php echo $list_purchases[$i]['id_purchase_item']?>"

								<?php
								if(strcasecmp($kardex['purchase_item_id'], $list_purchases[$i]['id_purchase_item'])==0){
									echo " SELECTED ";
								}
								?>
								>
								<?php echo mysql_date_format_to_spanish($list_purchases[$i]['purchase_start_process_date'])."  ".$list_purchases[$i]['inventory_category_name']."  (".$list_purchases[$i]['purchase_item_quantity'].")  ".$list_purchases[$i]['purchase_name']?>
							</option>
							<?php
						}?>
						</select>							
					</td>
				</tr>
				<tr>					
					<td>Tipo de equipo</td>
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
                                
                                
				
                                
                                <tr class="jumbotron">
					<td>Localidad</td>	
					<td>
						<?php
						echo get_display_locations_tree($list_locations, $name="location_id", $kardex_status_first['location_id'], $onchange=FALSE);
						?>
                                    </td>
                                </tr>
                                
                                
                                <tr>
                                   <td>
                                            Equipo maestro
					</td>
					<td id="kardexes_parents">
                                            
					</td>
                                </tr>
                                
                                
                                <tr>
					<td>
                                            <strong>Codigo</strong>
					</td>
					<td>	
   					 <input id="kardex_code" name="kardex_code" value="<?php echo $kardex['kardex_code']?>" placeholder="Codigo">
					</td>
				</tr>
				<tr>
					<td>
                                            <strong>Serial</strong>
					</td>
					<td>
						<input id="kardex_serial" name="kardex_serial" value="<?php echo $kardex['kardex_serial']?>" placeholder="Serial">
						<input type="hidden" name="kardex_id" value="<?php echo $kardex['id_kardex']?>">

					</td>
				</tr>
				
         	<tr>
         		<td>Descripcion</td>	
         		<td>
						<textarea name="kardex_description" cols="50" rows="4" placeholder="Descripcion"><?php echo $kardex['kardex_description']?></textarea>
						<script type="text/javascript">
							jQuery(document).ready(function() {
					
							  CKEDITOR.replace('kardex_description');

							 });
			            
			         </script>
					</td>
				</tr>
				<tr class="jumbotron">
					<td>
						Fecha de inicio de operaciones
					</td>
					<td>
						<input id="kardex_status_register_date" value="<?php echo mysql_date_format_to_spanish($kardex_status_first['kardex_status_register_date'])?>" name="kardex_status_register_date" readonly="true" class="arrow_drowpdown"/>
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
		
		<table class="table-striped table-hover">
			<tr>
				<th>Localidad</th>
				<th>Fecha de registro</th>
				<th>Descripcion</th>
				<th>Cambiar estado</th>
			</tr>
			<?php
			for($i=0; $i<count($list_kardexes_status); $i++){?>
				<tr>
					<td><?php echo $list_kardexes_status[$i]['location_name'] ?></td>
					<td><?php echo $list_kardexes_status[$i]['kardex_status_register_date'] ?></td>
					<td><?php echo $list_kardexes_status[$i]['kardex_status_description'] ?></td>
					
					<td><a href="<?php echo site_url("inventories/kardex_status_save")."?kardex_id=".$list_kardexes_status[$i]['id_kardex_status'] ?>">Cambiar estado</td>
				</tr>
			<?php
			}
			?>
		</table>

	</div>
</div>
