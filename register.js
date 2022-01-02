function registration(){

	const uname= document.getElementById("t1").value;
	const email= document.getElementById("t2").value;
	const pwd= document.getElementById("t3").value;
	const cpwd= document.getElementById("t4").value;

	//email expression code
	const pwd_expression = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-])/;
	const filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;


	if(email==''){
		alert('Please enter your user email');
	}else if (!filter.test(email)){
		alert('Invalid email');
	}else if(uname==''){
		alert('Please enter the username.');
	}else if(pwd==''){
		alert('Please enter Password');
	}else if(cpwd==''){
		alert('Please Confirm Password');
	}else if(!pwd_expression.test(pwd)){
		alert ('Upper case, Lower case, Special character and Numeric letter are required in Password');
	}else if(pwd != cpwd){
		alert ('Passwords do not Matched');
	}else if(document.getElementById("t4").value.length < 8){
		alert ('Password minimum length is 8');
	}else if(document.getElementById("t4").value.length > 20){
		alert ('Password max length is 20');
	}else{

		const upload = $.ajax({
			url: 'registerBE.php',
			method: 'POST',
			data: {username: uname, password: pwd,email:email}
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
			alert('This username is used, try another one')
		} else if(res == 1){
			alert('This email is used, try another one')
		}else if(res == 2){
			alert('Account has been created successfully')
			window.location.assign("index.html")
		}else if(res == 3){
			alert('An unexpected error has been occurred')
		}
	}
}