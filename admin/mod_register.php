<?php
require_once("lib/dbconnection.php");

if(isset($_GET["type"])){
	$type = $_GET["type"];
	$type();
}

function getEmail(){
	$eid = $_POST["empid"];
	$dbobj = DB::connect();
	$sql = "SELECT emp_email FROM tbl_employee WHERE emp_id='$eid';";
	$result = $dbobj->query($sql);

	if($dbobj->errno){
		echo("SQL Error : ".$dbobj->error);
		exit;
	}

	$rec= $result->fetch_array();
	echo ($rec[0]);
	$dbobj->close();
}


function addNewUser(){
	$eid = $_POST["txteid"];
	$uname = $_POST["txtuname"];
	$utype = $_POST["cmbtype"];
	$pwd = md5($eid);
	$status = 1;
	$reset =1;

	$dbobj = DB::connect();

	$sql = "INSERT INTO tbl_reg_users(usr_name,usr_pass,usr_type,usr_status,pwd_reset) VALUES (?,?,?,?,?);";

	$stmt = $dbobj->prepare($sql);
	$stmt->bind_param("ssiii",$uname,$pwd,$utype,$status,$reset);

	if(!$stmt->execute()){
		echo("0,SQL Error : ".$stmt->error);
	}
	else{
		echo("1,Account has been Successfully Created!");
	}
	$stmt->close();
	$dbobj->close();
}

//view user in table
function viewusers(){
	//echo("viewuser");
	// DB table to use
	$table = <<<EOT
	( SELECT 
		EMP.emp_id,
		USR.usr_name,
		CASE WHEN USR.usr_type=1 THEN "Admin"
		WHEN USR.usr_type=2 THEN "Manager"
		WHEN USR.usr_type=3 THEN "Sales Assistance"
		END AS "type",
		USR.usr_status 
		FROM tbl_employee EMP JOIN tbl_users USR ON 
			EMP.emp_email=USR.usr_name WHERE
			EMP.emp_status=1 ORDER BY emp_id ASC
		) temp
EOT;
 
	// Table's primary key
	$primaryKey = 'emp_id';

	$columns = array(
	    array( 'db' => 'emp_id', 'dt' => 0 ),
	    array( 'db' => 'usr_name',  'dt' => 1 ),
	    array( 'db' => 'type',  'dt' => 2 ),
	    array('db' => 'usr_status', 'dt'=>3)
	    	
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
    SSP::simple($_POST, $sql_details, $table, $primaryKey, $columns)
	);
}
function getUser(){
	$empid = $_POST["empid"];
	$dbobj = DB::connect();
	$sql = "SELECT * FROM tbl_employee INNER JOIN tbl_users ON tbl_employee.emp_email =tbl_users.usr_name WHERE tbl_employee.emp_id='$empid';";

	$result = $dbobj->query($sql);

	if($dbobj->errno){
		echo("SQL Error : ".$dbobj->error);
		exit;
	}
	$rec = $result->fetch_assoc();
	echo(json_encode($rec));
	$dbobj->close();

}

//update user
function updateUsers(){
	$empid = $_POST["txteid"];
	$usrtype = $_POST["cmbtype"];
	$username = $_POST["txtuname"];
	$usrstatus = $_POST["optstatus"];

	$dbobj = DB::connect();

	$sql = "UPDATE tbl_users SET usr_type=?,
			usr_status=? WHERE usr_name=? "; 

	$stmt = $dbobj->prepare($sql);
	$stmt->bind_param
	("iis",$usrtype,$usrstatus,$username);

	if(!$stmt->execute()){
		echo("0,SQL Error : ".$stmt->error);
	}
	else{
		echo("1,Successfully Updated!");
	}
	$stmt->close();
	$dbobj->close();
}
/*This is for password reset*/

function resetPassword(){
	$empid = $_POST["eid"];
	$uname = $_POST["uname"];

	$dbobj = DB::connect();

	$pwd = md5($empid);
	$reset=1;

	$sql = "UPDATE tbl_users SET usr_pass=?,pwd_reset=? WHERE usr_name=? ";

	$stmt = $dbobj->prepare($sql);
	$stmt->bind_param("sis",$pwd,$reset,$uname);

	if(!$stmt->execute()){
		echo("0,SQL Error : ".$stmt->error);
	}
	else{  /* to send email  */
		$to = "newuser@localhost"; /* receiver email */
		$sub = "Reset Your Password";  /* subject email */

		$name = getFirstName($empid);  /* to get user name */
		$msg = "Hello $name,<br><br>";
		$uname = md5($uname);
		$time = time();  /* to get current time */
		$link = "http://localhost/webclass/pw/reset.php?u=$uname&t=$time";  /* link for password reset*/
		$msg .= "Your password has been reset by administartor, please click this <a href='$link'>Password Reset link</a> to setup a new password.<br><br> ";

		$msg .="Thank you, <br>Admin team";
		$headers = "From:<postmaster@localhost>\r\n";  /* sender default email you can't change */
		$headers .= "Content-type: text/html\r\n";

		if(mail($to,$sub,$msg,$headers)) {
			echo("1,Successfully Updated!");
		}
		else{
			echo("0,Mail Error!");
		}
	}
	$stmt->close();
	$dbobj->close();
}

	/*this is for get user name for email*/
function getFirstName($empid){
	$dbobj = DB::connect();
	$sql = "SELECT emp_name FROM tbl_employee WHERE emp_id='$empid';";

	$result = $dbobj->query($sql);
	if($dbobj->errno){
		echo("0,SQL Error : ".$dbobj->error);
		exit;
	}
	$rec = $result->fetch_array();
	$dbobj->close();
	return $rec[0];
}
function changeStatus(){
	$uname = $_POST["uname"];

	$dbobj = DB::connect();
	$sql = "UPDATE tbl_users SET usr_status=(CASE WHEN usr_status=1 THEN 0 WHEN usr_status=0 THEN 1 END) WHERE usr_name=?;";

	$stmt = $dbobj->prepare($sql);
	$stmt->bind_param("s",$uname);

	if(!$stmt->execute()){
		echo("0,SQL Error : ".$stmt->error);
	}
	else{
		echo("1,Successfully Changed!");
	}
	$stmt->close();
	$dbobj->close();
}
?>