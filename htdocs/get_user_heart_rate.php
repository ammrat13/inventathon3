<?php
	function data_arr_hr(){
		include 'db_pass.php';

		$conn = new mysqli($server, $uname, $pass, $dbname);
		if($conn->connect_error){
			die("Connection failed: " . $conn->connect_error);
		}

		$sql = "SELECT * FROM user_data WHERE user=\"" .
			$_COOKIE["user"] . 
			"\" AND timest BETWEEN " . 
			(time() - 86400) . 
			" AND " . 
			time() . 
			" ORDER BY timest";
		$res = $conn->query($sql);

		if($res === FALSE){
			die("Error");
		}

		if($res->num_rows == 0){
			echo "[0,0]";
		}

		$t = 0;
		for($i=0; $i<$res->num_rows; $i++){
			$row = $res->fetch_assoc();
			if($i === 0){
				$t = $row["timest"] - 1;
				echo "[";
			} else {
				echo ", [";
			}
			echo $row["timest"] . ", ";
			echo 60 / ($row["timest"]-$t);
			echo "]";
			$t = $row["timest"];
		}

		$conn->close();
	}
?>