<?php

class LoginLog{	
	private $_ip;
	private $_email;
	private $_country;
	private $_region;
	private $_city;
	private $_location;
	private $_time_zone;
	private $_login_time;
	
	private $data;
	private $json;
	

	public function __construct($email){
			$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		   $ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		
		$this->_ip = $ipaddress;
		$this->json = file_get_contents("http://ipinfo.io/$ipaddress");
		$this->data = json_decode($this->json);
		$data = $this->data;
		$this->_region = $data->region;
		$this->_city = $data->city;
		$country = $data->country;
		
		$json2 = file_get_contents("http://freegeoip.net/json/$ipaddress"); 
		$data2 = json_decode($json2);
		$this->_time_zone = $data2->time_zone;
		$this->_country = $data2->country_name;
		$this->_location = "$this->_city, " . "$this->_region, " . "$country";
		$this->setEmail($email);
		$this->recordTime();
		$this->saveLogin();
	}
	
	private function recordTime(){
		date_default_timezone_set($this->_time_zone);
		$this->_login_time = date('h:i:s a', time());
	}
	
	public function setEmail($email){
		$this->_email = $email;
	}
	
	private function saveLogin(){
		$link = new mysqli("dedi849.jnb1.host-h.net", "dragoeyeee_15", "ySnj44VaSL8", "dragoeyeee_15") or die("Could not connect to server!" . mysqli_error());		
		$sql = mysqli_query($link, "INSERT INTO login_log VALUES('', '$this->_email', '$this->_ip', '$this->_country', '$this->_region', '$this->_city', '$this->_location', '$this->_login_time') ");
	}


}
