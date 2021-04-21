<?php    
require("../lib/mod_ad_order.php");  
?>

<script>
	$(document).ready(function(){
		var dataTable = $("#tblviewadorder").DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "lib/mod_ad_order.php?type=viewAllAdOrders",
				"type": "POST"
			},
			"columns":[
				{"data":"0"},
				{"data":"1"},
				{"data":"2"},
				{"data":"3"},
				{"data":"4"},
				{"data":"5"},
			],
			"columnDefs":[
				{
					"data":[5],
					"render":function(data,type,row){
						if(data=="0"){
							return "<a href='#' title='completed' ><i class='fas fa-1x text-primary fa-check-double'></i></a> "
						}else{
							return "<p class='text-success'>Completed</p> "
						}
					},
					"targets": 5
				},
				{
					"data":"5",
					"render":function(data,type,row){
						if(data=="0"){
							return "<p class='text-success'>Not Completed</p> "
						}else{
							return "<a href='#' title='Send_Message' data-toggle='modal' data-target='#sendsms' ><i class='fas fa-sms'></i></a>"
						}
					},
					"targets": 6
				},

				{
					"data":null,
					"defaultContent":"<a href='#' title='view_ad_orders'><i class='fas fa-2x fa-clipboard-list'></i></a> ",
					"targets": 7
				}
				]
		});

	$("#tblviewadorder tbody").on('click','a',function(){ //on command is dynamically content a-anker tag
		var type = $(this).attr('title');
		var data = dataTable.row($(this).parents('tr')).data(); //parents command using for select top data
		var adoid = data[0];

		if(type=="Completed"){
			swal({
				title:"Do you want to confirm this Order?",
				text:"You are trying to confirm this Order!"+adoid,
				icon:"warning",
				buttons:true,
				dangerMode:true
			}).then((willDelete)=>{
				if(willDelete){
					var url = "lib/mod_ad_order.php?type=completeAdOrder";
					$.ajax({
						method:"POST",
						url:url,
						//data:{:adoid},
						dataType:"text",
						success:function(result){

							if(result == 1){
								swal("Successfully Updated!", "success");
								$("#lnkviewadorder").click();
							}
							else{
								swal("Error", "Some problem occured in the system", "error");
							}
						},
						error:function(eobj,etxt,err){
							console.log(etxt);
						}
					});
				}
			});
		}else if(type=="Send_Message"){
			var url = "lib/mod_ad_order.php?type=sendSMS";
			$.ajax({
				method:"POST",
				url:url,
			})
		}



		else if(type=="view_ad_orders"){
			//var url = "lib/mod_ad_order.php?type=";
			$.ajax({
				method:"POST",
				url:url,
				//data:{:adoid},
				dataType:"text",
				success:function(result){
					$("#viewadorderdetails").html(result);
        			$("#viewadordermodel").modal("show");
        		},
        		error:function(eobj,etxt,err){
        			console.log(etxt);
        		}

			});
		}

	});





$("#btnmsgsend").click(function(){
		var fdata = $("#smsform").serialize();
		var url = "../controller/contsms.php?type=sendSMS";

		$.ajax({
			method:"POST",
			url:url,
			data:fdata,
			dataType:"text",
			success:function(result){
			alert(result);
			// if(result=="0"){
			// 	swal("Error","sms not send!","error");
			// }
			// else if(result=="1"){
			// 	swal("Success","message send","success");				 
			// }
			},
			error:function(eobj,etext,err){
				 console.log();
			}
		});
	});









	});
</script>

<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="home.php">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
    <a href="home.php">Order Management</a>
  </li>
  <li class="breadcrumb-item active">View Ad Order</li>
</ol>
<!--------- Breadcrumb end--------->

<!--------- Heading start--------->
<h2>Ad Orders for the Company</h2><br>
<!--------- Heading end--------->


<table id="tblviewadorder" class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Customer Name</th>
      <th>Order Date</th>
      <th>Publish Date</th>
      <th>Total Price</th>
      <th>Status</th>
      <th>Send Message</th>
      <th></th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th>ID</th>
      <th>Customer Name</th>
      <th>Order Date</th>
      <th>Publish Date</th>
      <th>Total Price</th>
      <th>Status</th>
      <th>Send Message</th>
	  <th></th>
    </tr>
  </tfoot>
</table>

<!--view full details model-->
<div class="modal fade" id="viewadordermodel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Order Details
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container">
					<div class="row">
						<div class="form-horizontal" id="viewadorderdetails">
							


						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>	
</div>


<div class="row">
	<div class="col-sm-3"></div>
	<div class="col-sm-6 shadow">
		<div align="center"><h5>Send SMS</h5></div>
		<form id="smsform" class="pt-3">
			<label><i class="fas fa-mobile"></i> Enter recepiant number </label>
			<input type="text" name="contactno" id="contactno" placeholder="contact number">
			<label><i class="fas fa-comment"></i> Enter text message </label>
			<input type="text" name="msgtext" id="msgtext" placeholder="enter your text">
			<button type="button" id="btnmsgsend" name="btnmsgsend" class="btn btn-success border border-dark shadow">Send</button>
		</form>
	</div>
	<div class="col-sm-3"></div>
</div>