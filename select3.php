<?php
	include "dbConn.php";
	session_start();

	$result = mysqli_query($db, "SELECT v.id_store FROM covid_cases AS c INNER JOIN user_visits AS v WHERE c.clientID=v.User_id");
	$storeIDs = array();
	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			array_push($storeIDs, $row['id_store']);
		}
	}
	
	$array4 = array();

	foreach($storeIDs as $f){
		$result4 = mysqli_query($db, "SELECT `types` FROM `stores` WHERE `id`= '$f'");
		if (mysqli_num_rows($result4) > 0) {
			while($row = mysqli_fetch_assoc($result4)) {
				array_push($array4, $row['types']);
			}
		}
	}
	echo json_encode($array4,true);

?>