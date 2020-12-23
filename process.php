<?php
error_reporting(1);
  // Create Connection
require_once 'db/config.php';


//Check for POS1t Variable
if(isset($_POST['rateable_value'])){
   // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                         // $userid             = $_POST['userid'];
                         // $uemail             = $_POST['uemail'];
                         $pro_acct_no        = $_POST['pro_acct_no'];
                         $rateable_value     = $_POST['rateable_value'];
                         $rate_impose        = $_POST['rate_impose'];
                         $rate_charge        = $_POST['rate_charge'];
                         $arrears            = $_POST['arrears'];
                         $payment            = $_POST['payment'];
                         $adjustment         = $_POST['adjustment'];
                         $total_amount_due   = $_POST['total_amount_due'];
                         $a_paid             = $_POST['amt_paid'];
                         $amt_paid_     = $payment + $a_paid;

     // Update quote exists
                        $query = "UPDATE property 
                        SET rateable_value='$rateable_value', rate_impose='$rate_impose',rate_charge='$rate_charge',arrears='$arrears',payment='$payment',adjustment='$adjustment',total_amount_due='$total_amount_due', amt_paid='$amt_paid_' WHERE pro_acct_no='$pro_acct_no' ";
                                $result = mysqli_query($connect,$query);
                                if($result){
                                $msg = '<div class="alert alert-success">Date recorded successfully <a class="btn btn-info waves-effect" href="all-rates">See List</a></div>';
                                //header("location:updatequote");
                                  }else{
                                        $msg = '<div class="alert alert-danger">Error updating data!</div>';
                                  }
}

// //Check for GET Variable
// if(isset($_GET['name'])){
//   echo 'GET: Your name is '. $_GET['name'];
// }

 ?>