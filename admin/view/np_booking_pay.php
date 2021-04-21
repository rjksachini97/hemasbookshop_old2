 <?php
require("../lib/mod_booking_pay.php");

?>
<script>
 $(document).ready(function(){
    var dataTable = $("#tblviewnppay").DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "lib/mod_booking_pay.php?type=viewnpbookingpay",
            "type": "POST"
        },
        "columns":[
          {"data":"0"},
          {"data":"1"},
          {"data":"2"},
          ],
        "columnDefs":[
    /*     {
            "data":"3",
            "render":function(data,type,row){
              return (data=="1")?"Approved":"Approval Pending";
            },
            "targets": 3
          },  */

           {
            "data":null,
            "defaultContent": "<a href='#' title='Open_Slip' data-toggle='modal' data-target='#viewSlip'><i class='fas fa-money-check-alt'></i></a>",
            "targets": 3
          },
            {
            "data":"3",
            "render":function(data,type,row){
              return (data=="1")?"Yes":"No";
            },
            "targets": 4
          },
          {
            "data":null,
            "defaultContent": "<a href='#' title='Full_payment'><i class='fas fa-calendar-check'></i></a>",
            "targets": 5
          },

        
		 {
            "data":null,
            "defaultContent": "<a href='#' title='View_details' data-toggle='modal' data-target='#viewdetails'><i class='fas fa-list-alt'></i></a>",
            "targets": 6
          },
         
        ]
    });

  $("#tblviewnppay tbody").on('click','a',function(){
      var type = $(this).attr('title');
      var data = dataTable.row($(this).parents('tr')).data();
      var eid = data[0];
      
 		if(type=="View_details"){
        var url = "lib/mod_booking_pay.php?type=viewadBookingPayDetails";
         $.ajax({
            method:"POST",
            url:url,
            data:{booking_id:eid},
            dataType:"text",
            success:function(result){
              $("#view-booking-details").html(result);
            },
            error:function(eobj,etxt,err){
              console.log(etxt);
            }
          });

   }

      else if(type=="Open_Slip"){
        var url = "lib/mod_booking_pay.php?type=AdviewSlip";
         $.ajax({
            method:"POST",
            url:url,
            data:{event_id:eid},
            dataType:"text",
            success:function(result){
              $("#view-slip").html(result);
            },
            error:function(eobj,etxt,err){
              console.log(etxt);
            }
          });
      }
     /* else if(type=="Full_payment"){
        swal({
            title:"Do you want to Approve this Booking?",
            text:"You are trying to Approve this Booking :"+eid,
            icon:"warning",
            buttons:true,
            dangerMode:true
          }).then((willDelete)=>{
            if(willDelete){
              var url = "lib/mod_booking_pay.php?type=confirmBooking";
             $.ajax({
                method:"POST",
                url:url,
                data:{booking_id:eid},
                dataType:"text",
                success:function(result){

                  if(result == 1){
                    swal("Approved", "Booking has been approved", "success")
                    dataTable.row($(this).parents('tr')).draw();
                  }else{
                    swal("Error!", "Some problem occured in the system", "error")
                  }
                },
                error:function(eobj,etxt,err){
                  console.log(etxt);
                }
              });
            }
          });
        
      }*/
      else if(type=="Full_payment"){
        swal({
            title:"Fully paid?",
            text:"You are trying to Approve for Full payment :"+eid,
            icon:"warning",
            buttons:true,
            dangerMode:true
          }).then((willDelete)=>{
            if(willDelete){
              var url = "lib/mod_booking_pay.php?type=confirmfullpayment";
             $.ajax({
                method:"POST",
                url:url,
                data:{booking_id:eid},
                dataType:"text",
                success:function(result){
                  if(result == 1){
                    swal("Full paid", "Full payment has been approved", "success")
                    dataTable.row($(this).parents('tr')).draw();
                  }else{
                    swal("Error!", "Some problem occured in the system", "error")
                  }
                },
                error:function(eobj,etxt,err){
                  console.log(etxt);
                }
              });
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
  <li class="breadcrumb-item" ><a href="#">Payment & Billing</a></li>            
  <li class="breadcrumb-item active">View Newspaper Booking Payments</li>
</ol>

<!-- New Newspaer Form -->
<h3 class="h3" >View Newspaper Booking Payments</h3>
<hr>
<table id="tblviewnppay" class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Cus ID</th>
      <th>Total Price</th>
    <!--  <th>Status</th>  -->
      <th>Uploaded Slip</th>
      <th>Fully paid</th>
      <th>Full payment</th>
      <th>View Details</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
	  <th>ID</th>
      <th>Cus ID</th>
      <th>Total Price</th>
    <!--  <th>Status</th>  -->
      <th>Uploaded Slip</th>
      <th>Fully paid</th>
      <th>Full payment</th>
      <th>View Details</th>
    </tr>
  </tfoot>
</table>


            <!-- View Bank Slip Modal -->
            <div class="modal fade" id="viewSlip" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bank Slip</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div id="view-slip"></div>
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
