<?php 
error_reporting(0);
session_start();
require_once '../db/config.php';
    if(!isset($_SESSION['is_logged_in']) == true){
            header("Location: ../../map-live");
    }
     if(isset($_SESSION['user_data']['user_role']) == "agent" || $_SESSION['user_data']['user_role'] == "adminxz"){
         $email      =  $_SESSION['email'];
        $first_name =  $_SESSION['user_data']['first_name'];
        $last_name  =  $_SESSION['user_data']['last_name'];
    }

                    if($_GET['id']) {
                                $id = base64_decode($_GET['id']);
                                $qid = $id;


                                $sql = "SELECT * FROM users WHERE id = {$qid}";
                                $result = $connect->query($sql);

                                $data = $result->fetch_assoc();
                            }

      if (isset($_REQUEST['uemail'])){
                         $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                        $first_name     = $post['first_name'];
                        $last_name      = $post['last_name'];
                        $phone          = $post['phone'];
                        $company        = $post['company'];
                        $gender         = $post['gender'];
                        $country        = $post['country'];
                        $user_role      = $post['user_role'];
                        $activate       = $post['activate'];


                         // Update User
                               $query = "UPDATE users 
    SET first_name='$first_name',last_name='$last_name',phone='$phone',company='$company',gender='$gender',country='$country',user_role='$user_role',activ='$activate' WHERE id='$qid' ";
    $result = mysqli_query($connect,$query);
                                if($result){
                                $msg = '<div class="alert alert-success">Updated successfully <a class="btn btn-info waves-effect" href="all-users.php">See List</a></div>';
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
    <title>Update User | <?php echo $name; ?></title>
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

    <!-- Morris Chart Css-->
    <link href="plugins/morrisjs/morris.css" rel="stylesheet" />

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
                <h2>UPDATE USER</h2>
            </div>

            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?php echo $msg; ?>
                    <div class="card">
                        <div class="header">
                            <h2>INPUT UPDATE DATA</h2>
                          <!--   <ul class="header-dropdown m-r--5">
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
                                <div class="form-group">
                                    <p>
                                        <b>User Type</b>
                                    </p>
                                    <input type="radio" <?php if($data['user_role']=='agent'){echo 'checked=""';}else{echo "";}?> value="agent" name="user_role" id="agent" class="with-gap">
                                    <label for="sea">Agent</label>

                                    <input type="radio" <?php if($data['user_role']=='customer'){echo 'checked=""';}else{echo "";}?> value="customer" name="user_role" id="customer" class="with-gap">
                                    <label for="customer" class="m-l-20">Customer</label>
                                </div>
                                <div class="col-md-4">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="email" value="<?php if($data['email']){echo $data['email'];}else{echo "";} ?>" class="form-control" name="email" required disabled="">
                                        <label class="form-label">Email</label>
                                    </div>
                                </div>
                            </div>
                             <div class="col-md-4">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="<?php if($data['first_name']){echo $data['first_name'];}else{echo "";} ?>" class="form-control" name="first_name" required>
                                        <label class="form-label">First Name</label>
                                    </div>
                                </div>
                            </div>
                             <div class="col-md-4">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="<?php if($data['last_name']){echo $data['last_name'];}else{echo "";} ?>" class="form-control" name="last_name" required>
                                        <label class="form-label">Last Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix"></div>
                            <div class="col-md-4">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="<?php if($data['company']){echo $data['company'];}else{echo "";} ?>" class="form-control" name="company" required>
                                        <label class="form-label">Company Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                 <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="<?php if($data['country']){echo $data['country'];}else{echo "";} ?>" class="form-control" name="country" required>
                                        <label class="form-label">Country</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" value="<?php if($data['phone']){echo $data['phone'];}else{echo "";} ?>" class="form-control" name="phone" required>
                                        <label class="form-label">Phone</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix"></div>
                                <div class="form-group">
                                    <p>
                                        <b>Gender</b>
                                    </p>
                                    <input type="radio" <?php if($data['gender']=='male'){echo 'checked=""';}else{echo "";}?> value="male" name="gender" id="agent" class="with-gap">
                                    <label for="male">Male</label>

                                    <input type="radio" <?php if($data['gender']=='female'){echo 'checked=""';}else{echo "";}?> value="female" name="gender" id="female" class="with-gap">
                                    <label for="female" class="m-l-20">Female</label>
                                </div>
                                <div class="form-group">
                                    <p>
                                        <b>Activate</b>
                                    </p>
                                    <input type="radio" <?php if($data['activ']=='Y'){echo 'checked=""';}else{echo "";}?> value="Y" name="activate" id="activate" class="with-gap">
                                    <label for="activate">Enable</label>

                                    <input type="radio" <?php if($data['activ']=='N'){echo 'checked=""';}else{echo "";}?> value="N" name="activate" id="activate" class="with-gap">
                                    <label for="activate" class="m-l-20">Disable</label>
                                </div>

                                <div class="form-group">
                                    <input type="checkbox" id="checkbox" name="checkbox">
                                    <label for="checkbox">I have read and accept the terms</label>
                                </div>
                                <button class="btn btn-primary waves-effect" type="submit">Update User</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Validation -->
            </div>

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

    <!-- Jquery CountTo Plugin Js -->
    <script src="plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Morris Plugin Js -->
    <script src="plugins/raphael/raphael.min.js"></script>
    <script src="plugins/morrisjs/morris.js"></script>

    <!-- ChartJs -->
    <script src="plugins/chartjs/Chart.bundle.js"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="plugins/flot-charts/jquery.flot.js"></script>
    <script src="plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="plugins/flot-charts/jquery.flot.time.js"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="plugins/jquery-sparkline/jquery.sparkline.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/index.js"></script>

    <!-- Demo Js -->
    <script src="js/demo.js"></script>
</body>

</html>