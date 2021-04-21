<?php
require_once("dbconnection.php");

/*
Below function is used to insert new Customer records to 
the tbl_customer
*/
function addNewCus(){
	$cus_id = $_POST["txteid"];
	$cus_name = $_POST["txtname"];
	$cus_dob = $_POST["dtpdob"];
	$cus_gender = $_POST["optgen"];
	$cus_address = $_POST["txtaddress"];
	$cus_mobile = $_POST["txtmob"];
	$cus_email = $_POST["txtemail"];
	$cus_nic = $_POST["txtnic"];
	$cus_pass = md5($_POST["txtpass"]);
	

	$dbobj = DB::connect();

	$sql = "INSERT INTO tbl_reg_customer(cus_id,cus_name,cus_dob,cus_gender,cus_address,cus_mobile,cus_email,cus_nic,cus_pass) VALUES(?,?,?,?,?,?,?,?,?);";

	$stmt = $dbobj->prepare($sql);
	$stmt->bind_param("ississsss",$cus_id,$cus_name,$cus_dob,$cus_gender,$cus_address,$cus_mobile,$cus_email,$cus_nic,$cus_pass);

	if(!$stmt->execute()){
		echo("0,SQL Error : ".$stmt->error);
	}
	else{
		echo("1,Successfully Registered!");
	}
	$stmt->close();
	$dbobj->close();
}



?>