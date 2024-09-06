<?php
    session_start();
    error_reporting(0);
    include('../configure/dbConnect.php');
    if(strlen($_SESSION['artid'])) {
        header('location:logout.php');
    } else {
        if(isset($_POST['submit'])) {
            $artID = $_SESSION['artid'];
            $pageTitle = $_POST['pagetitle'];
            $pageDes = $_POST['pagedescription']
            $email = $_POST['email'];
            $contactNum = $_POST['contactnumber'];
            $timing = $_POST['timming'];
            $qPage = mysqli_query($dbcon,"UPDATE tblpage SET pageTitle='$pageTitle', 
                                                             pageDescription='$pageDes',
                                                             email='$email', 
                                                             contactNumber='$contactNum', 
                                                             timing='$timing'
                                          WHERE pageType='contactus' ");
            if($qPage) {
                echo "<script>alert('Contact Us has been updated..');</script>";
            } else {
                echo "<script>alert('Something wet wrong.');</script>";
            }
        }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Contact US | Gallery Mangement System</title>
        <!-- custom styles -->
        <link href="../assign/css/style.css" rel="stylesheet">
        <link href="../assign/css/style-reponsive.css" rel="stylesheet" />
    </head>
<body>
    <section id="main-content">
        <?php include_once('../configure/header.php');?>
        <?php include_once('../configure/sidebar.php');?>
        <!-- main content -->
        <section id="main-content">
            <section class="wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="fa fa-files-o"></i>Contact Us</h3>
                        <ol>
                             <li><i class="fa fa-home"></i><a href="dashboard.php">Home</li>
                             <li><i class="icon_document_alt"></i>Content Us</li>
                             <li><i class="fa fa-files-o"></i>Contact Us</li>
                        </ol>
                    </div>
                </div>
                <!-- Form validation -->
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">Contact Us</header>
                        </section>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <div class="panel-body">
                                <div class="form">
                            <?php
                                $qPage = mysqli_query($dbcon,"SELECT * FROM tblpage WHERE pageType = 'contactus' ");
                                $count = 1;
                                while($result=mysqli_fetch_array($qPage)) {
                            ?>
                                <form class="form-validate form-horizontal" method="post" action="">
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="PageTitle">Page Title</label>
                                        <div class="col-lg-10">
                                            <input type="text" name="pagetitle" class="form-control" required="true" 
                                                   value="<?php echo $result['pageTitle'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="FullName">Email</label>
                                        <div class="col-lg-10">
                                            <input type="text" name="email" class="form-control" required="true" 
                                                  value="<?php echo $result['email'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="PhoneNumber" class="control-label col-lg-2">Phonee Number</label>
                                        <div class="col-lg-10">
                                            <input type="text" name="phonenumber" class="form-control" required="true" 
                                                  value="<?php $result['contactNumber'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Timming">Timing</label>
                                        <div class="col-lg-10">
                                            <input type="text" name="timing" class="form-control" required="true" 
                                                  value="<?php echo $result['timing'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="PageDescription" class="control-babel col-lg-2">Page Description</label>
                                        <div class="col-lg-10">
                                            <textarea type="text" class="form-control" id="pagedescription" name="pagedescription" required="true" 
                                                     value=""><?php echo $result['pageDescription'];?></textarea>
                                        </div>
                                    </div>                                    
                                    <?php } ?>
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button class="btn btn-primary" type="submit" name="submit">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </section>
        <!-- FOOTER -->
    </section>
    <!-- custom javascript -->
    <script src="../assign/js/form-validation.js"></script>
    <script src="../assign/js/script/js"></script>
</body>
</html>
<?php
    }
?>