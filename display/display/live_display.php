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
$sql = "SELECT * FROM `operations` WHERE `name` IS NOT NULL;";
$exe = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($exe)){

	$kart 				= array();
	$name 				= $row['name'];
	$lap  				= $row['cur_lap'];
	$kart_no 			= $row['kart_no'];
	$timing 			= $row['timing'];
	$times 				= explode('|', $timing);
	$best  				= 0;
	$total 				= 0;

	$timestampold 		= $row['time'];
	$latest 			= false;

	$kart['lap']		= $lap;

	if (strtotime($timestampcurrent) - strtotime($timestampold) < 2) {
		$latest = true;
	}

	for ($i=0; $i<sizeof($times) ; $i++) { 
		if($i == 0){

		}else if($i == 1){
			$best  = $times[$i];
			$total = $times[$i];
		}else{
			if ($best >  $times[$i]  ) {
				$best  = $times[$i];
			}
			$total = $total+$times[$i];
		}

		if ($latest) {
			if ($lap != 0) {
				$kart['latest'] = $times[sizeof($times)-1];
			}
		}
	}
	// was ==1
	if ($lap == 0) {
		$kart['lap']     = "Start";
	}else{
		// $kart['lap']     = $lap-1;
		$kart['lap']     = $lap;
	}		

	$kart['show']	 = $latest;
	$kart['name']    = strtoupper($name);
	$kart['best']    = $best;
	$kart['total']   = $total;
	$kart['kart_no'] = $kart_no;
	array_push($output, $kart);
}

echo json_encode($output);

?>