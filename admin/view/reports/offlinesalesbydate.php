<?php       

	require_once("../../lib/common.php"); 
	require_once("../../lib/mod_reports.php");
  if(isset($_GET['sdate'])){
        $sdate = $_GET['sdate'];
        $edate = $_GET['edate'];
        $income = $_GET['income'];        
   }
   

?>

<!------Breadcrumbs----->
<ol class="breadcrumb">  
  <li class="breadcrumb-item">
    <a href="home.php">Dashboard</a>
  </li>
  <li class="breadcrumb-item" ><a href="#" class="text-dark" onclick="funViewRep()" >Report Management</a></li><li class="breadcrumb-item active">Sales Report</li>
</ol>

<div class="d-flex justify-content-between">
         <button class="btn btn-danger" onclick="funViewRep()"><i class="fas fa-backspace"></i>Back</button><button class="ml-2 btn btn-success" id="btn-export"><i class="fas fa-paper-plane"></i> Export PDF</button>
</div>

<div class="card mt-3" >
    <h4 class="text-center h4 font-weight-bold text-dark">Offline Sales Report More than Rs <?php echo $income ?> </h4>
    <p class="text-center h5  text-dark">Form <?php echo $sdate;  ?> TO <?php echo $edate;  ?> </p>

    <div class="d-flex justify-content-between ">      
          <div class="col-sm-3">
            
          </div>
          <div class="col-sm-3">              
            
          </div> 
    </div>
     <div class="col-lg-3">
         
     </div>
     <div class="m-3">
        <table id="ls_report" class="table responsive table-bordered">
            <thead class="thead-light">
                <th>Order Id</th>
                <th>Customer Name</th>
                <th>Order Date</th>
                <th>Total(Rs) </th>
                <th>Paid(Rs)</th>
                <th>Status</th>
            </thead>
            <tbody id="sum_data">
       <?php 
        $dbobj  =DB::connect();
        $sql = "SELECT * From tbl_invoice inv JOIN tbl_reg_customer cus ON inv.cus_id = cus.cus_id WHERE inv_type ='offline' AND inv_date BETWEEN '$sdate' AND '$edate' AND inv_total > '$income' ORDER BY inv_id ";
        $result = $dbobj->query($sql);
        $rec = $result->num_rows;
        echo("Orders : ".$rec);

        while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
        <td><?php echo ($row['inv_id']) ?> </td>
        <td><?php echo ( $row['cus_name'])  ?> </td>
        <td><?php echo ( $row['inv_date'] ) ?> </td>
        <td><?php echo ( $row['inv_total'] ) ?> </td>
        <td><?php echo ( $row['inv_paid'] ) ?> </td>
        <?php $status = $row['inv_status'];
             if($status == "0") {
             $status = "canceled";
            }else if($status =="1"){
             $status = "Not Confirm";
            } else if($status =="2"){
             $status = "Confirmed";
            } else if($status =="3"){
              $status = "Deliverd";
             }  
              ?>
             <td><?php echo ( $status) ?> </td>
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
        var sdate =" <?php echo $sdate  ?>";
        var edate =" <?php echo $edate  ?>";
            
        window.open('view/reports/offlinesalesbydatePDF.php?sdate='+sdate+'&edate='+edate,'_blank');

    });
        
        
        
        
});
</script> 
