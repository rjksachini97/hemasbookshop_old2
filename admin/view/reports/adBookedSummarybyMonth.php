<?php       

	require_once("../../lib/common.php"); 
	require_once("../../lib/mod_reports.php");
 

   if(isset($_GET['month'])){
    $result = $_GET['month'];
    $res = explode("_",$result);
    $month = $res[0];
    $monthname = $res[1];

    $year = $_GET['year'];
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
	<h4 class="text-center h4 font-weight-bold text-primary">Newspaper Advertisment Order Summary Report By Month </h4>
	<p class="text-center h5  text-dark"><?php echo $monthname;  ?> <?php echo $year;  ?> </p>

  <div class="d-flex justify-content-between">
    <div class="col-sm-3">
      
    </div>
    <div class="col-sm-3">
      
    </div>
    
  </div>
  <div class="col-lg-3">
         
  </div>

  <div class="ml-3">
    <?php 
    $dbobj = DB::connect();

    $sql = "SELECT count(adorder_id),sum(adorder_price) FROm tbl_ad_order WHERE MONTH(publish_date)='$month' AND YEAR(publish_date)='$year' ";

    $result = $dbobj->query($sql);
    /*$rec = $result->num_rows;
    echo("Orders : ".$rec);*/
    $rec = $result->fetch_assoc();

    echo("<p> Month and Year : ".$monthname." ".$year."</p>");
    echo("<p> No of Orders : ".$rec['count(adorder_id)']."<br/> ");
    echo("<p> Gross Total (Rs.) :".$rec['sum(adorder_price)']."</p>" );


    ?>
  </div>


 <div class="m-3">
		<table id="os_report" class="table responsive">
			<thead>
				<th>Order Id</th>
        <th>Customer Name</th>
				<th>Publish date</th>
				<th>Modes of Advertisment</th>
				<th>Status</th>
			</thead>
			<tbody id="sum_data">
        <?php 
           
           $sql_data = "SELECT ad.adorder_id,ad.newsad_mode,ad.publish_date,ad.adorder_status,cus.cus_name FROM tbl_ad_order ad JOIN tbl_reg_customer cus ON ad.cus_id = cus.cus_id WHERE MONTH(publish_date)='$month' AND YEAR(publish_date)='$year' ";

           $result_data = $dbobj->query($sql_data);
          

           while ($row = $result_data->fetch_assoc())
              {
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
            $dbobj->close();
            ?>
			</tbody>
		</table>
	</div>
</div>

<script>
$(document).ready(function(){
 
    $("#btn-export").click(function(){
      var monthname = "<?php echo $monthname ?>";
      var year = "<?php echo $year ?>";
    	
    	/*window.open('view/reports/npBookedSummaryByMonthReportPDF.php?monthname='+monthname+'&year='+year,'_blank');*/

    });
});
</script>	

