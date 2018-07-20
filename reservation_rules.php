<?php

function overlapped_meetings($conn, $roomNumber, $startDateTime, $endDateTime){
	$statement = $conn->prepare(
		"SELECT * FROM display.reservation
        	WHERE ABS(roomNumber - ?) < 0.001
        	AND NOT (endDateTime <= ? OR startDateTime >= ?)"
	);

	/*
	AND startDateTime < ? AND ? < endDateTime
	OR startDateTime < ? AND ? < endDateTime
	OR ? < startDateTime AND ? > endDateTime"*/

	//$statement->bind_param("sssssss", $roomNum, $start, $end, $start2, $end2, $start3, $end3);
	$statement->bind_param("sss", $roomNum, $start, $end);

	$roomNum = $roomNumber;
	$start = $startDateTime;
	$end = $endDateTime;
	/*$start2 = $startDateTime;
	$end2 = $endDateTime;
	$start3 = $startDateTime;
	$end3 = $endDateTime;
*/
	$result = $statement->execute();
	$statement->store_result();
	$numRows = $statement->num_rows; 
	
	if($numRows>0){
		return "There is already another meeting taking place during the specified period of time!";
	}
	else return false;
}

?>