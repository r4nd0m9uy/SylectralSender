<?php
require('database_connection/interaction.php');
$request=$_GET;
$name=isset($request['name'])?$request['name']:"";
$contact=preg_replace('/\D/', '', $request['contact']);
$message=$request['text'];
$date=isset($request['date'])?$request['date']:date('Y-m-d H:i:s');	
	
$message=str_replace('xzeacute', 'é', $message);
$message=str_replace('xzegrave', 'è', $message);
$message=str_replace('xzugrave', 'ù', $message);
$message=str_replace('xzagrave', 'à', $message);
$message=str_replace('xzecirc', 'ê', $message);
$message=str_replace('xzocirc', 'ô', $message);
$message=str_replace('xzccedil', 'ç', $message);
$message=str_replace('xzicirc', 'î', $message);
$message=str_replace('xzeuro', '€', $message);
$message=str_replace('xzsquot', '\'', $message);
$message=str_replace('xzexcla', '!', $message);
$message=str_replace('xzinter', '?', $message);
$message=str_replace('xzampersand', '&', $message);
$message=str_replace('xzat', '@', $message);
$message=str_replace('xzslash', '/', $message);
$message=str_replace('xzbracopen', '(', $message);
$message=str_replace('xzparagraph', '§', $message);
$message=str_replace('xzbracclose', ')', $message);
$message=str_replace('xzdollar', '$', $message);
$message=str_replace('xzsemicolon', ';', $message);
$message=str_replace('xzequal', '=', $message);
$message=str_replace('xzcomma', ',', $message);
$message=str_replace('xzplus', '+', $message);
$message=str_replace('xzacirc', 'â', $message);
$message=str_replace('xzdot', '.', $message);
$message=str_replace('xzouml', 'ö', $message);
$message=str_replace('xzuuml', 'ü', $message);

var_dump(prepareMessage($contact, $name, $message, $date));
var_dump($date);
die('<b>Votre message:</b><br><i>'.$message.'</i><br><b>A été envoyé avec succès.</b>');
//die('message envoy&eacute;<script>window.open(\'\', \'_self\', \'\'); window.close();</script>');

?>