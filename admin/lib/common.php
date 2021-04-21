<?php  
require_once("dbconnection.php"); 


if(isset($_GET["type"])){
    $type = $_GET["type"]; 
    $type();
}

/*------------------------get NP Category List----------------------*/
function getNPCategory(){
    $dbobj = DB::connect();

    $sql = "SELECT npcat_id, npcat_category FROM  tbl_newspaper_category;";
    $result = $dbobj->query($sql);

    if($dbobj->errno){
        echo("SQL Error: ".$dbobj->error);
        exit;
    }
    $output ="";
    //$output .="<option value=''>  All</option>";
    while($row =$result->fetch_assoc()){
        $output .="<option value='".$row['npcat_id']."'>".$row['npcat_category']."</option>";
    }

    echo($output);
    $dbobj->close();
}


/*------------------------get Publication Company List----------------------*/
function getPubCompany(){
    $dbobj = DB::connect();

    $sql = "SELECT pub_id, pub_name FROM  tbl_pub_company";
    $result = $dbobj->query($sql);

    if($dbobj->errno){
        echo("SQL Error: ".$dbobj->error);
        exit;
    }
    $output ="";
    while($row =$result->fetch_assoc()){
        $output .="<option value='".$row['pub_id']."'>".$row['pub_name']."</option>";
    }

    echo($output);
    $dbobj->close();
}
/*------------------------Display Newspaper count----------------------*/
function NPCount(){
    $dbobj = DB::connect();
    $sql = "SELECT count(newsp_id) FROM tbl_newspaper ";
    $result = $dbobj->query($sql);
    if($dbobj->errno){
        echo("SQL Error : " .$dbobj->error);
        exit;
    }
    $cusCount = $result->fetch_array();


    $dbobj->close();
    return $cusCount[0];
}
/*------------------------Display register customer count----------------------*/
function customerCount(){
    $dbobj = DB::connect();
    $sql = "SELECT count(cus_id) FROM tbl_reg_customer ";
    $result = $dbobj->query($sql);
    if($dbobj->errno){
        echo("SQL Error : " .$dbobj->error);
        exit;
    }
    $cusCount = $result->fetch_array();

    echo($cusCount[0]);
    $dbobj->close();
}

/*------------------------Send notification about out of stock----------------------*/

function getNPOutStock(){
    $dbobj = DB::connect();
    $sql = "SELECT count(*) newsp_id FROM tbl_newspaper WHERE newsp_qty ='0';";
    $result = $dbobj->query($sql);
    if($dbobj->errno){
        echo ($dbobj->errno);
        exit;
    }
    $rec = $result->fetch_array();
    $dbobj->close();
    return $rec[0];


}
/*------------------------Send notification about np level----------------------*/

function getNPLevel(){
    $dbobj = DB::connect();
    $sql = "SELECT count(*) newsp_id FROM tbl_newspaper WHERE newsp_qty <= newsp_rlevel;";
    $result = $dbobj->query($sql);
    if($dbobj->errno){
        echo ($dbobj->errno);
        exit;
    }
    $rec = $result->fetch_array();
    $dbobj->close();
    return $rec[0];


}



?>