<?php

	require '../query/conn.php';

	date_default_timezone_set("Asia/Kolkata");
	$date = date('Y-m-d H:i:s');
	$unix = strtotime($date);


	$json 	= file_get_contents('php://input');
	$obj 	= json_decode($json,true);


	

	$kart_no = $obj["i"];
	$active = $obj["active"];

	
	$sql = "UPDATE `id_map` SET `active` = '".$active."' WHERE `kart_no` = '".$kart_no."' ;";
	$exe = mysqli_query($conn, $sql);

	$sql = "SELECT `kart_id` FROM `id_map` WHERE `kart_no` = '".$kart_no."';";
	$exe = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($exe);

	$kart_id = $row['kart_id'];

	if ($active == 1) {
		$sql = "INSERT INTO `operations` (`kart_id`,`kart_no`,`cust_id`,`ride_id`,`cur_lap`,`name`) VALUES ('".$kart_id."','".$kart_no."','0','1','0',' ') ;";
		$exe = mysqli_query($conn, $sql);
	}else{
		// $sql = "DELETE FROM `operations`  WHERE `kart_no` = '".$kart_no."';";
		// $exe = mysqli_query($conn, $sql);
	}

	
	$output = array();
	$output["success"] 		= true;
	$output["kart_no"] 		= $obj["i"];
	echo json_encode($output);
	

?>