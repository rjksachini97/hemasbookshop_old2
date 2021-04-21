<?php      
 
	require_once("../../lib/common.php"); 
	require_once("../../lib/mod_reports.php");
    

?>

<!------Breadcrumbs----->
<ol class="breadcrumb">  
  <li class="breadcrumb-item">
    <a href="home.php">Dashboard</a>
  </li>
  <li class="breadcrumb-item" ><a href="#" class="text-dark" onclick="funViewRep()" >Report Management</a></li><li class="breadcrumb-item active">Stock Report</li>
</ol>

<div class="d-flex justify-content-between">
         <button class="btn btn-danger" onclick="funViewRep()"><i class="fas fa-backspace"></i>Back</button>
      <!--   <button class="btn btn-info" id="btn-chart"><i class="fas fa-chart-line"></i>Chart</button>  -->

         <button class="ml-2 btn btn-success" id="btn-export"><i class="fas fa-paper-plane"></i> Export PDF</button>
</div>

<div class="card mt-3" >
	<h4 class="text-center h4 font-weight-bold text-primary">Stock Summery Report</h4>
	<p class="text-center text-primary">This will provide summury of Newspaper Quantity</p>
	<div class="d-flex justify-content-between">
      <div class="col-lg-4">
        <div class="form-group row">
          <label class="col-lg-4 col-form-label" for="inlineFormInput">Category</label>
          <select name="rep_cat" id="rep_cat" class=" col-lg-8 custom-select  mb-2">
            <?php getNPCategory() ?>
          </select>
        </div>
     </div>
 </div>

 <div class="m-3">
		<table id="sm_report" class="table responsive">
			<thead>
				<th>Newspaper ID</th>
				<th>Newspaper</th>
				<th>Available Quantity</th>
				<th>Reach Level</th>
				<th></th>
				<th>status</th>
			</thead>
			<tbody id="sum_data">
				
			</tbody>
		</table>
	</div>
</div>

<script>
$(document).ready(function(){
    var dataTable = $("#sm_report").DataTable({
        "processing": true,
        "serverSide" : true,
        "retrieve": true,
        "dom": 'Bfrtip',
        "ajax":{
            "url":"lib/mod_reports.php?type=stockSummary",
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
                "targets": [4],
                "visible": false,
                "searchable": true
            },
            {
            	"targets" : [5],
            	"render" : function(data, type, row){
            		if(row[2]=="0"){
            			return "<p class='text-danger'>Out Of Stock</p>";
            		}else{
            			return "<p>Low Stock</p>";
            		}
            	}
            }
           
         ]
         
    });  

       $("#rep_cat").on('change',function(){
    	var rep_cat =$(this).val() ;
    	dataTable.column(4).search( rep_cat).draw();
        	
    });

    

    $("#btn-export").click(function(){
    	var category =$("#rep_cat").val();
    	
    	window.open('view/reports/stockSummaryReportPDF.php?category='+category,'_blank');

    });

  /*  $("#btn-chart").click(function(){
      var category =$("#rep_cat").val();
      
      window.open('view/reports/stockSummaryReportChart.php?category='+category,'_blank');

    });*/

   
});
</script>	

