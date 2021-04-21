<?php
require_once("dbconnection.php");

if(isset($_GET["type"])){
	$type = $_GET["type"];
	$type(); 
}

function getEmployeeCount(){
	$dbobj = DB::connect();
	$table = "tbl_employee";

	$sql = "SELECT count(*) FROM $table WHERE emp_status=1;";

	$result = $dbobj->query($sql);

	if($dbobj->errno){
		echo("SQL Error : " .$dbobj->error);
		exit;
	}
	$rec = $result->fetch_array();
	echo($rec[0]);
	$dbobj->close();
}

function getEmployeeList(){
	$dbobj = DB::connect();
	$table = "tbl_employee";

	$sql = "SELECT emp_id,emp_name FROM $table WHERE emp_status=1;";

	$result = $dbobj->query($sql);

	if($dbobj->errno){
		echo("SQL Error : " .$dbobj->error);
		exit;
	}
	while($rec = $result->fetch_assoc()){
		echo('<a class="dropdown-item notifi" href="#" title="'.$rec["emp_id"].'">'.$rec["emp_name"].'</a>');
	}
	$dbobj->close();
}

function getUserName(){
	$dbobj = DB::connect();
	$table = "tbl_users";

	$sql = "SELECT usr_name from tbl_users WHERE usr_status=1;";

	$result = $dbobj->query($sql);
}

/*------------------------Display Active User count----------------------*/
function getActiveUserCount(){
    $dbobj = DB::connect();
    $sql = "SELECT count(usr_status) FROM tbl_users WHERE usr_status=1";
    $result = $dbobj->query($sql);
    if($dbobj->errno){
        echo("SQL Error : " .$dbobj->error);
        exit;
    }
    $rec = $result->fetch_array();
    echo ($rec[0]);

    $dbobj->close();
}

/*------------------------Display Register customer count----------------------*/
function getRegCustomerCount(){
    $dbobj = DB::connect();
    $sql = "SELECT count(cus_id) FROM tbl_reg_customer";
    $result = $dbobj->query($sql);
    if($dbobj->errno){
        echo("SQL Error : " .$dbobj->error);
        exit;
    }
    $rec = $result->fetch_array();
    echo ($rec[0]);

    $dbobj->close();
}

/*------------------------Display Register customer count----------------------*/
function getNPOrderCount(){
    $dbobj = DB::connect();
    $sql = "SELECT count(order_id) FROM tbl_newspaper_order";
    $result = $dbobj->query($sql);
    if($dbobj->errno){
        echo("SQL Error : " .$dbobj->error);
        exit;
    }
    $rec = $result->fetch_array();
    echo ($rec[0]);

    $dbobj->close();
}

/*------------------------Display Register customer count----------------------*/
function getOutofStockCount(){
    $dbobj = DB::connect();
    $sql = "SELECT count(*)newsp_id FROM tbl_newspaper WHERE newsp_qty='0'";
    $result = $dbobj->query($sql);
    if($dbobj->errno){
        echo("SQL Error : " .$dbobj->error);
        exit;
    }
    $rec = $result->fetch_array();
    echo ($rec[0]);

    $dbobj->close();
}


?>
