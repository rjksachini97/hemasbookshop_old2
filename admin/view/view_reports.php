<!------Breadcrumbs-----> 
<ol class="breadcrumb">  
  <li class="breadcrumb-item">
    <a href="home.php">Dashboard</a>
  </li>
  <li class="breadcrumb-item" ><a href="#">Reports</a></li><li class="breadcrumb-item active">View Reports</li>
</ol>

<div id='rport_page'>


<h4>Inventary</h4>
<hr>
<div class="row">

  <div class="col-lg-6">
   <div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="#" id="ssd" onclick="funStockSum()" class="card-link">
          <h6 class="m-0 font-weight-bold text-info"><i class="fas fa-chart-line fa-2x"></i><span>Stock Summary Report</span>
          </h6>
        </a>
    </div>
    <div class="card-body">
      This report will provide summary of current stock
    </div>
  </div>
</div>

  <div class="col-lg-6">
   <div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="#" id="" onclick="funStockLow()" class="card-link">
          <h6 class="m-0 font-weight-bold text-warning"><i class="fas fa-chart-line fa-2x"></i><span>Low Stock Report</span>
          </h6>
        </a>
    </div>
    <div class="card-body">
      This report will provide sumarry of low stock
    </div>
  </div>
</div>
</div>

<div class="row">

  <div class="col-lg-6">
   <div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="#" id="" onclick="outofstockreport()" class="card-link">
          <h6 class="m-0 font-weight-bold text-danger"><i class="fas fa-chart-line fa-2x"></i><span>Out Of Stock Report</span>
          </h6>
        </a>
    </div>
    <div class="card-body">
      This report will provide a summary out of stock
    </div>
  </div>
</div>

 <div class="col-lg-6">
   <div class="card shadow mb-4">
    <div class="card-header py-3 card rep_button">
        <a href="#" id="" class="card-link report_type" title="Recived Newspapers">
          <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-chart-line fa-2x"></i><span>Income Inventry</span>
          </h6>
        </a>
    </div>
    <div class="card-body">
      This report will provide recived newspapers within date range
    </div>
  </div>
</div>  
</div>

 

<h4>Sales</h4>
<hr>

<div class="row">
   <div class="col-lg-6">
   <div class="card shadow mb-4">
    <div class="card-header py-3 card rep_button">
        <a href="#" id="" class="card-link report_type" title="Booked Newspapers">
          <h6 class="m-0 font-weight-bold text-info"><i class="fas fa-chart-line fa-2x"></i><span>Newspaper Booked Summary Report </span>
          </h6>
        </a>
    </div>
    <div class="card-body">
      This report will provide a summary of booked newspapers
    </div>
  </div>
</div>

 <div class="col-lg-6">
   <div class="card shadow mb-4">
    <div class="card-header py-3 card rep_button">
        <a href="#" id="" class="card-link report_type" title="Online Sales">
          <h6 class="m-0 font-weight-bold text-success"><i class="fas fa-chart-line fa-2x"></i><span>Online Newspaper Sales Report</span>
          </h6>
        </a>
    </div>
    <div class="card-body">
      This report will provide a summary of online newspaper sales
    </div>
  </div>
</div> 
</div>

<div class="row">
   <div class="col-lg-6">
   <div class="card shadow mb-4">
    <div class="card-header py-3 card rep_button">
        <a href="#" id="" class="card-link report_type" title="Offline Sales">
          <h6 class="m-0 font-weight-bold text-danger"><i class="fas fa-chart-line fa-2x"></i><span>Offline Newspaper Sales Report </span>
          </h6>
        </a>
    </div>
    <div class="card-body">
      This report will provide a summary of offline newspaper sales
    </div>
  </div>
</div>

 <div class="col-lg-6">
   <div class="card shadow mb-4">
    <div class="card-header py-3 card rep_button">
        <a href="#" id="" class="card-link report_type" title="Sales by Newspaper">
          <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-chart-line fa-2x"></i><span>Sales by Newspaper Report</span>
          </h6>
        </a>
    </div>
    <div class="card-body">
      This report will provide a summary of newspaper sales
    </div>
  </div>
</div> 
</div>

<h4>Advertisment</h4>
<hr>

