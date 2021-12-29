<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
	integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
	crossorigin=""/>
	<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
	integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
	crossorigin=""></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-search/3.0.2/leaflet-search.src.js" integrity="sha512-V+GL/y/SDxveIQvxnw71JKEPqV2N+RYrUlf6os3Ru31Yhnv2giUsPadRuFtgmIipiXFBc+nCGMHPUJQc6uxxOA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet-search/3.0.2/leaflet-search.min.css" integrity="sha512-qI2MrOLvDIUkOYlIJTFwZbDQYEcuxaS8Dr4v+RIFz1LHL1KJEOKuO9UKpBBbKxfKzrnw9UB5WrGpdXQi0aAvSw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
				
	<title>Map</title>
</head>
<body>
	<div id="map"></div>
	<script>
		window.onload = function() {
			
			$.ajax({
				url: 'mapBE.php',
				method: 'GET',
				dataType: 'json',
				success: function(data){
					console.log(data)
				}
			})

			var baseLayer = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
				attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
				maxZoom: 18,
			})
			var markers = new L.layerGroup();
			var map = new L.Map('map', {
				center: new L.LatLng(38.246361, 21.734966),
				zoom: 4,
				layers: [baseLayer]
			})

			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(showPosition, showError)
			} else { 
				alert("Geolocation is not supported by this browser.")
			}

			function showPosition(position) {
				console.log(position);
				var ClLock = L.marker([position.coords.latitude, position.coords.longitude]);
				ClLock.bindPopup("lat: " + position.coords.latitude + "<br>lng: " + position.coords.longitude);
				ClLock.addTo(map);
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
		};

		//Initialize search bar
		var searchControl = new L.control.search({
			// sourceData: searchByAjax,
			textPlaceholder: 'Search for the store',
			position: "topright",
			autoType: false,
			delayType:500,
			collapsed:false,
			// moveToLocation: function(latLng, title, map){
			// 	map.setView([latLng.lat,latLng.lng], 20);
			// }
		});

		map.addControl(searchControl);
		// map.addLayer(markers);

		searchControl.on('search:locationfound', () => {
		map.on('popupclose', function(){
			markers.clearLayers();
		})

		});

		
	</script>

</body>
</html>