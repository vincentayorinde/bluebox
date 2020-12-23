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
        $my_id  =  $_SESSION['user_data']['id'];
    }
      if(isset($_POST['deleteBtn'])){
        $postVars = "";
        foreach ($_POST as $key => $value){
            $value = urlencode(stripcslashes($value));
            if($key != "deleteBtn"){
                $sql = mysqli_query($connect, "UPDATE private_messages SET recipientDelete='1', opened='1'
                                                WHERE id = '$value' AND to_id = '$my_id' LIMIT 1 ");
                // Check to see if sender also removed from sent box, then it is safe to remove completely from system
            }
        }
        header("location:inbox.php");
    }
    ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Inbox | Pacific Heavens Logistics</title>
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
     <script src="plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
    function toggleChecks(field){
        if(document.myform.toggleAll.checked == true){
            for(i=0;i<field.length;i++){
                field[i].checked=true;
            }
        }else{
            for(i=0;i<field.length;i++){
                field[i].checked=false;
        }
    }
}

$(document).ready(function(){
    $(".toggle").click(function(){
        if($(this).next().is(":hidden")){
            $(".hiddenDiv").hide();
            $(this).next().slideDown("fast");
        }else{
            $(this).next().hide();
        }
    });
});
function markAsRead(msgID){
    $.post("markasread.php", 
    {
        messageid:msgID,
        ownerid:<?php echo $my_id; ?>
        
    },
    function(data){
        $('#subj_line_'+msgID).addClass('msgRead');
        //alert(data); //used for text retured data from the PHP file
    });

}
function toggleReplyBox(subject,sendername,senderid,recName,recID){
    $("#subjectShow").text(subject);
    $("#recipientShow").text(recName);
    document.replyForm.pmSubject.value      = subject;
    document.replyForm.pm_sender_name.value = sendername;
    // document.replyForm.pmWipit.value         = replyWipit;
    document.replyForm.pm_sender_id.value   = senderid;
    document.replyForm.pm_rec_name.value    = recName;
    document.replyForm.pm_rec_id.value      = recID;
    document.replyForm.replyBtn.value       = "Send reply to "+recName;
    if($('#replyBox').is(":hidden")){
        $('#replyBox').fadeIn(1000);
    }else{
        $('#replyBox').hide();
    }
}
function processReply(){
    var pmSubject   = $("#pmSubject");
    var pmTextArea  = $("#pmTextArea");
    var sendername  = $("#pm_sender_name");
    var senderid    = $("#pm_sender_id");
    var recName     = $("#pm_rec_name");
    var recID       = $("#pm_rec_id");
    // var pm_wipit     = $("#pmWipit");
    var url         = "parse-message.php";
    if(pmTextArea.val() == ""){
        $("#PMStatus").text("Please type in your message").show().fadeOut(6000);
    }else{
        $("#pmFormProcessGif").show();
        $.post(url,{
            subject: pmSubject.val(),
            message: pmTextArea.val(),
            senderName: sendername.val(),
            senderID: senderid.val(),
            rcpntName: recName.val(),
            rcpntID: recID.val(),
            // thisWipit: pm_wipit.val()
        },
        function(data){
            document.replyForm.pmTextArea.value = "",
            $("#pmFormProcessGif").hide();
            $("#replyBox").slideUp("fast");
            $("#PMFinal").html("&nbsp; &nbsp;"+data).show().fadeOut(8000);
        });
    }
}


</script>
<style type="text/css">
    .hiddenDiv{
        display: none;
    }
    .replyBoxes{
        display: none;
        border: #999 1px solid;
        background-color: #ccc;
        margin-left: 100px;
        margin-right: 100px;
        padding: 12px; 
    }
    #pmFormProcessGif{
        display: none;
    }
    .msgDefault{
        font-weight: bold;
    }
    .msgRead{
        font-weight: 100;
        color: #666;
    }
</style>
</style>
</head>

<body class="theme-blue">
     <!-- Left Bar -->
    <?php include 'includes/left-sidebar.php'; ?>

    <!-- Right Bar -->
    <?php include 'includes/right-sidebar.php'; ?>
    </section>

   <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    MESSAGES
                    <small>Showing all received messages</small>
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
                                INBOX <a href="compose-message.php" class="btn bg-red waves-effect"><i class="material-icons">mode_edit</i>
                                    <span>COMPOSE</span>
                                </a>
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
                    <form name="myform" action="" method="post" enctype="multipart/form-data">
                    <table class="ui small table" width="100%" border="0" align="center">
                          <thead>
                        <tr>
                        <th width="3%" align="right" valign="bottom"><i class="arrow circle down icon"></i></th>
                        <th width="97%" valign="top"><input type="submit" name="deleteBtn" class="btn bg-red waves-effect" id="deleteBtn" value="Delete">
                        <span id="jsbox" style="display: none"></span>
                        </th>
                        </tr>
                    </thead>
                    </table>
                    <table class="ui small table" width="100%" border="0" align="center">
                        <thead>
                        <tr class="positive">
                            <th width="4%" valign="top">
                                <input type="checkbox" name="toggleAll" id="toggleAll" onclick="toggleChecks(document.myform.cb<?php echo $row['id'];?>)" />
                                <!-- <label for="toggleAll"></label> -->
                            
                            </th>
                            <th width="20%" valign="top">From</td>
                            <th width="58%" valign="top"><span class="style2">Subject</span></td>
                            <th width="18%" valign="top">Date</td>
                        </tr>
                        </thead>
                    </table>
