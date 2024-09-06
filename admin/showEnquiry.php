<?php
    session_start();
    error_reporting(0);
    include('../configure/dbConnect.php');
    if(strlen($_SESSION['artid'])) {
        header('location:logout.php');
    } else {
        if(isset($_POST['submit'])){
            $seeID = $GET['seeid'];
            $remark = $_POST['remark'];
            $status = 'Answer';

            $editEnq = mysqli_query($dbcon,"UPDATE tblenquiry SET adminRemark = '$remark' , status='$status' WHERE ID ='$seeID' ");
            if($editEnq) {
                echo "<script>alert('Remarks has been update')</script>";
            } else {
                echo "<script>alert('Something Went Wrong. Please try again')</script>";
            }
        }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Display Enguiry | Gallery Management System</title>
        <!-- custom style -->
        <link rel="stylesheet" href="../assign/css/style.css"></script>
        <link rel="stylesheet" href="../assign/css/style-responsive.css"></script>
    </head>
<body>
    <section id="container">
        <section id="main-content">
            <secction class="wrapper">
                <div class="row">
                    <h3 class="page-header"><i class="fa fa-table"></i>View Enquiry</h3>
                    <ol class="breadcrumb">
                         <li><i class="fa fa-home"></i><a href="dashboard.php"></a></li>
                         <li><i class="fa fa-table"></i>Enquiry</li>
                         <li><i class="fa fa-th-list"></i></li>
                    </ol>
                </div>
                <!-- content --> 
                <div class="row">
                    <div class="col-sm-12">
                        <section classs="panel">
                            <header class="panel-heading">Display Enquiry Details</header>
                            <?php
                                $seeID =$_GET['seeid'];
                                $qEnq = mysqli_query($dbcon,"SELECT tblartproduct,*, tblenquiry.* 
                                                             FROM tblenquiry JOIN tblartproduct.ID = tblenquiry.atpid 
                                                             WHERE tblenquiry.ID = '$seeID' ");
                            ?>
                            <table border="1" class="table table-bordered mg-b-0">
                                <tr>
                                    <th>Enquiry Number</th>
                                    <td colspan="3"><?php echo $result['enquiryNumber'];?></td>
                                </tr>
                                <tr>
                                    <th>Full Name</th>
                                    <td><?php $result['fullName'];?></td>
                                    <th>Art Name</th>
                                    <td><?php echo $result['artTitle'];?><br />
                                        <a href="editArtProduct.php?editid=<?php echo $result['atpid'];?>" target="_blank">View Details</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Art Reference Number</th>
                                    <td><?php echo $result['refNum'];?></td>
                                    <th>Email</td>
                                    <td><?php echo $result['email'];?></td>
                                </tr>
                                <tr>
                                    <th>Contact Number</th>
                                    <td><?php echo $result['mobileNumber'];?></td>
                                    <th>Enquiry Date</th>
                                    <td><?php echo  $result['enquiryDate'];?></td>
                                </tr>
                                <tr>
                                    <th>Message</th>
                                    <td><?php echo $result['message'];?></td>
                                    <th>Status</th>
                                    <td>
                                        <?php
                                            if($result['status'] ==""){
                                                echo "Unanswer Enquiry";
                                            }
                                            if($ressult['status'] == 'answer'){
                                                echo "Answer Enquiry";
                                            };?>
                                    </td>
                                </tr>
                                <?php if($result['status']=="") { ?>
                                <form name="submit" method="post">
                                    <tr>
                                        <th>Remark : </th>
                                        <td>
                                            <textarea name="remark" placeholder="" rows="5" cols="14" class="form-control wee-450" required="true"><textarea>
                                        </td>
                                    </tr>
                                    <tr align="center">
                                        <td colspan="2">
                                            <button type="submit" name="submit" class="btn btn-primary btn-sm">
                                                <i class="fa fa-dot-circle-o"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </form>
                                <?php } else { ?> 
                                    <tr>
                                        <th>Remark</th>
                                        <td colspan="3"><?php echo $result['adminRemark'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Remark Date</th>
                                        <td colspan="3"><?php echo $result['adminRemarkDate']; ?></td>
                                    </tr>
                                    <?php  } ?>
                                <?php  } ?>
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