<?php
    session_start();
    error_report(0);
    include('../configure/dbConnect.php');
    if(strlen($_SESSION['artid'])) {
        header('location:logout.php');
    } else {
        if(isset($_POST['submit'])) {
            $fullName = $_POST['fullname'];
            $contactNum = $_POST['contactnumber'];
            $email = $_POST['email'];
            $award = $_POST['award'];
            $editID = $_GET['editid'];

            $editAts = mysqli_query($dbcon,"UPDATE tblartist 
                                            SET artName='$fullname', contactnumber ='$contactNum', email='$email', award='$award' 
                                            WHERE ID = '$editID' " );
            if($editAts) {
                "<script>alert('Artist details has been update.');</script>";
            } else {
                echo "<script>alert('Something Went Wrong. Please try again.');</script>";
            }
        }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Update Artist | Gallery Management System</title>
        <!-- custom styles -->
        <link rel="stylesheet" href="../assign/css/style.css" >
        <link rel="stylesheet" href="../assign/css/style-ressponsive.css" rel="stylesheet" />
    </head>
<body>
    <section id="container" >
        <?php include_once('../configure/header.php');?>
        <?php include_once('../configure/sidebar.php');?>
        <!-- main content -->
        <section id="main-content">
            <section class="wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="fa fa-file-text-o"></i>Update Artis </h3>
                        <ol class="breadcrumb">
                             <li><i class="fa fa-home"></i><a href="dashboard.php">Home</li>
                             <li><i ckass="icon-document_alt"></i>Artist</li>                             
                             <li><i class="fa fa-file-text-0"></i>Artist Detail</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panal">
                            <header class="panel-headling">Update Details</header>
                            <div class="panel-body">
                                <form class="form-horizontal" method="post" action="">
                                    <p style="font-size;16px; color:red" align="left"><?php if($msg){ echo $msg; } ?>
                                    <?php
                                        $editID = $_GET['editid'];
                                        $qAts = mysqli_query($dbcon,"SELECT * tblartist WHERE ID='$editID' ");
                                        $count = 1;
                                        while($result=mysqli_fetch_array($qAts)) {
                                    ?>
                                    <div class="form-group">
                                        <label class="col-sm-2" for="FullName">Name<label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="fullname" name="fullname" required="true" 
                                                   value="<?php echo $result['artName'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2" for="MobileNumber">Phone Number</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="mobileNumber" name="mobileNumber" maxlength="10" required="true"
                                                   pattern="[0-9]+" value="<?php echo $result['contactNumber'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2" for="Email">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="email" name="email" required="true" 
                                                   value="<?php echo $result['email'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2" for="Award">Award</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="award" id="award" required="true">
                                                <?php $result['award'];?>
                                            </textarea>
                                        </div>
                                    </div>
                                    <dic class="form-group">
                                        <label class="col-sm-2" for="ProfilePic">Profile Picture</label>
                                        <div class="col-sm-10">
                                            <img src="images/<?php echo $result['profilePic'];?>" width="200" heigh="150" 
                                                 value="<?php echo $result['profilepic'];?>">
                                        </div>
                                    </div>
                                <?php } ?>
                                <p style="text-align: center;"><button type="submit" name="submit" class="btn btn-primary">Update</button></p>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </section>
        <!-- FOOTER -->
        <?php include_once('../configure/footer.php'); ?>
    </section>
    <!-- check editor -->
    <script src="../assing/js/ckeditor.php"></script>
    <!-- javascript -->
    <script rel="stylesheet" src="../assign/js/form-component"></script>
    <script rel="stylesheet" src="../assign/js/scripts.js"></script>
</body>
</html>
<?php
    }
?>
