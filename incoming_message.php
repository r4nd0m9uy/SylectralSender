<?php
	require('database_connection/interaction.php');
	$MessageSid = $_POST['MessageSid'];
	$From = $_POST['From'];
	$From = preg_replace('/\D/', '', $From); //Remove all non numeric characters
	$To = $_POST['To'];
	$Body = $_POST['Body'];
	
	//Get Name of Contact
	$name = getNameofContact($From);
	
	//Make Record in Database
	addMessage($From, $name, $Body, 'in');
			
	//MAIL
	if($name) {
		file_get_contents('http://mailer.krizdelogi.be/?fromnumber=' . $From . '&body=' . urlencode($Body) . '&name=' . urlencode($name));
	}else{
		file_get_contents('http://mailer.krizdelogi.be/?fromnumber=' . $From . '&body=' . urlencode($Body));
	}

?>	