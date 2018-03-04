<?php
require_once('connection.php');

function getMessagesTable()   {
	global $servername, $username, $password, $dbname;
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
 	} 
	
	$sql = "SELECT * FROM texts ORDER BY id";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
    	while($row = $result->fetch_assoc()) {
        	$table[] = $row;
    	}
	} else {
    	echo "0 results";
	}
 	$conn->close();
	return $table;
}

function getMessagesFromNumber($number) {
	global $servername, $username, $password, $dbname;
	//Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	//Check connection
	if($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$sql = "SELECT * FROM texts WHERE contact='$number' ORDER BY id";
	$result = $conn->query($sql);
	
	if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) $table[$row['id']] = $row;
	}else{
		$table = false;
	}
	$conn->close();
	return $table;
}

function addMessage($contact, $contact_name, $text, $direction) {
	global $servername, $username, $password, $dbname;
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "INSERT INTO texts (contact, contact_name, text, direction)
	VALUES ('$contact', '$contact_name', '$text', '$direction')";

	if ($conn->query($sql) === TRUE) {
    	$result = true;
	} else {
    	error_log("Error: " . $sql . "<br>" . $conn->error);
		$result = false;
	}
	$conn->close();
	return $result;
}

function prepareMessage($contact, $contact_name, $text, $date) {
	global $servername, $username, $password, $dbname;
	//Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	//Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		
	}
	
	$sql = "INSERT INTO prepared_texts (contact, contact_name, text, date)
	VALUES ('$contact', '$contact_name', '$text', '$date')";
	
	if($conn->query($sql) === TRUE) {
		$result = true;
	}else{
		error_log("Error: " . $sql . "<br>" .$conn->error);
		$result = false;
	}
	$conn->close();
	return $result;
}

function getPreparedMessagesYetToBeSent() {
	global $servername, $username, $password, $dbname;
	//Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	//Check connection
	if($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$sql = "SELECT * FROM prepared_texts WHERE date < NOW() ORDER BY id";
	$result = $conn->query($sql);
	
	if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) $table[] = $row;
	}else{
		$table = false;
	}
	return $table;
}

function getPreparedMessageByID($id) {
	global $servername, $username, $password, $dbname;
	//Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	//Check connection
	if($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$sql = "SELECT * FROM prepared_texts WHERE date < NOW() AND id = $id";
	$result = $conn->query($sql);
	
	if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) $table = $row;
	}else{
		error_log("phone2/database_connection/interaction.php:getPreparedMessageByID throws error -> ID ($id) does not exist or message is stil in the future.");
		die("ID ($id) does noet exist or message is still in the future.");
	}
	return $table;
}

function deletePreparedMessageByID($id) {
	global $servername, $username, $password, $dbname;
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	} 

	// sql to delete a record
	$sql = "DELETE FROM prepared_texts WHERE id=$id";

	if ($conn->query($sql) === TRUE) {
		$result = true;
	} else {
    	error_log("Error deleting record: " . $conn->error);
		$result = false;
	}

	$conn->close();
	return $result;
}
	
function transferPreparedMessagetoSentMessages($preparedMessageID) {
	$message = getPreparedMessageByID($preparedMessageID);
	$result = addMessage($message['contact'], $message['contact_name'], $message['text'], 'out');
	$result = $result && deletePreparedMessageByID($message['id']);
	return $result;
}

function getNameofContact($contact) {
	global $servername, $username, $password, $dbname;
	//Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	//Check connection
	if($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$sql = "SELECT * FROM texts WHERE contact='$contact' ORDER BY id";
	$result = $conn->query($sql);
	
	if($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$result = $row['contact_name'];
	}else{
		$result = false;
	}
	$conn->close();
	return $result;
}


?> 