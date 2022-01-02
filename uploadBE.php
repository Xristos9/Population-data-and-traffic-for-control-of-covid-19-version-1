<?php
	include "dbConn.php";
	session_start();

	$k = json_decode($_POST["kati"], true);
	// print_r($k);

	foreach($k as $row){

		$query = mysqli_query($db, "SELECT `id` FROM `data_pop` WHERE `id` = '".$row['id']."'");
		if (mysqli_num_rows($query) == 0) {
			for ($j = 0; $j <=6; $j++){
				$day = $row['day'][$j];
	
				$sql = "INSERT INTO `data_pop` (`id`,`day`, `data_0`,`data_1`,`data_2`,`data_3`,`data_4`,`data_5`,`data_6`,`data_7`,`data_8`,`data_9`,`data_10`,`data_11`,`data_12`,`data_13`,`data_14`,`data_15`,`data_16`,`data_17`,`data_18`,`data_19`,`data_20`,`data_21`,`data_22`,`data_23`) VALUES ('".$row['id']."','$day','".$row['data'][$j][0]."','".$row['data'][$j][1]."','".$row['data'][$j][2]."','".$row['data'][$j][3]."','".$row['data'][$j][4]."','".$row['data'][$j][5]."','".$row['data'][$j][6]."','".$row['data'][$j][7]."','".$row['data'][$j][8]."','".$row['data'][$j][9]."','".$row['data'][$j][10]."','".$row['data'][$j][11]."','".$row['data'][$j][12]."','".$row['data'][$j][13]."','".$row['data'][$j][14]."','".$row['data'][$j][15]."','".$row['data'][$j][16]."','".$row['data'][$j][17]."','".$row['data'][$j][18]."','".$row['data'][$j][19]."','".$row['data'][$j][20]."','".$row['data'][$j][21]."','".$row['data'][$j][22]."','".$row['data'][$j][23]."')";
	
				if (mysqli_query($db, $sql)) {
					echo "New record created successfully";
				} else {
					echo "Error: " . $sql . mysqli_error($db);
				}
			}
		} else {
			echo 'crap	';
		}


		$sql = "INSERT INTO stores (id, Name, Address,Rating,Rating_number,lat,lng,types) VALUES ('".$row['id']."', '".$row['name']."', '".$row['address']."', '".$row['rating']."', '".$row['rating_n']."','".$row['lat']."','".$row['lng']."','".$row['types']."')";

		if (mysqli_query($db, $sql)) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . mysqli_error($db);
		}
	}
?>