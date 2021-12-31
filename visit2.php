<!DOCTYPE html>
<html>
  <head>
	<link rel="stylesheet" href="//cdn.leafletjs.com/leaflet-0.7.5/leaflet.css" />
	<link rel="stylesheet" href="style.css" />
	<script type="text/javascript" src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="//cdn.leafletjs.com/leaflet-0.7.5/leaflet.js"></script>
	<!-- <script type="text/javascript" src="script.js"></script> -->
	<style>
		body {
			margin: 0;
		}
		html, body, #leaflet {
			height: 100%;
		}

	</style>
</head>
<body>
	<div id="leaflet"></div>
<script>
	var map = L.map('leaflet', {
		'center': [0, 0],
		'zoom': 5,
		'layers': [
		L.tileLayer('http://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png', {
			attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, &copy; <a href="http://cartodb.com/attributions">CartoDB</a>'
		})
		]
	});
	var markers = new L.layerGroup();
	map.addLayer(markers);

	var a = 9
	var template = `<p for="name">Name: ${a}</p>
					<p for="address">Address: ${a}</p>
					<label>How many people were at the store:</label>
					<input id="people" type="number"/>
					<button id="submit">Upload</button>`;

	window.onload = function layerClickHandler() {
		var marker
		var buttonSubmit = L.DomUtil.get('submit');
		for(var i=1; i<10; i++){
			marker = L.marker([i, i]);
			marker.bindPopup(template);
			markers.addLayer(marker);

			marker.on('click', '.submit', function(){
				people_in = $('#people').val();
				user_confirm(responseText, i, people_in);
			});
			// L.DomEvent.addListener(buttonSubmit, 'click', function (e) {
			// 	marker.closePopup();
			// });
		}
		
		
	}

	function user_confirm(server_response, iteration, people){
		console.log(server_response, iteration, people)
	}



	</script>
</body>
</html>