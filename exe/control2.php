<?php


	// control.php
	// require 'fuelmaster/query/conn.php';
	// require '../query/conn.php';

	// date_default_timezone_set("Asia/Kolkata");
	// $date = date('Y-m-d H:i:s');
	// $unix = strtotime($date);


	// $sql = "SELECT * FROM `sync` WHERE `table_name` = 'velocity' ;";
	// $exe = mysqli_query($conn, $sql);
	// $row = mysqli_fetch_assoc($exe);
 //    $pump_id	 = $row["pump_id"];

 //    echo $pump_id;
	

	// $time_diff = $unix - $last_updated;

	// if($time_diff > 1){
	// 	$return = 1;
	// }
	// else{
	// 	$return = -1;
	// }
	// echo $return;


	// OLD CODE
	$array = [-1,1,-1,-1,1];
	$index = rand(0,4);
	echo $array[$index];
?>