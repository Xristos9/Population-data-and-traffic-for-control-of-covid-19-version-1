var completelist= document.getElementById("thelist");
window.onload = function() {

	const ajax =  $.ajax({
		url: 'covidBE.php',
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
		for(var i in res){
			completelist.innerHTML += "<li>Store name: "+ res[i].Name + "<br>Date: "+ res[i].date+ "</li>";
		}
	}
}