<?php
session_start();
error_reporting(0);
include('../include/dbconnection.php');

if(isset($_POST['login']))
  {
    $userName=$_POST['username'];
    $userPass=md5($_POST['password']);
    $qAdmin=mysqli_query($dbcon,"SELECT ID FROM tbladmin WHERE  UserName='$userName' && password='$userPass' ");

    $result=mysqli_fetch_array($qAdmin);
    if($result > 0){
      $_SESSION['artID']=$result['ID'];
      echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
    } else{
    echo "<script>alert('Invalid Details');</script>";
    }
  }
  ?>
  
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login| Gallery Management </title>
        <!-- Custom styles -->
        <link href="css/style.css" rel="stylesheet">
        <link href="css/style-responsive.css" rel="stylesheet" />
    </head>
<body class="login-img3-body">
    <div class="container">
        <form class="login-form" action="" method="post">
        
            <div class="login-wrap">
            <p class="login-img"><i class="icon_lock_alt"></i></p>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_profile"></i></span>
                <input type="text" class="form-control" name="username" placeholder="Username" autofocus required="true">
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input type="password" class="form-control" name="password" placeholder="Password" required="true">
            </div>                
                <lable><span class="pull-right"> <a href="forgotPassword.php"> Forgot Password?</a></span></label>
                <button class="btn btn-primary btn-lg btn-block" type="submit" name="login">Login</button>
                <p style="margin-top:3%; font-weight:bold"><a href="../index.php" >Back to Home page</a></p>
            </div>
        </form>   
    </div>
</body>
</html>
