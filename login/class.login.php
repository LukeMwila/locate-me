<?php

class Login{
	private $_id;
	private $_username;
	private $_password;
	private $_passcrypt;
	
	private $_errors;
	private $_access;
	private $_login;
	private $_token;
	
	public function __construct(){
		$this->_errors = array();
		$this->_login = isset($_POST['login']) ? 1:0;
		$this->_access = 0;
		$this->_token = $_POST['token'];
		
		$this->_id = 0;
		$this->_username = ($this->_login) ? $this->filterInput($_POST['username']) : $_SESSION['username'];
		$this->_password = ($this->_login) ? $this->filterInput($_POST['password']) : '';
		$this->_passcrypt = ($this->_login) ? $this->encrypt_pass($this->_password) : $_SESSION['password'];
	}
	
	public function isLoggedIn(){
		($this->_login) ? $this->verifyPost() : $this->verifySession();	
		return $this->_access;
	}
	
	public function filterInput($input){
		$filtered_input = htmlentities(stripslashes($input));
		return $filtered_input;
	}
	
	public function encrypt_pass($password){
		$md5pass = md5($password);
		$sha1pass = sha1($md5pass);
		$cryptpass = crypt($sha1pass,'st');
		return $cryptpass;
	}
	
	public function verifyPost(){
		try{
			if(!$this->isTokenValid()){
				throw new Exception('Invalid Form Submission');
			} 
			
			/*if(!$this->isDataValid()){
				throw new Exception('Invalid Form Data');
			}
			*/
			if(!$this->verifyDatabase()){
				throw new Exception('Invalid Username/Password');
			}
			
			$this->_access = 1;
			$this->registerSession();
			
		}
		catch(Exception $e){
			$this->_errors[] = $e->getMessage();
		}
	}
	
	public function verifySession(){
		if($this->sessionExist() && $this->verifyDatabase()){
			$this->_access = 1;
		}
	}
	
	public function verifyDatabase(){	
		$username = $this->_username;
		$password = $this->_passcrypt;
		$link = new mysqli("", "", "", "") or die("Could not connect to server!" . mysqli_error());
		$sql = mysqli_query($link, "SELECT * FROM accounts_locate WHERE email='$username' AND password='$password'");
		
		if(mysqli_num_rows($sql)){
			list($this->_id) = @array_values(mysqli_fetch_assoc($sql));
			
			return true;
		}
		else{
			return false;
		}
	}
	
	public function getEmail(){
		return $this->_username;
	}
	
	public function isTokenValid(){
		return(!isset($_SESSION['token']) || $this->_token != $_SESSION['token']) ? 0 : 1;
	}
	
	public function registerSession(){
		$_SESSION['ID'] = $this->_id;
		$_SESSION['username'] = $this->_username;
		$_SESSION['password'] = $this->_passcrypt;
	}
	
	public function sessionExist(){
		return (isset($_SESSION['username']) && isset($_SESSION['password'])) ? 1 : 0;
	}
	
	public function showErrors(){
		echo "<h3>Errors</h3>";
		foreach($this->_errors as $key=>$value){
			echo $value . "<br />";
		}
	}
	
}


?>