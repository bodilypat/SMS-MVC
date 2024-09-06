<?php
    session_start();
    error_reporting(0);
    include('../configure/dbConnect.php');
    if(strlen($_SESSION['artid'])) {
        header('location : logout.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title> Gallery Management System || Admin Dashboard</title>
        <!-- custom css -->
        <link rel="stylesheet" href="../assign/css/style.css">
        <link rel="stylesheet" href="../assign/css/style-responsive.css" rel="stylesheet">
    </head>
<body>
    <section id="container">
        <?php include_once('../configure/header.php');?>
        <?php include_once('../configure/sidebar.php');?>
        <section id="main-content">
            <section class="wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header" ><i class="fa fa-laptop"></i>Dashboard</h3>
                        <ol>
                             <li><i class="fa fa-home"></i><a href="dashboard.php">Home</a></li>
                             <li><i class="fa fa-laptop"></i>Dashboard</li>
                        </ol>
                    </div>
                </div>
                <!-- content -->
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="info-box white-bg">
                            <?php
                                $qAtss = mysqli_query($dbcon,"SELECT * FROM tblartist");
                                $AtsNum = mysqli_num_rows($qAts);
                            ?>
                            <i class="fa fa-user"></i>
                            <div class="count"><?php echo $atsNum;?></div>
                            <div class="title"><a class="dropdown-item" href="manageArtist.php">TotalArtist</a></div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="info-box white-bg">
                             <?php
                                  $qEnq = mysqli_query($dbcon,"SELECT * FROM tblenquiry WHERE status='' || status is null ");
                                  $enqNum = mysqlis_num_rows($qEnq);
                             ?>
                            <i class="fa fa-file"></i>
                            <div class="count"><?php echo $enqNum;?></div>
                            <div class="title"><a class="dropdown-item" href="unanswerEnquiry.php">Total Unanswer Enquiry</a></div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="info-box white-bg">
                             <?php $qAtt = mysqli_query($dbcon,"SELECT * FROM tblarttype ");
                                   $attNum = mysqli_num_rows($qAtt);
                             ?>
                            <i class="fa fa-file"></i>
                            <div class="count"><?php echo $attNum;?></div>
                            <div class="title"><a class="dropdown" href="manageArttype.php">Total Art Type</a></div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="info-box white-bg">
                            <?php $qAtm = mysqli_query($dbcon,"SELECT * FROM tblartmedium ");
                                  $atmNum =mysqli_num_rows($qAtm);
                            ?>
                            <i class="fa fa-file"></i>
                            <div class="count"><?php echo $atmNum;?></div>
                            <div class="title"><a class="dropdown" href="manageArtMedium.php">Total Art Medium</a></div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="info-box white-bg">
                             <?php $qAtp = mysqli_query($dbcon,"SELECT * FROM tblartproduct ");
                                   $atpNum = mysqli_num_rows($qAtp);
                            ?>
                            <i class="fa fa-file"></i>
                            <div class="title"><a class="dropdown-item" href="manageArtProduct.php">Total Art Product</a></div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
        <!-- FOOTER -->
        <?php include_once('../configure/footer.php');?>
    </section>
    <!-- custom script -->
    <script src="../assign/js/scripts.js" ></script>
    <script>
        $(function() {
            $(".knob").knob({
                'drow' : function() {
                    $(thhis.i).val(this.cv + '%')
                }
            })
        });
        /* carousel */
        $(document).ready(function() {
            $('#owl-slider').owlCarousel({
                navigation : true,
                slideSpeed :  300,
                paginationSpeed : 400,
                singleItem : true
            });
        });

        /* custom select box */
        $(function() {
            $('select.styled').customSelect();
        });

        /* map */
        $(function() {
            $('map').vectorMap({
                series : {
                    region :[{
                        values : gdpData,
                        scale : ['#000','#000'],
                        normalizeFunction : 'polynomial'
                    }]
                },
                backgroundColor : '#eef3f7',
                onLabelShow : function(e, el, code) {
                     el.html(el.html() + '(GDP - ' + gdpData[code] + ')');
                }
            });
        });
    </script>
</body>
</html>