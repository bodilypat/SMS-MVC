<?php
    session_start();
    error_reporting(0);
    include('../configure/dbConnect.php');
    if(strlen($_SESSION[artid])) {
        header('location:logout.php');
    } else {
        if(isset($_GET['delid'])) {
            $delID = intval($_GET['delid']);
            $dBuyer = mysqli_query($dbcon,"DELETE FROM buyers WHERE id='$delID' ");
            echo "<script>alert('Data deleted');</script>";
            echo "<script>window.location.href='manageArtist.php'</script>";
        }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Manage Art Gallery | Art Gallery Management</title>
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
                        <h3 class="page-header"><i class="fa fa-table"></i>Manage Buyers</h3>
                        <ol>
                            <li><i class="fa fa-home"><a href="dashboard.php">Home</li>
                            <li><i class="fa fa-table"></i>Buyers</li>
                            <li><i class="fa fa-th-list"></i>Manage Buyers</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <section class="panel">
                            <header class="panel-heading">Manage Buyers</header>
                            <table class="table">
                                <thead>
                                    <tr>
                                         <th>Name</th>
                                         <th>Email</th>
                                         <th>Phone</th>
                                         <th>Address</th>
                                         <th>Actions</th>
                                    </tr>
                                </thead>
                                <?php
                                    $qAts = mysqli_query($dbcon,"SELECT * FROM buyers");
                                    $count = 1;
                                    while($result=mysqli_fetch_array($qAts))
                                    {
                                ?>
                                    <tr>
                                         <td><?php echo $count;?></td>
                                         <td><?php echo $result['name'];?></td>
                                         <td><?php echo $result['email'];?></td>
                                         <td><?php echo $result['phone'];?></td>
                                         <td><?php echo $result['address'];?></td>
                                         <td><a href="edit_buyer.php?editid=<?php echo $result['id'];?>" class="btn btn-success">Edit</a> || 
                                             <a href="manage_buyer.php?delid=<?php echo $result['id'];?>" class="btn btn-danger">Delete</a>
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
