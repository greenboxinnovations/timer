<?php
date_default_timezone_set("Asia/Kolkata");

require 'query/conn.php';

$date = date("Y-m-d");
$time = date("Y-m-d H:i:s");



$sql1 = "SELECT * FROM `operations` WHERE date(`time`) = '".$date."';";
$exe1 = mysqli_query($conn,$sql1);

	if (mysqli_num_rows($exe1) > 0) {
		while ( $row1 = mysqli_fetch_assoc($exe1) ) {
	
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

			$sql2 = "UPDATE `operations` SET `best_lap` = '$t' WHERE `op_id` = '".$row1['op_id']."';";
			$exe2 = mysqli_query($conn,$sql2);

			$best_array = array();

			$new_rank = array();

			$new_rank['cust_id'] = $row1['cust_id'];
			$new_rank['name'] = $row1['name'];
			$new_rank['best_lap'] = $b;
			$new_rank['best_total'] = $t;
			$new_rank['date'] = $date;


			array_push($best_array, $new_rank);



			$sql2 = "SELECT * FROM `all_time_best` WHERE 1 ORDER BY `name`;";
			$exe2 = mysqli_query($conn,$sql2);
			while ( $row2 = mysqli_fetch_assoc($exe2) ) {
				array_push($best_array, $row2);
			}

			
			




	

			aasort($best_array,"best_lap");

			// echo "<pre>";
			// print_r($best_array);
			// echo "</pre>";

			echo $best_array[0]['name'];



		}	
	}

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

		
// require 'phpqrcode/qrlib.php';


// $i = 100;
// $j = 0.12;
// echo $k = $i + ($i*$j);

//echo QRcode::png('http://google.com','a.png','L', 4, 2); // creates code image and outputs it directly into browser
//    QRcode::png('q :)','a.png');

// for ($i=1; $i < 51 ; $i++) { 

// 	$sql = "INSERT INTO `customers` (`firstname`,`lastname`,`no`,`email`,`age`,`cust_type`) VALUES('akshay','bhilare','9762230207','fvdkjbk@jkbn.in','26','p');";
			
// 	$exe = mysqli_query($conn,$sql);
// }

	// $target_url = "http://192.168.0.100/timer/api/operations/1";
	// echo $result = file_get_contents($target_url);
	
	// $check 	= exec("ping -c 1 192.168.0.129");
	// //$check 	= explode('=', $check);
	// //$result = trim($check[0]);
	// // print_r($check[0]);
	// if ( $check != '' ) {
	// 	echo 'ip connected';
	// }else{
	// 	echo 'ip not connected';
	// }

 //    $result =  shell_exec("udevadm info -a /dev/usb/lp0");
 //    $array = explode("==", $result);
	// $res = explode(" ",$array[43]);
	// $i = str_replace('"', "", $res[0]);
	// echo $i = trim($i);
	// echo $j = "55454a460683390000";


	// if ($i == $j) {
	// 	echo "string";
	// }else{
	// 	echo "asa";
	// }
	
	
	/////  BARCODE  //////
	// require 'vendor/autoload.php';
	// $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
	// $no = 122355;
	// echo '<img height="35" width="250" src="data:image/png;base64,' . base64_encode($generator->getBarcode($no, $generator::TYPE_CODE_128)).'">';
	// echo '<br>';
	// echo $no;
?>

