<?php
require("../lib/mod_ad_category.php");
?>

<script>
$(document).ready(function(){
  var dataTable = $("#tblviewadcat").DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": {
      "url": "lib/mod_ad_category.php?type=viewAdCat",
      "type": "POST"
    },
    "columns":[
      {"data":"0"},
      {"data":"1"}
    ],
    "columnDefs":[
      {
        "data":null,
        "defaultContent":"<a href='#' title='Edit'><i style='color:green' class='far fa-edit'></i></a> ",
        "targets":2
      },
      {
        "data":null,
        "defaultContent":"<a href='#' title='Delete'><i style='color:red' class='far fa-trash-alt'></i></a> ",
        "targets":3
      }
    ]
  });

  $("#tblviewadcat tbody").on('click','a',function(){ // on command is dynmacally content  a- anker tag
    var type= $(this).attr('title');
    var data= dataTable.row($(this).parents('tr')).data(); //parents command using for select top dstas
    var acid = data[0];
    if(type=="Edit"){
      $("#rpanel").load("view/updatead_category.php?adcatid="+acid);
    }else if(type=="Delete"){
      swal({
      title:"Do you want to Remove this Record?",
      text:"You are trying to Remove Record:"+acid,
      icon:"warning",
      buttons:true,
      dangerMode:true
      }).then((willDelete)=>{
        if(willDelete){
          var url = "lib/mod_ad_category.php?type=deleteAdCat";
          $.ajax({
          method:"POST",
          url:url,
          data:{adcatid:acid},
          dataType:"text",
          success:function(result){
            res = result.split(",");
            if(res[0]=="0"){
              swal("Error",res[1],"error")
            }
                    
            else if(res[0]=="1"){         
              swal("Success",res[1],"success");
              $("#lnkviewadcategory").click();
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
  <li class="breadcrumb-item" ><a href="#">Ad Management</a></li>            
  <li class="breadcrumb-item active">New Ad Category</li>
</ol>
<table id="tblviewadcat" class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Category</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th>ID</th>
      <th>Category</th>
      <th></th>
      <th></th>
    </tr>
  </tfoot>
</table>  