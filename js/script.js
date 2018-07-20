'use script'

function updateClock() {
	var currentTime = new Date();
	var currentHours   = currentTime.getHours();
	var currentMinutes = currentTime.getMinutes();
	var currentSeconds = currentTime.getSeconds();

	currentMinutes = (currentMinutes < 10 ? "0" : "") + currentMinutes;
	currentHours   = (currentHours 	 < 10 ? "0" : "") + currentHours;
	currentSeconds = (currentSeconds < 10 ? "0" : "") + currentSeconds;

	$('#clock').text(currentHours + ":" + currentMinutes + ":" + currentSeconds);
}

function updateDate() {
	var currentTime =  new Date();
	var y = currentTime.getFullYear();
	var m = currentTime.getMonth() + 1;
	var d = currentTime.getDate();

	document.getElementById("date").innerHTML = d + "/" + m + "/" + y;
}

/* 
funcion DataValidation (){

}
*/

/*function changeRoom() {
	var div = document.getElementById("hiddenRoom");
	var myRoom = div.textContent;

	document.getElementById("room").innerHTML = "Room: " + myRoom;
}
*/ 