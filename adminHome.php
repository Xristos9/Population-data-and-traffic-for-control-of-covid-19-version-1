<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Sympols -->
	<link rel="stylesheet" type="text/css" href="style.css"> 
	<title>Admin Home</title>
</head>
<body>
	<?php include "adminHeader.php"; ?>

	<div class="page-wrapper">
		<h1>Welcome, <?php echo $_SESSION['username']; ?></h1>

	</div>

	
	<?php include "footer.php";?>
</body>
</html>

<!-- #autocomplete {
	z-index: 100;
	margin-bottom: 5px;
}
#map {
	height: 100%;
	z-index: 0;
}
		/* date modifier */
label {
	display: flex;
	align-items: center;
}
span::after {
	padding-left: 5px;
}
input:invalid + span::after {
	content: '✖';
}
input:valid+span::after {
	content: '✓';
}
h1 {
	text-align: center;
	color: #222020;
} -->