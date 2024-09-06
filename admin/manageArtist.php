<?php
    session_start();
    error_reporting(0);
    include('../configure/dbConnect.php');
    if(strlen($_SESSION[artid])) {
        header('location:logout.php');
    } else {
        if(isset($_GET['delid'])) {
            $delID = intval($_GET['delid']);
            $delAts = mysqli_query($dbcon,"DELETE FROM tblartist WHERE ID='$delID' ");
            echo "<script>alert('Data deleted');</script>";
            echo "<script>window.location.href='manageArtist.php'</script>";
        }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Manage Artist | Gallery Management</title>
        <!-- custom styles -->
        <link rel="stylesheet" href="../assign/css/style.css">
        <link rel="stylesheet" href="../assign/css/style-responsive.php"> 
    </head>
<body>
    <section id="container">
        <?php include_once('../configure/header.php');?>
        <?php include_once('../configure/sidebar.php');?>
        <section>
            <section class="wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="fa fa-table"></i>Manage Artist</h3>
                        <ol>
                            <li><i class="fa fa-home"><a href="dashboard.php">Home</li>
                            <li><i class="fa fa-table"></i>Artist</li>
                            <li><i class="fa fa-th-list"></i>Manage Artist</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <section class="panel">
                            <header class="panel-heading">Manage Artist</header>
                            <table class="table">
                                <thead>
                                    <tr>
                                         <th>S.NO</th>
                                         <th>Name</th>
                                         <th>Email</th>
                                         <th>Mobile Number</th>
                                         <th>Registration Date</th>
                                         <th>Action</th>
                                    </tr>
                                </thead>
                                <?php
                                    $qAts = mysqli_query($dbcon,"SELECT * FROM tblartist");
                                    $count = 1;
                                    while($result=mysqli_fetch_array($qAts))
                                    {
                                ?>
                                    <tr>
                                         <td><?php echo $count;?></td>
                                         <td><?php echo $result['artName'];?></td>
                                         <td><?php echo $result['email'];?></td>
                                         <td><?php echo $result['contactNumber'];?></td>
                                         <td><?php echo $result['creationDate'];?></td>
                                         <td><a href="editArtis.php?editid=<?php echo $result['ID'];?>" class="btn btn-success">Edit</a> || 
                                             <a href="manageArtist.php?delid=<?php echo $result['ID'];?>" class="btn btn-danger">Delete</a>
                                         </td>
                                    </tr>
                                <?php $count=$count+1; } ?>
                            </table>
                        </section>
                    </div>
                </div>
            </section>
        </section>
        <!-- FOOTER -->
    </section>
    <!-- custom javascript -->
    <script src="../assign/js/scripts.js"></script>
</body>
</html>
<?php  } ?>