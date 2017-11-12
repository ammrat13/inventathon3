<?php
	use PHPMailer\PHPMailer;
	include 'db_pass.php';

	$conn = new mysqli($server, $uname, $pass, $dbname);
	if($conn->connect_error){
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "INSERT INTO user_alerts (user, timest, descr) VALUES (\"" . 
		$_GET["user"] . "\", " .
		$_GET["timest"] . ", \"" . 
		$_GET["descr"] . "\")";
	$res = $conn->query($sql);

	if($res === FALSE){
		echo "Error";
	} else {
		echo "Success";
	}
?>