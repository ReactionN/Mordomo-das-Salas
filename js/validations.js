'use script'
function valName(){
	var hostname = document.forms["reservationForm"]["host"].value;	
	//var startDate = document.forms["reservationForm"]["startDate"].value;
	var string = (hostname.trim());
	var i;
	var size;
	var cnt;
	var format = /^[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]*$/;
	var compare = " ";

	cnt = 0;
	size = string.length;
	space = 0;

	for(i=0 ; i < size ; i++) {	
		if(isNaN(string[i]) == false) {  // existe numero-> erro
    		cnt++;
							
			if(string[i].localeCompare(compare) == 0) {
				//document.write(i);
				cnt--;
				if( space!= 1 && i < size-1) {
					if(format.test(string[i+1]) == true){
						cnt++;
					}
					space++;
				}
			}
    	}
				
		if(format.test(string[i]) == true) {
			cnt++;
		}
	}

	if(cnt !=0 || space == 0) {
		alert("Nome mal inserido");
		return false;
	}

	return true;				
}

function dataValidation()
{
	
	var startDate = document.forms["reservationForm"]["startDate"].value;
	var endDate = document.forms["reservationForm"]["endDate"].value;
	var startHour = document.forms["reservationForm"]["startHour"].value;
	var startMinutes = document.forms["reservationForm"]["startMinute"].value;
	var endHour = document.forms["reservationForm"]["endHour"].value;
	var endMinutes = document.forms["reservationForm"]["endMinute"].value; 

	var nowDateTime = new Date();
	var month = nowDateTime.getMonth()+1;
	if(month < 10){
		month = "0" + month;
	}
	var nowDate = nowDateTime.getFullYear() + "-" + month + "-" + nowDateTime.getDate();
	var nowHour = nowDateTime.getHours();
	var nowMinutes = nowDateTime.getMinutes();

	//validate days
	if(startDate.localeCompare(endDate) != 0){
		alert("Error: The reservation must end in the same day it starts!");
		return false;
	}
	if(startDate.localeCompare(nowDate) == -1){
		alert("Error: Reservations cannot be booked before today!");
		return false;
	}

	//convert time to total minutes
	nowTotal = nowDateTime.getHours()*60 + nowDateTime.getMinutes();
	startTotal = parseInt(startHour)*60 + parseInt(startMinutes);
	endTotal = parseInt(endHour*60) + parseInt(endMinutes);

	//validate hours and minutes
	if(endTotal - startTotal < 30){
		alert("Error: The minimum amount of time for a reservation is 30 minutes and the reservation must end after it starts!");
		return false;
	}
	
	if(startTotal - nowTotal < -15){
		alert("Error: You cannot make reservation less than 15 minutes before the current time!");
		return false;
	}	

}
	
	
	
