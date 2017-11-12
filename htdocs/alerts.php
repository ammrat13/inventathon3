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
					<li class="active"><a href="#">Alerts</a></li>
					<li><a href="share_code.php">Share Code</a></li>
				</ul>
		  </div>
		</nav>

		<div class="container">
			<center><h1>Alerts:</h1></center><br/>

			<h4><center><a href="download_alerts.php">Download Alerts (.csv)</a></center></h4><br/>
			<table class="table table-condensed">
				<thead>
					<tr>
						<th class="col-md-4">Date</th>
						<th class="col-md-8">Alert</th>
					</tr>
				</thead>
				<tbody>
					<?php
						include 'db_pass.php';

						$conn = new mysqli($server, $uname, $pass, $dbname);
						if($conn->connect_error){
							die("Connection failed: " . $conn->connect_error);
						}

						$sql = "SELECT * FROM user_alerts WHERE user=\"" . $_COOKIE["user"] . "\" ORDER BY timest DESC";
						$res = $conn->query($sql);

						if($res === FALSE){
							die("<tr><td>Error</td><td></td></tr>");
						}

						while($row = $res->fetch_assoc()){
							echo "<tr><td class=\"col-md-4\">" . 
								date("Y-m-d h:i:sa", $row["timest"]) . 
								"</td><td class=\"col-md-8\">" .
								$row["descr"] . "</td></tr>";
						}
					?>
				</tbody>
			</table>
		</div>
	</body>
</html>