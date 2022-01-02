<?php

session_start();
include "dbConn.php";

	function validate($data){
		$data = trim($data); //remove spaces
		$data = stripslashes($data); //remove quotes -> read as text
		$data = htmlspecialchars($data);
		return $data;
	}

	$uname = validate($_POST['username']);
	$pass = validate($_POST['password']);
	$email = validate($_POST['email']);

	$query = mysqli_query($db, "SELECT * FROM users WHERE username='$uname'");
	$query2 = mysqli_query($db, "SELECT * FROM users WHERE email='$email'");

	if(mysqli_num_rows($query) > 0) {
		echo 0;
		exit();
	} elseif(mysqli_num_rows($query2) > 0){
		echo 1;
		exit();
	} else{
		$query3 = mysqli_query($db, "INSERT INTO users(username, email, password) VALUES('$uname', '$email', '$pass')");

		if($query3) {
			echo 2;
			exit();
		} else{
			echo 3;
			exit();
		}
	}