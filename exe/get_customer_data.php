<?php
	
	$output = array();	
	$data['success'] = false;

	require '../query/conn.php';

	$phone_number = $_GET['phone_number'];

	$sql = "SELECT `firstname`, `lastname`, `email`, `age` FROM `customers` WHERE `no`='".$phone_number."';";

	$exe = mysqli_query($conn, $sql);

	$row = mysqli_num_rows($exe);

	if($row > 0){
		$data['success'] = true;
		$result = mysqli_fetch_assoc($exe);

		$data['firstname'] = $result['firstname'];
		$data['lastname'] = $result['lastname'];
		$data['age'] = $result['age'];
		$data['email'] = $result['email'];

	}
	array_push($output, $data);

	echo json_encode($output);
?>