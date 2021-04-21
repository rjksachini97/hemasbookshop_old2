<?php 
require("subheader.php");  

require("lib/mod_ad_booking.php");

require("cmn_booking_navbar.php");
?> 


    <!-- ======= Advertisment Details Section ======= -->
  
    <div class="container" style="padding-top: 100px;">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <h3 >Advertisment Booking</h3>
        </li>
      </ol>
    <form id="BookingForm" enctype="multipart/form-data">

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="txt_npname">Newspaper Name<b class="text-danger">*</b></label>
            <select class="form-control col-sm-8" name="txt_npname" id="txt_npname">
              <option value="">-- Select Newspaper --</option>
                                  <?php getNewspaperCategories(); ?>
            </select>
        </div>
        <div class="form-group col-md-6">
          <label for="dtadpublish">Date Of Publish<b class="text-danger">*</b></label>                            
            <input type="text" id="dtadpublish" class="form-control col-sm-4" name="dtadpublish" readonly="readonly">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
					<label for="txt_npadmode">Modes of Advertisment<b class="text-danger">*</b></label>
						<select class="form-control col-sm-8" name="txt_npadmode" id="txt_npadmode">
          		<option value="">-- Select Ad Mode--</option>
         				<?php getModesofAd(); ?>
         		</select>
      	</div>
        <div class="form-group col-md-6">
        <label for="txt_npadcolour">Colour<b class="text-danger">*</b></label>
          <select class="form-control col-sm-8" name="txt_npadcolour" id="txt_npadcolour">
            <option value="">-- Select Colour --</option>
              <?php getAdColour(); ?>
          </select>
      </div>
      <div class="form-group col-md-6">
        <label for="txt_npadsize">Size<b class="text-danger">*</b></label>
          <select class="form-control col-sm-8" name="txt_npadsize" id="txt_npadsize">
            <option value="">-- Select Size --</option>
              <?php getAdSize(); ?>
          </select>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="txt_npadcat">Category of Advertisment<b class="text-danger">*</b></label>
          <select class="form-control col-sm-8" name="txt_npadcat" id="txt_npadcat">
            <option value="">-- Select Ad Category--</option>
              <?php getAdCategories(); ?>
          </select>
      </div>
      <div class="form-group col-md-6">
        <label for="txt_npadcatdes">Description of Ad Category<b class="text-danger">*</b></label>
          <select class="form-control col-sm-8" name="txt_npadcatdes" id="txt_npadcatdes">
            <option value="">-- Select Ad Category Description--</option>
              <?php getAdCatDescription(); ?>
          </select>
      </div>    
    </div>




    <div class="form-row" id="txtaddress-group">
      <div class="form-group col-md-10">
        <label for="txtaddress">Description of Ad <b class="text-danger">*</b></label>
          <textarea type="text" class="form-control" name="txtaddress" id="txtaddress" placeholder="Type your Advertisment here, Minimum word count is 15"></textarea>
      </div>  
    </div>

    <div class="form-row" id="txt_wc-group">
      <div class="form-group col-md-6">
        <label for="txt_wc">Word Count<b class="text-danger">*</b></label>
          <input type="text" class="form-control col-sm-8" id="txt_wc" name="txt_wc" value="" >
      </div>
    </div>


    <div class="form-group row" id="imgad-group">
        <label for="imgad" class="col-sm-4 col-form-label">Upload Advertisment Image</label>
          <div class="col-sm-3">
            <input type="hidden" name="MAX_FILE_SIZE" value="10000000">
            <input type="file" class="form-control-file" name="imgad" id="imgad"  accept="image/*">
          </div>
            <div style="padding-left: 180px; padding-right: 20px">
              <small id="passwordHelpBlock" class="form-text text-muted">*Only applicable for Photo classified & Full Page advertisments
              </small>
            </div>
      </div>

    <div class="form-group row">
      <label for="imgupnic" class="col-sm-4 col-form-label">Upload Image of NIC<b style="color: red">*</b></label>
        <div class="col-sm-3">
          <input type="hidden" name="MAX_FILE_SIZE" value="10000000">
          <input type="file" class="form-control-file" name="imgupnic" id="imgupnic"  accept="image/*">
        </div>
    </div>

    <div class="form-group row" id="imgupbr-group">
        <label for="imgupbr" class="col-sm-4 col-form-label">Upload Image of Business Registartion Certificate<b style="color: red">*</b></label>
          <div class="col-sm-3">
            <input type="hidden" name="MAX_FILE_SIZE" value="10000000">
            <input type="file" class="form-control-file" name="imgupbr" id="imgupbr"  accept="image/*">
          </div>
    </div>

    <div class="form-group" style="padding-top: 50px;">
      <label for="tot_price">Total Price</label>
      <input type="text" class="form-control col-sm-2" id="tot_price" name="tot_price" readonly="readonly" value="00.00">
    </div> 
