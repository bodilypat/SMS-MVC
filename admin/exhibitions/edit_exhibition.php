<?php
    session_start();
    error_reporting(0);
    include('../configure/dbConnect.php');
    if(strlen($_SESSION['artid']==0)){
        header('location:logout.php');
    } else {
        if(isset(_POST['submit'])){
            $title = $_POST['title'];
            $description = $_POST['description'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $location = $_POST['created_at']
            $editID = $_GET['editid'];

            $editEx = mysqli_query($dbcon,"UPDATE exhibition SET title = '$title',
                                                                  description = '$description',
                                                                  start_date = '$start_date',
                                                                  end_date = '$end_date',
                                                                  created_at = '$location',
                                            WHERE ID = '$editID' ");
            if($editEx) {
                echo "<script>alert('Exhibbition has been updated.');</script>";
            } else {
                echo "<script>alert('Something Went Wrong. Please try again.')</script>";
            }
        }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Add Product | Gallery Management System</title>
        <!-- custom style -->
        <link rel="stylesheet" href="../assign/style.css">
        <link rel="stylesheet" href="../assign/style-reponsive.css">
    </head>
<body>
    <section id="container" >
        <?php include_once('../configure/header.php');?>
        <?php include_once('../configure/sidebar.php');?>
        <section id="main-content" style="color:#000">
            <section class="wrapper">
                <div class="row">
                     <div class="col-lg-12">
                          <ol class="breadcrumb">
                               <li><i class="fa fa-home"></i><a href="dashboard.php">Home</li>
                               <li><i class="icon_document_alt"></i>Art Exibition</li>
                               <li><i class="fa fa-file-text-0"></i>Art Exibition Details</li>
                          </ol>
                     </div>
                </div>
                <div class="row">
                    <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                        <?php 
                            $qEx = $_GET['editid'];
                            $qEx = ($dbcon,"SELECT * FROM exhibitions WHERE id='$editID'");
                            $count = 1;
                            while ($result = mysqli_fetch_array($qEx))
                            {
                        ?>
                        <div class="col-lg-6">                            
                            <header class="panel-heading">Update Exhibition Details</header>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-2" for="Title">Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="title" name="title" required="ture" 
                                            value="<?php echo $result['title'];?>" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2" for="Description">Description</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="description" name="description" required="true" 
                                                value="<?php echo $result['description'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2" for="Description">Start Date</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="start_date" name="start_date" required="true" 
                                                value="<?php echo $result['start_date'];?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2" for="EndDate">End Date</label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" id="end_date" name="End_date" required="true" 
                                                value="<?php echo $result['end_date'];?>">
                                        </div>
                                    </div>
                                <div class="form-group">
                                    <label class="col-sm-2" for="Location">Location</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="created_at" name="created_at" required="true" 
                                               value="<?php echo $result['created_at'];?>">
                                    </div>
                                </div>   
                            </div>                                                   
                            <?php  } ?>
                            <p style="text-align: center;">
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </p>
                        </div>
                    </form>
                </div>
            </section>
        </section>
        <!-- FOOTER -->
        <?php include_once('../configure/footer.php');?>
    </section>
    <!-- check editor -->
    <script src="../assign/js/ckeditor.js"></script>
    <!-- javascript -->
    <script src="../assign/js/form-component.js"></script>
    <script src="../assign/js/script.js"></script>
</body>
</html>
<?php    } ?>
