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
  <li class="breadcrumb-item" ><a href="#" class="text-dark" onclick="funViewRep()" >Report Management</a></li><li class="breadcrumb-item active">Order Report</li>
</ol>

<div class="d-flex justify-content-between">
         <button class="btn btn-danger" onclick="funViewRep()"><i class="fas fa-backspace"></i>Back</button><button class="ml-2 btn btn-success" id="btn-export"><i class="fas fa-paper-plane"></i> Export PDF</button>
</div>

<div class="card mt-3" >
    <h4 class="text-center h4 font-weight-bold text-dark">Order By Advertisments </h4>
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
                <th>Customer name</th>
                <th>Mobile No</th>
                <th>Mode of Ad</th>
                <th>Category</th>
                <th>Publish Date</th>
            </thead>
            <tbody id="sum_data">
              <?php
              $dbobj = DB:: connect();
              $sql = "SELECT adb.newsad_mode,adb.newsac_category,ado.publish_date,cus.cus_name,cus.cus_mobile FROM tbl_ad_booking adb JOIN tbl_ad_order ado ON adb.ad_book_id = ado.ad_book_id JOIN tbl_reg_customer cus ON cus.cus_id = ado.cus_id WHERE publish_date BETWEEN '$sdate' AND '$edate' GROUP BY newsad_mode ORDER BY adorder_id";

              $result = $dbobj->query($sql);
              $rec =$result->num_rows;
              echo("Advertisments :".$rec);
              $i= 1;

              while($row = $result->fetch_assoc())
              {
              ?>
              <tr>
                <td><?php echo ($i)  ?></td>
                <td><?php echo ($row['cus_name']) ?></td>
                <td><?php echo ($row['cus_mobile']) ?></td>
                <td><?php echo($row['newsad_mode'])  ?></td>
                <td><?php echo($row['newsac_category'])  ?></td>
                <td><?php echo ($row['publish_date'])?></td>
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
            
        window.open('view/reports/adsalesbydatePDF.php?sdate='+sdate+'&edate='+edate,'_blank');

    });
        
        
        
});
</script> 