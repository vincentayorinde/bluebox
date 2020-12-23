<?php 
error_reporting(1);
session_start();
require_once 'db/config.php';
    if(!isset($_SESSION['is_logged_in']) == true){
            header("Location: sign-in");
    }
    if(isset($_SESSION['user_data']['user_role']) == "agent" || $_SESSION['user_data']['user_role'] == "adminxz"){
        $email      =  $_SESSION['email'];
        $first_name =  $_SESSION['user_data']['first_name'];
        $last_name  =  $_SESSION['user_data']['last_name'];
    }
    if ($_GET['pro_acct_no']){
                  $pro_acct_no        = $_GET['pro_acct_no'];

                  $sqlnew = "SELECT * FROM property WHERE pro_acct_no = '$pro_acct_no'";
                  $resultnew = $connect->query($sqlnew);
                  $data = $resultnew->fetch_assoc();
    }
      if (isset($_POST['rateable_value'])){
                        
                        // echo $amt_paid_new = floatval($amt_paid_new);
                         $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                         $id                 = $post['id'];
                         $userid             = $post['userid'];
                         $uemail             = $post['uemail'];
                         $pro_acct_no        = $post['pro_acct_no'];
                         $rateable_value     = $post['rateable_value'];
                         $rate_impose        = $post['rate_impose'];
                         $rate_charge        = $post['rate_charge'];
                         $arrears            = $post['arrears'];
                         $paying             = $post['paying'];
                         $adjustment         = $post['adjustment'];
                         $total_amount_due   = $post['total_amount_due'];
                         $paid               = $post['amt_paid'];

                         echo $amt_paid_new = $paying + $paid;

                      // Update quote exists
                        $query = "UPDATE property 
                        SET rateable_value='$rateable_value', rate_impose='$rate_impose',rate_charge='$rate_charge',arrears='$arrears',payment='$paying',adjustment='$adjustment',total_amount_due='$total_amount_due', amt_paid='$amt_paid_new' WHERE id='$id' ";
                                $result = mysqli_query($connect,$query);
                                if($result){
                                $msg = '<div class="alert alert-success">Payment entered successfully <a class="btn btn-info waves-effect" href="all-rates">See List</a></div>';
                                //header("location:updatequote");
                                  }else{
                                        $msg = '<div class="alert alert-danger">Error updating data!</div>';
                                  }
                 }

    ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Report Print | AS</title>
    <!-- Favicon-->
    <link rel="icon" href="images/favicon.png" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
 <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Colorpicker Css -->
    <link href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet" />

    <!-- Dropzone Css -->
    <link href="plugins/dropzone/dropzone.css" rel="stylesheet">

    <!-- Multi Select Css -->
    <link href="plugins/multi-select/css/multi-select.css" rel="stylesheet">

    <!-- Bootstrap Spinner Css -->
    <link href="plugins/jquery-spinner/css/bootstrap-spinner.css" rel="stylesheet">

    <!-- Bootstrap Tagsinput Css -->
    <link href="plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- noUISlider Css -->
    <link href="plugins/nouislider/nouislider.min.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />
      
