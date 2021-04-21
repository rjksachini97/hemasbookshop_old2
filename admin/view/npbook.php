<?php
require("subheader.php");

require("cmn_booking_navbar.php");

require("lib/mod_np_booking.php");

require_once("lib/dbconnection.php");

//$newID=getNewOrderId();

/*include('lib/dbconnection.php');

$sql = "SELECT newsp_id,newsp_name FROM tbl_newspaper WHERE newsp_id NOT IN (SELECT newsa_id FROM tbl_newspaper_ad) AND newsp_status=1;";

$statement = $connect->prepare($sql);

$statement->execute();

$result = $statement->fetchAll();  */

?>

<style type="text/css">
  .currency{
    text-align: right;
  }
</style>


    <!-- ======= Newspaper Booking Details Section ======= -->
<div class="container" style="padding-top: 100px;">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <h3 >Newspaper Booking</h3>
    </li>
  </ol>

   <form id="NewspaperBookingForm">
    <div class="form-row">
      <input type="hidden" name="txtspid" id="txtspid" class="form-control">
           
      <div class="form-group col-md-6">
        <label for="cusname">Customer Name<b class="text-danger">*</b></label>
        <input type="text" class="form-control col-sm-8" id="cusname" name="cusname" value="">
      </div>
      <div class="form-group col-md-6">
      <label for="txt_mob">Contact No<b class="text-danger">*</b></label>
      <input type="text" class="form-control col-sm-8" id="txt_mob" name="txt_mob" value="">
    </div>
    <div class="form-group col-md-6">
      <label for="txt_nic">NIC<b class="text-danger">*</b></label>
      <input type="text" class="form-control col-sm-8" id="txt_nic" name="txt_nic" value="">
    </div>
    <div class="form-group col-md-6">
      <label for="txt_timep">Period for ordering<b class="text-danger">*</b></label>
      <div >
          <select class="form-control col-sm-8" name="txt_timep" id="txt_timep">
            <option>-- Select Time Period for Ordering--</option>
              <option value="1">For One Day</option>
              <option value="2">For One Week</option>
              <option value="3">For One Month</option>
              <option value="4">For One Year</option>
          </select>
        </div>
    </div>
  </div>
  <br>

<table class="table table-bordered" id="table_field">
      <tr>
        <th>Newspaper Name<b class="text-danger">*</b></th>
        <th>Quantity<b class="text-danger">*</b></th>
        <th>Add</th>
      </tr>
      <tr>
        <td>
          <select class="form-control" name="txt_npname" id="txt_npname">
            <option>-- Select Newspaper --</option>
              <?php getNewspaperCategories(); ?>  
          </select>
        </td>
        <td><input class="form-control" type="text" name="txt_npqty" required=""></td>
        
        <td><button type="button" class="btn btn-warning"  id="btnadd" name="btnadd">ADD</button>

      </tr>
      </table>

  <div id="tbl_savedetails">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th></th>
          <th>Newspaper Name</th>
          <th>Quantity</th>
          <th>Total(Rs)</th>
        </tr>
      </thead>
      <tbody id="sampledetails"></tbody>
      <tfoot>
        
        <tr align="right">
          <th colspan="6" >Net Total(Rs)</th>
            <td><input type="text" name="txtntot" id="txtntot" class="form-control currency" readonly="readonly" size="1" value="0.00"></td>
        </tr>
        <tr>
          <td colspan="7">
            <button type="button" class="btn btn-primary ml-4  col-sm-2 btn btn-primary"  id="btnsave" name="btnsave">Save</button>
        
          </td>
        </tr>

      </tfoot>
    </table>    
  </div>

</form>


      <!-- End Newspaper Booking Details Section -->
<script type="text/javascript">
  $(document).ready(function(){

    $("#btnadd").click(function(){
        var sid = $("#txtproid").val();
        var name = $("#txt_npname").val();
        var qty = parseInt($("#txt_npqty").val());

        if(name==""){
          swal("Invalid Input", "Please select the Newspaper", "error");
          return;
        }
        if(qty==0){
          swal("Error","Quantity Cannot be Zero","error");
          return;
        }

       // var url = "lib/mod_np_booking.php?type=getNPDetails";

        $.ajax({
                      method:"POST",
                      url:url,
                      data:{sampleid:sid,qty:qty},
                      dataType:"json",
                      success:function(result){
                        for(i=0;i<result.length;i++){
                          var name = result[i][0];
                          var qty = parseFloat(result[i][1]);
                          
                          var nprice = parseFloat(result[i][2]);
                          
                          var total = nprice*qty;
                          
                          var ntot = parseFloat($("#txtntot").val());

                          var row ="<tr>";
                          
                          row += "<td><a href = 'javascript:void(0)'><i class= 'fa fa-times remove' aria-hidden='true'style= 'color:red' ></i></a></td>";

                          row +="<td><input type='text' class ='form-control' readonly='readonly' size='2' value='"+name+"' name='txtnpname[]'/></td>";

                          row +="<td><input type='text' class ='form-control' readonly='readonly' size='2' value='"+qty+"' name='txtnpqty[]'/></td>";

                          row +="<td><input type='text' class ='form-control' readonly='readonly' size='2' value='"+nprice+"' name='txtsnprice[]'/></td>";

                          

                          row +="<td><input type='text' class ='form-control total currency' readonly='readonly' size='2' value='"+total+"' name='txtstotal[]'/></td>";
                          
                          row += "</tr>";
                          ntot = ntot + total;
                          $("#txtntot").val(ntot);
                          $("#sampledetails").append(row);
                          resetCtrl();
                        }
                                                
                      },
                      error:function(eobj,etxt,err){
                        console.log(etxt);
                      }
          });

      });
    
</script>




<?php
require("subfooter.php");
?>


