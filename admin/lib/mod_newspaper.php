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
function getNewNewsPaperId(){
  $dbobj = DB::connect();
  $sql = "SELECT newsp_id FROM tbl_newspaper ORDER BY newsp_id DESC LIMIT 1;";
  $result = $dbobj->query($sql);

  if($dbobj->errno){
	echo("SQL Error : ".$dbobj->error);
	exit;
  }

  $nor = $result->num_rows;

  if($nor == 0){
	$newid = "NEWP0001";
  }
  else{
	$rec = $result->fetch_assoc();
	$lastid = $rec["newsp_id"];
	$num = substr($lastid, 4);
	$num++;
	$newid = "NEWP".str_pad($num,4,"0",STR_PAD_LEFT);
  }

  $dbobj->close();
  return $newid;
}

function getPubCategories(){
  $dbobj = DB::connect(); 
  $sql = "SELECT pub_id,pub_name FROM tbl_pub_company WHERE pub_id NOT IN (SELECT newsp_id FROM tbl_newspaper) AND pub_status=1;";

  $result = $dbobj->query($sql);

  if($dbobj->errno){
    echo("SQL Error : ".$dbobj->error);
    exit;
  }

   $nor = $result->num_rows;
  if($nor>0){
    while($rec = $result->fetch_assoc()){
      echo("<option value='".$rec["pub_id"]."'>".$rec["pub_name"]."</option>");
    }
  }
  $dbobj->close(); 
}

function getCategories(){
  $dbobj = DB::connect(); 
  $sql = "SELECT npcat_id,npcat_category FROM tbl_newspaper_category WHERE npcat_id NOT IN (SELECT newsp_id FROM tbl_newspaper) AND npcat_status=1;";

  $result = $dbobj->query($sql);

  if($dbobj->errno){
    echo("SQL Error : ".$dbobj->error);
    exit;
  }

   $nor = $result->num_rows;
  if($nor>0){
    while($rec = $result->fetch_assoc()){
      echo("<option value='".$rec["npcat_id"]."'>".$rec["npcat_category"]."</option>");
    }
  }
  $dbobj->close(); 
}

function getMedium(){
  $dbobj = DB::connect(); 
  $sql = "SELECT np_det_id,np_medium FROM tbl_newspaper_details WHERE np_det_id NOT IN (SELECT newsp_id FROM tbl_newspaper) AND np_det_status=1;";

  $result = $dbobj->query($sql);

  if($dbobj->errno){
    echo("SQL Error : ".$dbobj->error);
    exit;
  }

   $nor = $result->num_rows;
  if($nor>0){
    while($rec = $result->fetch_assoc()){
      echo("<option value='".$rec["np_det_id"]."'>".$rec["np_medium"]."</option>");
    }
  }
  $dbobj->close(); 
}


/*
Below function is used to insert new newspaer records to 
the tbl_newspaper
*/
function addNewNewsPaper(){

  $newsp_id = $_POST["txtnpid"];
  $newsp_name = $_POST["txtnpname"];
  $pub_id = $_POST["cmbnewspub"];
  $npcat_id = $_POST["cmbnpcategory"];
  $np_det_id = $_POST["cmbmedium"];
  $newsp_price = $_POST["txtnpprice"];
  $newsp_rlevel = $_POST["nprlevel"];

  $dbobj = DB::connect();

  $sql = "INSERT INTO tbl_newspaper(newsp_id,newsp_name,pub_id,npcat_id,np_det_id,newsp_price,newsp_rlevel) VALUES(?,?,?,?,?,?,?);";

  $stmt = $dbobj->prepare($sql);
  $stmt->bind_param("ssssidi",$newsp_id,$newsp_name,$pub_id,$npcat_id,$np_det_id,$newsp_price,$newsp_rlevel);

  if(!$stmt->execute()){
    echo("0,SQL Error : ".$stmt->error);
  }
  else{
    echo("1,Successfully Added!");
  }
  $stmt->close();
  $dbobj->close();
}

function viewNewsPaper(){ 
  $table = <<<EOT
  (SELECT news.newsp_id,pub.pub_name,cat.npcat_category,npdet.np_medium,news.newsp_name,news.newsp_price,news.newsp_rlevel,news.newsp_qty,news.newsp_status 
  FROM tbl_newspaper news 
  JOIN tbl_newspaper_category cat ON news.npcat_id = cat.npcat_id
  JOIN tbl_newspaper_details npdet ON news.np_det_id = npdet.np_det_id 
  JOIN tbl_pub_company pub ON news.pub_id = pub.pub_id WHERE 
  news.newsp_status=1 ORDER BY newsp_id ASC
    ) temp
EOT;
 
	// Table's primary key
  $primaryKey = 'newsp_id';
  
  $columns = array(
	array( 'db' => 'newsp_id', 'dt' => 0 ),
  array( 'db' => 'newsp_name', 'dt' => 1 ),
	array( 'db' => 'npcat_category',  'dt' => 2 ),
	array( 'db' => 'pub_name',  'dt' => 3 ),
  array( 'db' => 'np_medium',  'dt' => 4 ),
  array( 'db' => 'newsp_price',  'dt' => 5 ),
  array( 'db' => 'newsp_qty',  'dt' => 6 ),
  array( 'db' => 'newsp_rlevel',  'dt' => 7 ),
  array( 'db' => 'newsp_status', 'dt' => 8)	
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
  SSP::complex($_POST, $sql_details, $table, $primaryKey,$columns, null,"newsp_status=1")
  );
}

function getNewsPaper(){
  $newspid = $_POST["newspid"];
  $dbobj = DB::connect();
  $sql= "SELECT * FROM tbl_newspaper WHERE newsp_id='$newspid';";

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
function updateNewspaper(){

  $newsp_id = $_POST["txtnpid"];
  $newsp_name = $_POST["txtnpname"];
  $pub_id = $_POST["cmbnewspub"];
  $npcat_id = $_POST["cmbnpcategory"];
  $np_det_id = $_POST["cmbmedium"];
  $newsp_price = $_POST["txtnpprice"];
  $newsp_rlevel = $_POST["nprlevel"];

  $dbobj = DB::connect();

  $sql = "UPDATE tbl_newspaper SET newsp_name=?, pub_id=?, npcat_id=?,  np_det_id=?, newsp_price=?, newsp_rlevel=? WHERE newsp_id=?";

  $stmt = $dbobj->prepare($sql);
  $stmt->bind_param("ssssidi",$newsp_id,$newsp_name,$pub_id,$npcat_id,$np_det_id,$newsp_price,$newsp_rlevel);
  
  if(!$stmt->execute()){
    echo("0,SQL Error : ".$stmt->error);
  }
  else{
    echo("1,Successfully Updated!");
  }
  $stmt->close();
  $dbobj->close();
}
function deleteNewsPaper(){
	$newspid = $_POST["newspid"];
	
	$dbobj = DB::connect();
	$sql = "UPDATE tbl_newspaper SET newsp_status=0  WHERE newsp_id=?";

	$stmt = $dbobj->prepare($sql);
	$stmt->bind_param("s",$newspid);

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