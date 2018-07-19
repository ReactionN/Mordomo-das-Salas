<?php

function overlapped_meetings($conn, $roomNumber, $startDateTime, $endDateTime){
	$statement = $conn->prepare(
		"SELECT * FROM display.reservation
        	WHERE roomNumber = ?
        	AND ? BETWEEN startDateTime AND endDateTime
			OR ? BETWEEN startDateTime AND endDateTime
			OR ? < startDateTime AND ? > endDateTime"
	);

	$statement->bind_param("sssss", $roomNum, $start, $end, $start2, $end2);

	$roomNum = $roomNumber;
	$start = $startDateTime;
	$end = $endDateTime;
	$start2 = $startDateTime;
	$end2 = $endDateTime;

	//print $statement;

	/*$result = $statement->execute();

	while ($row = mysql_fetch_assoc($result)){
		foreach($row as $cname => $cvalue) {
			print "$cname: $cvalue\t";
		}
		print "\r\n";
	}
*/

	$statement->store_result();
	$numRows = $statement->num_rows;
	
	if($numRows > 0){
		return "There is already another meeting taking place during the specified period of time!";
	}
	else return false;
}

?>