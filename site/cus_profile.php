<?php 
session_start();
 require_once("lib/dbconnection.php");
 $dbobj=DB::connect();

$cus_id= $_SESSION["session_cus"]["cus_id"];

$sql_cus = "SELECT * FROM tbl_reg_customer WHERE cus_id = '$cus_id'";


$rescus = $dbobj->query($sql_cus);
$cus_info = $rescus->fetch_assoc();

/*$sqlnp = "SELECT np_book_id, newsp_name, np_tot_price, np_book_status FROM tbl_newspaper_booking WHERE cus_id='$cus_id'";
$sqlad = "SELECT ad_book_id, newsad_mode, ad_tot_price, ad_book_status FROM tbl_ad_booking WHERE cus_id='$cus_id'";

$resnp = $dbobj->query($sqlnp);
$resad = $dbobj->query($sqlad);
*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Hemas Bookshop</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="images/1.png" rel="icon">
  <link href="images/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,400,500,600,700" rel="stylesheet">

   <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="scripts/sweetalert.min.js"></script>

<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->


  <!-- Template Main CSS File -->
  <link href="css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="scripts/jquery-ui-1.12.1/jquery-ui.min.css">

  
</head>

<body>
<header id="header">
    <div class="container">
      <div class="logo float-left">
        
        <h1 class="text-light"><a href="#intro" class="scrollto"><span><?php echo "Hello!, " . $_SESSION['session_cus']['cus_name']; ?></span></a></h1>

      </div>        
      <nav class="main-nav float-right d-none d-lg-block">
        <ul>
              <li><a href="index.php">Home</a></li> 
              <li><a href="lib/logout.php" id="logout_btn">Logout</a></li>                
        </ul>
      </nav>
      <!-- .main-nav -->
      
    </div>
</header>
  <!-- #header --> 
<section id="services" class="section-bg" style="padding-top: 150px;">
  <div class="container">
  <table style="width:100%;" align="center">
  <tr>
    <th><button class="btn btn-success" id="profile-btn">Profile</button></th> 
    <th><button class="btn btn-success" id="npbookings-btn">My Newspaper Bookings</button></th>
    <th><button class="btn btn-success" id="adbookings-btn">My Advertisment Bookings</button></th>
  </tr>  
</table>
</div>
</section>

<!-- /////////////////////////////////Profile infomations///////////////////////////////////// -->

<div class="container">
	
  <div class="row">
    <fieldset class="for-panel" id="panel-profile">
      <legend>Profile Infomation</legend>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-horizontal">
              <label class="col-xs-5 control-label">Name:</label>
                <p class="form-control-static"><?php echo $cus_info["cus_name"]; ?></p>               
               <label class="col-xs-5 control-label">Phone Number: </label>
                <p class="form-control-static"><?php echo $cus_info["cus_mobile"]; ?></p>               
                <label class="col-xs-5 control-label">Address</label>
                  <p class="form-control-static"><?php echo $cus_info["cus_address"]; ?></p>
                 <label class="col-xs-4 control-label">Gender: </label>
                  	<p class="form-control-static"><?php if ($cus_info["cus_gender"]==1){
                        echo "Male";
                      }else{
                        echo "Female";
                      } ?></p>                        
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-horizontal">               
                  <label class="col-xs-4 control-label">Date Of Birth:</label>
                  	<p class="form-control-static"><?php echo $cus_info["cus_dob"]; ?></p>
                  <label class="col-xs-4 control-label">NIC Number:</label>
                  	<p class="form-control-static"><?php echo $cus_info["cus_nic"]; ?></p>
                  <label class="col-xs-4 control-label">Email:</label>
                  		<p class="form-control-static"><?php echo $cus_info["cus_email"]; ?></p>                
              </div>
             </div>
          </div>

        <!--  <a href="#Updatemodal" data-toggle="modal" class="btn btn-primary">
              Edit Details
            </a>  -->
        <!--  <a href="#updatepaswrd" data-toggle="modal" class="btn btn-primary">
              Update Password
            </a>  -->
        </fieldset>

        <!-- /////////////////////////////////np Booking infomations///////////////////////////////////// -->

        <fieldset class="for-panel" id="panel-npbookings">
          <legend>Newspaper Booking Infomation</legend>
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Booking Date</th>
                    <th scope="col">Newspaper</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Payment Slip</th>
                    <th scope="col">Slip approve Status</th>
                    <th scope="col">Full payment Status</th>


                  </tr>
                </thead>
                <tbody>
                  
                  <tr>
                    <td colspan="8" class="bg-info font-weight-bold" style="text-align:center;color:white;border-radius:30px;">
                      Newspaper Bookings
                    </td>
                  </tr>

                  <?php 
                    $sql_npbking = "SELECT np.newsp_id,np.newsp_name,cus.cus_id,npb.np_book_id,npb.np_book_qty,npb.order_date,npb.np_tot_price,npb.np_slip_img,npb.np_pay_status,npb.np_book_status FROM tbl_newspaper_booking npb
JOIN tbl_newspaper np ON np.newsp_id = npb.newsp_id
JOIN tbl_reg_customer cus ON cus.cus_id = npb.cus_id
WHERE npb.np_book_status=0 AND npb.np_pay_status=0 AND npb.cus_id = '$cus_id'"; 
                    $result_npbking = $dbobj->query($sql_npbking);
                    $nptotalPrice = 0;
                    $i=1;
                    while ($npbking= $result_npbking->fetch_assoc()) {
                      $nptotalPrice += $npbking['np_tot_price'];
                      $newspbking_id=$npbking['np_book_id'];
                     ?>
                     <tr>
                      <td ><?php echo $i; ?></td>
                      <td ><?php echo $npbking['order_date'] ?> </td>
                      <td ><?php echo $npbking['newsp_name'] ?> </td>
                      <td ><?php echo $npbking['np_book_qty'] ?> </td>
                      <th ><?php echo $npbking['np_tot_price'] ?> </td> 
                       <th >
                        <?php
                          if($npbking['np_slip_img'] == ""){
                        ?>
                        <form action="lib/mod_cus.php?type=uploadSlipNp&np_book_id=<?php echo $newspbking_id; ?>" enctype="multipart/form-data" method="post">
                                  <input type="file" name="imgup"  accept="image/*">
                                  <button type="submit" class="btn btn-primary btn-sm" name="upslip">Upload</button>
                                </form>
                                 <?php
                                  }else{
                                    echo "<i>Slip has already uploaded!</i>";
                                  }
                                ?>
                              </th>
                              <th scope="col"><?php if($npbking['np_book_status'] == 1){
                                echo "Approved";
                              }else{
                                echo "Approval Pending";
                              } ?>
                                
                              </th>

                              <th scope="col"><?php if($npbking['np_pay_status'] == 1){
                                echo "Approved";
                              }else{
                                echo "Approval Pending";
                              } ?>
                                
                              </th>    
                              
                            </tr>
                          <?php
                          $i++;
                      }

                  ?>
                </tbody>
              </table>
          
        </fieldset>
</div>
         <!-- /////////////////////////////////np Booking infomations End///////////////////////////////////// -->

        <!-- ////////////////////////////////ad Booking infomations///////////////////////////////////// -->

        <fieldset class="for-panel" id="panel-adbookings">
          <legend>Advertisment Booking Infomation</legend>
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Booking Date</th>
                    <th scope="col">Mode of Advertisment</th>
                    <th scope="col">Newspaper</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Payment Slip</th>
                    <th scope="col">Slip approve Status</th>
                    <th scope="col">Full payment Status</th>


                  </tr>
                </thead>
                <tbody>
                  

                  <tr>
                    <td colspan="8" class="bg-info font-weight-bold" style="text-align:center;color:white;border-radius:30px;">
                      Advertisment Bookings
                    </td>
                  </tr>
            <?php 
              $sql_bking = "SELECT adm.newsad_mode, np.newsp_name, cus.cus_id, adb.adpub_date,adb.ad_tot_price,adb.ad_img_slip,adb.ad_pay_status,adb.ad_book_status FROM tbl_ad_booking adb
JOIN tbl_newspaper np ON np.newsp_id=adb.newsp_id
JOIN tbl_news_ad_mode adm ON adm.newsad_mode_id = adb.newsad_mode_id
JOIN tbl_reg_customer cus ON cus.cus_id = adb.cus_id
WHERE adb.ad_pay_status=0 AND adb.ad_book_status=0 AND adb.cus_id = '$cus_id'"; 
                $result_bking = $dbobj->query($sql_bking);
                  $i=1;
                  $totalPrice = 0;
                  while ($bking= $result_bking->fetch_assoc()) {
                   $totalPrice += $bking['ad_tot_price'];
                   $ad_book_id=$bking['ad_book_id'];
                    ?>
                    <tr>
                      <td ><?php echo $i; ?></td>
                      <td ><?php echo $bking['adpub_date'] ?> </td>
                      <td ><?php echo $bking['newsad_mode'] ?> </td>
                      <td ><?php echo $bking['newsp_name'] ?> </td>
                     <th ><?php echo $bking['ad_tot_price'] ?> </td> 
                      <th ><?php
                         if($bking['ad_img_slip'] == ""){
                        ?>
                      <form action="lib/mod_cus.php?type=uploadSlipAd&ad_book_id=<?php echo $ad_book_id; ?>" enctype="multipart/form-data" method="post">
                        <input type="file" name="imgup" accept="image/*">
                          <button type="submit" class="btn btn-primary btn-sm" name="upslip">Upload</button>
                      </form>
                       <?php
                      }else{
                        echo "<i>Slip has already uploaded!</i>";
                      }
                        ?>
                       </th>
                        <th scope="col"><?php if($bking['ad_book_status'] == 1){
                                echo "Approved";
                              }else{
                                echo "Approval Pending";
                              } ?></th>

                         <th scope="col"><?php if($bking['ad_pay_status'] == 1){
                                echo "Approved";
                              }else{
                                echo "Approval Pending";
                              } ?></th>     
                              
                            </tr>
                          <?php
                          $i++;
                      }

                  ?>
                </tbody>
              </table>
          
        </fieldset>
</div>
         <!-- /////////////////////////////////Ad Booking infomations End///////////////////////////////////// -->




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
<script type="text/javascript">
  $("document").ready(function (){
    $("#panel-profile").show();
    $("#panel-npbookings").hide();
    $("#panel-adbookings").hide();
  });
  $("#profile-btn").click(function (){
    $("#panel-profile").show();
    $("#panel-npbookings").hide();
    $("#panel-adbookings").hide();
  });
  $("#npbookings-btn").click(function (){
    $("#panel-profile").hide();
    $("#panel-npbookings").show();
    $("#panel-adbookings").hide();
  });
  $("#adbookings-btn").click(function (){
    $("#panel-profile").hide();
    $("#panel-npbookings").hide();
    $("#panel-adbookings").show();
  });
</script>

<!-- JavaScript Libraries -->
    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/jquery/jquery-migrate.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/mobile-nav/mobile-nav.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Main Javascript File -->
    <script src="js/main.js"></script>

    <!-- login form -->
    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
  <!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
  <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
  <!--===============================================================================================-->
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
  <!--===============================================================================================-->
    <script src="vendor/countdowntime/countdowntime.js"></script>
  <!--===============================================================================================-->
<script src="scripts/jquery-ui-1.12.1/jquery-ui.min.js"></script>



</body>
</html>