<!-- 
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="ck_agree">
          <label class="form-check-label" for="ck_agree">I agree to the Pay Half of the total  fee as retainer to hold the date.</label>
    </div> -->

    <div class="modal-footer">
        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Reset</button>
        <button type="button" class="btn btn-primary" id="btnBooking" >Place My Booking</button>
    </div>
	</form>
</div>
<!-- End Advertismen Details Section -->

<script type="text/javascript"> 
    $(function(){
      $("#dtadpublish").datepicker({
        changeYear:true,
        changeMonth:true,
        dateFormat:"yy-mm-dd",
        //maxDate:"-6570" 
        minDate:"45",                                 
    });

  });
  
  /*-------------------- Load new ad category description according to category   ---------------------*/
                      
    $("#txt_npadcat").change(function () { /* run this function when change the category field*/
    
    //$("#grn_img").html("");
      var newsac_id = $(this).val(); /* store currnet id of category*/
      if(newsac_id =="ACAT0005"){
        $("#imgupbr-group").removeClass("d-none");
      }else{
        $("#imgupbr-group").addClass("d-none");
      }

      if(newsac_id==""){
          $("#txt_npadcatdes").html("<option value=''>Select Ad Category Description</option>");
      }else{
          url = "lib/mod_ad_booking.php?type=getAdCatDescription";

          $.ajax({
              method:"POST",  
              url:url,
              data:{newsac_id:newsac_id},
              dataType:"text",
              success:function (result) {
                  $("#txt_npadcatdes").html(result);
              },
              error:function (etxt) {
                  console.log(etxt);
              }

            });
      }

    });  



