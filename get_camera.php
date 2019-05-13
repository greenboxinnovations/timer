<?php

require 'query/conn.php';

	date_default_timezone_set("Asia/Kolkata");
	$date = date("Y-m-d");


	$sql = "SELECT `camera` FROM `users` WHERE `name` = 'admin';";
	$exe = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($exe);

	echo $row['camera'];
 
?>  