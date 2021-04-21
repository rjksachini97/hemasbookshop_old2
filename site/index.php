<?php require_once("header.php");  
?>
<body>

 
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-transparent">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto"><a href="#intro">HEMAS BOOKSHOP</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav class="main-nav d-none d-lg-block">
        <ul>
          <li class="active"><a href="#intro">Home</a></li>
          <li><a href="#about">About Us</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#footer">Contact Us</a></li>
         <ul id="nav" class="nav nav-pills clearfix right" role="tablist">
              <?php
                if(!isset($_SESSION['session_cus'])){
              ?>
              <li class="dropdown"><a href="#why-us" data-toggle="dropdown">Account</a></li>
              <?php
                }else{
              ?>

              <li class="dropdown"><a href="#why-us" data-toggle="dropdown"><?php echo $_SESSION['session_cus']['cus_name']; ?></a>

                
                  
                      <li><a href="cus_profile.php">Profile</a></li>
                      <li><a href="lib/logout.php" id="logout_btn">Logout</a></li>
                      
                  
              </li>

              <?php
                }
              ?>
            </ul>
          
        </ul>
      </nav><!-- .main-nav-->

    </div>
  </header><!-- End Header -->
  <script type="text/javascript">
              $(function(){
            

              $("#logout_btn").click(function(e){
                e.preventDefault();
                 
                 swal({
                        title:"Do you want to Logout from Your Account?",
                        text:"You are trying to logout from <?php echo $_SESSION['session_cus']['cus_name']; ?>",
                        icon:"warning",
                        buttons:true,
                        dangerMode:true
                     }).then((willLogout)=>{
                          if(willLogout){
                            window.location = "lib/logout.php";
                          }
                        });
              });
            });    

</script>

  <!-- ======= Hero Section ======= -->
 <section id="intro" class="clearfix">
      <div class="row justify-content-center align-self-center" >
        <div class="col-md-20 intro-img order-md-last order-first" data-aos="zoom-out" data-aos-delay="200">
          <img src="images/np4.jpg" alt="" class="img-fluid">
      <!--     <div style="padding-left: 40px;">
              <a href="#why-us" class="btn-get-started scrollto" >LOGIN</a>
            </div>
        -->
      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
<!-- End About Section -->

    <!-- ======= Services Section ======= -->
  <?php
      require("services.php");
    ?><!-- End Services Section -->

    <!-- ======= Why Us Section ======= -->
       <?php 
   if(!isset($_SESSION['session_cus'])){
    require("login.php");}
    ?>
 
<!-- End Why Us Section -->

       <?php
   require ("aboutus.php");
   ?>  


    <!-- ======= Clients Section ======= -->
      <section id="clients" class="clients">
      <div class="container" data-aos="zoom-in">

        <header class="section-header">
          <h3>Our Publication Companies</h3> 
        </header>


        <div class="row justify-content-center">
          <div class="col-lg-8">

            <div class="owl-carousel testimonials-carousel">
    
              <div class="testimonial-item">
                <img src="images/np3.jpg" class="testimonial-img" alt="">
                <h3>Lakehouse</h3>
                <p align="justify">
                We are maintaining our business relationship since 10 years ago.Always felt happy to negotaiate with you Hemas Bookshop.Good Luck!
                </p>
              </div>
    
    
              <div class="testimonial-item">
                <img src="images/np7.jpg" class="testimonial-img" alt="">
                <h3>Wijeya Newspapers</h3>
                <p align="justify">
                We are maintaining our business relationship since 10 years ago.Always felt happy to negotaiate with you Hemas Bookshop.Good Luck!
                </p>
              </div>

               <div class="testimonial-item">
                <img src="images/np5.jpg" class="testimonial-img" alt="">
                <h3>Lankadeepa Publications</h3>
                <p align="justify">
                We are maintaining our business relationship since 10 years ago.Always felt happy to negotaiate with you Hemas Bookshop.Good Luck!
                </p>
              </div>
    
             

            </div>

          </div>
        </div>
      </div>
    </section>
   <!-- End Clients Section -->

  

    <!-- ======= F.A.Q Section ======= -->
      <?php require("faq.php");
    ?>
<!-- End F.A.Q Section -->

      <!-- Footer  -->
    <?php require("footer.php");
    ?>

  </main><!-- End #main -->

<!-- corner icon go to the top of the page  --> 
  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

 <?php require_once("footerdetails.php");
 ?>
