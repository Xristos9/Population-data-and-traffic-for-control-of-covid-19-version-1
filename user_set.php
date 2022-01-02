<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Sympols -->
		<link rel="stylesheet" type="text/css" href="style.css">
		<title>User Info</title>
	</head>

	<body>

	<?php include "header.php"; ?>

	<div class="page-wrapper">
		<h1>Hello, <?php echo $_SESSION['username']; ?></h1>

		<button class="uBt" onclick="window.location.href='changePassword.php'">Change Password</button>
		<br>
		<br>
		<button class="uBt" onclick="window.location.href='changeUsername.php'">Change Username</button>
		<br>
		<br>
		<button class="uBt" onclick="window.location.href='logout.php'">Logout</button>

		<br>
		<br>
		<p>You visited these stores were there was a reported covid case:</p>
		<br/><br/>
		<ul id="thelist"></ul>

	</div>
	<script type="text/javascript" src="covid.js"></script>
	<?php include "footer.php";?>

	</body>
</html>