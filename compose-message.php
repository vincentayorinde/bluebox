<?php 
error_reporting(0);
session_start();
require_once '../db/config.php';
    if(!isset($_SESSION['is_logged_in']) == true){
            header("Location: ../../map-live");
    }
    if(isset($_SESSION['user_data']['user_role']) == "agent" || $_SESSION['user_data']['user_role'] == "adminxz"){
        $email              =  $_SESSION['email'];
        $first_name         =  $_SESSION['user_data']['first_name'];
        $last_name          =  $_SESSION['user_data']['last_name'];
        $message_sender_id  =  $_SESSION['user_data']['id'];
        $full_name          =  $first_name." ".$last_name;
        
    }

         if (isset($_REQUEST['message_receiver'])){
              $message_receiver = $_POST['message_receiver'];             
            $message_subject = $_POST['message_subject'];
            $message_content = $_POST['message_content'];
            $message_sender_id = $_POST['message_sender_id'];
            $message_receiver_id = $_post['message_receiver_id'];

                $sql = "SELECT * FROM users WHERE id != '$message_sender_id' AND email = '$message_receiver' LIMIT 1";

                   $result = $connect->query($sql);
                   $row = $result->fetch_assoc();
                   
                   if($result->num_rows > 0){ 
                            $message_receiver_id = $row['id'];             
                             //Insert the data into table now
                            $sql = "INSERT INTO private_messages (to_id, from_id, time_sent, subject, message)
                                    VALUES ('$message_receiver_id', '$message_sender_id', now(), '$message_subject', '$message_content')";
                            if(!mysqli_query($connect,$sql)){
                               $msg = '<div class="alert alert-danger">Could not send message! An insertion query error has occured</p>';
                                // exit();
                            }else{
                                //Send reciver mail alert 
                                $msg = '<div class="alert alert-success">Message sent successfully</div>';
                                // exit();
                            } // Close else block after the sql DB insert check

                   }else{
                         $msg = '<div class="alert alert-danger">Error! User has not registered for this system. (Please check email and try again.)</div>';
                   }


      
}
    ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Compose Message | Pacific Heavens Logistics</title>
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

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />


</head>

    <?php include 'includes/left-sidebar.php'; ?>

    <!-- Right Bar -->
    <?php include 'includes/right-sidebar.php'; ?>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>COMPOSE MESSAGE</h2>
            </div>

            <!-- CKEditor -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?php echo $msg; ?>
                    <div class="card">
                        <div class="header">
                            <h2>
                                COMPOSE
                                <small>Message will be sent to receiver </small>
                            </h2>
                            <!-- <ul class="header-dropdown m-r--5">
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
                            <form class="form-horizontal" name="message_form" id="message_form_ID" method="post" action="">
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 form-control-label">
                                        <label for="message_receiver">Email Address</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="message_receiver" id="message_receiver_ID" class="form-control" placeholder="Enter receiver's email address (Must be a registered user)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              <!--   <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 form-control-label">
                                        <label for="message_receiver_cc">Cc</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="message_receiver_cc" id="message_receiver_cc" class="form-control" placeholder="copy email address (Optional)">
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
             <input type="hidden" name="message_sender_id" id="message_sender_ID" value="<?php echo $message_sender_id;?>">
             <input type="hidden" name="message_receiver_id" id="message_receiver_ID" value="<?php echo $message_receiver_id;?>">
             <input type="hidden" name="message_receiver_name" id="message_receiver_name_ID" value="<?php echo $message_receiver_name_id;?>">
             <input type="hidden" name="message_sender_name" id="message_sender_name_ID" value="<?php echo $full_name;?>">
                                 <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 form-control-label">
                                        <label for="message_subject">Subject</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="message_subject" id="message_subject_ID" class="form-control" placeholder="Enter your Subject">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 form-control-label">
                                        <label for="message_subject">Message</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                           <textarea id="ckeditor" name="message_content" id="message_content_ID">
                                
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="row clearfix">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <button type="submit" name="submit" class="btn btn-primary m-t-15 waves-effect">SEND</button>
                                    </div>
                                </div>
                            </form>


                           
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# CKEditor -->
          
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Ckeditor -->
    <script src="plugins/ckeditor/ckeditor.js"></script>

    <!-- TinyMCE -->
    <script src="plugins/tinymce/tinymce.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/forms/editors.js"></script>

    <!-- Demo Js -->
    <script src="js/demo.js"></script>
</body>

</html>