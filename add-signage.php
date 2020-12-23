
<?php 
error_reporting(1);
// error_reporting(E_ALL);
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
                        $sql_ = "SELECT signage_acct_no FROM signage ORDER BY id DESC LIMIT 1";
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

                           $e_id = $row_['signage_acct_no'];

                           $pieces = explode("-", $e_id);
                           $p_letter = $p_l; // piesce1
                           $p_numeric = $pieces[1] + 1; // piece2

                         
                         $signage_acct_no        = $p_letter .'-'. $p_numeric;
                     

                 $userid                = $post['userid'];
                 $uemail                = $post['uemail'];

                if($post['signage_acct_name']){
                    $signage_acct_name = $post['signage_acct_name'];
                 }
                 if($post['signage_acct_name_new']){
                    $signage_acct_name = $post['signage_acct_name_new'];
                 }

                 $signage_tel           = $post['signage_tel'];
                 $signage_town        = $post['signage_town'];

                 if($post['electoral_area_asene'] == true){
                    $electoral_area = $post['electoral_area_asene'];
                 }
                 if ($post['electoral_area_manso'] == true) {
                     $electoral_area = $post['electoral_area_manso'];
                 }
                 if ($post['electoral_area_akroso'] == true) {
                     $electoral_area = $post['electoral_area_akroso'];
                 }

                 $signage_address       = $post['signage_address'];
                 $permit_size           = $post['permit_size'];
                 $rate_impost           = $post['rate_impost'];
                 $rate_charge           = $post['rate_charge'];


                         // Check if quote exists
                        $sql = "SELECT * FROM signage WHERE user_email = '$uemail' AND signage_acct_no = '$signage_acct_no'";
                        $result = $connect->query($sql);
                        $row = $result->fetch_assoc();
                        if($result->num_rows > 0){
                             $msg = '<div class="alert alert-danger">Sorry! Data already exist. <a class="btn btn-info waves-effect" href="all-business">See List</a></div>';
                         }else{
                 $query = "INSERT INTO signage (signage_acct_no,signage_acct_name,signage_tel,signage_town,electoral_area,signage_address,permit_size,rate_impost,rate_charge,user_id,user_email,activ) VALUES
     ('$signage_acct_no','$signage_acct_name','$signage_tel','$signage_town','$electoral_area','$signage_address','$permit_size','$rate_impost','$rate_charge','$userid','$uemail','Y')";
                                            $result = mysqli_query($connect,$query);

                   $query_ = "INSERT INTO signage_payment (signage_acct_no, rate_impost, rate_charge, arrears, paid, total_amt_due, bal, payment_mode,bank,cheque_no,gcr,user_id,user_email,activ)VALUES('$signage_acct_no','$rate_impost', '$rate_charge', '0', '0', '0', '0', 'NA','NA','NA','NA','$userid','$uemail','Y')";
                                $result_ = mysqli_query($connect,$query_);
                        if($result==1 && $result_ ==1){

                        $sqlss = "SELECT * FROM signage_payment WHERE signage_acct_no = '$signage_acct_no' order by id desc";
                                            $resultss = $connect->query($sqlss);
                                            $data_ = $resultss->fetch_assoc();
                                            $id_ = $data_["id"];
                                            $p_no_ = $data_["signage_acct_no"];

                                $msg = '<div class="alert alert-success">Data Added successfully<a class="btn btn-info waves-effect" href="all-signage">See List</a>
                                <a class="btn btn-info waves-effect" href="print-bill-signage?id='.$id_.'&p_no='.$p_no_.'">
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
    <title>Add New Sinage | <?php echo $name; ?></title>
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
                <h2>ADD NEW SIGNAGE</h2>
            </div>

            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?php echo $msg; ?>
                    <div class="card">
                        <div class="header">
                            <h2>SIGNAGE DETAILS</h2>
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST">
                          <input hidden="" name="userid" value="<?php echo $_SESSION['user_data']['id'];?>">
                          <input hidden="" name="uemail" value="<?php echo $_SESSION['email'] ?>">
                          <input hidden="" name="company" value="<?php echo $_SESSION['user_data']['company'];?>">
                            

                    <!-- SIGNAGE FORM -->
                    <div id="signage_form">
                              <div class="form-group form-float">
                                 <div class="col-md-4">
                                    <p>
                                        <b>Signage Acct. No.</b>
                                    </p>
                                    <div class="input-group">
                             <span class="input-group-addon">
                                 <i class="material-icons">perm_identity</i>
                               </span>
                                            <div class="form-line">
                          <input type="text" class="form-control" name="signage_acct_no" id="signage_acct_no_id" placeholder="Signage Acct. No. will be generated" disabled="">
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-4">
                                   <p>
                                        <b>Select Business name</b>
                                    </p>
                                   <select class="form-control show-tick"   name="signage_acct_name" id="signage_acct_name_id" required="">
                                        <option value="NA">Search BOP Acct. No or Owner Name</option>
                                        <option value="NA">No Account</option>
                                        <?php 
    // SQL to gather their entire PM List
    $sql = mysqli_query($connect, "SELECT * FROM business ORDER BY id DESC LIMIT 100");
    while($row = mysqli_fetch_assoc($sql)){
        ?>
                            
        <option value="<?php echo $row['b_name']?>"><?php echo $row['b_no'].' - '. $row['b_name']; ; ?></option>
                     <?php } ?>          
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <b> Business Name (Optional)</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">account_circle</i>
                                        </span>
                                        <div class="form-line">
                                         <input type="text" placeholder="Only if business does not exist" class="form-control" name="signage_acct_name_new" id="signage_acct_name_new_id">
                                            
                                        </div>
                                    </div>
                                </div>
                               </div>
                         <div class="form-group form-float">
                            
                <div class="col-md-6" id="electoral_area">
                                 <p>
                                        <b>Electoral Area</b>
                                    </p>
                <select class="form-control show-tick"   name="electoral_area" id="electorial_area_id">
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
                                        <b>Telephone No.</b>
                                    </p>
                                    <div class="input-group">
                                     <span class="input-group-addon">
                                            <i class="material-icons">phone</i>
                                        </span>
                                   <div class="form-line">
                                         <input type="text" placeholder="Enter phone No." class="form-control" name="signage_tel" id="signage_tel_id"  required>
                                            
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <p>
                                        <b>Sinage Location</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">room</i>
                                        </span>
                                            <div class="form-line">
                                        <input type="text" placeholder="Enter accurate Signage address" class="form-control" name="signage_address" id="signage_address_id" >
                                        
                                    </div>
                                </div>
                                </div>
                            </div>
                               
                               
                               
                                 
                                
                            
                       <div class="form-group form-float">
                                <div class="col-md-3">
                                    <p>
                                        <b>Dimension (L):</b>
                                    </p>
                                    <div class="input-group">
                                       
                                        <div class="form-line">
                                            <input type="number" placeholder="00.00" step="0.0001" min="0" class="form-control dim" name="lenght" id="lenght_id"  required>
                                            
                                        </div> <span class="input-group-addon">mm
                                        </span>
                                    </div>
                                </div>
                                  <div class="col-md-3">
                                    <p>
                                        <b>Dimension (B):</b>
                                    </p>
                                    <div class="input-group">
                                       
                                        <div class="form-line">
                                            <input type="number" placeholder="00.00" step="0.0001" min="0" class="form-control dim" name="breadth" id="breadth_id"  required>
                                            
                                        </div> <span class="input-group-addon">mm
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <p>
                                        <b>Size (M2):</b>
                                    </p>
                                    <div class="input-group">
                                       
                                        <div class="form-line">
                                            <input type="number" placeholder="00.00" step="0.0001" min="0" class="form-control calc" name="permit_size" id="permit_size_id"  required>
                                            
                                        </div> <span class="input-group-addon">mm
                                        </span>
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
                                            <input type="number" placeholder="00.00" step="0.0001"  min="0"  class="form-control calc" name="rate_impost" id="rate_impost_id"  required>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="form-group form-float">
                                 <div class="col-md-3">
                                    <p>
                                        <b>Permit Charge</b>
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
                                <button class="btn btn-primary waves-effect" type="submit">Add Building Permit</button>

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
        // $(document).ready(function() {
        //          $("#asene_area_id").hide();
        //             $("#manso_area_id").hide();
        //             $("#akroso_area_id").hide();
                
        //     });
        //     $('#signage_town_id').on('change', function() {
        //     var value  = $(this).val();
        //       if(value == "Asene"){
        //             $("#asene_area_id").show();
        //             $("#manso_area_id").hide();
        //             $("#akroso_area_id").hide();
        //       }
        //        if(value == "Manso"){
        //             $("#manso_area_id").show();
        //              $("#asene_area_id").hide();
        //              $("#akroso_area_id").hide();
        //       }
        //       if(value == "Akroso"){
        //             $("#akroso_area_id").show();
        //             $("#manso_area_id").hide();
        //             $("#asene_area_id").hide();
        //       }
        // });
</script>
  <script type="text/javascript">
      function initMap() {
        var address = document.getElementById('building_address_id');
        var autocomplete_address = new google.maps.places.Autocomplete(address);

}

    </script>
     <script type="text/javascript">
        $(".dim").on("change paste keyup", function() {
            var dim  = $("#lenght_id").val() *  $("#breadth_id").val();
           $('#permit_size_id').val(dim);
        });


        $(".calc").on("change paste keyup", function() {
            var impost  = $("#rate_impost_id").val() *  $("#permit_size_id").val();
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