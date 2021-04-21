<?php
require("header.php"); 
require("lib/mod_common.php");
if(!isset($_SESSION["user"])){
  header("Location:index.php");  //create session for block unauthirized person
}else if($_SESSION["user"]["type"]!="1"){
  header("Location:lib/route.php");
}
?>
<!-- Page Wrapper -->
<div id="wrapper">
  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php">
      
        <div><img src="../images/2.png" style="width: 150px"></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
      <a class="nav-link" href="home.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Nav Item - Newspaper Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNews" aria-expanded="true" aria-controls="collapseNews">
        <i class="fas fa-newspaper"></i>
        <span>Newspapaer Mgt</span>
      </a>  
      <div id="collapseNews" class="collapse" aria-labelledby="headingNews" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item menu" href="#" title="" id="lnknewnewspaper">New Newspaper</a>
              <a class="collapse-item menu" href="#" title="" id="lnkviewnewspaper">View Newspaper</a>
              <a class="collapse-item menu" href="#" title="" id="lnknewnewspapercategory">New Newspaper Category</a>
              <a class="collapse-item menu" href="#" title="" id="lnkviewnewspapercategory">View Newspaper Category</a>
              
          </div>
        </div>
    </li>

    <!-- Nav Item - Ad Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAd" aria-expanded="true" aria-controls="collapseAd">
        <i class="fas fa-ad"></i>
        <span>Ad Management</span>
      </a>
      <div id="collapseAd" class="collapse" aria-labelledby="headingAd" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item menu" href="#" title="" id="lnknewad">New Addvertisement</a>
            <a class="collapse-item menu" href="#" title="" id="lnkviewad">View Addvertisement</a> 
            <a class="collapse-item menu" href="#" title="" id="lnknewadcategory">New Ad Category</a>
            <a class="collapse-item menu" href="#" title="" id="lnkviewadcategory">View Ad Category</a>             
            <a class="collapse-item menu" href="#" title="" id="lnknewadcattype">New Ad Category Type</a>
            <a class="collapse-item menu" href="#" title="" id="lnkviewadcattype">View Ad Category Type</a>
            
          </div>
        </div>
    </li>

        <!-- Nav Item - Employee Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEmployee" aria-expanded="true" aria-controls="collapseEmployee">
        <i class="fas fa-user-tie"></i>
        <span>Employee Management</span>
      </a>  
      <div id="collapseEmployee" class="collapse" aria-labelledby="headingNews" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item menu" href="#" title="" id="lnknewemp">New Employees</a>
              <a class="collapse-item menu" href="#" title="" id="lnkviewemp">View Employees</a>
              <a class="collapse-item menu" href="#" title="" id="lnknewdelm">New Deliveryman</a>
              <a class="collapse-item menu" href="#" title="" id="lnkviewdelm">View Deliveryman</a>
          </div>
        </div>
    </li>

          <!-- Nav Item - User Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="true" aria-controls="collapseUser">
        <i class="fas fa-users"></i>
        <span>User Management</span>
      </a>  
      <div id="collapseUser" class="collapse" aria-labelledby="headingNews" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item menu" href="#" title="" id="lnknewacc">New User</a>
              <a class="collapse-item menu" href="#" title="" id="lnkviewuser">View User</a>
          </div>
        </div>
    </li>

            <!-- Nav Item - Customer Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCustomer" aria-expanded="true" aria-controls="collapseCustomer">
        <i class="fas fa-user"></i>
        <span>Customer Management</span>
      </a>  
      <div id="collapseCustomer" class="collapse" aria-labelledby="headingNews" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item menu" href="#" title="" id="lnknewcus">New Account</a>
              <a class="collapse-item menu" href="#" title="" id="lnkviewcus">View Customer</a>
          </div>
        </div>
    </li>

            <!-- Nav Item - Publication Company Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePC" aria-expanded="true" aria-controls="collapsePC">
        <i class="fas fa-building"></i>
        <span>Publication Com Mgt</span>
      </a>  
      <div id="collapsePC" class="collapse" aria-labelledby="headingNews" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item menu" href="#" title="" id="lnknewpc">New Publication Company</a>
              <a class="collapse-item menu" href="#" title="" id="lnkviewpc">View Publication Company</a>
          </div>
        </div>
    </li>

                <!-- Nav Item - Order Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrder" aria-expanded="true" aria-controls="collapseOrder">
        <i class="fas fa-box"></i>
        <span>Order Management</span>
      </a>  
      <div id="collapseOrder" class="collapse" aria-labelledby="headingNews" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item menu" href="#" title="" id="lnkviewnewsorder">View Newspaper Order</a>
              <a class="collapse-item menu" href="#" title="" id="lnkviewadorder">View Ad Order</a>
          </div>
        </div>
    </li>

           <!-- Nav Item - Booking Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBooking" aria-expanded="true" aria-controls="collapseBooking">
        <i class="fas fa-box-open"></i>
        <span>Booking Management</span>
      </a>  
      <div id="collapseBooking" class="collapse" aria-labelledby="headingNews" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item menu" href="#" title="" id="lnkviewnewsbooking">View Newspaper Booking</a>

              <a class="collapse-item menu" href="#" title="" id="lnkviewadbooking">View Ad Booking</a>
              
          </div>
        </div>
    </li>

                <!-- Nav Item - Payment & Billing Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePB" aria-expanded="true" aria-controls="collapsePB">
        <i class="fas fa-hand-holding-usd"></i>
        <span>Payment & Billing </span>
      </a>  
      <div id="collapsePB" class="collapse" aria-labelledby="headingNews" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item menu" href="#" title="" id="lnkviewadbookpay">Ad Booking Payments</a>
              <a class="collapse-item menu" href="#" title="" id="lnkviewnpbookpay">NP Booking Payments</a>
              <a class="collapse-item menu" href="#" title="" id="lnknewinvoice">New Invoice</a>
              <a class="collapse-item menu" href="#" title="" id="lnkviewinvoice">View Invoice</a>
              
          </div>
        </div>
    </li>


            <!-- Nav Item - Delivery Collapse Menu -->
