<?php

if(!isset($_SESSION))
{
	session_start();
}

require '../../query/conn.php';

	date_default_timezone_set("Asia/Kolkata");
	$date = date("Y-m-d");
	$timestampcurrent = date("Y-m-d H:i:s"); 


	$output = array();
	$sql = "SELECT * FROM `timing` WHERE `date` = '".$date."' ORDER BY `best_lap` ASC LIMIT 10;";
	$exe = mysqli_query($conn, $sql);

	while($row = mysqli_fetch_assoc($exe)){
		$kart = array();
		$name = $row['name'];
		$best  = $row['best_lap'];
		$total = $row['best_total'];		
		$kart['name']    = strtoupper($name);
		$kart['best']    = $best;
		$kart['total']   = $total;

		array_push($output, $kart);
	}

	echo json_encode($output);

?>