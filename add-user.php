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

                        $sql_ = "SELECT id FROM users ORDER BY id DESC LIMIT 1";
                        $result_ = $connect->query($sql_);
                        $row_ = $result_->fetch_assoc();
                         if($result_->num_rows > 0){
            
                         $userid        = $post['userid'];
                         $uemail        = $post['uemail'];
                         $first_name_    = $post['first_name_'];
                         $last_name_     = $post['last_name_'];
                         $email_         = $post['email_'];
                         $password      = sha1($post['password']);
                         $phone        = $post['tel_no'];
                         $gender        = $post['gender'];
                         $dob           = $post['dob']; 
                         $user_role     = $post['user_role'];
                         $address       = $post['address'];
                         $dp            = 'NA';

                         // Check if quote exists
                        $sql = "SELECT * FROM users WHERE email = '$email_'";
                        $result = $connect->query($sql);
                        $row = $result->fetch_assoc();
                        if($result->num_rows > 0){
                             $msg = '<div class="alert alert-danger">Sorry! User already exist. <a class="btn btn-info waves-effect" href="all-user">See Users</a></div>';
                         }else
      {
      $query = "INSERT INTO users (email,pass,first_name,last_name,gender,dob,address,phone,dp,user_role,reg_by_id,reg_by_email,activ) VALUES
      ('$email_','$password','$first_name_','$last_name_','$gender,','$dob','$address','$phone','$dp','$user_role','$userid','$uemail','Y')";
      $result = mysqli_query($connect,$query);
                            
                        if($result){

                                $msg = '<div class="alert alert-success">User Added successfully <a class="btn btn-info waves-effect" href="all-users">See All</a> <a class="btn btn-info waves-effect" href="add-users">Add New</a>
                                </div>';

                         }else{
                             $msg = '<div class="alert alert-danger">Error adding user <a class="btn btn-info waves-effect" href="add-user">Try again</a></div>';
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
    <title>Add New User | <?php echo $name; ?></title>
    <!-- Favicon-->
    <link rel="icon" href="../images/favicon.png" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
<!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- Wait Me Css -->
    <link href="plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />

</head>
<style type="text/css">
    #divCheckPasswordMatch{
        font-size: 12px;
        color: red;
    }
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
                <h2>ADD NEW USER ACCOUNT</h2>
            </div>

            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <a href="add-user" class="btn btn-primary waves-effect">Back </a>
                    <?php echo $msg; ?>
                    <div class="card">
                        <div class="header">
                   
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST" enctype="multipart/form-data">
                          <input hidden="" name="userid" value="<?php echo $_SESSION['user_data']['id'];?>">
                          <input hidden="" name="uemail" value="<?php echo $_SESSION['email'] ?>">
                          <input hidden="" name="company" value="<?php echo $_SESSION['user_data']['company'];?>">
                              <div class="form-group form-float">
                                 <div class="col-md-4">
                                    <p>
                                        <b>First Name</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">account_circle</i>
                                        </span>
                                            <div class="form-line">
                                        <input type="text" class="form-control" name="first_name_" placeholder="Enter First Name"  id="first_name_id" required="">
                                        
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <b>Last Name</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">account_circle</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" placeholder="Enter Last Name" class="form-control" name="last_name_" id="last_name_id"  required>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <b>Email</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">email</i>
                                        </span>
                                <div class="form-line">
                                    <input type="email" class="form-control" name="email_" placeholder="Enter Email"  id="email_id" required="">
                                        
                                    </div>
                                </div>
                                </div>
                               
                               </div>
                         <div class="form-group form-float">
                                 
                                <div class="col-md-4">
                                    <p>
                                        <b>Password</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">lock</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="password" placeholder="Enter Password" minlength="6" class="form-control" name="password" id="password_id" required="">
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-md-4">
                                 <p>
                                        <b>Role</b>
                                    </p>
                                    <select class="form-control show-tick"  name="user_role" id="user_role_id" required="">
                            <option value="N\A">Select Permision</option>
                            <option value="admin">Admin</option>
                            <option value="agent">Agent</option>
              
                                    </select>
                                </div>
                                
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>Phone</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">phone</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="eg. 0201112220 " name="tel_no" id="tel_no_id"  required="" >
                                            
                                        </div>
                                    </div>
                                </div>
                               
                               </div>
                                 <div class="form-group form-float">
                                  <div class="col-md-4">
                                 <p>
                                        <b>Gender</b>
                                    </p>
                                    <select class="form-control show-tick"  name="gender" id="gender_id" required="">
                            <option value="N\A">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
              
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <b>Date of Birth</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">event</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="date" class="form-control" name="dob" id="dob_id" placeholder="Please choose a date..." required="">
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                
                               
                               </div>
                        <div class="form-group form-float">
                                 
                                <div class="col-md-6">
                                    <!-- Geomap Location -->
                                    <p>
                                        <b>Address</b>
                                    </p>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">room</i>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" placeholder="Enter accurate business address" class="form-control" name="address" id="address_id"  required="">
                                            
                                        </div>
                                    </div>
                                </div>
                        
                                    
                               </div>


<div class="clearfix"></div>
                                <!-- <div class="form-group">
                                    <input type="checkbox" id="checkbox" name="checkbox">
                                    <label for="checkbox">I have read and accept the terms</label>
                                </div> -->
                                <button class="btn btn-primary waves-effect" type="submit">Create User</button>
                            </form>
                        </div> <!-- End body real form -->
                    </div>
                </div>
            </div>
            <!-- #END# Basic Validation -->
            </div>

        </div>
    </section>
<!--  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtwdU-k6I92E2C6zqsC6xPFlRUACzhmXc&libraries=places&callback=initMap"
    async defer></script> -->
    <script type="text/javascript">
    //   function initMap() {
    //   var loc = document.getElementById('location_id');
    //   var autocomplete_loc = new google.maps.places.Autocomplete(loc);

    // }

    </script>
   
    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript">

    </script>
    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Autosize Plugin Js -->
    <script src="plugins/autosize/autosize.js"></script>

    <!-- Moment Plugin Js -->
    <script src="plugins/momentjs/moment.js"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/forms/basic-form-elements.js"></script>

    <!-- Demo Js -->
    <script src="js/demo.js"></script>
</body>

</html>