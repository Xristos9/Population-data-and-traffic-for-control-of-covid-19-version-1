<?php
	include "dbConn.php";
	session_start();

	$result = mysqli_query($db, "SELECT s.types FROM stores AS s INNER JOIN user_visits AS v WHERE s.id=v.id_store");
	$types = array();
	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			array_push($types, $row['types']);
		}
		echo json_encode($types,true);
	}
?>