<?php 
// session_start();
// require_once '../db/config.php';
?>
<?php if($_SESSION['user_data']['user_role'] == "agent" ){?>
<body class="theme-blue">
    <?php }?>
<?php if($_SESSION['user_data']['user_role'] == "customer" ){?>
<body class="theme-green">
    <?php }?>
<?php if($_SESSION['user_data']['user_role'] == "adminxz" ){?>
<body class="theme-blue">
    <?php }?>
    <!-- Left Bar -->
<!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>

                <a class="navbar-brand" href="sign-in">
                 
                 <?php echo $name; ?>
                     
                 </a>
                    
         
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <div style="height: 8px;"></div>
                            <img src="images/arm.png" width="48" height="48" alt="User" />
                <ul class="nav navbar-nav navbar-right">
                    
                <!-- Call Search -->
                   <div>
                   <a href="search" class="btn bg-light-green waves-effect"> <i class="material-icons">search</i> Search </a>
                   </div>
                    <!-- <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li> -->
                    <!-- #END# Call Search -->
                    <!-- Notifications -->
                    <li class="dropdown">
                        <a href="#" role="button">
                            <!-- <i class="material-icons">mail</i> -->
                            <!-- <span class="label-count"> -->
                                <?php 
                                // if(isset($_SESSION['is_logged_in'])){ 
                                //       $email = $_SESSION['email'];
                                //       $theid = $_SESSION['user_data']['id'];
                                //       $sql = "SELECT * FROM private_messages WHERE to_id = $theid AND opened = '0' ";
                                //       $result = $connect->query($sql);
                                //         if ($result){
                                //             if($rowcountim=mysqli_num_rows($result) > 0){
                                //                      echo $rowcountim;
                                //                }else{
                                //                      echo "";
                                //                 }
                                //             }
                                //         }
                                           ?>
                        <!-- </span> -->
                        </a>

                        <!-- <ul class="dropdown-menu">
                            <li class="header">NOTIFICATIONS</li>
                            <li class="body">
                                <ul class="menu">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">person_add</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>12 new members joined</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 14 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-cyan">
                                                <i class="material-icons">add_shopping_cart</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>4 sales made</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 22 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-red">
                                                <i class="material-icons">delete_forever</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>Nancy Doe</b> deleted account</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 3 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-orange">
                                                <i class="material-icons">mode_edit</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>Nancy</b> changed name</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 2 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-blue-grey">
                                                <i class="material-icons">comment</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>John</b> commented your post</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 4 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">cached</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>John</b> updated status</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 3 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-purple">
                                                <i class="material-icons">settings</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>Settings updated</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> Yesterday
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">View All Notifications</a>
                            </li>
                        </ul> -->
                    </li>
                    <!-- #END# Notifications -->
                    <!-- Tasks -->
                   <!--  <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">flag</i>
                            <span class="label-count">9</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">TASKS</li>
                            <li class="body">
                                <ul class="menu tasks">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Footer display issue
                                                <small>32%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-pink" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 32%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Make new buttons
                                                <small>45%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-cyan" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Create new dashboard
                                                <small>54%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-teal" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 54%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Solve transition issue
                                                <small>65%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 65%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Answer GitHub questions
                                                <small>92%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 92%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">View All Tasks</a>
                            </li>
                        </ul>
                    </li> -->
                    <!-- #END# Tasks -->
                   <!--  <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li> -->
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $first_name." ".$last_name ?></div>
                    <div class="email"><?php echo $email; ?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                          <!--   <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li> -->
                            <li role="seperator" class="divider"></li>
                            <li><a href="logout.php"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">
                    <?php if($_SESSION['user_data']['user_role'] == "customer" ){?>
                        CUSTOMER ACCOUNT
                            <?php }?>
                    <?php if($_SESSION['user_data']['user_role'] == "agent" ){?>
                        AGENT ACCOUNT
                            <?php }?>
                    <?php if($_SESSION['user_data']['user_role'] == "adminxz" ){?>
                        ADMIN ACCOUNT
                            <?php }?>
                    

                </li>
                    <li class="active">
                        <a href="sign-in">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <?php if($_SESSION['user_data']['user_role'] == "agent"){ ?>
                        <li class="">
                        <a href="enter-data">
                            <i class="material-icons">business</i>
                            <span>Enter Data</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="print-bill">
                            <i class="material-icons">assignment</i>
                            <span>Print Bill/ Make Payment</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="make-payment">
                            <i class="material-icons">payment</i>
                            <span>Make Payment</span>
                        </a>
                    </li>
               <?php }?>
                    <?php if($_SESSION['user_data']['user_role'] == "adminxz"){ ?>
                    <li class="">
                        <a href="enter-data">
                            <i class="material-icons">business</i>
                            <span>Enter Data</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="print-bill">
                            <i class="material-icons">assignment</i>
                            <span>Print Bill/ Make Payment</span>
                        </a>
                    </li>
                    <!-- <li class="">
                        <a href="make-payment">
                            <i class="material-icons">payment</i>
                            <span>Make Payment</span>
                        </a>
                    </li> -->
                     <li class="">
                        <a href="report">
                            <i class="material-icons">book</i>
                            <span>Report</span>
                        </a>
                    </li>
            
                     <li class="">
                        <a href="all-users">
                            <i class="material-icons">people</i>
                            <span>Users</span>
                        </a>
                    </li>
                    
                   <!--  <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">business</i>
                            <span>BOP</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="add-new-business">Add New</a>
                            </li> -->
                          <!--   <li>
                                <a href="my-added-business">My Added Businesses</a>
                            </li> -->
                            <?php if($_SESSION['user_data']['user_role'] == "adminxz"){ ?>
                            <!-- <li>
                                <a href="all-business">Show All</a>
                            </li> -->
                            <?php } ?>
                      <!--   </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Property Rates</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="add-new-rate">Add New</a>
                            </li> -->
                            <!-- <li>
                                <a href="my-added-rate">My Added Rates</a>
                            </li> -->
                            <?php if($_SESSION['user_data']['user_role'] == "adminxz"){ ?>
                           <!--  <li>
                                <a href="all-rates">Show All Rates</a>
                            </li> -->
                            <?php } ?>
                       <!--  </ul>
                    </li>
                     <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Building Permit</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="add-building-permit">Add New</a>
                            </li> -->
                            <!-- <li>
                                <a href="my-added-rate">My Added Rates</a>
                            </li> -->
                            <?php if($_SESSION['user_data']['user_role'] == "adminxz"){ ?>
                            <!-- <li>
                                <a href="all-building-permit">Show All Permits</a>
                            </li> -->
                            <?php } ?>
                       <!--  </ul>
                    </li>
                     <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">view_carousel</i>
                            <span>Signage</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="add-signage">Add New</a>
                            </li> -->
                            <!-- <li>
                                <a href="my-added-rate">My Added Rates</a>
                            </li> -->
                            <?php if($_SESSION['user_data']['user_role'] == "adminxz"){ ?>
                           <!--  <li>
                                <a href="all-signage">Show All Signage</a>
                            </li> -->
                            <?php } ?>
                       <!--  </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">payment</i>
                            <span>Payment</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="enter-payment-bop">BOP</a>
                            </li>
                             <li>
                                <a href="bop-payment-list">BOP Payment List</a>
                            </li>
                            <li>
                                <a href="enter-payment-rate">Property Rate</a>
                            </li>
                            <li>
                                <a href="property-payment-list">Property Rate Payment List</a>
                            </li>
                            <li>
                                <a href="enter-payment-b-permit">Building Permit</a>
                            </li>
                            <li>
                                <a href="b-permit-payment-list">Building Permit Payment List</a>
                            </li>
                            <li>
                                <a href="enter-payment-signage">Signage</a>
                            </li>
                            <li>
                                <a href="signage-payment-list">Signage Payment List</a>
                            </li>
                             -->
                            <?php if($_SESSION['user_data']['user_role'] == "adminxz"){ ?>
                           <!-- <li>
                                <a href="all-payments">All Payment Records</a>
                            </li> -->
                            <?php } ?>
                        </ul>
                    </li>
                   
                    <!--    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">book</i>
                            <span>Generate Report</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="bop-report">BOP</a>
                            </li>
                            <li>
                                <a href="property-rate-report">Property Rate</a>
                            </li>
                            
                            <?php //if($_SESSION['user_data']['user_role'] == "adminxz"){ ?>
                           <li>
                                <a href="all-payments">All Payment Records</a>
                            </li> 
                            <?php //} ?>
                        </ul>
                    </li> -->
                    <!--    <li>
                        <a href="#" class="menu-toggle">
                            <i class="material-icons">book </i>
                            <span>Generate Report</span>
                        </a>
                    </li> -->

                    <?php } ?>
                     <!-- <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">email</i>
                            <span>Messages</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="compose-message.php">Compose</a>
                            </li>
                            <li>
                                <a href="inbox.php">Inbox</a>
                            </li>
                            <li>
                                <a href="sent.php">Sent</a>
                            </li>
                        </ul>
                    </li> -->
                    <?php if($_SESSION['user_data']['user_role'] == "adminxz"){ ?>
                   <!--  <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">people</i>
                            <span>Users</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="all-users">All Users</a>
                            </li>
                            <li>
                                <a href="add-user">Create User</a>
                            </li>
                             <li>
                                <a href="logs.php">Logs</a>
                            </li> -->
                      <!--   </ul>
                    </li>
                    <li>
                        <a href="reportmain">
                            <i class="material-icons">assignment</i>
                            <span>Report</span>
                        </a>
                        
                    </li> --> 
                  <?php } ?>
                   
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2019<a href="javascript:void(0);"> BlueBox System</a>
                </div>
                <div class="version">
                   <small> <b>Version: </b> 1.0.0 by <a href="https://vincenttechblog.com" target="_blank"> VTB</a></small>
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->