<?php
	include 'db_pass.php';

	$conn = new mysqli($server, $uname, $pass, $dbname);
	if($conn->connect_error){
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT * FROM users WHERE user=\"" . $_POST["uname"] . "\" AND pass=\"" . $_POST["pass"] . "\"";
	echo $sql;
	$res = $conn->query($sql);

	if(!$res){
		die("Error");
	}

	if($res->num_rows > 0){
		setcookie("user", $_POST["uname"], time()+10000);
		header("Location: user_data.php");
	} else {
		header("Location: index.html");
	}

	$conn->close();
?>