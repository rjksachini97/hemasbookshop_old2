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
                        "data":"6",
                        "render": function(data,type,row){
                            return(data=="0")?"<p class='text-success'>Not completed</p>":"<p class='text-primary'>Completed</p>";
                        },
                        "targets":6
                    },

                    {
					"data":"7",
					"render":function(data,type,row){
						if(data=="0"){
							return "<button class='btn btn-success btn-sm' title='Send Email'>Send Email</button> "
						}else{
							return "<p class='text-success'>Completed</p> "
						}
					},
					"targets": 7
				},
				{
                    "data":"8",
                    "render": function(data,type,row){
                        return(data=="0")?"<button class='btn btn-success btn-sm' title='Send_Message'>Send SMS</button>":"<p class='text-success'>SMS was sent</p>";
                        },
                        "targets":8
                    },


			/*	{
					"data":"5",
					"render":function(data,type,row){
						if(data=="0"){
							return "<p class='text-success'>Not Completed</p> "
						}else{
							return "<a href='#' title='Send_Message' data-toggle='modal' data-target='#sendsms' ><i class='fas fa-sms'></i></a>"
						}
					},
					"targets": 6
				}, */

				{
					"data":null,
					"defaultContent":"<button class='btn btn-primary btn-sm' title='view_order'>View Order</button> ",
					"targets":9
				}
				]
		});

	$("#tblviewadorder tbody").on('click','button',function(){ //on command is dynamically content a-anker tag
		var type = $(this).attr('title');
		var data = dataTable.row($(this).parents('tr')).data(); //parents command using for select top data
		var adoid = data[0];
		var cusname = data[1];
		var phone_number = data[2];

		if(type=="Send Email"){
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
		}else if(type=="Send_Message"){ // This function is to send SMS
			//var url = "lib/mod_ad_order.php?type=sendSMS";
			swal({
				title:"Do you want to Send sms?",
				text:"You are trying to send sms!"+cusname,
				icon:"warning",
				buttons:true,
				dangerMode:true
			}).then((willDelete)=>{
				if(willDelete){
					var url = "lib/mod_ad_order.php?type=sendSMS";
					$.ajax({
						method:"GET",
						url:url,
						data:{contact:phone_number},
						dataType:"text",
						success:function(result){
						alert(result);
					
						},
						error:function(eobj,etxt,err){
							console.log(etxt);
						}
					});
				}
			});
			
		}else if(type=="view_order"){
			//var url = "lib/mod_ad_order.php?type=";
			// $.ajax({
			// 	method:"POST",
			// 	url:url,
			// 	//data:{:adoid},
			// 	dataType:"text",
			// 	success:function(result){
			// 		$("#viewadorderdetails").html(result);
   //      			$("#viewadordermodel").modal("show");
   //      		},
   //      		error:function(eobj,etxt,err){
   //      			console.log(etxt);
   //      		}

			// });
		}

	});





// $("#btnmsgsend").click(function(){
// 		var fdata = $("#smsform").serialize();
// 		var url = "../controller/contsms.php?type=sendSMS";

// 		$.ajax({
// 			method:"POST",
// 			url:url,
// 			data:fdata,
// 			dataType:"text",
// 			success:function(result){
// 			alert(result);
// 			// if(result=="0"){
// 			// 	swal("Error","sms not send!","error");
// 			// }
// 			// else if(result=="1"){
// 			// 	swal("Success","message send","success");				 
// 			// }
// 			},
// 			error:function(eobj,etext,err){
// 				 console.log();
// 			}
// 		});
// 	});









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


<table id="tblviewadorder" class="table table-striped" width="100%">
  <thead>
    <tr>
      <th>ID</th>
      <th>Customer Name</th>
      <th>Customer Contact</th>
      <th>Order Date</th>
      <th>Publish Date</th>
      <th>Total Price</th>
      <th>Status</th>
      <th>Send Email</th>
      <th>Send Message</th>
      <th></th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th>ID</th>
      <th>Customer Name</th>
      <th>Customer Contact</th>
      <th>Order Date</th>
      <th>Publish Date</th>
      <th>Total Price</th>
      <th>Status</th>
      <th>Send Email</th>
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


<!--  --------------Send Email------------- -->

<div class="modal fade" id="sendEmail" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="formSendemail"> 
            <div class="modal-header">
                                   
                
                <div class="modal-title" >
                    <h5 >Send Email</h5>                 
                </div>                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="msg_body">
                <input type="hidden" name="id" id="id" value="" >
               <div class="form-group row">
                    <label for="" class="col-lg-4 col-form-label">name</label>:
                    <input type="email" class="ml-1 col-lg-6 form-control" readonly name="send_name" id="send_name"> 
                </div>
                <div class="form-group row">
                    <label for="" class="col-lg-4 col-form-label">To</label>:
                    <input type="email" class="ml-1 col-lg-6 form-control" readonly name="send_mail" id="send_mail"> 
                </div>
               <div class="form-group row">
                    <label for="" class="col-lg-4 col-form-label">Title</label>:
                    <input type="text" class="ml-1 col-lg-6 form-control" readonly name="send_title" id="send_title">
                </div>
               <div class="form-group row">
                    <label for="" class="col-lg-4 col-form-label">Message</label>:
                    <textarea class="ml-1 col-lg-7 form-control " rows="6" id="send_msg" name="send_msg">
                            
                    </textarea>
                </div>
            </div>
            <div class="modal-footer">
                <img src="../images/page-loading.gif" class="d-none" id="load_imag" width='100px'>
                <button type="button" class="btn btn-success"  id="modal_reply_send"> Send</button>

            </div>
            </form>
        </div>
    </div>
</div>





