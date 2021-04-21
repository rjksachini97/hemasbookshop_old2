<?php  

require("../lib/mod_ad.php");

 if(isset($_GET["newsadid"])){
  $newsadid = $_GET["newsadid"];
 }
 ?>
<script>  
$(document).ready(function(){

      var npadid = $("#txtadid").val();
      var url = "lib/mod_ad.php?type=getAd";
      $.ajax({
        method:"POST",
        url:url,
        data:{newsadid:npadid},
        dataType:"json",
        success:function(result){
          $("#cmbnewspub").val(result.pub_id);
          $("#cmbnpcategory").val(result.npcat_id);
          $("#cmbnpname").val(result.newsp_id);
          $("#cmbnpadmode").val(result.newsad_mode_id);
          $("#cmbnpcolour").val(result.adcolour_id);
          $("#txtfwc").val(result.newsa_fwc);
          $("#txtfwcprice").val(result.newsa_fwcprice);
          $("#txtmwcprice").val(result.newsa_mwcprice);
        },
        error:function(eobj,etxt,err){
          console.log(etxt);
        }
      });
  });


$(function(){
$("#btnupdate").click(function(){
  var npadid   =$("#txtadid").val();
  var pubcompany = $("#cmbnewspub").val();
  var npcategory = $("#cmbnpcategory").val();
  var npname = $("#cmbnpname").val();
  var admode = $("#cmbnpadmode").val();
  var colour = $("#cmbnpcolour").val();
  var fwc = $("#txtfwc").val();
  var fwcprice = parseFloat($("#txtfwcprice").val());
  var mwcprice = parseFloat($("#txtmwcprice").val());


  if (pubcompany==""){
    swal("Invalid Input","Please Select the Publication Company","error");
    return;
  }

  if (npcategory==""){
    swal("Invalid Input","Please Select the Category","error");
    return;
  }

  if (npname==""){
    swal("Invalid Input","Please Select the Newspaper Name","error");
    return;
  }

  if (admode==""){
    swal("Invalid Input","Please Select the Advertisment mode","error");
    return;
  }

  if (colour==""){
    swal("Invalid Input","Please Select the Colour Type","error");
    return;
  }

  var number_pattern=/^[0-9]+$/;

  if(!fwc.match(number_pattern)){
      swal("Invalid Input","Please Enter First Word Count","error");
    return;
  }

/*  var number_pattern=/^[0-9]+$/;

  if(!mwcprice.match(number_pattern)){
      swal("Invalid Input","Please Enter Word Count More than First Word Count","error");
    return;
  }*/

 
      swal({
        title:"Do you want to update this record?",
        text:"You are trying to update:"+npadid,
        icon:"warning",
        buttons:true,
        dangerMode:true
      }).then((willDelete)=>{
        if(willDelete){
          var fdata = $('form').serialize();
          var url = "lib/mod_ad.php?type=updateAd";
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
              $("#lnkviewad").click();
            }
          },
          error:function(eobj,etxt,err){
            console.log(etxt);
          }
          });
        }
         
        });

  });

  //$('#cmbnewspub').editableSelect();

  // function for cancel button
  $("#btncancel").click(function(){
    $("#lnkviewad").click();
  });
  });

	
</script> 

<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="home.php">Dashboard</a>
  </li>
  <li class="breadcrumb-item" ><a href="#">Ad Management</a></li>            
  <li class="breadcrumb-item active">Update Advertisment</li>
</ol>

<!-- New Newspaer Form -->

<h3 class="h3">Update Advertisments</h3><hr>
<form> 
  
  <div class="form-group row">
  	<label for="txtadid" class="col-sm-2 col-form-label">Ad ID</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" id="txtadid" name="txtadid" value="<?php echo($newsadid); ?>" readonly="readonly">
      </div>
  </div>


  <div class="form-group row">
    <label for="cmbnewspub" class="col-sm-2 col-form-label">Publication Company</label>
      <div class="col-sm-3">
        <select class="form-control" name="cmbnewspub" id="cmbnewspub">
            <?php
            foreach($result as $pub_id)
              {
                echo '<option value="'.$row["pub_id"].'">'.$row["pub_id"].'</option>';
              }?>
          <option>-- Select Company --</option>
              <?php getPubCategories(); ?>
        </select>
      </div>
  </div>

  <div class="form-group row">
    <label for="cmbnpcategory" class="col-sm-2 col-form-label">Newspaper Category</label>
      <div class="col-sm-3">
        <select class="form-control" name="cmbnpcategory" id="cmbnpcategory">
          <option>-- Select Newspaper Category --</option>
              <?php getCategories(); ?>
        </select>
      </div>
  </div>

    <div class="form-group row">
    <label for="cmbnpname" class="col-sm-2 col-form-label">Newspaper Name</label>
      <div class="col-sm-3">
        <select class="form-control" name="cmbnpname" id="cmbnpname">
          <option>-- Select Newspaper --</option>
              <?php getNewspaperCategories(); ?>
        </select>
      </div>
  </div>
  
  <div class="form-group row">
    <label for="cmbnpadmode" class="col-sm-2 col-form-label">Modes of Ad</label>
      <div class="col-sm-3">
        <select class="form-control" name="cmbnpadmode" id="cmbnpadmode">
          <option>-- Select Ad Mode--</option>
          <?php getModesofAd(); ?>
        </select>
      </div>
  </div>


  <div class="form-group row">
    <label for="cmbnpcolour" class="col-sm-2 col-form-label">Colour</label>
      <div class="col-sm-3">
        <select class="form-control" name="cmbnpcolour" id="cmbnpcolour">
          <option>-- Select Colour --</option>
          <?php getAdColour(); ?>
          
        </select>
      </div>
  </div>

  <div class="form-group row">
    <label for="txtfwc" class="col-sm-2 col-form-label">First Word Count</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" id="txtfwc" name="txtfwc" value="" placeholder="Enter First Word Count">
      </div>
  </div>

  <div class="form-group row">
    <label for="txtfwcprice" class="col-sm-2 col-form-label">First Word Count Price</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" id="txtfwcprice" name="txtfwcprice" value="" placeholder="First word count Price">
      </div>
  </div> 

  <div class="form-group row">
    <label for="txtmwcprice" class="col-sm-2 col-form-label">Per One Word Price</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" id="txtmwcprice" name="txtmwcprice" value="" placeholder="Additional word Price">
      </div>
  </div> 
          




<!--  <div class="form-group row">
    <label for="txtmwc" class="col-sm-2 col-form-label">More Word Count</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="txtmwc" name="txtmwc" value="" placeholder="Enter First Word Count">
      </div>
  </div>-->

    
  <div class="form-group row">
    <div class="col-sm-2"></div>
    <div class="col-sm-3">
      <input type="button" id="btnupdate" class="btn btn-success" name="btnupdate" value="Update">
      <input type="reset" class="btn btn-danger" id="btncancel" name="" value="Cancel">
    </div>
  </div>
              
</form>  
