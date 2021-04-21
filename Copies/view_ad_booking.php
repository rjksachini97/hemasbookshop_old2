 <?php 
require("../lib/mod_ad_booking.php");

?>

<script>
 $(document).ready(function(){
    var dataTable = $("#tblviewadbkings").DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "lib/mod_ad_booking.php?type=viewadbooking",
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
            "render":function(data,type,row){
              return (data=="1")?"Approved":"Approval Pending";
            },
            "targets": 6
          },
           {
            "data":null,
            "defaultContent": "<a href='#' title='Open_Slip' data-toggle='modal' data-target='#viewSlip'><i class='fas fa-money-check-alt'></i></a>",
            "targets": 7
          },
          {
            "data":"6",
            "render":function(data,type,row){
              return (data=="1")?"Yes":"No";
            },
            "targets": 8
          },

        {
            "data":null,
            "defaultContent": "<a href='#' title='Full_payment'><i class='fas fa-calendar-check'></i></a>",
            "targets": 9
          },
    
          {
            "data":null,
            "defaultContent": "<a href='#' title='View_details' data-toggle='modal' data-target='#viewdetails'><i class='fas fa-list-alt'></i></a>",
            "targets": 10
          },
          {
            "data":null,
            "defaultContent": "<a href='#' title='Cancel_Booking'><i style='color:red' class='fas fa-window-close'></i></a>",
            "targets": 11
          }
        ]
    });

    $("#tblviewadbkings tbody").on('click','a',function(){
      var type = $(this).attr('title');
      var data = dataTable.row($(this).parents('tr')).data();
      var eid = data[0];

      if(type=="Cancel_Booking"){
        swal({
            title:"Do you want to Cancel this Booking?",
            text:"You are trying to Cancel this Booking :"+eid,
            icon:"warning",
            buttons:true,
            dangerMode:true
          }).then((willDelete)=>{
            if(willDelete){
              var url = "lib/mod_ad_booking.php?type=deleteadbooking";
              $.ajax({
                method:"POST",
                url:url,
                data:{booking_id:eid},
                dataType:"text",
                success:function(result){
                  if(result == 1){
                    swal('Success', 'Succesfully removed', 'success');
                    dataTable.row($(this).parents('tr')).remove().draw();
                  }else{
                    swal('Error', 'Some problem occured in the system', 'error');
                  }
                },
                error:function(eobj,etxt,err){
                  console.log(etxt);
                }
              });
            }
          });
      }else if(type=="View_details"){
        var url = "lib/mod_ad_booking.php?type=viewadBookingDetails";
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

   }else if(type=="Open_Slip"){
        var url = "lib/mod_ad_booking.php?type=AdviewSlip";
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
      }else if(type=="Full_payment"){
        swal({
            title:"Do you want to Approve this Booking?",
            text:"You are trying to Approve this Booking :"+eid,
            icon:"warning",
            buttons:true,
            dangerMode:true
          }).then((willDelete)=>{
            if(willDelete){
              var url = "lib/mod_ad_booking.php?type=confirmBooking";
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
        
      }else if(type=="Full_payment"){
        swal({
            title:"Fully paid?",
            text:"You are trying to Approve for Full payment :"+eid,
            icon:"warning",
            buttons:true,
            dangerMode:true
          }).then((willDelete)=>{
            if(willDelete){
              var url = "lib/mod_ad_booking.php?type=confirmfullpayment";
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
  <li class="breadcrumb-item" ><a href="#">Booking Management</a></li>            
  <li class="breadcrumb-item active">View Ad Booking</li>
</ol>

<!-- New Newspaer Form -->
<h3 class="h3" >View Advertisment Booking</h3>
<hr>
<table id="tblviewadbkings" class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Cus ID</th>
      <th>Ad Mode</th>
      <th>News Paper</th>
      <th>Publish Date</th>
      <th>Total Price</th>
      <th>Status</th>
      <th>Uploaded Slip</th>
      <th>Fully paid</th>
      <th>Full payment</th>
      <th>View Details</th>
      <th>Cancel Booking</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th>ID</th>
      <th>Cus ID</th>
      <th>Ad Mode</th>
      <th>News Paper</th>
      <th>Publish Date</th>
      <th>Total Price</th>
      <th>Status</th>
      <th>Uploaded Slip</th>
      <th>Fully paid</th>
      <th>Full payment</th>
      <th>View Details</th>
      <th>Cancel Booking</th>
    </tr>
  </tfoot>
</table>

 <!-- View full details Modal -->
            <div class="modal fade" id="viewdetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Booking Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="container">
                      <div class="row">
                          <div class="col-sm-6">
                            <div class="form-horizontal" id="view-booking-details">    
                                                   
                            </div>
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