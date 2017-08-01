<?php
session_start();

if(isset($_POST['login'])){
	include 'login/class.login.php';
	include 'login/class.login.log.php';
	
	$login = new Login();
	
	if($login->isLoggedIn()){
		$record_login = new LoginLog($login->getEmail());
		header('Location: login/index.php');
		exit();
	}
	else{
		//$login->showErrors();
		$error_msg = "<div id='error-msg'>Invalid Email/Password Combination</div><br />";
	}	
}else{
}

$token = $_SESSION['token'] = md5(uniqid(mt_rand(),true));
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<title>LocateME | Find Out Your IP Address &amp; Geographic Location</title>
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
		<div id="form-container">
			<img id="logo" src="img/circle.png">
			<h2>LocateME</h2>
			<form action="" class="login-form" method="POST" >
				  <div class="mdl-textfield mdl-js-textfield">
					<input class="mdl-textfield__input" type="text" name="username" id="sample1">
					<label class="mdl-textfield__label" for="sample1">Enter your email</label>
				  </div>
				  <br />
				  <div class="mdl-textfield mdl-js-textfield">
					<input class="mdl-textfield__input" type="password" name="password" id="sample2">
					<label class="mdl-textfield__label" for="sample2">Password</label>
				  </div>
				  <br />
				  <?php
					if(isset($error_msg) && !empty($error_msg)){echo "$error_msg";}
				  ?>
				<input type="hidden" name="token" value="<?=$token;?>" />
				<input type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored submit-button" name="login" style="background: #673AB7" value="LOG IN">				 
			</form>
		</div>
	</body>
</html>