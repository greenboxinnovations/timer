<?php
require '../../query/conn.php';
	
	$cust_id = $_GET['cust_id'];	

 	$sql = "SELECT * FROM `operations` WHERE  `cust_id` = '".$cust_id."' AND `name` IS NULL ORDER BY `op_id` ASC ;";
	$exe = mysqli_query($conn,$sql);

	echo'<div class="daily_ops_card_holder">';
		echo'<div class="daily_op_card">';
  
			if (mysqli_num_rows($exe) > 0) {

				while ( $row = mysqli_fetch_assoc($exe) ) {
					echo'<div class="daily_gqg ">'.$row['ticket_code'].''.$cust_id.'</div>';					
				}
			}
			else{
				echo'<div class="daily_gqg ">No Customers Yet</div>';
			}	
		echo'</div>';
	echo '</div>';



?>