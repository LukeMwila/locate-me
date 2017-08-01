<?php
session_start();
include 'retrieve_ip.php';
include 'session-check.php';
include 'Record.class.php';
$record = new Record($email_address);
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
			<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
			  <header class="mdl-layout__header">
				<div class="mdl-layout__header-row">
				  <!-- Title -->
				  <span class="mdl-layout-title" id="title-locate-me"><a href="index.php"><img src="img/login-logo.png" />LocateME&nbsp;|&nbsp;<?php echo $email_address ?></a></span>
				  <!-- Add spacer, to align navigation to the right -->
				  <div class="mdl-layout-spacer"></div>
				</div>
			  </header>
			  <div class="mdl-layout__drawer">
				<span class="mdl-layout-title"><img src="img/circle.png" style="padding-top: 10px;" /></span>
				<nav class="mdl-navigation">
				  <a class="mdl-navigation__link" href="create-user.php">Create User</a>
				  <a class="mdl-navigation__link" href="sign-out.php">Sign Out</a>
				</nav>
			  </div>

			</div>
				<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp table1">
				  <thead>
					<tr>
					  <th class="mdl-data-table__cell--non-numeric">Current IP Address</th>
					  <th class="mdl-data-table__cell--non-numeric">Current Location</th>
					</tr>
				  </thead>
				  <tbody>
					<tr>
					  <td class="mdl-data-table__cell--non-numeric"><?php echo $ip; ?></td>
					  <td class="mdl-data-table__cell--non-numeric"><?php echo "$city, $region, $country"; ?></td>
					</tr>
				  </tbody>
				</table>
				
				<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp table2">
				  <thead>
					<tr>
					  <th class="mdl-data-table__cell--non-numeric">IP Address</th>
					  <th class="mdl-data-table__cell--non-numeric">Location</th>
					  <th class="mdl-data-table__cell--non-numeric">Time</th>
					</tr>
				  </thead>
				  <tbody>
					<?php $record->printList() ?>
				  </tbody>
				</table>
			
	</body>
</html>