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

      if (isset($_REQUEST['uemail'])){
                         $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


                           //  generate ID NUNBOP-180000001

                        $sql_ = "SELECT b_no FROM business ORDER BY id DESC LIMIT 1";
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
                          
                           $e_id = $row_['b_no'];
                           $pieces = explode("-", $e_id);
                           $p_letter = $p_l; // piesce1
                           $p_numeric = $pieces[1] + 1; // piece2

                         
                         $b_no        = $p_letter .'-'. $p_numeric;
                      

                         $userid        = $post['userid'];
                         $uemail        = $post['uemail'];
                         $first_name    = $post['first_name'];
                         $last_name     = $post['last_name'];
                         // $b_no          = $post['b_no'];
                         $b_name        = $post['b_name'];
                         $b_type        = $post['b_type'];
                         $b_category    = $post['b_category'];
                         $e_area        = $post['electoral_area'];
                         $location      = $post['location'];
                         $name_of_ceo   = $post['name_of_ceo'];
                         $tel_no        = $post['tel_no'];
                         $b_phone_no    = $post['b_phone_no'];
                         $b_charge      = $post['b_charge'];
                         $year          = $post['year'];
                         $date = date('Y-m-d');

                         // Check if quote exists
                        $sql = "SELECT * FROM business WHERE user_email = '$uemail' AND b_no = '$b_no'";
                        $result = $connect->query($sql);
                        $row = $result->fetch_assoc();
                        if($result->num_rows > 0){
                             $msg = '<div class="alert alert-danger">Sorry! Data already exist. <a class="btn btn-info waves-effect" href="all-business">See List</a></div>';
                         }else{
                            $query = "INSERT INTO business (b_no,b_name,b_type,b_category,electoral_area,location,name_of_ceo,tel_no,b_phone_no,b_charge,year,user_id,user_email,first_name, last_name,activ) VALUES
                      ('$b_no','$b_name','$b_type','$b_category','$e_area','$location','$name_of_ceo','$tel_no','$b_phone_no','$b_charge','$year','$userid','$uemail','$first_name','$last_name','Y')";
                                            $result = mysqli_query($connect,$query);

                             $query_ = "INSERT INTO bop_payment (b_no,b_name,payment_mode,paid,bal,b_charge,arrears,bank,cheque_no,gcr,user_id,user_email,first_name,last_name,date_,activ) VALUES
                  ('$b_no','$b_name','NA','0','0','$b_charge','0','NA','NA','NA','$userid','$uemail','$first_name','$last_name','$date','Y')";
                                $result_ = mysqli_query($connect,$query_);
                        if($result==1 && $result_ ==1){

                        $sqlss = "SELECT id,b_no,b_name,payment_mode,paid,bal,b_charge,arrears,bank,cheque_no,user_id,user_email FROM bop_payment WHERE b_no = '$b_no' order by id desc";
                                            $resultss = $connect->query($sqlss);
                                            $data_ = $resultss->fetch_assoc();
                                            $id_ = $data_["id"];
                                            $b_no_ = $data_["b_no"];

                                $msg = '<div class="alert alert-success">Data Added successfully<a class="btn btn-info waves-effect" href="bop-payment-list">See List</a>
                                <a class="btn btn-info waves-effect" href="print-bill-bop?id='.$id_.'&b_no='.$b_no_.'">
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
    <title>Add New Business Permit | <?php echo $name; ?></title>
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
                <h2>ADD NEW BUSINESS PERMIT</h2>
            </div>

            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?php echo $msg; ?>
                    <div class="card">
                        <div class="header">
                   
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST">
                          <input hidden="" name="userid" value="<?php echo $_SESSION['user_data']['id'];?>">
                          <input hidden="" name="uemail" value="<?php echo $_SESSION['email'] ?>">
                          <input hidden="" name="first_name" value="<?php echo $first_name; ?>">
                          <input hidden="" name="last_name" value="<?php echo $last_name; ?>">
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
                                        <input type="text" class="form-control" name="b_no" placeholder="Business No. will be generated automatically" disabled="" id="b_no_id">
                                        
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
                                            <input type="text" placeholder="Enter business name" class="form-control" name="b_name" id="b_name_id"  required>
                                            
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
                                            <input type="text" placeholder="Enter business type (eg. Cold Storage Facilities - Importers)" class="form-control" name="b_type" id="b_type_id"  required>
                                            
                                        </div>
                                   
                                </div>
                            </div>
                                
                                <div class="col-md-3">
                                 <p>
                                        <b>Business Category</b>
                                    </p>
                                    <select class="form-control show-tick"   name="b_category" id="b_category_id" required="">
                            <option value="N\A">Select Category</option>
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
                                    <!-- <option value="N\A">Select Area</option>
                                    <option value="Awisa West Asene">Awisa West Asene</option>
                                    <option value="Odunmase Asene">Odunmase Asene</option>
                                    <option value="Awisa East Asene">Awisa East Asene</option>
                                    <option value="Beposo Manso">Beposo Manso</option>
                                    <option value="Petenyinase">Petenyinase</option>
                                    <option value="Dadiesoaba Manso">Dadiesoaba Manso</option>
                                    <option value="Amantem Nkwantao">Amantem Nkwanta</option>
                                    <option value="Suponso">Suponso</option>
                                    <option value="Asuboa">Asuboa</option>
                                    <option value="Salem Asuboa">Salem Asuboa</option>
                                    <option value="Asanteman">Asanteman</option>
                                    <option value="Mofram">Mofram</option>
                                    <option value="Amanfrom Akroso">Amanfrom Akroso</option>
                                    <option value="Nkwantanam Akroso">Nkwantanam Akroso</option>
                                    <option value="Apontuaso Akroso">Apontuaso Akroso</option>
                                    <option value="Kyinso Akroso">Kyinso Akroso</option>
                                    <option value="Akroso New Town">Akroso New Town</option>
                                    <option value="Asuoso">Asuoso</option>
                                    <option value="Badukrom/ Tabita">Badukrom/ Tabita</option>
                                    <option value="Teacher Atta">Teacher Atta</option>
                                    <option value="Bantama">Bantama</option>
                                    <option value="Eshiem">Eshiem</option> -->
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
                               <div class="clearfix"></div>
                        <div class="form-group form-float">
                             <div class="col-md-4">
                                    <!-- Geomap Location -->
                                    <p>
                                        <b>Ghana Post GPS</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">room</i>
                                        </span>
                            <div class="form-line">
                        <input type="text" placeholder="e.g. GA-090111" class="form-control" name="postgps" id="postgps_id">
                                            
                                        </div>
                                    </div>
                                </div>
                                 
                                <div class="col-md-4">
                                    <!-- Geomap Location -->
                                    <p>
                                        <b>Location</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">room</i>
                                        </span>
                            <div class="form-line">
                        <input type="text" placeholder="Enter accurate business address" class="form-control" name="location" id="location_id">
                                            
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                    <p>
                                        <b>Busines Owner's Name</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">account_circle</i>
                                        </span>
                                            <div class="form-line">
                                        <input type="text" class="form-control" placeholder="Enter CEO's full name" name="name_of_ceo" id="name_of_ceo_id" required>
                                        
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
                                            <input type="text" class="form-control" placeholder="eg. 0201112220 " maxlength="10" name="tel_no" id="tel_no_id"  >
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <p>
                                        <b>Business Phone (Opt.)</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">phone</i>
                                        </span>
                                        <div class="form-line">
                            <input type="text" class="form-control" placeholder="eg. 0241112220" maxlength="10" name="b_phone_no" id="b_phone_no_id">
                                            
                                        </div>
                                    </div>
                                </div>
                                  <div class="col-md-3">
                                    <p>
                                        <b>BOP Charge</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">GHS
                                        </span>
                                        <div class="form-line">
                                            <input type="number" placeholder="00.00" min="0"  class="form-control" name="b_charge" id="b_charge_id"  required>
                                            
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
                                            <input type="text" class="form-control" name="year" id="year_id" value="<?php echo date("Y"); ?>"  readonly>
                                            
                                        </div>
                                    </div>
                                </div>
                               </div>


<div class="clearfix"></div>
                                <!-- <div class="form-group">
                                    <input type="checkbox" id="checkbox" name="checkbox">
                                    <label for="checkbox">I have read and accept the terms</label>
                                </div> -->
                                <button class="btn btn-primary waves-effect" type="submit">Add Business</button>
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
      var loc = document.getElementById('location_id');
      var autocomplete_loc = new google.maps.places.Autocomplete(loc);

    }

    </script>
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