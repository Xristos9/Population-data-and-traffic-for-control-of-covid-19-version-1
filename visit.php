<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
	integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="crossorigin=""/>
	<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-search/3.0.2/leaflet-search.src.js" integrity="sha512-V+GL/y/SDxveIQvxnw71JKEPqV2N+RYrUlf6os3Ru31Yhnv2giUsPadRuFtgmIipiXFBc+nCGMHPUJQc6uxxOA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet-search/3.0.2/leaflet-search.min.css" integrity="sha512-qI2MrOLvDIUkOYlIJTFwZbDQYEcuxaS8Dr4v+RIFz1LHL1KJEOKuO9UKpBBbKxfKzrnw9UB5WrGpdXQi0aAvSw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
				
	<title>Map</title>
</head>
<body>
	<div id="map"></div>
<script>
window.onload = function() {

	var baseLayer = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
		attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
		maxZoom: 18,
	})
	var map = new L.Map('map', {
		center: new L.LatLng(38.246361, 21.734966),
		zoom: 4,
		layers: [baseLayer]
	})
	var stores = new L.layerGroup();
	map.addLayer(stores);
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition, showError)
	} else { 
		alert("Geolocation is not supported by this browser.")
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

	function showPosition(position) {
		// console.log(position);
		var ClLock = L.marker([position.coords.latitude, position.coords.longitude]);
		ClLock.bindPopup("lat: " + position.coords.latitude + "<br>lng: " + position.coords.longitude);
		ClLock.addTo(map);
		map.setView([position.coords.latitude, position.coords.longitude], 8)

		const ajax =  $.ajax({
			url: 'mapBE.php',
			method: 'GET',
			dataType: 'json',
			success: function(data){
				// console.log(data)
			},error: function (xhr, exception) {
				var msg = "";
				if (xhr.status === 0) {
					msg = "Not connect.\n Verify Network." + xhr.responseText;
				} else if (xhr.status == 404) {
					msg = "Requested page not found. [404]" + xhr.responseText;
				} else if (xhr.status == 500) {
					msg = "Internal Server Error [500]." +  xhr.responseText;
				} else if (exception === "parsererror") {
					msg = "Requested JSON parse failed.";
				} else if (exception === "timeout") {
					msg = "Time out error." + xhr.responseText;
				} else if (exception === "abort") {
					msg = "Ajax request aborted.";
				} else {
					msg = "Error:" + xhr.status + " " + xhr.responseText;
				}
				console.log(msg)
			}
		})
		
		ajax.done(leadros)
	
		function leadros(res){
			for (var i in res) {
				if (getDistance(position.coords.latitude, position.coords.longitude, res[i].loc[0], res[i].loc[1]) <= 200000) {
	
					marker = L.marker([res[i].loc[0], res[i].loc[1]]);
	
					var container = $('<div />');
					container.html(`<p for="name">Name: ${res[i].name}</p>
					<p for="address">Address: ${res[i].address}</p>
					<label>How many people were at the store:</label>
					<input id="people" type="number" min="0"/>
					<button class="submit">Upload</button>`);
	
					container.on('click', '.submit', function(){
						people = $('#people').val();
						console.log(res[i])
						user_confirm(res, i, people);
					});
	
					marker.bindPopup(container[0]);
					stores.addLayer(marker);
				}
			}
		}
	}


		
	function user_confirm(res, i, num) {
		if (confirm(`Do you want to upload your visit to ${res[i].name} with ${parseInt(num)} people?`)) {
			var text = {};
			text.lat = res[i].loc[0];
			text.lng = res[i].loc[1];
			text.name = res[i].name;
			text.address = res[i].address;
			text.id = res[i].Id;
			text.estimate = parseInt(num);

			const upload = $.ajax({
				url: 'visitBE.php',
				method: 'POST',
				data: {
					key: text
				},
				success: function(data) {
					console.log(data)
					map.closePopup()
				},error: function (xhr, exception) {
					var msg = "";
					if (xhr.status === 0) {
						msg = "Not connect.\n Verify Network." + xhr.responseText;
					} else if (xhr.status == 404) {
						msg = "Requested page not found. [404]" + xhr.responseText;
					} else if (xhr.status == 500) {
						msg = "Internal Server Error [500]." +  xhr.responseText;
					} else if (exception === "parsererror") {
						msg = "Requested JSON parse failed.";
					} else if (exception === "timeout") {
						msg = "Time out error." + xhr.responseText;
					} else if (exception === "abort") {
						msg = "Ajax request aborted.";
					} else {
						msg = "Error:" + xhr.status + " " + xhr.responseText;
					}
					console.log(msg)
				}
			});
			event.preventDefault()

		} else {
			alert("Upload failed!")
			map.closePopup()
		}
	}
	
	
	//Function to calculate distance between coordinates
	function getDistance(lat1, lon1, lat2, lon2) {
		var R = 6371; // Radius of the earth in km
		var dLat = deg2rad(lat2 - lat1); // deg2rad below
		var dLon = deg2rad(lon2 - lon1);
		var a =
			Math.sin(dLat / 2) * Math.sin(dLat / 2) +
			Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
			Math.sin(dLon / 2) * Math.sin(dLon / 2);
		var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
		var d = R * c; // Distance in km
		return parseInt(d * 1000);
	}

	function deg2rad(deg) {
		return deg * (Math.PI / 180)
	}

}
</script>

</body>
</html>