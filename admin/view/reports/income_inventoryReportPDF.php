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
$output .="<th>Received date</th>";
$output .="<th >Newspaper</th>";
$output .="<th >Quantity</th>";
$output .="<th >Available</th>";
$output .="</tr>
            </thead>
            <tbody>";

//$date = date("Y-m-d");
$dbobj = DB::connect();

$sql = "SELECT bat.*,np.newsp_name FROM tbl_batch bat JOIN tbl_newspaper np ON np.newsp_id = bat.newsp_id WHERE bat_rdate BETWEEN '$sdate' AND '$edate' ORDER BY bat_rdate  ";
    

$result = $dbobj->query($sql);


$i = 0;
$qty= 0;
$remqty= 0;

while($row = $result->fetch_assoc()){
      $i++;
    $output .="<tr >";
   
    $output .="<td >".$i."</td>";
  
    $output .="<td >".$row['bat_rdate']."</td>";
    $output .="<td >".$row['newsp_name']."</td>";
    $output .="<td >".$row['bat_qty']."</td>";

    $qty = $qty+$row['bat_qty'];

    $output .="<td>" .$row['bat_rem']."</td></tr>";
    $remqty = $remqty+$row['bat_rem'];
    $output .="</tr>";
  
    
}


$output .="</tbody>";
$output .="</table>";


$output .="</div>";
$output .="";
$output .= "<p class='py-2'> No of Newspaper : ".$i."<br>";
$output .="Total Quantity : " .$qty."<br> ";
            $output .="Availbale Quantity : " .$remqty." <br>";
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