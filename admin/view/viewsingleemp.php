<?php
require("../lib/mod_emp.php");
if (isset($_GET["empid"])){
	$empid = $_GET["empid"];
}
?>


<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="home.php">Dashboard</a>
  </li>
  <li class="breadcrumb-item" ><a href="#">Employee Management</a>
  </li>            
  <li class="breadcrumb-item active empid"><?php echo($empid); ?></li>
</ol>

          <form>
          	<div class="form-group row">
          		<label for="txteid" class="col-sm-2 col-form-label">Employee ID</label>
          		<div class="col-sm-3"><input type="text" class="form-control" id="txteid" name="txteid" value="<?php echo($empID); ?>" readonly="readonly"> 
          		</div>
          	</div>

          	<div class="form-group row"><label for="cmbtitle" class="col-sm-2 col-form-label">Title</label>
          		<div class="col-sm-3">
          			<select class="form-control" name="cmbtitle" id="cmbtitle">
          				<option>--Select Here--</option>
          				<option value="1">Mr.
          				</option>
          				<option value="2">Ms.
          				</option>
          				<option value="3">Dr.
          				</option>
          			</select>
          		</div>
          	</div>

          	<div class="form-group row">
          		<label for="txtname" class="col-sm-2 col-form-label">Name</label>
          		<div class="col-sm-9">
          			<input type="text" class="form-control" id="txtname" name="txtname" value="" placeholder="Employee Full Name">
          		</div>	
          	</div>

          	<div class="form-group row">
          		<label for="dtpdob" class="col-sm-2 col-form-label">Date of Birth</label>
          		<div class="col-sm-3">
          			<input type="text" id="dtpdob" class="form-control" name="dtpdob" readonly="readonly">	
          		</div>
          	</div>

          	<div class="form-group row">
          		<label for="" class="col-sm-2 col-form-label">Gender</label>
          		<div class="col-sm-3">
          			<div class="form-check">
          				<input type="radio" class="form-check-input" name="optgen" id="optmale" value="1">
          				<label for="optmale" class="form-check-lable">Male</label>
          			</div>
          			<div class="form-check">
          				<input type="radio" class="form-check-input" name="optgen" id="optfemale" value="0">
          				<label for="optfemale" class="form-check-lable">Female</label>
          			</div>
          		</div>
          	</div>

          	<div class="form-group row">
          		<label for="txtaddress" class="col-sm-2 col-form-label">Address</label>
          		<div class="col-sm-5">
          			<textarea class="form-control" id="txtaddress" name="txtaddress" cols="40" rows="4" placeholder="Employee Address">
          		</textarea>
          		</div>
          	</div>

          	<div class="form-group row">
          		<label for="txtmobile" class="col-sm-2 col-form-label">Mobile</label>
          		<div class="col-sm-3">
          			<input type="text" class="form-control" id="txtmobile" name="txtmobile" >
          		</div>
          	</div>

          	<div class="form-group row">
          		<label for="txtemail" class="col-sm-2 col-form-label">Email</label>
          		<div class="col-sm-4">
          			<input type="text" class="form-control" id="txtemail" name="txtemail" >
          		</div>
          	</div>

          	<div class="form-group row">
          		<label for="txtnic" class="col-sm-2 col-form-label">NIC</label>
          		<div class="col-sm-3">
          			<input type="text" class="form-control" id="txtnic" name="txtnic" >
          		</div>
          	</div>

          	<div class="form-group row">
          		<label for="dtpdoj" class="col-sm-2 col-form-label">Date of Join</label>
          		<div class="col-sm-3">
          			<input type="text"   class="form-control" id="dtpdoj" name="dtpdoj">
          		</div>
          	</div>

          	<div class="form-group row">
          		<div class="col-sm-2"></div>
          		<div class="col-sm-3">
          			<input type="button" class="btn btn-primary" id="btnupdate" name="btnupdate" value="Update">
          			<input type="button" class="btn btn-danger" id="btncancel" name="" value="Cancel">
          		</div>
          	</div>
          </form>

<script type="text/javascript">
	$(document).ready(function(){
		var empid = $.trim($(".empid").html());  //trim use for delete space
		var url = "lib/mod_emp.php?type=getEmployee";
		$.ajax({
			method:"POST",
			url:url,
			data:{empid:empid},
			dataType:"json",
			success:function(result){
				$("#cmbtitle").val(result.emp_title);
				$("#txtname").val(result.emp_name);
				$("#dtpdob").val(result.emp_dob);
				var gender = result.emp_gender;
				if(gender=="1")
					$("#optmale").attr('checked',true);
				else if(gender=="0")
					$("#optfemale").attr('checked',true);

				$("#txtaddress").val(result.emp_address);
				$("#txtmobile").val(result.emp_mobile);
				$("#txtemail").val(result.emp_email);
				$("#txtnic").val(result.emp_nic);
				$("#dtpdoj").val(result.emp_doj);
			},
			error:function(eobj,etxt,err){
				console.log(etxt);
			}
		});
	});
</script>