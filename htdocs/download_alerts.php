<?php
	include 'db_pass.php';

	header("Content-Type: text/plain");

	$conn = new mysqli($server, $uname, $pass, $dbname);
	if($conn->connect_error){
		die("Connection failed: " . $conn->connect_error);
	}

	echo "TimeStamp, Alert Description\n";

	$sql = "SELECT * FROM user_alerts WHERE user=\"" . $_COOKIE["user"] . "\" ORDER BY timest";
	$res = $conn->query($sql);

	if($res === FALSE){
		die("Error");
	}

	$t = 0;
	for($i=0; $i<$res->num_rows; $i++){
		$row = $res->fetch_assoc();
		echo $row["timest"] . ", " . $row["descr"] . "\n";
	}
?>