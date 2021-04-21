<?php  
  require("lib/mod_cus.php");
   ?> 

<script>

$(function(){
  $("#dtpdob").datepicker({
    changeMonth:true,
    changeYear:true,
    dateFormat:"yy-mm-dd",
    maxDate:"-6570" 
  });
});
 $(function(){
    $("#btnreg").click(function(){
      var name = $("#txtname").val();
      var mobile = $("#txtmob").val();
      var address = $("#txtaddress").val();
      var gender = $("input[name='optgen']:checked").length;
      var dob = $("#dtpdob").val();
      var nic = $("#txtnic").val();
      var email = $("#txtemail").val();
      var pswd = $("#txtformpass").val();
      var cpass = $("#txtformcpass").val();

      var name_pattern = /^[a-zA-Z\.\s]+$/;

      if (!name.match(name_pattern)){
        swal("Empty Input","Please enter a valid name","error");
        return;
      }

      var mobile_no = /^[0]{1}[\d]{9}$/;
      var mobile_no2 = /^[+]{1}[/d]{11}$/;

      if(!mobile.match(mobile_no2) && !mobile.match(mobile_no) ){
        //alert(mobile)
        swal("Invalid mobile number","Please enter a valid number","error");
        return;
      }

      if(address == ""){
        swal("Required Field","Please enter the address","error");
        return;
      }

      if(gender == 0){
        swal("Required Field","Please select Gender","error");
        return;
      }

      var date_pattern = /^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/;
      if (!dob.match(date_pattern)){
        swal("Invalid Input","Please Enter a valid Date","error");
        return;
      }

      var email_pattern = /^[a-zA-Z\d\.\_]+\@[a-zA-Z\d\.\-]+\.[a-zA-Z]{2,4}$/;  

      if (!email.match(email_pattern)){
        swal("Invalid input", "Please enter a valid email address","error");
        return;
      }

      var nid =/^[0-9]{9}[VvXx]{1}/;
      var nid2 =/^[0-9]{12}/;

      if (!nic.match(nid) && !nic.match(nid2)){
        swal("Invalid ID number", "Please enter a valid ID number", "error");
        return;
      }

      if(pswd!=cpass){
        swal("Invalid Input", "Password not match", "error");
        return;
      }

      if(pswd.length <= 8){
        swal("Password is too short", "Password should be more than 8 charactors", "error");
        return;
      }

      //validate with DB
      var fdata = $('#signupform').serialize();
      var url = "lib/mod_cus.php?type=addNewCus";

      $.ajax({
        method:"POST",
        url:url,
        data:fdata,
        dataType:"text",
          success: function(result) {
                      swal("Registered", "Account created successfully!", 
                        "success");
                    setTimeout(function(){window.location.reload(); }, 1000);
                      },
          error:function(eobj,etxt,err){
            console.log(etxt);
          }
        }); 
    });
    });   
           //login function
    $(function(){
    $("#loginform").submit(function(e){
      e.preventDefault();
      var url = "lib/mod_log.php";
      var fdata = $('#loginform').serialize();
      $.ajax({
        method:"POST",
        url:url,
        data:fdata,
        dataType:"text",
        success: function(result) {
          if(result==1){
            location.href="lib/route.php";
          }else{
            swal("Error", "Incorrect Username or Password!", "error");
          }
        },
        error:function(eobj,etxt,err){
          console.log(etxt);
        }
      });

  });

   
    }); 
     

  
   
    


</script> 

    <!-- ======= Why Us Section ======= -->

    <!--Account Login  -->
    <section id="why-us" class="why-us">
      <div class="container-fluid" data-aos="fade-up">

        <header class="section-header">
          <h3>Account Login</h3>
        </header>

       <div class="row">

     <div class="container" >
    
<div class="row justify-content-center">
  <div class="col-xl-5 col-lg-9 col-md-9" > 
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">  
        <!-- Nested Row within Card Body -->
        <div class="row ">
          <div class="p-5">
            <div class="text-center">
              <div align="center"><img src="images/1.png" style="width: 100px"></div>
            </div>
                  
            <form class="login100-form validate-form" id="loginform" method="post" action="lib/mod_log.php" >
              <div class="form-group validate-input" data-validate="Valid email is required: abc@sd.xyz">
                <label class="text-gray-900" for="txtuname">Email</label>
                <input type="txtuname" class="form-control" id="txtuname" name="txtuname" " placeholder="Enter Email Address..." size="40">
              </div>
              <div class="form-group validate-input" data-validate="Valid email is required">
                <label class="text-gray-900" for="txtpass">Password</label>
                <input type="password" class="form-control" id="txtpass" name="txtpass" placeholder="Password">
              </div>
              <div class="form-group">
                <button class="btn btn-primary btn-block" id="btnlogin" type="submit" value="submit" >Login </button>
                <span style="display: none;" id="loading"><img width="30%" src="images/spinner.gif" /></span>
              </div>     
            </form>
            <hr>
              <div class="text-center">
                <span class="txt1">Create an Account!</span>
                <a href="#loginModalForm" data-toggle="modal" class="txt2 hov1" >Sign up</a> 
              </div>
          </div>
        </div> 
      </div>
    </div>
  </div>
</div>
</div>

</div>
<!-- End Account Login -->


<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////-->


<!--Login form -->
    <!--Modal -->
    <div class="modal fade" id="loginModalForm" tabindex="1" role="dialog" aria-labelledby="loginModalFormCenterTitle" araia-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="loginModalFormTitle">Sign Up</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="close" id="close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
            <!--form-->
            <div class="container">
              <form id="signupform">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="txtname">Name</label>
                    <input type="text" class="form-control" name="txtname" id="txtname" placeholder="Type your name here">
                  </div>
                  <div class="form-group com-md-6">
                    <label for="txtmob">Mobile No</label>
                    <input type="text" class="form-control" name="txtmob" id="txtmob" placeholder="0711234567">
                  </div>
                </div>
                  <div class="form-group">
                    <label for="txtaddress">Address</label>
                    <textarea type="text" class="form-control" name="txtaddress" id="txtaddress" placeholder="Type your address here"></textarea> 
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                    <label for="">Gender</label>
                    <div class="form-row-md-6">
                    <div class="form-check">
                      <input type="radio" class="form-check-input" name="optgen" id="optmale" value="1">
                      <label for="optmale" class="form-check-label">Male</label>
                    </div>
                    <div class="form-check">
                      <input type="radio" class="form-check-input" name="optgen" id="optfemale" value="0">
                      <label for="optfemale" class="form-check-label">Female</label>
                    </div>
                    </div>
                    </div>
                  <div class="form-group col-md-6">
                    <label for="dtpdob">Date of Birth</label>
                    <div class="col-sm-6">
                      <input type="text" id="dtpdob" class="form-control"  name="dtpdob" readonly="readonly">
                    </div>
                  </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="txtnic">NIC</label>
                      <input type="text" name="txtnic" id="txtnic" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="txtemail">Email</label>
                      <input type="text" name="txtemail" id="txtemail" class="form-control" placeholder="abc@gmail.com">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="txtpass">Password</label>
                      <input type="password" name="txtformpass" id="txtformpass" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="txtcpass">Confirm Password</label>
                      <input type="password" name="txtformcpass" id="txtformcpass" class="form-control">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <input type="reset" class="btn btn-default">
                    <input type="button" class="btn btn-primary" value="Register" name="btnreg" id="btnreg">
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>  


<!--End login form -->
