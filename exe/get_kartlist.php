<?php

require '../query/conn.php';

date_default_timezone_set("Asia/Kolkata");
$date = date('Y-m-d H:i:s');
$unix = strtotime($date);



$sql = "SELECT * FROM `id_map` WHERE 1;";
$exe = mysqli_query($conn, $sql);

// 30 sec
// $time_check = 60 * 1.5;
$time_check = 20;



$json = array();
while($row = mysqli_fetch_assoc($exe)){

	$output = array();

	$kart_no = $row['kart_no'];	
	$active = $row['active'];

	$sql2 = "SELECT `timestamp` FROM `ping_kart` WHERE `kart_no` = '".$kart_no."';";
	$exe2 = mysqli_query($conn, $sql2);
	$row2 = mysqli_fetch_assoc($exe2);
	$ping_time = strtotime($row2['timestamp']);

	// get engine status
	$sql3 = "SELECT `timestamp`, `active` FROM `id_map` WHERE `kart_no` = '".$kart_no."' ;";
	$exe3 = mysqli_query($conn, $sql3);
	$row3 = mysqli_fetch_assoc($exe3);
	$last_updated	 = strtotime($row3["timestamp"]);
	$time_diff_s = $unix - $last_updated;
	$return = false;
	if($time_diff_s < 10){
		if ($row3['active'] != 0) {			
			$return = true;
		}
	}	
	$output['makeGreen'] = $return;
	

	$time_diff = $unix - $ping_time;	

	// update ping here
	if($time_diff > $time_check){
		$output['batt_active'] = false;
	}
	else{
		$output['batt_active'] = true;
	}


	
	$output['kart_no'] = $kart_no;
	$output['active'] = $active;
	array_push($json, $output);
}


echo json_encode($json, JSON_NUMERIC_CHECK);
?>