<?php  
require("../lib/mod_ad.php");
?>

<script>
$(document).ready(function(){
  var dataTable = $("#tblviewnewspaperad").DataTable({
    "processing": true,
    "serverSide": true, 
    "ajax": {
      "url": "lib/mod_ad.php?type=viewNewsPaperAd",
      "type": "POST"
    },
    "columns":[
      {"data":"0"},
      {"data":"1"},
      {"data":"2"},
      {"data":"3"},
      {"data":"4"},
      {"data":"5"},
      {"data":"6"}
    ],
    "columnDefs":[
      {
        "data":null,
        "defaultContent":"<a href='#' title='Edit'><i style='color:green' class='far fa-edit'></i></a> ",
        "targets":7
      },
      {
        "data":null,
        "defaultContent":"<a href='#' title='Delete'><i style='color:red' class='far fa-trash-alt'></i></a> ",
        "targets":8
      }
    ]
  });

  $("#tblviewnewspaperad tbody").on('click','a',function(){ // on command is dynmacally content  a- anker tag
    var type= $(this).attr('title');
    var data= dataTable.row($(this).parents('tr')).data(); //parents command using for select top dstas
    var npadid = data[0];
    if(type=="Edit"){
      $("#rpanel").load("view/update_ad.php?newsadid="+npadid);
    }else if(type=="Delete"){
      swal({
      title:"Do you want to Remove this Newspaper?",
      text:"You are trying to Remove Newspaper:"+npadid,
      icon:"warning",
      buttons:true,
      dangerMode:true
      }).then((willDelete)=>{
        if(willDelete){
          var url = "lib/mod_ad.php?type=deleteNewsPaper";
          $.ajax({
          method:"POST",
          url:url,
          data:{newsadid:npadid},
          dataType:"text",
          success:function(result){
            res = result.split(",");
            if(res[0]=="0"){
              swal("Error",res[1],"error")
            }
                    
            else if(res[0]=="1"){         
              swal("Success",res[1],"success");
              $("#lnkviewad").click();
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
  <li class="breadcrumb-item active">View Ad</li>
</ol>

<h3 class="h3">View Advertisments</h3><hr>
           

<table id="tblviewnewspaperad" class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
       <th>Ad Mode</th>
       <th>Newspaper Name</th>
      <th>Colour</th>
      <th>First Word Count</th>
      <th>First Word Count Price</th>
      <th>Per Additional Word Price</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th>ID</th>
       <th>Ad Mode</th>
       <th>Newspaper Name</th>
      <th>Colour</th>
      <th>First Word Count</th>
      <th>First Word Count Price</th>
      <th>Per Additional Word Price</th>
      <th></th>
      <th></th>
    </tr>
  </tfoot>
</table>  