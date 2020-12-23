<!DOCTYPE html>
<html>


<!-- Mirrored from dev.lorvent.com/globals/directory/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 19 Sep 2016 06:01:03 GMT -->
<head>
    <!--meta tag css link-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="images/fevicon.ico" type="image/x-icon">
    <!--title-->
    <title>Pacific Heavens Logistics | Thanks</title>
    <style type="text/css">
        #tabs .ui-tabs-active {
            background: gray;
        }
    </style>

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

        <style>
            .back {
                background-image: url("images/crystolite/back.jpg");
            }
        </style>
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
    
    
    <!--slider-->
    <!--
    #################################
        - THEMEPUNCH BANNER -
    #################################
    -->
    <div class="container-fluid" style="background-color:#3399cc;">
        <div class="container" style="margin-top:40px; margin-bottom:40px;">
            <h1 style="font-size: 81px; color: #fafafa; opacity: 0.8; font-weight: 500;  text-transform:uppercase">Thanks</h1>
            <h1 style="font-size: 30px;  color: #fafafa;  opacity: 0.8; font-weight: 500; text-transform: uppercase; margin-top: -20px;"> Thanks, Our team will revert shortly...</h1>
        </div>
    </div>

     
    <?php include 'addon/footer.php' ?>
   
    <!--jquery js file-->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

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
    </script>
</body>
<!-- Mirrored from dev.lorvent.com/globals/directory/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 19 Sep 2016 06:01:52 GMT -->
</html>
