<?php 
require("../lib/mod_newspaper_category.php");
$catnewID=getNewNewsPaperCatId();
?> 

<script>

$(function(){
$("#btnadd").click(function(){
  var category = $("#txtnpcategory").val();
  var description = $("#txtnpcategorydesc").val();

  if (category==""){
    swal("Invalid Input","Please Select the Category ","error");
    return;
  }
  if(description== 0){
        swal("Required Field ","Please Enter valid Description","error");
        return;
  }
  /*var date_pattern=/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/;
  if(!dop.match(date_pattern)){
    swal("Invalid Input","Please Enter Valid Date","error");
  return;
  }*/
  var fdata = $('form').serialize();
  var url = "lib/mod_newspaper_category.php?type=addNewNewsPaperCat";

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
        $("#lnknewnewspapercategory").click();
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
  <li class="breadcrumb-item active">New Newspaper Category</li>
</ol>

<!-- New Newspaer Form -->
<form>
  <div class="form-group row">
  	<label for="txtnpcid" class="col-sm-2 col-form-label">Category ID</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" id="txtnpcid" name="txtnpcid" value="<?php echo($catnewID);?>" readonly="readonly">
      </div>
  </div>

  <div class="form-group row">
    <label for="txtnpcategory" class="col-sm-2 col-form-label">Category</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" id="txtnpcategory" name="txtnpcategory" value="" placeholder="Enter Newspaper Category">
      </div>
  </div>

  <div class="form-group row">
    <label for="txtnpcategorydesc" class="col-sm-2 col-form-label">Category Description</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="txtnpcategorydesc" name="txtnpcategorydesc" value="" placeholder="Newspaper Category Description">
      </div>
  </div> 
  <!--          
  <div class="form-group row">
    <label for="txtnpprice" class="col-sm-2 col-form-label">Price</label>
      <div class="col-sm-3">
        <input type="text" id="txtnpprice" class="form-control" name="txtnpprice">
      </div>
  </div>
  
  <div class="form-group row">
    <label for="dtpdop" class="col-sm-2 col-form-label">Date of Publish</label>
      <div class="col-sm-3">
        <input type="text" id="dtpdop" class="form-control" name="dtpdop" >
      </div>
  </div>-->
 
              
  <div class="form-group row">
    <div class="col-sm-2"></div>
    <div class="col-sm-3">
      <input type="button" id="btnadd" class="btn btn-success" name="btnadd" value="Add">
      <input type="reset" class="btn btn-danger" name="">
    </div>
  </div>
              
</form>  

