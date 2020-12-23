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
    if ($_GET['b_no']){
                  $b_no        = $_GET['b_no'];
                  $id__        = $_GET['id'];

                  $sqlnew = "SELECT * FROM business WHERE b_no = '$b_no'";
                  $resultnew = $connect->query($sqlnew);
                  $data = $resultnew->fetch_assoc();


                  $sql__ = "SELECT * FROM bop_payment WHERE b_no = '$b_no' AND id= '$id__'";
                  $result__ = $connect->query($sql__);
                  $data__ = $result__->fetch_assoc();


                 
    }
      if (isset($_POST['paying'])){
         $sqlnewb = "SELECT sum(paid) as p_total FROM bop_payment WHERE b_no = '$b_no'";
                  $resultnewb = $connect->query($sqlnewb);
                  $datab = $resultnewb->fetch_assoc();
                        
                        // echo $amt_paid_new = floatval($amt_paid_new);
                         $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                         $userid             = $post['userid'];
                         $uemail             = $post['uemail'];
                          $first_name    = $post['first_name'];
                         $last_name     = $post['last_name'];
                         $payment_mode       = $post['payment_mode'];
                         $paying             = $post['paying'];
                         $cheque_no          = $post['cheque_no'];
                         $bank               = $post['bank'];
                         $b_no               = $post['b_no'];
                         $b_name             = $post['b_name'];
                         $b_charge           = $post['b_charge'];
                         $b_balance          = $post['b_balance'];
                         $rev_type_code      = $post['rev_type_code'];
                         
                         $date = date('Y-m-d');
                         $gcr     = $post['gcr'];
                         $b_ = $b_charge - $paying;
                         $b_balance = $b_ - $datab['p_total'];
                         $b_arrears = $b_balance;

                         if(!$bank){
                            $bank = 'NA';
                         }
                          if(!$cheque_no){
                            $cheque_no = 'NA';
                         }

                     
                      // Update quote exists
            $query = "INSERT INTO bop_payment (b_no,b_name,rev_type_code,payment_mode,paid,bal,b_charge,arrears,bank,cheque_no,gcr,user_id,user_email,first_name, last_name,date_,activ) VALUES
                  ('$b_no','$b_name','$rev_type_code','$payment_mode','$paying','$b_balance','$b_charge','$b_arrears','$bank','$cheque_no','$gcr','$userid','$uemail','$first_name','$last_name','$date','Y')";
                                $result = mysqli_query($connect,$query);
                                if($result){
                                  $sqlss = "SELECT id,b_no,b_name,payment_mode,paid,bal,b_charge,arrears,bank,cheque_no,user_id,user_email,first_name FROM bop_payment WHERE b_no = '$b_no' order by id desc";
                                            $resultss = $connect->query($sqlss);
                                            $data_ = $resultss->fetch_assoc();
                                            $id_ = $data_["id"];
                                            $b_no_ = $data_["b_no"];

                                $msg = '<div class="alert alert-success">Payment entered successfully <a class="btn btn-info waves-effect" href="bop-payment-list">See List</a>
                                <a class="btn btn-info waves-effect" href="print-bill-bop?id='.$id_.'&b_no='.$b_no_.'">
                                                   Print Receipt </a>
                                </div>';


                                  
                                
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
    <title>Pay Now | <?php echo $name; ?></title>
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
         <!--    <div class="block-header">
                <h2>ENTER PAYMENT</h2>
            </div> -->

            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?php echo $msg; ?>
                    <div class="card">
                        <div class="header">
                            <h2>BOP PAYMENT DETAILS</h2>
                         
                        </div>
                        <div class="body">
                            <form id="validation" method="post">
                          <input hidden="" name="id" value="<?php echo $data['id'];?>">
                          <input hidden="" name="userid" value="<?php echo $_SESSION['user_data']['id'];?>">
                          <input hidden="" name="uemail" value="<?php echo $_SESSION['email'] ?>">
                          <input hidden="" value="<?php echo $data['rev_type_code']; ?>"  name="rev_type_code">
                          <input hidden="" name="company" value="<?php echo $_SESSION['user_data']['company'];?>">
                        <a href="#" onclick="location.href = document.referrer; return false;" class="btn btn-primary waves-effect">Back </a> 
                           <div class="clearfix"></div> <br>

                            <div class="form-group form-float">

                           <div class="col-md-3">
                                 <p>
                                        <b>Payment Mode</b>
                                    </p>
                <select class="form-control show-tick"   name="payment_mode" id="payment_mode" required="">
                                    <option value="N\A">Select Mode</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Cheque">Cheque</option>
                        </select>
                                </div>
                               
                              </div>
                                <div class="clearfix"></div>
                                <div class="form-group form-float">
                                 <div class="col-md-3" id="cash">
                                    <p>
                                        <b>Paying Amount</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">GHS
                                        </span>
         <div class="form-line"> <input type="number" placeholder="00.00" min="0"  placeholder="Enter Amount"  class="form-control" name="paying" id="paying_id"  required>
                                            
                                        </div>
                                    </div>
                                </div>
                                     <div class="col-md-3" id="cheque">
                                    <p>
                                        <b>Enter Cheque No.</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">NO.
                                        </span>
                      <div class="form-line"> <input type="text"  placeholder="Enter Cheque No."  class="form-control" name="cheque_no" id="cheque_id">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3" id="bank">
                                    <p>
                                        <b>Bank Name</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        </span>
         <div class="form-line"> <input type="text"  placeholder="Enter Bank Name"  class="form-control" name="bank" id="bank_id">
                                            
                                        </div>
                                    </div>
                                </div>
                                  <div class="col-md-3" id="gcr">
                                    <p>
                                        <b>GCR</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        </span>
         <div class="form-line"> <input type="text"  placeholder="Enter GCR No."  class="form-control" name="gcr" id="gcr" required="">
                                            
                                        </div>
                                    </div>
                                </div>

                              </div>
                              <div class="clearfix"></div>

                             <div class="form-group form-float">
                                 <div class="col-md-3" id="acct_no">
                                    <p>
                                        <b>Busines Acct. No.</b>
                                    </p>
                       <div class="form-line">
                          <input type="text" value="<?php echo $data['b_no']; ?>" class="form-control" name="b_no" id="b_no_id"  required readonly="">
                                            
                                        </div>
                            </div>
                               <div class="col-md-3" id="acct_name">
                                    <p>
                                        <b>Business Acct. Name.</b>
                                    </p>
                       <div class="form-line">
                          <input type="text" value="<?php echo $data['b_name']; ?>" class="form-control" name="b_name" id="b_name_id"  required readonly="">
                                            
                                        </div>
                            </div>
                                <div class="col-md-3" id="bop_charge_id">
                                    
                                    <p>
                                        <b>BOP Charge</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">GHS
                                        </span>
                                        <div class="form-line">
                <input type="number" value="<?php echo $data['b_charge']; ?>" class="form-control" name="b_charge" id="b_charge_id"  required readonly="">
                                            
                                        </div>
                                    </div>
                                </div>
                            <div class="col-md-3" id="total_amt_due">
                                    <p>
                                        <b>Balance</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">GHS
                                        </span>
                                        <div class="form-line">
         <input type="number" value="<?php echo $data__['bal']; ?>"  class="form-control" name="b_balance" id="b_balance_id" required readonly="">
                                            
                                        </div>
                                    </div>
                                </div>
                                    
                               </div>
    
<div class="clearfix"></div>
                               <!--  <div class="form-group">
                                    <input type="checkbox" id="checkbox" name="checkbox">
                                    <label for="checkbox">I have read and accept the terms</label>
                                </div> -->
                                <input type="submit" class="btn btn-primary waves-effect" value="Enter Payment" name=""> 
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
    <script type="text/javascript">
        $(document).ready(function() {
                $("#total_amt_due").hide();
                $("#bop_charge_id").hide();
                $("#acct_name").hide();
                $("#acct_no").hide();
                $("#cash").hide();
                $("#cheque").hide();
                $("#bank").hide();
                $("#gcr").hide();
                
            });
                // var value =  $("#payment_mode option:selected").val();
        $('#payment_mode').on('change', function() {
            var value  = $(this).val();
              if(value == "Cash"){
                    $("#cash").show();
                    $("#cheque").hide();
                    $("#bank").hide();
                   $("#acct_no").show();
                    $("#acct_name").show();
                    $("#bop_charge_id").show();
                    $("#total_amt_due").show();
                    $("#gcr").show();
              }
               if(value == "Cheque"){
                    $("#cheque").show();
                    $("#bank").show();
                    $("#cash").show();
                    $("#acct_no").show();
                    $("#acct_name").show();
                    $("#bop_charge_id").show();
                    $("#total_amt_due").show();
                    $("#gcr").show();
              }
        });
         
    </script>
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