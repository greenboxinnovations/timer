<?php


$data 	= $_POST['data'];
$cu_id 	= $_POST['cu_id'];
$i_type = $_POST['i_type'];

list($type, $data) = explode(';', $data);
list(, $data)      = explode(',', $data);
$data = base64_decode($data);


file_put_contents('../photos/cust_id_'.$cu_id.'_'.$i_type.'.png', $data);

?>