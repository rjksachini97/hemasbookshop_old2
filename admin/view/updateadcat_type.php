<?php
 if(isset($_GET["adctid"])){
  $adctid = $_GET["adctid"];
 }
 ?>
 <script >
  $(document).ready(function(){

      var actid = $("#txtadctypeid").val();
      var url = "lib/mod_adcat_type.php?type=getAdCatType";
      $.ajax({
        method:"POST",
        url:url,
        data:{adctid:actid},
        dataType:"json",
        success:function(result){         
      $("#cmbadcategory").val(result.newsac_category);
      $("#txtadctdesc").val(result.adcattype_desc);
        },
        error:function(eobj,etxt,err){
          console.log(etxt);
        }
      });
  });

  $(function(){
    $("#btnupdate").click(function(){
      var actid   =$("#txtadctypeid").val();
      var category = $("#cmbadcategory").val();
      var typedescription = $("#txtadctdesc").val();
      
      if(category== 0){
        swal("Required Field ","Please Enter Category","error");
      return;
    }

      if(typedescription== 0){
        swal("Required Field ","Please Enter valid Description","error");
        return;
      }

      swal({
        title:"Do you want to update this record?",
        text:"You are trying to update:"+actid,
        icon:"warning",
        buttons:true,
        dangerMode:true
      }).then((willDelete)=>{
        if(willDelete){
          var fdata = $('form').serialize();
          var url = "lib/mod_adcat_type.php?type=updateAdCatType";
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
              $("#lnkviewadcattype").click();
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
    $("#lnkviewadcattype").click();
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
  <li class="breadcrumb-item active">Update Ad Category Type</li>
</ol>

<!-- New AdCatType Form -->
<form>
  <div class="form-group row">
    <label for="txtadctypeid" class="col-sm-2 col-form-label"> Type ID</label>
      <div class="col-sm-3">
        <input type="text" class="form-control border-success" id="txtadctypeid" name="txtadctypeid" value="<?php echo($adctid); ?>" readonly="readonly" >
      </div>
  </div>

  <div class="form-group row">
    <label for="cmbadcategory" class="col-sm-2 col-form-label">Category</label>
      <div class="col-sm-3">
        <select class="form-control border-success" name="cmbadcategory" id="cmbadcategory" readonly="readonly">
          <option>-- Select Ad Category --</option>
          <option>Automobile</option>
          <option>Employment</option>
          <option>Realestate</option>
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
      <input type="button" id="btnupdate" class="btn btn-success" name="btnupdate" value="Update">
      <input type="button" class="btn btn-danger" id="btncancel" name="" value="Cancel">
    </div>
  </div>
              
</form>  

