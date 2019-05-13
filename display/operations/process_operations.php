<?php

require '../../query/conn.php';
date_default_timezone_set("Asia/Kolkata");
$date = date("Y-m-d");


function aasort (&$array, $key) {
    $sorter=array();
    $ret=array();
    reset($array);
    foreach ($array as $ii => $va) {
        $sorter[$ii]=$va[$key];
    }
    asort($sorter);
    foreach ($sorter as $ii => $va) {
        $ret[$ii]=$array[$ii];
    }
    $array=$ret;
}

	
$sql1 = "SELECT * FROM `operations` WHERE date(`time`) = '".$date."' AND `ride_id` IN (1,2);";
$exe1 = mysqli_query($conn,$sql1);

if (mysqli_num_rows($exe1) > 0) {
	while ($row1 = mysqli_fetch_assoc($exe1)) {

		$time = explode("|", $row1['timing']);
		$t = 0;
		$b = 0;

		for ($i=1; $i < sizeof($time); $i++) { 

			$t += $time[$i];

			if ($b == 0) {
				$b = $time[$i];
			}else if ($b > $time[$i]) {
				$b = $time[$i];
			}	

		}

		$sql2 = "UPDATE `operations` SET `total` = '".$t."', `best_lap` = '".$b."' WHERE `op_id` = '".$row1['op_id']."';";
		$exe2 = mysqli_query($conn,$sql2);


		// if ($row1['cur_lap'] > 3) {

		// 	$sql3 = "INSERT INTO `timing`(`cust_id`,`name`,`best_lap`,`best_total`,`date`) VALUES('".$row1['cust_id']."','".$row1['name']."','".$row1['best_lap']."','".$row1['total']."','".$date."');";
		// 	$exe3 = $exe1 = mysqli_query($conn,$sql3);


		// 	$sql4 = "SELECT `best_lap`,`best_total` FROM `customers` WHERE `id` = '".$row1['cust_id']."';";
		// 	$exe4 = mysqli_query($conn,$sql4);

		// 	while ( $row4 = mysqli_fetch_assoc($exe4) ) {

		// 		if ($row4['best_lap'] == 0 ) {
		// 			$best_lap = $b;
		// 		}else if($row4['best_lap'] > $b){
		// 			$best_lap = $b;
		// 		}else{
		// 			$best_lap = $row4['best_lap'];
		// 		}


		// 		if ($row4['best_total'] == 0 ) {
		// 			$best_total = $t;
		// 		}else if($row4['best_total'] > $t){
		// 			$best_total = $t;
		// 		}else{
		// 			$best_total = $row4['best_total'];
		// 		}

		// 		$sql5 = "UPDATE `customers` SET `best_total` = '".$best_total."', `best_lap` = '".$best_lap."' WHERE `id` = '".$row1['cust_id']."';";
		// 		$exe5 = mysqli_query($conn,$sql5);

		// 	}

		// 	$best_array = array();

		// 	$new_rank = array();

		// 	$new_rank['cust_id'] = $row1['cust_id'];
		// 	$new_rank['name'] = $row1['name'];
		// 	$new_rank['best_lap'] = $b;
		// 	$new_rank['best_total'] = $t;
		// 	$new_rank['date'] = $date;


		// 	array_push($best_array, $new_rank);

		// 	$sql7 = "SELECT * FROM `all_time_best` WHERE 1;";
		// 	$exe7 = mysqli_query($conn,$sql7);
		// 	while ( $row7 = mysqli_fetch_assoc($exe7) ) {
		// 		array_push($best_array, $row7);
		// 	}	

		// 	aasort($best_array,"best_lap");

		// 	$sql8 = "TRUNCATE `all_time_best`;";
		// 	$exe8 = mysqli_query($conn,$sql8);

		// 	for ($i=0; $i < (sizeof($best_array)-1) ; $i++) { 
		// 		$sql9 = "INSERT INTO `all_time_best`(`cust_id`, `name`, `best_lap`, `best_total`, `date`) VALUES ('".$best_array[$i]['cust_id']."','".$best_array[$i]['name']."','".$best_array[$i]['best_lap']."','".$best_array[$i]['best_total']."','".$best_array[$i]['date']."');";
		// 		$exe9 = mysqli_query($conn,$sql9);
		// 	}

		// 	// $sql6 = "DELETE FROM `operations` WHERE `op_id` = '".$row1['op_id']."' ";
		// 	// $exe6 = mysqli_query($conn,$sql6);
		// }		
	}	

}

?> 