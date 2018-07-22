<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

  <link id="css1" rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<div class="container">
  <h2>Reservations Weekly View</h2>           
  <table class="table table-bordered">
    <thead>
      <tr>
      	<th>Hours\Weekly Day</th>
        <th id=c1>Monday</th> 
        <th id=c2>Tuesday</th>
        <th id=c3>Wednesday</th>
        <th id=c4>Thursday</th>
        <th id=c5>Friday</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="padding: 0">
          <div class="table_cell">09:00</div>
          <div class="table_cell">10:00</div>
          <div class="table_cell">11:00</div>
          <div class="table_cell">12:00</div>
          <div class="table_cell">13:00</div>
          <div class="table_cell">14:00</div>
          <div class="table_cell">15:00</div>
          <div class="table_cell">16:00</div>
          <div class="table_cell">17:00</div>
          <div class="table_cell">18:00</div>
          <div class="table_cell">19:00</div>
        </td>
        <td style="padding: 0">
          <?php
            printcell();
          ?>        
        </td>
      </tr>
    </tbody>

    <?php 
        function printcell() {
      for ($x = 0; $x < 40; $x++) {
          echo ('<div class="table_cell_min"></div>');
      } 
    }
    ?>

</body>
</html>
