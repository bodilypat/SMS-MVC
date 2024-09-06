<?php
    session_start();
    error_reporting(0);
    include('../configure/dbconnect.php');
    if(strlen($_SESSION['artid'])) {
        header('location:logout.php');
    } else {
            if(isset($_POST['submit'])){
                $editID = $_GET['editid'];
                $artPic = $_FILES['image']['name'];
                $extension = substr($artPic, strlen($artPic) - 4, strlen($artPic));
                /* allowed extension */
                $allowed_extensions = array(".jpg",".jpeg",".png",".gif");
                /* validateion for allowed extension  */
                if(!in_array($extension, $allowed_extensions)){
                    echo "<script>alert('Invalid format. only jpg / jpeg/ gif format allowed');<script>";
                } else {
                    $artImg = md5($artPic).$extension;
                    move_uploaded_file($_FILES['image']['tmp_name'],"images/".$artImg);
                    $editAtp = mysqli_query($dbcon,"UPDATE tblartproduct SET image = '$artImg' WHERE ID ='$editID' ");
                    if($editAtp){
                        echo "<script>alert('Update art product image.');</script>";
                    } else {
                        echo "<script>alert('Something Went Wrong. Please try again.');</script>";
                    }
                }
            }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Update Image | Gallery Management System</title>
        <!-- custom styles -->
        <link href="../assign/css/style.css" rel="stylesheet" >
        <link href="../assign/css/style-responsive.css" rel="stylesheet" />
    </head>
<body>
    <section id="container">
        <?php include_once('../configure/header.php');?>
        <?php include_once('../configure/sidebar.php');?>
        <!-- main content -->
        <section id="main-content">
             <section class="wrapper">
                 <div class="row">
                     <div class="col-lg-12">
                         <h3 class="page-header"><i class="fa fa-files-text-o"></i>Update Art Product Image</h3>
                         <ol>
                              <li><i class="fa fa-home"></i><a href="dashboard">Home</a></li>
                              <li><i class="icon_document_alt"></i>Art Product Image</li>
                              <li><i class="fa fa-file-text-o"></i>Update Art Product Image</li>
                         </ol>
                     </div>
                 </div>
                 <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">Update Art Product Image</header>
                            <div class="panel-body">
                                <form class="form-horizontal" enctype="multipart/form-data" method="post" action="">
                                    <?php
                                        $editID = $_GET['editid'];
                                        $qAtp = mysqli_query($dbcon,"SELECT * FROM tblartproduct WHERE ID='$editID' ");
                                        $count = 1;
                                        while($result=mysqli_fetch_array($qAtp)){
                                    ?>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="Title">Title</label>
                                            <div class="col-sm-10">
                                                <input type="text "class="from-control" id="arttitle" name="arttitle" required="true" 
                                                      value="<?php echo $result['artTitle'];?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="OldImage">Old Image</label>
                                            <div class="col-sm-10">
                                                <img src="images/<?php echo $result['artImage'];?>" width="200" height="150">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="NewImage">New Image</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" id="images" name="images" type="file" required="true" value="">
                                            </div>
                                        </div>
                                <?php  } ?>
                                    <p style="text-align: center;"><button type="submit" name="submit" class="btn btn-primary">Update</button></p>
                                </form>
                            </div>
                        </section>
                    </div>
                 </div>
             </section>
        </section>
        <!-- FOOTER -->
        <?php include_once('../configure/footer.php');?>
    </section>
    <!-- custom javascript -->
    <script src="../assign/js/form-component.js"></script>
    <script src="../assign/js/script.js"></script>
</body>
</html>
<?php } ?>