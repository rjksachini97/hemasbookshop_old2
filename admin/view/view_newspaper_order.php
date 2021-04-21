<?php 
require("../lib/mod_news_order.php");  
?>

<script>
 $(document).ready(function(){
    var dataTable = $("#tblviewnewsorder").DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
           "url": "lib/mod_news_order.php?type=viewNPOrders",
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
                  return "<a href='#' title='completed' ><i class='fas fa-1x text-primary fa-check-double '></i></a>"
                }else{
                   return "<p class='text-success'>completed</p>"
                }
            },
            "targets": 5
          },
          {
            "data":null,
            "defaultContent":"<a href='#' title='view_orders'><i class='fas fa-2x fa-clipboard-list'></i></a> ",
            "targets": 6
          },
        ]
    });
    $("#tblviewnewsorder tbody").on('click','a',function(){ // on command is dynmacally content  a- anker tag
        var type= $(this).attr('title');
        var data= dataTable.row($(this).parents('tr')).data(); //parents command using for select top data
        var oid = data[0];

        if(type=="Completed"){
            swal({
            title:"Do you want to Confirm this Booking?",
            text:"You are trying to Confirm this Booking:"+oid,
            icon:"warning",
            buttons:true,
            dangerMode:true
          }).then((willDelete)=>{
              if(willDelete){
                var url = "lib/mod_news_order.php?type=completeOrder";
                $.ajax({
                  method:"POST",
                  url:url,
                  data:{order_id:oid},  //order_id mysql
                  dataType:"text",
                  success:function(result){

                  	if(result == 1){
                  		swal("Successfully Updted!", "Success");
                  		$("#lnkviewnewsorder").click();
                  	}
                  	else{
                  		swal("Error", "Some problem Occured in the system", "error");
                  	}
                  },
                  error:function(eobj,etxt,err){
                    console.log(etxt);
                  }
                });
              }
          });
        }else if(type=="view_orders"){
        	var url = "lib/mod_news_order.php?type=viewNPOrderDetails";
        	$.ajax({
        		method:"POST",
        		url:url,
        		data:{order_id,oid},
        		dataType:"text",
        		success:function(result){
        			$("#vieworderdetails").html(result);
        			$("#viewordermodel").modal("show");
        		},
        		error:function(eobj,etxt,err){
        			console.log(etxt);
        		}
        	});
        }  
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
  <li class="breadcrumb-item active">View Newspaper Order</li>
</ol>
<!--------- Breadcrumb end--------->

<!--------- Heading start--------->
<h2>Newspaper Orders for the Company</h2><br>
<!--------- Heading end--------->


<table id="tblviewnewsorder" class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Customer Name</th>
      <th>Order Date</th>
      <th>Delivery Date</th>
      <th>Total Price</th>
      <th>Delivery Details</th>
      <th>Status</th>
      <th></th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th>ID</th>
      <th>Customer Name</th>
      <th>Order Date</th>
      <th>Delivery Date</th>
      <th>Total Price</th>
      <th>Delivery Details</th>
      <th>Status</th>
      <th></th>
    </tr>
  </tfoot>
</table>

<!--view full details model-->
<div class="modal fade" id="viewordermodel">
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
						<div class="form-horizontal" id="vieworderdetails">
							


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

<!--  --------------Send Delivery Note------------- -->

<div class="modal fade" id="sendDelivery" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="formSendemail"> 
            <div class="modal-header">
                                   
                
                <div class="modal-title" >
                    <h5 >Inform about Delivery</h5>                 
                </div>                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="del_body">
                <input type="hidden" name="id" id="id" value="" >
                <div class="form-group row">
                <label for="cmbdelname" class="col-lg-4 col-form-label">Deliveryman</label>
                <div class="col-sm-3">
                  <select class="form-control" name="cmbdelname" id="cmbdelname">
                    <option>-- Select Deliveryman--</option>
                    <?php getdeliveryman(); ?>
                  </select>
                </div>
              </div>
                <div class="form-group row">
                  <label for="veh_no" class="col-lg-4 col-form-label">Vehicle Number</label>:
                    <div class="col-sm-3">
                    <select class="form-control" name="veh_no" id="veh_no">
                    <option>--Select Vehicle--</option>
                    <option>QL-9904</option>
                    <option>ER-01860</option>
                  </select>
                </div>
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
                <img src="../resources/img/page-loading.gif" class="d-none" id="load_imag" width='100px'>
                <button type="button" class="btn btn-success"  id="modal_reply_send"> Send</button>

            </div>
            </form>
        </div>
    </div>
</div>
