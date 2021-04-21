<!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container" style="padding-top: 250px;">

        <header class="section-header">
           <span class="login100-form-title p-b-33">
           <?php if (isset($_SESSION['session_cus'])) {
             echo "Hi!, " . $_SESSION['session_cus']['cus_name'];
             echo "<h5>This is what we offer..</h5>";
            }?>
            
          </span>
          <h3>Services</h3>
        </header>

        <div class="row">

          <div class="col-md-10 col-lg-6 wow bounceInUp" data-aos="zoom-in"  >
            <div class="box">
              <div class="icon" style="background: #fff0da;"><i class="ion-ios-bookmarks-outline" style="color: #e98e06;"></i></div>
              <h4 class="title"><a href="">ADVERTISING</a></h4>
              <!--<p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>  -->
              <div class="btn-group-vertical">
                <a href="./sub_pages/adbooking_details.php" class="btn btn-light">Read more</a>
                <a href="./sub_pages/adbooking.php" class="btn btn-light">Booking</a>
              </div>
            </div>
          </div>

          <div class="col-md-10 col-lg-6 wow bounceInUp" data-aos="zoom-in">
            <div class="box">
              <div class="icon" style="background: #fceef3;"><i class="ion-ios-analytics-outline" style="color: #ff689b;"></i></div>
              <h4 class="title"><a href="">NEWSPAPERS</a></h4>
              <!--<p class="description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata</p>  -->
              <div class="btn-group-vertical">
                <a href="./sub_pages/newspaper_details.php" class="btn btn-light">Read more</a>
                <a href="./sub_pages/newspaperbooking.php" class="btn btn-light">Booking</a>
              </div>
            </div>
          </div>

      </div>

      </div>
    </section><!-- End Services Section -->