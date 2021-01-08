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
 $enquires = "For enquires contact 024 428 5786";
 $pay = "Pay this bill on or before ________________.<br>
 You can pay your bill through this momo merchant code: 350 532";
?>