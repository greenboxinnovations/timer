<?php


	// control.php
	// require 'fuelmaster/query/conn.php';
	require '../query/conn.php';

	date_default_timezone_set("Asia/Kolkata");
	$date = date('Y-m-d H:i:s');
	$unix = strtotime($date);


	if(isset($_GET["i"])){

		$kart_no = $_GET["i"];

		
		$sql = "SELECT `timestamp`, `active` FROM `id_map` WHERE `kart_no` = '".$kart_no."' ;";
		$exe = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($exe);
		$last_updated	 = strtotime($row["timestamp"]);

		$time_diff = $unix - $last_updated;

		// update ping here
		$sql = "UPDATE `ping_kart` SET `timestamp`= '".$date."' WHERE `kart_no` = '".$kart_no."' ;";
		$exe = mysqli_query($conn, $sql);
		// $row = mysqli_fetch_assoc($exe);

		if($time_diff > 10){
			if ($row['active'] == 0) {
				$return = -1;
			}else{
				$return = 1;
			}
		}
		else{
			$return = -1;
		}
		echo $return;
	}


	// OLD
	// $sql = "SELECT * FROM `sync` WHERE `table_name` = 'velocity' ;";
	// $exe = mysqli_query($conn, $sql);
	// $row = mysqli_fetch_assoc($exe);
	// $last_updated	 = strtotime($row["last_updated"]);

	// // echo $last_updated;


	// $time_diff = $unix - $last_updated;

	// if($time_diff > 10){
	// 	$return = 1;
	// }
	// else{
	// 	$return = -1;
	// }
	// echo $return;
?>