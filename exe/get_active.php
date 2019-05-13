<?php

	require '../query/conn.php';

	date_default_timezone_set("Asia/Kolkata");
	$date = date('Y-m-d H:i:s');
	$unix = strtotime($date);


	if(isset($_GET["i"])){

		$kart_no = $_GET["i"];

		
		$sql = "SELECT `active` FROM `id_map` WHERE `kart_no` = '".$kart_no."' ;";
		$exe = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($exe);


		$sql2 = "UPDATE `ping_kart` SET `timestamp`= '".$date."' WHERE `kart_no` = '".$kart_no."' ;";
		$exe2 = mysqli_query($conn, $sql2);		


		
		echo $row['active'];
	}

?>