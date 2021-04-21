 <?php
 if(isset($_GET["delmid"])){  
 	$delmid = $_GET["delmid"];
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
        
    		$("#dtpdoj").datepicker({
    		  changeMonth:true,
    		  changeYear:true,
    		  dateFormat:"yy-mm-dd",
    		  maxDate:"0"
    		});

  		var dmid = $("#txtdelmid").val();
  		var url = "lib/mod_delman.php?type=getDel";
  		$.ajax({
  			method:"POST",
  			url:url,
  			data:{delmid:dmid},
  			dataType:"json",
  			success:function(result){
  				$("#cmbdelmtitle").val(result.delm_title);
  				$("#txtdelmname").val(result.delm_name);
  				$("#dtpdob").val(result.delm_dob);
  				var gender = result.delm_gender;
  				if(gender=="1")
  					$("#optmale").attr('checked',true);
  				else if(gender=="0")
  					$("#optfemale").attr('checked',true);
  				
  				$("#txtdelmaddress").val(result.delm_address);
  				$("#txtdelmmobile").val(result.delm_mobile);
  				$("#txtdelmemail").val(result.delm_email);
  				$("#txtdelmnic").val(result.delm_nic);
  				$("#dtpdoj").val(result.delm_doj);
  			},
  			error:function(eobj,etxt,err){
  				console.log(etxt);
  			}
  		});
 	});

  $(function(){
    $("#btnupdate").click(function(){
      var dmid   =$("#txtdelmid").val(); 
      var title = $("#cmbdelmtitle").val();
      var name  = $("#txtdelmname").val();
      var dob = $("#dtpdob").val();
      var gender = $("input[name='optgen']:checked").length;
      var address = $("#txtdelmaddress").val();
      var mobile = $("#txtdelmmobile").val();
      var email = $("#txtdelmemail").val();
      var nic = $("#txtdelmnic").val();
      var doj = $("#dtpdoj").val();

      if(title==""){
        swal("Invalid Input","Please Select The Title","error");
        return;
      }
      var name_pattern=/^[a-zA-Z\.\s]+$/;

      if(!name.match(name_pattern)){
        swal("Invalid Input","Please Enter Valid Name","error");
        return;
      }
      var date_pattern=/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/;
      if(!dob.match(date_pattern)){
        swal("Invalid Input","Please Enter Valid Date","error");
        return;
      }

      if(gender== 0){
        swal("Required Field ","Please Select Gender","error");
        return;
      }
      if(address== 0){
        swal("Required Field ","Please Enter Valid Address","error");
        return;
      }

      var email_pattern = /^[a-zA-Z\d\.\_]+\@[a-zA-Z\d\.\-]+\.[a-zA-Z]{2,4}$/;

      if(!email.match(email_pattern)){
        swal("Invalid Input","Please Enter Valid Email Address","error");
        return;
      }


      swal({
        title:"Do you want to update this record?",
        text:"You are trying to update:"+dmid,
        icon:"warning",
        buttons:true,
        dangerMode:true
      }).then((willDelete)=>{
        if(willDelete){
          var fdata = $('form').serialize();
          var url = "lib/mod_delman.php?type=updateDel";
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
              $("#lnkviewdelm").click();
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
    $("#lnkviewdelm").click();
  });
  });


  /**/
</script>

 <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="home.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item" ><a href="#">Deliveryman Management</a></li>            
            <li class="breadcrumb-item active">Update Deliveryman</li>
          </ol>

          <!-- Update employee form-->

          <form>
            <div class="form-group row">
              <label for="txtdelmid" class="col-sm-2 col-form-label">Deliveryman ID</label>
              <div class="col-sm-3">
                <input type="text" class="form-control" id="txtdelmid" name="txtdelmid" value="<?php echo($delmid); ?>" readonly="readonly">
              </div>
            </div>

            <div class="form-group row">
              <label for="cmbdelmtitle" class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-3">
                <select class="form-control" name="cmbdelmtitle" id="cmbdelmtitle">
                    <option>-- Select --</option>
                    <option value="1">Mr.</option>
                    <option value="2">Ms.</option>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="txtdelmname" class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" id="txtdelmname" name="txtdelmname" value="" placeholder="Deliveryman Full Name">
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
              <label for="txtdelmaddress" class="col-sm-2 col-form-label">Address</label>
              <div class="col-sm-3">
                <input type="text" id="txtdelmaddress" class="form-control" name="txtdelmaddress" placeholder="Enter Your Address">
              </div>
            </div>

            <div class="form-group row">
              <label for="txtdelmmobile" class="col-sm-2 col-form-label">Mobile</label>
                          
              <div class="col-sm-3">
                <input type="text" id="txtdelmmobile" class="form-control" name="txtdelmmobile" placeholder="Enter Your Mobile Number">
              </div>
            </div>

            <div class="form-group row">
              <label for="txtdelmemail" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-3">
                <input type="text" id="txtdelmemail" class="form-control" name="txtdelmemail" placeholder="Enter Your Email Address">
              </div>
            </div>

            <div class="form-group row">
                <label for="txtdelmnic" class="col-sm-2 col-form-label">NIC</label>
                <div class="col-sm-3">
                    <input type="text" id="txtdelmnic" class="form-control" name="txtdelmnic" placeholder="Enter Your NIC Here">
                </div>
            </div>

            <div class="form-group row">
                <label for="dtpdoj" class="col-sm-2 col-form-label">Date of Join</label>
                <div class="col-sm-3">
                    <input type="text" id="dtpdoj" class="form-control" name="dtpdoj" >
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
         
           