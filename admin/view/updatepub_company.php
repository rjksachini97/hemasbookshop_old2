 <?php
 if(isset($_GET["pubid"])){   
 	$pubid = $_GET["pubid"];
 }
 ?>
 <script >
 	$(document).ready(function(){

  		var pcid = $("#txtpcid").val();
  		var url = "lib/mod_pub_company.php?type=getPubCom";
  		$.ajax({
  			method:"POST",
  			url:url,
  			data:{pubid:pcid},
  			dataType:"json",
  			success:function(result){
  				$("#txtpcname").val(result.pub_name);
  				$("#txtpcaddress").val(result.pub_address);
  				$("#txtpcmobile").val(result.pub_mobile);
  				$("#txtpcemail").val(result.pub_email);
  			},
  			error:function(eobj,etxt,err){
  				console.log(etxt);
  			}
  		});
 	});

  $(function(){
    $("#btnupdate").click(function(){
      var name  = $("#txtpcname").val();
  	  var address = $("#txtpcaddress").val();
  	  var mobile = $("#txtpcmobile").val();
  	  var email = $("#txtpcemail").val();

  	 
  	  var name_pattern=/^[a-zA-Z\.\s]+$/;
  	  if(!name.match(name_pattern)){
  	  	swal("Invalid Input","Please Enter Valid Name","error");
  	  	return;
  	  }

  	  if(address==0){
  	  	swal("Required Field","Please Enter valid Address","error");
  	  	return;
  	  }

  	  var email_pattern = /^[a-zA-Z\d\.\_]+\@[a-zA-Z\d\.\-]+\.[a-zA-Z]{2,4}$/;

  	  if (!email.match(email_pattern)){
  	  	swal("Invalid Input","Please Enter Valid Email Address","error");
  	  	return;
  	  }


      swal({
        title:"Do you want to update this record?",
        text:"You are trying to update:"+pcid,
        icon:"warning",
        buttons:true,
        dangerMode:true
      }).then((willDelete)=>{
        if(willDelete){
          var fdata = $('form').serialize();
          var url = "lib/mod_pub_company.php?type=updatePubCom";
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
              $("#lnkviewpc").click();
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
    $("#lnkviewpc").click();
  });
  });
  
</script>

<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="home.php">Dashboard</a>
  </li>
  <li class="breadcrumb-item" ><a href="#">Publication Company Management</a></li>            
  <li class="breadcrumb-item active">Publication Company</li>
</ol>

<!-- New publication company  form-->
         
<form>
  <div class="form-group row">
    <label for="txtpcid" class="col-sm-2 col-form-label">Company ID</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="txtpcid" name="txtpcid" value="<?php echo($pubid); ?>" readonly="readonly">
    </div>
  </div>

  <div class="form-group row">
    <label for="txtpcname" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="txtpcname" name="txtpcname" value="" placeholder="Publication Company Name">
    </div>
  </div> 

 <div class="form-group row">
    <label for="txtpcaddress" class="col-sm-2 col-form-label">Address</label>
    <div class="col-sm-5">
      <input type="text" id="txtpcaddress" class="form-control" name="txtpcaddress" placeholder="Enter Address">
    </div>
  </div>

  <div class="form-group row">
    <label for="txtpcmobile" class="col-sm-2 col-form-label">Mobile</label>
                
    <div class="col-sm-3">
      <input type="text" id="txtpcmobile" class="form-control" name="txtpcmobile" placeholder="Enter Mobile Number">
    </div>
  </div>

  <div class="form-group row">
    <label for="txtpcemail" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-3">
      <input type="text" id="txtpcemail" class="form-control" name="txtpcemail" placeholder="Enter  Email Address">
    </div>
  </div>
              
  <div class="form-group row">
    <div class="col-sm-2"></div>
    <div class="col-sm-3">
      <input type="button" id="btnupdate" class="btn btn-success" name="btnupdate" value="Update">
      <input type="button" class="btn btn-danger" id="btncancel" name="" value="Cancel">
    </div>
  </div>
              
              

             
</form>