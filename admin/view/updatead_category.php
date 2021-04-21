<?php
 if(isset($_GET["adcatid"])){
  $adcatid = $_GET["adcatid"];
 }
 ?>
 <script >
  $(document).ready(function(){

      var acid = $("#txtadcid").val();
      var url = "lib/mod_ad_category.php?type=getAdCat";
      $.ajax({
        method:"POST",
        url:url,
        data:{adcatid:acid},
        dataType:"json",
        success:function(result){
          $("#txtadcategory").val(result.newsac_category);
        },
        error:function(eobj,etxt,err){
          console.log(etxt);
        }
      });
  });

  $(function(){
    $("#btnupdate").click(function(){
      var acid   =$("#txtadcid").val();    
      var category = $("#txtadcategory").val();
      
      if(category== 0){
        swal("Required Field ","Please Enter Category","error");
      return;
    }
      swal({
        title:"Do you want to update this record?",
        text:"You are trying to update:"+acid,
        icon:"warning",
        buttons:true,
        dangerMode:true
      }).then((willDelete)=>{
        if(willDelete){
          var fdata = $('form').serialize();
          var url = "lib/mod_ad_category.php?type=updateAdCat";
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
              $("#lnkviewadcategory").click();
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
    $("#lnkviewadcategory").click();
  });
  });


  /**/
</script>

<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="home.php">Dashboard</a>
  </li>
  <li class="breadcrumb-item" ><a href="#">Ad Management</a></li>            
  <li class="breadcrumb-item active">Update Ad Category</li>
</ol>

<!-- New AdCatType Form -->
<form>

  <div class="form-group row">
    <label for="txtadcid" class="col-sm-2 col-form-label">Category ID</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" id="txtadcid" name="txtadcid" value="<?php echo($adcatid);?>" readonly="readonly">
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
      <input type="button" id="btnupdate" class="btn btn-success" name="btnupdate" value="Update">
      <input type="button" class="btn btn-danger" id="btncancel" name="" value="Cancel">
    </div>
  </div>
              
</form>  

