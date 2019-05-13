<?php

require '../query/conn.php';


if(isset($_POST['color'])){

	$color = $_POST['color'];

	$sql = "UPDATE `color` SET `color`= '".$color."' WHERE 1;";
	$exe = mysqli_query($conn, $sql);
}

?>