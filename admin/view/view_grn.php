<?php 
session_start();
require("../lib/mod_grn.php");
?>

<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="home.php">Dashboard</a>
  </li>
  <li class="breadcrumb-item" ><a href="#">GRN Management</a></li>            
  <li class="breadcrumb-item active">View GRN</li>
</ol>

<!-- New Newspaer Form -->
<h3 class="h3" >View GRN</h3>
<hr> 

<div>
	<table id="tblviewgrn" class="table table-striped animated fadeInUp fast">
		<thead>
			<tr>
				<th>ID</th>
				<th>Pulication Comapany</th>
				<th>Date</th>
				<th>Total Quantity</th>
				<th>Total</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
	</table>
	<div>
		<input type="text" name="id" id="id" value="<?php echo($emp_id) ?>" style="display: none">
	</div>
</div>

<script> 
	
$(document).ready(function(){
	var dataTable = $("#tblviewgrn").DataTable({
		"processing": true,
		"serverSide": true,
		"ajax":{
			"url":"lib/mod_grn.php?type=viewGrn",
			"type":"POST",
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
				"defaultContent":"<button class='btn btn-primary btn-sm  ' id='btn_grn_detail' >Details</button> ",
				"targets":5
			}
		]
	});

	$("#tblviewgrn tbody").on('click','button',function(){
		var type = $(this).attr('id');
		var data = dataTable.row($(this).parents('tr')).data();
		var grn_id = data[0];
		var pub = data[1];
		var date = data[2];

		if (type == "btn_grn_details"){
			url = "view/view_grn_details.php?grn_id="+grn_id;
			$("#rpanel").load(url);
			
		}
	});

})

</script>
