<?php
    session_start();
    error_reporting(0);
    include('../configure/dbConnect.php');
    if(strlen($_SESSION['artid'])) {
        header('location:logout.php');
    } else {
        if(isset($_GET['delid'])){
            $delID = intval($_GET['delid']);
            $delAtt = mysqli_query($dbcon,"DELETE FROM tblarttype WHERE ID = '$delID' ");
            echo "<script>alert('Data deleted');</script>";
            echo "<script>window.location.href = 'manageArttype.php'</script>";
        }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Manage Arttype | Gallery Management System</title>
        <!-- custom styles -->
        <link rel="stylesheet" href="../assign/css/style.css">
        <link rel="stylesheet" href="../assign/css/style-reponsive.css">
    </head>
<body>
    <section id="container">
        <?php include_once('../configure/heder.php');?>
        <?php include_once('../configure/sidebar.php');?>
        <!-- content -->
        <section id="main-content">
            <section class="wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="fa fa-table"></i>Manage ArtType</h3>
                        <ol class="breadcrumb">
                             <li><i class="fa fa-home"></i><a href="dashboard.php">Home</li>
                             <li><i class="fa fa-table"></i>Manage Arttype</li>
                             <li><i class="fa fa-th-list"></i>Manage Arttype</li>
                        </ol>
                    </div>
                </div>
                <!-- content -->
                <div class="row">
                    <div class="col-sm-12">
                        <section class="panel">
                            <header class="panel-heading">Manage Arttype</header>
                            <table class="table">
                                <thead>
                                    <tr>
                                         <th>S.NO</th>
                                         <th>Type of Art</th>
                                         <th>Creation Date</th>
                                         <th>Action</th>
                                    </tr>
                                </thead>
                                <?php
                                    $qAtt = mysqli_query($dbcon,"SELECT * FROM tblarttype");
                                    $count = 1;
                                    while($result=mysqli_fetch_array($qAtt)){
                                ?>
                                    <tr>
                                        <td><?php echo $count;?></td>
                                        <td><?php echo $result['artType'];?></td>
                                        <td><?php echo $result['creationDate'];?></td>
                                        <td><a href="editArttype.php?editid=<?php echo $result['ID'];?>" class="btn btn-success">Edit</a>||
                                            <a href="manageArttype.php?delid=<?php echo $result['ID'];?>" class="btn btn-danger">Delete</a>
                                        </td>    
                                    </tr>                                    
                            <?php   $count=$count+1; } ?>
                            </table>
                        </section>
                    </div>
                </div>
            </section>
        </section>
        <!-- FOOTER -->
        <?php include_once('../configure/footer.php');?>
    </section>
    <!-- custom javascript -->
    <script src="../assign/js/script.js"></script>
</body>
</html>
<?php } ?>