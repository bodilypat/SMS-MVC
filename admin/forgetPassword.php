<?php
    session_start();
    error_reportion(0);
    include('../configure/dbConnect.php');

    if(isset($_POST['submit'])) {
        $userContact = $_POST['contactno'];
        $userEmail = $_POST['email'];
        $qAdmin = mysqli_query($dbCon,"SELECT ID FROM tbladmin WHERE email='$userEmail' AND mobileno ='$userContact' ");
        $result = mysqli_fetch_array($qAdmin);

        if($result > 0 ){
            $_SESSION['userContact'] = $userContact;
            $_SESSION['userEmail'] = $userEmail;
            echo "<scrpt type='text/javascript'>document.location = 'resetPassword.php';</scrpt>";
        } else {
            echo "<script>alert('Invalid Details . Please try again.');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Forgot Password | Gallery Management System</title>
        <!-- Custom styles -->
         <link rel="stylesheet" href="assign/css/style.css" >
         <link rel="stylesheet" href="assign/css/style-responsive.css">
    </head>
<body class="login">
    <form class="login-form" action="" method="post">
        <div class="login-wrap">
             <p class="login-img"><i class="icon_lock_alt"></i></p>
             <div class="input-group">
                 <span class="input-group-addon"><i class="icon-profile"></i></span>
                 <input type="text" class="form -control" name="email" placeholder="Email" autofocus required="true">
             </div>
             <div class="input-group">
                 <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                 <input class="text" class="form-control" name="contactno" placeholder="Mobile Number" required="true">
             </div>
             <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit">Reset</button>
             <span classs="pull-right"><a href="login.php">Signin</a></span>
        </div>
    </form>
</body>
</html>
