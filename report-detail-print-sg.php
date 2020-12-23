<?php 
error_reporting(0);
session_start();
$GLOBALS['no'];
require_once 'db/config.php';
    if(isset($_SESSION['is_logged_in']) != true){
            header("Location: sign-in");
    }
     if(isset($_SESSION['user_data']['user_role']) == "agent" || $_SESSION['user_data']['user_role'] == "adminxz"){
        $email      =  $_SESSION['email'];
        $first_name =  $_SESSION['user_data']['first_name'];
        $last_name  =  $_SESSION['user_data']['last_name'];
        $user_id    =  $_SESSION['user_data']['id'];
    }
          if ($_GET['sd']){
                  $sd = $_GET['sd'];
                  $ed = $_GET['ed'];

                  $sqlnewt = "SELECT sum(paid) as p_total, id, signage_acct_no FROM signage_payment WHERE date_ >= '$sd' AND date_ <= '$ed' AND activ = 'Y' order by id asc";
                  $resultnewt = $connect->query($sqlnewt);
                  $datat = $resultnewt->fetch_assoc();

                   $sql = "SELECT * FROM signage_payment WHERE date_ >= '$sd' AND date_ <= '$ed' AND activ = 'Y' order by id asc";
                                            $result = $connect->query($sql);
                                          
                                            if($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) {
                                                     $p_no = $row['signage_acct_no'];
                                                   
                                                     "<tr>
                                                    <td>" .$row['signage_acct_no']."</td>
                                                     <td>" .$row['rev_type_code']."</td>
                                                    <td>" .$row['rate_impost']."</td>
                                                    <td>" .$row['rate_charge']."</td>
                                                    <td>" .$row['paid']."</td>
                                                    <td>" .$row['arrears']. "</td>
                                                    <td>" .$row['payment_mode']."</td>
                                                    <td>" .$row['gcr']."</td>
                                                    ";
                                                     $GLOBALS['no']++;

                                                }
                                              
                                            }

                // $sqlnew = "SELECT id,b_no,b_name,payment_mode,paid,bal,b_charge,arrears,bank,cheque_no,gcr,user_id,user_email FROM property_payment";
                //   $resultnew = $connect->query($sqlnew);
                //   $data = $resultnew->fetch_assoc();


                //   $sqlnewp = "SELECT * FROM property WHERE pro_acct_no = '$b_no'";
                //   $resultnewp = $connect->query($sqlnewp);
                //   $datap = $resultnewp->fetch_assoc();


                     // if($data){
                     //    $sql_ = "SELECT * FROM bill ORDER BY id DESC LIMIT 1";
                     //       $result_ = $connect->query($sql_);
                     //         $row_ = $result_->fetch_assoc();
                     //            if($result_->num_rows > 0){
                     //             $new_bill_no = $row_['bill_no'] + 1; // piece2
                     //             $message = "New bill generated for property " . $data['pro_acct_no']; 
                     //             $query = "INSERT INTO bill (bill_no,message,user_id) VALUES ('$new_bill_no','$message', $user_id)";
                     //             $result = mysqli_query($connect,$query);                                        
                     //    // $msg = '<div class="alert alert-success">Data Added successfully <a class="btn btn-info waves-effect" href="all-business">See List</a></div>';

                     //     }
                     // }
    }
    ?>
<!DOCTYPE html>
<html>
<head>
	<title>Report - <?php echo $name; ?></title>
</head>
<style type="text/css" media="print">
@page {
    size: auto;   /* auto is the initial value */
    margin: 0;  /* this affects the margin in the printer settings */
}
</style>
<style>

	@media print {
	  #printPageButton {
	    display: none;
	  }
	  #button-back{
	  	display: none;
	  }
	}
	.button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 10px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 12px;
}
	.button-back {
    background-color: red; /* Green */
    border: none;
    color: white;
     padding: 10px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 12px;
}
	tr{
		height: 20px;
	}
	table{
		border: 0px solid black;
		border-radius: 5px;

	}
	table#title_bill{
		border: 0px solid black;
		border-radius: 5px;

	}
	td.title{
		padding-top: 0px;
		border: 0px;
	}
	#topic td{
		border: 1px solid black;
		border-radius: 5px;
	}
	tr{
		border: 0.1px solid black;
	}
	body{
		background-color: blue;
		margin: 0;
		padding: 0;
	}
	#wrapper{
		margin: auto;
		width:620px;
		font-family: sans-serif;
		font-size: 11px;
		background-color: white;
		padding: 15px;
	}
	.space{
		height: 50px;
	}
	#bill{
		margin-top: 2px;
		border: 1px solid blue;
		border-radius: 5px;
	}
	#bop{
		margin: 0px;
		color: red;
	}
