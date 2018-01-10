<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<script src = "<?php echo base_url("public/js/jquery-1.12.4.js"); ?>"></script>
<script src = "<?php //echo base_url("public/js/jquery-3.2.1.js");?>"></script>
<script src = "<?php echo base_url("public/js/bootstrap.js");?>"></script>
	<meta charset="utf-8">
	<title>Maintenance & Support</title>
	<link rel="stylesheet" href="<?php echo base_url("public/css/bootstrap.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("public/css/ptm.css"); ?>">
	

	


<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      
        <div id="logo_container">
		      <a class="navbar-brand" href="#">
		      	<img id="logo" src='<?php echo base_url("public/images/logo.png");?>'/>
		      </a>
	      </div>

    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li>
        		<a href="<?php echo site_url('/maintenances/maintenance_add')?>">Home</a>
     	  </li>
        <li class="dropdown">
          <a href="<?php echo site_url('/maintenances/maintenance_add')?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Soporte y Mantenimiento <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('/maintenances/maintenance_add')?>">Registrar Mantenimiento</a></li>
            <li><a href="<?php echo site_url('/maintenances/report_form')?>">Reporte de soporte y mantenimiento</a></li>            
            <li role="separator" class="divider"></li>            
          </ul>
        </li>
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Kardex <span class="caret"></span></a>
          <ul class="dropdown-menu">          	
          	<li><a href="<?php echo site_url('/inventories/kardex_add')?>">(2) Registrar Kardex</a></li>            
            <li><a href="<?php echo site_url('/inventories/inventory_category_add')?>">(1) Registrar Tipo Kardex</a></li>
            <li><a href="<?php echo site_url('/inventories/report_form')?>">(3) Reporte general de Kardex de equipos</a></li>
            <li><a href="<?php echo site_url('/inventories/kardex_search')?>">(4) Buscar Kardex</a></li>
            <li><a href="<?php echo site_url('/inventories/kardex_manager')?>">(5) Administrar Kardex</a></li>
            <li role="separator" class="divider"></li>            
          </ul>
        </li>
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Proyectos <span class="caret"></span></a>
          <ul class="dropdown-menu">          	
          	<li><a href="<?php echo site_url('/posts/project_add')?>">(1) Crear proyecto</a></li>            
                <li><a href="<?php echo site_url('/posts/discussion_add')?>">(2) Crear Discusion</a></li>
                <li><a href="<?php echo site_url('/posts/task_add')?>">(3) Crear Tarea</a></li>            
                <li><a href="<?php echo site_url('/posts/comment_add')?>">(4) Crear Comentario</a></li>            
                <li role="separator" class="divider"></li>            
          </ul>
        </li>

        


      </ul>
      <ul>  
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Foros<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">(1) Proyectos</a></li>
            <li><a href="#">(2) Foros</a></li>            
          </ul>
        </li>
        
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>



