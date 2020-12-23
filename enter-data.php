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
                        echo("Error description 1: " . mysqli_error($connect));
                         if($result_->num_rows > 0){
                         if($post['electoral_area_bop'] == "Klagon"){
                                 $p_l = 'KLAGON';
                            }else if($post['electoral_area_bop'] == "Lashibi"){
                                 $p_l = 'LASHIB';
                            }else if($post['electoral_area_bop'] == "Wolei"){
                                 $p_l = 'WOLEI';
                            }else if($post['electoral_area_bop'] == "Sakumono"){
                                 $p_l = 'SAKUMO';
                            }else if($post['electoral_area_bop'] == "Kassaadjan"){
                                 $p_l = 'KASSAA';
                            }else if($post['electoral_area_bop'] == "Railways"){
                                 $p_l = 'RAILWA';
                            }else if($post['electoral_area_bop'] == "Baatsonaa"){
                                 $p_l = 'BAATON';
                            }else if($post['electoral_area_bop'] == "Halcrow"){
                                 $p_l = 'HALCRO';
                            }else if($post['electoral_area_bop'] == "Adjei Kojo"){
                                 $p_l = 'ADJEIK';
                            }else if($post['electoral_area_bop'] == "Kaiser"){
                                 $p_l = 'KAISER';
                            }else if($post['electoral_area_bop'] == "Dzata-Bu"){
                                 $p_l = 'DZATAB';
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
                         $rev_type_code = $post['b_rev_code_bop'];
                          $date = date('Y-m-d');

                         // Check if quote exists
                        $sql = "SELECT * FROM business WHERE user_email = '$uemail' AND b_no = '$b_no'";
                        $result = $connect->query($sql);
                        $row = $result->fetch_assoc();  

                        if($result->num_rows > 0){
                             $msg = '<div class="alert alert-danger">Sorry! Data already exist. <a class="btn btn-info waves-effect" href="all-business">See List</a></div>';
                         }else{
                            $query = "INSERT INTO business (b_no,b_name,b_type,rev_type_code,b_category,electoral_area,location,name_of_ceo,tel_no,b_phone_no,b_charge,year,user_id,user_email,first_name, last_name,date_,activ) VALUES
                      ('$b_no','$b_name','$b_type','$rev_type_code','$b_category','$e_area','$location','$name_of_ceo','$tel_no','$b_phone_no','$b_charge','$year','$userid','$uemail','$first_name','$last_name','$date','Y')";
                                            $result = mysqli_query($connect,$query) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($connect), E_USER_ERROR);

                             $query_ = "INSERT INTO bop_payment (b_no,b_name,rev_type_code,payment_mode,paid,bal,b_charge,arrears,bank,cheque_no,gcr,user_id,user_email,first_name,last_name,date_,activ) VALUES
                  ('$b_no','$b_name','$rev_type_code','NA','0','0','$b_charge','0','NA','NA','NA','$userid','$uemail','$first_name','$last_name','$date','Y')";
                                $result_ = mysqli_query($connect,$query_)  or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($connect), E_USER_ERROR);
                        if($result==1 && $result_ ==1){

                        $sqlss = "SELECT id,b_no,b_name,payment_mode,paid,bal,b_charge,arrears,bank,cheque_no,user_id,user_email FROM bop_payment WHERE b_no = '$b_no' order by id desc";
                                            $resultss = $connect->query($sqlss)  or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($connect), E_USER_ERROR);
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
                            
                            if($post['electoral_area_pr'] == "Klagon"){
                                $p_l = 'KLAGON';
                           }else if($post['electoral_area_pr'] == "Lashibi"){
                                $p_l = 'LASHIB';
                           }else if($post['electoral_area_pr'] == "Wolei"){
                                $p_l = 'WOLEI';
                           }else if($post['electoral_area_pr'] == "Sakumono"){
                                $p_l = 'SAKUMO';
                           }else if($post['electoral_area_pr'] == "Kassaadjan"){
                                $p_l = 'KASSAA';
                           }else if($post['electoral_area_pr'] == "Railways"){
                                $p_l = 'RAILWA';
                           }else if($post['electoral_area_pr'] == "Baatsonaa"){
                                $p_l = 'BAATON';
                           }else if($post['electoral_area_pr'] == "Halcrow"){
                                $p_l = 'HALCRO';
                           }else if($post['electoral_area_pr'] == "Adjei Kojo"){
                                $p_l = 'ADJEIK';
                           }else if($post['electoral_area_pr'] == "Kaiser"){
                                $p_l = 'KAISER';
                           }else if($post['electoral_area_pr'] == "Dzata-Bu"){
                                $p_l = 'DZATAB';
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
                         $rev_type_code = $post['b_rev_code_pr'];
                          $date = date('Y-m-d');

                         // Check if quote exists
                        $sql = "SELECT * FROM property WHERE user_email = '$uemail' AND pro_acct_no = '$pro_acct_no'";
                        $result = $connect->query($sql);
                        $row = $result->fetch_assoc();
                        if($result->num_rows > 0){
                             $msg = '<div class="alert alert-danger">Sorry! Data already exist. <a class="btn btn-info waves-effect" href="all-business">See List</a></div>';
                         }else{
                 $query = "INSERT INTO property (pro_acct_no,pro_owner_name,rev_type_code,pro_area_category,pro_type,r_value,r_impose,r_charge,electoral_area,pro_address,pro_hs_no,user_id,user_email,date_,activ) VALUES
     ('$pro_acct_no','$pro_owner_name','$rev_type_code','$pro_area_category','$pro_type','$r_value','$r_impose','$r_charge','$electoral_area','$pro_address','$pro_hs_no','$userid','$uemail',$date,'Y')";
                                            $result = mysqli_query($connect,$query);

                   $query_ = "INSERT INTO property_payment (pro_acct_no, rev_type_code, rateable_value, rate_impose, rate_charge, arrears, paid, total_amt_due, bal, payment_mode,bank,cheque_no,gcr,user_id,user_email,date_,activ)VALUES('$pro_acct_no', '$rev_type_code', '$r_value', '$r_impose', '$r_charge', '0', '0', '0', '0', 'NA','NA','NA','NA','$userid','$uemail','$date','Y')";
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

                            
                            if($post['electoral_area_bp'] == "Klagon"){
                                $p_l = 'KLAGON';
                           }else if($post['electoral_area_bp'] == "Lashibi"){
                                $p_l = 'LASHIB';
                           }else if($post['electoral_area_bp'] == "Wolei"){
                                $p_l = 'WOLEI';
                           }else if($post['electoral_area_bp'] == "Sakumono"){
                                $p_l = 'SAKUMO';
                           }else if($post['electoral_area_bp'] == "Kassaadjan"){
                                $p_l = 'KASSAA';
                           }else if($post['electoral_area_bp'] == "Railways"){
                                $p_l = 'RAILWA';
                           }else if($post['electoral_area_bp'] == "Baatsonaa"){
                                $p_l = 'BAATON';
                           }else if($post['electoral_area_bp'] == "Halcrow"){
                                $p_l = 'HALCRO';
                           }else if($post['electoral_area_bp'] == "Adjei Kojo"){
                                $p_l = 'ADJEIK';
                           }else if($post['electoral_area_bp'] == "Kaiser"){
                                $p_l = 'KAISER';
                           }else if($post['electoral_area_bp'] == "Dzata-Bu"){
                                $p_l = 'DZATAB';
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
                 $rev_type_code = $post['b_rev_code_bp'];
                          $date = date('Y-m-d');


                         // Check if quote exists
                        $sql = "SELECT * FROM building WHERE user_email = '$uemail' AND b_permit_acct_no = '$b_permit_acct_no'";
                        $result = $connect->query($sql);
                        $row = $result->fetch_assoc();
                        if($result->num_rows > 0){
                             $msg = '<div class="alert alert-danger">Sorry! Data already exist. <a class="btn btn-info waves-effect" href="all-business">See List</a></div>';
                         }else{
                 $query = "INSERT INTO building (b_permit_acct_no,b_permit_owner_name,building_type,rev_type_code,permit_tel,electoral_area,building_address,permit_size,rate_impost,rate_charge,user_id,user_email,date_,activ) VALUES
     ('$b_permit_acct_no','$b_permit_owner_name','$building_type','$rev_type_code','$permit_tel','$electoral_area','$building_address','$permit_size','$rate_impost','$rate_charge','$userid','$uemail','$date','Y')";
                                            $result = mysqli_query($connect,$query);

                   $query_ = "INSERT INTO building_payment (b_permit_acct_no, rev_type_code, rate_impost, rate_charge, arrears, paid, total_amt_due, bal, payment_mode,bank,cheque_no,gcr,user_id,user_email,activ)VALUES('$b_permit_acct_no','$rev_type_code','$rate_impost', '$rate_charge', '0', '0', '0', '0', 'NA','NA','NA','NA','$userid','$uemail','$date','Y')";
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

                           
                            if($post['electoral_area_sg'] == "Klagon"){
                                $p_l = 'KLAGON';
                           }else if($post['electoral_area_sg'] == "Lashibi"){
                                $p_l = 'LASHIB';
                           }else if($post['electoral_area_sg'] == "Wolei"){
                                $p_l = 'WOLEI';
                           }else if($post['electoral_area_sg'] == "Sakumono"){
                                $p_l = 'SAKUMO';
                           }else if($post['electoral_area_sg'] == "Kassaadjan"){
                                $p_l = 'KASSAA';
                           }else if($post['electoral_area_sg'] == "Railways"){
                                $p_l = 'RAILWA';
                           }else if($post['electoral_area_sg'] == "Baatsonaa"){
                                $p_l = 'BAATON';
                           }else if($post['electoral_area_sg'] == "Halcrow"){
                                $p_l = 'HALCRO';
                           }else if($post['electoral_area_sg'] == "Adjei Kojo"){
                                $p_l = 'ADJEIK';
                           }else if($post['electoral_area_sg'] == "Kaiser"){
                                $p_l = 'KAISER';
                           }else if($post['electoral_area_sg'] == "Dzata-Bu"){
                                $p_l = 'DZATAB';
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
                 $rev_type_code = $post['b_rev_code_sg'];
                          $date = date('Y-m-d');


                         // Check if quote exists
                        $sql = "SELECT * FROM signage WHERE user_email = '$uemail' AND signage_acct_no = '$signage_acct_no'";
                        $result = $connect->query($sql);
                        $row = $result->fetch_assoc();
                        if($result->num_rows > 0){
                             $msg = '<div class="alert alert-danger">Sorry! Data already exist. <a class="btn btn-info waves-effect" href="all-business">See List</a></div>';
                         }else{
                 $query = "INSERT INTO signage (signage_acct_no,signage_acct_name,rev_type_code,signage_tel,signage_town,electoral_area,signage_address,permit_size,rate_impost,rate_charge,user_id,user_email,date_,activ) VALUES
     ('$signage_acct_no','$signage_acct_name','$rev_type_code','$signage_tel','$signage_town','$electoral_area','$signage_address','$permit_size','$rate_impost','$rate_charge','$userid','$uemail','$date','Y')";
                                            $result = mysqli_query($connect,$query);

                   $query_ = "INSERT INTO signage_payment (signage_acct_no, rev_type_code, rate_impost, rate_charge, arrears, paid, total_amt_due, bal, payment_mode,bank,cheque_no,gcr,user_id,user_email,activ)VALUES('$signage_acct_no','$rev_type_code','$rate_impost', '$rate_charge', '0', '0', '0', '0', 'NA','NA','NA','NA','$userid','$uemail','$date','Y')";
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
    <title>Enter Data | <?php echo $name; ?></title>
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
                <h2>ADD NEW DATA</h2>
            </div>

            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?php echo $msg; ?>
                    <div class="card">
                       <!--  <div class="header">fa
                   
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
                <select class="form-control show-tick" name="enter_data" id="enter_data_id" required="">
                                    <option value="N\A">Select Bill</option>
                                    <option value="bop_form">BOP</option>
                                    <option value="property_rate_form">Property Rate</option>
                                    <option value="building_permit_form">Building Permit</option>
                                    <option value="signage_form">Signage</option>
                        </select>
                                </div>
                               
                                <div class="clearfix"></div>




            <!-- BOP FORM -->
                             <div id="bop_form">
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
                                        <input type="text" class="form-control" name="b_no_bop" placeholder="Business No. will be generated automatically" disabled="" id="b_no_id">
                                        
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-3">
                                    <p>
                                        <b>Business Name</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">business</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" placeholder="Enter business name" class="form-control" name="b_name_bop" id="b_name_id"  required>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <p>
                                        <b>Revenue Code</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">business</i>
                                        </span>
                                        <div class="form-line">
                                    <input type="text" maxlength="7" placeholder="Enter code" class="form-control" name="b_rev_code_bop" id="b_rev_code_bop_id"  required>
                                            
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
                                            <input type="text" placeholder="Enter business type (eg. Cold Storage Facilities - Importers)" class="form-control" name="b_type_bop" id="b_type_id"  required>
                                            
                                        </div>
                                   
                                </div>
                            </div>
                                
                                <div class="col-md-3">
                                 <p>
                                        <b>Business Category</b>
                                    </p>
                                    <select class="form-control show-tick" name="b_category_bop" id="b_category_id" required="">
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
                <select class="form-control show-tick" name="electoral_area_bop" id="electoral_area_id" required="">
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
                        <input type="text" placeholder="e.g. GA-090111" class="form-control" name="postgps_bop" id="postgps_id">
                                            
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
                        <input type="text" placeholder="Enter accurate business address" class="form-control" name="location_bop" id="location_id_bop">
                                            
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
                                        <input type="text" class="form-control" placeholder="Enter CEO's full name" name="name_of_ceo_bop" id="name_of_ceo_id" required>
                                        
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
                                            <input type="text" class="form-control" placeholder="eg. 0201112220 " maxlength="10" name="tel_no_bop" id="tel_no_id"  >
                                            
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
                            <input type="text" class="form-control" placeholder="eg. 0241112220" maxlength="10" name="b_phone_no_bop" id="b_phone_no_id">
                                            
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
                                            <input type="number" placeholder="00.00" min="0"  class="form-control" name="b_charge_bop" id="b_charge_id"  required>
                                            
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
                                            <!-- <input type="text" class="form-control" name="year_bop" id="year_id" value="2019"  readonly> -->
                                            <input type="text" class="form-control" name="year_bop" id="year_id" value="<?php echo date("Y"); ?>"  readonly>
                                            
                                        </div>
                                    </div>
                                </div>
                               </div>
<div class="clearfix"></div>

                                <!-- <div class="form-group">
                                    <input type="checkbox" id="checkbox" name="checkbox">
                                    <label for="checkbox">I have read and accept the terms</label>
                                </div> -->
                                <button class="btn btn-primary waves-effect" type="submit" id="add_bop" name="add_bop" value="add_bop">Add Business</button>
</div>














<!-- PROPERTY RATE FORM -->
 <div id="property_rate_form">
                              <div class="form-group form-float">
                                 <div class="col-md-4">
                                    <p>
                                        <b>Property Acct. No.</b>
                                    </p>
                                    <div class="input-group">
                             <span class="input-group-addon">
                                 <i class="material-icons">perm_identity</i>
                               </span>
                                            <div class="form-line">
                          <input type="text" class="form-control" name="pro_acct_no" id="pro_acct_no_id" placeholder="Property No. generated automatically" disabled="">
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-5">
                                    <p>
                                        <b>Business Owner's Name</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">account_circle</i>
                                        </span>
                                        <div class="form-line">
                                         <input type="text" placeholder="Enter business owner's name" class="form-control" name="pro_owner_name_pr" id="pro_owner_name_id"  required>
                                            
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-3">
                                    <p>
                                        <b>Revenue Code</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">business</i>
                                        </span>
                                        <div class="form-line">
                                    <input type="text" maxlength="7" placeholder="Enter code" class="form-control" name="b_rev_code_pr" id="b_rev_code_pr_id"  required>
                                            
                                        </div>
                                    </div>
                                </div>
                               </div>
                         <div class="form-group form-float">
                             <div class="col-md-4">
                                   <p>
                                        <b>Property Type</b>
                                    </p>
                                    <select class="form-control show-tick"   name="pro_type_pr" id="pro_type_id" required="">
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
                                    <select class="form-control show-tick"   name="pro_area_category_pr" id="pro_area_category_id" required="">
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
                <select class="form-control show-tick"   name="electoral_area_pr" id="electoral_area_id" required="">
                              <option value="N\A">Select Area</option>
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
                                        <input type="text" placeholder="Enter accurate property address" class="form-control" name="pro_address_pr" id="pro_address_id" >
                                        
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

                            <input type="text" placeholder="Enter house no." class="form-control" name="pro_hs_no_pr" id="pro_hs_no_id" >
                                            
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
                                            <input type="number" placeholder="00.00" step="0.0001" min="0" class="form-control calc_pr" name="rateable_value_pr" id="rateable_value_id_pr"  required>
                                            
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
                                            <input type="number" placeholder="00.00" step="0.0001"  min="0"  class="form-control calc_pr" name="rate_impose_pr" id="rate_impost_id_pr"  required>
                                            
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
                                <input type="number" placeholder="00.00" step="0.0001" min="0"  class="form-control" name="rate_charge_pr" id="rate_charge_id_pr"  required>
                                            
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
                                <button class="btn btn-primary waves-effect" name="add_property_rate" id="add_property_rate" value="add_property_rate" type="submit">Add Property</button>

                        </div>







<!-- BUILDING PERMIT FORM -->


 <div id="building_permit_form">

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
                          <input type="text" class="form-control" name="b_permit_acct_no_bp" id="b_permit_acct_no_id" placeholder="Permit Acct. No. will be generated automatically" disabled="">
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-3">
                                    <p>
                                        <b> Building Owner's Name</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">account_circle</i>
                                        </span>
                                        <div class="form-line">
                                         <input type="text" placeholder="Enter building owner's name" class="form-control" name="b_permit_owner_name_bp" id="b_permit_owner_name_id"  required>
                                            
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-3">
                                    <p>
                                        <b>Revenue Code</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">business</i>
                                        </span>
                                        <div class="form-line">
                                    <input type="text" maxlength="7" placeholder="Enter code" class="form-control" name="b_rev_code_bp" id="b_rev_code_bp_id"  required>
                                            
                                        </div>
                                    </div>
                                </div>
                               </div>
                         <div class="form-group form-float">
                             <div class="col-md-6">
                                   <p>
                                        <b>Property Type</b>
                                    </p>
                                    <select class="form-control show-tick"   name="building_type_bp" id="building_type_id" required="">
                            <option value="N\A">Select Property Type</option>
                            <option value="Temporal">Temporal</option>
                            <option value="Permanent">Permanent</option>
                               
                                    </select>
                                </div>
                                 <div class="col-md-6">
                                   <p>
                                        <b>Telephone No.</b>
                                    </p>
                                    <div class="input-group">
                                     <span class="input-group-addon">
                                            <i class="material-icons">phone</i>
                                        </span>
                                   <div class="form-line">
                                         <input type="text" maxlength="10" placeholder="Enter phone No." class="form-control" name="permit_tel_bp" id="permit_tel_id"  required>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                              <div class="form-group form-float">
                               <div class="col-md-6">
                                 <p>
                                        <b>Electoral Area</b>
                                    </p>
                <select class="form-control show-tick"   name="electoral_area_bp" id="electoral_area_id" required="">
               
                                     <option value="N\A">Select Area</option>
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
                               
                               
                                 
                                 <div class="col-md-6">
                                    <p>
                                        <b>Property Location</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">room</i>
                                        </span>
                                            <div class="form-line">
                                        <input type="text" placeholder="Enter accurate property address" class="form-control" name="building_address_bp" id="building_address_id" >
                                        
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
                                            <input type="number" placeholder="00.00" step="0.0001" min="0" class="form-control dim_bp" name="lenght_bp" id="lenght_id_bp"  required>
                                            
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
                                            <input type="number" placeholder="00.00" step="0.0001" min="0" class="form-control dim_bp" name="breadth_bp" id="breadth_id_bp"  required>
                                            
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
                                            <input type="number" placeholder="00.00" step="0.0001" min="0" class="form-control calc_bp" name="permit_size_bp" id="permit_size_id_bp"  required>
                                            
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
                                            <input type="number" placeholder="00.00" step="0.0001"  min="0"  class="form-control calc_bp" name="rate_impost_bp" id="rate_impost_id_bp"  required>
                                            
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
                                            <input type="number" placeholder="00.00" step="0.0001" min="0"  class="form-control" name="rate_charge_bp" id="rate_charge_id_bp"  required>
                                            
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
                                <button class="btn btn-primary waves-effect" name="add_building_permit" id="add_building_permit" value="add_building_permit" type="submit">Add Building Permit</button>
                        </div>








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
                          <input type="text" class="form-control" name="signage_acct_no_sg" id="signage_acct_no_id" placeholder="Signage Acct. No. will be generated" disabled="">
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-5">
                                   <p>
                                        <b>Select Business name</b>
                                    </p>
                                   <select class="form-control show-tick"   name="signage_acct_name_sg" id="signage_acct_name_id" required="">
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
                                 <div class="col-md-3">
                                    <p>
                                        <b>Revenue Code</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">business</i>
                                        </span>
                                        <div class="form-line">
                                    <input type="text" maxlength="7" placeholder="Enter code" class="form-control" name="b_rev_code_sg" id="b_rev_code_sg_id"  required>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                               </div>
                         <div class="form-group form-float">
                            <div class="col-md-4">
                                    <p>
                                        <b> Business Name (Optional)</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">account_circle</i>
                                        </span>
                                        <div class="form-line">
                                         <input type="text" placeholder="Only if business does not exist" class="form-control" name="signage_acct_name_new_sg" id="signage_acct_name_new_id">
                                            
                                        </div>
                                    </div>
                                </div>
                <div class="col-md-4" id="electoral_area">
                                 <p>
                                        <b>Electoral Area</b>
                                    </p>
                <select class="form-control show-tick"   name="electoral_area_sg" id="electorial_area_id">
                    <option value="N\A">Select Area</option>
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
                   
                    <div class="col-md-4">
                                   <p>
                                        <b>Telephone No.</b>
                                    </p>
                                    <div class="input-group">
                                     <span class="input-group-addon">
                                            <i class="material-icons">phone</i>
                                        </span>
                                   <div class="form-line">
                                         <input type="text" maxlength="10" placeholder="Enter phone No." class="form-control" name="signage_tel_sg" id="signage_tel_id"  required>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="form-group form-float">
                                
                                 <div class="col-md-6">
                                    <p>
                                        <b>Sinage Location</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">room</i>
                                        </span>
                                            <div class="form-line">
                                        <input type="text" placeholder="Enter accurate Signage address" class="form-control location" name="signage_address_sg" id="signage_address_id" >
                                        
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
                                            <input type="number" placeholder="00.00" step="0.0001" min="0" class="form-control dim_sg" name="lenght_sg" id="lenght_id_sg"  required>
                                            
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
                                            <input type="number" placeholder="00.00" step="0.0001" min="0" class="form-control dim_sg" name="breadth_sg" id="breadth_id_sg"  required>
                                            
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
                                            <input type="number" placeholder="00.00" step="0.0001" min="0" class="form-control calc_sg" name="permit_size_sg" id="permit_size_id_sg"  required>
                                            
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
                                            <input type="number" placeholder="00.00" step="0.0001"  min="0"  class="form-control calc_sg" name="rate_impost_sg" id="rate_impost_id_sg"  required>
                                            
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
                                            <input type="number" placeholder="00.00" step="0.0001" min="0"  class="form-control" name="rate_charge_sg" id="rate_charge_id_sg"  required>
                                            
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
<button class="btn btn-primary waves-effect" name="add_signage" id="add_signage" value="add_signage" type="submit">Add Signage</button>

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
                $("#bop_form").hide(); 
                $("#property_rate_form").hide(); 
                $("#building_permit_form").hide(); 
                $("#signage_form").hide(); 
        });
                // var value =  $("#payment_mode option:selected").val();
        $('#enter_data_id').on('change', function() {
            var value  = $(this).val();
              if(value == "bop_form"){
                $("#bop_form").show(); 
                $("#property_rate_form").hide(); 
                $("#building_permit_form").hide(); 
                $("#signage_form").hide(); 
              }
               if(value == "property_rate_form"){
                $("#bop_form").hide(); 
                $("#property_rate_form").show(); 
                $("#building_permit_form").hide(); 
                $("#signage_form").hide(); 
              }
              if(value == "building_permit_form"){
                $("#bop_form").hide(); 
                $("#property_rate_form").hide(); 
                $("#building_permit_form").show(); 
                $("#signage_form").hide(); 
              }
              if(value == "signage_form"){
                $("#bop_form").hide(); 
                $("#property_rate_form").hide(); 
                $("#building_permit_form").hide(); 
                $("#signage_form").show(); 
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