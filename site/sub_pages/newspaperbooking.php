<?php 
require("subheader.php");  

require("lib/mod_ad_booking.php");

require("cmn_booking_navbar.php");
?> 


    <!-- ======= Advertisment Details Section ======= -->
  
    <div class="container" style="padding-top: 100px;">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <h3 >Newspaper Booking</h3>
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
          <label for="dtnporder">Price</label>  
          <div class="col-md-6">
                <input type="hidden"    id="newsp_id" name="newsp_id" >
                <input type="hidden"    id="newsp_name" name="newsp_name" >
                <input type="hidden"    id="remaining_qty" name="remaining_qty" >
                <input type="text"  class=" form-control" readonly="readonly"  id="newsp_price" name="newsp_price" value="0.00">
          </div> 
        </div>
         
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="txtqty" class="col-sm-5 col-form-label">Quantity<b class="text-danger">*</b></label>
            <div class="col-sm-6">
              <input type="number" class="form-control" id="txtqty" name="txtqty" value="1">
            </div> 
          </div>
        <div class="form-group col-md-6">
          <label for="dtnporder">Date Of Order<b class="text-danger">*</b></label>  
            <input type="text" id="dtnporder" class="form-control col-sm-4" name="dtnporder" >
        </div>
      </div>

      <div>
        <div class="align-items-end" >
          <input  type="button" class="btn btn-success col-1" value="Add" id="btn_np_add" name="btn_np_add">
        </div>
      </div>
      <br>

      <div class="container ">
         <table class="table table-sm" width="90%">
            <thead>
            <tr>
                <th></th>
                <th>Newspaper</th>                
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Date of Order</th>
                <th>Total Price(Rs)</th>

            </tr>
            </thead>

            <tbody id="np_content">

            </tbody>
            <tfoot>

            <tr align="right" >
                <th colspan="5">Total Qty</th>
                <td > <input type="text" readonly="readonly" class=" form-control form-control-sm text-right"  size="2" id="totqty" name="totqty" value="0"> </td>
                
            </tr>

            
            <tr align="right" ><th colspan="5" >Total(Rs)</th>
                <td  > <input type="text" readonly="readonly" class="form-control form-control-sm text-right"  size="2" id="txtntot" name="txtntot" value="0.00"> </td>
            </tr>
            </tfoot>

        </table>
        
          <div>
            <div class="modal-footer">
              <!-- <button type="reset" class="btn btn-secondary" data-dismiss="modal">Reset</button> -->
              <button type="button" class="btn btn-primary" id="btnBooking">Place My Booking</button>
            </div>
          </div>
        </div>
    </form>
</div>
<!-- End Advertismen Details Section -->