</style>
<body>
	<div id="wrapper">
	<a  href="#" onclick="location.href = document.referrer; return false;" id="button-back" class="button-back">Back</a>
	<button id="printPageButton" class="button" onclick="window.print()">Print Report</button>
	<div id="bill">
	<table id="title_bill" align="center">
	<tr>
		<td class="title"><img width="60" height="60" title="Coat of Arm" src="images/arm.png"></td>
		<td class="title">
			<center>
			<h2 style="color: blue">REPORT</h2>
				<h3 style="color: blue">From <?php echo $sd; ?> to <?php echo $ed ?></h3>
			</center>
		</td>
	 	<!-- <td class="title"><img width="70" height="70" title="Krowor Municipal Assembly" src="images/krowor_logo.png"></td> -->
	</tr>
	</table>
	<H1 id="bop">SIGNAGE REPORT </H1> <strong> <span style="float: right;padding-right: 15px;">GENERATED ON: <?php echo date('Y-m-d'); ?></span></strong>
	<br><br>
<table id="topic" border="0" width="620" cellpadding="5">
	<tr>
		<td colspan="3"><strong>TOTAL ENTRIES MADE:</strong><br> <h1> <?php if($GLOBALS['no'] = $no){echo  $GLOBALS['no'] = $no;}else{echo "0";}?></h1></td>
		<td colspan="3"><strong>PAYMENTS COLLECTED (Value):</strong><br> <h1>GHS <?php if($datat['p_total']){echo $datat['p_total'];}else{echo "0";}?></h1></td>
				<td colspan="3"><strong>GENERATED BY:</strong><br> <h1><?php echo $first_name; ?></h1> </td>
	</tr>
	
</table>
	  <table border="1" width="100%">
                                     <?php echo $msg;
                                             if($_SESSION['user_data']['user_role'] == "adminxz"){

                                                ?>
                                    <thead>
                                        <tr>
                                                    <th>No</th>
                                                    <th>Acct. No.</th>
                                                    <th>Rev Code</th>
                                                    <th>Impose</th>
                                                    <th>Charge</th>
                                                    <th>Paid</th>
                                                    <th>Arrears</th>
                                                    <th>MoP</th>
                                                    <th>GCR</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                                 <th>No</th>
                                                    <th>Acct. No.</th>
                                                    <th>Rev Code</th>
                                                    <th>Impose</th>
                                                    <th>Charge</th>
                                                    <th>Paid</th>
                                                    <th>Arrears</th>
                                                    <th>MoP</th>
                                                    <th>GCR</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                      <?php
                                             $GLOBALS['no']    = 1;
                                            $email = $_SESSION['email'];
                                           
                                  $sql = "SELECT * FROM signage_payment WHERE date_ >= '$sd' AND date_ <= '$ed' AND activ = 'Y' order by id asc";
                                            $result = $connect->query($sql);
                                          
                                            if($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) {
                                                     $p_no = $row['pro_acct_no'];
                                                   
                                                            echo "<tr>
                                                    <td>".  $GLOBALS['no'] ."</td>

                                                     <td>" .$row['signage_acct_no']."</td>
                                                     <td>" .$row['rev_type_code']."</td>
                                                    <td>" .$row['rate_impost']."</td>
                                                    <td>" .$row['rate_charge']."</td>
                                                    <td>" .$row['paid']."</td>
                                                    <td>" .$row['arrears']. "</td>
                                                    <td>" .$row['payment_mode']."</td>
                                                    <td>" .$row['gcr']."</td>
                                                    ";
                                                     $GLOBALS['no']++;

                                                }
                                              
                                            } else {
                                                echo "<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
                                            }
                                        }
                                                  ?>
                                        </tbody>
</div>
</div>
</body>
</html>