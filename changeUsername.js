function changeU(){
	const oldName= document.getElementById("t1").value;
	const newName= document.getElementById("t2").value;
	const cName= document.getElementById("t3").value;

	const pwd_expression = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-])/;


	if(oldName==''){
		alert('Please enter your Old Username');
	}else if(newName==''){
		alert('Please enter the new Username');
	}else if(cName==''){
		alert('Please Confirm Username');
	}else if(newName != cName){
		alert ('Usernames do not Matched');
	}else{

		const upload = $.ajax({
			url: 'changeUsernameBE.php',
			method: 'POST',
			data: {oldUsername: oldName, newUsername: newName}
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

	function success(res){
		if(res == 0){
			alert('Your Username has been updated successfully')
			window.location.assign("user_set.php")
		} else if(res == 1){
			alert('Incorrect Username')
			window.location.assign("user_set.php")
		}else if(res == 2){
			alert('An unexpected error has been occurred')
			window.location.assign("index.html")
		}
	}


}