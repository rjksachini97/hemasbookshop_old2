<?php
require("header.php"); 
?>

<body class="bg-gray-200"  >
<div class="container" >
    
<div class="row justify-content-center">
  <div class="col-xl-5 col-lg-9 col-md-9" > 
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row ">
          <div class="p-5">
            <div class="text-center">
              <div align="center"><img src="../images/1.png" style="width: 100px"></div>
              <h1 class="h4 text-gray-900 mb-4">Sign in</h1>
            </div>
                  
            <form class="userr">
              <div class="form-group">
                <label class="text-gray-900" for="txtuname">Email</label>
                <input type="txtuname" class="form-control" id="txtuname" name="txtuname" " placeholder="Enter Email Address..." size="40">
              </div>
              <div class="form-group">
                <label class="text-gray-900" for="txtpass">Password</label>
                <input type="password" class="form-control" id="txtpass" name="txtpass" placeholder="Password">
              </div>
              <div class="form-group">
                <button type="button" class="btn btn-info btn-block" id="btnlogin">Login </button>
                <span style="display: none;" id="loading"><img width="30%" src="..//images/loading-3.gif" /></span>
              </div>     
            </form>
          </div>
        </div> 
      </div>
    </div>
  </div>
</div>
</div>


 

<script type="text/javascript">
  function manage_ctrl(arg){ // function for disable button
    if(arg=="0"){
      $("#loading").css("display","inline"); // change css to display
      $("#btnlogin").attr("disabled",true);  // To disabled login button after enter

    }else if(arg=="1"){
      $("#loading").css("display","none");
      $("#btnlogin").attr("disabled",false);
    }
  }

  $(document).ready(function(){
    $("#txtpass").keypress(function(e){  // function of key press
      if(e.which==13){  // 13 = asque value of enter
        $("#btnlogin").click();  // call to click function 
      };
    });

    $("#btnlogin").click(function(){
      manage_ctrl("0");
      var uname,pass;
      uname=$("#txtuname").val();
      pass=$("#txtpass").val();
      if(uname=="" || pass==""){
        swal("Login Error!", "Both username and Password must be filled", "error");  //this is from sweet alert
        manage_ctrl("1");
      }
      else{
        var fdata = $("form").serialize();
        var url = "lib/loginhandle.php";

        $.ajax({
          method:"POST",
          url:url,
          data:fdata,
          dataType:"text",
          success:function(result){
            manage_ctrl("1");
            if(result=="1")
              swal("Login Error","Invalid username or Password", "error");
            else if(result=="2")
              swal("Locked Account","Your Account has been disabled, please contact administrartor", "warning");
            else if(result=="3")
              location.href="lib/route.php";
            else
              alert(result);
          },
          error:function(eobj,etxt,err){
            console.log(etxt);
          }
        });
      }

    });
    

  });

</script>


  <!-- Bootstrap core JavaScript-->
  <script src="../sbadmin2/vendor/jquery/jquery.min.js"></script>
  <script src="../sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!--  Core plugin JavaScript-->
  <script src="../sbadmin2/vendor/jquery-easing/jquery.easing.min.js"></script>

<!--  Custom scripts for all pages-->
  <script src="../sbadmin2/js/sb-admin-2.min.js"></script> 

