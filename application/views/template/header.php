<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
?>
<style>
#logo_container #logo{
	width: 130px;
	
	background-repeat: no-repeat;
	background-size: contain;
	border: 0px;
	padding: 10px;
}
#logo_container a{
	padding: 0px;
}
/* rewrite bootstrap */
.navbar-nav > li > a{
	padding-top: 27px !important;
	padding-bottom: 27px !important;
}


</style>


<!DOCTYPE html>
<html lang="en">
<head>
<script src = "<?php echo base_url("public/js/jquery-3.2.1.js");?>"></script>
<script src = "<?php echo base_url("public/js/bootstrap.js");?>"></script>
	<meta charset="utf-8">
	<title>Project Task Manager</title>
	<link rel="stylesheet" href="<?php echo base_url("public/css/bootstrap.css"); ?>">
	

	


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
        <li class="active">
        		<a href="<?php echo site_url('/inventories/kardex_search')?>">Home <span class="sr-only">(current)</span></a>
     	  </li>
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Proyectos <span class="caret"></span></a>
          <ul class="dropdown-menu">
          	<li><a href="#">Foros</a></li>
            <li><a href="#">Comentarios</a></li>
            <li><a href="#">Tareas</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Kardex <span class="caret"></span></a>
          <ul class="dropdown-menu">
          	<li><a href="#">Agregar kardex</a></li>
            <li><a href="#">Agregar Inventario</a></li>
            <li><a href="#">Nueva Categoria Inventario</a></li>            
            <li role="separator" class="divider"></li>
            <li><a href="#">Reporte de Estado kardex</a></li>
          </ul>
        </li>
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>



