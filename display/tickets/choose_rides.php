<div id="center_stuff">
	<?php

	require '../../query/conn.php';

	$sql = "SELECT * FROM `rides` WHERE `id` NOT IN (18)";
	$exe = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_assoc($exe)){

		$img 	= $row['img'];
		$name 	= $row['name'];
		$id 	= $row['id'];
		$rate	= $row['rate'];

		echo '<div class="box">';
			// echo '<div class="img_2"></div>';
			echo '<div class="img_change" style="background:url(css/icons/'.$img.') no-repeat center center;padding-left: 20px;padding-right: 20px;height: 100px;width: 100px;margin: 0 auto;padding-top: 10px;"></div>';				
			echo '<div class="box_text"><span class="no_selection" ride_id="'.$id.'" rate="'.$rate.'">'.$name.'</span></div>';
			echo '<div class="clear"></div>';			
			echo '<div class="cancel"></div>';
			echo '<div class="number"><span class="no_selection"></span></div>';
		echo '</div>';

	}

	// $array = array(
	// 	array("go karting 1","ic_gk1.png"),
	// 	array("go karting 2","ic_gk2.png"),
	// 	array("atv bikes","ic_atv.png"),
	// 	array("zipline","ic_zipline.png"),
	// 	array("dashing car","ic_dash.png"),
	// 	array("giant wheel","ic_wheel.png"),
	// 	array("gyroscope","ic_gyro.png"),
	// 	array("rodeo bull","ic_bull.png"),
	// 	array("bungee trampoline","ic_tramp.png"),
	// 	array("bungee ejection","ic_eject.png"),
	// 	array("drop tower","ic_tower.png"),
	// 	array("merry go round","ic_round.png"),
	// 	array("indoor games","ic_indoorgames.png"),
	// 	array("shooting","ic_shooting.png"),
	// 	array("video games","ic_video.png"),
	// 	array("air hockey","ic_hockey.png"),
	// 	array("massage chair","ic_massage.png")
	// 	);

	// for($i=0;$i<sizeof($array);$i++){
	// 	echo '<div class="box">';
	// 		// echo '<div class="img_2"></div>';
	// 		echo '<div class="img_change" style="background:url(css/icons/'.$array[$i][1].') no-repeat center center;padding-left: 20px;padding-right: 20px;height: 100px;width: 100px;margin: 0 auto;padding-top: 10px;"></div>';				
	// 		echo '<div class="box_text"><span class="no_selection">'.$array[$i][0].'</span></div>';
	// 		echo '<div class="clear"></div>';			
	// 		echo '<div class="cancel"></div>';
	// 		echo '<div class="number"><span class="no_selection"></span></div>';
	// 	echo '</div>';
	// }
	?>	
</div>

<div id="btn_holder">
	<div class="mat_btn goback">BACK</div>
	<div class="mat_btn next_btn" id="print">PRINT</div>
</div>