<?php 
    // SQL to gather their entire PM List
    $sql = mysqli_query($connect, "SELECT * FROM private_messages WHERE to_id = '$my_id' AND recipientDelete = '0'
                                    ORDER BY id DESC LIMIT 100");
    while($row = mysqli_fetch_assoc($sql)){
        $date = strftime("%b %d, %Y", strtotime($row['time_sent']));
        if($row['opened'] == "0"){
            $textWeight = 'msgDefault';
        }else{
            $textWeight = 'msgRead';
        }
        $fr_id = $row['from_id'];
        //SQL - Collect username for sender inside loop
        $ret = mysqli_query($connect, "SELECT id, email, first_name, last_name FROM users WHERE id = '$fr_id' LIMIT 1");
        while ($raw = mysqli_fetch_assoc($ret)){
            $Sid = $raw['id'];
            $Sname = $raw['first_name'] ." ". $raw['last_name'];
        }
?>
<table width="100%" class="ui celled blue table small" border="0" align="center" cellpadding="4">
    <tr >
        <td width="4%" valign="top">
            <input type="checkbox" name="cb<?php echo $row['id'];?>" id="cb<?php echo $row['id'];?>" value="<?php echo $row['id'];?>" >
            <label for="cb<?php echo $row['id'];?>"></label>
        </td>
        <td width="20%" valign="top"><a href="#"><?php echo $Sname; ?></a></td>
        <td width="58%" valign="top">
            <span class="toggle" style="padding: 3px;">
                <!-- <?php //echo $row['id']; ?>
                <?php //echo $my_id; ?> -->
                <a class="<?php echo $textWeight; ?>" id="subj_line_<?php echo $row['id']?>" style="cursor: pointer;"
                     onclick="markAsRead(<?php echo $row['id']; ?>)"> <?php echo stripcslashes($row['subject']); ?></a>
            </span>
            <div class="hiddenDiv"><br>
                <?php echo stripcslashes(wordwrap(nl2br($row['message']), 54, "\n", true)); ?>
                <br><br><a class="btn bg-red waves-effect" href="javascript:toggleReplyBox('<?php echo stripcslashes($row['subject']); ?>','<?php echo $first_name; ?>','<?php echo $my_id; ?>','<?php echo $Sname; ?>','<?php echo $fr_id; ?>')"><i class="material-icons">reply</i><span>REPLY</span></a><br>
            </div>
        </td>
        <td width="18%" valign="top"><span style="font-size:10px;"><?php echo $date; ?></span></td>
    </tr>
       
</table>
<?php
    } //Close Main while loop
?>
                </form>
                         </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
          <div id="replyBox" style="display: none;  top: 90px; position: fixed; padding: 1; color: #000; background-color: gray; width: 62%;">
    <div class="ui raised very padded text container blue inverted segment">
<div align="left"><a href="javascript:toggleReplyBox('close')" class="btn bg-red waves-effect"><i class="material-icons">close</i>
                                    <span>CLOSE</span>
                                </a></div>
<h2>Replying to <span style="color:#ABE3FE;" id="recipientShow"></span></h2>
Subject: <strong><span style="color:#ABE3FE;" id="subjectShow"></span></strong><br>
<form action="javascript:processReply();" name="replyForm" id="replyForm" method="post">
    <textarea id="pmTextArea" rows="10" style="width:70%;"></textarea><br>
    <input type="hidden" id="pmSubject">
    <input type="hidden" id="pm_rec_id">
    <input type="hidden" id="pm_rec_name">
    <input type="hidden" id="pm_sender_id">
    <input type="hidden" id="pm_sender_name">
    <!-- <input type="hidden" id="pmWipit"> -->
    <br>
    <input name="replyBtn" class="btn bg-red waves-effect" type="button" onclick="javascript:processReply()">&nbsp;&nbsp;&nbsp; <span id="pmFormProcessGif">processing...</span>
    <div id="PMStatus" style="color: #F00; font-size: 14px; font-weight: 700;">&nbsp;</div>
</form>
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

    <!-- Ckeditor -->
    <script src="plugins/ckeditor/ckeditor.js"></script>

    <!-- TinyMCE -->
    <script src="plugins/tinymce/tinymce.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/forms/editors.js"></script>
    <script src="js/pages/ui/modals.js"></script>

    <!-- Demo Js -->
    <script src="js/demo.js"></script>
</body>

</html>