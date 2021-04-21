<?php
if(isset($_GET["sellid"])){
	$sellid = $_GET["sellid"];
}
?>
<script type="text/javascript">
	$(document).ready(function(){
    $("#dtpdoj").datepicker({
	     changeYear:true,
	     changeMonth:true,
	     dateFormat:"yy-mm-dd",
	     maxDate:"0"
    });

    	var sellerid = $("#txtsellerid").val();
    	var url = "lib/mod_seller.php?type=getSeller";

      	$.ajax({
	        method:"POST",
	        url:url,
	        data:{sellid:sellerid},
	        dataType:"json",
	        success:function(result){
	          $("#cmbtitle").val(result.sell_title);
	          $("#txtsellername").val(result.sell_name);
            $("#txtselleraddress").val(result.sell_address);
            $("#txtsellermobile").val(result.sell_mobile);
            $("#txtselleremail").val(result.sell_email);
            $("#txtsellernic").val(result.sell_nic);
            $("#dtpdoj").val(result.sell_doj);
	        },
	        error:function(eobj,etxt,err){
	          console.log(etxt);
	        }
      	});

        $("#btnupdate").click(function(){
          var sellerid = $("#txtsellerid").val();
          var title = $("#cmbtitle").val();
          var name = $("#txtsellername").val();
          var address = $("#txtselleraddress").val();
          var mobile = $("#txtsellermobile").val();
          var email = $("#txtselleremail").val();
          var nic = $("#txtsellernic").val();
          var doj = $("#dtpdoj").val();

          if(title==""){
            swal("Invalid Input", "Please select the title", "error");
            return;
          }

          var name_pattern = /^[a-zA-Z\.\s]+$/;

          if(!name.match(name_pattern)){
            swal("Invalid Input", "Please enter a valid name", "error");
            return;
          }

          var date_pattern = /^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/;

          if(!doj.match(date_pattern)){
            swal("Invalid Input", "Please enter a valid date of birth", "error");
            return;
          }

          if(address == ""){
            swal("Required Field", "Please fill the address", "error");
            return;
          }

          var email_pattern = /^[a-zA-Z\d\.\_]+\@[a-zA-Z\d\.\-]+\.[a-zA-Z]{2,4}$/;

          if(!email.match(email_pattern)){
             swal("Invalid input", "Please fill a valid email address", "error");
            return;
          }

          swal({
            title:"Do you want to update this record?",
            text:"You are trying to update Seller :"+sellerid,
            icon:"warning",
            buttons:true,
            dangerMode:true
          }).then((willDelete)=>{
            if(willDelete){
              var fdata = $('form').serialize();
              var url = "lib/mod_seller.php?type=updateSeller";

              $.ajax({
                method:"POST",
                url:url,
                data:fdata,
                dataType:"text",
                success:function(result){
                  res = result.split(",");
                  if(res[0]=="0"){
                    swal("Error",res[1],"error");
                  }
                  else if(res[0]=="1"){
                    swal("Success",res[1],"success");
                    $("#lnkviewseller").click();
                  }
                },
                error:function(eobj,etxt,err){
                  console.log(etxt);
                }
              });
            }
          });

        });

        $("#btncancel").click(function(){
          $("#lnkviewseller").click();
        });
	});
</script>
<!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="home.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
              <a href="#">Seller Management</a>
            </li>
            <li class="breadcrumb-item active">Update Seller</li>
          </ol>

          <!-- New employee form-->
            <form>
              <div class="form-group row">
                <label for="txtsellerid" class="col-sm-2 col-form-label">Seller ID</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="txtsellerid" name="txtsellerid" value="<?php echo($sellid); ?>" readonly="readonly">
                </div>
              </div>

              <div class="form-group row">
                <label for="cmbtitle" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-3">
                  <select class="form-control" id="cmbtitle" name="cmbtitle">
                    <option value="">--Select Here--</option>
                    <option value="1">Mr</option>
                    <option value="2">Ms</option>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label for="txtsellername" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="txtsellername" name="txtsellername" placeholder="Seller Full Name">
                </div>
              </div>

              <div class="form-group row">
                <label for="txtselleraddress" class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-3">
                  <input id="txtselleraddress" class="form-control" name="txtselleraddress" placeholder="Enter Your Address">
                </div>
              </div>

              <div class="form-group row">
                <label for="txtsellermobile" class="col-sm-2 col-form-label">Mobile Phone</label>
                <div class="col-sm-3">
                  <input type="text" id="txtsellermobile" class="form-control" name="txtsellermobile" placeholder="Enter Your mobile number">
                </div>
              </div>

              <div class="form-group row">
                <label for="txtselleremail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-4">
                  <input type="text" id="txtselleremail" class="form-control" name="txtselleremail" placeholder="Enter Your Email Address">
                </div>
              </div>

              <div class="form-group row">
                <label for="txtsellernic" class="col-sm-2 col-form-label">NIC</label>
                <div class="col-sm-3">
                  <input type="text" id="txtsellernic" class="form-control" name="txtsellernic" placeholder="Enter Your NIC here">
                </div>
              </div>

              <div class="form-group row">
                <label for="dtpdoj" class="col-sm-2 col-form-label">Date of Join</label>
                <div class="col-sm-3">
                  <input type="text" id="dtpdoj" class="form-control" name="dtpdoj">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-sm-2"></div>
                <div class="col-sm-3">
                  <input type="button" class="btn btn-success" value="Update" name="btnupdate" id="btnupdate">
                  <input type="button" class="btn btn-danger" name="btncancel" value="Cancel" id="btncancel">
                </div>
              </div>
            </form>