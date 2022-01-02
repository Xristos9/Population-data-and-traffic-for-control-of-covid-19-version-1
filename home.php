<?php
	session_start();

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: index.html');
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Sympols -->
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Home</title>
</head>
<body>
	<?php include "header.php"; ?>

	<div class="page-wrapper">
	<!-- logged in user information -->
		<?php if (isset($_SESSION['username'])) : ?>
			<h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
		<?php endif ?>
	</div>
	
	<?php include "footer.php";?>
</body>
</html>