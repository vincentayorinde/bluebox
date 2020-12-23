<?php 

$localhost = "localhost";
$username = "root";
$password = "";
$dbname = "as_tw";

// create connection
$connect = new mysqli($localhost, $username, $password, $dbname);

// check connection
if($connect->connect_error) {
	die("connection failed : " . $connect->connect_error);
} else {
	// echo "Successfully Connected";
}
 $name = 'BlueBox System - Tema west';
 $print_name = "TEMA WEST MUNICIPAL ASSEMBLY";
 $moto = "(TWMA)";
 $enquires = "For enquires contact 024 428 5786 or 024 438 6896";
 $pay = "Pay this bill on or before ________________";
?>