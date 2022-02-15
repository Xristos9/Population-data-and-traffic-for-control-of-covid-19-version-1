<?php
	session_start();

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: index.html');
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Sympols -->
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Admin Home</title>
</head>
<body>
	<?php include "adminHeader.php"; ?>

	<div class="page-wrapper">
	<!-- logged in user information -->
		<?php if (isset($_SESSION['username'])) : ?>
			<h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
		<?php endif ?>
		<p>You visited these stores:</p>
		<br>
		<ul id="thelist"></ul>
		<!-- <br><br><br> -->
		<p id="text"></p>
		<br>
		<ul id="thelist2"></ul>
	</div>

	<script type="text/javascript" src="history.js"></script>

	<?php include "footer.php";?>
</body>
</html>