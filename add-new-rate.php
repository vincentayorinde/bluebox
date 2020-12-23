
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
      if (isset($_REQUEST['uemail'])){
                         $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                           //  generate ID NUNPR-180000001
                        $sql_ = "SELECT pro_acct_no FROM property ORDER BY id DESC LIMIT 1";
                        $result_ = $connect->query($sql_);
                        $row_ = $result_->fetch_assoc();
                        if($result_->num_rows > 0){
                            if($post['electoral_area'] == "Kloowee Koo Naa"){
                                 $p_l = 'KLOOW';
                            }else if($post['electoral_area'] == "Nkpor"){
                                 $p_l = 'NKPOR';
                            }else if($post['electoral_area'] == "Adogon"){
                                 $p_l = 'ADOGO';
                            }else if($post['electoral_area'] == "Nii Lawer"){
                                 $p_l = 'NIILA';
                            }else if($post['electoral_area'] == "Sookpoti"){
                                 $p_l = 'SOOKP';
                            }else if($post['electoral_area'] == "Nii Odai Ablade"){
                                 $p_l = 'NIIOD';
                            }else if($post['electoral_area'] == "Antwere Gonno"){
                                 $p_l = 'ANTWE';
                            }else if($post['electoral_area'] == "Blekese West"){
                                 $p_l = 'BLEWE';
                            }else if($post['electoral_area'] == "Blekese East"){
                                 $p_l = 'BLEEA';
                            }else if($post['electoral_area'] == "Mukwedjor"){
                                 $p_l = 'MUKWE';
                            }else if($post['electoral_area'] == "Baatsonaa"){
                                 $p_l = 'BAATS';
                            }else if($post['electoral_area'] == "Okpoi Gonno"){
                                 $p_l = 'OKPOI';
                            }

                           $e_id = $row_['pro_acct_no'];

                           $pieces = explode("-", $e_id);
                           $p_letter = $p_l; // piesce1
                           $p_numeric = $pieces[1] + 1; // piece2

                         
                         $pro_acct_no        = $p_letter .'-'. $p_numeric;
                      

                         $userid             = $post['userid'];
                         $uemail             = $post['uemail'];
                         $pro_owner_name     = $post['pro_owner_name'];
                         $pro_area_category  = $post['pro_area_category'];
                         $electoral_area     = $post['electoral_area'];
                         $pro_address        = $post['pro_address'];
                         $pro_hs_no          = $post['pro_hs_no'];
                         $pro_type         = $post['pro_type'];
                         $r_value   = $post['rateable_value'];
                         $r_impose         = $post['rate_impose'];
                         $r_charge         = $post['rate_charge'];
                         // $rateable_value     = $post['rateable_value'];
                         // $rate_impose        = $post['rate_impose'];
                         // $rate_charge        = $post['rate_charge'];
                         // $arrears            = $post['arrears'];
                         // $payment            = $post['payment'];
                         // $adjustment          = $post['adjustment'];
                         // $total_amount_due   = $post['total_amount_due'];

                         // Check if quote exists
                        $sql = "SELECT * FROM property WHERE user_email = '$uemail' AND pro_acct_no = '$pro_acct_no'";
                        $result = $connect->query($sql);
                        $row = $result->fetch_assoc();
                        if($result->num_rows > 0){
                             $msg = '<div class="alert alert-danger">Sorry! Data already exist. <a class="btn btn-info waves-effect" href="all-business">See List</a></div>';
                         }else{
                 $query = "INSERT INTO property (pro_acct_no,pro_owner_name,pro_area_category,pro_type,r_value,r_impose,r_charge,electoral_area,pro_address,pro_hs_no,user_id,user_email,activ) VALUES
     ('$pro_acct_no','$pro_owner_name','$pro_area_category','$pro_type','$r_value','$r_impose','$r_charge','$electoral_area','$pro_address','$pro_hs_no','$userid','$uemail','Y')";
                                            $result = mysqli_query($connect,$query);

                   $query_ = "INSERT INTO property_payment (pro_acct_no, rateable_value, rate_impose, rate_charge, arrears, paid, total_amt_due, bal, payment_mode,bank,cheque_no,gcr,user_id,user_email,activ)VALUES('$pro_acct_no', '$r_value', '$r_impose', '$r_charge', '0', '0', '0', '0', 'NA','NA','NA','NA','$userid','$uemail','Y')";
                                $result_ = mysqli_query($connect,$query_);
                        if($result==1 && $result_ ==1){

                        $sqlss = "SELECT * FROM property_payment WHERE pro_acct_no = '$pro_acct_no' order by id desc";
                                            $resultss = $connect->query($sqlss);
                                            $data_ = $resultss->fetch_assoc();
                                            $id_ = $data_["id"];
                                            $p_no_ = $data_["pro_acct_no"];

                                $msg = '<div class="alert alert-success">Data Added successfully<a class="btn btn-info waves-effect" href="all-rates">See List</a>
                                <a class="btn btn-info waves-effect" href="print-bill-propertyr?id='.$id_.'&p_no='.$p_no_.'">
                                                   Print Bill </a>
                                </div>';

                         }
                     }
                 }
                 }

    ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Add New Property Rate | <?php echo $name; ?></title>
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
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 400px;
        width: 100%;
      }
      
