<?php
	session_start();
	error_reporting(0);
	
	include('includes/dbconnection.php');
	if (strlen($_SESSION['agmsaid']==0)) {
	  header('location:logout.php');
	  } else{

	if(isset($_GET['delid']))
	{
		$did=intval($_GET['delid']);
		$delArt=mysqli_query($con,"delete from tblartist where ID='$did'");
		echo "<script>alert('Data deleted');</script>"; 
		echo "<script>window.location.href = 'handleArtist.php'</script>";     
	}
  ?>
  
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Manage Artist | Art Gallery  Management </title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <link href="css/elegant-icons-style.css" rel="stylesheet" />
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <!-- Custom  CSS-->
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
								<h3 class="page-header"><i class="fa fa-table"></i> Manage Artist</h3>
									<ol class="breadcrumb">
										  <li><i class="fa fa-home"></i><a href="dashboard.php">Home</a></li>
										  <li><i class="fa fa-table"></i>Artist</li>
										  <li><i class="fa fa-th-list"></i>Manage Artist</li>
									</ol>
							  </div>
						</div>
					<div class="row">
						  <div class="col-sm-12">
								<section class="panel">
									<header class="panel-heading">Manage Artis</header>
										<table class="table">
												<thead>
													<tr>
														<th>S.NO</th>
														<th>Name</th>
														<th>Email</th>
														<th>Mobile Number</th>
														<th>Registration Date</th>
														<th>Action</th>
													</tr>
													</tr>
												</thead>
												<?php
													$qArtist=mysqli_query($con,"SELECT * FROM  tblartist");
													$count=1;
													while ($data=mysqli_fetch_array($qArtist)) {
													?>								  
													<tr>
														  <td><?php echo $count;?></td>
														  <td><?php  echo $data['Name'];?></td>
														  <td><?php  echo $data['Email'];?></td> 
														  <td><?php  echo $data['MobileNumber'];?></td>
														  <td><?php  echo $data['CreationDate'];?></td>
														  <td><a href="editArtist.php?editid=<?php echo $data['ID'];?>" class="btn btn-success">Edit</a> || <a href="handleArtist.php?delid=<?php echo $data['ID'];?>" class="btn btn-danger">Delete</a></td>
													</tr>
													<?php 
														$count=$count+1;
													}
													?>
										</table>
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
  <!-- Custom JS -->
  <script src="js/scripts.js"></script>
</body>

</html>
<?php }  ?>