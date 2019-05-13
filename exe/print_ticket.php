<?php
	date_default_timezone_set("Asia/Kolkata");
	if(!isset($_SESSION)) { session_start(); }
	$date 		 = date("Y-m-d");
	$date1		 = date('d-m-y h:i:s A');

	require '../query/conn.php';
	require '../phpqrcode/qrlib.php';
	require_once("../print/Escpos.php");


	$t1 =$_SESSION['t1'];
	if ($t1 == 0) {
		$t2 =1;
	}else{
		$t2 =0;
	}

	$user = $_SESSION['user_id'];

	if ($user == 2) {
		$path = "/dev/usb/lp".$t1;
	}else{
		$path = "/dev/usb/lp".$t2;
	}



	$connector = new FilePrintConnector($path);
	$printer = new Escpos($connector);
	// $connector = new WindowsPrintConnector("T82");
	// $connector = new NetworkPrintConnector("192.168.22.38", 9100);

	function generateRand($conn){
		
		$i = rand(1000, 9999);	
		if ($i == 0) {
				$i = rand(1000, 9999);
		}	

		$d = rand(1,2222);
		if ($i < 7000) {
			$i = $i+$d;
		}

		$sql = "SELECT `ticket_code` FROM `operations` WHERE `ticket_code` = '".$i."' ;";
		$exe = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($exe);
		if($count > 0){
			generateRand($conn);
		}
		else{
			return $i;
		}		
	}

	$cust_id 			=  $_POST['cust_id'];
	$ticket_counts  	=  $_POST['nos'];
	$ride_names  	 	=  $_POST['names'];
	$ride_ids	  	 	=  $_POST['ride_ids'];

	if ($cust_id != 0) {
		$sql = "UPDATE `customers` SET `count` = `count`+1 WHERE `sr_no`='".$cust_id."' AND date(`date`) = CURDATE();";
		$exe = mysqli_query($conn, $sql);
	}else{
		$cust_id = '0';
	}

	

	for ($i=0; $i < sizeof($ticket_counts); $i++) { 

		
		for ($j=0; $j < $ticket_counts[$i]; $j++) { 

			$code = generateRand($conn);
		
			if ($code == 0 ) {
				$code = generateRand($conn);
			}

			$sql = "INSERT INTO `operations`(`cust_id`,`ticket_code`,`ride_id`) VALUES('".$cust_id."','".$code."','".$ride_ids[$i]."');";
			$exe = mysqli_query($conn, $sql);

			$qr = $code.$cust_id;
			$filename= "codes/".$qr.".png";
			QRcode::png($qr,$filename, QR_ECLEVEL_L, 7);

			//add the print command here

			/* Start the printer */


			$logo = new EscposImage($filename);

			$printer -> setJustification(Escpos::JUSTIFY_CENTER);

		
			/* Name of shop */
			$printer -> selectPrintMode(Escpos::MODE_DOUBLE_WIDTH);		
			$printer -> text("Velocity Entertainmentz\n");
			$printer -> selectPrintMode();
			$printer -> text("Village Bhose\n");
			$printer -> text("Panchgani-Mahabaleshwar Road \n");
			$printer -> text("Mahabaleshwar 412805\n");
			$printer -> text("Phone :- 02168 241 451");
			$printer -> feed(2);

			$printer -> selectPrintMode(Escpos::MODE_DOUBLE_WIDTH);
			$printer -> text(strtoupper($ride_names[$i]));
			$printer -> feed(1);
			$printer -> graphics($logo);
			$printer -> text($qr);
			$printer -> feed(2);

			$printer -> selectPrintMode();
			$printer -> text("Thank you for Visiting\n");
			$printer -> feed();
			$printer -> text($date1);
			$printer -> feed(2);
		
			/* Cut the receipt and open the cash drawer */
			$printer -> cut();
			//$printer -> pulse();
		}

	} 

	$printer -> close();

?>