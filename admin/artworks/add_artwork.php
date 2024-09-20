<?php
    session_start();
    error_reporting(0);
    include('../configure/deconnect.php');

    if(strlen($_SESSION['artid']==0)){
        header('location:logout');
    } else {
        if(isset($_POST['submit'])) {
            $artID = $_POST['artid'];
            $artTitle = $_POST['arttitle'];
            $artDimension = $_POST['artdimension'];
            $artOrientation = $_POST['artorientation'];
            $artSize = $_POST['artsize'];
            $artist = $_POST['artist'];
            $artType = $_POST['arttype'];
            $artMedium = $_POST['artMedium'];
            $artPrice = $_POST['artprice'];
            $artDescription = $_POST['artdescription'];
            $refno = mt_rand(1000000000, 999999999);
            $image = $_FILES['images']['name'];
            $extension = substr($image, strlen($image)-4, strlen($image));

            /* allowed extensions */
            $allowed_extensions = array('.jpg','jpeg','.png','.gif');
            /* validation for allowed extension */
            if(!in_array($extension, $allowed_extensions)) {
                echo "<script>alert('Featured image has Invalid format. only jpg /jpeg / png/ gif formart allowed');</script>";
            } else {
                $ficgure = md5($pic).time().$extension;
                move_uploaded_file($_FILE['image']['tmp_name'],"images/" .$ficgure);
                $addAtp = mysqli_query($dbcon,"INSERT INTO tblartproduct(title, dimension, orientation, size, artist, arttype, artmedium, saleprice, description, image, refnum)
                                               VALUES('$artID','$artTitle','$artDimension','$artOrientation','$artSize','$artist','$artType','$artMeduim','$artPrice','$artDescription','$ficgure',$refno') ");
                if($addAtp) {
                    echo "<script>alert('Art product details has been submitted.);</script>";
                    echo "<script>window.location.href='addArtproduct.php'</script>";
                } else {
                    echo "<script>alert('Something Went wrong. Please try again.');</script>";
                }
            }
        }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Add Art Product | Gallery Management System</title>
        <!-- custom style -->
        <link rel="stylesheet" href="../assign/css/style.css">
        <link rel="stylesheet" href="../assign/css/sidebar.php">
    </head>
<body>
    <section id="container">
        <?php include_once('../configure/header.php');?>
        <?php include_once('../configure/sideber.php');?>
        <!-- main content -->
        <section id="main-content" style="color:#000">
            <section class="wrapepr">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header"><i class="fa fa-file-text-0"></i>Add Art Gallery</h3>
                        <ol class="breadcrumb">
                            <li><i class="fa fa-home"></i><a href="dashboard.php">Home</li>
                            <li><i class="icon_document_alt"></i>Art Product</li>
                            <li><i class="fa fa-file-text-o"></i>Art Product Details</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <form class="class-horizontal" method="post" action="" enctype="multipart/form-data">
                        <div class="col-md-6">
                            <section class="panel">
                                <header class="panel-heading">Add Art Product Details</header>
                                <div class="panel-body">
                                     <div class="form-group">
                                        <label class="col-sm-2" for="Title">Title</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="title" name="title" class="form-control" required="true" />
                                        </div>
                                     </div>
                                     <div class="form-group">
                                        <label class="col-sm-2" for="Image">Ficgure Image</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="images" name="images" class="form-control" value="" required="ture">
                                        </div>
                                     </div>
                                     <div class="form-group">
                                        <label class="col-sm-2" for="Dimension">Dimention</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="dimension" name="dimension" class="form-control" required="true">
                                        </div>
                                     </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-6">
                            <section class="panel">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label></label>
                                        <div class="col-sm-10">
                                            <section>
                                                <option value="">Choose orientation</option>
                                                <option value="Potrait">Potrait</option>
                                                <option value="landscape">Landscape</option>
                                            </section>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2" for="Artist">Artist</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="artist" id="artist">
                                                <option value="">Choose Artist</option>
                                                   <?php $qAts = mysqli_query($dbcon,"SELECT * FROM tblArtist");
                                                        while($result=mysqli_fetch_array($qAts)){
                                                    ?>
                                                <option value="<?php echo $result['ID'];?>"><?php echo $result['name'];?></option>
                                                    <?php    } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2" for="Arttype">Art Type</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="arttype" id="arttype">
                                                <option value="">Choose Art type</option>
                                                    <?php
                                                        $qAtt = mysqli_query($dbcon,"SELECT * FROM tblarttype");
                                                        while($result=mysqli_fetch_array($qAtt)){
                                                    ?>
                                                <option value="<?php echo $result['ID'];?>"><?php echo $result['artType'];?></option>
                                                    <?php    } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2" for="ArtMedium">Choose Art Medium</lael>
                                        <div class="col-sm-10">
                                            <?php $qAtm = mysqli_query($dbcon,"SELECT * FROM tblartmeduium");
                                                while($result = mysqli_fetch_array([$qAtm])) {
                                            ?>
                                            <option value="<?php echo $result['ID'];?>"><?php echo $result['artMedium'];?></option>
                                            <?php  } ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2" for="SalePrice">Sale Price</label>
                                        <div class="col-sm-10">
                                            <textarea type="text" class="form-control" id="description" name="description" row="12" cols="4" required="ture"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <p style="text-align: center"><button type="submit" name="submit" class="btn btn-primary">Submit</button></p>
                    </form>
                </div>
            </section>
        </section>
        <!-- FOOTER -->
        <?php include_once('../configure/footer.php');?>
    </section>
    <!-- custom javascript -->
    <script src="../assign/js/form-component.js"></script>
    <script src="../assign/js/scripts.js"></script>
</body>
</html>
<?php   } ?>
