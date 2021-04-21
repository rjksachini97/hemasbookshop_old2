 <?php  
 if(isset($_GET["cusid"])){
 	$cusid = $_GET["cusid"];
 }
 ?>
 <script >
 	$(document).ready(function(){
 		
    		$("#dtpdob").datepicker({
      			changeMonth:true,
      			changeYear:true,
      			dateFormat:"yy-mm-dd",
      			maxDate:"-6570"
    		});

  		var cid = $("#txtcid").val();
  		var url = "lib/mod_customer.php?type=getCus";
  		$.ajax({
  			method:"POST",
  			url:url,
  			data:{cusid:cid},
  			dataType:"json",
  			success:function(result){
  				$("#txtname").val(result.cus_name);
  				$("#dtpdob").val(result.cus_dob);
  				var gender = result.cus_gender;
  				if(gender=="1")
  					$("#optmale").attr('checked',true);
  				else if(gender=="0")
  					$("#optfemale").attr('checked',true);
  				

  				$("#txtaddress").val(result.cus_address);
  				$("#txtmobile").val(result.cus_mobile);
  				$("#txtemail").val(result.cus_email);
  				$("#txtnic").val(result.cus_nic);
  			},
  			error:function(eobj,etxt,err){
  				console.log(etxt);
  			}
  		});
 	});

  $(function(){
    $("#btnupdate").click(function(){
      var cid   =$("#txtcid").val();
      var name = $("#txtname").val();
      var dob = $("#dtpdob").val();
      var gender = $("input[name='optgen']:checked").length;
      var address = $("#txtaddress").val();
      var mobile = $("#txtmobile").val();
      var email = $("#txtemail").val();
      var nic = $("#txtnic").val();

      
      var name_pattern=/^[a-zA-Z\.\s]+$/;

      if(!name.match(name_pattern)){
        swal("Invalid Input","Please enter valid name","error");
        return;
      }
      var date_pattern=/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/;
      if(!dob.match(date_pattern)){
        swal("Invalid Input","Please Enter valid date","error");
        return;
      }

      if(gender== 0){
        swal("Required Field ","Please Select Gender","error");
        return;
      }
      if(address== 0){
        swal("Required Field ","Please enter valid address","error");
        return;
      }

      var email_pattern = /^[a-zA-Z\d\.\_]+\@[a-zA-Z\d\.\-]+\.[a-zA-Z]{2,4}$/;

      if(!email.match(email_pattern)){
        swal("Invalid Input","Please Enter valid email address","error");
        return;
      }


      swal({
        title:"Do you want to update this record?",
        text:"You are trying to update:"+cid,
        icon:"warning",
        buttons:true,
        dangerMode:true
      }).then((willDelete)=>{
        if(willDelete){
          var fdata = $('form').serialize();
          var url = "lib/mod_customer.php?type=updateCus";
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
              $("#lnkviewcus").click();
            }
          },
          error:function(eobj,etxt,err){
            console.log(etxt);
          }
          });
        }
         
        });

  });

  // function for cancel button
  $("#btncancel").click(function(){
    $("#lnkviewcus").click();
  });
  });


  /**/
</script>

 <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="home.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item" ><a href="#">Customer Management</a></li>            
            <li class="breadcrumb-item active">Update Customer</li>
          </ol>

          <!-- Update employee form-->
         
           <form>
              <div class="form-group row">
                <label for="txtcid" class="col-sm-2 col-form-label">Customer ID</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="txtcid" name="txtcid" value="<?php echo($cusid); ?>" readonly="readonly">
                </div>
              </div>

              <div class="form-group row">
                <label for="txtname" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="txtname" name="txtname" value="" placeholder="Employee Full Name">
                </div>
              </div> 
              
              <div class="form-group row">
                <label for="dtpdob" class="col-sm-2 col-form-label">Date Of Birth</label>
                <div class="col-sm-3">
                  <input type="text" id="dtpdob" class="form-control" name="dtpdob" readonly="readonly">
                </div>
              </div>
              <div class="form-group row">
                <label for=""  class="col-sm-2 col-form-label">Gender</label>
                <div class="col-sm-5">
                  <div class="form-check form-check-inline"> <!-- for align button and label -->
                    <input type="radio" class="form-check-input" name="optgen" id="optmale" value="1" >
                    <label for="optmale" class="form-check-label">Male</label>
                  </div>
                  <div class="form-check form-check-inline"> <!-- for align button and label -->
                    <input type="radio" class="form-check-input" name="optgen" id="optfemale" value="0" >
                    <label for="optfemale" class="form-check-label" >Female</label>
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <label for="txtaddress" class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-3">
                  <input type="text" id="txtaddress" class="form-control" name="txtaddress" placeholder="Enter Your Address">
                </div>
              </div>

              <div class="form-group row">
                <label for="txtmobile" class="col-sm-2 col-form-label">Mobile</label>
                
                <div class="col-sm-3">
                  <input type="text" id="txtmobile" class="form-control" name="txtmobile" placeholder="Enter Your mobile number">
                </div>
              </div>

              <div class="form-group row">
                <label for="txtemail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-3">
                  <input type="text" id="txtemail" class="form-control" name="txtemail" placeholder="Enter Your Email Address">
                </div>
              </div>

              <div class="form-group row">
                <label for="txtnic" class="col-sm-2 col-form-label">NIC</label>
                <div class="col-sm-3">
                  <input type="text" id="txtnic" class="form-control" name="txtnic" placeholder="Enter Your NIC here">
                </div>
              </div>
              
              <div class="form-group row">
                <div class="col-sm-2"></div>
                <div class="col-sm-3">
                  <input type="button" class="btn btn-success"id="btnupdate" name="btnupdate" value="Update">
                  <input type="button" class="btn btn-danger" id="btncancel" name="" value="Cancel">
                </div>
              </div>
           </form>
           