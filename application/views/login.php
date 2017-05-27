<div id="container">
	<h1>Guardar Foro</h1>

	<div id="body">		

	<?php
		echo form_open_multipart($this->uri->uri_string());
		?>
<<<<<<< HEAD:application/views/login.php
			<input type="text" name="user_email" placeholder="Email"/><br/>			
			<input type="password" name="user_password" placeholder="Password"/><br/>			
			<input type="submit" name="login" value="Login"/>
=======
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
>>>>>>> origin/feature/INVENTARIOS:application/views/posts/save_discussion.php
		<?php
		echo form_close();
		?>
	</div>
</div>
