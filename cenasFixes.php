<?php
	//Converts hours/minutes/seconds to integer value - usefull to map the hours and minutes to the ID.
	$yourdatetime = "04:05:07";
	$time = explode(':', $yourdatetime);
	$hours = (int)$time[0];

	echo("$hours");

/* javascript code to map a certain day to the day of the week. Monday - 1, Tuesday - 2, etc...
	var d = new Date();
    var n = d.getDay();
*/

    //Increments the datetime
    $date = strtotime("+1 day", strtotime("2018-09-30"));
  	echo date("Y-m-d", $date);
?>