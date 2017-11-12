<?php
	include 'db_pass.php';

	$conn = new mysqli($server, $uname, $pass, $dbname);
	if($conn->connect_error){
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = ("INSERT INTO user_data (user,ox_content,timest) VALUES (\"" .
		$_GET["user"] . "\", " .
		$_GET["ox_content"] . ", " .
		$_GET["timest"] . ")" 
	);

	if($conn->query($sql) === TRUE){
		echo "Success";
	} else {
		echo "Error";
	}

	$conn->close();
?>