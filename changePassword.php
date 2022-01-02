<?php
session_start();

// if(isset($_SESSION['userID']) && isset($_SESSION['username'])){
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> <!--include jquery - use ajax -->
	<script src="changePassword.js"></script>
	<link rel="stylesheet" type="text/css" href="login.css">
	<title>Change Password</title>
</head>

<body>

	<!-- Main div code -->
	<div id="main">
	<div class="h-tag">
		<h2>Create Your Account</h2>
	</div>
	<!-- create account div -->
	<div class="login">
		<table cellspacing="2" align="center" cellpadding="8" border="0">
			<tr>
			<td align="right">Old Password: </td>
			<td><input type="password" placeholder="Old Password" id="t1" class="tb" /></td>
			</tr>
			<tr>
			<td align="right">New Password:</td>
			<td><input type="password" placeholder="New Password" id="t2" class="tb" /></td>
			</tr>
			<tr>
			<td align="right">Confirm New Password:</td>
			<td><input type="password" placeholder="Confirm New Password" id="t3" class="tb" /></td>
			</tr>
			<tr>
			<td></td>
			<td>
			<!-- <a href="user_set.php" class="ca">Back</a> -->
			<button class="uBt" onclick="changeP()" >Change</button>
			</td>
			</tr>
		</table>
	</div>
	<!-- create account box ending here.. -->
	</div>
	<!-- Main div ending here... -->

</body>
</html>

<?php
// } else{
// 	header("Location: index.php");
// 	exit();
// }
?>