<?php
	include 'db_pass.php';

	header("Content-Type: text/plain");

	$conn = new mysqli($server, $uname, $pass, $dbname);
	if($conn->connect_error){
		die("Connection failed: " . $conn->connect_error);
	}

	echo "TimeStamp, Oxygen Content, Heart Rate\n";

	$sql = "SELECT * FROM user_data WHERE user=\"" . $_COOKIE["user"] . "\" ORDER BY timest";
	$res = $conn->query($sql);

	if($res === FALSE){
		die("Error");
	}

	$t = 0;
	for($i=0; $i<$res->num_rows; $i++){
		$row = $res->fetch_assoc();
		if($i === 0){
			$t = $row["timest"] - 1;
		}
		echo $row["timest"] . ", " . $row["ox_content"] . ", ";
		echo 60 / ($row["timest"]-$t);
		echo "\n";
		$t = $row["timest"];
	}
?>