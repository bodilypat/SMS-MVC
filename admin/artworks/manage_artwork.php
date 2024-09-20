<?php
    session_start();
    error_reporting(0);
    include('../configure/dbConnect.php');
    if(strlen($_SESSION['artid'])){
        header('location:logout.php');
    } else {
        if(isset($_GET['delud'])){
            $delID = intval($_GET['delid']);
            $qAtp = mysqli_query($dbcon,"DELETE FROM tblartproduct where ID='$delID' ");
            echo "<script>alert('Data deleteted');</script>";
            echo "<script>window.location.href='manageArtproduct.php'</script>";
        }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Manage Art Product | Gallery Mangement System</title>
        <!-- custom style -->
        <link rel="stylesheet" href="../assign/css/style.css">
        <link rel="stylesheet" href="../assign/css/style.css">
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
                        <!-- header page -->
                            <h3 class="page-header"><i class="fa fa-table"></i>Manage Art Product</h3>
                            <ol class="breadcrumb">
                                 <li><i class="fa fa-home"></i><a href="dashboard.php">Home</li>
                                 <li><i class="fa fa-table"></i> Art Product</li>
                                 <li><i class="fa fa-th-list"></i>Art Product Details</li>
                            </ol>
                       </div>
                  </div>
                  <!-- body page -->
                  <div class="row">
                       <div class="col-sm-12">
                            <section class="panel">
                                <header class="panel-header">Manage Art Product</header>
                                <table class="table">
                                    <thead>
                                        <tr>
                                           <th>S.NO</th>
                                           <th>Reference Number</th>
                                           <th>Title</th>
                                           <th>Image</th>
                                           <th>Creation Date</th>
                                           <th>Action</th>
                                        </tr>
                                    </thead>      
                                <?php
                                    $qAtp = mysqli_query($dbcon,"SELECT * FROM tblartproduct");
                                    $count = 1;
                                    while($result=mysqli_fetch_array($qAtp)){
                                ?>
                                        <tr>
                                            <td><?php echo $count;?></td>
                                            <td><?php echo $result['refNum'];?></td>
                                            <td><?php echo $result['artTitle'];?></td>
                                            <td><?php echo $result['artImage'];?></td>
                                            <td><?php echo $result['creationDate';?></td>
                                            <td><a href="editArtProduct.php?editid=<?php echo $result'ID'];?>" class="btn btn-success">Edit</a> || 
                                                <a href="ManageArtProduct.php?delid=<?php echo $result['ID'];?>" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>                                        
                                        <?php $count = $count +1; } ?>
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
    <script src="../assign/js/scripts.js"></script>
</body>
</html>
<?php  } ?>