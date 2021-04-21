<?php 
session_start();
/*if(isset($_SESSION["user"]["uid"])){
    $oper =$_SESSION["user"]["uname"];
}*/
if(isset($_GET['sdate'])){
    $sdate =$_GET['sdate'];
    $edate =$_GET['edate'];
}

require_once("dompdf/autoload.inc.php");
require_once("../../../lib/config.php");

//reference the dompdf namespace
use Dompdf\Dompdf;
$dompdf  = new Dompdf();
;

// Load html content
$output ="";
/*$output .= '<style type="text/css">'.file_get_contents('rep_style.css').'</style>';*/
$output .= '<style type="text/css">'.file_get_contents('../../../bootstrap-4.1.3/css/bootstrap.css').'</style>';
$output .= '<script type="text/javascript">'.file_get_contents('../../../bootstrap-4.1.3/js/bootstrap.js').'</script>';

$output  .= "<img src='header.jpg'class='w-100' style='padding-bottom: 25px;'>";

$output .="<h3 class='text-center'>Recieved Newspapers From ".$sdate." To ".$edate."</h3>";

$output .="<table class='table table-borderless table-sm pt-2'>";
$output .="<thead class='thead-dark'><tr><th></th>";
$output .="<th>Customer name</th>";
$output .="<th >Mobile No</th>";
$output .="<th >Mode of Ad</th>";
$output .="<th >Category</th>";
$output .="<th >Publish Date</th>";
$output .="</tr>
            </thead>
            <tbody>";

//$date = date("Y-m-d");
$dbobj = DB::connect();

$sql = "SELECT adb.newsad_mode,adb.newsac_category,ado.publish_date,cus.cus_name,cus.cus_mobile FROM tbl_ad_booking adb JOIN tbl_ad_order ado ON adb.ad_book_id = ado.ad_book_id JOIN tbl_reg_customer cus ON cus.cus_id = ado.cus_id WHERE publish_date BETWEEN '$sdate' AND '$edate' GROUP BY newsad_mode ORDER BY adorder_id";
    

$result = $dbobj->query($sql);

$i = 0;
$qty= 0;
$remqty= 0;

while($row = $result->fetch_assoc()){
      $i++;
    $output .="<tr >";
   
    $output .="<td >".$i."</td>";
  
    $output .="<td >".$row['cus_name']."</td>";
    $output .="<td >".$row['cus_mobile']."</td>";
    $output .="<td >".$row['newsad_mode']."</td>";
    $output .="<td >".$row['newsac_category']."</td>";
    $output .="<td>" .$row['publish_date']."</td></tr>";
    $output .="</tr>";
   
}

$output .="</tbody>";
$output .="</table>";


$output .="</div>";
$output .=""; 
$output .= "<p class='py-2'> No of Newspaper : ".$i."<br>";
$output .="</p> ";
$dbobj->close();
           
// Pdf Footer Start ---------------------
/*$output .= ;
$output .="</p>" ;*/
$output .= "<footer style='position: fixed; bottom: -30px; left: 0px; right: 0px;  height: 85px;  '>

<p class='text-right fixed-bottom ' >Print Date : ".date("Y-m-d")." /  ".date("h:i:sa")."</p>
</footer>";
// Pdf Footer End ---------------------
$output .= "";


//<p class='text-left fixed-bottom ' >Print By : ".$oper." </p>


$dompdf->loadHtml($output);
//setup papaer size

$dompdf->setPaper('A4','landscape');
//render the html as PDF
$dompdf->render();


//output the generated Pdf
$dompdf->stream("Hemas Newspaper",array("Attachment"=>0));

?>

