<?php
require("../lib/mod_newspaper_category.php");
?>

<script>
$(document).ready(function(){
  var dataTable = $("#tblviewnewspapercat").DataTable({
    "processing": true,
    "serverSide": true, 
    "ajax": {
      "url": "lib/mod_newspaper_category.php?type=viewNewsPaperCat",
      "type": "POST"
    },
    "columns":[
      {"data":"0"},
      {"data":"1"}
    ]
 
  });

  $("#tblviewnewspapercat tbody").on('click','a',function(){ // on command is dynmacally content  a- anker tag
     
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
    

<table id="tblviewnewspapercat" class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
       <th>Name</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th>ID</th>
       <th>Name</th>
    </tr>
  </tfoot>
</table>  