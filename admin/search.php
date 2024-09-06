<?php
    session_start();
    error_reporting(0);
    include('../configure/dbConnect.php');
    if(strlen($_SESSION['artid']==0)) {
        header('location:logout.php');
    } else {
?>

<!DOCTYPE html>
<html lang="en"> 
    <head>
        <title>Search Enquiry | Gallery Management System</title>
        <!-- custom styles -->
        <link rel="stylesheet" href="../assign/css/style.css">
        <link rel="stylesheet" href="../assign/css/style-responsive.css">
    </head>
<body>

</body>
    <section id="container">
        <?php include_once('../configure/header.php');?>
        <?php include_once('../configure/sidebar.php');?>
        <!-- content  -->
        <section class="main-content">
            <section class="wrapper">
                <!-- header page -->
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="fa fa-table"></i>Search Enquiry</h3>
                        <ol class="breadcrumb">
                             <li><i class="fa fa-home"></i><a href="dashboard.php"></a></li>
                             <li><i class="fa fa-table"></i>Enquiry</li>
                             <li><i class="fa fa-th-this"></i>Search Enquiry</li>
                        </ol>
                    </div>
                </div>
                <!-- content page -->
                <div class="row">
                    <div class="col-sm-12">
                        <section class="panel">
                            <header class="panel-heading">Search Enquiry</header>
                            <form class="form-horizontal" name="search" method="post" action="" enctype="multipart/form-data">
                                <div class="form-group"></div>
                                <p style="text-align: center;"><button type="submit" name="search" class="btn btn-primary">Submit</button></p>
                            </form>
                            <?php 
                                if(isset($_POST['search'])) {
                                    $searchData = $_POST['searchdata'];
                            ?>
                            <h4 align="center">Result "<?php echo $searchData;?>" keyboard</h4>
                            <table class="table">
                                <thead>
                                    <tr>
                                         <th>S.NO</th>
                                         <th>Enquiry No</th>
                                         <th>Full Name</th>
                                         <th>Enquiry Date</th>
                                         <th>Action</th>
                                    </tr>
                                </thead>
                            <?php   
                                $qEng = mysqli_query($dbcon,"SELECT * FROM tblenquiry WHERE (enquiryNumber like '%searchData%' || FullName like '%searchData%' || mobileNumber like '%searchData') ");
                                $num=mysqli_num_rows($qEng);
                                if($num > 0){
                                    $count = 1;
                                    while($result = mysqli_fetch_array($qEng)){
                            ?>
                                    <tr>
                                         <td><?php echo $result['enquiryNumber'];?></td>
                                         <td><?php echo $result['FullName'];?></td>
                                         <td><?php echo $result['contactNumber'];?></td>
                                         <td><?php echo $result['enquiryDate'];?></td>
                                         <td><a href="seeEnquiry.php?seeid=<?php echo $result['ID'];?>" class="btn btn-success">Display Details</a></td>
                                    </tr>
                            <?php
                                $count = $count + 1;
                                    }
                                } else {  ?>
                                    <tr>
                                        <td colspan="8"> No record found against this search</td>
                                    </tr>

                        <?php  }   } ?>
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
</html>
<?php }?>