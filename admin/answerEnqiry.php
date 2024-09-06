<?php
    session_start();
    error_reporting(0);
    include('../configure/dbConnect.php');
    if(strlen($_SESSION['artid'])) {
        header('location: logout.php');
    } else {
?>

<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title>Answer Enquiry | Galelry Management System</title>
        <!-- custom style -->
        <link href="../assign/css/style.css" rel="stylesheet">
        <link href="../assign/css/style-responsive.css" rel="stylesheet">
    </head>
<body>
    <section id="container">
        <?php include_once('../configure/header.php');?>
        <?php include_once('../configure/sidebar.php');?>
        <!-- main content -->
         <section id="main-content" >
              <section class="wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="page-header"><i class="fa fa-table"></i>Answer Enquiry</h3>
                            <ol>
                                 <li><i class="fa fa-table"></i>Home</li>
                                 <li><i class="fa fa-table"></i>Enquiry</li>
                                 <li><i class="fa fa-th-list"></i>Answer Enquiry</li>
                            </ol>
                        </div>
                    </div>
                    <!-- content -->
                    <div class="row">
                        <div class="col-sm-12">
                            <section class="panel">
                                <header class="panel-heading">Answer Enquiry</header>
                                <table class="table">
                                     <thead>
                                        <tr>
                                            <th>Q.NO</th>
                                            <th>Full Name</th>
                                            <th>Contact Number</th>
                                            <th>Enquiry Date</th>
                                            <th>Actiion</th>
                                        </tr>
                                     </thead>
                                <?php
                                    $qEnq = mysqli_query($dbcon,"SELECT * FROM tblenquiry WHERE status='answer' ");
                                    $count = $count+1;
                                    while($result = mysqli_fetch_array($qEnq)) {
                                ?>
                                     <tbody>
                                        <tr>
                                            <td><?php echo $count;?></td>
                                            <td><?php echo $result['enquiryNumber'];?></td>
                                            <td><?php echo $result['fullName'];?></td>
                                            <td><?php echo $result['contactNumber'];?></td>
                                            <td><a href="seeEnquiry.php?seeid=<?php echo $result['ID'];?>" class="btn  btn-success">Display Details</a></td>
                                        </tr>
                                     </tbody>
                                <?php $count = $count+1; } ?>
                                </table>
                            </section>
                        </div>
                    </div>
              </section>
         </section>
        <!-- FOOTER -->
    </section>
    <!-- custom javascript -->
    <script src="../assign/js/script.js"></script>
</body>
</html>
<?php
    }
?>