<div id="container">
	<h1>Registrar inventario</h1>

	<div id="body">		
		
		<?php
		echo form_open_multipart($this->uri->uri_string());
		?>
		<table>
			<tr>
				<th>
					<select name="inventory_category_id">
					<option value="">Categoria ...</option>
					<?php
					for($i=0; $i<count($list_inventories) ; $i++){
						?>
						<option value="<?php echo $list_inventories[$i]['id_inventory_category']?>"><?php echo $list_inventories[$i]['inventory_category_name']?></option>
						<?php
					}?>
					</select>

				</th>				
			</tr>
			<tr>
				<th>
					<input type="text" name="inventory_mark" placeholder="Marca"/>
				</th>
			</tr>
			<tr>
				<th>
					<input type="text" name="inventory_model" placeholder="Modelo"/>
				</th>
			</tr>

			<tr>
				<th>
					<textarea name="inventory_description" placeholder="Descripcion"></textarea>
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


		
		<table border="1">
			<tr>
				<th>
					#
				</th>
				<th>
					Nombre
				</th>
				<th>
					Marca
				</th>
				<th>
					Modelo
				</th>
				<th>
					Descripcion
				</th>
			</tr>
			<?php
			for($i=0; $i<count($list_inventories);$i++){
				?>
					<tr>
						<td><?php echo $i+1?></td>
						<td><?php echo $list_inventories[$i]['inventory_category_name']?></td>
						<td><?php echo $list_inventories[$i]['inventory_mark']?></td>
						<td><?php echo $list_inventories[$i]['inventory_model']?></td>
						<td><?php echo $list_inventories[$i]['inventory_description']?></td>
					</tr>
				<?php
			}
			?>
		</table>


	</div>
</div>
