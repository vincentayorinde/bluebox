<?php 
error_reporting(0);
session_start();
include("timeout.php");
require_once 'db/config.php';
    if(isset($_SESSION['is_logged_in']) != true){
            header("Location: sign-in");
    }
    if(isset($_SESSION['user_data']['user_role']) == "agent" || $_SESSION['user_data']['user_role'] == "adminxz"){
        $email      =  $_SESSION['email'];
        $first_name =  $_SESSION['user_data']['first_name'];
        $last_name  =  $_SESSION['user_data']['last_name'];

        //Get BOP Info
        $date = date("Y-m-d");

        //Get Yesterday Date
        $yesterday = date('Y-m-d', strtotime('-1 day', strtotime($date)));

        //This Month
        $month = date("Y-m");

        //This Year
        $year_ = date("Y");


    // Amount of BOP entered today value
          $sql_bop_today_value = "SELECT sum(paid) as paid, date_added FROM bop_payment WHERE date_added LIKE '$date%'";
                                            $result_bop_today_value = $connect->query($sql_bop_today_value);
                                            $result_bop_today_value_ = mysqli_fetch_assoc($result_bop_today_value); 
                                            if ($result_bop_today_value)
                                              {
                                              // Return the number of rows in result set
                                              
                                              $result_bop_today_value = $result_bop_today_value_['paid'];
                                              }
                                              else {
                                              $result_bop_today_value="0";
                                          }
// Amount of BOP entered today
          $sql_bop_today = "SELECT * FROM bop_payment WHERE date_added LIKE '$date%'";
                                            $result_bop_today = $connect->query($sql_bop_today);

                                            if ($result_bop_today)
                                              {
                                              // Return the number of rows in result set
                                              $result_bop_today=mysqli_num_rows($result_bop_today);
                                              }
                                              else {
                                              $result_bop_today="0";
    }
       // Amount of BOP entered yesterday value
      $sql_bop_yesterday_value = "SELECT sum(paid) as paid, date_added FROM bop_payment WHERE date_added LIKE '$yesterday%'";
                                            $result_bop_yesterday_value = $connect->query($sql_bop_yesterday_value);
                                            $result_bop_yesterday_value_ = mysqli_fetch_assoc($result_bop_yesterday_value); 
                                            if ($result_bop_yesterday_value)
                                              {
                                              // Return the number of rows in result set
                                              
                                              $result_bop_yesterday_value = $result_bop_yesterday_value_['paid'];
                                              }
                                              else {
                                              $result_bop_yesterday_value="0";
                                          }
// Amount of BOP entered yesterday 
          $sql_bop_yesterday = "SELECT * FROM bop_payment WHERE date_added LIKE '$yesterday%'";
                                            $result_bop_yesterday = $connect->query($sql_bop_yesterday);

                                            if ($result_bop_yesterday)
                                              {
                                              // Return the number of rows in result set
                                              $result_bop_yesterday=mysqli_num_rows($result_bop_yesterday);
                                              }
                                              else {
                                              $result_bop_yesterday="0";
                                            }
                                  

            // Amount of BOP entered this month
          $sql_bop_month = "SELECT * FROM bop_payment WHERE date_added LIKE '$month%'";
                                            $result_bop_month = $connect->query($sql_bop_month);

                                            if ($result_bop_month)
                                              {
                                              // Return the number of rows in result set
                                              $result_bop_month=mysqli_num_rows($result_bop_month);
                                              }
                                              else {
                                              $result_bop_month="0";
                                          }
            // Amount of BOP entered this month value
           $sql_bop_month_value = "SELECT sum(paid) as paid, date_added FROM bop_payment WHERE date_added LIKE '$month%'";
                                            $result_bop_month_value = $connect->query($sql_bop_month_value);
                                            $result_bop_month_value_ = mysqli_fetch_assoc($result_bop_month_value); 
                                            if ($result_bop_month_value)
                                              {
                                              // Return the number of rows in result set
                                              
                                              $result_bop_month_value = $result_bop_month_value_['paid'];
                                              }
                                              else {
                                              $result_bop_month_value="0";
                                          }
    
       // Amount of BOP entered this year
          $sql_bop_year = "SELECT * FROM bop_payment WHERE date_added LIKE '$year_%'";
                                            $result_bop_year = $connect->query($sql_bop_year);

                                            if ($result_bop_year)
                                              {
                                              // Return the number of rows in result set
                                              $result_bop_year=mysqli_num_rows($result_bop_year);
                                              }
                                              else {
                                              $result_bop_year="0";
                                            }
        
         // Amount of BOP entered this year value
           $sql_bop_year_value = "SELECT sum(paid) as paid, date_added FROM bop_payment WHERE date_added LIKE '$year%'";
                                            $result_bop_year_value = $connect->query($sql_bop_year_value);
                                            $result_bop_year_value_ = mysqli_fetch_assoc($result_bop_year_value); 
                                            if ($result_bop_year_value)
                                              {
                                              // Return the number of rows in result set
                                              
                                              $result_bop_year_value = $result_bop_year_value_['paid'];
                                              }
                                              else {
                                              $result_bop_year_value="0";
                                          }


      
           // Amount of Property Rate entered today
          $sql_pr_today = "SELECT * FROM property_payment WHERE date_added LIKE '$date%'";
                                            $result_pr_today = $connect->query($sql_pr_today);

                                            if ($result_pr_today)
                                              {
                                              // Return the number of rows in result set
                                              $result_pr_today=mysqli_num_rows($result_pr_today);
                                              }
                                              else {
                                              $result_pr_today="0";
                                          }
           // Amount of Property Rate entered today value
         $sql_pr_today_value = "SELECT sum(paid) as paid, date_added FROM property_payment WHERE date_added LIKE '$date%'";
                                            $result_pr_today_value = $connect->query($sql_pr_today_value);
                                            $result_pr_today_value_ = mysqli_fetch_assoc($result_pr_today_value); 
                                            if ($result_pr_today_value)
                                              {
                                              // Return the number of rows in result set
                                              
                                              $result_pr_today_value = $result_pr_today_value_['paid'];
                                              }
                                              else {
                                              $result_pr_today_value="0";
                                          }
    
       // Amount of Property Rate entered yesterday
          $sql_pr_yesterday = "SELECT * FROM property_payment WHERE date_added LIKE '$yesterday%'";
                                            $result_pr_yesterday = $connect->query($sql_pr_yesterday);

                                            if ($result_pr_yesterday)
                                              {
                                              // Return the number of rows in result set
                                              $result_pr_yesterday=mysqli_num_rows($result_pr_yesterday);
                                              }
                                              else {
                                              $result_pr_yesterday="0";
                                            }
            // Amount of Property Rate entered yesterday value
         $sql_pr_yesterday_value = "SELECT sum(paid) as paid, date_added FROM property_payment WHERE date_added LIKE '$yesterday%'";
                                            $result_pr_yesterday_value = $connect->query($sql_pr_yesterday_value);
                                            $result_pr_yesterday_value_ = mysqli_fetch_assoc($result_pr_yesterday_value); 
                                            if ($result_pr_yesterday_value)
                                              {
                                              // Return the number of rows in result set
                                              
                                              $result_pr_yesterday_value = $result_pr_yesterday_value_['paid'];
                                              }
                                              else {
                                              $result_pr_yesterday_value="0";
                                          }                        


          // Amount of Property Rate entered this month
          $sql_pr_month = "SELECT * FROM property_payment WHERE date_added LIKE '$month%'";
                                            $result_pr_month = $connect->query($sql_pr_month);

                                            if ($result_pr_month)
                                              {
                                              // Return the number of rows in result set
                                              $result_pr_month=mysqli_num_rows($result_pr_month);
                                              }
                                              else {
                                              $result_pr_month="0";
                                          }
         // Amount of Property Rate entered month value
         $sql_pr_month_value = "SELECT sum(paid) as paid, date_added FROM property_payment WHERE date_added LIKE '$month%'";
                                            $result_pr_month_value = $connect->query($sql_pr_month_value);
                                            $result_pr_month_value_ = mysqli_fetch_assoc($result_pr_month_value); 
                                            if ($result_pr_month_value)
                                              {
                                              // Return the number of rows in result set
                                              
                                              $result_pr_month_value = $result_pr_month_value_['paid'];
                                              }
                                              else {
                                              $result_pr_month_value="0";
                                          } 
                                                                       
    
       // Amount of Property Rate entered this year
          $sql_pr_year = "SELECT * FROM property_payment WHERE date_added LIKE '$year%'";
                                            $result_pr_year = $connect->query($sql_pr_year);

                                            if ($result_pr_year)
                                              {
                                              // Return the number of rows in result set
                                              $result_pr_year=mysqli_num_rows($result_pr_year);
                                              }
                                              else {
                                              $result_pr_year="0";
                                            }

              // Amount of Property Rate entered year value
         $sql_pr_year_value = "SELECT sum(paid) as paid, date_added FROM property_payment WHERE date_added LIKE '$year%'";
                                            $result_pr_year_value = $connect->query($sql_pr_year_value);
                                            $result_pr_year_value_ = mysqli_fetch_assoc($result_pr_year_value); 
                                            if ($result_pr_year_value)
                                              {
                                              // Return the number of rows in result set
                                              
                                              $result_pr_year_value = $result_pr_year_value_['paid'];
                                              }
                                              else {
                                              $result_pr_year_value="0";
                                          }  


        // Amount of Building Permit entered today value
          $sql_bp_today_value = "SELECT sum(paid) as paid, date_added FROM building_payment WHERE date_added LIKE '$date%'";
                                            $result_bp_today_value = $connect->query($sql_bp_today_value);
                                            $result_bp_today_value_ = mysqli_fetch_assoc($result_bp_today_value); 
                                            if ($result_bp_today_value)
                                              {
                                              // Return the number of rows in result set
                                              
                                              $result_bp_today_value = $result_bp_today_value_['paid'];
                                              }
                                              else {
                                              $result_bp_today_value="0";
                                          }
// Amount of Building Permit entered today
          $sql_bp_today = "SELECT * FROM building_payment WHERE date_added LIKE '$date%'";
                                            $result_bp_today = $connect->query($sql_bp_today);

                                            if ($result_bp_today)
                                              {
                                              // Return the number of rows in result set
                                              $result_bp_today=mysqli_num_rows($result_bp_today);
                                              }
                                              else {
                                              $result_bp_today="0";
    }
       // Amount of Building Permit entered yesterday value
      $sql_bp_yesterday_value = "SELECT sum(paid) as paid, date_added FROM building_payment WHERE date_added LIKE '$yesterday%'";
                                            $result_bp_yesterday_value = $connect->query($sql_bp_yesterday_value);
                                            $result_bp_yesterday_value_ = mysqli_fetch_assoc($result_bp_yesterday_value); 
                                            if ($result_bp_yesterday_value)
                                              {
                                              // Return the number of rows in result set
                                              
                                              $result_bp_yesterday_value = $result_bp_yesterday_value_['paid'];
                                              }
                                              else {
                                              $result_bp_yesterday_value="0";
                                          }
// Amount of Building Permit entered yesterday 
          $sql_bp_yesterday = "SELECT * FROM building_payment WHERE date_added LIKE '$yesterday%'";
                                            $result_bp_yesterday = $connect->query($sql_bp_yesterday);

                                            if ($result_bp_yesterday)
                                              {
                                              // Return the number of rows in result set
                                              $result_bp_yesterday=mysqli_num_rows($result_bp_yesterday);
                                              }
                                              else {
                                              $result_bp_yesterday="0";
                                            }
                                  

            // Amount of Building Permit entered this month
          $sql_bp_month = "SELECT * FROM building_payment WHERE date_added LIKE '$month%'";
                                            $result_bp_month = $connect->query($sql_bp_month);

                                            if ($result_bp_month)
                                              {
                                              // Return the number of rows in result set
                                              $result_bp_month=mysqli_num_rows($result_bp_month);
                                              }
                                              else {
                                              $result_bp_month="0";
                                          }
            // Amount of Building Permit entered this month value
           $sql_bp_month_value = "SELECT sum(paid) as paid, date_added FROM building_payment WHERE date_added LIKE '$month%'";
                                            $result_bp_month_value = $connect->query($sql_bp_month_value);
                                            $result_bp_month_value_ = mysqli_fetch_assoc($result_bp_month_value); 
                                            if ($result_bp_month_value)
                                              {
                                              // Return the number of rows in result set
                                              
                                              $result_bp_month_value = $result_bp_month_value_['paid'];
                                              }
                                              else {
                                              $result_bp_month_value="0";
                                          }
    
       // Amount of Building Permit entered this year
          $sql_bp_year = "SELECT * FROM building_payment WHERE date_added LIKE '$year_%'";
                                            $result_bp_year = $connect->query($sql_bp_year);

                                            if ($result_bp_year)
                                              {
                                              // Return the number of rows in result set
                                              $result_bp_year=mysqli_num_rows($result_bp_year);
                                              }
                                              else {
                                              $result_bp_year="0";
                                            }
        
         // Amount of Building Permit entered this year value
           $sql_bp_year_value = "SELECT sum(paid) as paid, date_added FROM building_payment WHERE date_added LIKE '$year%'";
                                            $result_bp_year_value = $connect->query($sql_bp_year_value);
                                            $result_bp_year_value_ = mysqli_fetch_assoc($result_bp_year_value); 
                                            if ($result_bp_year_value)
                                              {
                                              // Return the number of rows in result set
                                              
                                              $result_bp_year_value = $result_bp_year_value_['paid'];
                                              }
                                              else {
                                              $result_bp_year_value="0";
                                          }




          // Inbox
         $sql_p = "SELECT * FROM property WHERE activ = 'Y' ";
                                            $result_p = $connect->query($sql_p);

                                            if ($result_p)
                                              {
                                              // Return the number of rows in result set
                                              $all_prop=mysqli_num_rows($result_p);
                                              }
                                              else {
                                              $result_p="0";
                                            }


        // Inbox
         $sql = "SELECT * FROM business WHERE activ = 'Y' ";
                                            $result = $connect->query($sql);

                                            if ($result)
                                              {
                                              // Return the number of rows in result set
                                              $all_freight=mysqli_num_rows($result);
                                              }
                                              else {
                                              $all_freight="0";
                                            }

        // Get All business
         $sql = "SELECT * FROM business WHERE activ = 'Y' ";
                                            $result = $connect->query($sql);

                                            if ($result)
                                              {
                                              // Return the number of rows in result set
                                              $all_freight=mysqli_num_rows($result);
                                              }
                                              else {
                                              $all_freight="0";
                                            }
        // Get my added business
          $sql = "SELECT * FROM business WHERE activ = 'Y' AND user_email = '$email' ";
                                            $result = $connect->query($sql);

                                            if ($result)
                                              {
                                              // Return the number of rows in result set
                                              $my_freights=mysqli_num_rows($result);
                                              }
                                              else {
                                              $my_freights="0";
                                            }

          // Get my added building permit
          $sql_bp = "SELECT * FROM building WHERE activ = 'Y' ";
                                            $result_bp = $connect->query($sql_bp);

                                            if ($result_bp)
                                              {
                                              // Return the number of rows in result set
                                              $bp_count=mysqli_num_rows($result_bp);
                                              }
                                              else {
                                              $bp_count="0";
                                            }
        // Get number of users
        // $sql = "SELECT * FROM users WHERE activ = 'Y' AND user_role<>'adminxz'";
        //                                     $result = $connect->query($sql);

        //                                     if ($result)
        //                                       {
        //                                       // Return the number of rows in result set
        //                                       $all_users=mysqli_num_rows($result);
        //                                       }
        //                                       else {
        //                                         $all_users = "0";
        //                                     }
        // Get the number of messages
         $theid = $_SESSION['user_data']['id'];
                          $sql = "SELECT * FROM private_messages WHERE to_id = $theid AND recipientDelete = '0'";
                           $result = $connect->query($sql);
                        if ($result)
                        {
                        // Return the number of rows in result set
                        $no_of_messages=mysqli_num_rows($result);
                        }
                        else {
                        $no_of_messages = "0";
                        }
    }
    ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Dashboard | <?php echo $name; ?></title>
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
                <h2>DASHBOARD</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                 <?php if($_SESSION['user_data']['user_role'] == "customer" || $_SESSION['user_data']['user_role'] == "agent" || $_SESSION['user_data']['user_role'] == "adminxz"){ ?>
                  <?php if($_SESSION['user_data']['user_role'] == "adminxz"){ ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">business</i>
                        </div>
                        <div class="content">
                            <div class="text">ALL BUSINESS</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $all_freight; ?>" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                 <?php } ?>
                 <?php if($_SESSION['user_data']['user_role'] == "agent" || $_SESSION['user_data']['user_role'] == "adminxz"){ ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">business</i>
                        </div>
                        <div class="content">
                            <div class="text">ALL PROPERTIES</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $all_prop; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                 <?php if($_SESSION['user_data']['user_role'] == "adminxz"){ ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">book</i>
                        </div>
                        <div class="content">
                            <div class="text">ALL B. PERMITS</div>
                            <div class="number count-to" data-from="0" data-to="<?php echo $bp_count; ?>" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                 <?php } ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">date_range</i>
                        </div>
                        <div class="content">
                            <div class="text">DATE</div>
                <div><?php echo date('Y-m-d'); ?></div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <!-- #END# Widgets -->
            
      <div class="block-header">
                <h2>BOP INFO</h2>
            </div>
            <?php  // echo date("Y-m-d H:i:s",time()); ?>
          <!-- Widgets -->
            <div class="row clearfix">
                 <?php if($_SESSION['user_data']['user_role'] == "customer" || $_SESSION['user_data']['user_role'] == "agent" || $_SESSION['user_data']['user_role'] == "adminxz"){ ?>
                  <?php if($_SESSION['user_data']['user_role'] == "adminxz"){ ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">BOP Payment Today</div>
                            <div style="font-size: 18px !important;" class="number count-to" data-from="0" data-to="<?php echo $result_bop_today; ?>" data-speed="15" data-fresh-interval="20"></div>
                                <small style="font-size: 11px !important;">Value (GHS <?php echo $result_bop_today_value ?>.00)</small>
                        </div>
                    </div>
                </div>
                 <?php } ?>
                 <?php if($_SESSION['user_data']['user_role'] == "agent" || $_SESSION['user_data']['user_role'] == "adminxz"){ ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">payment</i>
                        </div>
                        <div class="content">
                            <div class="text">BOP Yesterday</div>
                            <div style="font-size: 18px !important;" class="number count-to" data-from="0" data-to="<?php echo $result_bop_yesterday; ?>" data-speed="1000" data-fresh-interval="20"></div>
                            <small style="font-size: 11px !important;">Value (GHS <?php echo $result_bop_yesterday_value ?>.00)</small>
                        </div>
                    </div>
                </div>
                <?php } ?>
                 <?php if($_SESSION['user_data']['user_role'] == "adminxz"){ ?>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">feedback</i>
                        </div>
                        <div class="content">
                            <div class="text">BOP This Month</div>
                            <div style="font-size: 18px !important;" class="number count-to" data-from="0" data-to="<?php echo $result_bop_month; ?>" data-speed="1000" data-fresh-interval="20"></div>
                            <small style="font-size: 11px !important;">Value (GHS <?php echo $result_bop_month_value ?>.00)</small>
                        </div>
                    </div>
                </div>
                 <?php } ?>
                     <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">feedback</i>
                        </div>
                        <div class="content">
                            <div class="text">BOP This Year</div>
                            <div style="font-size: 18px !important;" class="number count-to" data-from="0" data-to="<?php echo $result_bop_year; ?>" data-speed="1000" data-fresh-interval="20"></div>
                            <small style="font-size: 11px !important;">Value (GHS <?php echo $result_bop_year_value ?>.00)</small>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <!-- #END# Widgets -->

<div class="block-header">
                <h2>PROPERTY RATE INFO</h2>
            </div>
          <!-- Widgets -->
            <div class="row clearfix">
                 <?php if($_SESSION['user_data']['user_role'] == "customer" || $_SESSION['user_data']['user_role'] == "agent" || $_SESSION['user_data']['user_role'] == "adminxz"){ ?>
                  <?php if($_SESSION['user_data']['user_role'] == "adminxz"){ ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">PR Payment Today</div>
                            <div style="font-size: 18px !important;" class="number count-to" data-from="0" data-to="<?php echo $result_pr_today; ?>" data-speed="15" data-fresh-interval="20"></div>
                            <small style="font-size: 11px !important;">Value (GHS <?php echo $result_pr_today_value ?>.00)</small>
                        </div>
                    </div>
                </div>
                 <?php } ?>
                 <?php if($_SESSION['user_data']['user_role'] == "agent" || $_SESSION['user_data']['user_role'] == "adminxz"){ ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">payment</i>
                        </div>
                        <div class="content">
                            <div class="text">PR Yesterday</div>
                            <div style="font-size: 18px !important;" class="number count-to" data-from="0" data-to="<?php echo $result_pr_yesterday; ?>" data-speed="1000" data-fresh-interval="20"></div>
                             <small style="font-size: 11px !important;">Value (GHS <?php echo $result_pr_yesterday_value ?>.00)</small>
                        </div>
                    </div>
                </div>
                 <?php } ?>
                 <?php if($_SESSION['user_data']['user_role'] == "adminxz"){ ?>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">feedback</i>
                        </div>
                        <div class="content">
                            <div class="text">PR This Month</div>
                            <div style="font-size: 18px !important;" class="number count-to" data-from="0" data-to="<?php echo $result_pr_month; ?>" data-speed="1000" data-fresh-interval="20"></div>
                             <small style="font-size: 11px !important;">Value (GHS <?php echo $result_pr_month_value ?>.00)</small>
                        </div>
                    </div>
                </div>
                 <?php } ?>
                     <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">feedback</i>
                        </div>
                        <div class="content">
                            <div class="text">PR This Year</div>
                            <div  style="font-size: 18px !important;" class="number count-to" data-from="0" data-to="<?php echo $result_pr_year; ?>" data-speed="1000" data-fresh-interval="20"></div>
                            <small style="font-size: 11px !important;">Value (GHS <?php echo $result_pr_year_value ?>.00)</small>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <!-- #END# Widgets -->

<div class="block-header">
                <h2>BUILDING PERMIT INFO</h2>
            </div>
          <!-- Widgets -->
            <div class="row clearfix">
                 <?php if($_SESSION['user_data']['user_role'] == "customer" || $_SESSION['user_data']['user_role'] == "agent" || $_SESSION['user_data']['user_role'] == "adminxz"){ ?>
                  <?php if($_SESSION['user_data']['user_role'] == "adminxz"){ ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">BP Payment Today</div>
                            <div style="font-size: 18px !important;" class="number count-to" data-from="0" data-to="<?php echo $result_bp_today; ?>" data-speed="15" data-fresh-interval="20"></div>
                            <small style="font-size: 11px !important;">Value (GHS <?php echo $result_bp_today_value ?>.00)</small>
                        </div>
                    </div>
                </div>
                 <?php } ?>
                 <?php if($_SESSION['user_data']['user_role'] == "agent" || $_SESSION['user_data']['user_role'] == "adminxz"){ ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">payment</i>
                        </div>
                        <div class="content">
                            <div class="text">BP Yesterday</div>
                            <div style="font-size: 18px !important;" class="number count-to" data-from="0" data-to="<?php echo $result_bp_yesterday; ?>" data-speed="1000" data-fresh-interval="20"></div>
                             <small style="font-size: 11px !important;">Value (GHS <?php echo $result_bp_yesterday_value ?>.00)</small>
                        </div>
                    </div>
                </div>
                 <?php } ?>
                 <?php if($_SESSION['user_data']['user_role'] == "adminxz"){ ?>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">feedback</i>
                        </div>
                        <div class="content">
                            <div class="text">BP This Month</div>
                            <div style="font-size: 18px !important;" class="number count-to" data-from="0" data-to="<?php echo $result_bp_month; ?>" data-speed="1000" data-fresh-interval="20"></div>
                             <small style="font-size: 11px !important;">Value (GHS <?php echo $result_bp_month_value ?>.00)</small>
                        </div>
                    </div>
                </div>
                 <?php } ?>
                     <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">feedback</i>
                        </div>
                        <div class="content">
                            <div class="text">BP This Year</div>
                            <div  style="font-size: 18px !important;" class="number count-to" data-from="0" data-to="<?php echo $result_bp_year; ?>" data-speed="1000" data-fresh-interval="20"></div>
                            <small style="font-size: 11px !important;">Value (GHS <?php echo $result_bp_year_value ?>.00)</small>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <!-- #END# Widgets -->


            <!-- CPU Usage -->
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-6">
                                    <h2>CPU USAGE (%)</h2>
                                </div>
                                <div class="col-xs-12 col-sm-6 align-right">
                                    <div class="switch panel-switch-btn">
                                        <span class="m-r-10 font-12">REAL TIME</span>
                                        <label>OFF<input type="checkbox" id="realtime" checked><span class="lever switch-col-cyan"></span>ON</label>
                                    </div>
                                </div>
                            </div>
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
                            <div id="real_time_chart" class="dashboard-flot-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# CPU Usage -->
            <!-- <div class="row clearfix"> -->
                <!-- Visitors -->
          <!--       <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="body bg-pink">
                            <div class="sparkline" data-type="line" data-spot-Radius="4" data-highlight-Spot-Color="rgb(233, 30, 99)" data-highlight-Line-Color="#fff"
                                 data-min-Spot-Color="rgb(255,255,255)" data-max-Spot-Color="rgb(255,255,255)" data-spot-Color="rgb(255,255,255)"
                                 data-offset="90" data-width="100%" data-height="92px" data-line-Width="2" data-line-Color="rgba(255,255,255,0.7)"
                                 data-fill-Color="rgba(0, 188, 212, 0)">
                                12,10,9,6,5,6,10,5,7,5,12,13,7,12,11
                            </div>
                            <ul class="dashboard-stat-list">
                                <li>
                                    TODAY
                                    <span class="pull-right"><b>1 200</b> <small>USERS</small></span>
                                </li>
                                <li>
                                    YESTERDAY
                                    <span class="pull-right"><b>3 872</b> <small>USERS</small></span>
                                </li>
                                <li>
                                    LAST WEEK
                                    <span class="pull-right"><b>26 582</b> <small>USERS</small></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> -->
                <!-- #END# Visitors -->
                <!-- Latest Social Trends -->
           <!--      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="body bg-cyan">
                            <div class="m-b--35 font-bold">LATEST SOCIAL TRENDS</div>
                            <ul class="dashboard-stat-list">
                                <li>
                                    #socialtrends
                                    <span class="pull-right">
                                        <i class="material-icons">trending_up</i>
                                    </span>
                                </li>
                                <li>
                                    #materialdesign
                                    <span class="pull-right">
                                        <i class="material-icons">trending_up</i>
                                    </span>
                                </li>
                                <li>#adminbsb</li>
                                <li>#freeadmintemplate</li>
                                <li>#bootstraptemplate</li>
                                <li>
                                    #freehtmltemplate
                                    <span class="pull-right">
                                        <i class="material-icons">trending_up</i>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> -->
                <!-- #END# Latest Social Trends -->
                <!-- Answered Tickets -->
             <!--    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="body bg-teal">
                            <div class="font-bold m-b--35">ANSWERED TICKETS</div>
                            <ul class="dashboard-stat-list">
                                <li>
                                    TODAY
                                    <span class="pull-right"><b>12</b> <small>TICKETS</small></span>
                                </li>
                                <li>
                                    YESTERDAY
                                    <span class="pull-right"><b>15</b> <small>TICKETS</small></span>
                                </li>
                                <li>
                                    LAST WEEK
                                    <span class="pull-right"><b>90</b> <small>TICKETS</small></span>
                                </li>
                                <li>
                                    LAST MONTH
                                    <span class="pull-right"><b>342</b> <small>TICKETS</small></span>
                                </li>
                                <li>
                                    LAST YEAR
                                    <span class="pull-right"><b>4 225</b> <small>TICKETS</small></span>
                                </li>
                                <li>
                                    ALL
                                    <span class="pull-right"><b>8 752</b> <small>TICKETS</small></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> -->
                <!-- #END# Answered Tickets -->
            <!-- </div> -->

            <!-- <div class="row clearfix"> -->
                <!-- Task Info -->
         <!--        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="card">
                        <div class="header">
                            <h2>TASK INFOS</h2>
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
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Task</th>
                                            <th>Status</th>
                                            <th>Manager</th>
                                            <th>Progress</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Task A</td>
                                            <td><span class="label bg-green">Doing</span></td>
                                            <td>John Doe</td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Task B</td>
                                            <td><span class="label bg-blue">To Do</span></td>
                                            <td>John Doe</td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Task C</td>
                                            <td><span class="label bg-light-blue">On Hold</span></td>
                                            <td>John Doe</td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-light-blue" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width: 72%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Task D</td>
                                            <td><span class="label bg-orange">Wait Approvel</span></td>
                                            <td>John Doe</td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Task E</td>
                                            <td>
                                                <span class="label bg-red">Suspended</span>
                                            </td>
                                            <td>John Doe</td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-red" role="progressbar" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100" style="width: 87%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- #END# Task Info -->
                <!-- Browser Usage -->
             <!--    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="header">
                            <h2>BROWSER USAGE</h2>
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
                            </ul>
                        </div>
                        <div class="body">
                            <div id="donut_chart" class="dashboard-donut-chart"></div>
                        </div>
                    </div>
                </div> -->
                <!-- #END# Browser Usage -->
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