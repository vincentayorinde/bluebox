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


                                $sql = "SELECT * FROM business WHERE id = {$qid}";
                                $result = $connect->query($sql);

                                $data = $result->fetch_assoc();
                            }

      if (isset($_REQUEST['uemail'])){
                         $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                         // $userid    = $post['userid'];
                         // $uemail    = $post['uemail'];
                         $ftype     = $_POST['freight_mode'];
                         // $company   = $post['company'];
                         $userid        = $post['userid'];
                         $uemail        = $post['uemail'];
                         // $b_no          = $post['b_no'];
                         $b_name        = $post['b_name'];
                         $b_type        = $post['b_type'];
                         $b_category    = $post['b_category'];
                         $e_area        = $post['electoral_area'];
                         $location      = $post['location'];
                         $name_of_ceo   = $post['name_of_ceo'];
                         $tel_no        = $post['tel_no'];
                         $b_phone_no    = $post['b_phone_no'];
                         $year          = $post['year'];

                         // Update quote exists
                              $query = "UPDATE business 
                                SET b_name='$b_name',b_type='$b_type',b_category='$b_category',electoral_area='$e_area',location='$location',name_of_ceo='$name_of_ceo',tel_no='$tel_no',b_phone_no='$b_phone_no',year='$year',user_id='$userid',user_email='$uemail' WHERE id='$qid' ";
                                $result = mysqli_query($connect,$query);
                                if($result){
                                $msg = '<div class="alert alert-success">Updated successfully <a class="btn btn-info waves-effect" href="all-business">See List</a>
                                <a class="btn btn-info waves-effect" href="print-bill-bop?id='.$qid.'&b_no='.$data['b_no'].'">Print</a></div>';
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
    <title>Update Business | <?php echo $name; ?></title>
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
                <h2>UPDATE BUSINESS</h2>
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
                                        <b>Business No.</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">perm_identity</i>
                                        </span>
                                            <div class="form-line">
                                        <input type="text" class="form-control" value="<?php echo $data['b_no']; ?>" name="b_no" placeholder="Business No. will be generated automatically" disabled="" id="b_no_id">
                                        
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                        <b>Business Name</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">business</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" value="<?php if($data['b_name']){echo $data['b_name'];}else{echo "";} ?>" placeholder="Enter business name" class="form-control" name="b_name" id="b_name_id"  required>
                                            
                                        </div>
                                    </div>
                                </div>
                               </div>
                         <div class="form-group form-float">
                                 <div class="col-md-6">
                                   <p>
                                        <b>Business Type</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">business</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" value="<?php if($data['b_type']){echo $data['b_type'];}else{echo "";} ?>" placeholder="Enter business type (eg. Cold Storage Facilities - Importers)" class="form-control" name="b_type" id="b_type_id"  required>
                                            
                                        </div>
                                   
                                </div>
                            </div>
                                <div class="col-md-3">
                                 <p>
                                        <b>Business Category</b>
                                    </p>
                                    <select class="form-control show-tick"   name="b_category" id="b_category_id" required="">
                             <option value="<?php if($data['b_category']){echo $data['b_category'];}else{echo "";} ?>"><?php if($data['b_category']){echo $data['b_category'];}else{echo "";} ?></option>
                           <option value="A-category">A-category</option>
                            <option value="B-category">B-category</option>
                            <option value="C-category">C-category</option>
                            <option value="D-category">D-category</option>
                            <option value="E-category">E-category</option>
                            <option value="F-category">F-category</option>
                            <option value="G-category">G-category</option>
                            <option value="H-category">H-category</option>
                            <option value="I-category">I-category</option>
                            <option value="J-category">J-category</option>
                               
                                    </select>
                                </div>
                                 <div class="col-md-3">
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
                               <div class="clearfix"></div>
                        <div class="form-group form-float">
                                 
                                <div class="col-md-6">
                                    <p>
                                        <b>Location</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">room</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" value="<?php if($data['location']){echo $data['location'];}else{echo "";} ?>" placeholder="Enter accurate business address" class="form-control" name="location" id="location_id"  required>
                                            
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <p>
                                        <b>Name of CEO</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">account_circle</i>
                                        </span>
                                            <div class="form-line">
                                        <input type="text"  value="<?php if($data['name_of_ceo']){echo $data['name_of_ceo'];}else{echo "";} ?>" class="form-control" placeholder="Enter CEO's full name" name="name_of_ceo" id="name_of_ceo_id" required>
                                        
                                    </div>
                                </div>
                                </div>
                                    
                               </div>
       <div class="form-group form-float">
                                <div class="col-md-3">
                                    <p>
                                        <b>Tel No.</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">phone</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" value="<?php if($data['tel_no']){echo $data['tel_no'];}else{echo "";} ?>" class="form-control" placeholder="eg. 0201112220 " name="tel_no" id="tel_no_id"  required>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <p>
                                        <b>Business Phone</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">phone</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" value="<?php if($data['b_phone_no']){echo $data['b_phone_no'];}else{echo "";} ?>"  class="form-control" placeholder="eg. 0241112220 " name="b_phone_no" id="b_phone_no_id"  required>
                                            
                                        </div>
                                    </div>
                                </div>
                                  <div class="col-md-3">
                                      <p>
                                        <b>Year of billing</b>
                                    </p>
                                   <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="year" id="year_id" value="<?php if($data['year']){echo $data['year'];}else{echo "";} ?>"  readonly>
                                            
                                        </div>
                                    </div>
                                </div>
                               </div>


<div class="clearfix"></div>
                                <button class="btn btn-primary waves-effect" type="submit">Update Business</button>
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
    async defer></script>
    <script type="text/javascript">
      function initMap() {
      var pols = document.getElementById('pol_ID');
      var autocomplete_pol = new google.maps.places.Autocomplete(pols);

      var pods = document.getElementById('pod_ID');
      var autocomplete_pod = new google.maps.places.Autocomplete(pods);
    }

    </script> -->
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