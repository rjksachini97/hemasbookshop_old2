<?php
require("header.php");
require("mod_register.php");
?>
<script >
   
  $(function(){
    $("#btnreg").click(function(){ 
      var uname=$("#txtusername").val();
      var email = $("#txtemail").val();
      var pass=$("#txtpass").val();
      var rpass=$("#txtrepeatpasse").val();

        if(uname==""){
          swal("Incomplete input","Please Enter First Name","error");
          return;
        }else if(lname==""){
          swal("Incomplete input","Please Enter Last Name","error");
          return;
        }

        var email_pattern = /^[a-zA-Z\d\.\_]+\@[a-zA-Z\d\.\-]+\.[a-zA-Z]{2,4}$/;

        if(!email.match(email_pattern)){
          swal("Invalid Input","Please Enter valid email address","error");
        return;
        }

         if(pass==""){
          swal("Incomplete input","Please Enter Valid Password","error");
          return;
        }else if(rpass==""){
          swal("Incomplete input","Please Repeat Password","error");
          return;
        }

      var fdata = $('form').serialize();
      var url = "mod_register.php?type=addNewUser";

      $.ajax({

      method:"POST",
      url:url,
      data:fdata,
      dataType:"text",
      success:function(result){
        res = result.split(",");
        if(res[0]=="0"){
          swal("Error",res[1],"error")
        }
        else if(res[0]=="1"){
          swal("Success",res[1],"success");
          $("#lnknewregacc").click();
        }
      },
      error:function(eobj,etxt,err){
        console.log(etxt);
      }

      });
   
    });
  });
</script>

<body class="bg-gradient-success">
  <div class="container">

<div class="row justify-content-center">

      <div class="col-xl-5 col-lg-9 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              
               
                <div class="p-5">

                  <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form class="userr">
                <div class="form-group">
                    <input type="txtusername" class="form-control " id="txtusername"" name="txtusername"  placeholder="Enter User Name">
                  
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" id="txtemail"" name="txtemail"  placeholder="Enter Email Address">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control " id="txtpass"" name="txtpass"  placeholder="Enter Password">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control " id="txtrepeatpass"" name="txtrepeatpass"  placeholder="Repeat Password">
                  </div>
                </div>
                <div class="form-group">
              <button type="button" class="btn btn-success btn-block" id="btnreg" name="btnreg">Register Account </button>
              <button type="button" class="btn btn-danger btn-block" id="btncancel" name="btncancel" value="">Cancel</button> 
              <span style="display: none;" id="loading"><img width="30%" src="..//images/loading-4.gif" /></span>
           </div>  
              
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="forgotpassword.php">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="index.php">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

<script type="text/javascript">
     $(".menu").click(function(){
      var item =$(this).attr("id"); // this page click id
      switch(item){
        case "lnknewregacc":
          $("#rpanel").load("view/register.php");
          break;
        //case "lnkviewregacc":
          //$("#rpanel").load("view/register.php");
          //break;
      }      
     });
   </script>

