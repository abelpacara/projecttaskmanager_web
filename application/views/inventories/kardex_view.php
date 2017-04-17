<link href = "<?php echo base_url("public/css/jquery-ui.css"); ?>"    rel = "stylesheet">
<script src = "<?php echo base_url("public/js/jquery-1.10.2.js");?>"></script>
<script src = "<?php echo base_url("public/js/jquery-ui.js"); ?>"></script>


<div id="container">
	<h1>Guardar Kardex</h1>

	<div id="body">		
		<table border="1">
			<tr>
				<th>Nombre</th><td><?php echo $found_kardex['inventory_name']?></td>
				<th>Marca</th><td><?php echo $found_kardex['inventory_mark']?></td>
				<th>Modelo</th><td><?php echo $found_kardex['inventory_model']?></td>
				<th>Codigo</th><td><?php echo $found_kardex['kardex_code']?></td>
				<th>Serie</th><td><?php echo $found_kardex['kardex_serial']?></td>
				<th>Estado</th><td><?php echo $found_kardex['kardex_status_value']?></td>
				<th>Localidad</th><td><?php echo $found_kardex['location_name']?></td>
				<th>Fecha Ultimo Registro</th><td><?php echo $found_kardex['kardex_status_register_date']?></td>
				<td>Modificar</td><td>Volver</td>
			</tr>
		</table>
	</div>
</div>
