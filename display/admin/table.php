<?php
	
	include '../../query/conn.php';
	date_default_timezone_set("Asia/Kolkata");
	$date = $_GET['date'];


	$sql =	"SELECT COUNT(a.amount) as count,a.amount,b.name,b.id,b.rate 
			FROM `master` a
			RIGHT JOIN `rides` b ON a.ride_id=b.id WHERE a.date = '".$date."' GROUP BY b.id ;";

		// $sql =	"SELECT COUNT(a.amount) as count,a.amount,b.name,b.id,b.rate 
		// 	FROM `master` a
		// 	RIGHT JOIN `rides` b ON a.ride_id=b.id AND a.date = '".$date."' WHERE 1 GROUP BY b.id ;";
			
	$info=mysqli_query($conn,$sql);
	

	echo '<table>';
		echo '<tr class="header">';
			echo '<td>RIDE</td>';
			echo '<td class="ride_num">COUNT</td>';
			echo '<td class="ride_rate">RATE</td>';
			echo '<td class="ride_total">TOTAL</td>';
		echo '</tr>';

		$grand = 0;

		while ($row = mysqli_fetch_assoc($info)) {
			echo '<tr ride_id="'.$row['id'].'">';
				echo '<td class="ride_name">'.ucwords($row['name']).'</td>';
				echo '<td class="ride_num">'.$row['count'].'</td>';
				echo '<td class="ride_rate">'.$row['amount'].'</td>';
				$total = $row['count']*$row['amount'];
				echo '<td class="ride_total">'.$total.'</td>';
			echo '</tr>';
			$grand+= $total;
		}

		echo '<tr>';
			echo '<td class=""></td>';
			echo '<td class=""></td>';
			echo '<td class="">Grand total</td>';
			echo '<td class="ride_total">'.$grand.'</td>';
		echo '</tr>';
				
	echo '</table>';

?>