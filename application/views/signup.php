<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Sign Up</title>
</head>
<body>

<div id="container">
	<h1>Sign Up</h1>

	<div id="body">		
		<?php 
		echo form_open_multipart($this->uri->uri_string());
		?>
			<input type="text" name="user_email" placeholder="Email"/><br/>			
			<input type="password" name="user_password" placeholder="Password"/><br/>			
			<input type="text" name="user_name" placeholder="User Name"/><br/>			
			<input type="text" name="user_profilename" placeholder="Profile Name"/><br/>			
			<input type="text" name="user_profilelastname" placeholder="Profile Lastname"/><br/>			
			<input type="submit" name="signup" value="Sign Up"/>
		<?php
		echo form_close();
		?>
	</div>
</div>
</body>
</html>