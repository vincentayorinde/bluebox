<?php 
error_reporting(0);
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


    // BOP PAYMENT

      if (isset($_POST['search-bop'])){
                         $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                         $userid             = $post['userid'];
                         $uemail             = $post['uemail'];
                         $b_no        = $post['b_no'];

                        // add data to session
                        $sql = "SELECT * FROM business WHERE b_no = '$b_no'";
                        $result = $connect->query($sql);
                        $row = $result->fetch_assoc();

                        $sql_ = "SELECT * FROM bop_payment WHERE b_no = '$b_no' order by id desc";
                        $result_ = $connect->query($sql_);
                        $row_ = $result_->fetch_assoc();
                        if($result->num_rows > 0){
                              header("Location: search-bop?b_no=".$row['b_no']."");
                         }
             }





// PROPERTY RATE PAYMENT

 if (isset($_POST['pay-pr'])){
                           $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                         $userid             = $post['userid'];
                         $uemail             = $post['uemail'];
                         $pro_acct_no        = $post['pro_acct_no'];

                        // add data to session
                        $sql = "SELECT * FROM property WHERE pro_acct_no = '$pro_acct_no'";
                        $result = $connect->query($sql);
                        $row = $result->fetch_assoc();

                        $sql_ = "SELECT * FROM property_payment WHERE pro_acct_no = '$pro_acct_no' order by id desc";
                        $result_ = $connect->query($sql_);
                        $row_ = $result_->fetch_assoc();
                        
                       if($result->num_rows > 0){
                              header("Location: enter-payment-pay-now?id=".$row_['id']."&pro_acct_no=".$row['pro_acct_no']."");
                         }
        }








// BUILDING PERMIT

   if (isset($_POST['pay-bp'])){
                         $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                         $userid             = $post['userid'];
                         $uemail             = $post['uemail'];
                         $b_permit_acct_no        = $post['b_permit_acct_no'];

                        // add data to session
                        $sql = "SELECT * FROM building WHERE b_permit_acct_no = '$b_permit_acct_no'";
                        $result = $connect->query($sql);
                        $row = $result->fetch_assoc();

                        $sql_ = "SELECT * FROM building_payment WHERE b_permit_acct_no = '$b_permit_acct_no' order by id desc";
                        $result_ = $connect->query($sql_);
                        $row_ = $result_->fetch_assoc();
                        
            if($result->num_rows > 0){
                     header("Location: enter-payment-b-permit-pay-now?id=".$row_['id']."&b_permit_acct_no=".$row['b_permit_acct_no']."");
                         }
                 
             }










