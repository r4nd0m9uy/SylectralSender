<?php

//Only allow acces from the VPS with the SMS system
if($_SERVER['REMOTE_ADDR']=='xxx.xxx.xxx.xxx') {

//GET MAIL PARAMETERS
$request=$_GET;
if(!isset($request['fromnumber'])) die('NO FROM'); //Die script if there is no fromnumber
  $From = $request['fromnumber'];
  $Body = $request['body'];
  if(isset($request['name'])) {
	   $name=$request['name'].' ('.$From.')';
   }else{
	    $name=$From;
   }
   $to = "xxxxxxx"; //Mailaddress to receive the incoming messages
 }


$subject = "SMS de $name";

$message = "
<html>
<head>
<title>SMS de $name</title>
</head>
<body>
<b>SMS de $name</b>
</br>
<p>$Body</p>
<br /><br />
<p>Retrouvez l'historique des messages avec ce contact <a href='http://domain.com/history.php?contact=$From'>ici</a></p>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: SMS Sylectral <noreply@domain.com>' . "\r\n";

mail($to,$subject,$message,$headers);


}else{
die('NO ACCES');
}




?>
