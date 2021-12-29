<?php

$sname = "localhost";
$uname = "root";
$password = "";
$db_name = "web";

$db = mysqli_connect($sname, $uname, $password, $db_name);

if(!$db){
	echo "Connection failed!";
}
?>