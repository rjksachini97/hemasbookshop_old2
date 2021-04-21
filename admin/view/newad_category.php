<?php
require("../lib/mod_ad_category.php");
$newID=getNewAdCatId();
?>

<script> 

$(function(){
$("#btnadd").click(function(){
  var category = $("#txtadcategory").val();

  if(category== 0){
        swal("Required Field ","Please Enter Category","error");
        return;
  }
  var fdata = $('form').serialize();
  var url = "lib/mod_ad_category.php?type=addNewAdCat";

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
        $("#lnknewadcategory").click();
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
  <li class="breadcrumb-item" ><a href="#">Ad Management</a></li>            
  <li class="breadcrumb-item active">New Ad Category</li>
</ol>

<!-- New Newspaer Form -->
<form>
  <div class="form-group row">
  	<label for="txtadcid" class="col-sm-2 col-form-label">Category ID</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" id="txtadcid" name="txtadcid" value="<?php echo($newID);?>" readonly="readonly">
      </div>
  </div>

  <div class="form-group row">
    <label for="txtadcategory" class="col-sm-2 col-form-label">Category</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" id="txtadcategory" name="txtadcategory" value="" placeholder="Enter Ad Category">
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