$("#btnBooking").click(function(){
    <?php
      if(isset($_SESSION['session_cus'])){ 

    ?>
    var npname = $("#txt_npname").val();
    var adpub_date = $("#dtadpublish").val(); 
    var ad_mode = $("#txt_npadmode").val();
    var ad_colour =$("#txt_npadcolour").val();
    var ad_size =$("#txt_npadsize").val();
    var ad_cat =$("#txt_npadcat").val();
    var adcat_des =$("#txt_npadcatdes").val();
    var ad_description =$("#txtaddress").val();
    var word_count =$("#txt_wc").val();
    var ad_img = $("#imgad").val();
    var nic_img = $("#imgupnic").val();
    var br_img = $("#imgupbr").val();
    var tot_price = $("#tot_price").val();


    if(npname == ""){
      swal("Required Field", "Please select Newspaper", "error");
      return;
    }
       
    if(adpub_date == ""){
      swal("Required Field", "Please Select the Publish Date", "error");
      return;
    }
                                
    if(ad_mode == ""){
      swal("Required Field", "Please Select Advertisment Mode", "error");
      return;
    }else if(ad_mode=="1" || ad_mode=="2" || ad_mode=="4"){
      if(ad_description == ""){
        swal("Required Field", "Please Enter Description of the Advertisment", "error");
        return;
      }else{
        if(word_count <= "15"){
          swal("Required Field", "Minimum Words should be 15 in the Addvertisment!", "error");
          return;
        }
      }
    }

    if(ad_colour == ""){
      swal("Required Field", "Please Select Advertisment Colour", "error");
      return;
    }

    if(ad_size == ""){
      swal("Required Field", "Please Select Advertisment Size", "error");
      return;
    }

    if(ad_cat == ""){
      swal("Required Field", "Please Select Advertisment Category", "error");
      return;
    }else if(ad_cat =="ACAT0005"){ // if category
      if(br_img == ""){
          swal("Required Field", "Please Upload the Image of Business Registration Certificate", "error");
          return;
      }
    }

    if(adcat_des == ""){
      swal("Required Field", "Please Select Description of Advertisment Category", "error");
      return;
    }
    if(nic_img == ""){
      swal("Required Field", "Please Upload the Image of NIC", "error");
      return;
    }

  /*  if(br_img == ""){
      swal("Required Field", "Please Upload the Image of Business Registartion Certificate", "error");
      return;
    }
*/
    // var fdata = $('#BookingForm').serialize();
    var fdata =new FormData($('#BookingForm')[0]);
    var url = "lib/mod_ad_booking.php?type=addNewAdBooking";

    swal({
        title:"Do you want to place this Booking ?",
        icon:"info",
        buttons:true,
      }).then((printdone)=>{  //start from her today-------------------------------------------------------
          if(printdone){
          
            $.ajax({
              method:"POST",
              url:url,
              data:fdata,
              dataType:"text",
              contentType:false,
              cache:false,
              processData:false,
              success:function(result){
     
              res = result.split(",");
              stat = res[0].trim();
                if(stat[0]=="0"){
                  swal("Error",res[1],"error");
                }
                else if(stat[0]=="1"){
                  swal({
                    title:"Success",
                    text:res[1],
                    icon:"success",
                  }).then((willDelete)=>{
                    if(willDelete){
                        window.location.href="../index.php";
                      }
                    });                                            
                }                                         
              },
              error:function(eobj,etxt,err){
                console.log(etxt);
              }
      });
      }
  });                                    
<?php
  }else{
?>
    swal({
          title:"You Have to Log In first ?",
          icon:"warning",
          buttons:true,
        }).then((bkingdone)=>{
            if(bkingdone){
              window.location = "../index.php#why-us";
            }
        });
  <?php
    }
  ?>
}); 

//function to disable booking button to agree for terms

//  $("#ck_agree").change(function (){
//   if($(this).is(":checked")) {
//     $("#btnBooking").attr('disabled', false);
//   }else{
//   $("#btnBooking").attr('disabled', true);
//   }
// });

/*File type validation for Ad Image upload*/
$("#imgad").change(function(){
  var file = this.files[0];
  var fileType = file.type;
  var match = ['image/jpeg', 'image/png', 'image/jpg'];
  var filesize = 5242880;

    if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) )){
      swal('Sorry',' only JPG, JPEG, & PNG Image files are allowed .','error');
        $("#imgupnic").val('');
        exit;
    }else if(file.size>filesize){
        swal("Sorry"," Maximum Image size should be 5MB ","error");
        $("#imgad").val('');
        exit;
    }
}); 
 
/*File type validation for NIC upload*/
$("#imgupnic").change(function(){
  var file = this.files[0];
  var fileType = file.type;
  var match = ['image/jpeg', 'image/png', 'image/jpg'];
  var filesize = 5242880;

    if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) )){
      swal('Sorry',' only JPG, JPEG, & PNG Image files are allowed .','error');
        $("#imgupnic").val('');
        exit;
    }else if(file.size>filesize){
        swal("Sorry"," Maximum Image size should be 5MB ","error");
        $("#imgupnic").val('');
        exit;
    }
});   


/*File type validation for BR upload*/
$("#imgupbr").change(function(){
  var file = this.files[0];
  var fileType = file.type;
  var match = ['image/jpeg', 'image/png', 'image/jpg'];
  var filesize = 5242880;

    if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) )){
      swal('Sorry',' only JPG, JPEG, & PNG Image files are allowed .','error');
        $("#imgupbr").val('');
        exit;
    }else if(file.size>filesize){
        swal("Sorry"," Maximum Image size should be 5MB ","error");
        $("#imgupbr").val('');
        exit;
    }
});  


/*validation for word count*/   
// $("#txt_wc").change(function(){
//   $string =                                   
// });    



/* -------------------------#############################################------------------------------------- */


