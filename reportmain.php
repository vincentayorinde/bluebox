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
       <!-- Multi Select Css -->
    <link href="plugins/multi-select/css/multi-select.css" rel="stylesheet">
    <!-- Bootstrap Tagsinput Css -->
    <link href="plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

</head>
<style type="text/css">
   /*  .small-btn {
        width: 2px !important;
        height: 2px !important;
    }
    .material-icons {
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
 <div class="form-group form-float">
                               <div class="col-md-6">
                                 <p>
                                        <b>Electoral Area</b>
                                    </p>
                <select class="form-control show-tick"   name="electoral_area" id="electoral_area_id" required="">
                                    <option value="N\A">Select Area</option>
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
                                    <option value="Eshiem">Eshiem</option>
                        </select>
                                </div>
                            </div>  
            <div class="block-header">
                <h2>
                    ALL PROPERTY PAYMENT
                    <small>Showing all payments</small>
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
                                                    <th width="5%">No</th>
                                                    <th width="50%">Acct. No.</th>
                                                    <th width="2%">Rateabele</th>
                                                    <th width="2%">Impose</th>
                                                    <th width="2%">Charge</th>
                                                    <th width="2%">Arrears</th>
                                                    <th width="2%">Paid</th>
                                                    <th width="2%">Bal</th>
                                                    <th width="2%">Mode</th>
                                                    <th width="2%">Bank</th>
                                                    <th width="2%">CNo</th>
                                                    <th width="40%">Date</th>
                                                    <th width="2%">Edit</th>
                                                </tr>
                                    </thead>
                                    <tfoot>
                                     
                                                  <tr>
                                                  <th width="5%">No</th>
                                                    <th width="50%">Acct. No.</th>
                                                    <th width="2%">Rateabele</th>
                                                    <th width="2%">Impose</th>
                                                    <th width="2%">Charge</th>
                                                    <th width="2%">Arrears</th>
                                                    <th width="2%">Paid</th>
                                                    <th width="2%">Bal</th>
                                                    <th width="2%">Mode</th>
                                                    <th width="2%">Bank</th>
                                                    <th width="2%">CNo</th>
                                                    <th width="40%">Date</th>
                                                    <th width="2%">Edit</th>
                                                </tr>
                                    
                                    </tfoot>
                                    <tbody>
                                      <?php
                                            $no    = 1;
                                            $email = $_SESSION['email'];
                                           
                                                 $sql = "SELECT * FROM property_payment WHERE activ = 'Y'";
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
                                                    <a href='update-payment-propertyr?id=".$row['id']."&pro_acct_no=".$row['pro_acct_no']."'>Edit
                                                    </a> | <a href='print-bill-propertyr?id=".$row['id']."&p_no=".$row['pro_acct_no']."'>Print
                                                    </a>
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

      <!-- Multi Select Plugin Js -->
    <script src="plugins/multi-select/js/jquery.multi-select.js"></script>

        <!-- Input Mask Plugin Js -->
    <script src="plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/tables/jquery-datatable.js"></script>
    <script src="js/pages/forms/advanced-form-elements.js"></script>
    <!-- Demo Js -->
    <script src="js/demo.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            fill_datatable();

            function fill_datatable(filter_gender = '', filter_country = ''){
                var dataTable = $('#customer_data').DataTable({
                    "processing" : true,
                    "serverSide" : true,
                    "order" : [],
                    "searching" : false,
                    "ajax" : {
                        url: "fetch.php",
                        type: "POST",
                        data: {
                            filter_gender: filter_gender, filter_country: filter_country
                        }
                    }
                })
            }
        })
    </script>
</body>

</html>