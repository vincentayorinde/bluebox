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

                    if($_GET['id']) {
                                $id = base64_decode($_GET['id']);
                                $qid = $id;


                                $sql = "SELECT * FROM building WHERE id = {$qid}";
                                $result = $connect->query($sql);

                                $data = $result->fetch_assoc();
                            }

      if (isset($_REQUEST['uemail'])){
                         $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                 $userid                = $post['userid'];
                 $uemail                = $post['uemail'];
                 $b_permit_owner_name   = $post['b_permit_owner_name'];
                 $building_type         = $post['building_type'];
                 $permit_tel            = $post['permit_tel'];
                 $electoral_area        = $post['electoral_area'];
                 $building_address      = $post['building_address'];
                 $permit_size           = $post['permit_size'];
                 $rate_impost           = $post['rate_impost'];
                 $rate_charge           = $post['rate_charge'];

                         // Update quote exists
                              $query = "UPDATE building 
                         SET b_permit_owner_name='$b_permit_owner_name',building_type='$building_type',permit_tel='$permit_tel',electoral_area='$electoral_area',building_address='$building_address',permit_size='$permit_size',rate_impost='$rate_impost',rate_charge='$rate_charge' WHERE id='$qid' ";
                                $result = mysqli_query($connect,$query);
                                if($result){
                                $msg = '<div class="alert alert-success">Updated successfully <a class="btn btn-info waves-effect" href="all-building-permit">See List</a></div>';
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
    <title>Update Property Rate | <?php echo $name; ?></title>
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
            <div class="block-header">
                <h2>UPDATE RATE</h2>
            </div>

            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?php echo $msg; ?>
                    <div class="card">
                        <div class="header">
                            <h2>INPUT UPDATE DATA</h2>
                           <!--  <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul> -->
                        </div>
                       
                        

 <div class="body">
                            <form id="form_validation" method="POST">
                          <input hidden="" name="userid" value="<?php echo $_SESSION['user_data']['id'];?>">
                          <input hidden="" name="uemail" value="<?php echo $_SESSION['email'] ?>">
                          <input hidden="" name="company" value="<?php echo $_SESSION['user_data']['company'];?>">
                              <div class="form-group form-float">
                                 <div class="col-md-6">
                                    <p>
                                        <b>Building Permit Acct. No.</b>
                                    </p>
                                    <div class="input-group">
                             <span class="input-group-addon">
                                 <i class="material-icons">perm_identity</i>
                               </span>
                                            <div class="form-line">
                          <input type="text" value="<?php if($data['b_permit_acct_no']){echo $data['b_permit_acct_no'];}else{echo "";} ?>" class="form-control" name="b_permit_acct_no" id="b_permit_acct_no_id" placeholder="Permit Acct. No. will be generated automatically" disabled="">
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <b>Owner's Name</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">account_circle</i>
                                        </span>
                                        <div class="form-line">
                                         <input value="<?php if($data['b_permit_owner_name']){echo $data['b_permit_owner_name'];}else{echo "";} ?>" type="text" class="form-control" name="b_permit_owner_name" id="b_permit_owner_name_id"  required>
                                            
                                        </div>
                                    </div>
                                </div>
                               </div>
                         <div class="form-group form-float">
                            <div class="col-md-6">
                                   <p>
                                        <b>Property Type</b>
                                    </p>
                                    <select class="form-control show-tick"   name="building_type" id="building_type_id" required="">
                            <option value="<?php if($data['building_type']){echo $data['building_type'];}else{echo "";} ?>"><?php if($data['building_type']){echo $data['building_type'];}else{echo "";} ?></option>
                           <option value="Temporal">Temporal</option>
                            <option value="Permanent">Permanent</option>
                                    </select>
                                </div>
                                  <div class="col-md-6">
                                    <p>
                                        <b>Telephone No</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">phone</i>
                                        </span>
                                        <div class="form-line">
                                         <input value="<?php if($data['permit_tel']){echo $data['permit_tel'];}else{echo "";} ?>" type="text" class="form-control" name="permit_tel" id="permit_tel_id"  required>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                               <div class="col-md-6">
                                 <p>
                                        <b>Electoral Area</b>
                                    </p>
                <select class="form-control show-tick"   name="electoral_area" id="electoral_area_id" required="">
                                    <option value="<?php if($data['electoral_area']){echo $data['electoral_area'];}else{echo "";} ?>"><?php if($data['electoral_area']){echo $data['electoral_area'];}else{echo "";} ?></option>
                                    <option value="Klagon">Klagon</option>
                                    <option value="Lashibi">Lashibi</option>
                                    <option value="Wolei">Wolei</option>
                                    <option value="Sakumono">Sakumono</option>
                                    <option value="Kassaadjan">Kassaadjan</option>
                                    <option value="Railways">Railways</option>
                                    <option value="Baatsonaa">Baatsonaa</option>
                                    <option value="Halcrow">Halcrow</option>
                                    <option value="Adjei Kojo">Adjei Kojo</option>
                                    <option value="Kaiser">Kaiser</option>
                                    <option value="Dzata-Bu">Dzata-Bu</option>
                        </select>
                                </div>
                               
                               </div>
                                 <div class="col-md-6">
                                    <p>
                                        <b>Property Location</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">room</i>
                                        </span>
                                            <div class="form-line">
                                        <input  type="text" value="<?php if($data['building_address']){echo $data['building_address'];}else{echo "";} ?>" class="form-control" name="building_address" id="building_address_id" required>
                                        
                                    </div>
                                </div>
                                </div>
                                
                               </div>
                        <div class="form-group form-float">
                               
                                <div class="col-md-3">
                                    <p>
                                        <b>Size (M2):</b>
                                    </p>
                                    <div class="input-group">
                                       
                                        <div class="form-line">
                                            <input type="number" step="0.0001"  value="<?php if($data['permit_size']){echo $data['permit_size'];}else{echo "";} ?>" class="form-control calc" name="permit_size" id="permit_size_id"  required>
                                            
                                        </div>
                                         <span class="input-group-addon">mm
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
                                            <input type="number" step="0.0001"  value="<?php if($data['rate_impost']){echo $data['rate_impost'];}else{echo "";} ?>" class="form-control calc" name="rate_impost" id="rate_impost_id"  required>
                                            
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-3">
                                    <p>
                                        <b>Permit Charge</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">GHS
                                        </span>
                                        <div class="form-line">
                                            <input type="number" step="0.0001" value="<?php if($data['rate_charge']){echo $data['rate_charge'];}else{echo "";} ?>" class="form-control" name="rate_charge" id="rate_charge_id"  required>
                                            
                                        </div>
                                    </div>
                                </div>
                                    
                      
                                     
                               </div>


<div class="clearfix"></div>
                                <button class="btn btn-primary waves-effect" type="submit">Update Building Permit</button>
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
    <script type="text/javascript">
      function initMap() {
      var pols = document.getElementById('pol_ID');
      var autocomplete_pol = new google.maps.places.Autocomplete(pols);

      var pods = document.getElementById('pod_ID');
      var autocomplete_pod = new google.maps.places.Autocomplete(pods);
    }

    </script>
    <script src="plugins/jquery/jquery.min.js"></script>
     <script type="text/javascript">

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