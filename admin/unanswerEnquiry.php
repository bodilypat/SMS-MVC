<?php
    session_start();
    error_reporting(0);
    include('../configuree/dbConnect.php');
    if(strlen($_SESSION['artid']==0)) {
        header('location:logout.php');
    }else {
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Unanswer Enquiry | Gallery Management System</title>
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
                        <h3 class="page-header"><i class="fa fa-table"></i>Unanswer Enquiry</h3>
                        <ol>
                            <li><i class="fa fa-home"></i><a href="dashboard.php"></li>
                            <li><i class="fa fa-table"></i>Enquiry</li>
                            <li><i class="fa fa-list"></i>Uanswer Enquiry</li>
                        </ol>
                    </div>
                </div>
                <!-- content -->
                <div class="row">
                    <div class="col-sm-12">
                         <section class="panel">
                              <header class="panel-heading">Unanswer Enquiry</header>
                              <table class="table">
                                   <thead>
                                        <tr>
                                             <th>Q.NO</th>
                                             <th>Full Name</th>
                                             <th>Contact Number</th>
                                             <th>Enquiry Date</th>
                                             <th>Action</th>
                                        </tr>
                                   </thead>
                                   <?php
                                        $qEnq=mysqli_query($dbcon,"SELECT * FROM tblenquiry WHERE (status='' || status is null");
                                        $count = 1;
                                        while($result=mysqli_fetch_array($qEnq)) {
                                    ?>
                                        <tr>
                                             <td><?php echo $result['enquiryNumber'];?></td>
                                             <td><?php echo $result['fullNamee'];?></td>
                                             <td><?php echo $result['contactNumber'];?></td>
                                             <td><?php echo $result['enquiryDate'];?></td>
                                             <td><a href="seeEnquiry.php?=seeid=<?php echo $result['ID'];?>" class="btn btn-success">Display Details</a></td>
                                        </tr>
                                    <?php
                                        $count = $count+1;
                                        }
                                    ?>
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