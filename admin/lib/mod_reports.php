<?php     
require_once("config.php"); 
if(isset($_GET["type"])){
    $type = $_GET["type"];
    $type(); 
}

/*---------------------------------Inventry Reports-----------------------------------------*/

function stockSummary(){
    $table = "tbl_newspaper";

    $primary_key ="newsp_id" ;

    $columns = array(
        array( 'db' => 'newsp_id', 'dt' => 0 ),
        array( 'db' => 'newsp_name',  'dt' => 1 ),
        array( 'db' => 'newsp_qty',   'dt' => 2 ),
        array( 'db' => 'newsp_rlevel',   'dt' => 3 ),
        array( 'db' => 'npcat_id',   'dt' => 4 ),
    );
    require_once("config.php");
    $host = Config::$host;
    $user = Config::$db_uname;
    $pass = Config::$db_pass;
    $db = Config::$dbname;

    $sql_details = array(
        'user' => $user,
        'pass' => $pass,
        'db'   => $db,
        'host' => $host
    );

    require('ssp.class.php');

    echo json_encode(
        SSP::complex($_POST, $sql_details, $table, $primary_key, $columns)
    );
}
 function lowStockSummary(){
    $table = "tbl_newspaper";

    $primary_key ="newsp_id" ;

    $columns = array(
        array( 'db' => 'newsp_id', 'dt' => 0 ),
        array( 'db' => 'newsp_name',  'dt' => 1 ),
        array( 'db' => 'newsp_qty',   'dt' => 2 ),
        array( 'db' => 'newsp_rlevel',   'dt' => 3 ),
        array( 'db' => 'npcat_id',   'dt' => 4 ),
    );
    require_once("config.php");
    $host = Config::$host;
    $user = Config::$db_uname;
    $pass = Config::$db_pass;
    $db = Config::$dbname;

    $sql_details = array(
        'user' => $user,
        'pass' => $pass,
        'db'   => $db,
        'host' => $host
    );

    require('ssp.class.php');

    echo json_encode(
        SSP::complex($_POST, $sql_details, $table, $primary_key, $columns,"newsp_qty < newsp_rlevel")
    );

 }

/*---------------------------------Income Inventory------------------------------*/

function incomeInventory($sdate,$edate){

    $dbobj = DB::connect();

    $sql = "SELECT bat.*,np.newsp_name FROM tbl_batch bat JOIN tbl_newspaper np ON np.newsp_id = bat.newsp_id WHERE bat_rdate BETWEEN '$sdate' AND '$edate' ORDER BY bat_rdate ";

    $result = $dbobj->query($sql);

    $output = "";
    $i=1;
    if($result->num_rows =="0"){
        $output .="<tr><td>No data<td></tr>";
    }else{
        while ($rec = $result->fetch_assoc()) {
            $output .= "<tr>
                            <td>".$i."</td>
                            <td>".$rec['bat_rdate']."</td>
                            <td>".$rec['newsp_name']."</td>
                            <td>".$rec['bat_qty']."</td>
                            <td>".$rec['bat_rem']."</td>

                        </tr>";
                        $i++;
        }
    }

    $result = $dbobj->query($sql);

    $output = "";
    $i=1;
    if($result->num_rows =="0"){
        $output .="<tr><td>No data</td></tr>";
    }else{
        while ($rec = $result->fetch_assoc()) {
            $output .="<tr>
                            <td>".$i."</td>
                            <td>".$rec['bat_rdate']."</td>
                            <td>".$rec['newsp_name']."</td>
                            <td>".$rec['bat_qty']."</td>
                            <td>".$rec['bat_rem']."</td>
                        </tr>";
                        $i++;
        }
    }
    echo $output;
    $dbobj->close();

}

/*---------------------------------np booked Reports-----------------------------------------*/
function numberOrderByYear(){ 

    $year = $_GET['year'];

    

    $dbobj=DB::connect();
    $sql ="SELECT MONTHNAME(inv_date), count(inv_id) FROM tbl_invoice WHERE YEAR(inv_date) ='$year' AND inv_status != '0' GROUP BY MONTH(inv_date)" ;
    $result = $dbobj->query($sql);
    $data_point =array();
    while($row= $result->fetch_assoc()){
        $point = array();
        $point['label'] = $row['MONTHNAME(inv_date)'];
        $point['value'] = $row['count(inv_id)'];


        array_push($data_point,$point);
    }
    header('Content-type: application/json');
    echo json_encode($data_point);
    $dbobj->close();

}


