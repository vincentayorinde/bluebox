<?php
$connect = new PDO("mysql:host=localhost;dbname=as_ama_", "root", "");

$column = array('pro_acct_no', 'rateable_value', 'rate_impose', 'rate_charge', 'arrears', 'paid', 'total_amt_due', 'bal', 'payment_mode', 'bank', 'cheque_no', 'gcr', 'user_id', 'user_email', 'date_added');

 $sql = "SELECT * FROM property_payment";

if(isset($_POST['filter_gender'], $_POST['filter_country']) && $_POST['filter_gender'] != '' && $_PSOT['filter_country'] != ''){
	$sql .= 'WHERE gender = "'.$_POST['filter_gender'].'" AND country = "'.$_POST['filter_country'].'"'
}

if(isset($_POST['order'])){
 	$sql .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir']. ' ';
}else{
	$sql .= 'ORDER BY id DESC';
}

$sql1 = '';

if($_POST['length'] != -1){
	$sql1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($sql);
$statement->execute();
$number_filter_row = $connect->rowCount();
$statement = $connect->prepare($sql . $sql1);
$statement->execute();
$result = $statement->fetchAll();
$data = array();

foreach($result as $row){
	$sub_array = array();
	$sub_array[] = $row['pro_acct_no'];
	$sub_array[] = $row['rateable_value'];
	$sub_array[] = $row['rate_impose'];
	$sub_array[] = $row['rate_charge'];
	$sub_array[] = $row['arrears'];
	$sub_array[] = $row['paid'];
	$data[] = $sub_array;

}

function count_all_data($connect){
	$query = "SELECT * FROM property_payment";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

$output  = array(

	'draw' => , inval($_POST['draw']),
	'recordsTotal' => count_all_data($connect),
	'recordsFiltered' => $number_filter_row,
	'data' 				=> $data
);

echo json_encode($output);

?>