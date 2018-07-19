<html>
	<head>
		<link id="css1" rel="stylesheet" type="text/css" href="css/style_new_reservation.css">
	</head>
	<body>
  	<?php   
		//DB connection
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
	?>

	<form action='reservation_result.php' method='get'>
		<h1>Make a new Reservation</h1>
		<div class='field'>
			<p>
				<div id='room'>Room Number: 
					<select name='roomNumber' style="font-size:3vh" >
						<?php
							$sql = "SELECT * FROM room;";
							$result = $conn->query($sql); 
							foreach($result as $row){
								echo "<option value='$row[roomNumber]'>$row[roomNumber]</option>";
							}
						?>
					</select>
					<div class="required"> *required field </div>
				</div>
			</p>

			<p>
				<div>Start Date: 
					<input style="font-size:3vh" type='datetime-local' name='startDateTime' required="required">
					<div class="required"> *required field </div>
				</div>
			</p>

			<p>
				<div>End Date: 
					<input style="font-size:3vh" type='datetime-local' name='endDateTime' required="required">
					<div class="required"> *required field </div>
				</div>
			</p>

			<p>
				<div>Host: 
					<input style="font-size:3vh" type='text' name='host' required="required">
					<div class="required"> *required field </div>
				</div>
			</p>

			<p>
				<div>Type: 
					<select style="font-size:3vh" name='type'>"
	       				<option value='External Meeting (high priority)'>External Meeting</option>
	        			<option value='Internal Meeting (medium priority)'>Internal Meeting</option>
	        			<option value='Other (low priority)'>Other</option>
	      			</select>
					<div class="required"> *required field </div>
	      		</div>   
	      	</p>
      	</div>
 		<div>
 			<p>
 				<input style="font-size:3vh" type='submit' value='Submit' required="required">
 			</p>
 		</div>
    </form>
  </body>

</html>