<!DOCTYPE html>
<html>
<head>
<style>

body {
    font: 3vh 'Open Sans', "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
}

.grid-container {
  display: grid;
  grid-gap: 2px;
  background-color: #2196F3;
  padding: 5px;
  border-radius: 10px;
}

.grid-container-cells {
  display: grid;
  /*background-color: #2196F3;*/
  background-color: white;
  border-color: black;
  border-style: solid;
}

.grid-container > div {
  /*background-color: rgba(255, 255, 255, 0.8);*/
  background-color: white;
  text-align: center;
  padding: 10px 0;
  font-size: 20px;
}

.cellsWeek {
  font-size: 10px;
  height: 10px
}

.cellsHours {
  padding: 0px;
  border-color: red;
  border-style: solid;
  font-size: 20px;
  height: 40px;
  border-radius: 5px;
}

.hours {
  grid-column-start: 1;
  grid-row-start: 1;
  grid-row-end: 4;
}

.cellsMonday {
  grid-column-start: 2;
  grid-row-start: 1;
  grid-row-end: 4;
}

.cellsTuesday {
  grid-column-start: 3;
  grid-row-start: 1;
  grid-row-end: 4;
}

.cellsWednesday {
  grid-column-start: 4;
  grid-row-start: 1;
  grid-row-end: 4;
}

.cellsThursday {
  grid-column-start: 5;
  grid-row-start: 1;
  grid-row-end: 4;
}

.cellsFriday {
  grid-column-start: 6;
  grid-row-start: 1;
  grid-row-end: 4;
}

</style>
</head>
<body>

<script>
//document.getElementById("C5L10E2").style.background = "red";

function daytoWeekDay() {
    var d = new Date(); //give the actual date
    var n = d.getDay();
    return n;
}
</script>

<h1>Weekly Reservations View</h1>

<div class="grid-container">
  <p id="demo" > oi </p>
  <div class="hours">Hours
    <div class="cellsHours">9:00</div>
    <div class="cellsHours">10:00</div>
    <div class="cellsHours">11:00</div>
    <div class="cellsHours">12:00</div>
    <div class="cellsHours">13:00</div>
    <div class="cellsHours">14:00</div>
    <div class="cellsHours">15:00</div>
    <div class="cellsHours">16:00</div>
    <div class="cellsHours">17:00</div>
    <div class="cellsHours">18:00</div>
  </div>
  <div class="cellsMonday">Monday
    <?php
       printcell(1);
    ?> 
  </div>
  <div class="cellsTuesday">Tuesday
    <?php
       printcell(2);
    ?> 
  </div> 
  <div class="cellsWednesday">Wednesday
    <?php
       printcell(3);
    ?> 
  </div>
  <div class="cellsThursday">Thursday
    <?php
       printcell(4);
    ?> 
  </div>
  <div class="cellsFriday">Friday
    <?php
       printcell(5);
    ?> 
  </div>
  </div>
</div>

<?php 

  paintcell();

  function printcell($c) {
    $l = 9;
    $e = 1;
    echo('<div class="grid-container-cells">');
    for ($x = 1; $x <= 40; $x++) {
        echo ('<div id="C'.$c.'L'.$l.'E'.$e.'" class="cellsWeek">9</div>'); //C-column L-line E-element (1 to 4)
        $e = $e+1;
        if ($x%4 == 0 && $x%40 != 0) {
          $l = $l+1;
          $e = 1;
          echo('</div>');
          echo('<div class="grid-container-cells">');
        }
    }
    echo('</div>');
  }

  function minuteToId($minute){
    return (($minute/15) + 1);
  }

  function hoursToNumBlocks($startHour, $startMinutes, $endHour, $endMinutes){
  	return (($endHour*60+$endMinutes) - ($startHour*60+$startMinutes))/15;
  }

  /*$ecras = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday");*/
  function paintcell(){
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

    $room = $_GET['roomNumber'];
    
    $inf_date = date("Y-m-d");
    $dw = date("N", time()); //DayToWeekday: returns 1(Monday) .. 7(Sunday)

    $sup_date = $inf_date; //$sup_date will be incremented until Friday

    for($i = 0; $i < 5-$dw; $i++){
      $sup_date = strtotime("+1 day", strtotime($sup_date));
      $sup_date = date("Y-m-d", $sup_date);
    }

    $sup_date = $sup_date . "T19:00";
    echo("$sup_date");
    $statement = "SELECT * FROM display.reservation WHERE endDateTime > NOW() AND endDateTime <= '$sup_date' AND roomNumber='$room'";

    $result = $conn->query($statement);

    if($result->num_rows > 0){
    	foreach ($result as $row) {
	      	$startDT = strtotime($row['startDateTime']);
	      	$endDT = strtotime($row['endDateTime']); 
	      	$startHour = date('H', $startDT);
	      	$endHour = date('H', $endDT);
	      	$startMinutes = date('i', $startDT);
	      	$endMinutes = date('i', $endDT);
	      	$startDT = date('Y-m-d', $startDT);
	      	$endDT = date('Y-m-d', $startDT); 

	      	$c = date("N", strtotime($startDT)); //column of the view (1-Monday, 2-Tuesday..)
	      	$l = (int)$startHour; //line of the view
	      	echo("$l");
	      	$e = minuteToId($startMinutes);
	      	$numBlocks = hoursToNumBlocks($startHour, $startMinutes, $endHour, $endMinutes);
	      	for($i=0; $i<$numBlocks; $i++) {
	      		$id="C".$c."L".$l."E".$e;
	      		echo("<script> document.getElementById('". $id ."').style.backgroundColor='red' </script>");
	      		if($e != 4){
	      			$e++;
	      		}else {
	      			$e=1;
	      			$l++;
	      		}
	      	}
    	}
    }
  }
?>

</body>
</html>