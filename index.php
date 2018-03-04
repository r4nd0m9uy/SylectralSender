<?php
/*
This index page is created to have a landig when accessing the root url of this folder.
It throws an 403 error because accessing the folder by human interaction is forbidden.
In other files the access is being checked by verifying the IP-adress of the REMOTE_ADDR (host) and
if not the correct IP, it also throws the 403 error.
*/
header("HTTP/1.1 403 Forbidden" );
?>