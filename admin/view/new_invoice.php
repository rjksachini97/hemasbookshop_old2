<?php
require ("../lib/mod_invoice.php");
require ("../lib/mod_customer.php");   
$cus_id = getCusId();
/*session_start();
if(isset($_SESSION["user"]["uid"])){
    $oper =$_SESSION["user"]["uid"];
}
*/

?>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="home.php">Dashboard</a>
  </li>
  <li class="breadcrumb-item" ><a href="#">Payment and Billing</a></li>            
  <li class="breadcrumb-item active">New Invoice</li>
</ol>

<!-- New Newspaer Form -->
<h3 class="h3" >Add New Invoice</h3>
<hr> 

<div class="container">
<form id="inv_form">
<!--    <input type="hidden" name="log_user" value="<?php //echo ($oper)?>">
-->
    <!-----------------------      Invoice Details                       --------------------->
    <div class="row">
        <div class="col-lg-5">
            <div class="form-group row">
                <label for="inv_id" class= " col-sm-4 col-form-label-sm">Invoice Number</label>
                <div class="col-sm-7">
                    <input type="text" readonly="readonly" class=" form-control form-control-sm"  id="inv_id" name="inv_id"  value="<?php getInvId(); ?>">
                </div>
            </div>
        </div> 

        <div class="col-lg-5">
            <div class="form-group row">
                <label for="inv_date" class= " col-sm-2 col-form-label-sm">Date</label>
                <div class="col-sm-8">
                    <input type="text"  class=" col-sm-8 form-control form-control-sm"  id="inv_date" name="inv_date" value="<?php echo(date("Y-m-d")) ; ?>" >
                </div>
            </div>
        </div>
    </div>
    <!----------------------- Customer Details  --------------------->
    <div class="row">
        <div class="col-lg-5">
            <div class="form-group row">
                <label for="cus_email" class= " col-sm-4 col-form-label-sm">Customer Email</label>
                <div class="col-sm-8">
                    <input type="email"  class=" form-control form-control-sm"  id="cus_email" name="cus_email" >
                    <label for="" class="alert-warning d-none" id="war_email"> Not a valid email</label>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="form-group row">
                <label for="txtname" class= " col-sm-3 col-form-label-sm">Name</label>
                <div class="col-sm-8">
                    <input type="hidden"    id="cus_id" name="cus_id" >
                    <input type="text"  class=" form-control form-control-sm"  id="cus_name" name="cus_name" >
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group row">
                <label for="txtname" class= " col-sm-5 col-form-label-sm">Contact No</label>
                <div class="col-sm-7">
                    <input type="text"  class=" form-control form-control-sm"  id="cus_mobile" name="cus_mobile" maxlength="10">
                    <label for="" class="alert-warning d-none" id="war_mobile"> Not a valid number</label>
                </div>
            </div>
        </div>
    </div>
    <!----------------------- NewspaperDetails       --------------------->
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group row">
                <label for="" class= " col-sm-5 col-form-label-sm">Newspaper ID</label>
                <div class="col-sm-7">
                    <input type="text"  class="  form-control form-control-sm"  id="newsp_id" name="newsp_id" >
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="form-group row">
                <label for="" class= "col-sm-3 col-form-label-sm pr-1">Newspaper</label>
                <div class="col-sm-8">
                    <input type="text" readonly="readonly"  class="  form-control form-control-sm"  id="newsp_name" name="newsp_name" >
                    <input type="hidden" readonly="readonly"  class="  form-control form-control-sm"  id="bat_id" name="bat_id" >
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group row">
                <label for="" class= " col-sm-4 col-form-label-sm pr-1">Remaining</label>
                <div class="col-sm-6">
                    <input type="text" readonly="readonly"  class="  form-control form-control-sm"  id="newsp_rem" name="newsp_rem" >
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group row">
                <label for="txtname" class= " col-sm-5 col-form-label-sm">Newspaper QTY.</label>
                <div class="col-sm-3">
                    <input type="number"  class="form-control  form-control-sm"  id="newsp_qty" name="newsp_qty" min="1" value="1">
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="form-group row">
                <label for="newsp_price" class= " col-sm-4 col-form-label-sm">Newspaper Price</label>
                <div class="col-sm-6">
                    <input type="hidden" readonly="readonly"  class="form-control form-control-sm"  id="newsp_cprice" name="newsp_cprice" >
                    <input type="text" readonly="readonly"  class="form-control form-control-sm"  id="newsp_sprice" name="newsp_sprice" >
                    <input type="hidden" readonly="readonly"  class="form-control form-control-sm"  id="newsp_tprice" name="newsp_tprice" >
                    
                </div>
            </div>
        </div>


    </div>
    <input type="button" value="add" class="btn btn-primary" id="add_table" >
    <div class="mt-3">
        <table class="table table-sm" width="90%">
            <thead>
            <tr>
                <th></th>
                <th>Newspaper ID</th>
                <th>Newspaper</th>
                <th>Newspaper Price(Rs)</th>
                <th>Quantity</th>
                <th>Total Price(Rs)</th>

            </tr>
            </thead>

            <tbody id="inv_content">

            </tbody>
            <tfoot>

            <tr align="right" >
                <td colspan="4"></td>
                <td > <input type="text" readonly="readonly" class=" form-control form-control-sm text-right"  size="1" id="totqty" name="totqty" value="0"> </td>

                <td  > <input type="text" readonly="readonly" class=" form-control form-control-sm text-right px-3"  size="1" id="txtgtot" name="txtgtot" value="0.00"> </td>
            </tr>

            <tr align="right" ><th colspan="5" >Discount(%)</th>
                <td  > <input type="text" class="form-control form-control-sm  text-right"  size="2" id="txtdis" name="txtdis" value="0"> </td>
            </tr>
            <tr align="right" ><th colspan="5" >Net Total(Rs)</th>
                <td  > <input type="text" readonly="readonly" class="form-control form-control-sm text-right"  size="2" id="txtntot" name="txtntot" value="0.00"> </td>
            </tr>
            </tfoot>

        </table>
    </div>
        <div>
            <div align="right" class="mr-4">
                <button type="button" class="btn btn-success"  id="btn_inv_submit">Submit</button>
                <button type="reset" class="btn btn-success"  id="btn_inv_cancel">clear</button>
            </div>
        </div>

    </form>

