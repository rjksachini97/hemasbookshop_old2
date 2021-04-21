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
function getNewPubComId(){
  $dbobj = DB::connect();
  $sql = "SELECT pub_id FROM tbl_pub_company ORDER BY pub_id DESC LIMIT 1;";
  $result = $dbobj->query($sql);

  if($dbobj->errno){
	echo("SQL Error : ".$dbobj->error);
	exit;
  }

  $nor = $result->num_rows;

  if($nor == 0){
	$newid = "PUBC0001";
  }
  else{
	$rec = $result->fetch_assoc();
	$lastid = $rec["pub_id"];
	$num = substr($lastid, 4);
	$num++;
	$newid = "PUBC".str_pad($num,4,"0",STR_PAD_LEFT);
  }

  $dbobj->close();
  return $newid;
}
/*
Below function is used to insert new employee records to 
the tbl_employee
*/
function addNewPubCom(){
  $pub_id = $_POST["txtpcid"];
  $pub_name = $_POST["txtpcname"];
  $pub_address = $_POST["txtpcaddress"];
  $pub_mobile = $_POST["txtpcmobile"];
  $pub_email = $_POST["txtpcemail"];

  $dbobj = DB::connect();

  $sql = "INSERT INTO tbl_pub_company(
  pub_id,pub_name,pub_address,pub_mobile,pub_email) VALUES(?,?,?,?,?);";

  $stmt = $dbobj->prepare($sql);
  $stmt->bind_param("sssss",$pub_id,$pub_name,$pub_address,$pub_mobile,$pub_email);

  if(!$stmt->execute()){
    echo("0,SQL Error : ".$stmt->error);
  }
  else{
    echo("1,Successfully Registered!");
  }
  $stmt->close();
  $dbobj->close();
}
function viewPubCom(){
  //echo("viewEmp");
  // DB table to use
  $table = 'tbl_pub_company';
 
  // Table's primary key
  $primaryKey = 'pub_id';

  $columns = array(
      array( 'db' => 'pub_id', 'dt' => 0 ),
      array( 'db' => 'pub_name',  'dt' => 1 ),
      array( 'db' => 'pub_address',  'dt' => 2 ),
      array( 'db' => 'pub_mobile',   'dt' => 3 ),
    array( 'db' => 'pub_email',    'dt' => 4) 
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
    SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns, null,"pub_status=1" )
  );
}
function getPubCom(){
  $pubid = $_POST["pubid"];
  $dbobj = DB::connect();
  $sql= "SELECT * FROM tbl_pub_company where pub_id='$pubid';";

  $result = $dbobj->query($sql);

  if($dbobj->errno){
    echo("SQL Error : ".$dbobj->error);
    exit;
  }
  $rec = $result->fetch_assoc();
  echo(json_encode($rec));
  $dbobj->close();

}
//update Pub Com
function updatePubCom(){
  $pub_id  = $_POST["txtpcid"];
  $pub_name  = $_POST["txtpcname"];
  $pub_address  = $_POST["txtpcaddress"];
  $pub_mobile  = $_POST["txtpcmobile"];
  $pub_email  = $_POST["txtpcemail"];
  
  $dbobj = DB::connect();

  $sql = "UPDATE tbl_pub_company SET pub_name=?, pub_address=?, pub_mobile=?, pub_email=? WHERE pub_id=?";

  $stmt = $dbobj->prepare($sql);
  $stmt->bind_param("sssss",$pub_name,$pub_address,$pub_mobile,$pub_email,$pub_id);

  if(!$stmt->execute()){
    echo("0,SQL Error : ".$stmt->error);
  }
  else{
    echo("1,Successfully Updated!");
  }
  $stmt->close();
  $dbobj->close();
} 
function deletePubCom(){
  $pubid = $_POST["pubid"];
  
  $dbobj = DB::connect();
  $sql = "UPDATE tbl_pub_company SET pub_status=0  WHERE pub_id=?";

  $stmt = $dbobj->prepare($sql);
  $stmt->bind_param("s",$pubid);

  if(!$stmt->execute()){
    echo("0,SQL Error : ".$stmt->error);
  }
  else{
    /*$sql_new = "UPDATE tbl_users SET usr_status=0 WHERE usr_name=(SELECT emp_email from tbl_employee WHERE emp_id=?)";
    $stmt_new= $dbobj->prepare($sql_new);
    $stmt_new->bind_param("s",$pubid);
    $stmt_new->execute();
    $stmat_new->close();*/
    echo("1,Successfully Removed!");
  }
  $stmt->close();
  $dbobj->close();


}
?>