//  SIGNAGE PAYMENT


  if (isset($_POST['pay-sg'])){
                   $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                         $userid             = $post['userid'];
                         $uemail             = $post['uemail'];
                         $signage_acct_no        = $post['signage_acct_no'];

                        // add data to session
                        $sql = "SELECT * FROM signage WHERE signage_acct_no = '$signage_acct_no'";
                        $result = $connect->query($sql);
                        $row = $result->fetch_assoc();

                        $sql_ = "SELECT * FROM signage_payment WHERE signage_acct_no = '$signage_acct_no' order by id desc";
                        $result_ = $connect->query($sql_);
                        $row_ = $result_->fetch_assoc();
                        
            if($result->num_rows > 0){
                     header("Location: enter-payment-signage-now?id=".$row_['id']."&signage_acct_no=".$row['signage_acct_no']."");
                         }

                 
             }

    ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title> Search bill | <?php echo $name; ?></title>
    <!-- Favicon-->
    <link rel="icon" href="../images/favicon.png" type="image/x-icon">

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
            <div class="block-header">
                <h2>SEARCH BILL DATA</h2>
            </div>

            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?php echo $msg; ?>
                    <div class="card">
                       <!--  <div class="header">
                   
                        </div> -->
                        <div class="body">
                            <form id="form_validation" method="POST" novalidate>
                          <!-- <input hidden="" name="add_bop" value="add_bop">
                          <input hidden="" name="add_property_rate" value="add_property_rate">
                          <input hidden="" name="add_building_permit" value="add_building_permit"> -->
                          <input hidden="" name="userid" value="<?php echo $_SESSION['user_data']['id'];?>">
                          <input hidden="" name="uemail" value="<?php echo $_SESSION['email'] ?>">
                          <input hidden="" name="first_name" value="<?php echo $first_name; ?>">
                          <input hidden="" name="last_name" value="<?php echo $last_name; ?>">
                          <input hidden="" name="company" value="<?php echo $_SESSION['user_data']['company'];?>">
                                 <div class="col-md-3">
                                 <p>
                                        <b>Select Bill Type</b>
                                    </p>
                <select class="form-control show-tick"   name="make_payment" id="make_payment_id" required="">
                                    <option value="N\A">Select Bill</option>
                                    <option value="make_bop_payment">BOP</option>
                                    <option value="make_property_rate_payment">Property Rate</option>
                                    <option value="make_building_permit_mayment">Building Permit</option>
                                    <option value="make_signage_payment">Signage</option>
                        </select>
                                </div>
                              
                               
                                <div class="clearfix"></div>




            <!-- BOP FORM -->
                    <div id="make_bop_payment">
                        <h5>
                                SEARCH BOP
                            </h5>

                        <div class="body">
                                   <form id="validation" method="post">
                          <input hidden="" name="userid" value="<?php echo $_SESSION['user_data']['id'];?>">
                          <input hidden="" name="uemail" value="<?php echo $_SESSION['email'] ?>">
                          <input hidden="" name="company" value="<?php echo $_SESSION['user_data']['company'];?>">
                             <div class="form-group form-float">
                                 <div class="col-md-8">
                                    <p>
                                        <b>BOP Acct. No.</b>
                                    </p>
        <select class="form-control show-tick"   name="b_no" id="b_no_id" required="">
                                        <option value="">Search BOP Account No or Owner Name</option>
                                        <?php 
    // SQL to gather their entire PM List
    $sql = mysqli_query($connect, "SELECT * FROM business ORDER BY id DESC");
    while($row = mysqli_fetch_assoc($sql)){
        ?>
                            
        <option value="<?php echo $row['b_no']?>"><?php echo $row['b_no'].' - '. $row['b_name']; ; ?></option>
                     <?php } ?>          
                                    </select>
                            </div>
                                </div>
                                
                                 
    
<div class="clearfix"></div>
                             <!--    <div class="form-group">
                                    <input type="checkbox" id="checkbox" name="checkbox">
                                    <label for="checkbox">I have read and accept the terms</label>
                                </div> -->
                                <input type="submit" class="btn btn-primary waves-effect" value="Fetch Data" name="search-bop" id="search-bop"> 
                            </form>
                         </div>

                         </div>











<!-- PROPERTY RATE FORM -->
 <div id="make_property_rate_payment">
                         <h5>
                         SEARCH PROPERTY RATE
                            </h5>
                    <div class="body">
                            <form id="" method="post">
                          <input hidden="" name="userid" value="<?php echo $_SESSION['user_data']['id'];?>">
                          <input hidden="" name="uemail" value="<?php echo $_SESSION['email'] ?>">
                          <input hidden="" name="company" value="<?php echo $_SESSION['user_data']['company'];?>">
                             <div class="form-group form-float">
                                 <div class="col-md-8">
                                    <p>
                                        <b>Property Acct. No.</b>
                                    </p>
        <select class="form-control show-tick"   name="pro_acct_no" id="pro_acct_no_id" required="">
                                        <option value="">Search Property Account No or Owner Name</option>
                                        <?php 
    // SQL to gather their entire PM List
    $sql = mysqli_query($connect, "SELECT * FROM property ORDER BY id DESC LIMIT 100");
    while($row = mysqli_fetch_assoc($sql)){
        ?>
                            
        <option value="<?php echo $row['pro_acct_no']?>"><?php echo $row['pro_acct_no'].' - '. $row['pro_owner_name']; ; ?></option>
                     <?php } ?>          
                                    </select>
                            </div>
                                
                                
                                 </div>
    
