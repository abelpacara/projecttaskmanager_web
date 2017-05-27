<div id="container">
	<h1>Guardar Tarea</h1>

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
					for($i=0; $i<count($list_inventories_categories) ; $i++){
						?>
						<option value="<?php echo $list_inventories_categories[$i]['id_inventory_category']?>"><?php echo $list_inventories_categories[$i]['inventory_category_name']?></option>
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
	</div>
</div>
