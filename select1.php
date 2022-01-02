<?php

include "dbConn.php";
session_start();
// $u = $_SESSION["userID"];
$array = array();
$query = mysqli_num_rows(mysqli_query($db, "SELECT `id_store` FROM `user_visits`"));
$query2 = mysqli_num_rows(mysqli_query($db, "SELECT `ID` FROM `covid_cases`"));

$query3 = mysqli_query($db, "SELECT `clientID`,`Date` FROM `covid_cases` ORDER BY `covid_cases`.`Date` DESC");
$array1 = array();
if (mysqli_num_rows($query3) > 0) {
	while($row = mysqli_fetch_assoc($query3)) {
		array_push($array1, array('id' =>  $row['clientID'], 'date' => $row['Date']));
	}
}

$array2 = array();
for($i=0; $i<count($array1); $i++){
	$u = $array1[$i]['id'];
	$date = date($array1[$i]['date']);
	$date2 = date('Y-m-d', strtotime('-7 day', strtotime($date)));
	$date3 = date('Y-m-d', strtotime('+14 day', strtotime($date)));
	$query4 = mysqli_query($db, "SELECT `visit_id` FROM `user_visits` WHERE `User_id`= $u AND `Date_of_upload` BETWEEN DATE('$date2') AND DATE('$date3')");
	if (mysqli_num_rows($query4) > 0) {
		while($row = mysqli_fetch_assoc($query4)) {
			array_push($array2,$row['visit_id']);
		}
	}
}
// print_r($array2);
$unique = count(array_unique($array2));
// print_r($unique);

array_push($array, $query,$query2,$unique);
echo json_encode($array,true);