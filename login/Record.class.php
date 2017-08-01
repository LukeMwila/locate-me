<?php

class Record{
	
	private $ip_list;
	private $location_list;
	private $time_list;
	private $_email;
	
	public function __construct($email){
		$this->_email = $email;
		$this->getIPList();
		$this->getLocationList();
		$this->getTimeList();
		
	}
	
	private function dbconnect(){
		$link = new mysqli("", "", "", "") or die("Could not connect to server!" . mysqli_error());
		return $link;
	}
	
	public function getIPList(){
		$link = $this->dbconnect();
		$query = mysqli_query($link,"SELECT * FROM login_log WHERE email='$this->_email'");
		$ip_array = array();

		while($rows = mysqli_fetch_array($query)):
			$ip_address = $rows['ip_address'];
			$ip_array[] = $ip_address;
		endwhile;
		
		$this->ip_list = $ip_array;
	}
	
	public function getLocationList(){
		$link = $this->dbconnect();
		$query = mysqli_query($link,"SELECT * FROM login_log WHERE email='$this->_email'");
		$location_array = array();

		while($rows = mysqli_fetch_array($query)):
			$location = $rows['location'];
			$location_array[] = $location;
		endwhile;
		
		$this->location_list = $location_array;
	}

	public function getTimeList(){
		$link = $this->dbconnect();
		$query = mysqli_query($link,"SELECT * FROM login_log WHERE email='$this->_email'");
		$time_array = array();

		while($rows = mysqli_fetch_array($query)):
			$time = $rows['time'];
			$time_array[] = $time;
		endwhile;
		
		$this->time_list = $time_array;
	}
	
	public function printList(){
		$ip_array = $this->ip_list;
		$location_array = $this->location_list;
		$time_array = $this->time_list;
		
		for($x = 0; $x < sizeof($this->ip_list); $x++){
			echo "
				<tr>
					  <td class='mdl-data-table__cell--non-numeric'>$ip_array[$x]</td>
					  <td class='mdl-data-table__cell--non-numeric'>$location_array[$x]</td>
					  <td class='mdl-data-table__cell--non-numeric'>$time_array[$x]</td>
				</tr>
			";
		}			
	}
	


}