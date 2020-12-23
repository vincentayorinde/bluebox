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
          if ($_GET['pr_id']){
                  $pr_id = $_GET['pr_id'];
                  $pro_acct_no = $_GET['pro_acct_no'];

                  $sql__ = "SELECT * FROM property WHERE pro_acct_no = '$pro_acct_no' AND id= '$pr_id'";
                  $result__ = $connect->query($sql__);
                  $data__ = $result__->fetch_assoc();
    }
      if (isset($_POST['remove'])){
                    $sqlnew = "UPDATE property SET activ='N' WHERE id='$pr_id'";
                      $resultnew = $connect->query($sqlnew);
                      if($resultnew){
                        header("location:all-rates");
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
        <p> Are you sure you want to permanetly delete <strong><?php echo $data__['pro_owner_name'] ?></strong> with the ID <strong><?php echo $data__['pro_acct_no']; ?></strong> </p>
    	<form action="" method="post">
        <a  href="#" onclick="location.href = document.referrer; return false;" id="button-back" class="button-back">No, take me back</a>

  <button class="button" type="submit" id="remove" name="remove" value="remove">Yes, delete it</button>
</form>
        <p>NOTE: Data deleted is permanent</p>

    </div>
</body>
</html>