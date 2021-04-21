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
function getNewAdCatTypeId(){
  $dbobj = DB::connect();
  $sql = "SELECT adcattype_id FROM tbl_news_adcat_type ORDER BY adcattype_id DESC LIMIT 1;";
  $result = $dbobj->query($sql);

  if($dbobj->errno){
	echo("SQL Error : ".$dbobj->error);
	exit;
  }

  $nor = $result->num_rows;

  if($nor == 0){
	$newid = "ADCT0150";
  }
  else{
	$rec = $result->fetch_assoc();
	$lastid = $rec["adcattype_id"];
	$num = substr($lastid, 4);
	$num++;
	$newid = "ADCT".str_pad($num,4,"0",STR_PAD_LEFT);
  }

  $dbobj->close();
  return $newid;
}

function getCatType(){
  $dbobj = DB::connect(); 
  $sql = "SELECT newsac_id,newsac_category FROM tbl_news_ad_category WHERE newsac_id NOT IN (SELECT adcattype_id FROM tbl_news_adcat_type)AND newsac_status=1;";

  $result = $dbobj->query($sql);

  if($dbobj->errno){
    echo("SQL Error : ".$dbobj->error);
    exit;
  }

   $nor = $result->num_rows;
  if($nor>0){
    while($rec = $result->fetch_assoc()){
      echo("<option value='".$rec["newsac_id"]."'>".$rec["newsac_category"]."</option>");
    }
  }
  $dbobj->close();  
}

/*
Below function is used to insert new newspaer records to 
the tbl_news_adcat_type
*/
function addNewAdCatType(){

  $adcattype_id = $_POST["txtadctypeid"];
  $newsac_id = $_POST["cmbadcategory"];
  $adcattype_desc = $_POST["txtadctdesc"];

  $dbobj = DB::connect();

  $sql = "INSERT INTO tbl_news_adcat_type(adcattype_id,newsac_id,adcattype_desc) VALUES(?,?,?);";

  $stmt = $dbobj->prepare($sql);
  $stmt->bind_param("sss",$adcattype_id,$newsac_id,$adcattype_desc);

  if(!$stmt->execute()){
    echo("0,SQL Error : ".$stmt->error);
  }
  else{
    echo("1,Successfully Added!");
  }
  $stmt->close();
  $dbobj->close();
}

function viewAdCatType(){
  $table = <<<EOT
  (SELECT adct.adcattype_id,adca.newsac_category,adct.adcattype_desc,adct.adcattype_status FROM tbl_news_adcat_type adct JOIN tbl_news_ad_category adca ON adct.newsac_id = adca.newsac_id WHERE adct.adcattype_status=1 ORDER BY adcattype_id ASC
    ) temp
EOT;
 
  // Table's primary key
  $primaryKey = 'adcattype_id';
  
  $columns = array(
  array( 'db' => 'adcattype_id', 'dt' => 0 ),
  array( 'db' => 'newsac_category',  'dt' => 1 ),
  array( 'db' => 'adcattype_desc',  'dt' => 2 ),
  array( 'db' => 'adcattype_status', 'dt' => 3 )  
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
  SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns, null,"adcattype_status=1" )
  );
}
function getAdCatType(){
  $adctid = $_POST["adctid"];
  $dbobj = DB::connect();
  $sql= "SELECT * FROM tbl_news_adcat_type WHERE adcattype_id='$adctid';";

  $result = $dbobj->query($sql);

  if($dbobj->errno){
  echo("SQL Error : ".$dbobj->error);
  exit;
  }
  $rec = $result->fetch_assoc();
  echo(json_encode($rec));
  $dbobj->close();  
}

// update newspaper
function updateAdCatType(){

  $adcattype_id = $_POST["txtadctypeid"];
  $newsac_id = $_POST["cmbadcategory"];
  $adcattype_desc = $_POST["txtadctdesc"];

  $dbobj = DB::connect();

  $sql = "UPDATE tbl_news_adcat_type SET newsac_id=?,adcattype_desc=? WHERE adcattype_id=?";

  $stmt = $dbobj->prepare($sql);
  $stmt->bind_param("sss",$adcattype_id,$newsac_id,$adcattype_desc);
  
  if(!$stmt->execute()){
    echo("0,SQL Error : ".$stmt->error);
  }
  else{
    echo("1,Successfully Updated!");
  }
  $stmt->close();
  $dbobj->close();
}

function deleteAdCatType(){
  $adctid = $_POST["adctid"];
  
  $dbobj = DB::connect();
  $sql = "UPDATE tbl_news_adcat_type SET adcattype_status=0  WHERE adcattype_id=?";

  $stmt = $dbobj->prepare($sql);
  $stmt->bind_param("s",$adctid);

  if(!$stmt->execute()){
    echo("0,SQL Error : ".$stmt->error);
  }
  else{
    /*$sql_new = "UPDATE tbl_users SET usr_status=0 WHERE usr_name=(SELECT emp_email from tbl_deliveryman WHERE emp_id=?)";
    $stmt_new= $dbobj->prepare($sql_new);
    $stmt_new->bind_param("s",$delmid);
    $stmt_new->execute();
    $stmat_new->close();*/
    echo("1,Successfully Removed!");
  }
  $stmt->close();
  $dbobj->close();


}
?>