<div class="row">
   <div class="col-lg-6">
   <div class="card shadow mb-4">
    <div class="card-header py-3 card rep_button">
        <a href="#" id="" class="card-link report_type" title="Booked Ad">
          <h6 class="m-0 font-weight-bold text-info"><i class="fas fa-chart-line fa-2x"></i><span>Newspaper Advertisment Booked Summary Report </span>
          </h6>
        </a>
    </div>
    <div class="card-body">
      This report will provide a summary of booked newspaper advertisments
    </div>
  </div>
</div> 

 <div class="col-lg-6">
   <div class="card shadow mb-4">
    <div class="card-header py-3 card rep_button">
        <a href="#" id="" class="card-link report_type" title="Sales by Ad">
          <h6 class="m-0 font-weight-bold text-success"><i class="fas fa-chart-line fa-2x"></i><span>Sales by Advertisment Report</span>
          </h6>
        </a>
    </div>
    <div class="card-body">
      This report will provide a summary of order newspaper advertisments
    </div>
  </div>
</div> 
</div>



</div>

<div class="modal  fade" id="reportType" tabindex="-1" role="alertdialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg " role="document">
    <form id="" >
      <div class="modal-content">
        <div class="modal-header">
          <div class="modal-title text-center" >
            <div class="row">
              <h3 id="report_ttitle" style="margin: 0 auto"></h3>
            </div>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="msg_body"> 
          <div id="daily_section">
            <div class="card bg-gray-200 my-2">
              <h4 class="text-center">Daily Reports</h4>
            </div>
            <div class="row py-3">
              <div class="col">
                <div class="form-group row">
                  <label for="" class="col-lg-4 col-form-label">From : </label>
                    <input type="text" class="col-lg-7 form-control form-control-sm" id="sddate" name="sdate" placeholder="YYYY-MM-DD"  value="">
                </div>
              </div>
              <div class="col">
                <div class="form-group row">
                  <label for="" class="col-lg-4 col-form-label">To : </label>
                    <input type="text" class="col-lg-7 form-control form-control-sm" id="eddate" name="edate" placeholder="YYYY-MM-DD"  value="">
                </div>
              </div>
              <div class="col-sm-2">
                <button type="button" class="btn btn-info" id="btn_daily_report">Generate</button>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group row">
                <label for="" class="col-lg-4 col-form-label">Minimum Income</label>
                  <input type="text" class="col-lg-7 form-control form-control-sm" id="income" name="income"  value="">
              </div>
            </div>
          </div>

          <div id="month_section">
            <div class="card bg-gray-200 my-2">
              <h4 class="text-center">Monthly Report</h4>
            </div>
            <div class="row my-3">
              <div class="col">
                <div class="form-group row">
                  <label for="" class="col-lg-4 col-form-label">Month :</label>
                  <select class="form-control col-lg-7" id="month">
                    <option value="01_January">January</option>
                    <option value="02_February">February</option>
                    <option value="03_March">March</option>
                    <option value="04_April">April</option>
                    <option value="05_May">May</option>
                    <option value="06_June">June</option>
                    <option value="07_July">July</option>
                    <option value="08_Augest">Augest</option>
                    <option value="09_September">September</option>
                    <option value="10_Octomber">Octomber</option>
                    <option value="11_November">November</option>
                    <option value="12_December">December</option>
                  </select>
                </div>
              </div>

               <div class="col">
                  <div class="form-group row">
                    <label for="" class="col-lg-4 col-form-label">Year :</label>
                      <select class="form-control col-lg-7" id=myear>
                        <?php 
                            $year = date("Y");
                             for ($i = 0; $i<5; $i++){
                          ?>
                            <option value="<?php echo($year) ?>"><?php echo($year) ?></option>

                           <?php
                                $year--;
                            }
                             ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <button type="button" class="btn btn-primary" id="btn_monthly_report">Generate</button>
                    </div>
                  </div>
                </div>

                <div id="year_section">
                  <div class="card bg-gray-200 my-2">
                    <h4 class="text-center">Annual Annalyse</h4>                        
                  </div>
                    <div class="row my-3">
                      <div class="col">
                        <div class="form-group row">
                          <label for="" class="col-lg-4 col-form-label">Year :</label>
                            <select class="form-control col-lg-7" id="AnYear">
                              <?php 
                                  $year = date("Y");
                                  for ($i = 0; $i<5; $i++){
                              ?>
                              <option><?php echo($year) ?></option>

                                <?php
                                  $year--;
                              }
                                ?>
                              </select>
                            </div>
                          </div>
                          <div class="col">
                            
                          </div>
                          <div class="col-sm-2">
                            <button type="button" class="btn btn-success" id="btn_year_report">Generate</button>
                          </div>
                        </div>
                      </div>

                      <div id="type" class="row d-none">
                        <label class='col-lg-2' >Select Method </label>
                        <select class="custom-select col-lg-3" name="pay_method" id="pay_method">
                          <option value="online">Online</option>
                          <option value="offline">Offline</option>
                        </select>
                    
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div> 

















