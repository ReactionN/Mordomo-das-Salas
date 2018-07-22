<?php

function overlapped_meetings($conn, $roomNumber, $startDateTime, $endDateTime){
	$statement = $conn->prepare(
		"SELECT * FROM display.reservation
        	WHERE roomNumber = ?
        	AND NOT (endDateTime <= ? OR startDateTime >= ?)"
	);
	$statement->bind_param("sss", $roomNum, $start, $end);

	$roomNum = $roomNumber;
	$start = $startDateTime;
	$end = $endDateTime;

	$result = $statement->execute();
	$statement->store_result();
	$numRows = $statement->num_rows; 
	
	if($numRows>0){
		return "There is already another meeting taking place during the specified period of time!";
	}
	else return false;
}

?>