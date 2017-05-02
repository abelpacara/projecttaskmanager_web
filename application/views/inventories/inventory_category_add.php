<div id="container">
	<h1>Agregar Categoria de Inventario</h1>

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
					<textarea name="inventory_category_description" placeholder="Descripcion"></textarea>
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
					Descripcion
				</th>
			</tr>
			<?php
			for($i=0; $i<count($list_inventories_categories);$i++){
				?>
					<tr>
						<td><?php echo $i+1?></td>
						<td><?php echo $list_inventories_categories[$i]['inventory_category_name']?></td>
						<td><?php echo $list_inventories_categories[$i]['inventory_category_description']?></td>
					</tr>
				<?php
			}
			?>
		</table>


	</div>
</div>