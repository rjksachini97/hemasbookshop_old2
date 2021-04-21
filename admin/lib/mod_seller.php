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
function getNewSellerId(){
	$dbobj = DB::connect();
	$sql = "SELECT sell_id FROM tbl_seller ORDER BY sell_id DESC LIMIT 1;";
	$result = $dbobj->query($sql);

	if($dbobj->errno){
		echo("SQL Error : ".$dbobj->error);
		exit;
	}

	$nor = $result->num_rows;

	if($nor == 0){
		$newid = "SELL0001";
	}
	else{
		$rec = $result->fetch_assoc();
		$lastid = $rec["sell_id"];
		$num = substr($lastid, 4);
		$num++;
		$newid = "SELL".str_pad($num,4,"0",STR_PAD_LEFT);
	}

	$dbobj->close();
	return $newid;
}

/*
Below function is used to insert new employee records to 
the tbl_employee
*/
function addNewSeller(){
	$sell_id = $_POST["txtsellerid"];
	$sell_title = $_POST["cmbtitle"];
	$sell_name = $_POST["txtsellername"];
	$sell_address = $_POST["txtselleraddress"];
	$sell_mobile = $_POST["txtsellermobile"];
	$sell_email = $_POST["txtselleremail"];
	$sell_nic = $_POST["txtsellernic"];
	$sell_doj = $_POST["dtpdoj"];

	$dbobj = DB::connect();

	$sql = "INSERT INTO tbl_seller(sell_id,sell_title,sell_name,sell_address,sell_mobile,sell_email,sell_nic,sell_doj) VALUES(?,?,?,?,?,?,?,?);";

	$stmt = $dbobj->prepare($sql);
	$stmt->bind_param("sissssss",$sell_id,$sell_title,$sell_name,$sell_address,$sell_mobile,$sell_email,$sell_nic,$sell_doj);

	if(!$stmt->execute()){
		echo("0,SQL Error : ".$stmt->error);
	}
	else{
		echo("1,Successfully Registered!");
	}
	$stmt->close();
	$dbobj->close();
}

function viewSeller(){
	//echo("viewEmp");
	// DB table to use
	$table = 'tbl_seller';
 
	// Table's primary key
	$primaryKey = 'sell_id';

	$columns = array(
	    array( 'db' => 'sell_id', 'dt' => 0 ),
	    array( 'db' => 'sell_name',  'dt' => 1 ),
	    array( 'db' => 'sell_address',  'dt' => 2 ),
	    array( 'db' => 'sell_mobile',   'dt' => 3 ),
		array( 'db' => 'sell_email',    'dt' => 4)	
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
    SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns, null,"sell_status=1" )
	);
}
function getSeller(){
	$sellid = $_POST["sellid"];
	$dbobj = DB::connect();
	$sql= "SELECT * FROM tbl_seller where sell_id='$sellid';";

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
function updateSeller(){
	$sell_id = $_POST["txtsellerid"];
	$sell_title = $_POST["cmbtitle"];
	$sell_name = $_POST["txtsellername"];
	$sell_address = $_POST["txtselleraddress"];
	$sell_mobile = $_POST["txtsellermobile"];
	$sell_email = $_POST["txtselleremail"];
	$sell_nic = $_POST["txtsellernic"];
	$sell_doj = $_POST["dtpdoj"];

	$dbobj = DB::connect();

	$sql = "UPDATE tbl_seller SET sell_title=?, sell_name=?, sell_address=?, sell_mobile=?, sell_email=?, sell_nic=?, sell_doj=? WHERE sell_id=?";

	/*$sql = "UPDATE tbl_employee SET emp_title='$emp_title', emp_name='$emp_name', emp_dob='$emp_dob', emp_gender='$emp_gender', emp_address='$emp_address', emp_mobile='$emp_tel', emp_email='$emp_email', emp_nic='$emp_nic',emp_doj='$emp_doj' WHERE emp_id='$emp_id'";*/

	/*$sql = "INSERT INTO tbl_employee(emp_id,emp_title,emp_name,emp_dob,emp_gender,emp_address,emp_mobile,emp_email,	emp_nic,emp_doj) VALUES(?,?,?,?,?,?,?,?,?,?);";*/

	$stmt = $dbobj->prepare($sql);
	$stmt->bind_param("isssssss",$sell_title,$sell_name,$sell_address,$sell_tel,$sell_email,$sell_nic,$sell_doj,$sell_id);

	if(!$stmt->execute()){
		echo("0,SQL Error : ".$stmt->error);
	}
	else{
		echo("1,Successfully Updated!");
	}
	$stmt->close();
	$dbobj->close();
}
function deleteSeller(){
	$sellid = $_POST["sellid"];
	
	$dbobj = DB::connect();
	$sql = "UPDATE tbl_seller SET sell_status=0  WHERE sell_id=?";

	$stmt = $dbobj->prepare($sql);
	$stmt->bind_param("s",$sellid);

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