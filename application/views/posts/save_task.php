<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Guardar Tarea</title>
</head>
<body>

<div id="container">
	<h1>Guardar Tarea</h1>

	<div id="body">		
		<?php 
		echo form_open_multipart($this->uri->uri_string());
		?>
			<input type="text" name="post_title" placeholder="Titulo"/><br/>
			<textarea name="post_content" placeholder="Descripcion"></textarea><br/>
			<input type="submit" name="guardar" value="Guardar"/>
		<?php
		echo form_close();
		?>
	</div>
</div>
</body>
</html>