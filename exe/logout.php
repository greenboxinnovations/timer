<?php
if(!isset($_SESSION))
{
	session_start();
}
if(session_destroy())
{
	require '../query/conn.php';
	$sql = "UPDATE `users` SET `p_status` = 0 WHERE `name` = 'admin';";
	$exe = mysqli_query($conn, $sql);
	header("location: ../login.php");
}
?>