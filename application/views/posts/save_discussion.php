<div id="container">
	<h1>Guardar Foro</h1>

	<div id="body">		

	<?php
		echo form_open_multipart($this->uri->uri_string());
		?>
		<select name="project_id">
			<option value="">Proyecto ...</option>
		<?php
		for($i=0; $i<count($list_projects) ; $i++){
			?>
			<option value="<?php echo $list_projects[$i]['id_post']?>"><?php echo $list_projects[$i]['post_title']?></option>
			<?php
		}?>
		</select>

			<input type="text" name="post_title" placeholder="Titulo"/><br/>
			<textarea name="post_content" placeholder="Descripcion"></textarea><br/>
			<input type="submit" name="guardar" value="Guardar"/>
		<?php
		echo form_close();
		?>
	</div>
</div>
