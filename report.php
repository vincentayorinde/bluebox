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


    // BOP ENTRY

      if (isset($_POST['add_bop'])){
                         $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


                           //  generate ID NUNBOP-180000001

                        $sql_ = "SELECT b_no FROM business ORDER BY id DESC LIMIT 1";
                        $result_ = $connect->query($sql_);
                        $row_ = $result_->fetch_assoc();
                         if($result_->num_rows > 0){
                           if($post['electoral_area_bop'] == "Kloowee Koo Naa"){
                                 $p_l = 'KLOOW';
                            }else if($post['electoral_area_bop'] == "Nkpor"){
                                 $p_l = 'NKPOR';
                            }else if($post['electoral_area_bop'] == "Adogon"){
                                 $p_l = 'ADOGO';
                            }else if($post['electoral_area_bop'] == "Nii Lawer"){
                                 $p_l = 'NIILA';
                            }else if($post['electoral_area_bop'] == "Sookpoti"){
                                 $p_l = 'SOOKP';
                            }else if($post['electoral_area_bop'] == "Nii Odai Ablade"){
                                 $p_l = 'NIIOD';
                            }else if($post['electoral_area_bop'] == "Antwere Gonno"){
                                 $p_l = 'ANTWE';
                            }else if($post['electoral_area_bop'] == "Blekese West"){
                                 $p_l = 'BLEWE';
                            }else if($post['electoral_area_bop'] == "Blekese East"){
                                 $p_l = 'BLEEA';
                            }else if($post['electoral_area_bop'] == "Mukwedjor"){
                                 $p_l = 'MUKWE';
                            }else if($post['electoral_area_bop'] == "Baatsonaa"){
                                 $p_l = 'BAATS';
                            }else if($post['electoral_area_bop'] == "Okpoi Gonno"){
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
                         $b_name        = $post['b_name_bop'];
                         $b_type        = $post['b_type_bop'];
                         $b_category    = $post['b_category_bop'];
                         $e_area        = $post['electoral_area_bop'];
                         $location      = $post['location_bop'];
                         $name_of_ceo   = $post['name_of_ceo_bop'];
                         $tel_no        = $post['tel_no_bop'];
                         $b_phone_no    = $post['b_phone_no_bop'];
                         $b_charge      = $post['b_charge_bop'];
                         $year          = $post['year_bop'];

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

                             $query_ = "INSERT INTO bop_payment (b_no,b_name,payment_mode,paid,bal,b_charge,arrears,bank,cheque_no,gcr,user_id,user_email,activ) VALUES
                  ('$b_no','$b_name','NA','0','0','$b_charge','0','NA','NA','NA','$userid','$uemail','Y')";
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





// PROPERTY RATE ENTRY

 if (isset($_POST['add_property_rate'])){
                         $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                           //  generate ID NUNPR-180000001
                        $sql_ = "SELECT pro_acct_no FROM property ORDER BY id DESC LIMIT 1";
                        $result_ = $connect->query($sql_);
                        $row_ = $result_->fetch_assoc();
                        if($result_->num_rows > 0){
                            if($post['electoral_area_pr'] == "Kloowee Koo Naa"){
                                 $p_l = 'KLOOW';
                            }else if($post['electoral_area_pr'] == "Nkpor"){
                                 $p_l = 'NKPOR';
                            }else if($post['electoral_area_pr'] == "Adogon"){
                                 $p_l = 'ADOGO';
                            }else if($post['electoral_area_pr'] == "Nii Lawer"){
                                 $p_l = 'NIILA';
                            }else if($post['electoral_area_pr'] == "Sookpoti"){
                                 $p_l = 'SOOKP';
                            }else if($post['electoral_area_pr'] == "Nii Odai Ablade"){
                                 $p_l = 'NIIOD';
                            }else if($post['electoral_area_pr'] == "Antwere Gonno"){
                                 $p_l = 'ANTWE';
                            }else if($post['electoral_area_pr'] == "Blekese West"){
                                 $p_l = 'BLEWE';
                            }else if($post['electoral_area_pr'] == "Blekese East"){
                                 $p_l = 'BLEEA';
                            }else if($post['electoral_area_pr'] == "Mukwedjor"){
                                 $p_l = 'MUKWE';
                            }else if($post['electoral_area_pr'] == "Baatsonaa"){
                                 $p_l = 'BAATS';
                            }else if($post['electoral_area_pr'] == "Okpoi Gonno"){
                                 $p_l = 'OKPOI';
                            }

                           $e_id = $row_['pro_acct_no'];

                           $pieces = explode("-", $e_id);
                           $p_letter = $p_l; // piesce1
                           $p_numeric = $pieces[1] + 1; // piece2

                         
                         $pro_acct_no        = $p_letter .'-'. $p_numeric;
                      

                         $userid             = $post['userid'];
                         $uemail             = $post['uemail'];
                         $pro_owner_name     = $post['pro_owner_name_pr'];
                         $pro_area_category  = $post['pro_area_category_pr'];
                         $electoral_area     = $post['electoral_area_pr'];
                         $pro_address        = $post['pro_address_pr'];
                         $pro_hs_no          = $post['pro_hs_no_pr'];
                         $pro_type         = $post['pro_type_pr'];
                         $r_value   = $post['rateable_value_pr'];
                         $r_impose         = $post['rate_impose_pr'];
                         $r_charge         = $post['rate_charge_pr'];
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








// BUILDING PERMIT

   if (isset($_POST['add_building_permit'])){
                         $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                           //  generate ID NUNPR-180000001
                        $sql_ = "SELECT b_permit_acct_no FROM building ORDER BY id DESC LIMIT 1";
                        $result_ = $connect->query($sql_);
                        $row_ = $result_->fetch_assoc();
                        if($result_->num_rows > 0){

                             if($post['electoral_area_bp'] == "Kloowee Koo Naa"){
                                 $p_l = 'KLOOW';
                            }else if($post['electoral_area_bp'] == "Nkpor"){
                                 $p_l = 'NKPOR';
                            }else if($post['electoral_area_bp'] == "Adogon"){
                                 $p_l = 'ADOGO';
                            }else if($post['electoral_area_bp'] == "Nii Lawer"){
                                 $p_l = 'NIILA';
                            }else if($post['electoral_area_bp'] == "Sookpoti"){
                                 $p_l = 'SOOKP';
                            }else if($post['electoral_area_bp'] == "Nii Odai Ablade"){
                                 $p_l = 'NIIOD';
                            }else if($post['electoral_area_bp'] == "Antwere Gonno"){
                                 $p_l = 'ANTWE';
                            }else if($post['electoral_area_bp'] == "Blekese West"){
                                 $p_l = 'BLEWE';
                            }else if($post['electoral_area_bp'] == "Blekese East"){
                                 $p_l = 'BLEEA';
                            }else if($post['electoral_area_bp'] == "Mukwedjor"){
                                 $p_l = 'MUKWE';
                            }else if($post['electoral_area_bp'] == "Baatsonaa"){
                                 $p_l = 'BAATS';
                            }else if($post['electoral_area_bp'] == "Okpoi Gonno"){
                                 $p_l = 'OKPOI';
                            }

                           $e_id = $row_['b_permit_acct_no'];

                           $pieces = explode("-", $e_id);
                           $p_letter = $p_l; // piesce1
                           $p_numeric = $pieces[1] + 1; // piece2

                         
                         $b_permit_acct_no        = $p_letter .'-'. $p_numeric;
                     

                 $userid                = $post['userid'];
                 $uemail                = $post['uemail'];
                 $b_permit_owner_name   = $post['b_permit_owner_name_bp'];
                 $building_type         = $post['building_type_bp'];
                 $permit_tel            = $post['permit_tel_bp'];
                 $electoral_area        = $post['electoral_area_bp'];
                 $building_address      = $post['building_addressbp'];
                 $permit_size           = $post['permit_size_bp'];
                 $rate_impost           = $post['rate_impost_bp'];
                 $rate_charge           = $post['rate_charge_bp'];


                         // Check if quote exists
                        $sql = "SELECT * FROM building WHERE user_email = '$uemail' AND b_permit_acct_no = '$b_permit_acct_no'";
                        $result = $connect->query($sql);
                        $row = $result->fetch_assoc();
                        if($result->num_rows > 0){
                             $msg = '<div class="alert alert-danger">Sorry! Data already exist. <a class="btn btn-info waves-effect" href="all-business">See List</a></div>';
                         }else{
                 $query = "INSERT INTO building (b_permit_acct_no,b_permit_owner_name,building_type,permit_tel,electoral_area,building_address,permit_size,rate_impost,rate_charge,user_id,user_email,activ) VALUES
     ('$b_permit_acct_no','$b_permit_owner_name','$building_type','$permit_tel','$electoral_area','$building_address','$permit_size','$rate_impost','$rate_charge','$userid','$uemail','Y')";
                                            $result = mysqli_query($connect,$query);

                   $query_ = "INSERT INTO building_payment (b_permit_acct_no, rate_impost, rate_charge, arrears, paid, total_amt_due, bal, payment_mode,bank,cheque_no,gcr,user_id,user_email,activ)VALUES('$b_permit_acct_no','$rate_impost', '$rate_charge', '0', '0', '0', '0', 'NA','NA','NA','NA','$userid','$uemail','Y')";
                                $result_ = mysqli_query($connect,$query_);
                        if($result==1 && $result_ ==1){

                        $sqlss = "SELECT * FROM building_payment WHERE b_permit_acct_no = '$b_permit_acct_no' order by id desc";
                                            $resultss = $connect->query($sqlss);
                                            $data_ = $resultss->fetch_assoc();
                                            $id_ = $data_["id"];
                                            $p_no_ = $data_["b_permit_acct_no"];

                                $msg = '<div class="alert alert-success">Data Added successfully<a class="btn btn-info waves-effect" href="all-rates">See List</a>
                                <a class="btn btn-info waves-effect" href="print-bill-b-permit?id='.$id_.'&p_no='.$p_no_.'">
                                                   Print Bill </a>
                                </div>';

                         }
                     }
                 }
                 
             }












//  SIGNAGE ENTRY


  if (isset($_POST['add_signage'])){
                         $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                           //  generate ID NUNPR-180000001
                        $sql_ = "SELECT signage_acct_no FROM signage ORDER BY id DESC LIMIT 1";
                        $result_ = $connect->query($sql_);
                        $row_ = $result_->fetch_assoc();
                        if($result_->num_rows > 0){

                            if($post['electoral_area_sg'] == "Kloowee Koo Naa"){
                                 $p_l = 'KLOOW';
                            }else if($post['electoral_area_sg'] == "Nkpor"){
                                 $p_l = 'NKPOR';
                            }else if($post['electoral_area_sg'] == "Adogon"){
                                 $p_l = 'ADOGO';
                            }else if($post['electoral_area_sg'] == "Nii Lawer"){
                                 $p_l = 'NIILA';
                            }else if($post['electoral_area_sg'] == "Sookpoti"){
                                 $p_l = 'SOOKP';
                            }else if($post['electoral_area_sg'] == "Nii Odai Ablade"){
                                 $p_l = 'NIIOD';
                            }else if($post['electoral_area_sg'] == "Antwere Gonno"){
                                 $p_l = 'ANTWE';
                            }else if($post['electoral_area_sg'] == "Blekese West"){
                                 $p_l = 'BLEWE';
                            }else if($post['electoral_area_sg'] == "Blekese East"){
                                 $p_l = 'BLEEA';
                            }else if($post['electoral_area_sg'] == "Mukwedjor"){
                                 $p_l = 'MUKWE';
                            }else if($post['electoral_area_sg'] == "Baatsonaa"){
                                 $p_l = 'BAATS';
                            }else if($post['electoral_area_sg'] == "Okpoi Gonno"){
                                 $p_l = 'OKPOI';
                            }

                           $e_id = $row_['signage_acct_no'];

                           $pieces = explode("-", $e_id);
                           $p_letter = $p_l; // piesce1
                           $p_numeric = $pieces[1] + 1; // piece2

                         
                         $signage_acct_no        = $p_letter .'-'. $p_numeric;
                     

                 $userid                = $post['userid'];
                 $uemail                = $post['uemail'];

                if($post['signage_acct_name_sg']){
                    $signage_acct_name = $post['signage_acct_name_sg'];
                 }
                 if($post['signage_acct_name_new_sg']){
                    $signage_acct_name = $post['signage_acct_name_new_sg'];
                 }

                 $signage_tel           = $post['signage_tel_sg'];
                 $signage_town        = $post['signage_town_sg'];

                 if($post['electoral_area_asene'] == true){
                    $electoral_area = $post['electoral_area_asene'];
                 }
                 if ($post['electoral_area_manso'] == true) {
                     $electoral_area = $post['electoral_area_manso'];
                 }
                 if ($post['electoral_area_akroso'] == true) {
                     $electoral_area = $post['electoral_area_akroso'];
                 }
                 $electoral_area = $post['electoral_area_sg'];
                 $signage_address       = $post['signage_address_sg'];
                 $permit_size           = $post['permit_size_sg'];
                 $rate_impost           = $post['rate_impost_sg'];
                 $rate_charge           = $post['rate_charge_sg'];


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
    <title>Generate Report| <?php echo $name; ?></title>
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
                <h2>GENERATE REPORT</h2>
            </div>

            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?php echo $msg; ?>
                    <div class="card">
                       
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
                                 <div class="col-md-8"> 
                                  <p>
                                        <b>Select Report Type</b>
                                    </p>
                <a href="report-detail" class="btn btn-primary waves-effect">BOP Bills </a>
                <a href="report-detail-pr" class="btn btn-primary waves-effect">Property Rate Bills </a>
                <a href="report-detail-bp" class="btn btn-primary waves-effect">Building Permit Bills </a>
                <a href="report-detail-sg" class="btn btn-primary waves-effect">Signage Bills </a>
                                </div>
                                 <div class="col-md-8"> 
                                   <p>
                                        <b>View Previous Payments</b>
                                    </p>
                <a href="bop-payment-list" class="btn btn-primary waves-effect">BOP Bills</a>
                <a href="property-payment-list" class="btn btn-primary waves-effect">Property Rate Bills</a>
                <a href="b-permit-payment-list" class="btn btn-primary waves-effect">Building Permit Bills</a>
                <a href="signage-payment-list" class="btn btn-primary waves-effect">Signage Bills </a>
                               </div>
                                <div class="clearfix"></div>










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
      var location_id_bop = document.getElementById('location_id_bop');
      var location_id_bop = new google.maps.places.Autocomplete(location_id_bop);

      var building_address_id = document.getElementById('building_address_id');
      var building_address_id = new google.maps.places.Autocomplete(building_address_id);

      var pro_address_id = document.getElementById('pro_address_id');
      var pro_address_id = new google.maps.places.Autocomplete(pro_address_id);

      var signage_address_id = document.getElementById('signage_address_id');
      var signage_address_id = new google.maps.places.Autocomplete(signage_address_id);


    }

    </script>

      <script src="plugins/jquery/jquery.min.js"></script>
       <script type="text/javascript">

        // Hiding all forms
        $(document).ready(function() {
                $("#bop_data").hide(); 
                $("#property_rate_data").hide(); 
                $("#building_permit_data").hide(); 
                $("#signage_data").hide(); 
        });
                // var value =  $("#payment_mode option:selected").val();
        $('#print_bill_id').on('change', function() {
            var value  = $(this).val();
              if(value == "bop_data"){
                $("#bop_data").show(); 
                $("#property_rate_data").hide(); 
                $("#building_permit_data").hide(); 
                $("#signage_data").hide(); 
              }
               if(value == "property_rate_data"){
                $("#bop_data").hide(); 
                $("#property_rate_data").show(); 
                $("#building_permit_data").hide(); 
                $("#signage_data").hide(); 
              }
              if(value == "building_permit_data"){
                $("#bop_data").hide(); 
                $("#property_rate_data").hide(); 
                $("#building_permit_data").show(); 
                $("#signage_data").hide(); 
              }
              if(value == "signage_data"){
                $("#bop_data").hide(); 
                $("#property_rate_data").hide(); 
                $("#building_permit_data").hide(); 
                $("#signage_data").show(); 
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