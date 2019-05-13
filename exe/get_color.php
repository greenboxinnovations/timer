<?php

require '../query/conn.php';

$sql = "SELECT * FROM `color` WHERE 1";
$exe = mysqli_query($conn, $sql);


$row = mysqli_fetch_assoc($exe);

echo $row['color'];

?>