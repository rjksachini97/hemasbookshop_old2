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
function getCusId(){
	$dbobj = DB::connect();
	$sql = "SELECT cus_id FROM tbl_reg_customer ORDER BY cus_id DESC LIMIT 1;";
	$result = $dbobj->query($sql);

	if($dbobj->errno){
		echo("SQL Error : ".$dbobj->error);
		exit;
	}

	$dbobj->close();

}

/*
Below function is used to insert new employee records to 
the tbl_employee
*/
function addNewCus(){
	$cus_name = $_POST["txtname"];
	$cus_dob = $_POST["dtpdob"];
	$cus_gender = $_POST["optgen"];
	$cus_address = $_POST["txtaddress"];
	$cus_mobile = $_POST["txtmobile"];
	$cus_email = $_POST["txtemail"];
	$cus_nic = $_POST["txtnic"];

	$dbobj = DB::connect();

	$sql = "INSERT INTO tbl_reg_customer(cus_name,cus_dob,cus_gender,cus_address,cus_mobile,cus_email,cus_nic) VALUES(?,?,?,?,?,?,?);";

	$stmt = $dbobj->prepare($sql);
	$stmt->bind_param("ssissss",$cus_name,$cus_dob,$cus_gender,$cus_address,$cus_mobile,$cus_email,$cus_nic);

	if(!$stmt->execute()){
		echo("0,SQL Error : ".$stmt->error);
	}
	else{
		echo("1,Successfully Registered!");
	}
	$stmt->close();
	$dbobj->close();
}

function viewCus(){
	//echo("viewEmp");
	// DB table to use
	$table = 'tbl_reg_customer';
 
	// Table's primary key
	$primaryKey = 'cus_id';

	$columns = array(
	    array( 'db' => 'cus_id', 'dt' => 0 ),
	    array( 'db' => 'cus_name',  'dt' => 1 ),
	    array( 'db' => 'cus_address',  'dt' => 2 ),
	    array( 'db' => 'cus_mobile',   'dt' => 3 ),
		array( 'db' => 'cus_email',    'dt' => 4)	
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
    SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns, null,"cus_status=1" )
	);
}
function getCus(){
	$cusid = $_POST["cusid"];
	$dbobj = DB::connect();
	$sql= "SELECT * FROM tbl_reg_customer where cus_id='$cusid';";

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
function updateCus(){
	$cus_id = $_POST["txtcid"];
	$cus_name = $_POST["txtname"];
	$cus_dob = $_POST["dtpdob"];
	$cus_gender = $_POST["optgen"];
	$cus_address = $_POST["txtaddress"];
	$cus_tel = $_POST["txtmobile"];
	$cus_email = $_POST["txtemail"];
	$cus_nic = $_POST["txtnic"];


	$dbobj = DB::connect();

	$sql = "UPDATE tbl_reg_customer SET cus_name=?, cus_dob=?, cus_gender=?, cus_address=?, cus_mobile=?, cus_email=?, cus_nic=? WHERE cus_id=?";

	$stmt = $dbobj->prepare($sql);
	$stmt->bind_param("sssissss",$cus_name,$cus_dob,$cus_gender,$cus_address,$cus_mobile,$cus_email,$cus_nic,$cus_id);

	if(!$stmt->execute()){
		echo("0,SQL Error : ".$stmt->error);
	}
	else{
		echo("1,Successfully Updated!");
	}
	$stmt->close();
	$dbobj->close();
}
function deleteCus(){
	$cusid = $_POST["cusid"];
	
	$dbobj = DB::connect();
	$sql = "UPDATE tbl_reg_customer SET cus_status=0  WHERE cus_id=?";

	$stmt = $dbobj->prepare($sql);
	$stmt->bind_param("s",$cusid);

	if(!$stmt->execute()){
		echo("0,SQL Error : ".$stmt->error);
	}
	else{
		/*$sql_new = "UPDATE tbl_users SET usr_status=0 WHERE usr_name=(SELECT emp_email from tbl_employee WHERE emp_id=?)";
		$stmt_new= $dbobj->prepare($sql_new);
		$stmt_new->bind_param("s",$cusid);
		$stmt_new->execute();
		$stmat_new->close();*/
		echo("1,Successfully Removed!");
	}
	$stmt->close();
	$dbobj->close();


}
?>