<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="refresh" content="10"> <!--refresh page every x seconds-->

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- jquery v3.2.1 -->
	<script src="js/jquery-3.2.1.js"></script>

	<!-- Bootstrap v3.3.7 -->
	<link rel="stylesheet" type="text/css" href="bootstrap-3.3.7-dist/css/bootstrap.css">
	<link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap-theme.css">
	<script src="bootstrap-3.3.7-dist/js/bootstrap.js"></script>

	<!-- Font awesome v4.7.0 -->
	<link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">

	<!-- Material icons v3.0.1 -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

	<!-- Custom includes -->
	<link id="css1" rel="stylesheet" type="text/css" href="css/style.css">
	<script src="js/script.js"></script>

	<title>Sala ocupada</title>
</head>

<body onload="updateClock(); setInterval('updateClock()', 1000); updateDate(); /*changeRoom();*/">

	<img src="images/background1.jpg" style="width: 100vw; height: 100vh; position: relative;">
	<div class="whole_screen">
		<!-- Toolbar -->
		<nav class="navbar navbar-default navbar_custom">
			<div id="toolbar_section" class="container-fluid">

				<!-- Toolbar Header -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main_toolbar" aria-expanded="false">
						<span class="sr-only"></span>
						<span class="sr-only"></span>
					</button>
				</div>

				<!-- Toolbar Content -->
				<div id="main_toolbar" class="collapse navbar-collapse">
					<div id ="clock_date">
						<!-- Clock-->
						<span id="clock"></span>
						<!-- Date -->
						<span id="date"></span>
					</div>
				</div>
			</div>
		</nav>

		<?php
			$servername = "localhost";
			$username = "root";
			$password = "root";
			$dbname = "display";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			} 

			//Change active status from active(1) to inactive(0) of all the meetings that took place.
			$sql_active = "UPDATE display.reservation SET active=0 WHERE active=1 AND endDateTime<NOW()";
			$conn->query($sql_active);

			//Get the roomNumber from the URL to use in the next queries.
			$room = $_GET['roomNumber'];

			//Give the current meeting if exists.
			$sql = "SELECT * FROM display.reservation WHERE active=1 AND roomNumber='$room' AND startDateTime<NOW() AND endDateTime>NOW()";

			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			    // output data of each row
			    $row = $result->fetch_assoc();
			    $status = "images/occupied.jpg";
			} else {
				//Give the next meeting for this room if exists.
				$until_sql = "SELECT * FROM display.reservation WHERE active=1 AND roomNumber='$room' AND startDateTime = (SELECT MIN(startDateTime) FROM display.reservation WHERE active=1 AND roomNumber='$room')";
				$result_until = $conn->query($until_sql);
				if ($result_until->num_rows > 0) {
			    	// output data of each row
			    	$until = $result_until->fetch_assoc();
			    	$until_str = "until " . $until["startDateTime"];
			    }
			    $status = "images/vacant.jpg"; 
			}
		?>

		<!-- Main Screen -->
		<div class="main_screen">
			<strong>
			<p id="room"> 
				<?php 
					echo "Room: " . $room . "<br>"; 
				?>	
			</p>
			<p id="type"> 
				<?php 
					echo "Type of Meeting: " . $row["type"] . "<br>"; 
				?>		
			</p>

			<p id="host"> 
				<?php 
					echo "Host: " . $row["host"] . "<br>"; 
				?>	
			</p>
			<div class="changing status">
				<p id="status"> Status: 
					<?php
						echo ("<img src=$status style='width: 10vw; height: 10vh;'>");
					?>
				</p>
				<p id="until"> 
					<?php 
						echo $until_str . "<br>"; 
					?>	
				</p>
			</div>
			<p class="info">
				<a href="viewsemanal.php">
					<img src="images/plusbutton.png" alt="Go to Weekly View Reservation" width="80" height="80border="0">info
				</a>
			</p>
			</strong>
		</div>
	</div>


	<script type="text/javascript">
		function updateClock() {
			var currentTime = new Date();
			var currentHours   = currentTime.getHours();
			var currentMinutes = currentTime.getMinutes();
			var currentSeconds = currentTime.getSeconds();

			currentMinutes = (currentMinutes < 10 ? "0" : "") + currentMinutes;
			currentHours   = (currentHours 	 < 10 ? "0" : "") + currentHours;
			currentSeconds = (currentSeconds < 10 ? "0" : "") + currentSeconds;

			$('#clock').text(currentHours + ":" + currentMinutes + ":" + currentSeconds);
		}

		function updateDate() {
			var currentTime =  new Date();
			var y = currentTime.getFullYear();
			var m = currentTime.getMonth() + 1;
			var d = currentTime.getDate();

			document.getElementById("date").innerHTML = d + "/" + m + "/" + y;
		}

	</script>

	<?php
		$conn->close();
	?>
</body>
</html>


