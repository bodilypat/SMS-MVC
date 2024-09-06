<?php
    sesson_start();
    error_reporting(0);
    include('../configure/dbConnect.php');
    
    if(isset($_POST['submit'])) {
        $userContact = $_SESSION['mobileno'];
        $userEmail = $_POST['email'];
        $userPass = md5($_POST['newPassword']);

        $editAd = mysqli__query($dbcon,"UPDATE tbladmin SET password='$userPass' WHERE email='$userEmail' && mobileno = '$userContact' ");
        if($editAd){
            echo "<script>alert('Password successfully chnaged');</script>";
            session_destroy();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Reset Password | Gallery Management System</title>
        <!-- custom style -->
        <link rel="stylesheet" href="assign/css/style.css" >
        <link rel="stylesheet" href="assign/css/style-reponsive.css" >
        <script type="text/javascript">
            function checkPass(){
                if(document.changpwd.newPassword.value != document.changpwd.confirmPassword.value){
                    alert('New Password and Confirm Password field does not match');
                    document.changpwd.confirmPassword.focus();
                    return.false;
                }
                return true;
            }
        </script>
    </head>
<body class="login">
    <div class="container">
         <form class="login-form" action="" method="post" name="changpwd" onSubmit="return checkPass();">
            <div class="login-wrap">
                 <div class="input-group"></div>
                 <div class="input-group"></div>
            </div>
            <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit">Reset</button>
            <span class="pull-right"><a href="login.php">Signin</a></span>
         </form>
    </div>
</body>
<html>
