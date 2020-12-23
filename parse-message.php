<?php

session_start();
require_once '../db/config.php'; //Require connection to database

//Prevent double posts 
$checkuserid = $_POST['senderID'];
$prevent_dp = mysqli_query($connect,"SELECT id FROM private_messages WHERE from_id = '$checkuserid' AND time_sent BETWEEN subtime(now(),'0:0:20') and now()");
$nr = mysqli_num_rows($prevent_dp);
  if($nr > 0){
    $msg = '<div class="alert alert-danger">You must wait 20 seconds between you private message sending</div>';
    // exit();
  }

//Prevent more than 30  in one day from this member
$sql = mysqli_query($connect,"SELECT id FROM private_messages WHERE from_id = '$checkuserid' AND DATE(time_sent) = DATE(now()) LIMIT 40");
$numRows = mysqli_num_rows($sql);
  if($numRows > 30){
    $msg = '<div class="alert alert-danger">You can only send 30 private messages per</div>';
    // exit();
  }

// Parse the message
// Process the message once it has been sent
  if(isset($_POST['message'])){
    //Escape and prepare our variables for insertion into the databse
    //Thi is alse where you would run any sort of editing, such as BBcode parsing
    $to = ($_POST['rcpntID']);
    $from = ($_POST['senderID']);
    $toName = ($_POST['rcpntName']);
    $fromName = ($_POST['senderName']);
    $sub = htmlspecialchars($_POST['subject']); // Convert html tags and such to html entities which are safer to store and display
    $msg = htmlspecialchars($_POST['message']); // Convert html tags and such to html entities which are safer to store and display
    $sub = mysqli_real_escape_string($connect,$sub); // Just in case anything malicious is not converted, we escape those characters here
    $msg = mysqli_real_escape_string($connect,$msg); // Just in case anything malicious is not converted, we escape those characters here

    //Handle all PM form specific error checking here
    if(empty($to) || empty($from) || empty($toName) || empty($fromName) || empty($sub) || empty($msg)){
      
      $msg = '<div class="alert alert-danger">Missing Data to continue</div>';
      // exit();
    }else{
      // Delete the message residing at the tail end of their list to they cannot archive more that 100 PMs
      $sqldeleteTail = mysqli_query($connect,"SELECT * FROM private_messages WHERE to_id = '$to' ORDER BY time_sent DESC LIMIT 0,100");
      $dci = 1;
      while($row = mysqli_fetch_assoc($sqldeleteTail)){
        $pm_id = $row['id'];
        if($dci > 99){
          $deleteTail = mysqli_query($connect,"DELETE FROM private_messages WHERE id = '$pm_id'");
        }
        $dci++;
      }
      //End delete any comments past 100 off of the tail end

      //Insert the data into table now
      $sql = "INSERT INTO private_messages (to_id, from_id, time_sent, subject, message)
          VALUES ('$to', '$from', now(), '$sub', '$msg')";
      if(!mysqli_query($connect,$sql)){
         $msg = '<div class="alert alert-danger">Could not send message! An insertion query error has occured</div>';
          // exit();
      }else{
        //Send reciver mail alert 
        $msg = '<div class="alert alert-success">Message sent successfully</div>';
          // exit();
      } // Close else block after the sql DB insert check
    } //Close if empty {
  }// Close if POST Messages {



?>