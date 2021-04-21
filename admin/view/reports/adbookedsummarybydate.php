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
  <li class="breadcrumb-item" ><a href="#" class="text-dark" onclick="funViewRep()" >Report Management</a></li><li class="breadcrumb-item active">Order Report</li>
</ol>

<div class="d-flex justify-content-between">
         <button class="btn btn-danger" onclick="funViewRep()"><i class="fas fa-backspace"></i>Back</button><button class="ml-2 btn btn-success" id="btn-export"><i class="fas fa-paper-plane"></i> Export PDF</button>
</div>

<div class="card mt-3" >
	<h4 class="text-center h4 font-weight-bold text-primary">Newspaper Advertisment Order Summary Report </h4>
	<p class="text-center h5  text-dark">Form <?php echo $sdate;  ?> TO <?php echo $edate;  ?> </p>


 <div class="m-3">
		<table id="os_report" class="table responsive">
			<thead>
				<th>Order Id</th>
        <th>Customer Name</th>
				<th>Publish Date</th>
				<th>Mode of Advertisment</th>
				<th>Status</th>
			</thead>
			<tbody id="sum_data">
        <?php 
           $dbobj = DB::connect();
           $sql = "SELECT ad.adorder_id,ad.newsad_mode,ad.publish_date,ad.adorder_status,cus.cus_name FROM tbl_ad_order ad JOIN tbl_reg_customer cus ON ad.cus_id = cus.cus_id WHERE publish_date BETWEEN '$sdate' AND '$edate' ORDER BY adorder_id ";

           $result = $dbobj->query($sql);
           $rec = $result->num_rows;
           echo("Orders : ".$rec);

           while ($row = $result->fetch_assoc()){ 
            ?>
           
            <tr>
              <td><?php echo ($row['adorder_id']) ?></td>
              <td><?php echo($row['cus_name']) ?></td>
              <td><?php echo($row['publish_date']) ?></td>
              <td><?php echo ($row['newsad_mode']) ?></td>

             <?php $status = $row['adorder_status'];
                if($status == "0"){
                  $status = "Not Confirmed";
                }else if ($status == "1"){
                  $status = "Confirmed";
                }
                ?>
              <td><?php echo ($status)  ?></td>  
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
      var sdate = "<?php echo $sdate ?>";
      var edate = "<?php echo $edate ?>";
    	
    	window.open('view/reports/adbookedsummarybydatePDF.php?sdate='+sdate+'&edate='+edate,'_blank');

    });
});
</script>	

