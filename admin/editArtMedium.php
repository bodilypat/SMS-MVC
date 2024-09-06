<?php
    session_start();
    error_reporting(0);
    include('../configure/dbConnect.php');
    if(strlen($_SESSION['artid']==0)) {
        header("location:logout.php");
    } else {
        if(isset($_POST['submit'])) {
            $artMed = $_POST['artmed'];
            $editID = $_GET['editid'];

            $editAtm = mysqli_query($dbcon,"UPDATE tblartmedium set artmedium = $artMed' WHERE ID = '$editID' ");
            if($editAtm) {
                echo "<script>alert('Art medium has been updated.');</script>";
            } else {
                echo "<script>alert('Something Went Wrong. Please try again.');</script>";
            }
        }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Update Art Medium | Gallery Management System</title>
        <!-- custom styles -->
        <link rel="stylesheet" href="../assign/css/style.css" />
        <link rel="stylesheet" href="../assign/css/style-responsive.css">
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
                          <h3 class="page-header"><i class="fa fa-file-text-o"></i>Update Art Medium</h3>
                          <ol class="breadcrumb">
                               <li><i class="fa fa-home"></i><a href="dashboard.php">Home</li>
                               <li><i class="icon_document_alt"></i>Update Art Medium</li>
                               <li><i class="fa fa-file-text-o"></i>Update Art Medium</li>
                          </ol>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col-lg-12">
                         <section class="panel">
                              <header class="panel-heading">Uppdate Art Medium</header>
                              <div class="panel-body">
                                    <form class="form-horizonal" method="post" action="">
                                        <?php
                                            $editID = $_GET['editid'];
                                            $qAtm = mysqli_qeury($dbcon,"SELECT * FROM tblartmedium WHERE ID = '$editID' ");
                                            $count = 1;
                                            while($result=mysqli_fetch_array($qAtm)) {
                                        ?>
                                            <div class="form-group">
                                                <label class="col-sm-2" for="ArtMedium" ></label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="artmedium" name="artmedium" required="true" value="<?php echo $result['artMedium'];?>">
                                                </div>
                                            </div>
                                        <?php  } ?>
                                        <p style="text-align: center;"><button type="text" name="submit" class="btn btn-primary">Update</button></p>
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
    <!-- custom style -->
    <script src="../assign/js/form-component.js"></script>
    <script src="../assign/js/script.js"></script>
</body>
</html>
    }