<!--

<div class="row" align="center">
	<div class="col-sm-4">
		<div class="card border-primary mb-3" style="max-width: 18rem;">
		  <div class="card-header text-primary">Employee Details</div>
		  <div class="card-body text-primary">
		  	<form method="post" action="reports/custom_report.php" id="inventory_form" target="_blank">
		    	
			    	<div class="form-group">
				    	<button type="submit" class="btn btn-primary"><i class="fas fa-clipboard-list"></i>&nbsp;View Report</button>
				    </div>
			</form>
		  </div> 

		   <div class="card-body text-primary">
		  	<form method="post" action="reports/example_003.php" id="inventory_form" target="_blank">
		    	
			    	<div class="form-group">
				    	<button type="submit" class="btn btn-primary"><i class="fas fa-clipboard-list"></i>&nbsp;View Report</button>
				    </div>
			</form>
		  </div>

		</div>
	</div>
</div>   

 -->  


<script>

function  funStockSum() {    // view all reports
        $("#rpanel").load("view/reports/stockSummaryReport.php");
      }
function  funStockLow() {    // view all reports
        $("#rpanel").load("view/reports/lowStockSummaryReport.php");
      }
function  outofstockreport() {    // view all reports
        $("#rpanel").load("view/reports/outStockSummaryReport.php");
      }

