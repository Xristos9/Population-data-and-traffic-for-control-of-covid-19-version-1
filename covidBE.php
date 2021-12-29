<?php
	include "dbConn.php";
	session_start();
	// $user_id = $_SESSION['id'];

	$date = date('Y-m-d');
	$date2 = date('Y-m-d', strtotime('-7 day', strtotime($date)));
	$date3 = date('Y-m-d', strtotime('-14 day', strtotime($date)));


	$query = mysqli_query($db, "SELECT `id` FROM `covid_cases`WHERE `Covid_date` BETWEEN DATE('$date2') AND DATE('$date') ");
	$array = array();
	if (mysqli_num_rows($query) > 0) {
		while($row = mysqli_fetch_assoc($query)) {
			array_push($array,$row['id']);
		}
	}
	// print_r($array);
	$array2 = array();
	foreach($array as $c){
		$query2 = mysqli_query($db, "SELECT `id_store`,`Date_of_upload` FROM `user_visits` WHERE `User_id`= '$c' AND `Date_of_upload` BETWEEN DATE('$date3') AND DATE('$date') ");

		if (mysqli_num_rows($query2) > 0) {
			while($row = mysqli_fetch_assoc($query2)) {
				array_push($array2, array('id'=>$row['id_store'], 'date' => $row['Date_of_upload']));
			}
		}
	}
	// print_r($array2);
	$array3 = array();
	$query3 = mysqli_query($db, "SELECT `id_store`,`Date_of_upload` FROM `user_visits` WHERE `User_id`= '210' AND `Date_of_upload` BETWEEN DATE('$date3') AND DATE('$date') ");

	if (mysqli_num_rows($query3) > 0) {
		while($row = mysqli_fetch_assoc($query3)) {
			array_push($array3, array('id'=>$row['id_store'], 'date' => $row['Date_of_upload']));
		}
	}

	// print_r($array3[0]['date']);
	$storeIDs = array();
	for($i = 0; $i< count($array2); $i++){
		for($j = 0; $j< count($array3); $j++){
			$time = strtotime($array2[$i]['date']);
			$time2 = strtotime($array3[$j]['date']);
			if($array3[$j]['id'] == $array2[$i]['id'] and abs($time - $time2) <= 7200 ){
				array_push($storeIDs, $array3[$j]['id']);
				// print_r('1');
			}
		}
	}

	// print_r($storeIDs);
	$array4 = array();
	foreach ($storeIDs as $key) {
		$query4 = mysqli_query($db, "SELECT * FROM `stores` WHERE `id`= '$key' ");
		if (mysqli_num_rows($query4) > 0) {
			while($row = mysqli_fetch_assoc($query4)) {
				array_push($array4, array('Name' => $row['Name'],'date'=>$row['DATES']));
			}
		}
	}

	print_r($array4);

?>