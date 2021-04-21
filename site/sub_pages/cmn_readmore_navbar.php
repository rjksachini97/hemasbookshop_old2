<header id="header">

    <div class="container">

      <div class="logo float-left">
        <!-- Uncomment below if you prefer to use an image logo -->
        <h1 class="text-light"><a href="#intro" class="scrollto"><span>Hemas Bookshop</span></a></h1>
        <!-- <a href="#header" class="scrollto"><img src="img/favicon.png" alt="" class="img-fluid"></a> -->
      </div>
        
      <nav class="main-nav float-right d-none d-lg-block">
        <ul>
          <li><a href="../index.php">Home</a></li>
          <li><a href="adbooking.php">Advertisment booking</a></li>
          <li><a href="newspaperbooking.php">Newspaper Booking</a></li> 

              <?php
                if(isset($_SESSION['session_cus'])){
              ?>
              

              <li class="dropdown"><a href="#why-us" data-toggle="dropdown"><?php echo "Hi!, " . $_SESSION['session_cus']['cus_name']; ?></a></li>
                  
                      <li><a href="">Profile</a></li>
                      <li><a href="../lib/logout.php" id="logout_btn">Logout</a></li>                       
              <?php
                }
              ?>
        </ul>
      </nav><!-- .main-nav -->
      
    </div>
  </header><!-- #header --> 

   <!-- navigatinon menu my account button function for dropdown -->
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
                            window.location = "../lib/logout.php";
                          }
                        });
              });
            });
            </script>