<?php

include "dbConn.php";
session_start();

$query = mysqli_query($db, "SELECT `clientID`,`Date` FROM `covid_cases` ORDER BY `covid_cases`.`Date` DESC");
$array = array();
if (mysqli_num_rows($query) > 0) {
	while($row = mysqli_fetch_assoc($query)) {
		array_push($array,array('id'=>$row['clientID'], 'date' => $row['Date']));
	}
}
// print_r($array);
echo json_encode($array,true);