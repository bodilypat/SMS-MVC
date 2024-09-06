<?php
    session_start();
    error_reporting(0);
    include('../configure/deconnect.php');

    if(strlen($_SESSION['artid']==0)) {
        header('location:logout.php');
    } else {
        if(isset($_POST['submit'])){

            $artType = $_POST['submit'];

            $qAtt = mysqli_query($dbcon,"INSERT INTO tblarttype(artType) values('$arttype') ");
            if($qAtt) {
                echo "<script>alert('Artist type has been added.');</script>";
                echo "<script>window.location.href ='manageArtType.php'</script>";
            } else {
                echo "<script>alert('Something Went Wrong. Please try again.');</script>";
            }
        }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Add ArtType | Gallery Menagement System</title>
        <!-- custom style -->
        <link rel="stylesheet" href="../assign/css/style.css" >
        <link rel="stylesheet" href="../assign/css/style-reponsive.css" >
    </head>
    <section id="container">
        <?php include_once('../configure/header.php'); ?>
        <?php include_once('../configure/sidebar.php'); ?>
        <!-- main content -->
        <section id="main-content">
            <section class="wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="fa fa-file-text-o"></i>Add Art Type</h3>
                        <ol class="breadcrumb">
                             <li><i class="fa fa-home"></i><a href="dashboard.php">Home</a></li>
                             <li><i class="icon_document_alt">Art Type</li>
                             <li><i class="fa fa-file-text-0"></i>Add Art Type</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <section class="panel">
                            <header class="panel-heading">Add Art Type</header>
                            <div class="panel-body">
                                <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Art Type</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="arttype" name="arttype" required="ture">
                                        </div>
                                    </div>
                                    <p style="text-align:center;"><button type="submit" name="submit" class="btn btn-primary">Submit</button></p> 
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
    <!-- custom javascript -->
    <script src="../assign/js/form-component.php"></script>
    <script src="../assign/js/scripts.js"></script>
</html>
<?php   } ?>
