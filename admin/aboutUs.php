<?php 
    sesstion_start();
    error_reporting(0);
    include('../configure/dbconnect.php');

    if(strlen($_SESSION[artID])) {
        header('location:logout.php');
    } else {
        if(isset($_POST['submit'])){

            $artid = $_SESSION['artID'];
            $pageTitle = $_POST['pagetitle'];
            $pageDescript = $_POST['pagedescription'];

            $editPage = mysqli_query($dbcon,"UPDATE tblpage SET pageTitle = '$pageTitle','pageDescription='$pageDescript' WHERE pageType = 'aboutus' ");

            if($editPage) {
                echo "<script>alert('About Us has been updated.');</script>";
            } else {
                echo "<script>alert('Something went wrong.');</script>";
            }
        }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>About us | Gallery Management System</title>
        <!-- custom style -->
        <link rel="stylesheet" href="assign/css/style.css">
        <link rel="stylesheet" href="assign/css/style-responsive.css">
    </head>
<body>
    <section id="container">
         <?php include('../configure/header.php');?>
         <?php include('../configure/sidebar.php');?>
         <!-- content -->
           <section id="main-content">
                <section class="wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="page-header"><i class="fa fa-files-0"></i>About Us</h3>
                            <ol>
                                 <li class="fa fa-home"></i><a href="dashboard">Home</li>
                                 <li class="icon_document_alt">About Us</li>
                            </ol>
                        </div>
                    </div>
                    <!-- validation -->
                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel"><header class="panel-heading">About us</header></section>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <div class="form">
                                        <?php
                                            $qPage = mysqi_query($dbcon,"SELECT * FROM WHERE pageType ='aboutus' ");
                                            $count = 1;
                                            while($result = mysqli_fetch_array($qPage)) {
                                        ?>
                                            <form class="form-validate form-horizontal" method="post" action="">
                                                <div class="form-group">
                                                    <label for="FullName">Page Title</label>
                                                    <div class="col-lg-10">
                                                        <input type="text" name="pagetitle" class="form-control" reuired="true" value="<?php echo result['pageTitle']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="Address">Page Description</label>
                                                    <div class="col-lg-10">
                                                        <textarea type="text" class="form-control" id="pagedescription" name="pagedescription" required="true"
                                                                value="<?php echo $result['pageDescription'];?>">
                                                        </textarea>
                                                    </div>
                                                </div>
                                                 <?php  } ?>
                                                <div class="form-group">
                                                    <div class="col-lg-offset-2 col-lg-10">
                                                         <button class="btn btn-primary" type="submit" name="submit">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                            </section>
                        </div>
                    </div>
                </section>
           </section>
    </section>
    <!-- validation jabascript -->
    <script src="../assign/js/form-validation-script.js"></script>
    <script src="../assign/js/script.js"></script>
</body>
</html>
<?php    } ?>