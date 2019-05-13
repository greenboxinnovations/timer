<?php
// outputs the username that owns the running php/httpd process
// (on a system with the "whoami" executable in the path)
$pid = exec('pidof new');

if($pid == ""){
	
	//echo exec('./all.sh');
	echo "program isnt running";
	// echo passthru("newt_bell(oid) 2>&1");
}
else{
	echo $pid;
	
	echo exec('./all.sh 2>&1');
}


?>

