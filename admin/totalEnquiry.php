<?php
    session_start();
    error_reporting(0);
    include('../configure/dbconnect.php');
    if(strlen('artid')){
        header('location:logout.php')
    } else {
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Unanswer Enquiry | Gallery Management system</title>
        <!-- custom styles -->
        <link href="../define/css/style.css" rel="stylesheet">
        <link href="../define/css/style-responsive.css" rel="stylesheet">
    </head>
<body>
    <section id="container">
        <?php include_once('../define/header.php');?>
        <?php include_once('../define/sidebar.php');?>
        <section id="main-content">
            <section class="wrapper">
                <div class="row">
                    <div class="wrapper">
                        <h3 class="page-header"><i class="fa fa-table"></i>Total Received Enquiry</h3>
                        <ol>
                            <li><i class="fa fa-home"></i><a href="dashboard.php"></i>Home</li>
                            <li><i class="fa fa-table"></i>Enquiry</li>
                            <li><i class="fa fa-th-list"></i>Total Received Enquiry</li>
                        </ol>
                    </div>
                </div>
                <!-- content -->
                <div class="row">
                    <div class="col-sm-12">
                         <section class="panel">
                             <header class="panel-heading">Total Received Enquiry</header>
                             <table class="table">
                                  <thead>
                                       <tr>
                                            <th>Q.NO</th>
                                            <th>Enquiry Number</th>
                                            <th>Full Name</th>
                                            <th>Contact Number</th>
                                            <th>Action</th>
                                       </tr>
                                  </thead>
                            <?php
                                $qEnq = mysqli_query($dbcon,"SELECT * FROM tblenquiry");
                                $count = 1;
                                while($ressult=mysqli_fetch_array($qEnq)) {
                            ?>
                                <tbody>
                                       <tr>
                                            <td><?php echo $count;?></td>
                                            <td><?php echo $result['enquiryNumber'];?></td>
                                            <td><?php echo $result['fullName'];?></td>
                                            <td><?php echo $result['contactNumber'];?></td>
                                            <td><a href="seeEnquiry.php?seeid=<?php echo $result['ID'];?>">Display Details</td>
                                       </tr>
                                </tbody>
                            <?php $count=$count+1; } ?>
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
<?php    } ?>