//calculate Total Price
function calculate_total_price(){ 
  $per_word = 25;  
  $vat = 15; // %
  $full_page = 175000;
  $box = 25000;
  $full = 225000;
  $word_count= $("#txt_wc").val();  //word count

  $price = 0
  if($word_count < 16){ //if word less than 15
    $price = 1500;
  }else{
    $extra_word = $word_count-15
    $price = 1500 + ($per_word * $extra_word);
  }
  

  $if_colour = $("#txt_npadcolour").val(); //colour type  CL003
  if($if_colour =="CL002"){
    $colour_price = 10; // %
  }else if($if_colour =="CL003"){
    $colour_price = 25; // %
  }else{
    $colour_price = 0; // %
  }
 
  $price = $price + (($price*$colour_price)/100);
  

  $total_price = $price;
  $total_price = $total_price +  (($total_price*$vat)/100);
  $total_price = $total_price.toFixed(2);
  $("#tot_price").val($total_price);
}

// When change mode of Advertissment change the css in description
$("#txt_npadmode").change(function(){
  $mode_id = $(this).val();
  if(($mode_id=="1") || ($mode_id=="2") || ($mode_id=="4") ){
    $("#txtaddress-group").removeClass("d-none");
    $("#txt_wc-group").removeClass("d-none");
    $("#imgad-group").addClass("d-none"); //photo upload hidden
    $("#imgupbr-group").addClass("d-none"); //br upload hidden

    $("#txtaddress").removeAttr("required"); //remove required attributes
    $("#txt_wc").removeAttr("required"); //remove required attributes
    $("#imgad").removeAttr("required"); //remove required attributes
    $("#imgupbr").removeAttr("required"); //remove required attribute

  }else{
    $("#txtaddress-group").addClass("d-none");
    $("#txt_wc-group").addClass("d-none");
    $("#imgad-group").removeClass("d-none"); //photo upload
    $("#imgupbr-group").removeClass("d-none"); //br upload 

    $("#txtaddress").removeAttr("required"); //remove required attributes
    $("#txt_wc").removeAttr("required"); //remove required attributes
    $("#imgad").removeAttr("required"); //remove required attributes
    $("#imgupbr").removeAttr("required"); //remove required attribute
  }
  
});

// When click the the description button automatically get word count
$("#txtaddress").keyup(function(){
   var wordCount = $(this).val().split(/[\s\.\?]+/).length;
   $("#txt_wc").val(wordCount);

  //  if(wordCount <= "15"){
  //     swal("Required Field", "Minimum Words should be 15 in the Addvertisment!", "error");
  //     return;
  //   }

   calculate_total_price()
});








/*-------------------- Load new ad category description according to category   ---------------------*/
                      
  //  $("#txt_npadcat").change(function () { /* run this function when change the category field*/

    //$("#grn_img").html("");
  //  var newsac_id = $(this).val(); /* store currnet id of category*/
  /*  if(newsac_id==""){
        $("#txt_npadcatdes").html("<option value=''>Select Ad Category Description</option>");
    }else{
        url = "lib/mod_ad_booking.php?type=getAdCatDescription";

        $.ajax({
            method:"POST",  
            url:url,
            data:{newsac_id:newsac_id},
            dataType:"text",
            success:function (result) {
                $("#txt_npadcatdes").html(result);
            },
            error:function (etxt) {
                console.log(etxt);
            }

          });
        }

      });  */

  /*-------------------- Load new newspaper category  according to newspaper   ---------------------*/
                      
  //  $("#grn_cat").change(function () { /* run this function when change the category field*/

    //$("#grn_img").html("");
  //  var npcat_id = $(this).val(); /* store currnet id of category*/
  /*  if(npcat_id==""){
        $("#grn_np").html("<option value=''>Select Ad Category Description</option>");
    }else{
        url = "lib/mod_ad_booking.php?type=getNewspaper";

        $.ajax({
            method:"POST",  
            url:url,
            data:{npcat_id:npcat_id},
            dataType:"text",
            success:function (result) {
                $("#grn_np").html(result);
            },
            error:function (etxt) {
                console.log(etxt);
            }

          });
        }

      });  */























</script>


<?php
require("subfooter.php");
?>