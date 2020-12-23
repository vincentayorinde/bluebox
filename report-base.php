<?php 
error_reporting(0);
session_start();
require_once 'db/config.php';
    if(isset($_SESSION['is_logged_in']) != true){
            header("Location: sign-in");
    }
     if(isset($_SESSION['user_data']['user_role']) == "agent" || $_SESSION['user_data']['user_role'] == "adminxz"){
        $email      =  $_SESSION['email'];
        $first_name =  $_SESSION['user_data']['first_name'];
        $last_name  =  $_SESSION['user_data']['last_name'];
        $user_id    =  $_SESSION['user_data']['id'];
    }
     if ($_GET['pro_acct_no']){
                  $pro_acct_no        = $_GET['pro_acct_no'];

                  $sqlnew = "SELECT * FROM property_payment WHERE pro_acct_no = '$pro_acct_no'";
                  $resultnew = $connect->query($sqlnew);
                  $data = $resultnew->fetch_assoc();

                  $sqlnewp = "SELECT * FROM property WHERE pro_acct_no = '$pro_acct_no'";
                  $resultnewp = $connect->query($sqlnewp);
                  $datap = $resultnewp->fetch_assoc();

                     if($data){
                        $sql_ = "SELECT * FROM bill ORDER BY id DESC LIMIT 1";
                           $result_ = $connect->query($sql_);
                             $row_ = $result_->fetch_assoc();
                                if($result_->num_rows > 0){
                                 $new_bill_no = $row_['bill_no'] + 1; // piece2
                                 $message = "New bill generated for property " . $data['pro_acct_no']; 
                                 $query = "INSERT INTO bill (bill_no,message,user_id) VALUES ('$new_bill_no','$message', $user_id)";
                                 $result = mysqli_query($connect,$query);                                        
                        // $msg = '<div class="alert alert-success">Data Added successfully <a class="btn btn-info waves-effect" href="all-business">See List</a></div>';

                         }
                     }
    }
    ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>All Business | AS </title>
    <!-- Favicon-->
    <link rel="icon" href="/images/favicon.png" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

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
                <h2>
                    PRINT REPORT
                    <small>Showing all Rates added by Agents</small>
                </h2>
            </div>
            <!-- Basic Examples -->
            
            <!-- #END# Basic Examples -->
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ALL DATA
                            </h2>
                           
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                        <table style="font-size:11px;" class="table small table-bordered table-striped table-hover dataTable js-exportable">
                            
                                    <thead>
                                        <tr>
                                                    <th>No</th>
                                                    <th>Pro. No.</th>
                                                    <th>Pro. Name</th>
                                                    <th>Area</th>
                                                    <th>Rateable Value</th>
                                                    <th>Impose</th>
                                                    <th>Charge</th>
                                                    <th>Arrears</th>
                                                    <th>Due</th>
                                                    <th>Paid</th>
                                                    <th>Edit</th>
                                                    <th>Edit</th>
                                        </tr>
                                    </thead>
                                
                                    <tbody>
                                         <tr>
                                                    <td>BILL TO : <?php echo $datap['pro_owner_name']; ?></td>
                                                    <td>PROPERTY NUMBER: <?php echo $data['pro_acct_no']; ?></td>
                                                    <td>PROPERTY CATEGORY: <?php echo $datap['pro_area_category']; ?></td>
                                                    <td>ELECTORAL AREA: <?php echo $datap['electoral_area']; ?></td>
                                                    <td>BILL NO : <?php echo $new_bill_no; ?></td>
                                                    <td>BILL PERIOD : <?php echo date('Y'); ?></td>
                                                    <td>BILL TYPE : BOP</td>
                                                   
                                                    <td>DESCRIPTION: Business Operating Permit</td>
                                                    <td>Rate Charge (GHS) <?php echo $data['rate_charge']; ?></td>
                                                    <td>Arrears (GHS) <?php echo $data['arrears']; ?></td>
                                                    <td>Total (GHS) <?php echo $data['paid']; ?></td>
                                                    <td>Amount Due (GHS) <?php echo $data['bal']; ?></td>
                                                   
                                     </tr>
                                    
                                      
                                        </tbody>
                                
                                               
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
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

    <!-- Jquery DataTable Plugin Js -->
    <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/tables/jquery-datatable.js"></script>

    <!-- Demo Js -->
    <script src="js/demo.js"></script>
</body>

</html>