</div>
</div>
<div class="modal  fade" id="addCus" tabindex="-1" role="alertdialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <form id="addCudForm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" >
                        <h3>Add New Customer</h3>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="msg_body">
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">Customer Email</label>
                        <input type="text" class="col-lg-7 form-control " name="ncus_email" id="ncus_email"  >
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">Name</label>
                        <input type="text" class="col-lg-7 form-control " name="ncus_name" id="ncus_name"  >
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">Date of Birth</label>
                        <input type="text" class="col-lg-7 form-control " name="ndtpdob" id="ndtpdob"  >
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">Address</label>
                        <input type="text" class="col-lg-7 form-control " name="ncus_address" id="ncus_address"  >
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">Mobile No</label>
                        <input type="text" class="col-lg-7 form-control " name="ncus_mobile" id="ncus_mobile"  >
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-lg-4 col-form-label">NIC</label>
                        <input type="text" class="col-lg-7 form-control " name="ncus_nic" id="ncus_nic"  >
                    </div>
                        <div class="form-group row">
                        <label for="staticEmail" class=" col-sm-4  col-form-label-sm">Gender</label>
                        <div class="form-check form-check-inline"> <!-- for align button and label -->
                            <input type="radio" class="form-check-input ml-3 selected" required name="gender" id="optmale" value="1" >
                            <label for="optmale" class="form-check-label-sm">Male</label>
                            <!-- for align button and label -->
                            <input type="radio" class="form-check-input ml-4" required name="gender" id="optfemale" value="0" >
                            <label for="optfemale" class="form-check-label-sm" >Female</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success"   id="modal_btn_add_cus"> ADD</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"  id="modal_btn_add"> Cancel</button>

                </div>
            </div>
        </form>
    </div>
