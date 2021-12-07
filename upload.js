function readFile(input) {
	const file = new FileReader()
	file.readAsText(input.files[0])

	file.onload = function(e) {
		const data = JSON.parse(e.currentTarget.result)
		console.log(data)
		
		document.getElementById("up").addEventListener("click", function() {
			$.ajax({
				url: "uploadBE.php",
				type: "POST",
				data: {kati:e.currentTarget.result},
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


