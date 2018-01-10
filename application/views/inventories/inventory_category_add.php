<div id="container">
	<h1>Registrar Tipo de Kardex</h1>

	<div id="body">		
		
		<?php
		echo form_open_multipart($this->uri->uri_string());
		?>
		<table>
			<tr>
				<th>
					<input type="text" name="inventory_category_name" placeholder="Nombre"/>
				</th>
			</tr>
			
			<tr>
				<th>
					<input type="submit" name="btn_save" value="Guardar"/>
				</th>
			</tr>

		</table>
			
		<?php
		echo form_close();
		?>

		<div class="table-responsive">
			<div class="panel-default">
				<div class="panel-heading">
		       <h4>
		         LISTA DE TIPOS DE KARDEX
		       </h4>
		     	</div>
	     	</div> 
			<table class="table table-striped">
			
			<tr>
				<th>
					#
				</th>
				<th>
					Nombre
				</th>
				
			</tr>
			<?php
			for($i=0; $i<count($list_inventories_categories);$i++){
				?>
					<tr>
						<td><?php echo $i+1?></td>
						<td><?php echo $list_inventories_categories[$i]['inventory_category_name']?></td>						
					</tr>
				<?php
			}
			?>
		</table>
		</div>

	</div>
</div>
