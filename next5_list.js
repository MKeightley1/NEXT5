
function getData() {
    // The function returns the product of p1 and p2

	var test_races = [
		[1,"Tauranga", 1490411880],
		[2,"Winton", 1490412120],
		[3,"Auckland", 1490412180],
		[4,"Tauranga", 1490412600],
		[5,"Winton", 1490412840]
		
	];
	return test_races;	
}

function setTimer(races){
	for (var i = 0; i < races.length; i++) { 
	
		var raceId = "race"+races[i][0];
		var meetingId = "meeting"+races[i][0];
		
		raceId = raceId.replace(/^\s+|\s+$/g,"");
		
		var countDownDate = new Date(races[i][2] * 1000);
		//get todays date
		var now = new Date().getTime();
		
		// Find the distance between now an the count down date
		var distance = countDownDate - now;

		// Time calculations for days, hours, minutes and seconds
		var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);


			// Display the result in the element with id="demo"
		document.getElementById(meetingId).innerHTML = races[i][1];
		document.getElementById(raceId).innerHTML = days + "d " + hours + "h "
		+ minutes + "m " + seconds + "s ";
	}
	

	return distance;

	
}



var races = getData();

// Update the count down every 1 second
var x = setInterval(function() {
	//setup test array 
	
		distance = setTimer(races);
		// If the count down is finished, write some text 
		if (distance < 0) {
			clearInterval(x);
			document.getElementById("race1").innerHTML = "Closed";
		}
	



	
	

}, 1000);