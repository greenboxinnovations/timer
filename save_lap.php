<?php  

require 'query/conn.php';

if(isset($_GET['id'])){

	date_default_timezone_set("Asia/Kolkata");
	$date = date("Y-m-d");
	$timestamp = date("Y-m-d H:i:s"); 

	$kart_id = $_GET['id'];
	$time = $_GET['lap'];

	$time = round($time, 3);
	if($time == 0.000){
		$time = 0;
	}
 
	$sql  = "SELECT `kart_no` FROM `id_map` WHERE `kart_id` = '".$kart_id."'";
	$exe = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($exe);
	$kart_no = $row['kart_no'];
		
		
	$sql2 = "SELECT * FROM `operations` WHERE `kart_no` = '".$kart_no."'";
	$exe2 = mysqli_query($conn, $sql2);
	$count2 = mysqli_num_rows($exe2);

	if($count2 == 1){

		$sql  = "SELECT `timing` FROM `operations` WHERE `kart_no` = '".$kart_no."'";
		$exe = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($exe);
		$timing = $row['timing'];

		

		if ($timing == NULL) {
			$timing = $time;
		}else{
			$timing = $timing.'|'.$time;
		}

		$sql = "UPDATE `operations` SET `timing`= '$timing', `lap` = `lap` + 1 , `time` = '$timestamp' WHERE `kart_no` = '".$kart_no."'";
		$exe = mysqli_query($conn, $sql);

		echo 1;
		
	}else{
		echo -1;
	}
}
else{
	echo -1;
}	





?>