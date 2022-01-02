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


	$query = mysqli_query($db, "SELECT * FROM users WHERE username='$uname' AND password='$pass' ");

	if(mysqli_num_rows($query) === 1) {
		$row = mysqli_fetch_assoc($query);
		if($row['username'] === $uname && $row['password'] === $pass){
			$_SESSION['username'] = $row['username'];
			$_SESSION['email'] = $row['email'];
			$_SESSION['userID'] = $row['userID'];
			$_SESSION['isAdmin'] = $row['isAdmin'];

			if($row['isAdmin']){
				echo 1;
				exit();
			} else{
				echo 0;
				exit();
			}

		}else{
			echo 2;
			exit();
		}

	} else{
		echo 3;
		exit();
	}
