<?php

	require '../query/conn.php';
	date_default_timezone_set("Asia/Kolkata");

	$check 	= exec("ping -c 1 192.168.0.125");

	$return = array();

	// default return
	$return["status"] = 0;
	$return["camera"] = 0;

	if ($check != '' ){
		// $sql = "UPDATE `users` SET `camera` = 1 WHERE `name` = 'admin';";
		$sql = "UPDATE `users` SET `camera` = 1, `p_status` = 1 WHERE `name` = 'admin';";
		$return["camera"] = 1;		
		$return["status"] = 1;
	}
	else{
		$sql = "UPDATE `users` SET `camera` = 0 , `p_status` = 0 WHERE `name` = 'admin';";
		// session_destroy();
	}
	$exe = mysqli_query($conn, $sql);
	

	$sql ="SELECT `p_status` FROM `users` WHERE  `name` = 'admin';";	
	$info = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($info);

	$return["status"] = $row['p_status'];

	echo json_encode($return, JSON_NUMERIC_CHECK);
?>

