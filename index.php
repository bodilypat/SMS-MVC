<?php
     session_start();
     error_reporting(0);
     include('define/dbConnect.php');
?>
<!-- loading url script -->
<script>
    addEventLister("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);
    function hideURLbar(){
        window.scrollto(0,1);
    }
</script>
<!-- end -->
<!-- body  content -->
<body>
    <?php include_once('define/header.php');?>
    <div class="silder text-center">
          <div class="callback_container">
                <ul class="rslides" id="slide">
                      <li>
                           <div class="slider-img one-img">
                                 <div class="container">
                                       <div class="bottom-info"><h5>The Best Art</h5>
                                       <div class="bottom-info"></div>
                                       <div class="outs_more_button"><a href="about.php">Henri Matisse</a></div>
                                 </div>
                           </div>
                      </li>
                      <li>
                           <div class="slider-image two-img">
                                 <div class="container">
                                       <div class="slider-info">
                                             <h5></h5>
                                             <div class="button-info"><p></p></div>
                                             <div class="outs-more-button"><a href="about.php">Vincent Van Gogh</a></div>
                                       </div>                                       
                                 </div>
                           </div>
                      </li>
                      <li>
                           <div class="slider-img three-img">
                                 <div class="container">
                                       <div class="slider-info">
                                             <h5></h5>
                                             <div class="button-info"><p></p></div>
                                             <div class="outs_more_button"><a href="about.php">J.R.R Tolkien</a></div>
                                       </div>
                                 </div>
                           </div>
                      </li>
                </ul>
          </div>
          <div class="clearfix"></div>
    </div>
    <!-- portfolio -->
    <div id="portfolio">
          <div class="container">
                <div class="row no-gutters">
                      
                </div>
          </div>
    </div>
    <!-- new arrivals section -->
    <section class="blog">
          <div class="container">
                <h3>New Arrivals</h3>
                <div class="slide-image">
                      <ul id="">
                           <?php  $qAtt = mysqli_query($dbcon,"SELECT * 
                                                               FROM artProduct JOIN artType on artType.ID=artProduct.arttype");
                                  $count =1;
                                  while($resultAtt=mysqli_fetch_array($qAtt))
                                  {
                            ?>
                                <li>
                                     <div class="gallery_info">
                                           <img src="admin/images/<?php echo $resultAtt['image'];?>" width="300" height="300" alt="" class="img-fluid" />
                                           <div class="braner-right-icon">
                                                 <h4><?php echo $resultAtt['typeName'];?></h4>
                                           </div>
                                           <div class="outs_more_button">
                                                 <a href="artEnquiries.php?enid=<?php echo $resultAtt['artpid'];?>">Enquiry</a>
                                           </div>
                                     </div>
                                </li>
                            <?php } ?>
                      </ul>
                </div>
          </div>
    </section>
    <!-- section page -->
    <section class="about-page">
         <div class="container">
               <?php
                    $qPage=mysqli_query($dbcon,"SELECT * 
                                                FROM tblpage 
                                                WHERE pageType ='aboutus' ");
                    $count=1;
                    while($resultPage=mysqli_fetch_array($qPage))
                    {
                ?>
                    <h3><?php echo $resultPage['pageTitle'];?></h3>
                    <div class="">
                          <p><?php echo $resultPage['pageDescription'];?></p>
                    </div>
                <?php } ?>
         </div>
    </section>
<!-- end section -->
<!-- javascript -->
    <script>
        toys.render();
        toys.cart.on('toys_checkout', function(event){
            var items, length, count;
            if(this.subtotal() > 0) {
                items = this.items();
                for (count = 0; length = item.length; count< length; count++){}
            }
        });
    </script>
    <script src="assign/js/responsiveSlides.min.js"></script>
    <script>    
        $(function() {
            $('#slide4').responsiveSlide({
                auto : true;
                pages :false;
                nav :true;
                speed : 900,
                namespance : "callbacks",
                before : function(){
                    $('.events').append("<li>before event fired.</li>");
                },
                after: function() {
                    $('.events').append('<li>after event fired.</li>');
                }
            });
        });
    </script>
    <script src="assign/js/jquery.flexisel.js"></script>
    <script>
        $(window).load(function() {
            $("#flexiselArt").flexisel({
                visibleItem : 3,
                animationSpeed : 300,
                autoPlaySpeed : true,
                payseOnHover : true,
                enableResponsiveBreakpoints : true,
                responsiveBreakPoints : {
                    portrait : {
                        changePoints : 480,
                        visibleItem : 1
                    },
                    landscape : {
                        chanagePoint : 640,
                        visibleItems : 2
                    },
                    tablet : {
                        changePoint  : 768,
                        visibleItems : 2
                    }
                }
            });
        });
    </script>
    <script src="assign/js/move-top.js"></script>
    <script src="assign/js/easign.js"></script>
    <script>
        jQuery(document).ready(function (){
            var defaults = {
                containerID = 'toTop',
                containerHoverID = 'toTopHover',
                scrollSpeed : 1200,
                easingType : 'liner'
            };
            $().UItoTop({
                easingtype : 'easeOutQuart';
            });
        });
    </script>
</body>