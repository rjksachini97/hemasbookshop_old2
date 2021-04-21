<?php
require_once("dbconnection.php");

if(isset($_GET["type"])){
	$type = $_GET["type"];
	$type();
}

function viewadbooking(){

	$table = 'tbl_ad_booking';
	//echo("viewEmp");
	// DB table to use
	//$table = ' tbl_ad_booking';
 
	// Table's primary key
	$primaryKey = 'ad_book_id';

	$columns = array(
	    array( 'db' => 'ad_book_id','dt' => 0 ),
	    array( 'db' => 'cus_id','dt' => 1 ),
	    array( 'db' => 'newsad_mode','dt' => 2 ),
	    array( 'db' => 'newsp_name','dt' => 3 ),
	    array( 'db' => 'adpub_date','dt' => 4 ),
	    array( 'db' => 'ad_tot_price','dt' => 5 ),
	    array( 'db' => 'ad_book_status','dt' => 6 ),
		array( 'db' => 'ad_pay_status' , 'dt' => 7)
	);

	// SQL server connection information
	require_once("config.php");
	$host = Config::$host;
	$uname = Config::$db_uname;
	$pass = Config::$db_pass;
	$db = Config::$dbname;

	$sql_details = array(
    	'user' => $uname,
    	'pass' => $pass,
    	'db'   => $db,
    	'host' => $host
	);

	require('ssp.class.php');
 
	echo json_encode(
    SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns,null)
	);
}

function viewadBookingDetails(){
	$booking_id = $_POST['booking_id'];
	$dbobj=DB::connect();

	$sql = "SELECT * FROM tbl_ad_booking abook, tbl_reg_customer cus 
			WHERE abook.cus_id=cus.cus_id AND abook.ad_book_id=1=$booking_id;";

	$result = $dbobj->query($sql);

	$output = "";

	while($row = $result->fetch_assoc()){
		$output .= "<label class=\"col-xs-5 control-label\">Booking ID:</label>";
		$output .= "<p class=\"form-control-static\">" . $row['ad_book_id'] . "</p>";

		$output .= "<label class=\"col-xs-5 control-label\">Customer name : </label>";
		$output .= "<p class=\"form-control-static\">".$row['cus_name']."</p> ";

		$output .= "<label class=\"col-xs-5 control-label\">Mobile number : </label>";
		$output .= "<p class=\"form-control-static\">".$row['cus_mobile']."</p> ";

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


function AdviewSlip(){
			$ad_book_id = $_POST['ad_book_id'];
			$dbobj=DB::connect();

			$sql = "SELECT slip_img FROM tbl_event_book WHERE ad_book_id=$ad_book_id;";

			$result = $dbobj->query($sql);

			$output = "";

			$row = $result->fetch_assoc();
			if($row['slip_img'] != ""){  //correct  the path
				$output .= "<img  class='img-thumbnail' src='../../dlab_admin_edit/images/Bankslips/Event_slips/" . $row['slip_img'] . "' />";
			}else{
				$output .="<i>No Image Uploaded!</i>";
			}
			echo $output;
}


function confirmBooking(){
	$booking_id = $_POST['booking_id'];
	$dbobj=DB::connect();

	$sql = "UPDATE tbl_ad_booking SET ad_book_status=1 WHERE ad_book_id=$booking_id";


	sendEmail($dbobj,$booking_id);// mail send to customer

	if($dbobj->query($sql)){
		echo 1;
	}else{
		echo 0;
	}
}


function confirmfullpayment(){
	$booking_id = $_POST['booking_id'];
	$dbobj=DB::connect();

	$sql = "UPDATE tbl_ad_booking SET ad_pay_status=1 WHERE ad_book_id=$booking_id";

	if($dbobj->query($sql)){
		echo 1;
	}else{
		echo 0;
	}
}


function deleteadbooking(){
	$booking_id = $_POST['booking_id'];
	$dbobj=DB::connect();

	$sql = "DELETE FROM tbl_ad_booking WHERE ad_book_id = $booking_id";
	if($dbobj->query($sql)){
		echo 1;
	}else{
		echo 0;
	}
}

?>