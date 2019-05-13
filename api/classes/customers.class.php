<?php


	/**
	* 
	*/
class Customers 
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
			
		}
		else if($this->_method=='POST'){

			$action = $this->_postParams['action'];
			
			if($action=='insert')
			{				
				$this->insertNewCustomer($this->_postParams);
			}
			else if($action=='update')
			{
				$this->updateCustomer($this->_postParams);
			}

		}
	}

	// private function generateRand(){
		
	// 	$i = rand(1000, 9999);		
	// 	$this->_db->query("SELECT `ticket_code` FROM `tickets` WHERE `ticket_code` = :ticket_code");
	// 	$this->_db->bind(':ticket_code', $i); 
	// 	$this->_db->execute();

	// 	$count = $this->_db->rowCount();
	// 	if($count > 0){
	// 		$this->generateRand();
	// 	}
	// 	else{
	// 		return $i;
	// 	}		
	// }

	private function insertNewCustomer($postParams) {

		$firstname		= strtolower(trim($postParams['firstname']));
		$lastname		= strtolower(trim($postParams['lastname']));
		$phone_number	= trim($postParams['phone_number']);
		$email   		= strtolower(trim($postParams['email']));
		$age     		= trim($postParams['age']);
		$children 		= $postParams['child'];
		$adults	 		= $postParams['adults'];
		$cust_type		= 'p'; // parent

		//Looking for duplicates
		$this->_db->query("SELECT 1 FROM `customers` WHERE `no` = :no");
		$this->_db->bind(':no', $phone_number); // use bindParam to bind the variable		
		$this->_db->execute();

		if($this->_db->rowCount() == 0){

			date_default_timezone_set("Asia/Kolkata");
			$date = date("Y-m-d");

			$this->_db->query("SELECT MAX(`sr_no`) as sr_no FROM `customers` WHERE date(`date`) = '".$date."' ");
			$this->_db->execute();
			$r = $this->_db->single();		

			$sr_no = $r['sr_no'];

			if ($sr_no == NULL) {
				$sr_no = 1;
			}else{
				$sr_no = $sr_no +1;
			}
			
			//If no duplicates found insert the customer into the the customers table of DB
			$sql = "INSERT INTO `customers`(`firstname`,`lastname`,`no`,`email`,`age`,`cust_type`,`sr_no`)  
					VALUES(:field1,:field2,:field3,:field4,:field5,:field6,:field7);";

			$this->_db->query($sql);

			$this->_db->bind(':field1',$firstname);
			$this->_db->bind(':field2',$lastname);
			$this->_db->bind(':field3',$phone_number);
			$this->_db->bind(':field4',$email);
			$this->_db->bind(':field5',$age);
			$this->_db->bind(':field6',$cust_type);
			$this->_db->bind(':field7',$sr_no);
			$this->_db->execute();

			//Insert children into database
			if($children != NULL){
				

				foreach ($children as $child) {

					$sr_no++;

					$sql = "INSERT INTO `customers`(`firstname`,`lastname`,`no`,`email`,`age`,`cust_type`,`sr_no`)
							VALUES(:field1,:field2,:field3,:field4,:field5,:field6,:field7);";

					$this->_db->query($sql);

					$this->_db->bind(':field1', strtolower($child['firstname']));
					$this->_db->bind(':field2', strtolower($child['lastname']));
					$this->_db->bind(':field3', $phone_number);
					$this->_db->bind(':field4', $email);
					$this->_db->bind(':field5', $child['age']);
					$this->_db->bind(':field6', 'c');
					$this->_db->bind(':field7',$sr_no);				
					$this->_db->execute();
					
				}
			}

			if($adults != NULL){
				
				foreach ($adults as $adult) {

					$sr_no++;

					$sql = "INSERT INTO `customers`(`firstname`,`lastname`,`no`,`email`,`age`,`cust_type`,`sr_no`)
							VALUES(:field1,:field2,:field3,:field4,:field5,:field6,:field7);";

					$this->_db->query($sql);

					$this->_db->bind(':field1', strtolower($adult['firstname']));
					$this->_db->bind(':field2', strtolower($adult['lastname']));
					$this->_db->bind(':field3', $phone_number);
					$this->_db->bind(':field4', $email);
					$this->_db->bind(':field5', $adult['age']);
					$this->_db->bind(':field6', 'p');
					$this->_db->bind(':field7',$sr_no);				
					$this->_db->execute();
					
				}
			}
			
			
			$this->_db->query(	"SELECT `id` FROM `customers` 
								WHERE `firstname` = '".$firstname."'
								AND `lastname` = '".$lastname."'
								AND `no` = '".$phone_number."'
								AND `cust_type` = 'p'
								AND date(`date`) = '".$date."';");
			$this->_db->execute();
			$r = $this->_db->single();		

			$id = $r['id'];
			echo $id;
		}
		else{
			echo 'Duplicate Customer!';
		}


	}

	private function updateCustomer($postParams) {
        // $comp_id		= 1;
        $firstname		= strtolower(trim($postParams['firstname']));
        $lastname   	= strtolower(trim($postParams['lastname']));
		$phone_number	= trim($postParams['phone_number']);
		$id				= trim($postParams['id']);
		$email      	= strtolower(trim($postParams['email']));
		$age        	= trim($postParams['age']);  

		date_default_timezone_set("Asia/Kolkata");
		$date = date("Y-m-d");

		$this->_db->query("SELECT MAX(`sr_no`) as sr_no FROM `customers` WHERE date(`date`) = '".$date."' ");
		$this->_db->execute();
		$r = $this->_db->single();		

		$sr_no = $r['sr_no'];

		if ($sr_no == NULL) {
			$sr_no = 1;
		}else{
			$sr_no = $sr_no +1;
		}


		$sql = "UPDATE `customers` SET `firstname`=:field1,`lastname`=:field2,`no`=:field3,`email`=:field5,`age`=:field6,`count` = '0',`sr_no` = :field7 WHERE `id`=:field4";

		$this->_db->query($sql);


		$this->_db->bind(':field1', $firstname);	
		$this->_db->bind(':field2', $lastname);
		$this->_db->bind(':field3', $phone_number);
		$this->_db->bind(':field4', $id);		
		$this->_db->bind(':field5', $email);
		$this->_db->bind(':field6', $age);	
		$this->_db->bind(':field7', $sr_no);		
		$this->_db->execute();

		echo 'Customer Updated Succesfully';
	}

}		

	
?>