<div id="container">
	<h1>Guardar Tarea</h1>

	<div id="body">		
		
		<?php
		echo form_open_multipart($this->uri->uri_string());
		?>
		<select name="discussion_id">
			<option value="">Discusion ...</option>
		<?php
		for($i=0; $i<count($list_discussions) ; $i++){
			?>
			<option value="<?php echo $list_discussions[$i]['id_post']?>"><?php echo $list_discussions[$i]['post_title']?></option>
			<?php
		}?>
		</select>
                <br>

			<input type="text" name="post_title" placeholder="Titulo"/><br/>
			<textarea name="post_content" placeholder="Descripcion"></textarea><br/>
			<input type="submit" name="guardar" value="Guardar"/>
		<?php
		echo form_close();
		?>
	</div>
        <table>
                <tr>
                        <th>#</th>
                        <th>Task</th>
                        <th>Discussion</th>
                        <th>Project</th>
                </tr>
                <?php
                for($i=0; $i<count($list_tasks); $i++)
                {?>
                        <tr>
                                <td><?php echo ($i+1)?></td>
                                <td><?php echo $list_tasks[$i]['post_title']?></td>
                                <!--<td><?php echo $list_tasks[$i]['project_title']?></td>-->
                        </tr>
                <?php
                }
                ?>
        </table>
</div>
