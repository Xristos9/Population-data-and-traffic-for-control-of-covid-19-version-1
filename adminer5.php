
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Sympols -->
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>er5</title>
</head>
<body>
<?php include "adminHeader.php"; ?>

<br/><br/>
	<div class="page-wrapper">
		<label>
			When did u test positive for covid:
			<input type="date" id="covid" min="2021-10-01" max="2022-12-31" required>
			<span class="validity"></span>
		</label>

		<p>
			<button class="uBt" onclick="onSubmit()">Submit</button>
		</p>

	</div>

	<?php include "footer.php";?>
<script>

	const cu_date = new Date();

	function onSubmit(){
		const de_date = new Date(document.getElementById('covid').value)
		const ajax =  $.ajax({
			url: 'er5select.php',
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
			// console.log(res[0])

			a = new Date(res[0])
			var c = new Date(a.getTime());
			c.setDate(c.getDate()+14);
			if(de_date> cu_date){
				alert('Please dont select future dates')
			} else if(de_date<c && de_date>=a){
				alert('Please wait 14 days before you can declare again')
			} else if(de_date<a){
				alert('You have to choose a date thats after your last declaration')
			}else{
				var date = de_date.getFullYear()+'-'+(de_date.getMonth()+1)+'-'+de_date.getDate();
				// console.log(de_date)
				$.ajax({
				url: 'er5BE.php',
				method: 'POST',
				data: {
					key: date
				},
				success: function(data) {
					console.log(data)
					alert("Thank you")
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
			}
		}
	}
</script>
</body>
</html>