<?php
    session_start();
    error_reporting(0);
    include('../configure/dbconnect.php');

    if(strlen($_SESSION['artid'] == 0)){
        header('location:logout.php');
    } else {
        if(isset($_POST['submit'])) {
            $artName = $_POST['artname'];
            $artMobile = $_POST['mobileno'];
            $artEmail = $_POST['email'];
            $awardDetails = $_POST['award'];
            $img = $_FILES['images']['name'];
            $extionsion = substr($img, strlen($img)-4, strlen($img));

            /* allowed extensions */
            $allowed_extension = array('.jpg','jpeg','.png','.gif');

            /* validation for allowed extensions */
            if(!in_array($extension,$allowed_extension)) {
                echo "<script>alert('Invalid format. only jpg / jpeg/ png/ gif format allowed');</script>";
            } else {
                $artPic = md5($img).$extension;
                move_uploaded_file($_FILES['images']['tmp_name'],"images/" . $artPic);
                $addArt = mysqli_query($dbcon,"INSERT INTO tblArtist(artname, mobileNumber, email, award, profilePic)
                                               VALUES('$artName','$artMobile','$artEmail','$awardDetial','$artPic' ");
                if($addArt) {
                    echo "<script>alert('Artist details has been added.');</script>";
                    echo "<script>window.location.href='manageArtist.php'</script>";
                } else {
                    echo "<script>alert('Something went wrong. Please try again.');</script>";
                }
            }
        }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Add Artist | Gallery Management System</title>
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
                           <h3 class="page-header"><i class="fa fa-file-text-o"></i>Add Artists</i></h3>
                           <ol class="breadcrumb">
                                 <li><i class="fa fa-home"></i><a href="dashboard">Home</li>
                                 <li class="icon_document_alt">Artist</li>
                                 <li class="fa fa-file-text-0">Add Artist</li>
                           </ol>
                      </div>
                  </div>
                  <div class="row">
                       <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">Add Artist Details</header>
                                <div class="panel-body">
                                    <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="ArtistName">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="artistName" name="artistName" class="form-control" required="true">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2" for="MobileNumber">Mobile Number</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="mobileNumberr" name="mobileNumber" class="form-control" required="true">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2" for="Email">Email</label>
                                            <div class="col-sm-10" >
                                                <input type="email" id="email" name="email" class="form-control" required="true">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-s" for="AwardDetails">Award Details</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="awarddetails" requried="true"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2" for="ProfilePic">Profile Picture</label>
                                            <div class="col-sm-10">
                                                <input type="file" class="form-control" name="images" value="" required="true">
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
