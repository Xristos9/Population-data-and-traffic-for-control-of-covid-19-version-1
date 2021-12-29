<!DOCTYPE html>
<html>
<body>

<p>Click the button to get your coordinates.</p>


<p id="demo"></p>

<script>

	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition, showError)
	} else { 
		alert("Geolocation is not supported by this browser.")
	}


function showPosition(position) {
	var marker = L.marker([position.coords.latitude, position.coords.longitude]);
	marker.bindPopup("I am Here:<br>lat: " + position.coords.latitude + "<br>lng: " + position.coords.	longitude);
	markers.addLayer(marker);
	map.setView([position.coords.latitude, position.coords.longitude], 13)
}

function showError(error) {
	switch(error.code) {
		case error.PERMISSION_DENIED:
			alert("User denied the request for Geolocation.")
			break;
		case error.POSITION_UNAVAILABLE:
			alert("Location information is unavailable.")
			break;
		case error.TIMEOUT:
			alert("The request to get user location timed out.")
			break;
		case error.UNKNOWN_ERROR:
			alert("An unknown error occurred.")
			break;
	}
}
</script>

</body>
</html>