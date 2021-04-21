<?php
require("../lib/mod_adcat_type.php");
$newID=getNewAdCatTypeId();
?> 

<script> 

$(function(){
$("#btnadd").click(function(){
  var category = $("#cmbadcategory").val();
  var typedescription = $("#txtadctdesc").val();

  if(typedescription== 0){
        swal("Required Field ","Please Enter valid Description","error");
        return;
  }
  var fdata = $('form').serialize();
  var url = "lib/mod_adcat_type.php?type=addNewAdCatType";

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
        $("#lnknewadcattype").click();
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
  <li class="breadcrumb-item active">New Ad Category Type</li>
</ol>

<!-- New Newspaer Form -->
<form>
  <div class="form-group row">
    <label for="txtadctypeid" class="col-sm-2 col-form-label"> Type ID</label>
      <div class="col-sm-3">
        <input type="text" class="form-control border-success" id="txtadctypeid" name="txtadctypeid" value="<?php echo($newID); ?>" readonly="readonly" >
      </div>
  </div>

  <div class="form-group row">
    <label for="cmbadcategory" class="col-sm-2 col-form-label">Category</label>
      <div class="col-sm-3">
        <select class="form-control border-success" name="cmbadcategory" id="cmbadcategory">
          <option>-- Select Ad Category --</option>
              <?php getCatType();?>
        </select>
      </div>
  </div>

  <div class="form-group row">
    <label for="txtadctdesc" class="col-sm-2 col-form-label">Type Description</label>
      <div class="col-sm-5">
        <input type="text" class="form-control border-success" id="txtadctdesc" name="txtadctdesc" value="" placeholder="Ad Type Description">
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


