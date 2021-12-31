<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Search</title>

	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
	<script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
	<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
	<style>
		#autocomplete {
			z-index: 100;
			margin-bottom: 5px;
		}
		#map {
			height: 100vh;
			z-index: 0;
		}
	</style>
</head>
<body>

	<div class="ui-widget"  style="text-align:left;">
	<input id="autocomplete" placeholder="Search for: Store"></div>
	<div id="map" ></div>

<script>

	var date = new Date();
	var day = date.toLocaleString('en-us', { weekday: 'long'})

	const Icon1 = L.icon({
		iconUrl: 'icons/icon1.png',
		iconSize: [38, 38],
		iconAnchor: [20, 0]
	});

	const Icon2 = L.icon({
		iconUrl: 'icons/icon2.png',
		iconSize: [38, 38],
		iconAnchor: [20, 0]
	});

	const Icon3 = L.icon({
		iconUrl: 'icons/icon3.png',
		iconSize: [38, 38],
		iconAnchor: [20, 0]
	});

	var baseLayer = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
		attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
	})
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
		// console.log(position);
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

	$.ajax({
		url: 'mapBE.php',
		method: 'GET',
		dataType: 'json',
		success: function(data){
			var arr = []
			// Initialize autocomplete with empty source.
			$( "#autocomplete" ).autocomplete()

			const names = []
			for(var i in data){
				names.push(data[i].name)
			}
			let unique = [...new Set(names)]

			addDataToAutocomplete(unique)
			// Autocomplete search
			function addDataToAutocomplete(arr) {
				// The source for autocomplete.  https://api.jqueryui.com/autocomplete/#method-option
				$( "#autocomplete" ).autocomplete("option", "source", arr);

				$( "#autocomplete" ).on( "autocompleteselect", function( event, ui ) {
					// console.log(ui.item.label)
					polySelect(ui.item.label);  //grabs selected state name
					ui.item.value='';
				});
			}	// Autocomplete search end

			function polySelect(a){
				var arr1 = []

				for(var i in data){
					if(data[i].name == a && data[i].day == day){
						arr1.push(data[i])
					}
				}
				console.log(arr1)

				num = calc(arr1[0].popular_times)
				console.log(num)
				if (num >= 0 && num <= 32) {
					var marker = L.marker(L.latLng(arr1[0].loc[0], arr1[0].loc[1]), {icon: Icon1}, {id:arr1[0].id}).addTo(map)
				} else if (num >= 33 && num <= 65) {
					var marker = L.marker(L.latLng(arr1[0].loc[0], arr1[0].loc[1]), {icon: Icon2}, {id:arr1[0].id}).addTo(map)
				} else if (num >= 66) {
					var marker = L.marker(L.latLng(arr1[0].loc[0], arr1[0].loc[1]), {icon: Icon3}, {id:arr1[0].id}).addTo(map)
				} else {
					var marker = L.marker(L.latLng(arr1[0].loc[0], arr1[0].loc[1]), {id:data[i].id}).addTo(map)
				}

				marker.bindPopup("Name: '" + arr1[0].name + "'<br> Address: " + arr1[0].address + "<br>Traffic: " + Math.round(calc(arr1[0].popular_times)));
				map.setView([arr1[0].loc[0], arr1[0].loc[1]], 20);
			}

			function calc(arr){
				let nextTwoHours = [];
				nextTwoHours.push(parseInt(arr[date.getHours()]), parseInt(arr[date.getHours() + 1]), parseInt(arr[date.getHours() + 2]));
				return nextTwoHours.reduce((a, b) => a + b)/3
			}
		}
	})

</script>
</body>
</html>