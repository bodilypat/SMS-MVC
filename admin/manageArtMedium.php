<?php
    session_start();
    error_reporting(0);
    include('../configure/dbConnect.php');
    if(strlen($_SESSION['artid'])){
        header('location:logout.php');
    } else {
        if(isset($_GET['delid'])) {
            $delID = intval($_GET['delid']);
            $delAtm = mysqli_query($dbcon,"DELETE FROM tblartmedium WHERE ID='$delid' ");
            echo "<script>alert('Data deleted');</script>";
            echo "<script>window.location.href='manageArtMedium.php'</script>";
        }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Manage ArtMedium | Gallery Management System</title>
        <!-- custom styles -->
        <link href="../assign/css/style.css" ref="stylesheet">
        <link href="../assign/css/style-responsive.css" rel="stylesheet">
    </head>
<body>
    <section id="container">
        <?php include_once('../configure/header.php');?>
        <?php include_once('../configure/sidebar.php');?>
        <section class="main-content">
            <section class="wrapper">
                <!-- header page -->
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="fa fa-table"></i>Manage Art Medium</h3>
                        <ol>
                             <li><i class="fa fa-home"></i><a href="dashboard.php">Home</a></li>
                             <li><i class="fa fa-table"></i>Art Medium</li>
                             <li><i class="fa fa-th-list"></i>Art Mediium Details</li>
                        </ol>
                    </div>
                </div>
                <!-- body page -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel">
                            <header class="panel-heading">Manage Art Medium</header>
                            <table class="table">
                                <thead>
                                    <tr>
                                         <th>S.NO</th>
                                         <th>Medium of Art</th>
                                         <th>Creation Date</th>
                                         <th>Action</th>
                                    </tr>
                                </thead>
                                <?php 
                                    $qAtm = mysqli_query($dbcon,"SELECT * FROM tblartmedium");
                                    $count = 1;
                                    while($result=mysqli_fetch_array($qAtm)) {
                                ?>
                                    <tr>
                                         <td><?php echo $count; ?></td>
                                         <td><?php echo $result['artMedium'];?></td>
                                         <td><?php echo $result['creationDate'];?></td>
                                         <td><a href="editAtrMedium.php=<?php echo $result['ID'];?>" class="btn btn-success">Edit</a> || 
                                             <a href="manageArtMedium.php=<?php echo $result['ID'];?>" class="btn btn-danger">Delete</a>
                                         </td>
                                    </tr>
                                <?php $count=$count+1 ; } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </section>
        <!-- FOOTER -->
        <?php include_once('../configure/footer.php');?>
    </section>
    <!-- custom javascript -->
    <script src="../assign/js/scripts.js"></script>
</body>
</html>
<?php   } ?>