<!--    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDeliveryMan" aria-expanded="true" aria-controls="collapseDeliveryMan">
        <i class="fas fa-truck"></i>
        <span>Delivery Management</span>
      </a>  
      <div id="collapseDeliveryMan" class="collapse" aria-labelledby="headingNews" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item menu" href="#" title="" id="lnknewdelm">New Deliveryman</a>
              <a class="collapse-item menu" href="#" title="" id="lnkviewdelm">View Deliveryman</a>
          </div>  
        </div>
    </li>
-->
            <!-- Nav Item - Stock Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStock" aria-expanded="true" aria-controls="collapseStock">
        <i class="fas fa-boxes"></i>
        <span>Stock Management</span>
      </a>  
      <div id="collapseStock" class="collapse" aria-labelledby="headingNews" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item menu" href="#" title="" id="lnkviewstock">View Stock</a>
             <!-- <a class="collapse-item menu" href="#" title="" id="lnknewstock">New Stock</a> -->   
          </div>
        </div>
    </li>

             <!-- Nav Item - GRN Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGRN" aria-expanded="true" aria-controls="collapseGRN">
        <i class="fas fa-list "></i>
        <span>GRN</span>
      </a>  
      <div id="collapseGRN" class="collapse" aria-labelledby="headingNews" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item menu" href="#" title="" id="lnkviewgrn">View GRN</a>
              <a class="collapse-item menu" href="#" title="" id="lnknewgrn">New GRN</a>    
          </div>
        </div>
    </li>



        <!-- Nav Item - Report Collapse Menu -->
       <li class="nav-item">
      <a class="nav-link collapsed" href="#" onclick="funViewRep()" >
        <i class="fas fa-chart-line"></i>
        <span>Reports</span>
      </a>  
      
    </li>

<!-- <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-target="#collapseReport" aria-expanded="true" aria-controls="collapseReport">
        <i class="fas fa-table"></i>
        <span>Reports</span>
      </a> 
      <div id="collapsePB" class="collapse" aria-labelledby="headingNews" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              
              <a class="collapse-item menu" href="#" title="" id="lnkviewreports">View Reports</a>
          </div>
        </div>     
    </li>   -->
   
  </ul>
  <!-- End of Sidebar -->

  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

  <!-- Main Content -->
  <div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

      <!-- Sidebar Toggle (Topbar) -->
      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
      </button>

      <!-- Topbar Navbar -->
      <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
          <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search fa-fw"></i>
          </a>
          <!-- Dropdown - Messages -->
          <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
            <form class="form-inline mr-auto w-100 navbar-search">
              <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell fa-fw"></i>
            <span class="badge badge-danger badge-counter"><?php getEmployeeCount(); ?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
            <?php getEmployeeList(); ?>
          </div>
        </li>
          
        </li>

        <!-- Nav Item - Messages -->
<!--        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-envelope fa-fw"></i>
-->
            <!-- Counter - Messages -->
<!--            <span class="badge badge-danger badge-counter">7</span>
          </a>
-->
          <!-- Dropdown - Messages -->
<!--          <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">Message Center</h6>
            <a class="dropdown-item d-flex align-items-center" href="#">
              <div class="dropdown-list-image mr-3">
                <img class="rounded-circle" src="" alt="">
                <div class="status-indicator bg-success"></div>
              </div>
              <div class="font-weight-bold">
                <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                <div class="small text-gray-500">Emily Fowler · 58m</div>
              </div>
            </a> 
            <a class="dropdown-item text-center small text-gray-500" href="#">Read More Mess</a>
          </div>
        </li>
-->

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->

        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php getUserName() ?></span>
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <!-- Dropdown - User Information -->
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
            </a>
          </div>
        </li>

      </ul>

    </nav>
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->   
      <div class="container-fluid" id="rpanel">
<!--        <?php //require("view/kpi.php");?>        -->
      
      <!-- Breadcrumbs-->
<div class="row d-sm-flex align-items-center justify-content-between mb-4">
  <div class="col-xl-8 col-lg-7">  <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">Overview</li>
    </ol></div>   
  <!-- Page Heading -->
<!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" id="btnallreports">
  <i class="fas fa-download fa-sm text-white-50"></i> Generate Report  </a>
  <script type="text/javascript">
