<?php

include "dbConn.php";
session_start();
$u = $_SESSION["userID"];

$query = mysqli_query($db, "SELECT `Date` FROM `covid_cases` WHERE `clientID` = $u ORDER BY `covid_cases`.`Date` DESC");
$array = array();
if (mysqli_num_rows($query) > 0) {
	while($row = mysqli_fetch_assoc($query)) {
		array_push($array,$row['Date']);
	}
}
// print_r($array);
echo json_encode($array,true);