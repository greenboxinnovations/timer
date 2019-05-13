

<div class="t_heading">TODAYS TOP 20</div>
<div class="flex">	
	<div class="t_holder">
		<table>

<?php



require '../../query/conn.php';

date_default_timezone_set("Asia/Kolkata");
	$date = date("Y-m-d");
	$timestampcurrent = date("Y-m-d H:i:s"); 


	$sql = "SELECT * FROM `operations` WHERE `name` IS NOT NULL;";
	$exe = mysqli_query($conn, $sql);

	$num_rows = mysqli_num_rows($exe);
	$count = 0;

	while($row = mysqli_fetch_assoc($exe)){


		

		$kart = array();
		$name = $row['name'];
		$lap  = $row['cur_lap'];
		$kart_no = $row['kart_no'];
		$timing = $row['timing'];
		$times = explode('|', $timing);
		$best  = 0;
		$total = 0;

		$timestampold = $row['time'];
		$latest = false;

		$kart['lap']     = $lap;

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

		if ($lap == 1) {
			$kart['lap']     = "Start";
		}else{
			$kart['lap']     = $lap-1;
		}		

		$kart['show']	 = $latest;
		$kart['name']    = strtoupper($name);
		$kart['best']    = $best;
		$kart['total']   = $total;
		$kart['kart_no'] = $kart_no;


		if($count < 11){
			echo '<tr><td class="t_no">'.($count+1).'</td><td class="t_name">'.strtoupper($name).'</td><td class="t_time">'.$best.'</td></tr>';
		}else if($count == 11){
			echo '</table></div><div class="t_holder"><table><div class="t_holder"><table>';
		}else if($count == $num_rows){
			echo '<tr><td class="t_no">'.($count+12).'</td><td class="t_name">'.strtoupper($name).'</td><td class="t_time">'.$best.'</td></tr>';
			echo '</table></div>';
		}else{
			echo '<tr><td class="t_no">'.($count+12).'</td><td class="t_name">'.strtoupper($name).'</td><td class="t_time">'.$best.'</td></tr>';
		}
		++$count;
	}



?>
	
</div>


