<?php 
error_reporting(0);
session_start();
$GLOBALS['no'];
require_once 'db/config.php';
    if(isset($_SESSION['is_logged_in']) != true){
            header("Location: sign-in");
    }
     if(isset($_SESSION['user_data']['user_role']) == "agent" || $_SESSION['user_data']['user_role'] == "adminxz"){
        $email      =  $_SESSION['email'];
        $first_name =  $_SESSION['user_data']['first_name'];
        $last_name  =  $_SESSION['user_data']['last_name'];
        $user_id    =  $_SESSION['user_data']['id'];
    }
          if ($_GET['sg_id']){
                  $sg_id = $_GET['sg_id'];
                  $sg_no = $_GET['sg_no'];

                  $sql__ = "SELECT * FROM signage_payment WHERE signage_acct_no = '$sg_no' AND id= '$sg_id'";
                  $result__ = $connect->query($sql__);
                  $data__ = $result__->fetch_assoc();
    }
      if (isset($_POST['remove'])){
                    $sqlnew = "UPDATE signage_payment SET activ='N' WHERE id='$sg_id'";
                      $resultnew = $connect->query($sqlnew);
                      if($resultnew){
                        header("location:signage-payment-list");
                      }
                    }
    ?>
<!DOCTYPE html>
<html>
<head>
	<title>DELETE DATA - <?php echo $name; ?></title>
</head>

<style>


	.button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 10px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 12px;
}
	.button-back {
    background-color: red; /* Green */
    border: none;
    color: white;
     padding: 10px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 12px;
}
	
	body{
		background-color: blue;
		margin: 0;
		padding: 0;
	}
	#wrapper{
		margin: auto;
		width:620px;
		font-family: sans-serif;
		font-size: 14px;
		background-color: white;
		padding: 15px;
	}
	.space{
		height: 50px;
	}
	#bill{
		margin-top: 2px;
		border: 1px solid blue;
		border-radius: 5px;
	}
	#bop{
		margin: 0px;
		color: red;
	}
</style>
<body>
    	<div id="wrapper">
        <p> Are you sure you want to permanetly delete payment of <strong><?php echo $data__['paid'] ?></strong> for the ID <strong><?php echo $data__['signage_acct_no']; ?></strong> </p>
    	<form action="" method="post">
        <a  href="#" onclick="location.href = document.referrer; return false;" id="button-back" class="button-back">No, take me back</a>

  <button class="button" type="submit" id="remove" name="remove" value="remove">Yes, delete it</button>
</form>
        <p>NOTE: Data deleted is permanent</p>

    </div>
</body>
</html>