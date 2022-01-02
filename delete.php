<?php

	session_start();
	include "dbConn.php";

	if(isset($_POST['kati'])){

		$sql = "DELETE FROM `stores`";

		if ($db->query($sql) === TRUE) {
		echo "Record deleted successfully";
		} else {
		echo "Error deleting record: " . $db->error;
		}

		$sql2 = "DELETE FROM `data_pop`";

		if ($db->query($sql2) === TRUE) {
		echo "Record deleted successfully";
		} else {
		echo "Error deleting record: " . $db->error;
		}

	}else {
		echo "Unexpected error";
	}