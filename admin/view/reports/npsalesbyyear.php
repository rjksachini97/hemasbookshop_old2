<?php       

	require_once("../../lib/common.php"); 
	require_once("../../lib/mod_reports.php");
 

   if(isset($_GET['year'])){

    $year = $_GET['year'];
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
         <button class="btn btn-danger" onclick="funViewRep()"><i class="fas fa-backspace"></i>Back</button>
</div>
<div>
  <input type="hidden" name="syear" id="syear" value="<?php echo $year ?>">


<div class="card mt-3" >
	<h4 class="text-center h4 font-weight-bold text-primary">Newspaper Sales </h4>
	<p class="text-center h5  text-dark"><?php echo $year;  ?> </p>

  <div class="d-flex justify-content-between">
    <div class="col-sm-3">
      
    </div>
    <div class="col-sm-2 mt-2">
      
    </div>
    
  </div>
  
   <div class="row mt-5">
     
      <div id="annual_report" class="col text-center">
        
      </div>
     
      <div id="annual_report_income" class="col text-center">
        
      </div>
         
     </div>

  <div class="ml-3">
 
  </div>


 <div class="m-3">

	</div>
</div>
<script>
$(document).ready(function(){
  var year = $("#syear").val();
  /* ------------------- Chart for income Annalyze ------------------*/
    $.ajax({
      data:{year:year},
      url: "lib/mod_reports.php?type=newspapersalesbyyear",
      type: "GET",
      dataType:"json",
        success: function(data) {
          

            apiChart = new FusionCharts({
              type: "msline",
              width : "500",
              height : "400",
              renderAt: "annual_report",
              dataFormat: "json",
              dataSource: data,
            });
                apiChart.render();
        }
    });


  /*  $("#btn-export").click(function(){
        var category =$("#rep_cat").val();        
        window.open('report/inventry.php?category='+category,'_blank');

    });
        
    */    
        
});
</script>   