$(document).ready(function(){
  $("#btnallreports").click(function(){
    window.open("reports/custom_report.php");
  });
});
</script>  -->
</div>  

<!-- Content Row -->
<div class="row">

              <!-- Active Users Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-3">Active Users</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php getActiveUserCount(); ?></div>
                      </div>
                    <div class="col-auto">
                      <i class="fas fa-user fa-2x text-gray-600"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>


              <!-- Redister Customers Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-3">Register Customers</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php getRegCustomerCount(); ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-600"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

              <!-- Orders Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-3"> Newspaper Orders</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php getNPOrderCount(); ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-cart-arrow-down fa-2x text-gray-600"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

              <!-- Out of Stocks Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-3">Out of Stocks</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php getOutofStockCount();?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-box-open fa-2x text-gray-600"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

      
</div>





      </div>

      </div>
      <!-- End of Main Content -->
    </div>

<?php
require("footer.php")
?>

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="index.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

   <script type="text/javascript">
     function  funViewRep() {    // view all reports
        $("#rpanel").load("view/view_reports.php");
    }
    
     $(".menu").click(function(){
      var item =$(this).attr("id"); // this page click id
      switch(item){
        case "lnknewemp":
          $("#rpanel").load("view/newemp.php");
          break;
        case "lnkviewemp":
          $("#rpanel").load("view/viewemp.php");
          break;
        case "lnknewacc":
          $("#rpanel").load("view/newuser.php");
          break;
        case "lnkviewuser":
          $("#rpanel").load("view/viewuser.php");
          break;
        case "lnknewcus":
          $("#rpanel").load("view/newcus.php");
          break;
        case "lnkviewcus":
          $("#rpanel").load("view/viewcus.php");
          break;
        case "lnknewdelm":
          $("#rpanel").load("view/newdel_man.php");
          break;
        case "lnkviewdelm":
          $("#rpanel").load("view/viewdel_man.php");
          break;
        case "lnknewnewspaper":
          $("#rpanel").load("view/newnewspaper.php");
          break;
        case "lnkviewnewspaper":
          $("#rpanel").load("view/viewnewspaper.php");
          break;
        case "lnknewnewspapercategory":
          $("#rpanel").load("view/newnewspaper_category.php");
          break;
        case "lnkviewnewspapercategory":
          $("#rpanel").load("view/viewnewspaper_category.php");
          break;
        case "lnknewpc":
          $("#rpanel").load("view/newpub_company.php");
          break;
        case "lnkviewpc":
          $("#rpanel").load("view/viewpub_company.php");
          break;
        case "lnknewseller":
          $("#rpanel").load("view/newseller.php");
          break;
        case "lnkviewseller":
          $("#rpanel").load("view/viewseller.php");
          break;
        case "lnknewad":
          $("#rpanel").load("view/newad.php");
          break;
        case "lnkviewad":
          $("#rpanel").load("view/viewad.php");
          break;
        case "lnknewadcategory":
          $("#rpanel").load("view/newad_category.php");
          break;
        case "lnkviewadcategory":
          $("#rpanel").load("view/viewad_category.php");
          break;
        case "lnknewadcattype":
          $("#rpanel").load("view/newadcat_type.php");
          break;
        case "lnkviewadcattype":
          $("#rpanel").load("view/viewadcat_type.php");
          break;
        case "lnkviewnewsorder":
          $("#rpanel").load("view/view_newspaper_order.php");
          break;
        case "lnkviewadorder":
          $("#rpanel").load("view/view_ad_order.php");
          break;
        case "lnkviewnewsorderpub":
          $("#rpanel").load("view/view_newspaper_order_pub.php");
          break;
        case "lnkviewadorderpub":
          $("#rpanel").load("view/view_ad_order_pub.php");
          break;
        case "lnkviewnewsbooking":
          $("#rpanel").load("view/view_np_booking.php");
          break;
        case "lnkviewadbooking":
          $("#rpanel").load("view/view_ad_booking.php");
          break;
        /*case "lnknewstock":
          $("#rpanel").load("view/new_stock.php");
          break;*/
        case "lnkviewstock":
          $("#rpanel").load("view/view_stock.php");
          break;
        case "lnknewgrn":
          $("#rpanel").load("view/new_grn.php");
          break;
        case "lnkviewgrn":
          $("#rpanel").load("view/view_grn.php");
          break;
        
        case "lnknewinvoice":
          $("#rpanel").load("view/new_invoice.php");
          break;
          case "lnkviewinvoice":
          $("#rpanel").load("view/view_invoice.php");
          break;
          case "lnkviewadbookpay":
          $("#rpanel").load("view/ad_booking_pay.php");
          break;
          case "lnkviewnpbookpay":
          $("#rpanel").load("view/np_booking_pay.php");
          break;

         /* case "lnkviewreports":
          $("#rpanel").load("view/view_reports.php");
          break;
*/









          




      }      
     });

     $(".notifi").click(function(){
      var empid = $(this).attr("title");
      $("#rpanel").load("view/viewsingleemp.php?empid="+empid);
     })


   </script>
