<?php
	
	// control.php
	// require 'fuelmaster/query/conn.php';

	// date_default_timezone_set("Asia/Kolkata");
	// $date = date('Y-m-d H:i:s');
	// $unix = strtotime($date);


	// $sql = "SELECT `last_updated` FROM `sync` WHERE `pump_id` = 99";
	// $exe = mysqli_query($conn, $sql);
	// $row = mysqli_fetch_assoc($exe);
	// $last_updated	 = $row["last_updated"];
	

	// $time_diff = $unix - $last_updated;


	// $output = array();
	// $output["success"] 		= true;
	// $output["last_updated"] = $last_updated;
	// $output["date"] 		= $date;
	// $output["unix"] 		= $unix;
	// $output["time_diff"] 	= $time_diff;

	// echo json_encode($output,JSON_NUMERIC_CHECK);


	$json 	= file_get_contents('php://input');
	$obj 	= json_decode($json,true);

	$output = array();

	require '../query/conn.php';
	date_default_timezone_set("Asia/Kolkata");
	$date = date('Y-m-d H:i:s');
	$unix = strtotime($date);

	$sql = "SELECT `status` FROM `id_map` WHERE `kart_no` = '".$obj["trigger"]."' ;";
	$exe = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($exe);

	if ($row['status'] == 1) {
		$sql1 = "UPDATE  `id_map` SET `status` = '-1' , `timestamp` = '".$date."' WHERE `kart_no` = '".$obj["trigger"]."' ;";
	}else{
		$sql1 = "UPDATE  `id_map` SET `status` = '1' , `timestamp` = '".$date."' WHERE `kart_no` = '".$obj["trigger"]."' ;";
	}
	$exe1 = mysqli_query($conn, $sql1);

	$output["success"] 		= true;
	$output["kart_no"] 		= $obj["trigger"];


	echo json_encode($output);
?>