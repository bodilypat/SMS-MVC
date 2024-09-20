<?php
    session_start();
    error_reporting(0);
    include('../configure/dbconnect.php');

    if(strlen($_SESSION['artid'] == 0)){
        header('location:logout.php');
    } else {
        if(isset($_POST['submit'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $created_at = $_POST['location']
            $addE = mysqli_query($dbcon,"INSERT INTO exhibitions(title, description,start_date, end_date)
                                               VALUES('$title','$description','$start_date','$end_date' ");
                if($addArt) {
                    echo "<script>alert('Exhibition has been added.');</script>";
                    echo "<script>window.location.href='manage_exhibition.php'</script>";
                } else {
                    echo "<script>alert('Something went wrong. Please try again.');</script>";
                }
            }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Add Exhibition | Art Gallery Management System</title>
        <!-- custom styles -->
        <link rel="stylesheet" href="../assign/css/style.css">
        <link rel="stylesheet" href="../assign/css/style-responsive.css">
    </head>
<body>
    <section id="container">
        <?php include_once('../configure/header.php');?>
        <?php include_once('../configure/sidebar.php'); ?>
        <section class="main-content">
             <section class="wrapper">
                  <div class="row">
                      <div class="col-lg-12">
                           <h3 class="page-header"><i class="fa fa-file-text-o"></i>Add Exibition</i></h3>
                           <ol class="breadcrumb">
                                 <li><i class="fa fa-home"></i><a href="dashboard">Home</li>
                                 <li class="icon_document_alt">Exhibitions</li>
                                 <li class="fa fa-file-text-0">Add Exhibitions</li>
                           </ol>
                      </div>
                  </div>
                  <div class="row">
                       <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">Add Exhibition Details</header>
                                <div class="panel-body">
                                    <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="Title">Title</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="title" name="title" class="form-control" required="true">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2" for="phone">Mobile Number</label>
                                            <div class="col-sm-10">
                                                <textarea id="description" name="description" class="form-control" required="true">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2" for="StartDate">Start Date</label>
                                            <div class="col-sm-10" >
                                                <input type="date" id="start_date" name="start_date" class="form-control" required="true">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-s" for="EndDate">End Date</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" id="end_date" name="end_date" requried="true">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </section>
                       </div>
                  </div>
             </section>
        </section>
        <!-- FOOTER -->
        <?php include_once('../define/footer.php');?>
    </section>
    <!-- custom javascript -->
    <script src="../assign/js/form-component.js"></script>
    <script src="../assign/js/scripts.js"></script>
</body>
</html>
<?php    } ?>
