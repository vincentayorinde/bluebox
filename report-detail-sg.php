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

      if (isset($_GET['sg-date-from'])){

                         $sg_date_from = $_GET['sg-date-from'];
                         $sg_date_from = date("Y-m-d", strtotime($sg_date_from));

                         $sg_date_to = $_GET['sg-date-to'];
                         $sg_date_to = date("Y-m-d", strtotime($sg_date_to));


                        header("Location: report-detail-print-sg?sd=".$sg_date_from."&ed=".$sg_date_to."");
                 
             }

    ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Generate Report| <?php echo $name; ?></title>
    <!-- Favicon-->
    <link rel="icon" href="../images/favicon.png" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
 <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

     <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="plugins/morrisjs/morris.css" rel="stylesheet" />

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

     <!-- Bootstrap Material Datetime Picker Css -->
    <link href="plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- Wait Me Css -->
    <link href="plugins/waitme/waitMe.css" rel="stylesheet" />

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
                <h2>GENERATE REPORT</h2>
            </div>

            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?php echo $msg; ?>
                    <div class="card">
                       
                        <div class="body">
                            <form id="form_validation" method="GET" novalidate>
                          <!-- <input hidden="" name="add_bop" value="add_bop">
                          <input hidden="" name="add_property_rate" value="add_property_rate">
                          <input hidden="" name="add_building_permit" value="add_building_permit"> -->
                          <input hidden="" name="userid" value="<?php echo $_SESSION['user_data']['id'];?>">
                          <input hidden="" name="uemail" value="<?php echo $_SESSION['email'] ?>">
                          <input hidden="" name="first_name" value="<?php echo $first_name; ?>">
                          <input hidden="" name="last_name" value="<?php echo $last_name; ?>">
                          <input hidden="" name="company" value="<?php echo $_SESSION['user_data']['company'];?>">
                    <div class="col-md-16"> 
                         <a href="report" class="btn btn-primary waves-effect">Back </a>
                                  

                                    <!--DateTime Picker -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <p>
                                        <b>Select Start Date and End Date</b>
                                    </p>
                        <!--     <h2>
                                DATETIME PICKER
                                <small>Taken from <a href="https://github.com/T00rk/bootstrap-material-datetimepicker" target="_blank">github.com/T00rk/bootstrap-material-datetimepicker</a> with <a href="http://momentjs.com/" target="_blank">momentjs.com</a></small>
                            </h2>
                            <ul class="header-dropdown m-r--5">
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
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="datepicker form-control" name="sg-date-from" id="sg-date-from" placeholder="Select Start date">
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="datepicker form-control" name="sg-date-to" id="sg-date-to" placeholder="Select End Date">
                                        </div>
                                    </div>
                                </div>
                               <!--  <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="timepicker form-control" placeholder="Please choose a time...">
                                        </div>
                                    </div>
                                </div> -->
                                <!-- <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="datetimepicker form-control" placeholder="Please choose date & time...">
                                        </div>
                                    </div>
                                     </div> -->

                             <input type="submit" class="btn btn-primary waves-effect" value="Generate" name="generate"> 
                            </div>
                             <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    
                </div>
                        </div>
                    </div>
                </div>
            </div>
          
                            </form>
                        </div> <!-- End body real form -->
                        
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
                $("#bop_data").hide(); 
                $("#property_rate_data").hide(); 
                $("#building_permit_data").hide(); 
                $("#signage_data").hide(); 
        });
                // var value =  $("#payment_mode option:selected").val();
        $('#print_bill_id').on('change', function() {
            var value  = $(this).val();
              if(value == "bop_data"){
                $("#bop_data").show(); 
                $("#property_rate_data").hide(); 
                $("#building_permit_data").hide(); 
                $("#signage_data").hide(); 
              }
               if(value == "property_rate_data"){
                $("#bop_data").hide(); 
                $("#property_rate_data").show(); 
                $("#building_permit_data").hide(); 
                $("#signage_data").hide(); 
              }
              if(value == "building_permit_data"){
                $("#bop_data").hide(); 
                $("#property_rate_data").hide(); 
                $("#building_permit_data").show(); 
                $("#signage_data").hide(); 
              }
              if(value == "signage_data"){
                $("#bop_data").hide(); 
                $("#property_rate_data").hide(); 
                $("#building_permit_data").hide(); 
                $("#signage_data").show(); 
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

        <!-- Jquery CountTo Plugin Js -->
    <script src="plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Morris Plugin Js -->
    <script src="plugins/raphael/raphael.min.js"></script>
    <script src="plugins/morrisjs/morris.js"></script>


        <!-- Autosize Plugin Js -->
    <script src="plugins/autosize/autosize.js"></script>

    <!-- Moment Plugin Js -->
    <script src="plugins/momentjs/moment.js"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    <!-- Custom Js -->
    <script src="js/pages/forms/basic-form-elements.js"></script>
    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/forms/advanced-form-elements.js"></script>

    <!-- Demo Js -->
    <script src="js/demo.js"></script>
</body>

</html>