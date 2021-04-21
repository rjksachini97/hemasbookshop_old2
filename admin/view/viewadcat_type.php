<?php
require("../lib/mod_adcat_type.php");
?>

<script>
$(document).ready(function(){
  var dataTable = $("#tblviewadcattype").DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
      "url": "lib/mod_adcat_type.php?type=viewAdCatType",
      "type": "POST"
    },
    "columns":[
      {"data":"0"},
      {"data":"1"},
      {"data":"2"}
    ],
    "columnDefs":[
      {
        "data":null,
        "defaultContent":"<a href='#' title='Edit'><i style='color:green' class='far fa-edit'></i></a> ",
        "targets":3
      },
      {
        "data":null,
        "defaultContent":"<a href='#' title='Delete'><i style='color:red' class='far fa-trash-alt'></i></a> ",
        "targets":4
      }
    ]
  });

  $("#tblviewadcattype tbody").on('click','a',function(){ // on command is dynmacally content  a- anker tag
    var type= $(this).attr('title');
    var data= dataTable.row($(this).parents('tr')).data(); //parents command using for select top dstas
    var actid = data[0];
    if(type=="Edit"){
      $("#rpanel").load("view/updateadcat_type.php?adctid="+actid);
    }else if(type=="Delete"){
      swal({
      title:"Do you want to Remove this Record?",
      text:"You are trying to Remove Record:"+actid,
      icon:"warning",
      buttons:true,
      dangerMode:true
      }).then((willDelete)=>{
        if(willDelete){
          var url = "lib/mod_adcat_type.php?type=deleteAdCatType";
          $.ajax({
          method:"POST",
          url:url,
          data:{adctid:actid},
          dataType:"text",
          success:function(result){
            res = result.split(",");
            if(res[0]=="0"){
              swal("Error",res[1],"error")
            }
                    
            else if(res[0]=="1"){         
              swal("Success",res[1],"success");
              $("#lnkviewadcattype").click();
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
    <a href="#">Ad Management</a>
  </li>
  <li class="breadcrumb-item active">View Ad Category Type</li>
</ol>
<table id="tblviewadcattype" class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Category</th>
      <th>Name</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th>ID</th>
      <th>Category</th>
      <th>Name</th>
      <th></th>
      <th></th>
    </tr>
  </tfoot>
</table>  