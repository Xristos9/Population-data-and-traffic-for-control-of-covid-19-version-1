<?php
session_start();

if(isset($_SESSION['userID']) && isset($_SESSION['username'])){

	include "dbConn.php";

	if (isset($_POST['oldUsername']) && isset($_POST['newUsername'])){

		function validate($data){
			$data = trim($data); //remove spaces
			$data = stripslashes($data); //remove quotes -> read as text
			$data = htmlspecialchars($data);
			return $data;
		}

		$ou = validate($_POST['oldUsername']);
		$nu = validate($_POST['newUsername']);

		$id = $_SESSION['userID'];

		$result = mysqli_query($db,"SELECT username FROM users WHERE userID=$id AND username='$ou'");

		if(mysqli_num_rows($result) === 1){

			$result2 = mysqli_query($db,"UPDATE users SET username='$nu' WHERE userID='$id'");
			echo 0;
			exit();

		} else{
			echo 1;
			exit();
		}

	} else{
		echo 2;
		exit();
	}


} else{
	echo 2;
	exit();
}