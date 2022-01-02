var date = new Date();
	var day = date.toLocaleString('en-us', { weekday: 'long'})

	const green = L.icon({
		iconUrl: 'icons/green.png',
		iconSize: [38, 38],
		iconAnchor: [20, 0]
	});

	const orange = L.icon({
		iconUrl: 'icons/orange.png',
		iconSize: [38, 38],
		iconAnchor: [20, 0]
	});

	const red = L.icon({
		iconUrl: 'icons/red.png',
		iconSize: [38, 38],
		iconAnchor: [20, 0]
	});

	const blue = L.icon({
		iconUrl: 'icons/blue.png',
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
					var marker = L.marker(L.latLng(arr1[0].loc[0], arr1[0].loc[1]), {icon: green}, {id:arr1[0].id}).addTo(map)
				} else if (num >= 33 && num <= 65) {
					var marker = L.marker(L.latLng(arr1[0].loc[0], arr1[0].loc[1]), {icon: orange}, {id:arr1[0].id}).addTo(map)
				} else if (num >= 66) {
					var marker = L.marker(L.latLng(arr1[0].loc[0], arr1[0].loc[1]), {icon: red}, {id:arr1[0].id}).addTo(map)
				} else {
					var marker = L.marker(L.latLng(arr1[0].loc[0], arr1[0].loc[1]), {icon: blue}, {id:data[i].id}).addTo(map)
				}

				marker.bindPopup("Name: '" + arr1[0].name + "'<br> Address: " + arr1[0].address + "<br>Traffic: " + Math.round(calc(arr1[0].popular_times)));
				map.setView([arr1[0].loc[0], arr1[0].loc[1]], 20);
			}

			function calc(arr){
				let nextTwoHours = [];
				nextTwoHours.push(parseInt(arr[date.getHours()]), parseInt(arr[date.getHours() + 1]), parseInt(arr[date.getHours() + 2]));
				return nextTwoHours.reduce((a, b) => a + b)/3
			}
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