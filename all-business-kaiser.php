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
    <title>All Business | <?php echo $name; ?> </title>
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
<style type="text/css">
   /*  .small-btn {
        width: 2px !important;
        height: 2px !important;
    }*/
   /* .material-icons {
    font-family: 'Material Icons';
    font-weight: normal;
    font-style: normal;
    font-size: 15px !important;
    line-height: 1;
    letter-spacing: normal;
    text-transform: none;
    display: inline-block;
    white-space: nowrap;
    word-wrap: normal;
    direction: ltr;
    -webkit-font-feature-settings: 'liga';
    -webkit-font-smoothing: antialiased;
}*/
    
</style>

    <?php include 'includes/left-sidebar.php'; ?>

    <!-- Right Bar -->
    <?php include 'includes/right-sidebar.php'; ?>


    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    ALL BUSINESS
                    <small>Showing all business added by Agents</small>
                </h2>
            </div>
            <!-- Basic Examples -->
            
            <!-- #END# Basic Examples -->
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <a href="all-business-klagon" class="btn btn-primary waves-effect">Klagon </a> 
                   <a href="all-business-lashibi" class="btn btn-primary waves-effect">Lashibi </a> 
                   <a href="all-business-wolei" class="btn btn-primary waves-effect">Wolei </a> 
                   <a href="all-business-sakumono" class="btn btn-primary waves-effect">Sakumono </a> 
                   <a href="all-business-kassaadjan" class="btn btn-primary waves-effect">Kassaadjan </a> 
                   <a href="all-business-railways" class="btn btn-primary waves-effect">Railways </a> 
                   <a href="all-business-baatsonaa" class="btn btn-primary waves-effect">Baatsonaa</a> 
                   <a href="all-business-halcrow" class="btn btn-primary waves-effect">Halcrow </a> 
                   <a href="all-business-adjei-kojo" class="btn btn-primary waves-effect">Adjei Kojo </a> 
                   <a href="all-business-kaiser" class="btn btn-primary waves-effect">kaiser </a> 
                   <a href="all-business-dzata-bu" class="btn btn-primary waves-effect">Dzata-Bu </a> 
                   <br>
                   
                    <div class="card">
                        <div class="header">
                            <h2>
                                ALL KAISER DATA
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
                                                    <th>B. No.</th>
                                                    <th>B. Name</th>
                                                    <th>B. Type</th>
                                                    <th>Category</th>
                                                    <th>Electoral Area</th>
                                                    <th>Loc.</th>
                                                    <th>CEO</th>
                                                    <th>Tel No.</th>
                                                    <th>BOP Charge</th>
                                                    <th>Year</th>
                                                    <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                                    <th>No</th>
                                                    <th>B. No.</th>
                                                    <th>B. Name</th>
                                                    <th>B. Type</th>
                                                    <th>Category</th>
                                                    <th>Electoral Area</th>
                                                    <th>Loc.</th>
                                                    <th>CEO</th>
                                                    <th>Tel No.</th>
                                                    <th>BOP Charge</th>
                                                    <th>Year</th>
                                                    <th>Edit</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                    
                                      <?php
                                            $no    = 1;
                                            $email = $_SESSION['email'];
                                           
                                            $sql = "SELECT * FROM business WHERE activ = 'Y' and electoral_area='kaiser' ORDER BY id DESC";
                                            
                                            $result = $connect->query($sql);
                                          
                                            if($result->num_rows > 0) {

                                                while($row = $result->fetch_assoc()) {
                                                    $b_no = $row['b_no'];
                                                    $sql_ = "SELECT * FROM bop_payment WHERE b_no='$b_no' AND activ = 'Y' order by id DESC";
                                                    $result_ = $connect->query($sql_);
                                                    $row_ = $result_->fetch_assoc();
                                                    $id_ = $row_['id'];

                                                    $sql_d = "SELECT * FROM business WHERE b_no='$b_no' AND activ = 'Y' order by id DESC";
                                                    $result_d = $connect->query($sql_d);
                                                    $row_d = $result_d->fetch_assoc();
                                                    $id_d = $row_d['id'];

                                                            echo "<tr>
                                                    <td>". $no ."</td>
                                                    <td >" .$row['b_no']."</td>
                                                    <td>" .$row['b_name']."</td>
                                                    <td>" .$row['b_type']."</td>
                                                    <td>" .$row['b_category']."</td>
                                                    <td>" .$row['electoral_area']. "</td>
                                                    <td>" .$row['location']."</td>
                                                    <td>" .$row['name_of_ceo']."</td>
                                                    <td>" .$row['tel_no']."</td>
                                                    <td>" .$row['b_charge']."  -
                                                            <a href='update-business-charge.php?id=".base64_encode($row['id'])."'>Edit</a>
                                                    </td>
                                                    <td>" .$row['year']."</td>
                                            <td>
                                            <a href='enter-payment-pay-now-bop?id=".$row_['id']."&b_no=".$row['b_no']."'>Make Payment</a> |

                                            <a href='update-business.php?id=".base64_encode($row['id'])."'>Edit</a> |
                                            <a href='print-bill-bop?id=".$id_."&b_no=".$row['b_no']."'>Print</a> |
                                            <a href='delete-bop?bop_id=".$id_d."&bop_b_no=".$row_d['b_no']."'>Delete</a>
                                             </td>
                                                    </tr>";
                                                    $no++;
                                                }
                                            } else {
                                                echo  "<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
                                            }


                                            }else{

                                                  ?>
                                        </tbody>
                                        <thead>
                                                <tr>
                                                  <th>No</th>
                                                    <th>B. No.</th>
                                                    <th>B. Name</th>
                                                    <th>B. Type</th>
                                                    <th>Category</th>
                                                    <th>Electoral Area</th>
                                                    <th>Loc.</th>
                                                    <th>CEO</th>
                                                    <th>Tel No.</th>
                                                    <th>BOP Charge</th>
                                                    <th>Year</th>
                                                    <th>Edit</th>
                                                </tr>
                                            </thead>
                                         <tbody>
                                            <?php
                                            $no    = 1;
                                            $email = $_SESSION['email'];
                                           
                                            $sql = "SELECT * FROM business WHERE activ = 'Y' and electoral_area='kaiser' ORDER BY id DESC LIMIT 500";
                                            
                                            $result = $connect->query($sql);
                                          
                                            if($result->num_rows > 0) {

                                                while($row = $result->fetch_assoc()) {
                                                    $b_no = $row['b_no'];
                                                     $sql_ = "SELECT * FROM bop_payment WHERE b_no='$b_no' AND activ = 'Y' order by id DESC";
                                                    $result_ = $connect->query($sql_);
                                                    $row_ = $result_->fetch_assoc();
                                                    $id_ = $row_['id'];

                                                    $sql_d = "SELECT * FROM business WHERE b_no='$b_no' AND activ = 'Y' order by id DESC";
                                                    $result_d = $connect->query($sql_d);
                                                    $row_d = $result_d->fetch_assoc();
                                                    $id_d = $row_d['id'];

                                                            echo "<tr>
                                                    <td>". $no ."</td>
                                                    <td >" .$row['b_no']."</td>
                                                    <td>" .$row['b_name']."</td>
                                                    <td>" .$row['b_type']."</td>
                                                    <td>" .$row['b_category']."</td>
                                                    <td>" .$row['electoral_area']. "</td>
                                                    <td>" .$row['location']."</td>
                                                    <td>" .$row['name_of_ceo']."</td>
                                                    <td>" .$row['tel_no']."</td>
                                                    <td>" .$row['b_charge']."  </td>
                                                    <td>" .$row['year']."</td>
                                            <td>
                                            <a href='update-business.php?id=".base64_encode($row['id'])."'>Edit</a>|
                                            <a href='print-bill-bop?id=".$id_."&b_no=".$row['b_no']."'>Print</a>
                                             </td>
                                                    </tr>";
                                                    $no++;
                                                }
                                            } else {
                                                echo  "<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
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