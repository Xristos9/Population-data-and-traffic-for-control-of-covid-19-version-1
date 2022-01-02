<?php
session_start();

if(isset($_SESSION['userID']) && isset($_SESSION['username'])){

	include "dbConn.php";

	if (isset($_POST['oldPassword']) && isset($_POST['newPassword'])){

		function validate($data){
			$data = trim($data); //remove spaces
			$data = stripslashes($data); //remove quotes -> read as text
			$data = htmlspecialchars($data);
			return $data;
		}

		$op = validate($_POST['oldPassword']);
		$np = validate($_POST['newPassword']);


		$id = $_SESSION['userID'];

		$result = mysqli_query($db,"SELECT password FROM users WHERE userID='$id' AND password='$op'");

		if(mysqli_num_rows($result) === 1){

			$result2 = mysqli_query($db,"UPDATE users SET password='$np' WHERE userID='$id'");
			if($_SESSION['isAdmin']){
				echo 1;
				exit();
			} else{
				echo 0;
				exit();
			}

		} else{
			echo 2;
			exit();
		}


	} else {
		echo 3;
		exit();
		}

} else{
	echo 3;
	exit();
}