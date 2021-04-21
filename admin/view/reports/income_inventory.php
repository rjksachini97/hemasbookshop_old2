<?php       

	require_once("../../lib/common.php"); 
	require_once("../../lib/mod_reports.php");
  if(isset($_GET['sdate'])){
        $sdate = $_GET['sdate'];
        $edate = $_GET['edate'];        

    }
   

?>

<!------Breadcrumbs----->
<ol class="breadcrumb">  
  <li class="breadcrumb-item">
    <a href="home.php">Dashboard</a>
  </li>
  <li class="breadcrumb-item" ><a href="#" class="text-dark" onclick="funViewRep()" >Report Management</a></li><li class="breadcrumb-item active">Stock Report</li>
</ol>

<div class="d-flex justify-content-between">
         <button class="btn btn-danger" onclick="funViewRep()"><i class="fas fa-backspace"></i>Back</button><button class="ml-2 btn btn-success" id="btn-export"><i class="fas fa-paper-plane"></i> Export PDF</button>
</div>

<div class="card mt-3" >
	<h4 class="text-center h4 font-weight-bold text-primary">Income Quantity of Newspapers From <?php echo($sdate) ?> To <?php echo($edate) ?></h4>
	<p class="text-center text-primary">This will provide summury of Received Newspapers </p>


 <div class="m-3">
		<table id="os_report" class="table responsive">
			<thead>
				<th>No</th>
        <th>Received Date</th>
				<th>Newspaper</th>
				<th>Quantity</th>
				<th>Available</th>
			</thead>
			<tbody id="sum_data">
        <?php incomeInventory($sdate,$edate)?>
			</tbody>
		</table>
	</div>
</div>

<script>
$(document).ready(function(){
 
    $("#btn-export").click(function(){
      var sdate = "<?php echo $sdate ?>";
      var edate = "<?php echo $edate ?>";
    	
    	window.open('view/reports/income_inventoryReportPDF.php?sdate='+sdate+'&edate='+edate,'_blank');

    });
});
</script>	

