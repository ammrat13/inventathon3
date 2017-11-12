<html>
	<head>
		<title>Alerts</title>
		<meta charset="utf-8"> 
		<!-- Bootstrap -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">Pulse-Ox Glove</a>
				</div>
				<ul class="nav navbar-nav">
					<li><a href="user_data.php">Home</a></li>
					<li><a href="alerts.php">Alerts</a></li>
					<li class="active"><a href="#">Share Code</a></li>
				</ul>
		  </div>
		</nav>

		<div class="container">
			<center><h1>Share Code:</h1></center><br/>

			<center>
				<div class="well">
					<h2>
						<?php
							function random_string(){
								$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
								$charactersLength = strlen($characters);
								$randomString = '';
								for ($i = 0; $i < 20; $i++) {
									$randomString .= $characters[rand(0, $charactersLength - 1)];
								}
								return $randomString;
							}

							include 'db_pass.php';

							$conn = new mysqli($server, $uname, $pass, $dbname);
							if($conn->connect_error){
								die("Connection failed: " . $conn->connect_error);
							}

							$code = random_string();

							$sql = "INSERT INTO share_codes (user, sharecode) VALUES (\"" . 
								$_COOKIE["user"] . "\", \"" . $code . "\")"
							;
							$res = $conn->query($sql);

							if($res === FALSE){
								$sql = "UPDATE share_codes SET sharecode=\"" . 
									$code . "\" WHERE user=\"" . $_COOKIE["user"] . "\""
								;
								$res = $conn->query($sql);
							}

							echo $code;
						?>
					</h2>
				</div>
			</center>

			<center><b>Remember this code:</b> once you leave this page, the code will change.</center>
		</div>
	</body>
</html>