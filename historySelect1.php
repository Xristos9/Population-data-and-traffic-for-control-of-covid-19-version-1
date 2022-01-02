<?php
	include "dbConn.php";
	session_start();
	$u = $_SESSION["userID"];

	$query = mysqli_query($db, "SELECT `Name`,`Date_of_upload` FROM `user_visits` WHERE `User_id`= $u");
	$array = array();
	if (mysqli_num_rows($query) > 0) {
		while($row = mysqli_fetch_assoc($query)) {
			array_push($array, array('name'=>$row['Name'], 'date' => $row['Date_of_upload']));
		}
	}

	echo json_encode($array,true);