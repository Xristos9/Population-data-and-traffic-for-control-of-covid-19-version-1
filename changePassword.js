function changeP(){
	const oldPWD= document.getElementById("t1").value;
	const newPWD= document.getElementById("t2").value;
	const cpwd= document.getElementById("t3").value;

	const pwd_expression = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-])/;


	if(oldPWD==''){
		alert('Please enter your Old Password');
	}else if(newPWD==''){
		alert('Please enter the new Password');
	}else if(cpwd==''){
		alert('Please Confirm Password');
	}else if(!pwd_expression.test(newPWD)){
		alert ('Upper case, Lower case, Special character and Numeric letter are required in Password');
	}else if(newPWD != cpwd){
		alert ('Passwords do not Matched');
	}else if(document.getElementById("t2").value.length < 8){
		alert ('Password minimum length is 8');
	}else if(document.getElementById("t2").value.length > 20){
		alert ('Password max length is 20');
	}else{

		const upload = $.ajax({
			url: 'changePasswordBE.php',
			method: 'POST',
			data: {oldPassword: oldPWD, newPassword: newPWD}
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
			alert('Your password has been updated successfully')
			window.location.assign("user_set.php")
		}else if(res == 1){
			alert('Your password has been updated successfully')
			window.location.assign("adminUserSet.php") 
		}else if(res == 2){
			alert('Incorrect password')
		}else if(res == 3){
			alert('An unexpected error has been occurred')
			window.location.assign("index.html")
		}
	}


}