</div>



<script>
    $(document).ready(function () {
         $("#inv_date").datepicker({
            changeMonth:true,
            changeYear:true,
            maxDate:"0",
            dateFormat:"yy-mm-dd"
        });
         $("#ndtpdob").datepicker({
            changeMonth:true,
            changeYear:true,
            maxDate:"0",
            dateFormat:"yy-mm-dd"
        });

        /*----------------------check customer email new --------------------------   */
        $("#cus_email").keypress(function (e) {  // check this email register or not
            var email_pattern=/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;

            if(e.which==13){
                var email = $(this).val();
                if(email==""){
                   swal("warning","email Not valied","warning");
                }else if(!email.match(email_pattern)){
                     swal ("Invalid Input","Please enter valid email address","error");
                 }else{

                    var url  = "lib/mod_invoice.php?type=checkCustomer";

                    $.ajax({
                        method:"POST",
                        url:url,
                        data:{email:email},
                        dataType:"json",
                        success:function (result) {
                           
                            if(result=="1"){
                                $("#cus_id").val("");
                                $("#cus_name").val("");
                                $("#cus_mobile").val("");
                                $("#ncus_email").val(email);
                                $("#addCus").modal();
                            }else{
                                $("#cus_id").val(result.cus_id);
                                $("#cus_name").val(result.cus_name);
                                $("#cus_mobile").val(result.cus_mobile);
                            }
                        }

                    });
                }
            }
        });

        /*----------------------Add new customer  --------------------------   */

        // add new Customer
        $("#modal_btn_add_cus").click(function () {
            
            $ncus_email =$("#ncus_email").val();
            $ncus_name =$("#ncus_name").val();
            $ncus_mobile =$("#ncus_mobile").val();
            $ndtpdob =$("#ndtpdob").val();
            $ncus_address =$("#ncus_address").val();
            $ncus_nic = $("ncus_nic").val();

            var date_pattern = /^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/;
            if (!ndtpdob.match(date_pattern)){
            swal("Invalid Input","Please Enter a valid Date","error");
                return;
            }

            var email_pattern=/^[a-zA-Z\.\s]+$/;
            if( $ncus_email.match(email_pattern)){
                swal ("Invalid Input","Please enter your email address","error");
                return;
            }

            if($ncus_email == "" || $ncus_name=="" || $ncus_address=="" || $ncus_mobile=="" || $ncus_nic==""){
                swal("warning","Fill All Fieds","warning" );
            }
            var fdata = $("#addCudForm").serialize();
            var url  = "lib/mod_invoice.php?type=addNewCustomer";

            $.ajax({
                method:"POST",
                url:url,
                data:fdata,
                dataType:"json",
                success:function (result) {
                    res = result.split(",");
                    if(res[0]=="0"){
                        swal("Error",res[1],"error")
                    }
                    else if(res[0]=="1") {
                        $("#addCus").modal('hide');
                        $("#cus_id").val($ncus_id);
                        $("#cus_name").val($ncus_name);
                        $("#cus_mobile").val($ncus_mobile);
                    }
                }

            });
        });

        /*-----------------------Customer email and mobile no keyup---------------------*/
        $("#cus_email").keyup(function(){
            var email = $(this).val();
            var email_pattern=/^[a-zA-Z1-9\n{@}.\s]+$/;
            if(!email.match(email_pattern)){

                $("#war_email").removeClass('d-none');
            }else{
                $("#war_email").addClass('d-none');
            }
        });
        $("#cus_mobile").keyup(function(){
            var phone = $(this).val();
            var phone_pattern = /[^0-9]/;
            if(phone.match(phone_pattern)){

                $("#war_mobile").removeClass('d-none');
            }else{
                $("#war_mobile").addClass('d-none');
            }
        });
        /*----------------------get newspaer details--------------------------   */


         $("#newsp_id").keypress(function (e) {  // check this email register or not
            if(e.which==13){
                var newspid = $(this).val();
                 if(newspid==""){
                   swal("warning","Newspaper id not valid","warning");
                }else{

                    var url  = "lib/mod_invoice.php?type=getNewspaper";

                    $.ajax({
                        method:"POST",
                        url:url,
                        data:{newspid:newspid},
                        dataType:"json",
                        success:function (result) {

                            if(result=="1"){
                               swal("warning","Newspaper ID is not valid","warning");
                            }else{
                                $("#newsp_id").val(result.newsp_id); //np id
                                $("#bat_id").val(result.bat_id);    //batch id
                                $("#newsp_name").val(result.newsp_name);    //modal
                                $("#newsp_rem").val(result.newsp_qty);    //remaining quantity
                                $("#newsp_cprice").val(result.bat_cprice);   //cost price
                                $("#newsp_sprice").val(result.bat_sprice);   //sell price
                                $("#newsp_tprice").val(result.bat_sprice);   //total price
                                
                                
                            }
                        }

                    });
                }
            }
        });

/*----------------------Change price from quantity--------------------------   */

         $("#newsp_qty").on("keyup mouseup",function(){
            var qty = $(this).val();
            var price = $("#newsp_sprice").val();  //selling price

            var newsp_rem = $("#newsp_rem").val();

               
            totalNewspprice = parseFloat(price)*parseInt(qty);
            totalNewspprice = parseFloat(totalNewspprice).toFixed(2);
            $("#newsp_tprice").val(totalNewspprice); 
         
            if(parseInt(qty)> parseInt(newsp_rem)){
                    swal("Error","Quantity is more than available","error");
                    $("#newsp_qty").val("14");
                    return;
               }

         }) ;

         /*----------------------Invoice data add to the Table--------------------------   */

        $("#add_table").click(function () {            

            var date = $("#inv_date").val(); //invoice date
            var cus_email = $("#cus_email").val();  //customer email
            var cus_name = $("#cus_name").val(); //customer first name
            var cus_mobile = $("#cus_mobile").val(); // customer mobile
            
            var newsp_id = $("#newsp_id").val(); // np id
            var bat_id = $("#bat_id").val();    //batch id
            var newsp_name = $("#newsp_name").val(); //model name
            var newsp_rem = $("#newsp_rem").val(); //remaining quantity
            var newsp_qty = $("#newsp_qty").val();
            var newsp_cprice = $("#newsp_cprice").val(); //cost price
            var newsp_sprice = $("#newsp_sprice").val();  //cost selling price
            var newsp_tprice = $("#newsp_tprice").val();   // np total price
        

            var email_pattern=/[^@]{1,64}@[^@]{4,253}$/;
            var mobile_pattern=/^([0-9]){10}$/;
            if( !cus_email.match(email_pattern)){
                swal ("Invalid Input","Not a valid Email","error");
                return;
            }
            if( !cus_mobile.match(mobile_pattern)){
                swal ("Invalid Input","Not a valid Contact Number","error");
                return;
            }
            if( parseInt(newsp_qty) > parseInt(newsp_rem)){
                swal ("Invalid Input","Sorry, Quantity is not in stock","error");
                return;
            }

            if(date =="" || cus_email=="" || cus_name=="" || cus_mobile=="" || newsp_id=="" ||
                newsp_name=="" || newsp_qty=="" ){
                swal("warning","Please fill All Inputs correctly","warning");
            return;
            }

              var totqty = $("#totqty").val(); // get table total quantity

            var totqty = parseInt(totqty)+ parseInt(newsp_qty); // sum of existing quantity and new total quantity
            $("#totqty").val(totqty); // add table total quantity
            
            var gtot = parseFloat($("#txtgtot").val()) ; //get table total price
            var total = parseFloat(parseInt(gtot) + parseInt(newsp_tprice)).toFixed(2); //sum of existing price and new price
            $("#txtgtot").val(total); //save total

            var ntot = parseFloat($("#txtntot").val());
            var ntotal = parseFloat(parseFloat(ntot) + parseFloat(newsp_tprice)).toFixed(2);
            $("#txtntot").val(ntotal);

            $row= "<tr>";
            $row += "<td><a href='javascript:void(0)' class='btn btn-danger remove' >X</a> </td>";

            $row += "<td><input type='text' class='form-control-plaintext ' id='tbl_id' name='tbl_id[]' readonly value='"+newsp_id+"'> <input type='hidden' class='form-control-plaintext ' id='bat_id' name='bat_id[]' readonly value='"+bat_id+"'><input type='hidden' class='form-control-plaintext ' id='tbl_cprice' name='tbl_cprice[]' readonly value='"+newsp_cprice+"'>";

            $row += "<td><input type='text' class='form-control-plaintext ' id='tbl_modal' name='tbl_modal[]' readonly value='"+newsp_name+"' ></td>";

            $row += "<td><input type='text' class='form-control-plaintext text-right  pr-5' id='tbl_sprice' name='tbl_sprice[]' readonly value='"+newsp_sprice+"' ></td>";

            $row += "<td><input type='text' class='form-control-plaintext qty' id='tbl_qty' name='tbl_qty[]' readonly value='"+newsp_qty+"' ></td>";

            $row += "<td><input type='text' class='form-control-plaintext text-right total pr-3' id='tbl_tprice' name='tbl_tprice[]' readonly value='"+newsp_tprice+"' > </td>";

            $row += "</tr>";

            $("#inv_content").append($row);
            $("#txtdis").val("0");
             
             resetinput();

        });

        /*---------------------- cus email change for double click --------------------------   */

        $("#cus_email").dblclick(function(e){
            $(this).prop("readonly","");
            $("#cus_name").prop('readonly',"");
            $("#cus_mobile").prop('readonly',"");
        });

        /*---------------------- function for remove --------------------------   */

        $("#inv_content").on("click",".remove",function(){ // after load page if click remove run function

            var total =parseFloat($(this).parents("tr").find(".total").val());
            var qty =parseFloat($(this).parents("tr").find(".qty").val());

            var gtot = parseFloat($("#txtgtot").val());
            var gqty = parseFloat($("#totqty").val());

            gtot = parseFloat(gtot-total).toFixed(2);
            $("#txtdiscount").prop("readonly","");
            $("#txtdiscount").val("");
            var ntot = gtot;

            gqty = gqty-qty;

            $("#txtgtot").val(gtot);
            $("#txtntot").val(ntot);
            $("#totqty").val(gqty);

            $(this).parents("tr").remove();
        });

                /*---------------------- add Discount --------------------------   */

        $("#txtdis").keypress(function (e) {
            if(e.which==13){
                if($(this).val()==""){
                    $("#txtntot").val($("#txtgtot").val());
                }else{
                    var dis = parseFloat($(this).val());
                    var gtot = parseFloat($("#txtgtot").val());
                    var ntot = gtot - ((gtot*dis)/100);
                    $("#txtntot").val(ntot);
                    $("#txtdis").prop('readonly',true);
                }
            }
        });

                /*---------------------- Submit Data --------------------------   */

        $("#btn_inv_submit").click(function () {
            var date = $("#inv_date").val();
            var ncus_email =$("#ncus_email").val();
            var ncus_name =$("#ncus_name").val();
            var ncus_lname =$("#ncus_address").val();
            var ncus_mobile =$("#ncus_mobile").val();

            var newspid =$("#newspid").val();
            var newsp_name =$("#newsp_name").val();



            var data = $('#inv_form').serialize();
            var url  = "lib/mod_invoice.php?type=addNewInv";

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
                        swal("Success",res[1],"success");
                        setTimeout(function() {
                            $("#lnknewinvoice").click();
                        }, 300);
                    }
                }

            });

        });
        

    });

    function resetinput(){

        $("#newsp_id").val("");
        $("#newsp_name").val("");
        $("#newsp_rem").val("");
        $("#newsp_qty").val("1");
        $("#newsp_price").val("");
        // disable customer details
        $("#cus_email").prop('readonly',true);
        $("#cus_name").prop('readonly',true);
        $("#cus_mobile").prop('readonly',true);
    }


</script>


