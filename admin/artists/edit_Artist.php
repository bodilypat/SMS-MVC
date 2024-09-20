<?php
  session_start();
  error_reporting(0);
  include('includes/dbconnection.php');
  if (strlen($_SESSION['agmsaid']==0)) {
    header('location:logout.php');
  }
  else{

      if(isset($_POST['submit']))
        {
          
          $artName=$_POST['name'];
          $artMobnum=$_POST['mobnum'];
          $artEmail=$_POST['email'];
          $artEducate=$_POST['edudetails'];
          $artAward=$_POST['awarddetails'];

          $eid=$_GET['editid'];
        
          $editArt=mysqli_query($con, "UPDATE tblartist 
                                       SET Name='$artName',MobileNumber='$artMobnum',Email='$artEmail',Education='$artEducate',Award='$artAward' 
                                       WHERE ID='$eid'");
          if ($editArt) {
        
          echo "<script>alert('Artist details has been updated.');</script>";
        }
        else
          {
            echo "<script>alert('Something Went Wrong. Please try again.');</script>";
          }

        }

  ?>
<!DOCTYPE html>
<html lang="en">

<head>
  
  <title>Update Artist | Art Gallery Management System</title>

 
  <link href="css/bootstrap.min.css" rel="stylesheet">
  
  <link href="css/bootstrap-theme.css" rel="stylesheet">
 
  <link href="css/elegant-icons-style.css" rel="stylesheet" />
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <link href="css/daterangepicker.css" rel="stylesheet" />
  <link href="css/bootstrap-datepicker.css" rel="stylesheet" />
  <link href="css/bootstrap-colorpicker.css" rel="stylesheet" />
  <!-- Custom css -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />

</head>

<body>

  
  <section id="container" class="">
    
    <?php include_once('includes/header.php');?>
    

   
   <?php include_once('includes/sidebar.php');?>
   
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-file-text-o"></i>Update Artist Detail</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="dashboard.php">Home</a></li>
              <li><i class="icon_document_alt"></i>Artist</li>
              <li><i class="fa fa-file-text-o"></i>Artist Detail</li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">Update  Detail</header>
				    <div class="panel-body">
						<form class="form-horizontal " method="post" action="">
					        <p style="font-size:16px; color:red" align="left"> 
								<?php if($msg){ echo $msg;}  ?> 
							 </p>
								<?php
									$eId=$_GET['editid'];
									$qArtist=mysqli_query($con,"SELECT * FROM tblartist WHERE ID='$eId'");
									$count=1;
									while ($data=mysqli_fetch_array($qArtist)) 
									{
									?>
							<div class="form-group">
								<label class="col-sm-2 control-label">Name</label>
								    <div class="col-sm-10">
									   <input class="form-control" id="name" name="name"  type="text" required="true" value="<?php  echo $data['Name'];?>">
									</div>
							</div>						  
							<div class="form-group">
							    <label class="col-sm-2 control-label">Mobile Number</label>
							    	<div class="col-sm-10">
										<input class="form-control" id="mobnum" maxlength="10" name="mobnum"  type="text" required="true" pattern="[0-9]+" value="<?php  echo $data['MobileNumber'];?>">
									</div>
								</div>										  
								<div class="form-group">
									<label class="col-sm-2 control-label">Email</label>
										<div class="col-sm-10">
											<input class="form-control" id="email" name="email"  type="email" required="true" value="<?php  echo $data['Email'];?>">
										</div>
							    </div>									
								<div class="form-group">
									<label class="col-sm-2 control-label">Award Details</label>
										<div class="col-sm-10">
									    	<textarea class="form-control" name="awarddetails" required="true"><?php  echo $data['Award'];?></textarea>
										</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Profile Pics</label>
										<div class="col-sm-10">
											<img src="images/<?php echo $data['Profilepic'];?>" width="200" height="150" value="<?php  echo $data['Profilepic'];?>">
												<a href="changepropic.php?imageid=<?php echo $data['ID'];?>" class="btn btn-success">  Edit Image</a>
										</div>				   
								</div>
								<?php } ?>
								<p style="text-align: center;"> <button type="submit" name='submit' class="btn btn-primary">Update</button></p>
						</form>
					</div>
            </section>
          </div>
        </div>      
      </section>
    </section>
 <?php include_once('includes/footer.php');?>
  </section>
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script> 
  <script src="js/jquery.scrollTo.min.js"></script>
  <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="js/jquery-ui-1.9.2.custom.min.js"></script>
  <script type="text/javascript" src="js/ga.js"></script> 
  <script src="js/bootstrap-switch.js"></script>
  <script src="js/jquery.tagsinput.js"></script>
  <script src="js/jquery.hotkeys.js"></script>
  <script src="js/bootstrap-wysiwyg.js"></script>
  <script src="js/bootstrap-wysiwyg-custom.js"></script>
  <script src="js/moment.js"></script>
  <script src="js/bootstrap-colorpicker.js"></script>
  <script src="js/daterangepicker.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="js/ckeditor.js"></script>
  <script src="js/form-component.js"></script>
  <script src="js/scripts.js"></script>
</body>

</html>
<?php  } ?>