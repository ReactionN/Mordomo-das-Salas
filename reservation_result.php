<html>
  <body style="font-size:4vh">

  <?php    
  	include 'reservation_rules.php';

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

    $statement = $conn->prepare("INSERT INTO display.reservation (roomNumber, startDateTime, endDateTime, host, type, active) VALUES (?, ?, ?, ?, ?, ?);");

    if ($statement === false){
        echo 'statement is false';
        exit();
    }

    try{
        $statement->bind_param("ssssss", $roomNumber, $startDateTime, $endDateTime, $host, $type, $active);

        $roomNumber = $_GET['roomNumber'];
        $startDateTime = $_GET['startDateTime'];
        $endDateTime = $_GET['endDateTime'];
        $host = $_GET['host'];
        $type = $_GET['type'];
        $active = 1;

        $result = overlapped_meetings($conn, $roomNumber, $startDateTime, $endDateTime);

        if ($result === false) {
        	$statement->execute();
            echo 'The new reservation was booked successfully!', "\n";
        }
        else {
            printf("Error: %s \n", $result);
        }
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }

    //echo "<script>console.log( 'Debug Objects: " . $error . "' );</script>";
    
  ?>

  </body>
</html>