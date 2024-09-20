<?php
    session_start();
    error_reporting(0);
    include('../configure/dbConnect.php');
    if(strlen($_SESSION['artid']==0)){
        header('location:logout.php');
    } else {
        if(isset(_POST['submit'])){
            $artTitle = $_POST['arttitle'];
            $artOrientation = $_POST['orientation'];
            $artSize = $_POST['size'];
            $artist = $_POST['artist'];
            $arttype = $_POST['arttype'];
            $artMedium = $_POST['artmedium']
            $salePrice = $_POST['saleprice'];
            $artDescription = $_POST['description'];
            $editID = $_GET['editid'];
            $editAtp = mysqli_query($dbcon,"UPDATE artProduct SET artTitle = '$artTitle',
                                                                  artDimension = '$artDimension',
                                                                  artSize = '$artsize',
                                                                  artist = '$artist',
                                                                  artType = '$artType',
                                                                  artMedium = '$artMedium',
                                                                  salePrice = '$salePrice',
                                                                  artDescription = 'description',
                                            WHERE ID = '$editID' ");
            if($editAtp) {
                echo "<script>alert('Art product has been updated.');</script>";
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
                               <li><i class="icon_document_alt"></i>Art Product</li>
                               <li><i class="fa fa-file-text-0"></i>Art Product Details</li>
                          </ol>
                     </div>
                </div>
                <div class="row">
                    <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                        <?php 
                            $editID = $_GET['editid'];
                            $qAtp = ($dbcon,"SELECT tblarttype.ID as attID,
                                                    tblarttype.artType as attName,
                                                    tblArtMedium.ID as atmID,
                                                    tblartMedium.artMedium as atmName,
                                                    tblartProduct.ID as atpID,
                                                    tblartist.ID as atsID,
                                                    tblartist.Name,
                                                    tblartProduct.artTitle,
                                                    tblartProduct.artDimension,
                                                    tblartProduct.artOrientation,
                                                    tblartProduct.artSize,
                                                    tblartProduct.artist,
                                                    tblartProduct.arttype,
                                                    tblartProduct.artMedium,
                                                    tblartProduct.salePrice,
                                                    tblartProduct.artDescription,
                                                    tblartProduct.artImage,
                                                    tblartProduct.RefNum,
                                                    tblartProduct.artType
                                            FROM tblartProduct JOIN tblarttype ON tblarttype.ID=tblartProduct.artType 
                                                               JOIN tblartMedium on tblartMedium.ID=tblartProduct.artMedium
                                                               JOIN tblartist.ID ON tblartProduct.ID=tblartProduct.artist ");
                            $count = 1;
                            while ($result = mysqli_fetch_array($query))
                            {
                        ?>
                        <div class="col-lg-6">
                            <section class="panel">
                                <header class="panel-heading">Update Art Details</header>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-sm-2" for="ArtTitle">Title</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="title" name="title" required="ture" 
                                                  value="<?php echo $result['artTitle'];?>" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2" for="FeaturedImage">Featured Image</label>
                                        <div class="col-sm-10">
                                            <img src="images/<?php echo $result['artImage'];?>" width="200" hight="150" 
                                                 value="<?php echo $result['artImage'];?>">
                                                 <a href="changeImage.php?editid=<?php echo $result['atpID'];?>">&nbsp; Edit Image</a>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2" for="Dimension">Dimension</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="dimension" name="dimension" required="true" 
                                                   value="<?php echo $result['artDimension'];?>">
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-lg-6">
                            <section class="panel">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-sm-2" for="Orientation">Orientation</label>
                                        <div class="col-sm-10">
                                             <select class="form-control" id="orientation" name="orientation" required="true">
                                                  <option value="<?php echo $result['artOrientation'];?>"><?php echo $result['artOrientation'];?></option>
                                                  <option value="Potrait">Potrait</option>
                                                  <option value="Landscape">Landscape</option>
                                             </section>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2" for="Size">Size</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="size" name="size" required="true">
                                                <option value="<?php echo $result['artSize'];?>"><?php echo $result['artSize'];?></option>
                                                <option value="Small">Small</option>
                                                <option value="Medium">Medium</option>
                                                <option value="Large">Large</option>
                                            </section>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2" for="Artist">Artist</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="artist" id="artist">
                                                <option value="<?php echo $result['artID'];?>"><?php echo $result['artSize'];?></option>
                                                    <?php $qAts = mysqli_query($dbcon,"SELECT * FROM tblartist");
                                                         while($dataAts=mysqli_fetch_array($qAts)){
                                                    ?>
                                                <option value="<?php echo $dataAts['ID'];?>"><?php echo $dataAts['artName'];?></option>
                                                  <?php  } ?>
                                            </select>
                                        </div>
                                    </div>                                
                                    <div class="form-group">
                                        <label class="col-sm-2" for="ArtType">Art Type</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="arttype" id="arttype">
                                                <option value="<?php echo $result['artID'];?>"><?php echo $result['arttype'];?></option>
                                                    <?php $qAtt=mysqli_query($dbcon,"SELECT * FROM tblarttype");
                                                        while($dataAtt=mysqli_fetch_array($qAtt)) {
                                                    ?>
                                                <option value="<?php echo $dataAtt['ID'];?>"><?php echo $dataAtt['artType'];?></option>
                                                    <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2" for="AtrMedium">Art Medium</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="artmedium" id="artmediium">
                                                  <option value="<?php echo $result['atmID'];?>"><?php echo $result['atmName'];?></option>
                                                  <?php 
                                                        $qAtm = mysqli_query($dbcon,"SELECT * FROM tblartMedium");
                                                        while($dataAtm = mysqli_fetch_array($qAtm))
                                                        {
                                                    ?>
                                                    <option value="<?php echo $dataAtm['ID'];?>"><?php echo $dataAtm['artMedium'];?></option>
                                                    <?php  } ?>
                                            </section>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2" for="SalePrice">Sale Price</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" id="saleprice" name="saleprice" required="true" 
                                                   value="<?php echo $result['salePrice'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2" for="Description">Product Description</label>
                                        <div class="col-sm-10">
                                            <textarea class="foorm-control" id="description" name="description" row="12" cols="4" required="true">
                                                <?php echo $result['description'];?>
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>                        
                    <?php  } ?>
                        <p style="text-align: center;"><button type="submit" name="submit" class="btn btn-primary">Submit</button></p>
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
