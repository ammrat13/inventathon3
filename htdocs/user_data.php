<?php
	include 'db_pass.php';
	include 'get_user_heart_rate.php';
	include 'get_user_oxy.php';
?>

<html>
	<head>
		<title>User Data</title>
		<meta charset="utf-8"> 
		<!-- Bootstrap -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	</head>
	<body>
		<script type="text/javascript">
		    google.charts.load('current', {'packages':['corechart']});
		    google.charts.setOnLoadCallback(drawChart);

		    function drawChart() {
		   		var datahr = google.visualization.arrayToDataTable([
		   			['TimeStamp', 'Heart Rate'], 
		   			<?php data_arr_hr(); ?>
		   		]);

		   		var dataox = google.visualization.arrayToDataTable([
		   			['TimeStamp', 'Oxygen Concentration'], 
		   			<?php data_arr_ox(); ?>
		   		]);

				var options = {
					title: 'Heart Rate',
					curveType: 'function',
					legend: { position: 'bottom' },
					series: {0:{color: "#0000ff"}},
					hAxis: {textPosition: 'none'}
				};

				var chart = new google.visualization.LineChart(document.getElementById('hr_chart'));
				chart.draw(datahr, options);

				options = {
					title: 'Oxygen Concentration',
					curveType: 'function',
					legend: { position: 'bottom' },
					series: {0:{color: "#ff0000"}},
					hAxis: {textPosition: 'none'}
				};

				chart = new google.visualization.LineChart(document.getElementById('ox_chart'));
				chart.draw(dataox, options);
			}
		</script>

		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">Pulse-Ox Glove</a>
				</div>
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Home</a></li>
					<li><a href="alerts.php">Alerts</a></li>
					<li><a href="share_code.php">Share Code</a></li>
				</ul>
		  </div>
		</nav>
		<div class="container">
			<h1><center><?php echo $_COOKIE["user"] ?>'s Data</center></h1><br/>
			<center><h4><a href="download_data.php">Download Data (.csv)</a></h4></center>
		    <div class="row">
		    	<div class="col-lg-6">
		    		<div id="hr_chart" style="height: 500px"></div>
		    	</div>
		    	<div class="col-lg-6">
		    		<div id="ox_chart" style="height: 500px"></div>
		    	</div>
		    </div>
		</div>
	</body>
</html>