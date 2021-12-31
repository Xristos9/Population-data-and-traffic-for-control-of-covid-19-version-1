<?php

	include "dbConn.php";
	session_start();

	// $u = $_SESSION["userID"];
	$k = $_POST["key"];
	$lat = $k['lat'];
	$lng = $k['lng'];
	$name = $k['name'];
	$address = $k['address'];
	$id = $k['id'];
	$estimation = $k['estimate'];

	print_r($k);

	$sql = "INSERT INTO `user_visits`(`User_id`, `id_store`, `Address`, `Name`, `lat`, `lng`, `estimation`) VALUES ('210','$id','$address','$name','$lat','$lng','$estimation')";

	if (mysqli_query($db, $sql)) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . mysqli_error($db);
	}