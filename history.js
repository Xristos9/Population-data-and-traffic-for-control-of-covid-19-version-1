const completelist= document.getElementById("thelist");
const completelist2= document.getElementById("thelist2");
window.onload = function() {

	const ajax =  $.ajax({
		url: 'historySelect1.php',
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
			console.log(res[i].name)
			completelist.innerHTML += "<li>Store name: "+ res[i].name + "<br>Date: "+ res[i].date+ "</li>";
		}
		
		for(var i=0; i<3; i++){
			
			completelist.innerHTML += "<br>";
		}
		document.getElementById("text").innerHTML = "Your covid declaration dates:"

		asyncCall()
	}
	
	function asyncCall() {

		const ajax2 =  $.ajax({
			url: 'historySelect2.php',
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
	
		ajax2.done(leadros2)
	
		function leadros2(res){
			for(var i in res){
				console.log(res[i])
				completelist2.innerHTML += "<li>Date: "+ res[i]+ "</li>";
			}
		}
	}
}