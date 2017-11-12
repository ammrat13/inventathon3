<?php
	include 'db_pass.php';

	$conn = new mysqli($server, $uname, $pass, $dbname);
	if($conn->connect_error){
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "SELECT * FROM share_codes WHERE sharecode=\"" . $_POST["code"] . "\"";
	echo $sql;
	$res = $conn->query($sql);

	if(!$res){
		die("Error");
	}

	if($res->num_rows > 0){
		$row = $res->fetch_assoc();
		setcookie("user", $row["user"], time()+10000);
		header("Location: user_data.php");
	} else {
		header("Location: index.html");
	}

	$conn->close();
?>