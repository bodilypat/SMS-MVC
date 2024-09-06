<?php
    session_start();
    error_reporting(0);
    include('../configure/dbconnect.php');
    if(strlen($_SESSION['artid'])) {
        header('location:logout.php');
    } else {
        if(isset($_POST['submit'])) {
            $artType = $_POST['arttype'];
            $editID = $_GET['editid'];
            $editAtt = mysqli_query($dbcon,"UPDATE tblarttype SET artType = '$artType' WHERE ID='$editID' ");
            if($editAtt) {
                echo "<script>alert('Art type been updated.');</script>";
            } else {
                echo "<script>alert('Something wet Wrong. Please try again.'0;</script>";
            }
        }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Update Arttype | Gallery Management System</title>
        <!-- custom style -->
        <link rel="stylesheet" href="../assign/css/style.css">
        <link rel="stylesheet" href="../assign/css/style-responsive.css">
    </head>
<body>
    <section id="container">
        <?php include_once('../configure/header.php');?>
        <?php include_once('../configure/sidebar.php');?>
        <section id="main-content">
            <section class="wrapper">
                <div class="row">
                    <div class="col-lg-12">
                         <h3 lass="page-header"><i class="fa-fa-file-text-o"></i>Update Arttype</h3>
                         <ol class="breadcrumb">
                              <li><i class="fa fa-home"><a href="dasboard.php">Home</a></li>
                              <li><i class="icon_document_alt"></i>Update Arttype</li>
                              <li><i class="fa fa-file-text-o"></i>Update Arttype detail</li>
                         </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">Update Arttype Detail</header>
                            <div class="panel-body">
                                <form class="form-horizontal" method="post" action="">
                            <?php
                                $editID = $_GET['editid'];
                                $qAtt = mysqli_query($dbcon,"SELECT * FROM tblarttype WHERE ID='$editID' ");
                                $count = 1;
                                while($result = mysqli_fetch_array($qAtt)) {
                            ?>
                                    <div class="forom-grou">
                                        <label class="col-sm-2" for="ArtType">Art Type</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="arttype" name="arttype" required="true" 
                                                   value="<?php echo $result['artType'];?>">
                                        </div>
                                    </div>
                         <?php  } ?>
                                    <p stype="text-align: center;"><button type="submit" name="submit" class="btn btn-primary">Update<//button></p>
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
    <!-- javascript -->
    <script src="../assign/js/form-component.js"></script>
    <script src="../assign/js/scripts.js"></script>
</body>
</html>
<?php  } ?>
