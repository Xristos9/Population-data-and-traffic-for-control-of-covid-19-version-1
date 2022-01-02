function login(){
	const uname= document.getElementById("t1").value;
	const pwd= document.getElementById("t2").value;

	if(uname==''){
		alert('Please enter the username.');
	}else if(pwd==''){
		alert('Please enter Password');
	}else{

		const upload = $.ajax({
			url: 'loginBE.php',
			method: 'POST',
			data: {username: uname, password: pwd}
			,
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
		});
		upload.done(success);
	}

}

function success(res){
	if(res == 0){
		window.location.assign("home.php")
	} else if(res == 1){
		window.location.assign("adminHome.php")
	}else if(res == 2){
		alert('Incorrect username or password')
	}else if(res == 3){
		alert('Incorrect username or password')
	}
}


