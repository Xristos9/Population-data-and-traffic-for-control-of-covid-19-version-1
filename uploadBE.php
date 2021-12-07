<?php
	include "dbConn.php";
	session_start();
	// $u = $_SESSION["id"];
	$k = json_decode($_POST["kati"], true);
	print_r($k);


?>