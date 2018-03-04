<?php
require_once 'Services/Twilio.php'; // Loads the library

/*
This file must check if there are messages to be sent form the 'prepared_texts' table.
If so, they must be sent and transferd to the 'texts' table by using the transferPreparedMessagetoSentMessages function.
*/

if($_SERVER['REMOTE_ADDR']=='***REMOVED***') {
	
	require('database_connection/interaction.php');
	
	$tosend = getPreparedMessagesYetToBeSent();
	if(!$tosend) {
		echo "<html><head><meta http-equiv='refresh' content='30'></head><body><b>AUTOSEND:</b> ";
    	echo '<br/>Last connection: '.date('Y-m-d G:i:s');
		echo "<br /></body></html>";
		exit();
	}
	foreach($tosend as $prepMessage) {
		//GRAB THE DETAILS OF THE MESSAGE
			$contact=$prepMessage['contact'];
			$contact=preg_replace('/\D/', '', $contact);
			$contact_name=$prepMessage['contact_name'];
			$text=$prepMessage['text'];
		
		
		//SEND THE MESSAGE
			// Your Account Sid and Auth Token from twilio.com/user/account
			$sid = "***REMOVED***";
			$token = "***REMOVED***";
			$client = new Services_Twilio($sid, $token);

			$message = $client->account->messages->create(array(
    		"From" => '32460202122', // From a valid Twilio number
    		"To" => $contact,   // Text this number
    		"Body" => $text,
			));
			
		//TRANSFER THE MESSAGE DETAILS TO THE 'TEXTS' TABLE
			transferPreparedMessagetoSentMessages($prepMessage['id']);
			
	}
	
	echo "<html><head><meta http-equiv='refresh' content='30'></head><body><b>AUTOSEND:</b> ";
    echo '<br/>Last connection: '.date('Y-m-d G:i:s');
	echo "<br />SENT</body></html>";
	
	
	
}else{
	header("HTTP/1.1 403 Forbidden" );
	echo "<h1>HTTP/1.1 403 Forbidden</h1><hr />No Access. Your IP adress is: ".$_SERVER['REMOTE_ADDR'];
	exit(); //To prevent further execution
}





?>