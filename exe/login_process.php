<?php

require '../query/conn.php';

if(!isset($_SESSION))
{
	session_start();
}


$result =  shell_exec("udevadm info -a /dev/usb/lp0");

if ($result != null) {
	$array = explode("==", $result);
	$res = explode(" ",$array[43]);
	$i = str_replace('"', "", $res[0]);
	$i = trim($i);
	$j = "55454a460683390000";

	if ($i == $j) {
		$_SESSION['t1'] ='0';
	}else{
		$_SESSION['t1'] ='1';
	}
}else{
	$result1 =  shell_exec("udevadm info -a /dev/usb/lp1");
	if ($result1 != null) {
		$array1 = explode("==", $result1);
		$res = explode(" ",$array1[43]);
		$i = str_replace('"', "", $res[0]);
		$i = trim($i);
		$j = "55454a460683390000";

		if ($i == $j) {
			$_SESSION['t1'] ='1';
		}else{
			$_SESSION['t1'] ='0';
		}
	}
}



//request method
$method = $_SERVER['REQUEST_METHOD'];

//response array
$json = array();

if($method == 'POST'){
	//get inputs
	$postParams = json_decode(file_get_contents("php://input"),true);							
	//user
	$user = $postParams["name"];
	//password
	$password = $postParams["password"];

	//get employees salt	

	// echo '<b>bcrypt with complex salt: </b>'.$complex_hash = password_hash($complex_salt.$enc, PASSWORD_DEFAULT, ['cost' => 12]);

	if (($user != '')||($password != '')) {
			$stmt = mysqli_prepare($conn, "SELECT user_id, pass FROM users WHERE name=? LIMIT 1");

			if ($stmt === false) {
				$json['success'] = false;
				$json['message'] = "Authentication Error";

			} else {

				$bind = mysqli_stmt_bind_param($stmt, "s", $user);

				if ($bind === false) {
					$json['success'] = false;
					$json['message'] = "Authentication Error";
				} else {

					mysqli_stmt_execute($stmt);
					mysqli_stmt_store_result($stmt);
					$rows = mysqli_stmt_num_rows($stmt);
					mysqli_stmt_bind_result($stmt,$user_id,$hash);
								
					mysqli_stmt_fetch($stmt);		

 
					if($rows>0 && $hash == '12345'){
						$json['success'] = false;
						$json['message'] = "reset";
					} else {							

						if (password_verify($password, $hash)) {
							$json['success'] = true;
							$json['message'] = "Authentication Success";

							$token = substr(strtr(base64_encode(openssl_random_pseudo_bytes(22)), '+', '.'), 0, 22);

							$json['token'] = $token;
							$_SESSION['token'] = $token;
							$_SESSION['user_id'] = $user_id;
							
							//create token table
						} else {
							$json['success'] = false;
							$json['message'] = "Authentication Error";
						}			
					}
				}
			}

			//close stmt
		    mysqli_stmt_close($stmt);
	}else{
		//get isnt allowed here
		$json['success'] = false;
		$json['message'] = "Authentication Error/no inputs specified";

	}
	
} else {

	//get isnt allowed here
	$json['success'] = false;
	$json['message'] = "Authentication Error";	

}

//send response
echo json_encode($json);

//close conn
mysqli_close($conn);


?>