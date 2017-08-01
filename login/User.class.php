<?php

class User{
	private $_email;
	private $password;
	private $passcrypt;
	private $error_msg;
	private $submit;
	
	public function __construct(){
		$this->submit = isset($_POST['submit']) ? 1:0;
		$this->_email = ($this->submit) ? $this->filterEmail($_POST['email']) : '';
		($this->validateEmail($this->_email)) ? $this->createAccount() : $this->setEmailError($this->error_msg);	
	}
	
	public function filterEmail($email){
		$email_address = htmlentities(stripslashes(($email)));
		return $email_address;
	}
	
	public function validateEmail(){
		if (!filter_var($this->_email, FILTER_VALIDATE_EMAIL)) {
		  return false;
		}
		else{
			if($this->checkValidEmail()){
				return true;
			}else{
				return false;
			}			 
		}		
	}
	
	private function dbconnect(){
		$link = new mysqli("", "", "", "") or die("Could not connect to server!" . mysqli_error());
		return $link;
	}
	
	private function checkValidEmail(){
		
		$link = $this->dbconnect();
		$query = mysqli_query($link,"SELECT * FROM accounts_locate");
		$email_array = array();
		
		while($rows = mysqli_fetch_array($query)):
			$email = $rows['email'];
			$email_array[] = $email;
		endwhile;
		
		$em = $this->_email;
		
		if(in_array($em, $email_array))
		{
		   $this->error_msg = "Email is already in use";
		   return false;
		}
		else{
			return true;
		}
	}
	
	private function createPassword(){
		$my_array = array("!","@","$","%");
		shuffle($my_array);
		$password = str_shuffle("location") . mt_rand(100,900) . $my_array[1];
		$this->password = $password;
		
		$md5pass = md5($password);
		$sha1pass = sha1($md5pass);
		$cryptpass = crypt($sha1pass,'st');
		$this->passcrypt = $cryptpass;
		
		return $cryptpass;
	}
	
	private function createAccount(){
		$link = $this->dbconnect();
		$encrypted_password = $this->createPassword();		
		$sql = mysqli_query($link, "INSERT INTO accounts_locate VALUES('', '$this->_email', '$encrypted_password') ");
		$this->sendMail();
		
	}
	
	private function sendMail(){
		$to = "$this->_email";
		$from = "webmaster@locateme.co.za"; 
		$subject = "LocateME Account Created";
		$content = "Welcome to LocateME,\n\nWe hope that you will find our app useful to find out your IP address and geographic location. \n\nYour login details are: \nEmail: $this->_email\nPassword: $this->password"; 
		$body = "$content\n\nKind Regards,\n\nLocateME";
		$from_new = "From: $from";

		mail($to,$subject,$body,$from_new);
	}
	
	private function setEmailError($error_msg){
		if(isset($error_msg) && !empty($error_msg)){
			
		}
		else{
			$this->error_msg = "Invalid email address";
		}
	}
	
	public function getError(){
		return $this->error_msg;
	}


}