function OrderSummaryByYear(){

    $year = $_GET['year'];

    $dbobj =DB::connect();
    $sql ="SELECT MONTHNAME(inv_date), sum(inv_total), sum(inv_paid) FROM tbl_invoice WHERE YEAR(inv_date) = '$year' AND inv_status != '0' GROUP BY MONTH(inv_date)" ;
    $result = $dbobj->query($sql);

    $dataArray = array(
        "chart" => array(
            "theme" => "fusion",
            "caption" => "Total Revenue",
            "exportEnabled" => "1",
            "subCaption" => $year,
        )
    );

    $categoryArray = array();
    $dataserios1 = array();
    $dataserios2 = array(); 

    while($row= $result->fetch_assoc()){
        array_push($categoryArray,array("label"=> $row['MONTHNAME(inv_date)']));

        array_push($dataserios1,array("value"=> $row['sum(inv_total)']));
        array_push($dataserios2,array("value"=> $row['sum(inv_paid)']));

    }
    $dataArray["categories"] = array(array("category"=>$categoryArray));

    $dataArray["dataset"] = array(array("seriesName"=>'invoice Total',"data"=>$dataserios1),array("seriesName"=>'invoice Paid',"data"=>$dataserios2));
     echo json_encode($dataArray);

    //header('Content-type: application/json');
   
    $dbobj->close();

}




/*function npOrderByDay(){

   $category = $_GET['category'];

    

    $dbobj=DB::connect();
    $sql ="SELECT newp_name, count(newsp_id) FROM tbl_newspaper WHERE npcat_id ='$category'" ;
    $result = $dbobj->query($sql);
    $data_point =array();
    while($row= $result->fetch_assoc()){
        $point = array();
        $point['label'] = $row['newsp_name'];
        $point['value'] = $row['newsp_id'];


        array_push($data_point,$point);
    }
    header('Content-type: application/json');
    echo json_encode($data_point);
    $dbobj->close();

}
*/

/*---------------------------------Sales Reports-----------------------------------------*/
function numberonlinesalesbyyear(){

    $year = $_GET['year'];
    
    $dbobj =DB::connect();
    $sql ="SELECT MONTHNAME(inv_date), count(inv_id) FROM tbl_invoice WHERE YEAR(inv_date) = '$year' AND inv_status != '0' AND inv_type='online' GROUP BY MONTH(inv_date)" ;
    $result = $dbobj->query($sql);
    $data_point =array();
    while($row= $result->fetch_assoc()){
        $point = array();
        $point['label'] = $row['MONTHNAME(inv_date)'];
        $point['value'] = $row['count(inv_id)'];


        array_push($data_point,$point);
    }
    header('Content-type: application/json');
    echo json_encode($data_point);
    $dbobj->close();

}

/*---------------------------------SalesReports-----------------------------------------*/

function orderonlinebyyear(){

    $year = $_GET['year'];

    $dbobj =DB::connect();
    $sql ="SELECT MONTHNAME(inv_date), sum(inv_total), sum(inv_paid) FROM tbl_invoice WHERE YEAR(inv_date) = '$year' AND inv_status != '0' AND inv_type='online' GROUP BY MONTH(inv_date)" ;
    $result = $dbobj->query($sql);

    $dataArray = array(
        "chart" => array(
            "theme" => "fusion",
            "caption" => "Total Revenue",
            "exportEnabled" => "1",
            "subCaption" => $year,
        )
    );

    $categoryArray = array();
    $dataserios1 = array();
    $dataserios2 = array(); 

    while($row= $result->fetch_assoc()){
        array_push($categoryArray,array("label"=> $row['MONTHNAME(inv_date)']));

        array_push($dataserios1,array("value"=> $row['sum(inv_total)']));
        array_push($dataserios2,array("value"=> $row['sum(inv_paid)']));

    }
    $dataArray["categories"] = array(array("category"=>$categoryArray));

    $dataArray["dataset"] = array(array("seriesName"=>'invoice Total',"data"=>$dataserios1),array("seriesName"=>'invoice Paid',"data"=>$dataserios2));
     echo json_encode($dataArray);

    //header('Content-type: application/json');
   
    $dbobj->close();

}

/*---------------------------------Sales Reports-----------------------------------------*/
function numberofflinesalesbyyear(){

    $year = $_GET['year'];
    
    $dbobj =DB::connect();
    $sql ="SELECT MONTHNAME(inv_date), count(inv_id) FROM tbl_invoice WHERE YEAR(inv_date) = '$year' AND inv_status != '0' AND inv_type='offline' GROUP BY MONTH(inv_date)" ;
    $result = $dbobj->query($sql);
    $data_point =array();
    while($row= $result->fetch_assoc()){
        $point = array();
        $point['label'] = $row['MONTHNAME(inv_date)'];
        $point['value'] = $row['count(inv_id)'];


        array_push($data_point,$point);
    }
    header('Content-type: application/json');
    echo json_encode($data_point);
    $dbobj->close();

}

/*---------------------------------SalesReports-----------------------------------------*/

