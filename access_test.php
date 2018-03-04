<?php
$IP=$_SERVER['REMOTE_ADDR'];
if($IP=='94.177.242.196') {
	echo "Access Granted";
}else{
	header("HTTP/1.1 403 Forbidden" );
	echo "<h1>HTTP/1.1 403 Forbidden</h1><hr />No Access. Your IP adress is: $IP";
	exit(); //To prevent further execution
}