</head>
<style type="text/css">
    .pac-container:after {
    /* Disclaimer: not needed to show 'powered by Google' if also a Google Map is shown */

    background-image: none !important;
    height: 0px;
}
</style>

    <?php include 'includes/left-sidebar.php'; ?>

    <!-- Right Bar -->
    <?php include 'includes/right-sidebar.php'; ?>


    </section>

    <section class="content">
        <div class="container-fluid">
           <!--  <div class="block-header">
                <h2>ENTER PAYMENT</h2>
            </div> -->

            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?php echo $msg; ?>
                    <div class="card">
                        <!-- <div class="header">
                            <h2>PAYMENT DETAILS</h2>
                         
                        </div> -->
                        <div class="body">
                            <form id="validation" method="post">
                          <input hidden="" name="id" value="<?php echo $data['id'];?>">
                          <input hidden="" name="userid" value="<?php echo $_SESSION['user_data']['id'];?>">
                          <input hidden="" name="uemail" value="<?php echo $_SESSION['email'] ?>">
                          <input hidden="" name="company" value="<?php echo $_SESSION['user_data']['company'];?>">
                           <a href="report" class="btn btn-primary waves-effect">Change Property </a> 
                           <div class="clearfix"></div> <br>
                             <div class="form-group form-float">
                                <div class="col-md-3">
                                     <center><img src="images/arm.png" width="48" height="48" alt="User" /></center>
                                </div>
                                <div class="col-md-6">
                                    <center>
                                        <h2>KROMA MUNICIPAL ASSEMBLY </h2>
                                    </center>    
                                
                                </div>
                                 
                                <div class="col-md-3">
                                    <center><img src="images/arm.png" width="48" height="48" alt="User" /></center>
                                </div>
                                 
                                    
                               </div>
                               <div class="form-group form-float">
                               
                                <div class="col-md-12">
                                    <center>
                                        <h3>PROPERTY BILL </h3>
                                    </center>    
                                
                                </div>
                                 
                               </div>
                       <div class="form-group form-float">
                                 
                                 
                                <div class="col-md-3">
                                   <h3>OWNER NAME:</h3>
                                </div>
                              
                                <div class="col-md-6">
                                    <p>
                                        <b>Owner Name</b>
                                    </p>
                                    <div class="input-group">
                                       <span class="input-group-addon">
                                            <i class="material-icons">account_circle</i>
                                        </span>
                                        <div class="form-line">
               <input type="text" value="<?php echo $data['pro_owner_name']; ?>" class="form-control" name="adjustment" id="adjustment_id"  required readonly="">
                                            
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-3">
                                    <p>
                                        <b>Date</b>
                                    </p>
                                    <div class="input-group">
                                        <!-- <i class="material-icons">date_range</i> -->
                                        <div class="form-line">
         <input type="date" value="<?php echo date('Y-m-d'); ?>"  class="form-control" name="total_amount_due" id="total_amount_due_id" required readonly="">
                                            
                                        </div>
                                    </div>
                                </div>
                               
                                     
                               </div>
                                <div class="form-group form-float">
                                 
                                 
                                <div class="col-md-3">
                                   <h3>ACCOUNT NUMBER:</h3>
                                </div>
                              
                                <div class="col-md-6">
                                    <p>
                                        <b>Account No</b>
                                    </p>
                                    <div class="input-group">
                                       <span class="input-group-addon">
                                            <i class="material-icons">account_balance_wallet</i>
                                        </span>
                                        <div class="form-line">
               <input type="text" value="<?php echo $data['pro_acct_no']; ?>" class="form-control" name="adjustment" id="adjustment_id"  required readonly="">
                                            
                                        </div>
                                    </div>
                                </div>
                                     
                               </div>
                               <div class="clearfix"></div>
                      <div class="form-group form-float">
                                 
                                 
                                <div class="col-md-3">
                                   <h3>ADDRESS:</h3>
                                </div>
                              
                                <div class="col-md-6">
                                    <p>
                                        <b>Address</b>
                                    </p>
                                    <div class="input-group">
                                       <span class="input-group-addon">
                                            <i class="material-icons">room</i>
                                        </span>
                                        <div class="form-line">
               <input type="text" value="<?php echo $data['pro_address']; ?>" class="form-control" name="adjustment" id="adjustment_id"  required readonly="">
                                            
                                        </div>
                                    </div>
                                </div>
                               
                               </div>
<div class="clearfix"></div> 
              <div class="form-group form-float">
                                 
                                 
                                <div class="col-md-3">
                                   <h3>HOUSE NO:</h3>
                                </div>
                              
                                <div class="col-md-6">
                                    <p>
                                        <b>House</b>
                                    </p>
                                    <div class="input-group">
                                       <span class="input-group-addon">
                                            <i class="material-icons">home</i>
                                        </span>
                                        <div class="form-line">
               <input type="text" value="<?php echo $data['pro_hs_no']; ?>" class="form-control" name="adjustment" id="adjustment_id"  required readonly="">
                                            
                                        </div>
                                    </div>
                                </div>
                                
                               
                                     
                               </div>
                               <div class="clearfix"></div> 
                    <div class="form-group form-float">
                                 
                                 
                                <div class="col-md-3">
                                   <h3>AREA CATEGORY</h3>
                                </div>
                              
                                <div class="col-md-6">
                                    <p>
                                        <b>House</b>
                                    </p>
                                    <div class="input-group">
                                       <span class="input-group-addon">
                                            <i class="material-icons">business</i>
                                        </span>
                                        <div class="form-line">
               <input type="text" value="<?php echo $data['pro_area_category']; ?>" class="form-control" name="adjustment" id="adjustment_id"  required readonly="">
                                            
                                        </div>
                                    </div>
                                </div>
                                
                               
                                     
                               </div>
