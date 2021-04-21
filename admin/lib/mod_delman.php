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
function getNewDelmId(){
  $dbobj = DB::connect();
  $sql = "SELECT delm_id FROM tbl_deliveryman ORDER BY delm_id DESC LIMIT 1;";
  $result = $dbobj->query($sql);

  if($dbobj->errno){
	echo("SQL Error : ".$dbobj->error);
	exit;
  }

  $nor = $result->num_rows;

  if($nor == 0){
	$newid = "DELM0001";
  }
  else{
	$rec = $result->fetch_assoc();
	$lastid = $rec["delm_id"];
	$num = substr($lastid, 4);
	$num++;
	$newid = "DELM".str_pad($num,4,"0",STR_PAD_LEFT);
  }

  $dbobj->close();
  return $newid;
}

/*
Below function is used to insert new employee records to 
the tbl_employee
*/
function addNewDel(){
  $delm_id = $_POST["txtdelmid"];
  $delm_title = $_POST["cmbdelmtitle"];
  $delm_name = $_POST["txtdelmname"];
  $delm_dob = $_POST["dtpdob"];
  $delm_gender = $_POST["optgen"];
  $delm_address = $_POST["txtdelmaddress"];
  $delm_mobile = $_POST["txtdelmmobile"];
  $delm_email = $_POST["txtdelmemail"];
  $delm_nic = $_POST["txtdelmnic"];
  $delm_doj = $_POST["dtpdoj"];

  $dbobj = DB::connect();

  $sql = "INSERT INTO tbl_deliveryman(delm_id,delm_title,delm_name,delm_dob,delm_gender,delm_address,delm_mobile,delm_email,delm_nic,delm_doj) VALUES(?,?,?,?,?,?,?,?,?,?);";

  $stmt = $dbobj->prepare($sql);
  $stmt->bind_param("sississsss",$delm_id,$delm_title,$delm_name,$delm_dob,$delm_gender,$delm_address,$delm_mobile,$delm_email,$delm_nic,$delm_doj);

  if(!$stmt->execute()){
    echo("0,SQL Error : ".$stmt->error);
  }
  else{
    echo("1,Successfully Registered!");
  }
  $stmt->close();
  $dbobj->close();
}

function viewDel(){
  $table = 'tbl_deliveryman';
 
	// Table's primary key
  $primaryKey = 'delm_id';

  $columns = array(
	array( 'db' => 'delm_id', 'dt' => 0 ),
	array( 'db' => 'delm_name',  'dt' => 1 ),
	array( 'db' => 'delm_address',  'dt' => 2 ),
	array( 'db' => 'delm_mobile',   'dt' => 3 ),
	array( 'db' => 'delm_email',    'dt' => 4)	
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
  SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns, null,"delm_status=1" )
  );
}
function getDel(){
  $delmid = $_POST["delmid"];
  $dbobj = DB::connect();
  $sql= "SELECT * FROM tbl_deliveryman WHERE delm_id='$delmid';";

  $result = $dbobj->query($sql);

  if($dbobj->errno){
	echo("SQL Error : ".$dbobj->error);
	exit;
  }
  $rec = $result->fetch_assoc();
  echo(json_encode($rec));
  $dbobj->close();  
}

// update deliveryman
function updateDel(){
  $delm_id = $_POST["txtdelmid"];
  $delm_title = $_POST["cmbdelmtitle"];
  $delm_name = $_POST["txtdelmname"];
  $delm_dob = $_POST["dtpdob"];
  $delm_gender = $_POST["optgen"];
  $delm_address = $_POST["txtdelmaddress"];
  $delm_mobile = $_POST["txtdelmmobile"];
  $delm_email = $_POST["txtdelmemail"];
  $delm_nic = $_POST["txtdelmnic"];
  $delm_doj = $_POST["dtpdoj"];

  $dbobj = DB::connect();

  $sql = "UPDATE tbl_deliveryman SET delm_title=?, delm_name=?, delm_dob=?, delm_gender=?, delm_address=?, delm_mobile=?, delm_email=?, delm_nic=?, delm_doj=? WHERE delm_id=?";

  $stmt = $dbobj->prepare($sql);
  $stmt->bind_param("ississssss",$delm_title,$delm_name,$delm_dob,$delm_gender,$delm_address,$delm_mobile,$delm_email,$delm_nic,$delm_doj,$delm_id);
  
  if(!$stmt->execute()){
    echo("0,SQL Error : ".$stmt->error);
  }
  else{
    echo("1,Successfully Updated!");
  }
  $stmt->close();
  $dbobj->close();
}
function deleteDel(){
	$delmid = $_POST["delmid"];
	
	$dbobj = DB::connect();
	$sql = "UPDATE tbl_deliveryman SET delm_status=0  WHERE delm_id=?";

	$stmt = $dbobj->prepare($sql);
	$stmt->bind_param("s",$delmid);

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