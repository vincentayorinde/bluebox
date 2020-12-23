<?php

  // Create Connection
require_once 'db/config.php';
 $q = $_GET['q'];
  //Query Dat
  $query = "SELECT * FROM property WHERE pro_acct_no =  $q";
 //Get Result
  $result = mysqli_query($connect, $query);

//   //Fetch Data
//   while($row = mysqli_fetch_assoc($result)) {
//                         echo $row['rateable_value'];
//                         echo $row['rate_impose'];
//                         echo $row['rate_charge'];
//                         echo $row['arrears'];
//                         echo $row['payment'];
//                         echo $row['adjustment'];
//                         echo $row['total_amount_due'];
// }
  $properties = mysqli_fetch_all($result, MYSQLI_ASSOC);


  echo json_encode($properties);


?>