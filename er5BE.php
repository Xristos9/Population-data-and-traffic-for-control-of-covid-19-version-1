<?php

include "dbConn.php";
session_start();

$u = $_SESSION["userID"];
$k = $_POST["key"];
$k = new Datetime($k);
$date1 = $k->format('Y-m-d');

// print_r($date1);

$sql = "INSERT INTO `covid_cases`(`clientID`, `Date`) VALUES ('$u','$date1')";

	if (mysqli_query($db, $sql)) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . mysqli_error($db);
	}