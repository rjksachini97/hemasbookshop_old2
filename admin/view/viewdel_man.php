<?php
require("../lib/mod_delman.php");
?>

<script>
 $(document).ready(function(){
    var dataTable = $("#tblviewdelman").DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "lib/mod_delman.php?type=viewDel",
            "type": "POST"
        },
        "columns":[
          {"data":"0"},
          {"data":"1"},
          {"data":"2"},
          {"data":"3"},
          {"data":"4"},
          {"data":"5"}
        ],
        "columnDefs":[
          {
            "data":null,
            "defaultContent":"<a href='#' title='Edit'><i style='color:green' class='far fa-edit'></i></a> ",
            "targets":5
          },
          {
            "data":null,
            "defaultContent":"<a href='#' title='Delete'><i style='color:red' class='far fa-trash-alt'></i></a> ",
            "targets":6
          }
        ]
    });
    $("#tblviewdelman tbody").on('click','a',function(){ // on command is dynmacally content  a- anker tag
        var type= $(this).attr('title');
        var data= dataTable.row($(this).parents('tr')).data(); //parents command using for select top dstas
        var dmid = data[0];
        if(type=="Edit"){
            $("#rpanel").load("view/updatedel_man.php?delmid="+dmid);
        }else if(type=="Delete"){
            swal({
            title:"Do you want to Remove this Deliveryman?",
            text:"You are trying to Remove Deliveryman:"+dmid,
            icon:"warning",
            buttons:true,
            dangerMode:true
          }).then((willDelete)=>{
              if(willDelete){
                var url = "lib/mod_delman.php?type=deleteDel";
                $.ajax({
                  method:"POST",
                  url:url,
                  data:{delmid:dmid},
                  dataType:"text",
                  success:function(result){
                    res = result.split(",");
                    if(res[0]=="0"){
                      swal("Error",res[1],"error")
                    }
                    
                    else if(res[0]=="1"){         
                      swal("Success",res[1],"success");
                      $("#lnkviewdelm").click();
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
    <a href="#">Deliveryman Management</a>
  </li>
  <li class="breadcrumb-item active">View Deliveryman</li>
</ol>
<table id="tblviewdelman" class="table table-striped">
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