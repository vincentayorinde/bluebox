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
    }
    ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>All Signage Payment | <?php echo $name; ?> </title>
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
                    ALL SIGNAGE PAYMENT
                    <small>Showing all payments</small>
                </h2>
            </div>
            <!-- Basic Examples -->
            
            <!-- #END# Basic Examples -->
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <a href="report" class="btn btn-primary waves-effect">Back </a>
                    <div class="card">
                        <div class="header">
                            <h2>
                                ALL DATA
                            </h2>
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
                            <div class="table-responsive">
                                <table style="font-size:11px;" class="table small table-bordered table-striped table-hover dataTable js-exportable">
                                     <?php echo $msg;
                                             if($_SESSION['user_data']['user_role'] == "adminxz"){

                                                ?>
                                    <thead>
                                        <tr>
                                                    <th>No</th>
                                                    <th>Signage Acct. No.</th>
                                                    <th>Impost</th>
                                                    <th>Charge</th>
                                                    <th>Arrears</th>
                                                    <th>Paid</th>
                                                    <th>Bal</th>
                                                    <th>Mode</th>
                                                    <th>Bank</th>
                                                    <th>Cheq No</th>
                                                    <th>Date</th>
                                                    <th>Edit</th>
                                                </tr>
                                    </thead>
                                    <tfoot>
                                     
                                                  <tr>
                                                    <th>No</th>
                                                    <th>Signage Acct. No.</th>
                                                    <th>Impost</th>
                                                    <th>Charge</th>
                                                    <th>Arrears</th>
                                                    <th>Paid</th>
                                                    <th>Bal</th>
                                                    <th>Mode</th>
                                                    <th>Bank</th>
                                                    <th>Cheq No</th>
                                                    <th>Date</th>
                                                    <th>Edit</th>
                                                </tr>
                                    
                                    </tfoot>
                                    <tbody>
                                      <?php
                                            $no    = 1;
                                            $email = $_SESSION['email'];
                                           
                                                 $sql = "SELECT * FROM signage_payment WHERE activ = 'Y'";
                                            $result = $connect->query($sql);
                                          
                                            if($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) {
                                                            echo "<tr>
                                                    <td>". $no ."</td>
                                                    <td>" .$row['signage_acct_no']."</td>
                                                    <td>" .$row['rate_impost']."</td>
                                                    <td>" .$row['rate_charge']."</td>
                                                    <td>" .$row['arrears']. "</td>
                                                    <td>" .$row['paid']."</td>
                                                    <td>" .$row['bal']."</td>
                                                    <td>" .$row['payment_mode']."</td>
                                                    <td>" .$row['bank']."</td>
                                                    <td>" .$row['cheque_no']."</td>
                                                    <td>" .$row['date_added']."</td>
                                                    <td>
                                                    <a href='update-payment-signage?id=".$row['id']."&signage_acct_no=".$row['signage_acct_no']."'>Edit
                                                     <a href='print-bill-signage?id=".$row['id']."&p_no=".$row['signage_acct_no']."'>Print
                                                    </a>
                                                    <a href='delete-p-sg?sg_id=".$row['id']."&sg_no=".$row['signage_acct_no']."'>Delete</a>
                                                    </td>
                                                    </tr>";
                                                    $no++;
                                                }
                                            } else {
                                                echo "<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
                                            }


                                            }else{

                                                  ?>
                                        </tbody>
                                        <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Acct. No.</th>
                                                    <th>Rateabele</th>
                                                    <th>Rate Impose</th>
                                                    <th>Rate Charge</th>
                                                    <th>Arrears</th>
                                                    <th>Paid</th>
                                                    <th>Bal</th>
                                                    <th>Mode</th>
                                                    <th>Bank</th>
                                                    <th>Cheq No</th>
                                                    <th>Date</th>
                                                    <th>Edit</th>
                                                </tr>
                                            </thead>
                                         <tbody>
                                            <?php
                                             $no    = 1;
                                            $email = $_SESSION['email'];

                                            $sql = "SELECT * FROM freightquotes WHERE active = '1' AND uemail = '$email'";
                                            $result = $connect->query($sql);
                                          
                                            if($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) {
                                                    echo "<tr>
                                                   <td>". $no ."</td>
                                                    <td>" .$row['pro_acct_no']."</td>
                                                    <td>" .$row['rateable_value']."</td>
                                                    <td>" .$row['rate_impose']."</td>
                                                    <td>" .$row['rate_charge']."</td>
                                                    <td>" .$row['arrears']. "</td>
                                                    <td>" .$row['paid']."</td>
                                                    <td>" .$row['bal']."</td>
                                                    <td>" .$row['payment_mode']."</td>
                                                    <td>" .$row['bank']."</td>
                                                    <td>" .$row['cheque_no']."</td>
                                                    <td>" .$row['date_added']."</td>
                                                    <td>
                                                            <a href='update-business?id=".base64_encode($row['id'])."'><button class='ui yellow icon button' type='button'><i class='edit icon'></i></button></a>
                                                            <a href='update-business?delete=".base64_encode($row['id'])."'><button  class='ui red icon button'  type='button'><i class='times icon'></i></button></a>
                                                        </td>
                                                    </tr>";
                                                    $no++;
                                                }
                                            } else {
                                                echo "<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
                                            }
}
                                            ?>
                                                
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