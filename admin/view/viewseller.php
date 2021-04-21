<?php
require("../lib/mod_seller.php");
?>

<script>
 $(document).ready(function(){
    var dataTable = $("#tblviewseller").DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "lib/mod_seller.php?type=viewSeller",
            "type": "POST"
        },
        "columns":[
          {"data":"0"},
          {"data":"1"},
          {"data":"2"},
          {"data":"3"},
          {"data":"4"},
        ],
        "columnDefs":[
          {
            "data":null,
            "defaultContent": "<a href='#' title='Edit'><i style='color:green' class='far fa-edit'></i></a>",
            "targets": 5
          },
          {
            "data":null,
            "defaultContent": "<a href='#' title='Delete'><i style='color:red' class='far fa-trash-alt'></i></a>",
            "targets": 6
          }
        ]
    });

    $("#tblviewseller tbody").on('click','a',function(){
      var type = $(this).attr('title');
      var data = dataTable.row($(this).parents('tr')).data();
      var sellerid = data[0];

      if(type=="Edit"){
        $("#rpanel").load("view/updateseller.php?sellid="+sellerid);
      }
      else if(type=="Delete"){
        swal({
            title:"Do you want to remove this Seller?",
            text:"You are trying to remove Seller :"+sellerid,
            icon:"warning",
            buttons:true,
            dangerMode:true
          }).then((willDelete)=>{
            if(willDelete){
              var url = "lib/mod_seller.php?type=deleteSeller";
              $.ajax({
                method:"POST",
                url:url,
                data:{sellid:sellerid},
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
    <a href="#">Seller Management</a>
  </li>
  <li class="breadcrumb-item active">View Seller</li>
</ol>
<table id="tblviewseller" class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Address</th>
      <th>Mobile</th>
      <th>Email</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Address</th>
      <th>Mobile</th>
      <th>Email</th>
      <th></th>
      <th></th>
    </tr>
  </tfoot>
</table>