<!DOCTYPE html>
<html>
<head>
<style>

body {
    font: 3vh 'Open Sans', "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
}

.grid-container {
  display: grid;
  grid-gap: 10px;
  background-color: #2196F3;
  padding: 10px;
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
  padding: 20px 0;
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

<h1>Weekly Reservations View</h1>

<div class="grid-container">
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
       printcell();
    ?> 
  </div>
  <div class="cellsTuesday">Tuesday
  </div> 
  <div class="cellsWednesday">Wednesday
  </div>
  <div class="cellsThursday">Thursday
    <div class="cells">9</div>
    <div class="cells">9</div>
    <div class="cells">9</div>
    <div class="cells">9</div>
  </div>
  <div class="cellsFriday">Friday
    <div class="cells">9</div>
    <div class="cells">9</div>
    <div class="cells">9</div>
    <div class="cells">9</div>
  </div>
  </div>
</div>

<?php 
  function printcell() {
    echo('<div class="grid-container-cells">');
    for ($x = 1; $x <= 40; $x++) {
        echo ('<div id="L'.$x.'" class="cellsWeek">9</div>');
        if ($x%4 == 0 && $x%40 != 0) {
          echo('</div>');
          echo('<div class="grid-container-cells">');
        }
    }
    echo('</div>');
  }
?>

<script>
  document.getElementById("L2").innerHTML = 10;
</script>

</body>

</html>