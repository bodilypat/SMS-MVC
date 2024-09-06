<?php
    session_start();
    error_reporting(0);
    include('../configure/dbconnect.php');
    if(strlen($_SESSION['artid']==0)) {
        header('location: logout.php');
    } else {
        if(isset($_POST['submit'])){
            $adID = $_SESSION['artid'];
            $userName = $_POST['username']
            $mobileNum = $_POST['contactnumber']

            $editAdmin = mysqli_query($dbcon,"UPDATE tbladmin SET adminName = '$userName', mobileNumber='$mobileNum' WHERE id = '$adID' ");
            if($editAdmin){
                echo "<script>alert('Admin profile has been updated.');</script>";
                echo "<script>window.location.href='adminProfile.php'</script>";
            } else {
                echo "<script>alert('something Went Wrong. Please try again.');</script>";
            } 
        }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title lang="en">Admin-Profile | Gallery Management System</title>
        <!-- custom styles -->
        <link rel="stylesheet" href="../assign/css/styles.css">
        <link rel="stylesheet" href="../assign/css/style-responsive.css" >
    </head>
<body lang="en">
    <section id="container" >
        <?php include_once('../configure/header.php');?>
        <?php include_once('../configure/sidebar.php');?>
        <section id="main-content">
            <section class="wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="fa fa-user-md"></i>Profile</h3>
                        <ol class="breadcrumb">
                             <li><i class="fa fa-home"></i><a href="dashboard.php">Home</li>
                             <li><i class="icon_documents_alt"></i>Page</li>
                             <li><i class="fa fa-user-md"></i>Profile</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div col="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                <ul class="nav nav-tabs">
                                    <li class=""><a data-toggle="tab" href="#edit-profile"><i class="icon-envelop"></i>Edit Profile</a></li>
                                </ul>
                            </header>
                            <div class="panel-body">
                                <div>
                                    <div id="editProfile" class="tab-pane">
                                        <section class="panel">
                                            <div class="panel-body">
                                                <h1>Profile Info</h1>
                                                <form class="form-horizontal" role="form" method="post" action="">
                                                    <?php
                                                        $adID = $_SESSION['artid'];
                                                        $qAdmin = mysqli_query($dbcon,"SELECT * FROM tbladmin WHERE ID = '$adID' ");
                                                        $count = 1;
                                                        while($result = mysqli_fetch_array($qAdmin)) {
                                                    ?>
                                                    <div class="form-group">
                                                        <label class="col-lg-2" for="AdminName">Admin Name</label>
                                                        <div class="col-lg-6">
                                                            <input type="text" class="form-control" id="adminname" name="adminname" value="<?php echo $result['adminName'];?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-2" for="UserName">User Name</label>
                                                        <div class="col-lg-6">
                                                            <input type="text" class="form-control" id="username" name="username" value="<?php echo $result['userName'];?>" readonly="ture">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-2" for="ContactNumber">Contact Number</label>
                                                        <div class="col-lg-6">
                                                             <input type="text" class="form-control" id="contactnumber" name="contactnumber" value="<?php echo $result['contactnumber'];?>" required="true">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-2" for="Email">Email</label>
                                                        <div class="col-lg-6">
                                                             <input type="text"  class="form-control" id="email" name="email" value="<?php echo $result['email'];?>" required="true" readonly="true">
                                                        </div>
                                                    </div>
                                                    <?php  } ?>
                                                    <div class="form-group">
                                                        <div class="col-lg-offset-2 col-lg-10">
                                                            <button type="submit" class="btn btn-primary" name="submit">Update</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </section>
        <!-- FOOTER -->
        <?php include_once('../configure/footer.php');?>
    </section>
    <!-- custom javascript -->
    <script src="../assign/js/scripts.js"></script>
    <script>
        $(".knob").knob();
    </script>
</body>
</html>
<?php } ?>