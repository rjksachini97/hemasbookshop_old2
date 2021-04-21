 <?php
 if(isset($_GET["empid"])){
 	$empid = $_GET["empid"];
 }
 ?>
 <script >
 	$(document).ready(function(){

  		var eid = $("#txteid").val();
  		var url = "lib/mod_user.php?type=getUser";
  		$.ajax({
  			method:"POST",
  			url:url,
  			data:{empid:eid},
  			dataType:"json",
  			success:function(result){
  				$("#cmbtitle").val(result.emp_title);
  				$("#txtname").val(result.emp_name);
  				$("#txtuname").val(result.emp_email);
          $("#cmbtype").val(result.usr_type);
          var status = result.usr_status;
          if(status=="1"){
            $("#optactive").attr("checked",true);
          }else if(status =="0"){
            $("#optinactive").attr("checked",true);
          }
        },
  				error:function(eobj,etxt,err){
  				console.log(etxt);
  			}
  		});
 	});

  $(function(){
    $("#btnupdate").click(function(){
      var eid   =$("#txteid").val();
      var type =$("#cmbtype").val();
      var status =$("#optstatus").val();

      swal({
        title:"Do you want to update this record?",
        text:"You are trying to update:"+eid,
        icon:"warning",
        buttons:true,
        dangerMode:true
      }).then((willDelete)=>{
        if(willDelete){
          var fdata = $('form').serialize();
          var url = "lib/mod_user.php?type=updateUsers";
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
              $("#lnkviewuser").click();
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
    $("#lnkviewuser").click();
  });
  });


  /**/
</script>

 <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="home.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item" ><a href="#">User Management</a></li>            
            <li class="breadcrumb-item active">Update User</li>
          </ol>

          <!-- Update user form-->
         
           <form>
              <div class="form-group row">
                <label for="txteid" class="col-sm-2 col-form-label">Employee ID</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control border-infos" id="txteid" name="txteid" value="<?php echo($empid); ?>" readonly="readonly">
                </div>
              </div>

              <div class="form-group row">
                <label for="cmbtitle" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-3">
                  <select class="form-control border-info" name="cmbtitle" id="cmbtitle" readonly="readonly">
                    <option>-- Select --</option>
                    <option value="1">Mr.</option>
                    <option value="2">Ms.</option>
                    <option value="3">Dr.</option>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label for="txtname" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control border-info" id="txtname" name="txtname" value="" placeholder="Employee Full Name" readonly="readonly">
                </div>
              </div> 
              
              <div class="form-group row">
                <label for="txtuname" class="col-sm-2 col-form-label">User Name</label>
                <div class="col-sm-5">
                  <input type="text" id="txtuname" class="form-control border-info" name="txtuname" placeholder="Employee Full Name" readonly="readonly">
                </div>
              </div>

              <div class="form-group row">
                <label for="cmbtype" class="col-sm-2 col-form-label">Type</label>
                <div class="col-sm-3">
                  <Select class="form-control border-info" id="cmbtype"name="cmbtype">
                    <option value="1">Admin</option>
                    <option value="2">Manager</option>
                    <option value="3">Sales Assistant</option>
                  </Select>
                </div>
              </div>

              <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Status</label>
                  <div class="col-sm-5">
                    <div class="form-check form-check-inline">  <!--for align button and lable-->
                      <input type="radio" class="form-check-input" name="optstatus" id="optactive" value="1">
                      <label for="optactive" class="form-check-label">Active</label>
                    </div>
                    <div class="form-check form-check-inline"> <!--for align button and lable-->
                      <input type="radio" class="form-check-input" name="optstatus" id="optinactive" value="0">
                      <label for="optinactive" class="form-check-label">Inctive</label>
                    </div>
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