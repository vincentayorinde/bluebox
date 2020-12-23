<?php
// session_start();
require_once '../db/config.php';
include("../db/auth.php");

echo $messageid = preg_replace('#[^0-9]#i', '', $_POST['messageid']);
echo $ownerid = preg_replace('#[^0-9]#i', '', $_POST['ownerid']);

// $my_id = $id_array[1];
 if($ownerid != $my_id){
  mysqli_query($connect, "UPDATE private_messages SET opened = '1' WHERE id = '$messageid' AND to_id = '$ownerid' LIMIT 1");
 }

?>