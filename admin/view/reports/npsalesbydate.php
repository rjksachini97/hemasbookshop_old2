<?php         

	require_once("../../lib/common.php"); 
	require_once("../../lib/mod_reports.php");
  if(isset($_GET['sdate'])){
        $sdate = $_GET['sdate'];
        $edate = $_GET['edate'];
        //$income = $_GET['income'];        
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
    <h4 class="text-center h4 font-weight-bold text-dark">Sales By Newspapers </h4>
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
                <th></th>
                <th>Newspaper Name</th>
                <th>Category</th>
                <th>Quantity</th>
            </thead>
            <tbody id="sum_data">
              <?php
              $dbobj = DB:: connect();
              $sql = "SELECT np.newsp_name,cat.npcat_category,SUM(npo.order_qty) FROM tbl_newspaper_category cat JOIN tbl_newspaper np ON cat.npcat_id = np.npcat_id JOIN tbl_newspaper_order npo ON npo.newsp_id = np.newsp_id WHERE order_date BETWEEN '$sdate' AND '$edate' GROUP BY newsp_name ORDER BY npo.order_id";

              $result = $dbobj->query($sql);
              $rec =$result->num_rows;
              echo("Newspapers :".$rec);
              $i= 1;

              while($row = $result->fetch_assoc())
              {
              ?>
              <tr>
                <td><?php echo ($i)  ?></td>
                <td><?php echo ($row['newsp_name']) ?></td>
                <td><?php echo ($row['npcat_category']) ?></td>
                <td><?php echo($row['SUM(npo.order_qty)'])  ?></td>
              </tr>
              <?php
              $i++;
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
            
        window.open('view/reports/npsalesbydatePDF.php?sdate='+sdate+'&edate='+edate,'_blank');

    });
        
        
        
});
</script> 