<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Guardar Discusion</title>
</head>
<body>

<div id="container">
	<h1>Crear Foro</h1>

	<div id="body">		
		<?php 
		echo form_open_multipart($this->uri->uri_string());
		?>

			<select name="project_id">
				<option>
					Proyecto ...
				</option>
				<?php
				for($i=0; $i<count($list_projects); $i++)
				{?>
					<option value="<?php echo $list_projects[$i]['id_post']?>"><?php echo $list_projects[$i]['post_title']?></option>
				<?php
				}
				?>
			</select>
                        <br>

			<input type="text" name="post_title" placeholder="Titulo"/><br/>
			<textarea name="post_content" placeholder="Descripcion"></textarea><br/>
			<input type="submit" name="guardar" value="Guardar"/>
		<?php
		echo form_close();
		?>

		<table>
			<tr>
				<th>#</th>
				<th>Discussion</th>
				<th>Project</th>
			</tr>
			<?php
			for($i=0; $i<count($list_discussions); $i++)
			{?>
				<tr>
					<td><?php echo ($i+1)?></td>
					<td><?php echo $list_discussions[$i]['post_title']?></td>
					<!--<td><?php echo $list_discussions[$i]['project_title']?></td>-->
				</tr>
			<?php
			}
			?>
		</table>


	</div>
</div>
</body>
</html>