$(document).ready(function () {
  $(this).scrollTop(0);

    $("#edate, #sdate, #eddate, #sddate").datepicker({
            changeMonth:true,
            changeYear:true,
            dateFormat: 'yy-mm-dd',
            maxDate:"0"

    });

    $("#rport_page").on("click",".report_type",function(){
      var title = $(this).attr("title");
      $("#report_ttitle").html(title);
        //sales by product
        if(title=="Recived Newspapers"){
          $("#month_section").addClass('d-none');    //hide month section             
          $("#year_section").addClass('d-none'); // see year section
          $("#daily_section").removeClass('d-none'); // see daily section
          $("#type").addClass('d-none'); // hide payment type
        // purchase summery
      }else if(title=="Sales by Newspaper"){
                $("#month_section").addClass('d-none');    //hide month section             
                $("#year_section").removeClass('d-none'); // see year section
                $("#daily_section").removeClass('d-none'); // see daily section
                $("#type").addClass('d-none'); // hide payment type
        // purchase summery
            }else if(title=="Sales by Ad"){
                $("#month_section").addClass('d-none');
                $("#year_section").addClass('d-none');                
                $("#daily_section").removeClass('d-none');
                $("#type").addClass('d-none');
        //purchase summery method
            }else if(title=="Purchase Summery By method"){
                $("#month_section").addClass('d-none');
                $("#daily_section").removeClass('d-none');
                $("#year_section").addClass('d-none');
                $("#type").removeClass('d-none');
            }else if(title=="Summery of Dilivery"){
                $("#month_section").addClass('d-none');
                $("#daily_section").removeClass('d-none');
                $("#year_section").addClass('d-none');
                $("#type").addClass('d-none');
            }else if(title=="Purchase To Supplier"){
                $("#month_section").removeClass('d-none');
                $("#daily_section").removeClass('d-none');
                $("#year_section").addClass('d-none');
                $("#type").addClass('d-none');
            }else{
                $("#month_section").removeClass('d-none');
                $("#year_section").removeClass('d-none');
                $("#daily_section").removeClass('d-none');
                $("#type").addClass('d-none');
            }
            $("#reportType").modal("show");
   });
       /*----------------- Daily Reports generation  -----------------------*/
        $("#btn_daily_report ").click(function(){
            var title = $("#report_ttitle").html();
            var sdate = $("#sddate").val();
            var edate = $("#eddate").val();
            var income = $("#income").val();
            income = parseFloat(income).toFixed(2);

            if(sdate =="" || edate =="" ){
                swal("warning","Enter the start date and End date",'warning');
            }else if (sdate>edate){
                swal("warning","Selct a after date of start date",'warning');
            }else{
                $("#reportType").modal("hide");

                if(title=="Recived Newspapers"){
                  setTimeout(function(){ 
                    $("#rpanel").load("view/reports/income_inventory.php?sdate="+sdate+"&edate="+edate);
                  }, 250);

                }else if(title=="Booked Newspapers"){
                  setTimeout(function(){ 
                    $("#rpanel").load("view/reports/npBookedSummaryByDate.php?sdate="+sdate+"&edate="+edate);
                  }, 250);
                    
              }else if(title=="Online Sales"){
                    //var income = $("#income").val();
                  setTimeout(function(){ 
                    $("#rpanel").load("view/reports/onlinesalesbydate.php?sdate="+sdate+"&edate="+edate+"&income="+income);
                  }, 250);
                    
                }else if(title=="Offline Sales"){
                    //var income = $("#income").val();
                  setTimeout(function(){ 
                    $("#rpanel").load("view/reports/offlinesalesbydate.php?sdate="+sdate+"&edate="+edate+"&income="+income);
                  }, 250);
                }else if(title=="Sales by Newspaper"){
                    //var income = $("#income").val();
                  setTimeout(function(){ 
                    $("#rpanel").load("view/reports/npsalesbydate.php?sdate="+sdate+"&edate="+edate+"&income="+income);
                  }, 250);
                }else if(title=="Booked Ad"){
                    //var income = $("#income").val();
                  setTimeout(function(){ 
                    $("#rpanel").load("view/reports/adbookedsummarybydate.php?sdate="+sdate+"&edate="+edate+"&income="+income);
                  }, 250);
                }else if(title=="Sales by Ad"){
                    //var income = $("#income").val();
                  setTimeout(function(){ 
                    $("#rpanel").load("view/reports/adsalesbydate.php?sdate="+sdate+"&edate="+edate+"&income="+income);
                  }, 250);
                }


            }

}); 



       

         /*----------------- Monthly Reports generation  -----------------------*/

        $("#btn_monthly_report").click(function(){
            var title = $("#report_ttitle").html();
            var month = $("#month").val();
            var year = $("#myear").val();
             $("#reportType").modal("hide");
                
                if(title=="Booked Newspapers"){
                  setTimeout(function(){ 
                    $("#rpanel").load("view/reports/npBookedSummaryByMonth.php?month="+month+"&year="+year);
                  }, 250);
                    
                }
                else if(title=="Online Sales"){
                  setTimeout(function(){ 
                    $("#rpanel").load("view/reports/onlinesalesbymonth.php?month="+month+"&year="+year);
                  }, 250);
                    
                }else if(title=="Offline Sales"){
                  setTimeout(function(){ 
                    $("#rpanel").load("view/reports/offlinesalesbymonth.php?month="+month+"&year="+year);
                  }, 250);
                    
                }else if(title=="Booked Ad"){
                    
                  setTimeout(function(){ 
                    $("#rpanel").load("view/reports/adBookedSummarybyMonth.php?month="+month+"&year="+year);
                  }, 250);  
                    
                }
             

        });


         /*----------------- Yearly Reports generation  -----------------------*/
         $("#btn_year_report").click(function(){
            var title = $("#report_ttitle").html();
            var year = $("#AnYear").val();
             $("#reportType").modal("hide");
                
                if(title=="Booked Newspapers"){
                  setTimeout(function(){ 
                    $("#rpanel").load("view/reports/npBookedSummaryByYear.php?year="+year); 
                  }, 250); 
                    
                }
                else if(title=="Online Sales"){
                  setTimeout(function(){ 
                    $("#rpanel").load("view/reports/onlinesalesbyyear.php?year="+year); 
                  }, 250);
                    
                }else if(title=="Offline Sales"){
                  setTimeout(function(){ 
                    $("#rpanel").load("view/reports/offlinesalesbyyear.php?year="+year); 
                  }, 250);
                    
                }else if(title=="Sales by Newspaper"){
                  setTimeout(function(){ 
                    $("#rpanel").load("view/reports/npsalesbyyear.php?year="+year); 
                  }, 250);
                    
                }else if(title=="Booked Ad"){
                    
                  setTimeout(function(){ 
                    $("#rpanel").load("view/reports/adBookedSummarybyYear.php?year="+year);
                  }, 250);  
                    
                }

              /*  else if(title=="Sales by Ad"){
                  setTimeout(function(){ 
                    $("#rpanel").load("view/reports/adsalesbyyear.php?year="+year); 
                  }, 250);
                    
                }*/

        }); 





  });


 </script>