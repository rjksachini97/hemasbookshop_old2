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
         <button class="btn btn-danger" onclick="funViewRep()"><i class="fas fa-backspace"></i>Back</button><button class="ml-2 btn btn-success" id="btn-export"><i class="fas fa-paper-plane"></i> Export PDF</button>
</div>

<div class="card mt-3" >
	<h4 class="text-center h4 font-weight-bold text-primary">Out of Stock Summery Report</h4>
	<p class="text-center text-primary">This will provide summury of Out of Stock Newspapers </p>


 <div class="m-3">
		<table id="os_report" class="table responsive">
			<thead>
				<th>Newspaper ID</th>
				<th>Newspaper</th>
				<th>Category</th>
				<th>Minimum Level</th>
			</thead>
			<tbody id="sum_data">
        <?php
          $dbobj = DB::connect();

          $sql = "SELECT newsp_id,newsp_name,npcat_category,newsp_rlevel FROM tbl_newspaper np JOIN tbl_newspaper_category cat ON np.npcat_id = cat.npcat_id WHERE newsp_qty='0' ";

          $result = $dbobj->query($sql);

          $rec = $result->num_rows;

          $date = date("Y-m-d",time());

          echo("Date :".$date."<br/>");

          echo("No of Newspaper :".$rec);

          while($row = $result->fetch_assoc()) {
            ?>

            <tr>
              <td><?php echo($row['newsp_id']) ?></td>
              <td><?php echo($row['newsp_name']) ?></td>
              <td><?php echo($row['npcat_category']) ?></td>
              <td><?php echo($row['newsp_rlevel']) ?></td>
            </tr>

            <?php
          }
        ?>
				
			</tbody>
		</table>
	</div>
</div>

<script>
$(document).ready(function(){
 
    $("#btn-export").click(function(){
    	
    	window.open('view/reports/outStockSummaryReportPDF.php','_blank');

    });
});
</script>	

