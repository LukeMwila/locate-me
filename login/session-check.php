<?php

if (!empty($_SESSION['username']) && isset($_SESSION['username']) && !empty($_SESSION['password']) && isset($_SESSION['password']))
{
	$email_address = $_SESSION['username'];
}
else
{
session_unset(); 

session_destroy(); 
	header('Location: ../index.php');
	exit();
}

?>