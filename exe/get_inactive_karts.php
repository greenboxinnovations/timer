<?php

require '../query/conn.php';


$sql = "SELECT * FROM `id_map` WHERE `active` = 0;";
$exe = mysqli_query($conn, $sql);


$json = array();
while($row = mysqli_fetch_assoc($exe)){	
	$kart_no = $row['kart_no'];
	// $status = $row['status'];
	$active = $row['active'];


	$output = array();
	$output['kart_no'] = $kart_no;
	$output['active'] = $active;	
	array_push($json, $output);
}


echo json_encode($json, JSON_NUMERIC_CHECK);
?>