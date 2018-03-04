<?php
require('database_connection/interaction.php');
$request=$_GET;
$name=isset($request['name'])?$request['name']:"";
$contact=preg_replace('/\D/', '', $request['contact']);
$message=$request['text'];
$date=isset($request['date'])?$request['date']:date('Y-m-d H:i:s');

$replaceArray = [
'xzeacute' => 'é',
'xzegrave' => 'è',
'xzugrave' => 'ù',
'xzagrave' => 'à',
'xzecirc' => 'ê',
'xzocirc' => 'ô',
'xzccedil' => 'ç',
'xzicirc' => 'î',
'xzeuro' => '€',
'xzsquot' => '\'',
'xzexcla' => '!',
'xzinter' => '?',
'xzampersand' => '&',
'xzat' => '@',
'xzslash' => '/',
'xzbracopen' => '(',
'xzparagraph' => '§',
'xzbracclose' => ')',
'xzdollar' => '$',
'xzsemicolon' => ';',
'xzequal' => '=',
'xzcomma' => ',',
'xzplus' => '+',
'xzacirc' => 'â',
'xzdot' => '.',
'xzouml' => 'ö',
'xzuuml' => 'ü',
];

$message = str_replace(array_keys($replaceArray), array_values($replaceArray), $message);

var_dump($message);
$result = prepareMessage($contact, $name, $message, $date);
var_dump($date);
if($result) {
	echo '<b>Votre message:</b><br><i>'.$message.'</i><br><b>A été envoyé avec succès.</b>';
}else{
	echo "Erreur. Verifier les logs.";
}
exit();
//die('message envoy&eacute;<script>window.open(\'\', \'_self\', \'\'); window.close();</script>');
?>
