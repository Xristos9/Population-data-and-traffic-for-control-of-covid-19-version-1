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
				success: function(res) {
					console.log(res)
				}
			})
		})
	}

	

	file.onerror = function() {
		console.log(reader.error);
	};
}