<?php
require("../lib/mod_newspaper.php");
?> 

<script>
$(document).ready(function(){
  var dataTable = $("#tblviewnewspaper").DataTable({
    "processing": true,
    "serverSide": true, 
    "ajax": {
      "url": "lib/mod_newspaper.php?type=viewNewsPaper",
      "type": "POST"
    },
    "columns":[
      {"data":"0"
        "visible": false,
        "searchable": false},
      {"data":"1"},
      {"data":"2"},
      {"data":"3"},
      {"data":"4"},
      {"data":"5"},
      {"data":"6"},
      {"data":"7"},
    ],
    "columnDefs":[
      {
        "data":null,
        "defaultContent":"<a href='#' title='Edit'><i style='color:green' class='far fa-edit'></i></a> ",
        "targets":8
      },
      {
        "data":null,
        "defaultContent":"<a href='#' title='Delete'><i style='color:red' class='far fa-trash-alt'></i></a> ",
        "targets":9
      }
    ]
  });

  $("#tblviewnewspaper tbody").on('click','a',function(){ // on command is dynmacally content  a- anker tag
    var type= $(this).attr('title');
    var data= dataTable.row($(this).parents('tr')).data(); //parents command using for select top dstas
    var npid = data[0];
    if(type=="Edit"){
      $("#rpanel").load("view/updatenewspaper.php?newspid="+npid);
    }else if(type=="Delete"){
      swal({
      title:"Do you want to Remove this Newspaper?",
      text:"You are trying to Remove Newspaper:"+npid,
      icon:"warning",
      buttons:true,
      dangerMode:true
      }).then((willDelete)=>{
        if(willDelete){
          var url = "lib/mod_newspaper.php?type=deleteNewsPaper";
          $.ajax({
          method:"POST",
          url:url,
          data:{newspid:npid},
          dataType:"text",
          success:function(result){
            res = result.split(",");
            if(res[0]=="0"){
              swal("Error",res[1],"error")
            }
                    
            else if(res[0]=="1"){         
              swal("Success",res[1],"success");
              $("#lnkviewnewspaper").click();
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

 <!--Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="home.php">Dashboard</a>
  </li>
  <li class="breadcrumb-item">
    <a href="#">Newspaer Management</a>
  </li>
  <li class="breadcrumb-item active">View Newspaepr</li>
</ol>

<h3 class="h3" >View Newspapers</h3>
<hr>
    

<table id="tblviewnewspaper" class="table table-striped">
  <thead>
    <tr>
    
       <th>Name</th>
      <th>Category</th>
      <th>Pub Company</th>
      <th>Medium</th>
      <th>Price</th>
      <th>Qty</th>
      <th>Rlevel</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      
       <th>Name</th>
      <th>Category</th>
      <th>Pub Company</th>
      <th>Medium</th>
      <th>Price</th>
      <th>Qty</th>
      <th>Rlevel</th>
      <th></th>
      <th></th>
    </tr>
  </tfoot>
</table>  