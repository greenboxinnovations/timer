<?php
	require '../../query/conn.php';
	
 	$sql = "SELECT * FROM `customers` WHERE date(`date`) = CURDATE() AND `cust_type` = 'p' ORDER BY `sr_no` DESC LIMIT 21;";
	$exe = mysqli_query($conn,$sql);

	echo'<div class="recent_box">';
		echo'<div class="recent_single " id="0	">Guest</div>';

		if (mysqli_num_rows($exe) > 0) {
			$counter = 2;

			while ( $row = mysqli_fetch_assoc($exe) ) {
				
				$name = $row['firstname'].' '.$row['lastname'];
				
				echo'<div class="recent_single " id="'.$row['sr_no'].'">'.ucfirst($name).'</div>';
				if ($counter % 7 == 0) {				
					echo '</div>';
					echo'<div class="recent_box">';
				}

				$counter++;			
			}
		}
	echo '</div>';

?>