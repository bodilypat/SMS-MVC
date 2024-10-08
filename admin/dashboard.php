<?php

session_start();
error_report(0);
include('../config/dbConnect.php');
    if(strlen($_SESSION['id']) == 0)
    {
        header('location:logout.php');
    } else {

    ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin | Dashboard</title>
        <!-- custom css -->
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stysesheet" href="../assets/css/plugins.css">
        <link rel="stylesheet" href="../assets/css/theme-1.css">
    </head>
<body>
    <div id="app">
        <?php include('layouts/sidebar.php');?>
        <div class="app-content">
            <?php include('layouts/header.php');?>
            <div class="main-content">
                <div id="container" class="wrapper-content container" >
                    <!-- PAGE TITLE -->
                    <section id="page-title">
                        <div class="row">
                            <div class="col-sm-8"><h1 class="mainTitle">Admin | Dashboard</div>
                            <ol class="breadcrumb">
                                 <li><span>Admin</span></li>
                                 <li class="active"><span>Dashboard</span></li>
                            </ol>
                        </div>
                    </section>
                    <!-- panel container-->
                    <div class="container-fluid continer-full bg-white">
                        <div class="row">

                            <!-- Artist panel -->
                            <div class="col-sm-4">
                                <div class="panel panel-blue no-radius text-center">
                                    <div class="panel-body">
                                         <span class="fa-stack fa-2x">
                                              <i class="fa fa-square fa-stack-2x text primary"></i>
                                              <i class="fa fa-smaile-o fa-stack-1x fa-inverse"></i>
                                         </span>
                                         <h2 class="StepTitle">Mainage Doctors</h2>
                                         <p class="links cl-effect-1">
                                            <a href="Manage-Artists.php">
                                                <?php
                                                    $qAts = mysqli_query($handle,"SELECT * FROM artists");
                                                    $numRows = mysqli_num_rows($qAts)
                                                    {
                                                ?>
                                                    Total Artists : <?php echo htmlentities($numRows);
                                                    }?>
                                            </a>
                                         </p>
                                    </div>
                                </div>
                            </div>
                            <!-- Exhibition panel -->
                            <div class="col-sm-4">
                                <div class="panel panel-blue no-radius text-center">
                                    <div class="panel-body">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa fa-squire fa-stack-2x text-primary"></i>
                                            <i class="fa fa-smail-o fa-stack-1x fa-inverse"></i>
                                        </span>
                                        <h2 clas="StepTitle">Manage Exhibitions</h2>
                                        <p class="links cl-effect-1">
                                            <a href="manage-artwork-exhibition.php">
                                                <?php
                                                    $qExh = mysqli_query($handle,"SELECT * FROM exhibitions");
                                                    $numRows = mysql_num_rows($qExh)
                                                    {
                                                ?>
                                                    Total Exhibitions = <?php echo htmlentities($numRow)
                                                    } ?>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- Gallery Visitor  panel -->
                            <div class="col-sm-4">
                                <div class="panel panel-blue no-radio text-center">
                                    <div class="panel-body">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa fa-square fa-stack-2x text-primary"></i>
                                            <i class="fa fa-smaile-o fa-stack-1x fa-inverse"></i>
                                        </span>
                                        <h2 class="StepTitle">Manage Gallery Visitor</h2>
                                        <p class="links cl-effect-1">
                                            <a href="manage-artworks.php">
                                                <?php
                                                    $qGvis = mysqli_query($handle,"SELECT * FROM gallery_visitiors");
                                                    $numRows = mysqli_num_rows($qGvis)
                                                    {
                                                ?>
                                                    Total Artworks =<?php echo htmlentities($numRows); 
                                                    } ?>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- Artworks panel -->
                            <div class="col-sm-4">
                                <div class="panel panel-blue no-radius text-center">
                                    <div class="panel-body">
                                        <span class="fa fa-stack fa-2x">
                                            <i class="fa fa-square-2x text-primary"></i>
                                            <i class="fa fa-smaile-o fa-stack-1x fa-inverse"></i>
                                        </span>
                                        <h2 class="StepTitle">Manage Artworks</h2>
                                        <p class="links cl-effect-1">
                                            <a href="manage-buyers.php">
                                                <?php   
                                                    $qAtw = mysqli_query($handle,"SELECT * FROM artworks");
                                                    $numRows = mysqli_num_rows($qAtw)
                                                    {
                                                ?>
                                                    Total Buyers = <?php echo htmlentities($numRows);
                                                    } ?>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- sales panel -->
                            <div class="col-sm-4">
                                <div class="panel panel-blue no-ordius text-center">
                                    <div class="panel-body">
                                        <span class="fa fa-stack fa-2x">
                                            <i class="fa fa-square fa-stack-2x text-primary"></i>
                                            <i class="fa fa-smail-o fa-stack-1x fa-inverse"></i>
                                        </span>
                                        <p class="links cl-effect-1">
                                            <a href="manage-artwors.php">
                                                <?php
                                                    $qSale = mysqli_query($handle,"SELECT * FROM sales");
                                                    $numRows = mysqli_num_rows($qSale){
                                                ?>
                                                    Total Artworks = <?php echo htmlentities($numRows);
                                                    } ?>

                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- buyers panel -->
                            <div class="col-sm-4">
                                <div class="panel panel-blue no-radius text-center">
                                    <div class="panel-body">
                                        <span class="fa fa-stack fa-2x">
                                            <i class="fa fa-square fa-stack-2x text-primary "></i>
                                            <i class="fa fa-smail-o fa-stack-1x fa-inverse"></i>
                                        </span>
                                        <h2 class="StepTitle">Manage Buyers</h2>
                                        <p class="links cl-stack-1">
                                            <a href="manage-buyers.php">
                                                <?php 
                                                    $qBuy = mysqli_query($handle,"SELECT * FROM buyers");
                                                    $numRow = mysqli_num_row($qBuy)
                                                    {
                                                ?>
                                                    Total Buyers = <?php echo htmlentities($numRows); 
                                                    } ?>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- Exhibition Artworks -->
                            <div class="col-sm-4">
                                <div class="panel panel-blue no-radius text-center">
                                    <div class="panel-body">
                                        <span class="fa fa-stack fa-2x">
                                            <i class="fa fa-square fa-stack-2x text-primary"></i>
                                            <i class="fa fa-smail-o fa-stack-1 fa-inverse"><i>
                                        </span>
                                        <h2 class="StepTitle">Manage Exhibition-Artworks</h2>
                                        <p class="links cl-effect-1">
                                            <?php
                                                $qEatw = mysqli_query($handle,"SELECT * FORM exhibition_artworks");
                                                $numRows = mysqli_num_rows($qEatw)
                                                {
                                            ?>
                                                Total Exhibition Artworks = <?php echo htmlentities($numRows);
                                                } ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('layouts/footer.php');?>
        <?php include('layouts/setting.php');?>
    </div>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/form-elements.js"></script>
    <script>
        jQuery(document).ready(function(){
            Main.init();
            form-elements.init();
        });
    </script>
</body>
</html>
<?php } ?>