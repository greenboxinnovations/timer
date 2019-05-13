<?php

require '../query/conn.php';

if(isset($_POST["choice"])){

	$choice = $_POST['choice'];

	if($choice == "start"){		
		$sql = "UPDATE `users` SET `p_status`= 1 WHERE 1;";
	}
	else if($choice == "stop"){
		$sql = "UPDATE `users` SET `p_status`= 0 WHERE 1;";
	}

	$exe = mysqli_query($conn, $sql);
}

?>