<div class="clearfix"></div> 
                           <div class="form-group form-float">
                                 
                                 
                                 <div class="col-md-3">
                                    <p>
                                        <b>Rateable Value</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">GHS
                                        </span>
                                        <div class="form-line">
         <input type="text" value="<?php echo $data['rateable_value']; ?>"  class="form-control" name="total_amount_due" id="total_amount_due_id" required readonly="">
                                            
                                        </div>
                                    </div>
                                </div>
                              
                                 <div class="col-md-3">
                                    <p>
                                        <b>Rate Impose</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">GHS
                                        </span>
                                        <div class="form-line">
         <input type="text" value="<?php echo $data['rate_impose']; ?>"  class="form-control" name="total_amount_due" id="total_amount_due_id" required readonly="">
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                 <div class="col-md-3">
                                    <p>
                                        <b>Rate Charge</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">GHS
                                        </span>
                                        <div class="form-line">
         <input type="text" value="<?php echo $data['rateable_value']; ?>"  class="form-control" name="total_amount_due" id="total_amount_due_id" required readonly="">
                                            
                                        </div>
                                    </div>
                                </div>
                              <div class="col-md-3">
                                    <p>
                                        <b>Arrears</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">GHS
                                        </span>
                                        <div class="form-line">
         <input type="text" value="<?php echo $data['arrears']; ?>"  class="form-control" name="total_amount_due" id="total_amount_due_id" required readonly="">
                                            
                                        </div>
                                    </div>
                                </div>
                                     
                               </div>

<div class="clearfix"></div> 
                               <div class="form-group form-float">
                                 <div class="col-md-3">
                                    <p>
                                        <b>Payment</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">GHS
                                        </span>
                                        <div class="form-line">
         <input type="text" value="<?php echo $data['payment']; ?>"  class="form-control" name="total_amount_due" id="total_amount_due_id" required readonly="">
                                            
                                        </div>
                                    </div>
                                </div>
                                  <div class="col-md-3">
                                    <p>
                                        <b>Adjustment</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">GHS
                                        </span>
                                        <div class="form-line">
         <input type="text" value="<?php echo $data['adjustment']; ?>"  class="form-control" name="total_amount_due" id="total_amount_due_id" required readonly="">
                                            
                                        </div>
                                    </div>
                                </div>
                                  <div class="col-md-3">
                                    <p>
                                        <b>Total Amount Due</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">GHS
                                        </span>
                                        <div class="form-line">
         <input type="text" value="<?php echo $data['total_amount_due']; ?>"  class="form-control" name="total_amount_due" id="total_amount_due_id" required readonly="">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
    
<div class="clearfix"></div>
                                <div class="form-group">
                                  <center><h6>ACCOUNT #: 000000000 | BANK: NIB, GHANA COMMERCIAL BANK, SPINTEX</h6></center>
                                </div>
                                <input type="submit" class="btn btn-primary waves-effect" value="Print" name=""> 
                            </form>
                        </div> <!-- End body real form -->
                    </div>
                </div>
            </div>
            <!-- #END# Basic Validation -->
            </div>

        </div>
    </section>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtwdU-k6I92E2C6zqsC6xPFlRUACzhmXc&libraries=places&callback=initMap"
    async defer></script>
    
       
      <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Bootstrap Colorpicker Js -->
    <script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>

    <!-- Dropzone Plugin Js -->
    <script src="plugins/dropzone/dropzone.js"></script>

    <!-- Input Mask Plugin Js -->
    <script src="plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>

    <!-- Multi Select Plugin Js -->
    <script src="plugins/multi-select/js/jquery.multi-select.js"></script>

    <!-- Jquery Spinner Plugin Js -->
    <script src="plugins/jquery-spinner/js/jquery.spinner.js"></script>

    <!-- Bootstrap Tags Input Plugin Js -->
    <script src="plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>

    <!-- noUISlider Plugin Js -->
    <script src="plugins/nouislider/nouislider.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/forms/advanced-form-elements.js"></script>

    <!-- Demo Js -->
    <script src="js/demo.js"></script>

</body>

</html>