</style>

    <?php include 'includes/left-sidebar.php'; ?>

    <!-- Right Bar -->
    <?php include 'includes/right-sidebar.php'; ?>


    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>ADD NEW PROPERTY RATE</h2>
            </div>

            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?php echo $msg; ?>
                    <div class="card">
                        <div class="header">
                            <h2>PROPERTY DETAILS</h2>
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST">
                          <input hidden="" name="userid" value="<?php echo $_SESSION['user_data']['id'];?>">
                          <input hidden="" name="uemail" value="<?php echo $_SESSION['email'] ?>">
                          <input hidden="" name="company" value="<?php echo $_SESSION['user_data']['company'];?>">
                        <div id="property-rate-form">
                              <div class="form-group form-float">
                                 <div class="col-md-6">
                                    <p>
                                        <b>Property Acct. No.</b>
                                    </p>
                                    <div class="input-group">
                             <span class="input-group-addon">
                                 <i class="material-icons">perm_identity</i>
                               </span>
                                            <div class="form-line">
                          <input type="text" class="form-control" name="pro_acct_no" id="pro_acct_no_id" placeholder="Property No. will be generated automatically" disabled="">
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <b>Business Owner's Name</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">account_circle</i>
                                        </span>
                                        <div class="form-line">
                                         <input type="text" placeholder="Enter property owner's name" class="form-control" name="pro_owner_name" id="pro_owner_name_id"  required>
                                            
                                        </div>
                                    </div>
                                </div>
                               </div>
                         <div class="form-group form-float">
                             <div class="col-md-4">
                                   <p>
                                        <b>Property Type</b>
                                    </p>
                                    <select class="form-control show-tick"   name="pro_type" id="pro_type_id" required="">
                            <option value="N\A">Select Property Type</option>
                            <option value="Residential">Residential</option>
                            <option value="Industrial">Industrial</option>
                            <option value="Commercial">Commercial</option>
                            <option value="Mixed used">Mixed used</option>
                            <option value="Telecomminication">Telecomminication</option>
                            <option value="Transformers">Transformers</option>
                               
                                    </select>
                                </div>
                                 <div class="col-md-4">
                                   <p>
                                        <b>Area Category</b>
                                    </p>
                                    <select class="form-control show-tick"   name="pro_area_category" id="pro_area_category_id" required="">
                            <option value="N\A">Select Category</option>
                            <option value="1st Class">1st Class</option>
                            <option value="2nd Class">2nd Class</option>
                            <option value="3rd Class">3rd Class</option>
                               
                                    </select>
                                </div>
                               <div class="col-md-4">
                                 <p>
                                        <b>Electoral Area</b>
                                    </p>
                <select class="form-control show-tick"   name="electoral_area" id="electoral_area_id" required="">
                             <option value="N\A">Select Area</option>
                                    <option value="Kloowee Koo Naa">Kloowee Koo Naa</option>
                                    <option value="Nkpor">Nkpor</option>
                                    <option value="Adogon">Adogon</option>
                                    <option value="Nii Lawer">Nii Lawer</option>
                                    <option value="Sookpoti">Sookpoti</option>
                                    <option value="Nii Odai Ablade">Nii Odai Ablade</option>
                                    <option value="Antwere Gonno">Antwere Gonno</option>
                                    <option value="Blekese West">Blekese West</option>
                                    <option value="Blekese East">Blekese East</option>
                                    <option value="Mukwedjor">Mukwedjor</option>
                                    <option value="Baatsonaa">Baatsonaa</option>
                                    <option value="Okpoi Gonno">Okpoi Gonno</option>
                        </select>
                                </div>
                               
                               </div>
                                   <div class="form-group form-float">
                                 <div class="col-md-6">
                                    <p>
                                        <b>Address</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">room</i>
                                        </span>
                                            <div class="form-line">
                                        <input type="text" placeholder="Enter accurate property address" class="form-control" name="pro_address" id="pro_address_id" >
                                        
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <b>House No.</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">account_circle</i>
                                        </span>
                            <div class="form-line">

                            <input type="text" placeholder="Enter house no." class="form-control" name="pro_hs_no" id="pro_hs_no_id" >
                                            
                                        </div>
                                    </div>
                                </div>
                               </div>
                       <div class="form-group form-float">
                               
                                <div class="col-md-3">
                                    <p>
                                        <b>Rateable Value</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">GHS
                                        </span>
                                        <div class="form-line">
                                            <input type="number" placeholder="00.00" step="0.0001" min="0" class="form-control calc" name="rateable_value" id="rateable_value_id"  required>
                                            
                                        </div>
                                    </div>
                                </div>
                                 
                                <div class="col-md-3">
                                    <p>
                                        <b>Rate Impost</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">GHS
                                        </span>
                                        <div class="form-line">
                                            <input type="number" placeholder="00.00" step="0.0001"  min="0"  class="form-control calc" name="rate_impose" id="rate_impose_id"  required>
                                            
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
                                            <input type="number" placeholder="00.00" step="0.0001" min="0"  class="form-control" name="rate_charge" id="rate_charge_id"  required>
                                            
                                        </div>
                                    </div>
                                </div>
                                     <!-- <div class="col-md-3">
                                    <p>
                                        <b>Arrears</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">GHS
                                        </span>
                                        <div class="form-line">
                                        <input type="number" placeholder="00.00" min="0" class="form-control" name="arrears" id="arrears_id"  required>
                                            
                                        </div>
                                    </div>
                                </div> -->
                               </div> 
                    <!--    <div class="form-group form-float">
                               <div class="col-md-4">
                                    <p>
                                        <b>Total Amount Due</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">GHS
                                        </span>
                                        <div class="form-line">
                                            <input type="number" placeholder="00.00" min="0" class="form-control" name="total_amount_due" id="total_amount_due_id"  required>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <b>Payment</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">GHS
                                        </span>
                                        <div class="form-line">
                                        <input type="number" placeholder="00.00" min="0"  class="form-control" name="payment" id="payment_id"  required>
                                            
                                        </div>
                                    </div>
                                </div>
                               </div> -->

<div class="clearfix"></div>
                                <button class="btn btn-primary waves-effect" type="submit">Add Property</button>

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
   

 <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtwdU-k6I92E2C6zqsC6xPFlRUACzhmXc&libraries=places&callback=initMap"
    async defer></script> -->
  
      <script src="plugins/jquery/jquery.min.js"></script> 
      <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtwdU-k6I92E2C6zqsC6xPFlRUACzhmXc&libraries=places&callback=initMap">
    </script>
  <script type="text/javascript">
      function initMap() {
        var address = document.getElementById('pro_address_id');
        var autocomplete_address = new google.maps.places.Autocomplete(address);

}

    </script>
     <script type="text/javascript">

        $(".calc").on("change paste keyup", function() {
            var impost  = $("#rate_impose_id").val() *  $("#rateable_value_id").val();
           $('#rate_charge_id').val(impost);
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