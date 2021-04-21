<?php
require("../lib/mod_newspaper.php"); 
$newID=getNewNewsPaperId();
?>
 
<script>

$(function(){
$("#btnadd").click(function(){
  var pubcategory = $("#cmbnewspub").val();
  var category = $("#cmbnpcategory").val();
  var name = $("#txtnpname").val();
  var medium = $("#cmbmedium").val();
  var price = $("#txtnpprice").val();
  var rlevel = $("#nprlevel").val();

  if (pubcategory==""){
    swal("Invalid Input","Please Select the Publication Company","error");
    return;
  }

  if (category==""){
    swal("Invalid Input","Please Select the Category","error");
    return;
  }

  var name_pattern=/^[a-zA-Z\.\s]+$/;

  if(!name.match(name_pattern)){
      swal("Invalid Input","Please Enter Valid Newspaper Name","error");
    return;
  }

  if (medium==""){
    swal("Invalid Input","Please Select the Medium","error");
    return;
  }

   if (price==""){
    swal("Invalid Input","Please Enter the Newspaper Price","error");
    return;
  }

  if (rlevel==""){
    swal("Invalid Input","Please Enter the Newspaper Reach Level","error");
    return;
  }

  var fdata = $('form').serialize();
  var url = "lib/mod_newspaper.php?type=addNewNewsPaper";

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
        $("#lnknewnewspaper").click();
      }
    },
    error:function(eobj,etxt,err){
    console.log(etxt);
    }
  });
  });
});
	
</script> 

<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="home.php">Dashboard</a>
  </li>
  <li class="breadcrumb-item" ><a href="#">Newspaper Management</a></li>            
  <li class="breadcrumb-item active">New Newspaper</li>
</ol>

<!-- New Newspaer Form -->
<h3 class="h3" >Add Newspapers</h3>
<hr>  
      

<form>
  <div class="form-group row">
  	<label for="txtnpid" class="col-sm-2 col-form-label">Newspaper ID</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" id="txtnpid" name="txtnpid" value="<?php echo($newID); ?>" readonly="readonly">
      </div>
  </div>

  <div class="form-group row">
    <label for="cmbnewspub" class="col-sm-2 col-form-label">Publication Company</label>
      <div class="col-sm-3">
        <select class="form-control" name="cmbnewspub" id="cmbnewspub">
          <option>-- Select Company --</option>
              <?php getPubCategories(); ?>
        </select>
      </div>
  </div>

  <div class="form-group row">
    <label for="cmbnpcategory" class="col-sm-2 col-form-label">Category</label>
      <div class="col-sm-3">
        <select class="form-control" name="cmbnpcategory" id="cmbnpcategory">
          <option>-- Select Newspaper --</option>
              <?php getCategories(); ?>
        </select>
      </div>
  </div>

  <div class="form-group row">
    <label for="txtnpname" class="col-sm-2 col-form-label">Name</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="txtnpname" name="txtnpname" value="" placeholder="Newspaper Name">
      </div>
  </div>

  <div class="form-group row">
                <label for="cmbmedium" class="col-sm-2 col-form-label">Medium</label>
                <div class="col-sm-3">
                  <select class="form-control" name="cmbmedium" id="cmbmedium">
                    <option>-- Select Medium--</option>
                      <?php getMedium(); ?>
                  </select>
                </div>
              </div>

  <div class="form-group row">
    <label for="txtnpprice" class="col-sm-2 col-form-label">Price</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="txtnpprice" name="txtnpprice" value="0.00" placeholder="Newspaper Price">
      </div>
  </div>

   <div class="form-group row">
    <label for="nprlevel" class="col-sm-2 col-form-label">Reach Level</label>
      <div class="col-sm-5">
        <input type="number" class="form-control" id="nprlevel" name="nprlevel" value="1" min="1" placeholder="">
      </div>
  </div>  
         
  <div class="form-group row">
    <div class="col-sm-2"></div>
    <div class="col-sm-3">
      <input type="button" id="btnadd" class="btn btn-success" name="btnadd" value="Add">
      <input type="reset" class="btn btn-danger" name="">
    </div>
  </div>            
</form>  

