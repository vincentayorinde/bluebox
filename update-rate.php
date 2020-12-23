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


                                $sql = "SELECT * FROM property WHERE id = {$qid}";
                                $result = $connect->query($sql);

                                $data = $result->fetch_assoc();
                            }

      if (isset($_REQUEST['uemail'])){
                         $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                         $userid                = $post['userid'];
                         $uemail                = $post['uemail'];
                         $pro_owner_name     = $post['pro_owner_name'];
                         $pro_area_category  = $post['pro_area_category'];
                         $pro_type  = $post['pro_type'];
                         $electoral_area     = $post['electoral_area'];
                         $pro_address        = $post['pro_address'];
                         $pro_hs_no          = $post['pro_hs_no'];
                         $r_value   = $post['rateable_value'];
                         $r_impose         = $post['rate_impose'];
                         $r_charge         = $post['rate_charge'];
                         // $payment            = $post['payment'];
                         // $adjustment          = $post['adjustment'];
                         $total_amount_due   = $post['total_amount_due'];

                         // Update quote exists
                              $query = "UPDATE property 
                         SET pro_owner_name='$pro_owner_name',pro_area_category='$pro_area_category',pro_type='$pro_type',r_value='$r_value',r_impose='$r_impose',r_charge='$r_charge',electoral_area='$electoral_area',pro_address='$pro_address',pro_hs_no='$pro_hs_no' WHERE id='$qid' ";
                                $result = mysqli_query($connect,$query);
                                if($result){
                                $msg = '<div class="alert alert-success">Updated successfully <a class="btn btn-info waves-effect" href="all-rates">See List</a></div>';
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
                                        <b>Property Acct. No.</b>
                                    </p>
                                    <div class="input-group">
                             <span class="input-group-addon">
                                 <i class="material-icons">perm_identity</i>
                               </span>
                                            <div class="form-line">
                          <input type="text" value="<?php if($data['pro_acct_no']){echo $data['pro_acct_no'];}else{echo "";} ?>" class="form-control" name="pro_acct_no" id="pro_acct_no_id" placeholder="Property No. will be generated automatically" disabled="">
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
                                         <input value="<?php if($data['pro_owner_name']){echo $data['pro_owner_name'];}else{echo "";} ?>" type="text" class="form-control" name="pro_owner_name" id="pro_owner_name_id"  required>
                                            
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
                            <option value="<?php if($data['pro_type']){echo $data['pro_type'];}else{echo "";} ?>"><?php if($data['pro_type']){echo $data['pro_type'];}else{echo "";} ?></option>
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
                            <option value="<?php if($data['pro_area_category']){echo $data['pro_area_category'];}else{echo "";} ?>"><?php if($data['pro_area_category']){echo $data['pro_area_category'];}else{echo "";} ?></option>
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
                                        <input  type="text" value="<?php if($data['pro_address']){echo $data['pro_address'];}else{echo "";} ?>" class="form-control" name="pro_address" id="pro_address_id" required>
                                        
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
                            <input type="text" value="<?php if($data['pro_hs_no']){echo $data['pro_hs_no'];}else{echo "";} ?>" class="form-control" name="pro_hs_no" id="pro_hs_no_id"  required>
                                            
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
                                            <input type="number" step="0.0001"  value="<?php if($data['r_value']){echo $data['r_value'];}else{echo "";} ?>" class="form-control calc" name="rateable_value" id="rateable_value_id"  required>
                                            
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
                                            <input type="number" step="0.0001"  value="<?php if($data['r_impose']){echo $data['r_impose'];}else{echo "";} ?>" class="form-control calc" name="rate_impose" id="rate_impose_id"  required>
                                            
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
                                            <input type="number" step="0.0001" value="<?php if($data['r_charge']){echo $data['r_charge'];}else{echo "";} ?>" class="form-control" name="rate_charge" id="rate_charge_id"  required>
                                            
                                        </div>
                                    </div>
                                </div>
                                    
                      
                                     
                               </div>


<div class="clearfix"></div>
                                <button class="btn btn-primary waves-effect" type="submit">Update Property</button>
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