<div class="clearfix"></div>
                               <!--  <div class="form-group">
                                    <input type="checkbox" id="checkbox" name="checkbox">
                                    <label for="checkbox">I have read and accept the terms</label>
                                </div> -->
                                <input type="submit" class="btn btn-primary waves-effect" value="Fetch Data" name="pay-pr" id="pay-pr"> 
                            </form>
                        </div> <!-- End body real form -->
                    </div>








<!-- BUILDING PERMIT FORM -->


 <div id="make_building_permit_mayment">
<h5>SEARCH BUILDING PERMIT</h5>
  <div class="body">
                            <form id="validation" method="post">
                          <input hidden="" name="userid" value="<?php echo $_SESSION['user_data']['id'];?>">
                          <input hidden="" name="uemail" value="<?php echo $_SESSION['email'] ?>">
                          <input hidden="" name="company" value="<?php echo $_SESSION['user_data']['company'];?>">
                             <div class="form-group form-float">
                                 <div class="col-md-8">
                                    <p>
                                        <b>Property Acct. No.</b>
                                    </p>
        <select class="form-control show-tick"   name="b_permit_acct_no" id="b_permit_acct_no_id" required="">
                                        <option value="">Search Building Permit Account No or Owner Name</option>
                                        <?php 
    // SQL to gather their entire PM List
    $sql = mysqli_query($connect, "SELECT * FROM building ORDER BY id DESC LIMIT 100");
    while($row = mysqli_fetch_assoc($sql)){
        ?>
                            
        <option value="<?php echo $row['b_permit_acct_no']?>"><?php echo $row['b_permit_acct_no'].' - '. $row['b_permit_owner_name']; ; ?></option>
                     <?php } ?>          
                                    </select>
                            </div>
                                </div>
                                
                                 
    
<div class="clearfix"></div>
                               <!--  <div class="form-group">
                                    <input type="checkbox" id="checkbox" name="checkbox">
                                    <label for="checkbox">I have read and accept the terms</label>
                                </div> -->
                                <input type="submit" class="btn btn-primary waves-effect" value="Fetch Data" name="pay-bp" id="pay-bp"> 
                            </form>
                        </div> <!-- End body real form -->
                    </div>
                           </div>








         <!-- SIGNAGE FORM -->
                    <div id="make_signage_payment">                        
                                 <div class="body"><h5>SEARCH SIGNAGE</h5>
                            <form id="validation" method="post">
                          <input hidden="" name="userid" value="<?php echo $_SESSION['user_data']['id'];?>">
                          <input hidden="" name="uemail" value="<?php echo $_SESSION['email'] ?>">
                          <input hidden="" name="company" value="<?php echo $_SESSION['user_data']['company'];?>">
                             <div class="form-group form-float">
                                 <div class="col-md-8">
                                    <p>
                                        <b>Signage Acct. No.</b>
                                    </p>
        <select class="form-control show-tick"   name="signage_acct_no" id="signage_acct_no_id" required="">
                                        <option value="">Search Signage Account No or Owner Name</option>
                                        <?php 
    // SQL to gather their entire PM List
    $sql = mysqli_query($connect, "SELECT * FROM signage ORDER BY id DESC LIMIT 100");
    while($row = mysqli_fetch_assoc($sql)){
        ?>
                            
        <option value="<?php echo $row['signage_acct_no']?>"><?php echo $row['signage_acct_no'].' - '. $row['signage_acct_name']; ; ?></option>
                     <?php } ?>          
                                    </select>
                            </div>
                                
                              </div>  
                                 
    
