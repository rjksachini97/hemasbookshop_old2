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


 

















         /*-------------------- Price format   ---------------------*/

        $("#cost_price").on("change",function () {
            $sprice = $(this).val();
            if($sprice ==""){
                $(this).val("0.00");
            }else{
                $(this).val((parseFloat($sprice)).toFixed(2));
            }
        });
        $("#sell_price").on("change",function () {
            $sprice = $(this).val();
            if($sprice ==""){
                $(this).val("0.00");
            }else{
                $(this).val((parseFloat($sprice)).toFixed(2));
            }
        });

        /*------
-------------- Data add to table  ---------------------*/
$("#btn_grn_add").click(function () {

            $rdate = $("#rdate").val();
            $grn_pub = $("#grn_pub").val();
            $grn_cat = $("#grn_cat").val();
            $cat_name = $("#grn_cat option:selected").text();
            $grn_np = $("#grn_np").val();
            $np_name = $("#grn_np option:selected").text();
            $grn_qty = $("#grn_qty").val();
            $cost_price = $("#cost_price").val();
            $sell_price = $("#sell_price").val();
            $totqty = $("#totqty").val();


            if($rdate=="" || $grn_pub=="" || $grn_cat=="" || $cat_name=="" || $grn_np=="" || $np_name=="" || $grn_qty=="" || $cost_price=="" || $sell_price=="" || $totqty==""){
                swal("Error","Please Fill All inputs","error");
                return;
            }

            //sum of curunt quantity and new quantity
            var totqty = parseInt($totqty)+ parseInt($grn_qty);
            $("#totqty").val(totqty); //add quantity to total quantity input


            var total = parseFloat($cost_price) * parseInt($grn_qty); // calculate toatal using price and quantity
            total = parseFloat(total).toFixed(2);

            $row= "<tr>";
            $row += "<td><a href='javascript:void(0)' class='btn btn-danger remove' >X</a> </td>";

            $row += "<td><input type='text' class='form-control-plaintext '  readonly value='"+$np_name+"'>" +
                "<input type='hidden' id='tbl_np' name='tbl_np[]'  value='"+$grn_np+"' ></td>";

            $row += "<td><input type='text' class='form-control-plaintext'  readonly value='"+$cat_name+"' >" +
                "<input type='hidden' id='tbl_cat' name='tbl_cat[]' value='"+$grn_cat+"' ></td>";

            $row += "<td><input type='text' class='form-control-plaintext text-right qty' id='tbl_qty' name='tbl_qty[]' readonly value='"+$grn_qty+"' ></td>";

            $row += "<td><input type='text' class='form-control-plaintext text-right' id='tbl_cprice' name='tbl_cprice[]' readonly value='"+$cost_price+"' ></td>";

            $row += "<td><input type='text' class='form-control-plaintext text-right' id='tbl_sprice' name='tbl_sprice[]' readonly value='"+$sell_price+"' ></td>";

            $row += "<td><input type='text' class='form-control-plaintext text-right total' id='bat_price' name='bat_price[]' readonly value='"+total+"' > </td>";

            $row += "</tr>";

            var gtot = parseFloat($("#txtgtot").val()); // input convert to currency
            var ntot = parseFloat($("#txtntot").val()); // input convert to currency

            gtot = parseFloat(gtot)+parseFloat(total);
            ntot = parseFloat(ntot)+parseFloat(total);
            gtot= parseFloat(gtot).toFixed(2);
            ntot= parseFloat(ntot).toFixed(2);


            $("#txtgtot").val(gtot); 
            $("#txtntot").val(ntot);
            $("#selectPub").val($("#grn_sup").val());
            $("#grn_pub").prop("disabled",true);

            $("#grn_content").append($row);
            resetinput();

        });

 /*-------------- Data add to database after click submit button  -------------*/
        $("#btn_grn_submit").click(function () {
            var rdate = $("#rdate").val();
            var grn_pub = $("#grn_pub").val();
            var tbl_cat = $("#tbl_cat").val();
            var tbl_np = $("#tbl_np").val();
            var tbl_qty = $("#tbl_qty").val();
            var tbl_cprice = $("#tbl_cprice").val();
            var tbl_sprice = $("#tbl_sprice").val();
            var gtot = $("#txtgtot").val();
            var ntot = $("#txtntot").val();

            if(rdate=="" || grn_pub=="" || tbl_cat =="" || tbl_np=="" || tbl_qty =="" || tbl_cprice=="" || tbl_sprice=="" || gtot=="" || ntot==""){
                swal("Error","Please Fill All inputs","error");
                return;
            }

            var data = $('form').serialize();
            //var url  = "lib/mod_grn.php?type=addNewGrn";

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
                        $("#view_grn").click();
                    }
                }

            })

        });

         /*---------------- function for after click remove button on tabale  -----------*/

        $("#grn_content").on("click",".remove",function () {

            var total = parseFloat($(this).parents("tr").find(".total").val()); //newspaper total
            var qty = parseFloat($(this).parents("tr").find(".qty").val());     // newspaper quantity

            var totqty = $("#totqty").val(); //currunnt total quntity
            var gtot = $("#txtgtot").val();     // current total 
            var ntot = $("#txtntot").val();     //current net total
            totqty = totqty-qty;
            gtot = gtot-total;
            ntot = gtot;

            gtot = parseFloat(gtot).toFixed(2);
            ntot = parseFloat(ntot).toFixed(2);

            $("#totqty").val(totqty); //total quantity
            $("#txtgtot").val(gtot); // grn total
            $("#txtntot").val(ntot); // grn net total
            
            $(this).parents("tr").remove();
        });

          /*-------------------- Clear inputs  ---------------------*/
        function  resetinput() {

            $("#grn_cat").val("");
            $("#grn_np").val("");
            $("#grn_qty").val("");
            $("#cost_price").val("");
            $("#sell_price").val("");
            
        }

});
</script>  