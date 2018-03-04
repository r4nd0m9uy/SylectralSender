<?php
require('database_connection/interaction.php');

echo "<style>


.box {
  width: 300px;
  margin: 50px auto;
  background: #00bfb6;
  padding: 20px;
  font-weight: 900;
  color: #fff;
  font-family: arial;
  position: relative;
}

.sb1:before {
  content: '';
  width: 0px;
  height: 0px;
  text-align: left;
  position: absolute;
  border-left: 10px solid #00bfb6;
  border-right: 10px solid transparent;
  border-top: 10px solid #00bfb6;
  border-bottom: 10px solid transparent;
  right: -19px;
  top: 6px;
}

.sb2:before {
  content: '';
  width: 0px;
  height: 0px;
  text-align: right;
  position: absolute;
  border-left: 10px solid transparent;
  border-right: 10px solid #00bfb6;
  border-top: 10px solid #00bfb6;
  border-bottom: 10px solid transparent;
  left: -19px;
  top: 6px;
}

.sb3:before {
  content: '';
  width: 0px;
  height: 0px;
  position: absolute;
  border-left: 10px solid #00bfb6;
  border-right: 10px solid transparent;
  border-top: 10px solid #00bfb6;
  border-bottom: 10px solid transparent;
  left: 19px;
  bottom: -19px;
}

.sb4:before {
  content: '';
  width: 0px;
  height: 0px;
  position: absolute;
  border-left: 10px solid transparent;
  border-right: 10px solid #00bfb6;
  border-top: 10px solid #00bfb6;
  border-bottom: 10px solid transparent;
  right: 19px;
  bottom: -19px;
}
</style>";

$request=$_GET;
$contact=$request['contact'];
echo "<title>Historique de messages</title>";

if($name=getNameofContact($contact)) echo "<h1>$name</h1>";

$messages=getMessagesFromNumber($contact);

echo "<h5>$contact</h5>";
echo "<hr>";

foreach($messages as $message) {
	$b='sb2';
	if($message['direction']=="in") $b='sb1';
	echo "<div class='box $b'><b>".$message['direction']."</b><br />".$message['text']."</div>";
}

?>