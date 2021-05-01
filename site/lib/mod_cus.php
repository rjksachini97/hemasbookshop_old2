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

function viewadBookingDetails(){
	$booking_id = $_POST['booking_id'];
	$dbobj=DB::connect();

	$sql = "SELECT * FROM tbl_ad_booking book, tbl_newspaper np, tbl_reg_customer cus, tbl_news_ad_mode adm, 
	tbl_ad_colour cl, tbl_news_ad_category adc, tbl_news_adcat_type act, tbl_ad_modes_details admdet 
	WHERE book.cus_id=cus.cus_id AND book.newsp_id=np.newsp_id AND book.newsad_mode_id=adm.newsad_mode_id 
	AND book.adcolour_id=cl.adcolour_id AND book.newsac_id=adc.newsac_id AND 
	book.adcattype_id=act.adcattype_id AND book.admode_details_id=admdet.admode_details_id AND 
	book.ad_book_id='$booking_id';";

	$result = $dbobj->query($sql);

	$output = "";

	while($row = $result->fetch_assoc()){
		/*$output .= "<label class=\"col-xs-5 control-label\">Booking ID:</label>";
		$output .= "<p class=\"form-control-static\">" . $row['ad_book_id'] . "</p>";

		$output .= "<label class=\"col-xs-5 control-label\">Customer name : </label>";
		$output .= "<p class=\"form-control-static\">".$row['cus_name']."</p> ";

		$output .= "<label class=\"col-xs-5 control-label\">Mobile number : </label>";
		$output .= "<p class=\"form-control-static\">".$row['cus_mobile']."</p> ";     */

		$output .= "<label class=\"col-xs-5 control-label\">Advertisment Mode : </label>";
		$output .= "<p class=\"form-control-static\">".$row['newsad_mode']."</p> ";

		$output .= "<label class=\"col-xs-5 control-label\">Advertisment Colour: </label>";
		$output .= "<p class=\"form-control-static\">".$row['adcolour_name']."</p> ";

		$output .= "<label class=\"col-xs-5 control-label\">Newspaper : </label>";
		$output .= "<p class=\"form-control-static\">".$row['newsp_name']."</p> ";

		$output .= "<label class=\"col-xs-5 control-label\">Newspaper Ad Category : </label>";
		$output .= "<p class=\"form-control-static\">".$row['newsac_category']."</p> ";

		$output .= "<label class=\"col-xs-5 control-label\">Newspaper Ad Category Type : </label>";
		$output .= "<p class=\"form-control-static\">".$row['adcattype_desc']."</p> ";


		$output .= "<label class=\"col-xs-5 control-label\">Advertisment Size : </label>";
		$output .= "<p class=\"form-control-static\">".$row['admode_details_size']."</p> ";
	
		$output .= "<label class=\"col-xs-5 control-label\">Booked Date : </label>";
		$output .= "<p class=\"form-control-static\">".$row['crnt_date']."</p> ";

		$output .= "<label class=\"col-xs-5 control-label\">Publish date : </label>";
		$output .= "<p class=\"form-control-static\">".$row['adpub_date']."</p> ";

		$output .= "<label class=\"col-xs-5 control-label\">Ad Description : </label>";
		$output .= "<p class=\"form-control-static\">".$row['ad_description']."</p> ";

		$output .= "<label class=\"col-xs-5 control-label\">Word Count : </label>";
		$output .= "<p class=\"form-control-static\">".$row['ad_wc']."</p> ";

		$output .= "<label class=\"col-xs-5 control-label\">Total Price : </label>";
		$output .= "<p class=\"form-control-static\">".$row['ad_tot_price']."</p> ";
	}

	echo $output;
}






?>