<div class="clearfix"></div>
                               <!--  <div class="form-group">
                                    <input type="checkbox" id="checkbox" name="checkbox">
                                    <label for="checkbox">I have read and accept the terms</label>
                                </div> -->
                                <input type="submit" class="btn btn-primary waves-effect" value="Fetch Data" name="pay-sg" id="pay-sg"> 
                            </form>
                        </div> <!-- End body real form -->
                    </div>







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
   <!--  <script type="text/javascript">
      function initMap() {
      var location_id_bop = document.getElementById('location_id_bop');
      var location_id_bop = new google.maps.places.Autocomplete(location_id_bop);

      var building_address_id = document.getElementById('building_address_id');
      var building_address_id = new google.maps.places.Autocomplete(building_address_id);

      var pro_address_id = document.getElementById('pro_address_id');
      var pro_address_id = new google.maps.places.Autocomplete(pro_address_id);

      var signage_address_id = document.getElementById('signage_address_id');
      var signage_address_id = new google.maps.places.Autocomplete(signage_address_id);


    }

    </script> -->

      <script src="plugins/jquery/jquery.min.js"></script>
       <script type="text/javascript">

        // Hiding all forms
        $(document).ready(function() {
                $("#make_bop_payment").hide(); 
                $("#make_property_rate_payment").hide(); 
                $("#make_building_permit_mayment").hide(); 
                $("#make_signage_payment").hide(); 
        });
                // var value =  $("#payment_mode option:selected").val();
        $('#make_payment_id').on('change', function() {
            var value  = $(this).val();
              if(value == "make_bop_payment"){
                $("#make_bop_payment").show(); 
                $("#make_property_rate_payment").hide(); 
                $("#make_building_permit_mayment").hide(); 
                $("#make_signage_payment").hide(); 
              }
               if(value == "make_property_rate_payment"){
                $("#make_bop_payment").hide(); 
                $("#make_property_rate_payment").show(); 
                $("#make_building_permit_mayment").hide(); 
                $("#make_signage_payment").hide(); 
              }
              if(value == "make_building_permit_mayment"){
                $("#make_bop_payment").hide(); 
                $("#make_property_rate_payment").hide(); 
                $("#make_building_permit_mayment").show(); 
                $("#make_signage_payment").hide(); 
              }
              if(value == "make_signage_payment"){
                $("#make_bop_payment").hide(); 
                $("#make_property_rate_payment").hide(); 
                $("#make_building_permit_mayment").hide(); 
                $("#make_signage_payment").show(); 
              }
        });
         
    </script>


<!-- Property Rate -->
    <script type="text/javascript">

        $(".calc_pr").on("change paste keyup", function() {
            var impost  = $("#rate_impost_id_pr").val() *  $("#rateable_value_id_pr").val();
           $('#rate_charge_id_pr').val(impost);
        });
    </script>


<!-- Building Permit -->
    <script type="text/javascript">
        $(".dim_bp").on("change paste keyup", function() {
            var dim  = $("#lenght_id_bp").val()/1000 *  $("#breadth_id_bp").val()/1000;
           $('#permit_size_id_bp').val(dim);
        });


        $(".calc_bp").on("change paste keyup", function() {
            var impost  = $("#rate_impost_id_bp").val() *  $("#permit_size_id_bp").val();
           $('#rate_charge_id_bp').val(impost);
        });
    </script>

<!-- Signage -->
    <script type="text/javascript">
        $(".dim_sg").on("change paste keyup", function() {
            var dim  = $("#lenght_id_sg").val() *  $("#breadth_id_sg").val();
           $('#permit_size_id_sg').val(dim);
        });


        $(".calc_sg").on("change paste keyup", function() {
            var impost  = $("#rate_impost_id_sg").val() *  $("#permit_size_id_sg").val();
           $('#rate_charge_id_sg').val(impost);
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