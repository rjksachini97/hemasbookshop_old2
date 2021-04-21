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
function getNewAdCatId(){
  $dbobj = DB::connect();
  $sql = "SELECT newsac_id FROM tbl_news_ad_category ORDER BY newsac_id DESC LIMIT 1;";
  $result = $dbobj->query($sql);

  if($dbobj->errno){
	echo("SQL Error : ".$dbobj->error);
	exit;
  }

  $nor = $result->num_rows;

  if($nor == 0){
	$newid = "ACAT0001";
  }
  else{
	$rec = $result->fetch_assoc();
	$lastid = $rec["newsac_id"];
	$num = substr($lastid, 4);
	$num++;
	$newid = "ACAT".str_pad($num,4,"0",STR_PAD_LEFT);
  }

  $dbobj->close();
  return $newid;
}

/*
Below function is used to insert new employee records to 
the tbl_news_ad_category
*/
function addNewAdCat(){
  $newsac_id = $_POST["txtadcid"];
  $newsac_category = $_POST["txtadcategory"];

  $dbobj = DB::connect();

  $sql = "INSERT INTO tbl_news_ad_category(newsac_id,newsac_category) VALUES(?,?);";

  $stmt = $dbobj->prepare($sql);
  $stmt->bind_param("ss",$newsac_id,$newsac_category);

  if(!$stmt->execute()){
    echo("0,SQL Error : ".$stmt->error);
  }
  else{
    echo("1,Successfully Registered!");
  }
  $stmt->close();
  $dbobj->close();
}

function viewAdCat(){
  //echo("viewEmp");
  // DB table to use
  $table = 'tbl_news_ad_category';
 
  // Table's primary key
  $primaryKey = 'newsac_id';

  $columns = array(
      array( 'db' => 'newsac_id', 'dt' => 0 ),
      array( 'db' => 'newsac_category',  'dt' => 1 )
  );

  // SQL server connection information
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
    SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns, null,"newsac_status=1" )
  );
}

function getAdCat(){
  $adcatid = $_POST["adcatid"];
  $dbobj = DB::connect();
  $sql= "SELECT * FROM tbl_news_ad_category where newsac_id='$adcatid';";

  $result = $dbobj->query($sql);

  if($dbobj->errno){
    echo("SQL Error : ".$dbobj->error);
    exit;
  }
  $rec = $result->fetch_assoc();
  echo(json_encode($rec));
  $dbobj->close();

}

// update employee
function updateAdCat(){
  $newsac_id = $_POST["txtadcid"];
  $newsac_category = $_POST["txtadcategory"];

  $dbobj = DB::connect();

  $sql = "UPDATE tbl_news_ad_category SET newsac_category=? WHERE newsac_id=?";

  $stmt = $dbobj->prepare($sql);
  $stmt->bind_param("ss",$newsac_category,$newsac_id);

  if(!$stmt->execute()){
    echo("0,SQL Error : ".$stmt->error);
  }
  else{
    echo("1,Successfully Updated!");
  }
  $stmt->close();
  $dbobj->close();
}
function deleteAdCat(){
  $adcatid = $_POST["adcatid"];
  
  $dbobj = DB::connect();
  $sql = "UPDATE tbl_news_ad_category SET newsac_status=0 WHERE newsac_id=?";

  $stmt = $dbobj->prepare($sql);
  $stmt->bind_param("s",$adcatid);

  if(!$stmt->execute()){
    echo("0,SQL Error : ".$stmt->error);
  }
  else{
    /*$sql_new = "UPDATE tbl_users SET usr_status=0 WHERE usr_name=(SELECT emp_email from tbl_employee WHERE emp_id=?)";
    $stmt_new= $dbobj->prepare($sql_new);
    $stmt_new->bind_param("s",$sellid);
    $stmt_new->execute();
    $stmat_new->close();*/
    echo("1,Successfully Removed!");
  }
  $stmt->close();
  $dbobj->close();


}
?>