<?php
session_start();
include 'session-check.php';

if(isset($_POST['submit'])){
	include 'User.class.php';	
	$user = new User();
	$error_msg = $user->getError();
	if(isset($error_msg) && !empty($error_msg)){
		
	}else{
		print("
		<script type='text/javascript'>
		var answer = confirm('User Successfully Created...')
			window.location='index.php'
		</script>");
		}
	
}else{
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<title>Where Am I&nbsp;? | Find Out Your IP Address &amp; Geographic Location</title>
		<link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.6/material.indigo-pink.min.css">
		<script src="https://storage.googleapis.com/code.getmdl.io/1.0.6/material.min.js"></script>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link href='https://fonts.googleapis.com/css?family=Oxygen:300' rel='stylesheet' type='text/css'>
		<link href="css/style.css" rel="stylesheet">
		<!--[if IE]><link rel="shortcut icon" href="img/location-icon.png"><![endif]-->
		<!-- Touch Icons - iOS and Android 2.1+ 180x180 pixels in size. --> 
		<link rel="apple-touch-icon-precomposed-itech-icon" href="img/apple-touch-icon-location-icon.png">
		<link rel="icon" type="image/png" href="img/location-icon.png">
	</head>
	<body>
		<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
			  <header class="mdl-layout__header">
				<div class="mdl-layout__header-row">
				  <!-- Title -->
				  <span class="mdl-layout-title"><a href="index.php"><img src="img/login-logo.png" /></a></span>
				  <!-- Add spacer, to align navigation to the right -->
				  <div class="mdl-layout-spacer"></div>
				</div>
			  </header>
			  <div class="mdl-layout__drawer">
				<span class="mdl-layout-title"><?php echo $email_address ?></span>
				<nav class="mdl-navigation">
				  <a class="mdl-navigation__link" href="create-user.php">Create User</a>
				  <a class="mdl-navigation__link" href="sign-out.php">Sign Out</a>
				</nav>
			  </div>

		</div>	
			<div id="form-container">
			<img id="logo" src="img/circle.png">
			<h2>Add A New User!</h2>
			<form action="" class="login-form" method="POST" >
				  <div class="mdl-textfield mdl-js-textfield">
					<input class="mdl-textfield__input" type="text" name="email" id="sample1">
					<label class="mdl-textfield__label" for="sample1">Enter your email</label>
				  </div>
				  <br />
				  <br />
				  <?php
					if(isset($error_msg) && !empty($error_msg)){echo "<div id='error-msg'>$error_msg</div>";}
				  ?>
				<input type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored submit-button" name="submit" style="background: #673AB7" value="CREATE USER">				 
			</form>
		</div>	
		
			
	</body>
</html>