<html lang="pt-br">
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
					<input style="font-size:3vh" type='date' name='startDate' required="required"> Start time:
					<input style="font-size:3vh" type='number' name='startHour' oninput='format(this)' step='1' min='09' max='19' required="required"> h
					<input style="font-size:3vh" type='number' name='startMinute' oninput='format(this)' step='15' min='00' max='45' required="required"> mins
					<div class="required"> *required field </div>
				</div>
			</p>

			<p>
				<div>End Date: 
					<input style="font-size:3vh" type='date' name='endDate' required="required"> End time:
					<input style="font-size:3vh" type='number' name='endHour' step='1' oninput='format(this)' min='09' max='19' required="required"> h
					<input style="font-size:3vh" type='number' name='endMinute' step='15' oninput='format(this)' min='00' max='45' required="required"> mins
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
    <script>
    	function format(input){
  			if(input.value.length === 1){
  				input.value = "0" + input.value;
  			}
		}
    </script>
  </body>

</html>