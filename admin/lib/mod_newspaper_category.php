<?php
require_once("dbconnection.php");
 
if(isset($_GET["type"])){ 
	$type = $_GET["type"];
	$type();
}

/*
Following function generates a new employee id
eg. EMP00001
*/
function getNewNewsPaperCatId(){
  $dbobj = DB::connect();
  $sql = "SELECT npcat_id FROM tbl_newspaper_category ORDER BY npcat_id DESC LIMIT 1;";
  $result = $dbobj->query($sql);

  if($dbobj->errno){
	echo("SQL Error : ".$dbobj->error);
	exit;
  }

  $nor = $result->num_rows;

  if($nor == 0){
	$catnewid = "NCAT0001";
  }
  else{
	$rec = $result->fetch_assoc();
	$lastid = $rec["npcat_id"];
	$num = substr($lastid, 4);
	$num++;
	$catnewid = "NCAT".str_pad($num,4,"0",STR_PAD_LEFT);
  }

  $dbobj->close();
  return $catnewid;
}

function addNewNewsPaperCat(){

  $npcat_id = $_POST["txtnpcid"];
  $npcat_category = $_POST["txtnpcategory"];
  $npcat_desc = $_POST["txtnpcategorydesc"];

  $dbobj = DB::connect();

  $sql = "INSERT INTO tbl_newspaper_category(npcat_id,
npcat_category,
npcat_desc) VALUES(?,?,?);";

  $stmt = $dbobj->prepare($sql);
  $stmt->bind_param("sss",$npcat_id,$npcat_category,$npcat_desc);

  if(!$stmt->execute()){
    echo("0,SQL Error : ".$stmt->error);
  }
  else{
    echo("1,Successfully Added!");
  }
  $stmt->close();
  $dbobj->close();
}

 function viewNewsPaperCat(){

    $table ='tbl_newspaper_category';

    $primaryKey ='npcat_id';

    $columns = array(
        array( 'db' => 'npcat_id', 'dt'=> 0),
        array( 'db' => 'npcat_category', 'dt'=> 1),

    );
    require_once('config.php');
    $host = Config::$host ; 
    $user = Config::$db_uname ;
    $pass = Config::$db_pass ;
    $db = Config::$dbname ;

    $sql_details = array(
        'user' => $user,
        'pass' => $pass,
        'db'   => $db,
        'host' => $host
    );

    require('ssp.class.php');

    echo json_encode(
    SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns,null )
    );
 }

 ?>