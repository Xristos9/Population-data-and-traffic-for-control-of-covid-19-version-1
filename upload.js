function readFile(input) {
	const file = new FileReader()
	file.readAsText(input.files[0])

	file.onload = function(e) {
		const data = JSON.parse(e.currentTarget.result)
		console.log(data)

		let E = []


		for(var i in data){
			entries = {}
			entries.day = []
			entries.data = []
			entries.id = data[i].id
			entries.name = data[i].name
			entries.address = data[i].address
			entries.rating = data[i].rating
			entries.rating_n = data[i].rating_n
			entries.lat = data[i].coordinates.lat
			entries.lng = data[i].coordinates.lng
			entries.types = data[i].types.toString()

			for (var j in data[i].populartimes){
				entries.day.push(data[i].populartimes[j].name)
				entries.data.push(data[i].populartimes[j].data)
			}

			E.push(entries)
		}
		console.log(E)

		document.getElementById("up").addEventListener("click", function() {
			$.ajax({
				url: "uploadBE.php",
				type: "POST",
				data: {kati:JSON.stringify(E)},
				success: function(data) {
					console.log(data)
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
		})
	}

	file.onerror = function() {
		console.log(reader.error);
	};
}


function onDelete(){
	// console.log(1)
	if(confirm("Are you sure that you want to nuke the server?")){

		const ajax = $.ajax({
			url: "delete.php",
			type: "POST",
			data: {kati:1},
			success: function(data) {
				console.log(data)
				alert("Server nuked successfully")
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
	}
}