<script type="text/javascript"> 
    $(function(){
      $("#dtnporder").datepicker({
        changeYear:true,
        changeMonth:true,
        dateFormat:"yy-mm-dd",
        //maxDate:"-6570" 
        minDate:"10",  
      });
   
    //     /*----------------------get np price when click newspaper--------------------------   */
    $("#txt_npname").change(function() {  
      
      var newsp_id = $(this).val(); /* store currnet id of newpaper*/
 
      if(newsp_id==""){
        $("#newsp_price").html("");
      }else{
        var url  = "lib/mod_np_booking.php?type=getprice";
       
        $.ajax({
          method:"POST",  
          url:url,
          data:{newsp_id:newsp_id},
          dataType:"json",
          success:function (result) {
           
            $("#newsp_id").val(result.newsp_id);
            $("#newsp_name").val(result.newsp_name);
            $("#remaining_qty").val(result.newsp_qty);
            $("#newsp_price").val(result.newsp_price);
          },
          error:function (etxt) {
            console.log(etxt);
          }

        });
      }

    });  


     
        $("#btn_np_add").click(function () {

            $npodate = $("#dtnporder").val();
            $np_name = $("#txt_npname").val();
            $newspaper_name = $("#newsp_name").val();
            $np_qty = $("#txtqty").val();
            $order_date = $("#dtnporder").val();
            $newsp_id = $("#newsp_id").val();
            $newsp_price = $("#newsp_price").val();

            $totqty = $("#totqty").val();            
            

            if($npodate=="" || $np_name=="" || $np_qty=="" || $totqty==""){
              swal("Error","Please Fill All inputs","error");
                return;
            }
            //sum of curunt quantity and new quantity
            var totqty = parseFloat($totqty)+ parseFloat($np_qty);
            $("#totqty").val(totqty); //add quantity to total quantity input


            var total = parseFloat($newsp_price) * parseInt($np_qty); // calculate toatal using price and quantity
            total = parseFloat(total).toFixed(2);

            $row = "<tr>";
            $row += "<td><a href='javascript:void(0)' class='btn btn-danger remove' >X</a> </td>";

            $row += "<td><input type='text' class='form-control-plaintext '  readonly='readonly' class='form-control form-control-sm text-right' id='newsp_name' name='newsp_name[]' value='"+$newspaper_name+"'/>" +
                "<input type='hidden' id='newsp_id' name='newsp_id[]'  value='"+$newsp_id+"' /></td>";

            $row += "<td><input type='text' id='newsp_unit_price' name='newsp_unit_price[]' readonly='readonly' class='form-control form-control-sm text-right' value='"+$newsp_price+"' /></td>";
            
            $row += "<td><input type='text' id='newsp_qty' name='newsp_qty[]' readonly='readonly' class='form-control form-control-sm text-right'  value='"+$np_qty+"' /></td>";
            
            $row += "<td><input type='text' id='order_date' name='order_date[]' readonly='readonly' class='form-control form-control-sm text-right'  value='"+$order_date+"' /></td>";

            $row += "<td><input type='text' id='newsp_total_price' name='newsp_total_price[]' readonly='readonly' class='form-control form-control-sm text-right'  value='"+total+"' /></td>";
            
           
            $row += "</tr>";

            $price_total = $("#txtntot").val();
            var inv_total = parseFloat($price_total) +parseFloat(total);
            inv_total= parseFloat(inv_total).toFixed(2);
            $("#txtntot").val(inv_total);

            // $("#txtgtot").val(gtot); 
            // $("#txtntot").val(ntot);
            // $("#selectSup").val($("#grn_sup").val());
            // $("#grn_sup").prop("disabled",true);

            $("#np_content").append($row);
            resetinput();

        });

    
    
        /*---------------------- Submit Data --------------------------   */

        $("#btnBooking").click(function () {
            var date = $("#newsp_id").val();
            if(data==""){
              swal("Error","Please add products","error");
            }   

            var data = $('#BookingForm').serialize();
            var url  = "lib/mod_np_booking.php?type=addNewsPaperBooking";

            $.ajax({
                method:"POST",
                url:url,
                data:data,
                dataType:"text",
                success:function (result) {  
                      
                    res = result.split(",");
                    msg = res[0].trim();
                    if(msg=="0"){
                        swal("Error",res[1],"error")
                    }
                    else if(msg=="1"){
                      swal({
                        title:"Success",
                        text:res[1],
                        icon:"success",
                      }).then((willDelete)=>{
                        if(willDelete){
                            window.location.href="../index.php";
                          }
                        });
                        // setTimeout(function() {
                        //     funAddInv();
                        // }, 300);
                    }
                }

            });

        });

    function resetinput(){

      $npodate = $("#dtnporder").val("");
      $np_name = $("#txt_npname").val("");
      $newspaper_name = $("#newsp_name").val("");
      $np_qty = $("#txtqty").val("1");
      $newsp_id = $("#newsp_id").val("");
      $newsp_price = $("#newsp_price").val("0.00");
      // disable customer details
      $("#cus_email").prop('readonly',true);
      $("#cus_fname").prop('readonly',true);
      $("#cus_mobile").prop('readonly',true);
    }

    /*---------------------- function for remove --------------------------   */

    $("#np_content").on("click",".remove",function(){ // after load page if click remove run function

      var total =parseFloat($(this).parents("tr").find("#newsp_total_price").val());
      var qty =parseFloat($(this).parents("tr").find("#newsp_qty").val());

      var totqty = parseFloat($("#totqty").val()); 
      var price_total = parseFloat($("#txtntot").val());

      price_total = parseFloat(price_total-total).toFixed(2);
      // $("#txtdiscount").prop("readonly","");
      // $("#txtdiscount").val("");
      // var ntot = gtot;

      totqty = totqty-qty;

      $("#txtntot").val(price_total);
      $("#totqty").val(totqty);

      $(this).parents("tr").remove();
    });


})


</script>


<?php
require("subfooter.php");
?>