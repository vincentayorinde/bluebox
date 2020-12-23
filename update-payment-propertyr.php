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
                  $id__               = $_GET['id'];

                  $sqlnew = "SELECT * FROM property WHERE pro_acct_no = '$pro_acct_no'";
                  $resultnew = $connect->query($sqlnew);
                  $data = $resultnew->fetch_assoc();



                  $sql__ = "SELECT * FROM property_payment WHERE pro_acct_no = '$pro_acct_no' AND id='$id__' ";
                  $result__ = $connect->query($sql__);
                  $data__ = $result__->fetch_assoc();


    }
      if (isset($_POST['rateable_value'])){
        $sqlnewb = "SELECT sum(paid) as p_total FROM property_payment WHERE pro_acct_no = '$pro_acct_no'";
                  $resultnewb = $connect->query($sqlnewb);
                  $datab = $resultnewb->fetch_assoc();
                        
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
                         $bal            = $post['bal'];
                         $paying             = $post['paying'];
                         $adjustment         = $post['adjustment'];
                         $total_amt_due      = 'N/A';
                         $paid               = $post['amt_paid'];
                         $payment_mode  = $post['payment_mode'];
                         $bank          = $post['bank'];
                         $cheque_no     = $post['cheque_no'];
                         $gcr     = $post['gcr'];


                         $b_ = $rate_charge - $paying;
                         $bal = $b_;
                         $arrears = $bal;

                      // Update quote exists

                   $query = "UPDATE property_payment SET paid='$paying', bal='$bal', payment_mode='$payment_mode',bank='$bank',cheque_no='$cheque_no',gcr='$gcr' WHERE id='$id__' ";

                                $result = mysqli_query($connect,$query);
                                if($result){
                                   $sqlss = "SELECT id,pro_acct_no FROM property_payment WHERE pro_acct_no = '$pro_acct_no' order by id desc";
                                            $resultss = $connect->query($sqlss);
                                            $data_ = $resultss->fetch_assoc();
                                            $id_ = $data_["id"];
                                            $p_no_ = $data_["pro_acct_no"];
                               $msg = '<div class="alert alert-success">Payment updated successfully <a class="btn btn-info waves-effect" href="property-payment-list">See List</a>
                                <a class="btn btn-info waves-effect" href="print-bill-propertyr?id='.$id_.'&p_no='.$p_no_.'">
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
    <title>Update Property Payment | <?php echo $name; ?></title>
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
                        <div class="header">
                            <h2>PROPERTY PAYMENT DETAILS</h2>
                         
                        </div>
                        <div class="body">
                            <form id="validation" method="post">
                          <input hidden="" name="id" value="<?php echo $data['id'];?>">
                          <input hidden="" name="userid" value="<?php echo $_SESSION['user_data']['id'];?>">
                          <input hidden="" name="uemail" value="<?php echo $_SESSION['email'] ?>">
                          <input hidden="" name="company" value="<?php echo $_SESSION['user_data']['company'];?>">
                           <a href="enter-payment-rate" class="btn btn-primary waves-effect">Change Property </a> 
                           <div class="clearfix"></div> <br>
                                 <div class="form-group form-float">
                                <div class="col-md-3">
                                 <p>
                                        <b>Payment Mode</b>
                                    </p>
                <select class="form-control show-tick"   name="payment_mode" id="payment_mode" required="">
                                  <option value="<?php echo $data__['payment_mode']; ?>"><?php echo $data__['payment_mode']; ?></option>
                                    <option>__________</option>
                                    
                                    <option value="Cash">Cash</option>
                                    <option value="Cheque">Cheque</option>
                        </select>
                                </div>
                                <div class="col-md-3" id="gcr">
                                    <p>
                                        <b>GCR</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                        </span>
 <div class="form-line"> <input type="text" value="<?php echo $data__['gcr']; ?>" placeholder="Enter GCR No."  class="form-control" name="gcr" id="gcr" required="">
                                            
                                        </div>
                                    </div>
                                </div>
                              </div>
                               <div class="clearfix"></div> 
                               <div class="form-group form-float">
                                  <div class="col-md-3" id="cheque">
                                    <p>
                                        <b>Enter Cheque No.</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">NO.
                                        </span>
        <div class="form-line"> <input type="text" value="<?php if(!$data__['cheque_no']){echo "NA";}else{echo $data__['cheque_no'];} ?>"  placeholder="Enter Cheque No."  class="form-control" name="cheque_no" id="cheque_id">

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
          <div class="form-line"> <input type="text" value="<?php if(!$data__['bank']){echo "NA";}else{echo $data__['bank'];} ?>"  placeholder="Enter Bank Name"  class="form-control" name="bank" id="bank_id">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3" id="cash">
                                    <p>
                                        <b>Paying Amount</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">GHS
                                        </span>
         <div class="form-line"> <input type="number" placeholder="00.00" min="0"  placeholder="Enter Amount"  class="form-control" name="paying" id="paying_id" value="<?php echo $data__['paid']; ?>"  required>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="clearfix"></div> 
                             <div class="form-group form-float">
                          <div class="col-md-3" id="acct-no">
                                    <p>
                                        <b>Property Acct. No.</b>
                                    </p>
                       <div class="form-line">
                          <input type="text" value="<?php echo $data['pro_acct_no']; ?>" class="form-control" name="pro_acct_no" id="pro_acct_no_id"  required readonly="">
                                            
                                        </div>
                            </div>
                             <div class="col-md-3" id="acct-name">
                                    <p>
                                        <b>Property Owner Name</b>
                                    </p>
                       <div class="form-line">
                          <input type="text" value="<?php echo $data['pro_owner_name']; ?>" class="form-control" name="pro_owner_name" id="pro_owner_name_id"  required readonly="">
                                            
                                        </div>
                            </div>
                                <div class="col-md-3" id="rate-value">
                                    
                                    <p>
                                        <b>Rateable Value</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">GHS
                                        </span>
                                        <div class="form-line">
                <input type="number" value="<?php echo $data['r_value']; ?>" class="form-control" name="rateable_value" id="rateable_value_id"  required readonly="">
                                            
                                        </div>
                                    </div>
                                </div>
                                 
                                <div class="col-md-3" id="rate-impose">
                                    <p>
                                        <b>Rate Impost</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">GHS
                                        </span>
                                        <div class="form-line">
                             <input type="number" value="<?php echo $data['r_impose']; ?>" class="form-control" name="rate_impose" id="rate_impose_id"  required readonly="">
                                            
                                        </div>
                                    </div>
                                </div>
                                
                               </div>
                       <div class="form-group form-float">
                                 
                                  <div class="col-md-3" id="rate-charge">
                                    <p>
                                        <b>Rate Charge</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">GHS
                                        </span>
                                        <div class="form-line">
             <input type="number" value="<?php echo  $data['r_charge']; ?>" class="form-control"  name="rate_charge" id="rate_charge_id"  required readonly="">
                                            
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="col-md-3" id="rate-arrears">
                                    <p>
                                        <b>Arrears</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">GHS
                                        </span>
                                        <div class="form-line">
               <input type="number" value="<?php echo $data__['arrears']; ?>" class="form-control" name="arrears" id="arrears_id"  required readonly="">
                                            
                                        </div>
                                    </div>
                                </div>
                              
                                <div class="col-md-3" id="balance">
                                    <p>
                                        <b>Balance</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">GHS
                                        </span>
                                        <div class="form-line">
               <input type="number" value="<?php echo $data__['bal']; ?>" class="form-control" name="bal" id="bal_id"  required readonly="">
                                            
                                        </div>
                                    </div>
                                </div>
                                 <!-- <div class="col-md-3" id="amt-due">
                                    <p>
                                        <b>Total Amount Due</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">GHS
                                        </span>
                                        <div class="form-line">
         <input type="number" value="<?php // echo $data['total_amount_due']; ?>"  class="form-control" name="total_amount_due" id="total_amount_due_id" required readonly="">
                                            
                                        </div>
                                    </div>
                                </div> -->
                               <!--  <div class="col-md-3">
                                    <p>
                                        <b>Total Amount Paid</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">GHS
                                        </span>
                                        <div class="form-line">
           <input type="number" value="<?php // echo $data['amt_paid']; ?>" class="form-control" name="amt_paid" id="amt_paid_id"  required readonly="">
                                            
                                        </div>
                                    </div>
                                </div> -->
                                     
                               </div>
                               <div class="clearfix"></div>
                         
    
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
                // $("#cash").hide();
                $("#cheque").hide();
                $("#bank").hide();
                // $("#acct-no").hide();
                // $("#acct-name").hide();
                // $("#rate-value").hide();
                // $("#rate-impose").hide();
                // $("#rate-charge").hide();
                // $("#rate-arrears").hide();
                // $("#amt-due").hide();
                // $("#balance").hide();
                // $("#gcr").hide();
                
            });
                // var value =  $("#payment_mode option:selected").val();
        $('#payment_mode').on('change', function() {
            var value  = $(this).val();
              if(value == "Cash"){
                    $("#cash").show();
                    $("#cheque").hide();
                    $("#bank").hide();
                    $("#acct-no").show();
                    $("#acct-name").show();
                    $("#rate-value").show();
                    $("#rate-impose").show();
                    $("#rate-charge").show();
                    $("#rate-arrears").show();
                    $("#amt-due").show();
                    $("#balance").show();
                    $("#gcr").show();
              }
               if(value == "Cheque"){
                    $("#cheque").show();
                    $("#bank").show();
                    $("#cash").show();
                    $("#acct-no").show();
                    $("#acct-name").show();
                    $("#rate-value").show();
                    $("#rate-impose").show();
                    $("#rate-charge").show();
                    $("#rate-arrears").show();
                    $("#amt-due").show();
                    $("#balance").show();
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