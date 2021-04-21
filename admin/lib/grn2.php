<?php
require("../lib/mod_grn.php");
require("../lib/common.php");
require ("../lib/mod_pub_company.php");
$newid = getNewPubComId();

require ("../lib/mod_newspaper_category.php");
//$catnewID=getNewNewsPaperCatId();
?>

<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="home.php">Dashboard</a>
  </li>
  <li class="breadcrumb-item" ><a href="#">GRN Management</a></li>            
  <li class="breadcrumb-item active">New GRN</li>
</ol>

<!-- New Newspaer Form -->
<h3 class="h3" >Add New GRN</h3>
<hr> 

<div class="animated zoomIn fast">
    <div class="card">
        <form >
        <div class="m-xl-5">
            <div class="row">
                <div class="col">
                    <div class="form-group row">
                        <label for="" class="col-lg-2 form-label">Grn No</label>
                        <input type="text" class="col-lg-1 form-control-plaintext "     id="grnid" name="grnid" value="<?php getGrnNo() ?>" >
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-lg-2 form-label">Received Date</label>
                        <input type="text" class="col-lg-2 form-control " id="rdate" name="rdate" value="<?php echo(date("Y-m-d")) ; ?>">
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-lg-2"> Publication Company</label>
                        <select  class= "col-lg-4 custom-select" name="grn_pub" id="grn_pub" readonly='readonly'>
                            <option value="">Select Publication Company</option>
                            <?php getPubCompany() ?>
                        </select>
                        <input type="hidden" name="selectPub" id="selectPub">
                 	</div>

               <div class="row mt-2">
                <div class="col">
                    <div class="form-group row">
                        <label for="grn_cat" class="col-lg-4"> Category</label>
                        <select class= "col-lg-5 custom-select " name="grn_cat" id="grn_cat">
                            <option value="">Select Category</option>
                            <?php getNPCategory(); ?>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group row">
                        <label for="grn_np" class="col-lg-4"> Newspaper</label>
                        <select class= "col-lg-5 custom-select " name="grn_np" id="grn_np">
                            <option value="">--Select Newspaper--</option>
                            	
                        </select>
                    </div>
                </div>

            </div>

                </div>
      		</div>	
<br>
      		            <div class="row mt-2    ">
                <div class="col">
                    <div class="form-group row">
                        <label for="" class="col-lg-4 form-label">Quantity *</label>
                        <input type="text" class="col-lg-5 form-control form-control-sm" id="grn_qty" name="grn_qty" >
                    </div>
                </div>
                <div class="col">
                    <div class="form-group row">
                        <label for="" class="col-lg-5 form-label">Cost Price(Rs) *</label>
                        <input type="text" class="col-lg-5 form-control form-control-sm text-right" id="cost_price" name="cost_price">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group row">
                        <label for="" class="col-lg-5 form-label">Sell Price(Rs) *</label>
                        <input type="text" class="col-lg-5 form-control form-control-sm text-right" id="sell_price" name = "sell_price"  >
                    </div>
                </div>

            </div>
            <div>
                <div class="align-items-end" >
                    <input  type="button" class="btn btn-primary col-1" value="Add" id="btn_grn_add" name="btn_grn_add">
                </div>

            </div>

        </div>
        <div class="container ">
            <table class="table" width="90%">
                <thead>
                    <tr>
                        <th></th>
                        <th>Newspaper</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Cost Price(Rs)</th>
                        <th>Selling Price(Rs)</th>
                        <th>Total Price(Rs)</th>

                    </tr>
                </thead>

                <tbody id="grn_content">

                </tbody>
                <tfoot>

                    <tr align="right" >
                        <th colspan="3" >Total Quantity</th>
                        <td  > <input type="text" class=" form-control text-right"  size="2" id="totqty" name="totqty" value="0"> </td>
                        
                        <th colspan="2" >Total(Rs)</th>
                        <td  > <input type="text" class=" form-control text-right"  size="2" id="txtgtot" name="txtgtot" value="0"> </td>
                    </tr>

                    
                    <tr align="right" ><th colspan="6" >Net Total(Rs)</th>
                        <td  > <input type="text" class=" form-control text-right"  size="2" id="txtntot" name="txtntot" value="0"> </td>
                    </tr>
                </tfoot>

            </table>
            <div>
                <div align="right" class="mr-4">
                    <input type="button" class="btn btn-success" value="submit" id="btn_grn_submit" name="btn_grn_submit">
                </div>
            </div>
        </div>

        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#rdate").datepicker({
            changeMonth:true,
            changeYear:true,
            maxDate:"0",
            dateFormat:"yy-mm-dd"
        });

        /*-------------------- Load new newspaper category  according to newspaper  NNNNNNNNNEEEEEEEEEEEWWWWWWWWWWWWW ---------------------*/
                      
    $("#grn_cat").change(function () { /* run this function when change the category field*/

    //$("#grn_img").html("");
    var npcat_id = $(this).val(); /* store currnet id of category*/
    if(npcat_id==""){
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

      });  

    });
</script>