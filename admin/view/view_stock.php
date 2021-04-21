<?php
 session_start();
require("../lib/mod_stock.php");
require ("../lib/common.php");
?>

<!-- Breadcrumbs--> 
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="home.php">Dashboard</a>
  </li>
  <li class="breadcrumb-item" ><a href="#">Stock Management</a></li>            
  <li class="breadcrumb-item active">View Stock</li>
</ol>

<!-- Content Row -->
<div class="row">

  <!-- Total Newspaper Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-2">Total newspaper Batches</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              <?php
                $count = NPCount();
                if($count=="0"){
                    echo ("<p class='text-danger'>0</p>");
                }else{
                    echo ("<p class='text-success'>".$count."</p>");
                }
                ?>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-boxes fa-2x text-gray-600"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

              <!-- Orders Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-secondary text-uppercase mb-2">Low Stock Newspaper
                      </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php
                         $level = getNPLevel();
                            if($level=="0"){
                                echo ("<p class='text-danger'>0</p>");
                            }else{
                                echo ("<p class='text-success'>".$level."</p>");
                            }
                            ?> 

                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-box fa-2x text-gray-600"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

              <!-- Out of Stocks Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-secondary text-uppercase mb-2">Out of Stocks</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php
                            $stocklevel = getNPOutStock();
                            if($stocklevel=="0"){
                                echo ("<p class='text-danger'>0</p>");
                            }else{
                                echo ("<p class='text-success'>".$stocklevel."</p>");

                            }
                            ?>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-box-open fa-2x text-gray-600"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>




<!-- New Newspaer Form -->
<h3 class="h3" >View All Stock Batches</h3> 
<hr>
<br>

<div class="view_stock">
<table id="tblviewstock" class="isplay nowrap table table-striped animated fadeInUp fast">
  <thead>
    <tr>
      <th>ID</th>
      <th>Newspaper</th>
      <th>Quantity</th>
      <th>Reach Level</th>
      <th>status</th>
      <th></th>
    </tr>
  </thead>
  <tbody id="stockBody">
    
  </tbody>
</table>
</div>

<div class="modal fade" id="Change_Reorder" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="formrlevel"> 
            <div class="modal-header">
                                   
                
                <div class="modal-title" >
                    <h5 >Change Reorder Level</h5>                 
                </div>                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="msg_body">
                
               <div class="form-group row">
                    <label for="" class="col-lg-4 col-form-label">Newspaper ID</label>:
                    <input type="email" class="ml-1 col-lg-4 form-control" readonly name="npid" id="npid"> 
                </div>
                <div class="form-group row">
                    <label for="" class="col-lg-4 col-form-label">Rorder Level</label>:
                    <input type="email" class="ml-1 col-lg-3 form-control" readonly name="rlevel" id="rlevel"> 
                </div>
               <div class="form-group row">
                    <label for="" class="col-lg-4 col-form-label">New Level</label>:
                    <input type="text" class="ml-1 col-lg-3 form-control"  name="newlevel" id="newlevel">
                </div>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success"  id="rlevel_confirm"> Confirm</button>

            </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

       dataTable = $('#tblviewstock').DataTable( {
                "processing": true,
                "serverSide": true,
                "dom": 'Bfrtip',

                "ajax": {
                    "url": "lib/mod_stock.php?type=viewStock",
                    "type": "POST"
                },
                "columns": [
                    {"data": "0"},
                    {"data": "1"},
                    {"data": "2"},
                    {"data": "3"},
                    {"data": "4"},
                    {"data": "5"},
                ],               
                "order": [[2,"asc"]],
                "columnDefs":[
                    {
                        "data": null,
                        "render":function(data,type,row){
                            if(row[2] ==="0"){
                                return "<p class='text-light text-center bg-danger'>Out of Stock</p>"
                            }else if(row[2] >= row[3]){
                                 return "<p class='text-light text-center bg-success'>In Stock</p>"
                            }else if(row[2] < row[3]){
                                return "<p class='text-light text-center bg-warning'>Low Stock</p>"
                            }
                        },
                        "targets":4
                        
                        
                    },
                    {
                        "data": null,
                        "defaultContent":"<button class='btn btn-primary' id='changeReorder'> Change Reorder </button> <button class='btn btn-success' id='view'> Batch </button>  ",
                        "targets":5
                    }
                ]
  });

  $("#tblviewstock tbody").on('click','button',function() {
            var type = $(this).attr('id');
            var data = dataTable.row($(this).parents('tr')).data();
            var npid = data[0];
            var npname = data[1];
            var qty = data[2];
            var rlevel = data[3];

            if(type =="view"){
                url = "view/view_batch_details.php?npid="+npid+"&npname="+npname+"&qty="+qty;
                $("#rpanel").load(url,'','top=500');            
            }else if(type =="changeReorder"){
                $("#npid").val(npid);
                $("#rlevel").val(rlevel);
                $("#Change_Reorder").modal();     
            } 


        });
        $("#rlevel_confirm").click(function(){
            var newlevel = $("#newlevel").val();
            var inputPattern = /^[0-9]*$/;
            if(!newlevel.match(inputPattern) || newlevel==""){
                swal("Error","Input is not valid","error");
                return;
            }
            $("#Change_Reorder").modal("hide"); 
            var data = $("#formrlevel").serialize();
             var url= "lib/mod_stock.php?type=changerlevel";
             $.ajax({
                 method:"POST",
                 url:url,
                 data:data,
                 dataType:"text",
                 success:function (result) {
                    res = result.split(",");
                    msg = res[0].trim();
                    if(msg =="0"){
                        swal("error",res[1],"error")
                    }else{
                        swal("success",res[1],"success");
                        setTimeout(function() {
                            funViewStock();
                        }, 300);
                        
                    }
                   
                 },
                 error:function (eobj,err,etxt) {
                     console.log(etxt);
                 }
             });  
        });
        


    });
 </script>