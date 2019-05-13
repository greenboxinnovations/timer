<?php
	require 'query/conn.php';
if(isset($_GET['name'])){

	$val = $_GET['name'];
	
 	// $sql = "SELECT * FROM `customers` WHERE date(`date`) = CURDATE() AND `cust_type` = 'p' AND `firstname` LIKE '%".$val."%' ORDER BY `sr_no` DESC LIMIT 3;";
 	$sql = "SELECT * FROM `customers` 
 			WHERE date(`date`) = CURDATE() AND `cust_type` = 'p' 
 			AND `firstname` LIKE '%".$val."%' 
 			OR date(`date`) = CURDATE() AND `cust_type` = 'p' AND `no` LIKE '%".$val."%' 
 			ORDER BY `sr_no` DESC LIMIT 3;";
	$exe = mysqli_query($conn,$sql);

	if (mysqli_num_rows($exe) > 0) {

			while ( $row = mysqli_fetch_assoc($exe) ) {
				echo'<div class="search_single">';
					
					$name = $row['firstname'].' '.$row['lastname'];

					echo'<div class="float_left" id="'.$row['sr_no'].'">'.ucfirst($name).'</div>';
					echo '<div class="float_right">'.$row['no'].'</div>';

				echo '</div>';
			}
	}
	else{
		echo'<div class="search_single">';
			echo'<div class="float_left"  id="-999">Nothing Found</div>';
		echo '</div>';
	}	
}

?>