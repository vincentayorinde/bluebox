<?php 
error_reporting(1);
session_start();
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
          if ($_GET['p_no']){
                  $signage_acct_no = $_GET['p_no'];
                  $id = $_GET['id'];

                   $sqlnewt = "SELECT sum(paid) as p_total,signage_acct_no FROM signage_payment WHERE signage_acct_no = '$signage_acct_no'";
                  $resultnewt = $connect->query($sqlnewt);
                  $datat = $resultnewt->fetch_assoc();

           $sqlnew = "SELECT id,signage_acct_no,rate_impost,rate_charge,arrears,paid,bal,payment_mode,bank,cheque_no,gcr,user_id,user_email,date_added FROM signage_payment WHERE signage_acct_no = '$signage_acct_no' AND id = '$id'";
                  $resultnew = $connect->query($sqlnew);
                  $data = $resultnew->fetch_assoc();
                  $date = date('Y',strtotime($data['date_added']));
                  // if($date != date('Y')){
                  // 	$arrears = $data['arrears'];
                  // }else{
                  // 	$arrears = 0;
                  // }

                  $sqlnewp = "SELECT * FROM signage WHERE signage_acct_no = '$signage_acct_no'";
                  $resultnewp = $connect->query($sqlnewp);
                  $datap = $resultnewp->fetch_assoc();

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
	<title>Signage Rate Bill - <?php echo $name; ?></title>
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
	td{
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
	<button id="printPageButton" class="button" onclick="window.print()">Print Bill</button>
	<div id="bill">
		<table id="title_bill" align="center">
	<tr>
		<td class="title"><img width="60" height="60" title="Coat of Arm" src="images/arm.png"></td>
		<td class="title">
			<center>
			<h1 style="color: blue"><?php echo $print_name; ?></h1>
				<h2 style="color: blue"><?php echo $moto; ?></h2>
			</center>
		</td>
	 	<td class="title"><img width="70" height="70" title="Tema West Municipal Assembly" src="images/logo.png"></td>
	</tr>
	</table>
<H2 id="bop">SIGNAGE BILL </H2> <strong> <span style="float: right;padding-right: 15px;">DATE: <?php echo date('Y-m-d'); ?></span></strong>
<table border="0" width="620" cellpadding="5">
	<tr>
		<td colspan="3"><strong>BILL TO:</strong> <?php echo $datap['signage_acct_name']; ?></td>
	</tr>
	<tr>
		<td colspan="3"><strong>SIGNAGE ACCT. NO:</strong> <?php echo $data['signage_acct_no']; ?></td>
	</tr>
	<tr></tr>
	<tr>
		<td colspan="2"><strong>ELECTORAL LOCATION / AREA:</strong> <?php echo $datap['electoral_area']; ?></td>
		<td colspan="1"><strong>LOCATION:</strong><?php echo $datap['signage_address']; ?></td>
	</tr>
	<tr>
		<td colspan="2"><strong>TOWN: </strong><?php echo $datap['signage_town']  ?></td>
		<td colspan="1"><strong>VALID UNTIL:</strong>
		 <?php
		 if($datap['building_type']=='Temporal'){
		 	echo date('d-m-Y', strtotime('+6 months')); 
		 }else{
		 	echo 'N\A';
		 }
		 ?></td>
	</tr>
</table><br>
<table border="0" width="620" cellpadding="5">
	<tr>
		<td><strong>BILL TYPE</strong></td>
		<td><strong>DESCRIPTION</strong></td>
		<td><strong>CURRENT RATE CHARGE (GHS)</strong></td>
		<td><strong>ARREARS (GHS)</strong></td>
		<td><strong>CREDIT (GHS)</strong></td>
	</tr>
	<tr>
		<td>SIGNAGE</td>
		<td>Signage Bill</td>
		<td><?php echo $data['rate_charge']; ?>.00</td>

		<td><?php echo $data['bal']?>.00</td>
		<td><?php
		if($data['p_total'] > 0 && $data['rate_charge'] > $data['p_total']){
			echo  $data['rate_charge'] - $data['p_total'];
		}else{
			echo '0';
		}
		?>.00
	    </td>
	</tr>
	<!-- <tr>
		<td colspan="2"><strong>GCR:  </strong><?php //echo $data['gcr']; ?></td>
		<td colspan="1"><strong>Current Amount Paid(GHS)</strong></td>
		<td colspan="2"><?php // echo $datat['p_total']?>.00</td>
	</tr> -->
</table>
<center><p style="color: blue;">Please present this bill when making payment</p></center>
<table>
	<tr>
		<td style="border:0px;"><p><?php echo $enquires; ?></p></td>
		<td style="border:0px; width: 120px;"></td>
		<td style="border:0px;"><?php echo $pay; ?></td>
	</tr>
	<tr>
		
	</tr>
</table>
	<!-- <table border="0" width="620" cellpadding="5">
	<tr>
		<td><strong>BILL TYPE</strong></td>
		<td><strong>DESCRIPTION</strong></td>
		<td><strong>RATE CHARGE (GHC)</strong></td>
		<td><strong>BALANCE (GHC)</strong></td>
		<td><strong>TOTAL (GHC)</strong></td>
	</tr>
	<tr>
		<td><strong>SB</strong></td>
		<td><strong>Signage Bill</strong></td>
		<td><strong><?php echo $data['rate_charge']; ?>.00</strong></td>

		<td><strong><?php echo $data['bal']?>.00</strong></td>
		<td><strong><?php echo $data['rate_charge']; ?>.00</strong></td>
	</tr>
	<tr>
		<td colspan="2"><strong>GCR: <?php echo $data['gcr']; ?> </strong></td>
		<td colspan="1"><strong>Current Amount Paid(GHC)</strong></td>
		<td colspan="2"><strong><?php echo $datat['p_total']?>.00</strong></td>
	</tr>
</table>
<center><p style="color: blue;">Please present this bill when making payment</p></center> -->
</div>
</div>
</body>
</html>