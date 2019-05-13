<?php
	/**
	* 
	*/
class Operations 
{
	private $_db;
	private $_method;	
	private $_getParams = null;
	private $_postParams = null;

	function __construct($db,$method,$getParams,$postParams) {
		$this->_db 			= $db->getInstance();
		$this->_method		= $method;
		$this->_getParams	= $getParams;
		$this->_postParams	= $postParams;

		$size = sizeof($this->_getParams);
	

		if($this->_method=='GET'){

			$this->_kartID = $this->_getParams[0];
			$this->getLap($this->_kartID);			
		}
		else if($this->_method=='POST'){
			
			$action = $this->_postParams['action'];

			if($action=='check')
			{				
				$this->check($this->_postParams);
			}
			else if($action=='namelist')
			{				
				$this->nameList($this->_postParams);
			}
			else if($action=='ridelist')
			{
				$this->rideList($this->_postParams);
			}
			else if($action=='start')
			{
				$this->startOperations($this->_postParams);
			}
			else if($action=='finish')
			{
				$this->finishOperations($this->_postParams);
			}
			else if($action=='dat')
			{
				$this->dataOperations($this->_postParams);
			}
		
		}
	}

	private function getLap($kart_id){

		$this->_db->query("SELECT `lap` FROM `operations` WHERE `kart_no` IN (SELECT `kart_no` FROM `id_map` WHERE `kart_id` = '$kart_id') ;");
		$this->_db->execute();
		$r = $this->_db->single();		
		$lap = $r['lap'];
		if (($lap == "")||($lap == NULL)) {
			$lap = 0;
		}
		echo $lap;
	}

	private function check($postParams) {

		date_default_timezone_set("Asia/Kolkata");
		$date = date("Y-m-d");

		$output    = array();

		$qr = trim($postParams['code']);
		$my_ride_id = trim($postParams['my_ride_id']);

		$code = substr($qr, 0, 4);
		$cust_sr_no = substr($qr, 4); 

		$this->_db->query("SELECT `ride_id` FROM `operations` WHERE `cust_id` = '".$cust_sr_no."' 
					AND date(`time`) = '".$date."' AND `cur_lap` = '0' AND `ticket_code` = '".$code."' AND `name` IS NULL;");
		
		$this->_db->execute();
		$r = $this->_db->single();		

		if ($r['ride_id'] != $my_ride_id) {
			$output["success"]  = false;
		}else{
			$output["success"]  = true;
		}

		echo json_encode($output, JSON_NUMERIC_CHECK);
	}

	private function dataOperations($postParams) {

		$ride_num = $postParams['ride_num'];
		$ride_id = $postParams['ride_id'];
		$date = $postParams['date1'];

		// echo $date;

		for ($i=0; $i < $ride_num ; $i++) { 
			$sql = "DELETE FROM `master` WHERE `date` = '".$date."'AND `ride_id` = '".$ride_id."' LIMIT 1;";

			$this->_db->query($sql);
			
			$this->_db->execute();	
		}

		
		echo 'success';
	}

	private function nameList($postParams) {

		date_default_timezone_set("Asia/Kolkata");
		$date = date("Y-m-d");

		$output    = array();

		$qr = trim($postParams['code']);

		$code = substr($qr, 0, 4);
		$cust_sr_no = substr($qr, 4); 

		$this->_db->query("SELECT `ticket_code` FROM `operations` WHERE `cust_id` = '$cust_sr_no' 
					AND date(`time`) = '$date' AND `cur_lap` = '0';");
		
		$this->_db->execute();
		$r = $this->_db->single();		

		$ticket_code = $r['ticket_code'];
		if (!$ticket_code == $code) {
			$output["success"]  = false;

		}else{

			if ($cust_sr_no != 0) {
				$this->_db->query("SELECT * FROM `customers` WHERE `no` IN (SELECT `no` FROM `customers` WHERE `sr_no` = '".$cust_sr_no."' AND date(`date`) = CURDATE())");
				$this->_db->execute();
				$r = $this->_db->resultset();
				

				foreach ($r as $row) {
					$json = array();
					$json['name'] 	   = $row['firstname'].' '.$row['lastname'];
					$json['sr_no'] 	   = $row['sr_no'];
					array_push($output, $json);
				}
			}else{
				$json = array();
				$json['name'] 	   = 'guest';
				$json['sr_no'] 	   = 1;
				array_push($output, $json);
			}

			
			$output["success"]  = true;
		}

		echo json_encode($output, JSON_NUMERIC_CHECK);
	}

	private function rideList($postParams) {

		date_default_timezone_set("Asia/Kolkata");
		$date = date("Y-m-d");

		$output    = array();


		$this->_db->query("SELECT * FROM `rides` WHERE 1 ");
		$this->_db->execute();
		$r = $this->_db->resultset();
		

		foreach ($r as $row) {
			$json = array();
			$json['name'] 	   = ucwords($row['name']);
			$json['sr_no'] 	   = $row['id'];
			array_push($output, $json);
		}
		$output["success"]  = true;
		

		echo json_encode($output, JSON_NUMERIC_CHECK);
	}

	private function startOperations($postParams) {

		date_default_timezone_set("Asia/Kolkata");
		$date = date("Y-m-d");
        
        $kart_no  = trim($postParams['kart_no']);
        $sr_no    = trim($postParams['sr_no']);
        $name     = trim($postParams['name']);
        $qr     = trim($postParams['code']);

        $code = substr($qr, 0, 4);

        $output    = array();


		$this->_db->query("SELECT `kart_id` FROM `id_map` WHERE `kart_no` = '$kart_no'");	
		$this->_db->execute();
		$r = $this->_db->single();		
		$kart_id = $r['kart_id'];
		

		$this->_db->query("SELECT * FROM `operations` WHERE `ticket_code` = '".$code."'");
	//	$this->_db->bind(':no', $kart_no); // use bindParam to bind the variable		
		$this->_db->execute();
		if($this->_db->rowCount() == 1){

			$this->_db->query("SELECT `id` FROM `customers` WHERE `sr_no` = '".$sr_no."' AND date(`date`) = '".$date."' ;");		
			$this->_db->execute();
			$r = $this->_db->single();		

			$cust_id = $r['id'];

			$sql="UPDATE `operations` SET `cust_id`= '".$cust_id."', `name` = '".$name."', `kart_no` = '".$kart_no."', `kart_id` = '".$kart_id."' WHERE `ticket_code`= '".$code."';";
			$this->_db->query($sql);
			$this->_db->execute();

			$output['success'] = true;
			
		}else{
			$output['success'] = false;
		}

		echo json_encode($output, JSON_NUMERIC_CHECK);
	}

	private function finishOperations($postParams){

		$op_id = trim($postParams['id']);

		date_default_timezone_set("Asia/Kolkata");
		$date = date("Y-m-d");

		$this->_db->query("SELECT * FROM `operations` WHERE `op_id` = '$op_id'");
		$this->_db->execute();

		$r = $this->_db->single();

		$kart_no 	= $r['kart_no'];
		$cust_id	= $r['cust_id'];
		$name		= $r['name'];
		$lap		= $r['cur_lap'];
		$timing 	= $r['timing'];
		
		$sql = "INSERT INTO `master`(`kart_no`, `cust_id`, `name`, `lap` , `timing` , `date`)  
					VALUES('$kart_no','$cust_id','$name','$lap' , '$timing' , '$date');";

		$this->_db->query($sql);
		$this->_db->execute();

		$this->_db->query("DELETE FROM `operations` WHERE `op_id` = '$op_id'");
		$this->_db->execute();
		echo 'Success';
	}

}		

	
?>