function orderofflinebyyear(){

    $year = $_GET['year'];

    $dbobj =DB::connect();
    $sql ="SELECT MONTHNAME(inv_date), sum(inv_total), sum(inv_paid) FROM tbl_invoice WHERE YEAR(inv_date) = '$year' AND inv_status != '0' AND inv_type='offline' GROUP BY MONTH(inv_date)" ;
    $result = $dbobj->query($sql);

    $dataArray = array(
        "chart" => array(
            "theme" => "fusion",
            "caption" => "Total Revenue",
            "exportEnabled" => "1",
            "subCaption" => $year,
        )
    );

    $categoryArray = array();
    $dataserios1 = array();
    $dataserios2 = array(); 

    while($row= $result->fetch_assoc()){
        array_push($categoryArray,array("label"=> $row['MONTHNAME(inv_date)']));

        array_push($dataserios1,array("value"=> $row['sum(inv_total)']));
        array_push($dataserios2,array("value"=> $row['sum(inv_paid)']));

    }
    $dataArray["categories"] = array(array("category"=>$categoryArray));

    $dataArray["dataset"] = array(array("seriesName"=>'invoice Total',"data"=>$dataserios1),array("seriesName"=>'invoice Paid',"data"=>$dataserios2));
     echo json_encode($dataArray);

    //header('Content-type: application/json');
   
    $dbobj->close();

}

/*---------------------------------np Sales-----------------------------------------*/
/*
function newspapersalesbyyear(){

    $year = $_GET['year'];   

    $dbobj =DB::connect();
    $sql ="SELECT prod_modal, MONTHNAME(inv_date), sum(invp.prod_qty) FROM tbl_invoice inv JOIN tbl_inv_prod invp ON inv.inv_id = invp.inv_id JOIN tbl_products pro ON pro.prod_id = invp.prod_id WHERE YEAR(inv_date) = '$year'  GROUP BY MONTH(inv_date)" ;
    $result = $dbobj->query($sql);

    $dataArray = array(
        "chart" => array(
            "theme" => "fusion",
            "caption" => "Total Revenue",
            "exportEnabled" => "1",
            "subCaption" => $year,
        )
    );

    $categoryArray = array();
    $dataserios1 = array();
    $seriasname = array(); 

    while($row= $result->fetch_assoc()){
        array_push($seriasname,array($row['prod_modal']));
        array_push($categoryArray,array("label"=> $row['MONTHNAME(inv_date)']));

        array_push($dataserios1,array("value"=> $row['sum(invp.prod_qty)']));
        
        

    }
    $dataArray["categories"] = array(array("category"=>$categoryArray));

    $dataArray["dataset"] = array(array("seriesName"=>$seriasname,"data"=>$dataserios1));
     echo json_encode($dataArray);

    //header('Content-type: application/json');
   
    $dbobj->close();

}

*/

/*--------------------------------Ad bookedReports-----------------------------------------*/
function AdOrderByYear(){

    $year = $_GET['year'];
 

    $dbobj=DB::connect();
    $sql ="SELECT MONTHNAME(publish_date), count(adorder_id) FROM tbl_ad_order WHERE YEAR(publish_date) ='$year' AND adorder_status !=0 GROUP BY MONTH(publish_date)" ;
    $result = $dbobj->query($sql);
    $data_point =array();
    while($row= $result->fetch_assoc()){
        $point = array();
        $point['label'] = $row['MONTHNAME(publish_date)'];
        $point['value'] = $row['count(adorder_id)'];


        array_push($data_point,$point);
    }
    header('Content-type: application/json');
    echo json_encode($data_point);
    $dbobj->close();

}

function AdOrderSummaryByYear(){

    $year = $_GET['year'];

    $dbobj =DB::connect();
    $sql ="SELECT MONTHNAME(publish_date), sum(adorder_price) FROM tbl_ad_order WHERE YEAR(publish_date) = '$year' AND adorder_status !='0' GROUP BY MONTH(publish_date)" ;
    $result = $dbobj->query($sql);

    $dataArray = array(
        "chart" => array(
            "theme" => "fusion",
            "caption" => "Total Revenue",
            "exportEnabled" => "1",
            "subCaption" => $year,
        )
    );

    $categoryArray = array();
    $dataserios1 = array();
    //$dataserios2 = array(); 

    while($row= $result->fetch_assoc()){
        array_push($categoryArray,array("label"=> $row['MONTHNAME(publish_date)']));

        array_push($dataserios1,array("value"=> $row['sum(adorder_price)']));
        //array_push($dataserios2,array("value"=> $row['sum(inv_paid)']));

    }
    $dataArray["categories"] = array(array("category"=>$categoryArray));

    $dataArray["dataset"] = array(array("seriesName"=>'Advertisment Total',"data"=>$dataserios1)
        //,array("seriesName"=>'invoice Paid',"data"=>$dataserios2)
    );
     echo json_encode($dataArray);

    //header('Content-type: application/json');
   
    $dbobj->close();

}



?>