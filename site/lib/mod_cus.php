<?php
require_once("dbconnection.php");

if (isset($_GET["type"])){
	$type = $_GET["type"];
	$type();
}
/*
Below function is used to insert new Customer records to 
the tbl_reg_customer
*/

function addNewCus(){
	$cus_name = $_POST["txtname"];
	$cus_dob = $_POST["dtpdob"];
	$cus_gender = $_POST["optgen"];
	$cus_address = $_POST["txtaddress"];
	$cus_mobile = $_POST["txtmob"];
	$cus_email = $_POST["txtemail"];
	$cus_nic = $_POST["txtnic"];
	$cus_pass = md5($_POST["txtformpass"]);

	$dbobj = DB::connect();

	$sql = "INSERT INTO  tbl_reg_customer(cus_name,cus_dob,cus_gender,cus_address,cus_mobile,cus_email,cus_nic,cus_pass) VALUES(?,?,?,?,?,?,?,?);"; 

	$stmt = $dbobj->prepare($sql);
	$stmt->bind_param("ssisssss",$cus_name,$cus_dob,$cus_gender,$cus_address,$cus_mobile,$cus_email,$cus_nic,$cus_pass);

	if(!$stmt->execute()){
		echo("0,SQL Error : ".$stmt->error);
	}
	else{
		
		echo("1,Successfully Registered!");
	}
	$stmt->close();
	$dbobj->close();
}

function uploadSlipAd(){
	$dbobj = DB::connect();

	$ad_book_id = $_GET['ad_book_id'];
	$img_name = $ad_book_id . ".jpg";
	$img_temp = $_FILES['imgup']['tmp_name'];
	$path = "../../images/BankSlips/AdBooking_slips/" . $img_name;
	$sql = "UPDATE  tbl_ad_booking SET ad_img_slip='$img_name' WHERE ad_book_id=$ad_book_id";

	if($dbobj->query($sql)){
		move_uploaded_file($img_temp, $path);
	}
	// echo $dbobj->error;
	// return 0;

	header("Location: ../cus_profile.php");
}

function uploadSlipNp(){
	$dbobj = DB::connect();

	$np_book_id = $_GET['np_book_id'];
	$img_name = $np_book_id . ".jpg";
	$img_temp = $_FILES['imgup']['tmp_name'];
	$path = "../../images/BankSlips/NpBooking_slips/" . $img_name;
	$sql = "UPDATE  tbl_newspaper_booking SET np_slip_img='$img_name' WHERE np_book_id=$np_book_id";

	if($dbobj->query($sql)){
		move_uploaded_file($img_temp, $path);
	}
	// echo $dbobj->error;
	// return 0;

	header("Location: ../cus_profile.php");
}

?>