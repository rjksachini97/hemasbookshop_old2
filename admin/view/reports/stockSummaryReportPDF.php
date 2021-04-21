<?php 
session_start();
/*if(isset($_SESSION["user"]["uid"])){
    $oper =$_SESSION["user"]["uname"];
}*/
if(isset($_GET['category'])){
    $category = $_GET['category'];
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

$date = date("Y-m-d");
$dbobj =DB::connect();

if($category==""){
    $sql = "SELECT newsp_id,newsp_name,npcat_category,newsp_qty FROM tbl_newspaper np JOIN tbl_newspaper_category cat ON np.npcat_id = cat.npcat_id";
    $output .= "<h4 class='text-center'>Stock Report of ".$date ." </h4>";
}else{
    $sql = "SELECT newsp_id,newsp_name,npcat_category,newsp_qty FROM tbl_newspaper np JOIN tbl_newspaper_category cat ON np.npcat_id = cat.npcat_id WHERE cat.npcat_id='$category'";
   $output .= "<h4 class='text-center'> Stock Report of ".$date ." </h4>";
}

$result = $dbobj->query($sql);

$output .="<table class='table table-borderless table-sm pt-2'>";
$output .="<thead class='thead-dark'><tr><th></th>";
$output .="<th>Newspaper ID</th>";
$output .="<th >Newspaper</th>";
$output .="<th >Category</th>";
$output .="<th >Quantity</th></tr></thead><tbody>";
$i = 0;
$stock= 0;
$outstock= 0;
$totqty = 0;
while($row = $result->fetch_assoc()){
      $i++;
    $output .="<tr >";
   
    $output .="<td >".$i."</td>";
  
    $output .="<td >".$row['newsp_id']."</td>";
    $output .="<td >".$row['newsp_name']."</td>";
    $output .="<td >".$row['npcat_category']."</td>";
    $output .="<td >".$row['newsp_qty']."</td>";
    $output .="</tr>";
    $totqty = $totqty +$row['newsp_qty'];
    if($row['newsp_qty']=="0"){
        $outstock++;
    }else{
        $stock++;
    }
}


$output .="</tbody>";
$output .="</table>";


$output .="</div>";
$output .="";
$output .= "<p class='py-2'> No of Total Newspaper In Stock : ".$i."<br>";
$output .= " No of In Stock : ".$stock."<br>";
$output .= " No of out of stock : ".$outstock."</p>";
$output .="No of Total Newspapers: ".$totqty."";

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

$dompdf->setPaper('A4','portrait');
//render the html as PDF
$dompdf->render();


//output the generated Pdf
$dompdf->stream("Hemas Newspaper",array("Attachment"=>0));

?>