<?php
    session_start();
    error_reporting(0);
    include('../configure/dbconnect.php');
    if(strlen($_SESSION['artid']==0)) {
        header('location:logout.php');
    } else {
        if(isset($_POST['submit'])) {
            $artMed = $_post['artmedium'];
            $addAtm = mysqli_query($dbcon,"INSERT INTO tblartmedium(artMedium) VALUES('$artMed') ");
            if($addAtm) {
                echo "<script>alert('Art medium has been added.');</script>";
                echo "<script>windown.location.href='manageArtMedium.php</script>";
            } else {
                echo "<script>alert('Something Went Wrong. Pleasse try again.');</script>";
            }
        }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Add Art Medium | Gallery Management System</title>
        <!-- custom style -->
         <link rel="stylesheet" href="../assign/css/style.css">
         <link rel="stylesheet" href="../assign/css/style-responsive.css" >
    </head>
<body>
    <section id="container">
        <?php include_once('../configure/header.php');?>
        <?php include_once('../configure/sidebar.php');?>
        <section id="main-content">
            <section class="wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="fa fa-file-text-o"></i>Add Art Medium</h3>
                        <ol class="breadcrum">
                            <li><i class="fa fa-home"><a href="dashboard.php">Home</li>
                            <li><i class="icon_document_alt"></i>Art Medium</li>
                            <li><i class="fa fa-file-text-o">Add Art Mediium</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">Add Art Medium</header>
                            <div class="panel-body">
                                <form class="form-horizonal" method="post" action="" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="col-sm-2" for="ArtMedium">Art Medium</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="artmedium" name="artmedium" class="form-control" required="true">
                                        </div>
                                    </div>
                                    <p style="text-align: center;"><button type="submit" name="submit" class="btn btn-primary">Submit</button></p>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </section>
        <!-- FOOTER -->
        <?php include_once('../configure/footer.php');?>
    </section>
    <!-- check editor -->
     <script type="../assign/js/ckeditor.js"></script>
    <!-- custom javascript -->
    <script src="../assign/js/form-comment.js"></script>
    <script src="../assign/js/script.js"></script>
</body>
</html>
<?php    } ?>